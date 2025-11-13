@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-2">{{ $category->name }}</h2>
                <p class="text-muted">{{ $category->description }}</p>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-4">
                @forelse($category->products as $product)
                    <div class="card shadow-sm border-0 position-relative" style="width: 16rem;">

                        <img 
                            src="{{ $product->image ? asset('storage/products/products/' . $product->image) : asset('assets/img/default-product.png') }}" 
                            class="card-img-top rounded-top" 
                            alt="{{ $product->name }}"
                            style="height: 180px; object-fit: cover;"
                        >
                        <div class="card-body text-center">
                            <h6 class="fw-bold">{{ $product->name }}</h6>
                            <p class="text-muted small">{{ Str::limit($product->description, 60) }}</p>

                            <a href="{{ route('products.show', $product->id) }}" 
                               class="btn btn-outline-primary btn-sm mb-2">
                               View
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted w-100">No products in this category yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
