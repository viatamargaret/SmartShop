<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// AUTH & GENERAL CONTROLLERS
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;

// CUSTOMER CONTROLLERS
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatbotController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController;

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthManager::class, 'register'])->name('register');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [CustomerHomeController::class, 'index'])->name('home');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place', [CheckoutController::class, 'process'])->name('checkout.place');
    Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');
    Route::get('/chatbot/clear', [ChatbotController::class, 'clear'])->name('chatbot.clear');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'editProfile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('updateProfile');

    Route::resource('/products', AdminProductController::class)->names('products');
    Route::resource('/categories', AdminCategoryController::class)->names('categories');
    Route::resource('/users', UserController::class)->names('users');
    Route::post('/users/{id}/toggle', [UserController::class, 'toggleActive'])->name('users.toggle');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::post('/messages/reply/{message}', [MessageController::class, 'reply'])->name('messages.reply');
});


