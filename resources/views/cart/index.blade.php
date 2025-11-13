@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center fw-bold">
            🛒 Your Shopping Cart
        </div>
        <div class="card-body">
            @if(empty(session('cart')))
                <div class="text-center p-5">
                    <h5>Your cart is empty.</h5>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary mt-3">
                        Continue Shopping
                    </a>
                </div>
            @else
                @php
                    $cart = session('cart');
                    $total = 0;
                @endphp

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                @php
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex justify-content-center align-items-center">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                class="form-control text-center me-2" style="width: 80px;">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                        </form>
                                    </td>
                                    <td>Ksh {{ number_format($item['price'], 2) }}</td>
                                    <td>Ksh {{ number_format($subtotal, 2) }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.remove') }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="3" class="text-end">Total:</td>
                                <td colspan="2">Ksh {{ number_format($total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        ← Continue Shopping
                    </a>
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
            @endif
        </div>
    </div>
</div>
@endsection
