<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Feedback;

class CustomerHomeController extends Controller
{
    /**
     * Display the customer dashboard/home page.
     */
    public function index()
    {
        // 🌟 Get top popular products (based on sales or ratings)
        $popularProducts = Product::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // 🧾 Get recent orders for the logged-in user
        $recentOrders = Order::where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->get();

        // ⭐ Get recent feedback (with users)
        $reviews = Feedback::with('user')
            ->latest()
            ->take(5)
            ->get();

        // 🏡 Return the view with all data
        return view('customer.home', compact('popularProducts', 'recentOrders', 'reviews'));
    }

    /**
     * Store user feedback from the form.
     */
    public function storeFeedback(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thanks for your feedback!');
    }
}
