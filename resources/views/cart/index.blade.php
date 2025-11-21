@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="fw-bold text-center mb-4">🛒 Your Shopping Cart</h2>

            @if(empty($cart))
                <div class="text-center p-5">
                    <h5>Your cart is empty.</h5>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary mt-3">
                        Continue Shopping
                    </a>
                </div>
            @else
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price (Ksh)</th>
                                <th>Quantity</th>
                                <th>Subtotal (Ksh)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                @php $lineTotal = $item['price'] * $item['quantity']; @endphp
                                <tr>
                                    <td class="fw-semibold">{{ $item['name'] }}</td>
                                    <td>{{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                min="1" class="form-control form-control-sm me-2" style="width: 80px;">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                                        </form>
                                    </td>
                                    <td>{{ number_format($lineTotal, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST"
                                            onsubmit="return confirm('Remove this item?')">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card bg-light border-0 mb-4">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <h5 class="mb-3 mb-md-0">Total: <strong>Ksh {{ number_format($total, 2) }}</strong></h5>
                        <div>
                            <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger me-2"
                               onclick="return confirm('Are you sure you want to clear the cart?')">
                                Clear Cart
                            </a>
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                                Proceed to Checkout →
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        ← Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
