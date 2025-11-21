<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ChatbotMessage;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        $messageCount = ChatbotMessage::count();

        return view('admin.dashboard', compact('userCount', 'productCount', 'categoryCount', 'messageCount'));
    }

    public function editProfile() { }
    public function updateProfile() { }
}
