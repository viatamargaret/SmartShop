@extends('layouts.default')

@section('title', 'SmartShop Home')

@section('content')
<div class="container py-5">

    <div class="card shadow-sm mb-4 p-4">
        <div class="row align-items-center">

            <div class="col-md-4 text-center">
                <img class="auth-logo mb-3" src="{{ asset('storage/products/products/logo.png') }}" alt="SmartShop Logo" width="180">
            </div>

            <div class="col-md-8">
                <h2 class="fw-bold text-primary">Welcome to SmartShop</h2>
                <p class="text-muted mt-3">
                    SmartShop is your ultimate online shopping destination in Kenya. We bring you a wide range of high-quality products from electronics, fashion and groceries to home and beauty essentials, all in one convenient platform.  
                    Enjoy a smooth, secure and fast shopping experience with quick deliveries, easy returns and excellent customer support.  
                    Whether you’re looking for daily items or exclusive deals, SmartShop is here to make your shopping smarter and simpler!
                </p>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card shadow-sm mb-4 p-3">
                <h5 class="fw-semibold mb-3">🔥 Popular Products</h5>
                <div class="row g-3">
                    @foreach($popularProducts->take(3) as $product)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img 
                                src="{{ $product->image ? asset('storage/products/products/' . $product->image) : asset('assets/img/default-product.png') }}" 
                                class="card-img-top rounded-top" 
                                alt="{{ $product->name }}"
                                style="height: 180px; object-fit: cover;"
                            >
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">{{ $product->name }}</h6>
                                <p class="card-text text-success fw-bold">KSh {{ number_format($product->price, 2) }}</p>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm mt-auto">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card shadow-sm mb-4 p-3">
                <h5 class="fw-semibold mb-3">📦 Most Recent Orders</h5>
                @if($recentOrders->count() > 0)
                    <ul class="list-group">
                        @foreach($recentOrders as $order)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Order #{{ $order->id }}
                            <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">You have no recent orders.</p>
                @endif
            </div>

            <div class="card shadow-sm mb-4 p-3">
                <h5 class="fw-semibold mb-3">💬 Customer Reviews</h5>
                @foreach($reviews as $review)
                <div class="mb-3 border-bottom pb-2">
                    <strong>{{ $review->user->name }}</strong>
                    <span class="text-warning">
                        @for($i = 0; $i < $review->rating; $i++)
                            ★
                        @endfor
                    </span>
                    <p>
                        {{ $review->comment }}
                        <span class="badge bg-light text-muted">{{ $review->language }}</span>
                    </p>
                </div>
                @endforeach
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm mb-4 p-3">
                <h5 class="fw-semibold mb-3">⚡ Quick Access</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">View Categories</a>
                    <a href="{{ route('cart.index') }}" class="btn btn-success">Your Cart</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-info">Your Orders</a>
                    <a href="{{ route('chatbot.index') }}" class="btn btn-warning text-dark">Chat Assistant</a>
                </div>
            </div>

            <div class="card shadow-sm mb-4 p-3 text-center">
                <h5 class="fw-semibold mb-3">👤 Your Profile</h5>
                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm mt-auto">Edit Profile</a>
            </div>

            <div class="card shadow-sm p-3">
                <h5 class="fw-semibold mb-3">📞 Contact Us</h5>
                <p><strong>Phone:</strong> +254 700 123456</p>
                <p><strong>WhatsApp:</strong> +254 712 987654</p>
                <p><strong>Instagram:</strong> <a href="https://instagram.com/SmartShop" target="_blank">@SmartShop</a></p>
                <p><strong>Facebook:</strong> <a href="https://facebook.com/SmartShop" target="_blank">SmartShop</a></p>
            </div>

        </div>

    </div>
</div>
@endsection
