@extends('layouts.default')

@section('title', 'Order Confirmation')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center text-primary fw-bold">✅ Order Confirmation</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <p>Thank you, <strong>{{ Auth::user()->name }}</strong>! Your order has been placed successfully.</p>
        <p>Order ID: <strong>#{{ $order->id }}</strong></p>
        <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>

        <hr>

        <h4 class="mb-3">Order Summary</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price (KSh)</th>
                        <th>Subtotal (KSh)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @foreach ($order->items as $item)
                        @php
                            $lineTotal = $item->price * $item->quantity;
                            $subtotal += $lineTotal;
                        @endphp
                        <tr>
                            <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>{{ number_format($lineTotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <p>Subtotal: <strong>KSh {{ number_format($subtotal, 2) }}</strong></p>

            @if (!empty($order->delivery_fee))
                <p>Delivery Fee: <strong>KSh {{ number_format($order->delivery_fee, 2) }}</strong></p>
            @endif

            @if (strtolower($order->payment_method) === 'cod')
                <p>Cash on Delivery Fee: <strong>KSh 100</strong></p>
            @endif

            <hr>
            <h5>Total Amount: <strong class="text-primary">KSh {{ number_format($order->total_amount, 2) }}</strong></h5>
        </div>

        <div class="mt-4">
            <p><strong>Delivery Address:</strong> {{ $order->address ?? 'N/A' }}</p>
            <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
        </div>

        <hr>

        <div class="mt-4">
            <h4 class="text-primary fw-bold">⭐ Leave Feedback</h4>

            <form action="{{ route('feedback.store', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1-5)</label>
                    <input type="number" id="rating" name="rating" class="form-control" min="1" max="5" required>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Submit Feedback</button>
            </form>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">🛍 Continue Shopping</a>
        </div>
    </div>
</div>
@endsection
