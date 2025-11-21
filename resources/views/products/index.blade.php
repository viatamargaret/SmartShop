@extends('layouts.default')

@section('title', 'SmartShop - Products')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="fw-bold text-center mb-4">🛍️ Explore Our Products</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($products->isEmpty())
                <div class="text-center text-muted">
                    <p>No products available yet.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($products as $product)
                        <div class="col-md-4 col-lg-3">
                            <div class="card shadow-sm border-0 h-100 position-relative">

                                <img 
                                    src="{{ $product->image ? asset('storage/products/products/' . $product->image) : asset('assets/img/default-product.png') }}"
                                    class="card-img-top" 
                                    alt="{{ $product->name }}"
                                    style="height: 200px; object-fit: cover;"
                                >
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold">{{ $product->name }}</h5>
                                    <p class="card-text text-muted mb-2">{{ Str::limit($product->description, 60) }}</p>
                                    <h6 class="text-primary mb-3">KSh {{ number_format($product->price, 2) }}</h6>

                                    <div class="mt-auto">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
