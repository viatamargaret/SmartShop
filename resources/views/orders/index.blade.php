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
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="fw-bold mb-4 text-center">📜 My Orders</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            {{-- If no orders --}}
            @if($orders->isEmpty())
                <div class="text-center mt-4">
                    <h5>No orders found 🛍️</h5>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Start Shopping</a>
                </div>
            @else

                {{-- Orders Grid --}}
                <div class="row g-4">
                    @foreach($orders as $order)
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex flex-column">

                                    {{-- Header --}}
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h6 class="fw-bold mb-1">Order #{{ $order->id }}</h6>
                                            <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                        </div>

                                        <span class="badge
                                            @if($order->status === 'Pending') bg-warning
                                            @elseif($order->status === 'Delivered') bg-success
                                            @elseif($order->status === 'Cancelled') bg-danger
                                            @else bg-info
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>

                                    {{-- TOTAL --}}
                                    <p class="mb-2 fw-semibold text-primary">
                                        Total: Ksh {{ number_format($order->total_amount, 2) }}
                                    </p>

                                    {{-- ITEMS TABLE --}}
                                    <div class="mb-3">
                                        <h6 class="fw-bold">Items</h6>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                        <tr>
                                                            <td>{{ $item->product->name }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>Ksh {{ number_format($item->price * $item->quantity, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- SUMMARY --}}
                                    <div class="bg-light rounded-3 p-3 mb-3">
                                        <h6 class="fw-bold mb-2">Order Summary</h6>

                                        @php
                                            $deliveryFee = $order->delivery_fee ?? 0;
                                            $codFee = $order->cod_fee ?? 0;
                                            $subtotal = $order->subtotal ?? $order->total_amount - ($deliveryFee + $codFee);
                                        @endphp

                                        <p class="mb-1">
                                            Subtotal
                                            <span class="float-end">Ksh {{ number_format($subtotal, 2) }}</span>
                                        </p>
                                        <p class="mb-1">
                                            Delivery Fee
                                            <span class="float-end">Ksh {{ number_format($deliveryFee, 2) }}</span>
                                        </p>
                                        <p class="mb-2">
                                            COD Fee
                                            <span class="float-end">Ksh {{ number_format($codFee, 2) }}</span>
                                        </p>
                                        <p class="fw-bold mb-0">
                                            Grand Total
                                            <span class="float-end text-success">
                                                Ksh {{ number_format($order->total_amount, 2) }}
                                            </span>
                                        </p>
                                    </div>

                                    <p class="mb-1">
                                        <strong>Delivery:</strong>
                                        {{ $order->address ?? 'Not specified' }}
                                    </p>

                                    <p class="mb-3">
                                        <strong>Payment:</strong>
                                        {{ ucfirst($order->payment_method ?? 'COD') }}
                                    </p>

                                    @if($order->status === 'Delivered')
                                        <a href="{{ route('orders.invoice', $order->id) }}"
                                           class="btn btn-outline-primary btn-sm mt-auto">
                                            Download Invoice
                                        </a>
                                    @endif

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
