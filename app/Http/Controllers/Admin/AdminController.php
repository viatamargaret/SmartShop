<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ChatbotMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Admin Dashboard - display counts and overview.
     */
    public function index()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        $messageCount = ChatbotMessage::count();

        return view('admin.dashboard', compact('userCount', 'productCount', 'categoryCount', 'messageCount'));
    }

    /**
     * Show admin profile edit form.
     */
    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Update admin profile info.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
