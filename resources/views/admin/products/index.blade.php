@extends('layouts.admin')
@section('title', 'Admin - Products')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Products</h2>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-4">Add New Product</a>

    <div class="row">
        @forelse($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                        <strong>Category:</strong> {{ $product->category->name ?? '-' }}<br>
                        <strong>Price:</strong>  Ksh {{ number_format($product->price, 0) }}<br>
                        <strong>Stock:</strong> {{ $product->stock }}
                    </p>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
</div>
@endsection
