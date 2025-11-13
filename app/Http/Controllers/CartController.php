<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        if (Auth::check()) {
            // You can extend this later to merge user + guest carts
            $cart = session()->get('cart', []);
        } else {
            $cart = session()->get('cart', []);
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function add($id)
    {
        $product = Product::findOrFail($id);

        // Example: Add to session cart
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

    /**
     * Update product quantity in the cart.
     */
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

    /**
     * Remove a product from the cart.
     */
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

    /**
     * Clear the entire cart.
     */
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Your cart has been cleared.');
    }
}
