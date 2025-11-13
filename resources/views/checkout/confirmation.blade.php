@extends('layouts.default')

@section('title', 'Order Confirmation')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4 p-4 text-center">
                <div class="card-body">
                    <h2 class="fw-bold text-success mb-3">🎉 Order Confirmed!</h2>
                    <p class="text-muted mb-4">
                        Thank you for shopping with <strong>SmartShop</strong>!  
                        Your order has been successfully placed and is now being processed.
                    </p>

                    <div class="border rounded-4 p-4 text-start bg-light">
                        <h5 class="fw-semibold mb-3 text-center">🧾 Order Details</h5>

                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Total Amount:</strong> KSh {{ number_format($order->total_amount, 2) }}</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
                        </p>
                        <p><strong>Delivery Address:</strong> {{ $order->address }}</p>

                        <hr>

                        <h5 class="fw-semibold mb-3 text-center">📦 Items Ordered</h5>
                        <ul class="list-group">
                            @foreach ($order->items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $item->product->name }}</strong><br>
                                        <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                    </div>
                                    <span>KSh {{ number_format($item->price * $item->quantity, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-5 text-center">
                        <a href="{{ route('products.index') }}" class="btn btn-primary px-4">🛍 Continue Shopping</a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary px-4">📜 View Orders</a>
                    </div>

                    <div class="mt-5 border-top pt-4">
                        <h5 class="fw-semibold mb-3">⭐ Give Feedback</h5>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('checkout.feedback', $order->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (1-5)</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="">-- Select Rating --</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment (optional)</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
