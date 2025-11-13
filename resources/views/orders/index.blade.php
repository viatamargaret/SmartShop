@extends('layouts.default')

@section('style')
<style>
.orders-page {
    margin-top: 40px;
}
.order-card {
    border-left: 4px solid #007bff;
    margin-bottom: 20px;
}
.fee-details {
    background-color: #f9f9f9;
    border-radius: 8px;
    padding: 12px 15px;
}
.fee-details p {
    margin-bottom: 5px;
}
</style>
@endsection

@section('content')
<div class="container orders-page">
    <h2 class="mb-4 fw-bold text-center">📜 My Orders</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center mt-5">
            <h5>No orders found 🛍️</h5>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Start Shopping</a>
        </div>
    @else
        @foreach($orders as $order)
            <div class="card order-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-1">Order #{{ $order->id }}</h6>
                            <p class="mb-1 text-muted">
                                Total: <strong>Ksh {{ number_format($order->total_amount, 2) }}</strong>
                            </p>
                            <span class="badge 
                                @if($order->status == 'Pending') bg-warning 
                                @elseif($order->status == 'Delivered') bg-success 
                                @elseif($order->status == 'Cancelled') bg-danger 
                                @else bg-info 
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">Placed on: {{ $order->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-2">🛒 Items Ordered:</h6>
                    <ul class="list-unstyled">
                        @foreach($order->items as $item)
                            <li>
                                {{ $item->product->name }} × {{ $item->quantity }} — 
                                <strong>Ksh {{ number_format($item->price * $item->quantity, 2) }}</strong>
                            </li>
                        @endforeach
                    </ul>

                    <hr>

                    {{-- Fees Breakdown --}}
                    <div class="fee-details">
                        <h6 class="fw-bold mb-2">💰 Order Summary</h6>
                        <p>Subtotal: <span class="float-end">Ksh {{ number_format($order->subtotal ?? $order->total_amount - (($order->delivery_fee ?? 0) + ($order->service_fee ?? 0)), 2) }}</span></p>
                        <p>Delivery Fee: <span class="float-end">Ksh {{ number_format($order->delivery_fee ?? 150, 2) }}</span></p>
                        <p>Service Fee: <span class="float-end">Ksh {{ number_format($order->service_fee ?? 50, 2) }}</span></p>
                        <hr>
                        <p class="fw-bold">Grand Total: <span class="float-end text-success">Ksh {{ number_format($order->total_amount, 2) }}</span></p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1"><strong>Delivery Address:</strong> {{ $order->address ?? 'Not specified' }}</p>
                            <p class="mb-0"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? 'Cash on Delivery') }}</p>
                        </div>
                        <div>
                            @if($order->status == 'Delivered')
                                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-outline-primary btn-sm">Download Invoice</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
