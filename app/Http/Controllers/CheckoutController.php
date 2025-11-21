<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $cities = [
            'Nairobi' => ['Central Park', 'Westlands Mall', 'CBD PickUp Point'],
            'Mombasa' => ['Mombasa Mall', 'Nyali PickUp', 'Old Town PickUp'],
            'Kisumu' => ['Kisumu Mall', 'Nyakach PickUp', 'CBD Kisumu'],
        ];

        return view('checkout.index', compact('cart', 'subtotal', 'cities'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'delivery_option' => 'required|string',
            'pickup_point' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'payment_method' => 'required|string',
            'phone' => 'nullable|string',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Calculate delivery fee
        $deliveryFee = 0;
        if ($request->delivery_option === 'door') {
            $deliveryFees = [
                'Nairobi' => 200,
                'Mombasa' => 300,
                'Kisumu' => 250,
            ];
            $deliveryFee = $deliveryFees[$request->city] ?? 400;
        }

        // Include COD fee directly in total
        $codFee = strtolower($request->payment_method) === 'cod' ? 100 : 0;

        $totalAmount = $subtotal + $deliveryFee + $codFee;

        $finalAddress = $request->delivery_option === 'door' ? $request->address : $request->pickup_point;

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $finalAddress,
            'payment_method' => $request->payment_method,
            'total_amount' => $totalAmount,
            'status' => 'Pending',
        ]);

        foreach ($cart as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        Session::forget('cart');

        return redirect()->route('checkout.confirmation', $order->id)
                         ->with('success', 'Your order has been placed successfully!');
    }

    public function confirmation($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('checkout.confirmation', compact('order'));
    }

    public function feedback()
    {
        return view('checkout.feedback');
    }

    public function submitFeedback(Request $request, $orderId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('checkout.confirmation', $orderId)
                         ->with('success', 'Thank you for your feedback!');
    }
}
