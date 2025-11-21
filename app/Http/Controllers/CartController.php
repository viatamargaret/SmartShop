<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $rawCart = session()->get('cart', []);

        $cart = collect($rawCart)->mapWithKeys(function ($item, $key) {
            $name = is_array($item) ? ($item['name'] ?? null) : ($item->name ?? null);
            $price = is_array($item) ? ($item['price'] ?? null) : ($item->price ?? null);
            $quantity = is_array($item) ? ($item['quantity'] ?? null) : ($item->quantity ?? null);
            $image = is_array($item) ? ($item['image'] ?? null) : ($item->image ?? null);

            return [
                $key => [
                    'name' => $name ?? 'Unknown Product',
                    'price' => is_numeric($price) ? (float) $price : 0.0,
                    'quantity' => is_numeric($quantity) ? (int) $quantity : 0,
                    'image' => $image,
                ],
            ];
        })->filter(fn ($item) => $item['quantity'] > 0)->toArray();

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('cart.index', ['cart' => $cart, 'total' => $total]);
    }
    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', "{$product->name} added successfully to cart!");
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }

        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }

        return redirect()->back();
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Your cart has been cleared.');
    }
}
