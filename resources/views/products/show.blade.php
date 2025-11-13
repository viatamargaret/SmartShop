@extends('layouts.default')

@section('title', $product->name . ' - SmartShop')

@section('content')
<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">

            <div class="row g-5 align-items-center">
                <!-- Product Image -->
                <div class="col-md-6 text-center">
                    <img 
                        src="{{ $product->image ? asset('storage/products/products/' . $product->image) : asset('assets/img/default-product.png') }}"
                        alt="{{ $product->name }}"
                        class="img-fluid rounded shadow-sm"
                        style="max-height: 400px; object-fit: cover;"
                    >
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <div class="text-start">
                        <h2 class="fw-bold">{{ $product->name }}</h2>
                        <h4 class="text-primary mb-4">KSh {{ number_format($product->price, 2) }}</h4>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <h5 class="fw-semibold">Product Description</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>

                    @if(!empty($product->specs))
                        <div class="mb-4">
                            <h5 class="fw-semibold">Specifications</h5>
                            <ul class="list-group list-group-flush rounded">
                                @foreach($product->specs as $key => $value)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>{{ ucfirst($key) }}</strong>
                                        <span>{{ $value }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3 w-100 py-2">
                            Add to Cart 🛒
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
