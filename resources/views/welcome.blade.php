@extends('layouts.default')

@section('title', 'Welcome to SmartShop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center py-5">
                    <h1 class="fw-bold text-primary mb-3">SmartShop</h1>
                    <p class="text-muted mb-4">
                        Discover electronics, fashion, groceries, beauty essentials, and more — all in one smart shopping experience.
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary px-4">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold text-primary">Curated Products</h5>
                    <p class="text-muted mb-0">
                        Browse a wide range of high-quality products, updated daily to match your lifestyle and budget.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold text-primary">Secure Checkout</h5>
                    <p class="text-muted mb-0">
                        Enjoy fast, secure payments with simplified order tracking from purchase to delivery.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold text-primary">Responsive Support</h5>
                    <p class="text-muted mb-0">
                        Need help? Chat with our support team anytime and get quick responses tailored to you.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection