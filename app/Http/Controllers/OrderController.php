<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $cities = [
            'Nairobi' => ['Central Park', 'Westlands Mall', 'CBD PickUp Point'],
            'Mombasa' => ['Mombasa Mall', 'Nyali PickUp', 'Old Town PickUp'],
            'Kisumu' => ['Kisumu Mall', 'Nyakach PickUp', 'CBD Kisumu'],
        ];

        return view('checkout.index', compact('cart', 'total', 'cities'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'delivery_option' => 'required|string',
            'pickup_point' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'payment_method' => 'required|string',
            'phone' => 'nullable|string',
            'card_number' => 'nullable|string',
            'card_expiry' => 'nullable|string',
            'card_cvv' => 'nullable|string',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to place an order.');
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $deliveryFee = 0;
        if ($request->delivery_option === 'door') {
            $deliveryFees = [
                'Nairobi' => 200,
                'Mombasa' => 300,
                'Kisumu' => 250,
            ];
            $deliveryFee = $deliveryFees[$request->city] ?? 400;
        }

        $paymentFee = ($request->payment_method === 'cod' && $request->delivery_option === 'door') ? 100 : 0;

        $totalAmount = $subtotal + $deliveryFee + $paymentFee;

        $finalAddress = $request->delivery_option === 'door' ? $request->address : $request->pickup_point;

        $order = Order::create([
            'user_id' => $user->id,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'cod_fee' => $paymentFee,
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'address' => $finalAddress,
            'status' => 'Pending',
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        Session::forget('cart');

        return redirect()->route('checkout.confirmation', $order->id)
            ->with('success', 'Your order has been placed successfully!');
    }
}
