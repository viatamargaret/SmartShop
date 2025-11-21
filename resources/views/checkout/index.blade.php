@extends('layouts.default')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <div class="row g-4">

            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h5 class="mb-3">Delivery Details</h5>

                    <div class="mb-3">
                        <label for="city" class="form-label">Select City</label>
                        <select name="city" id="city" class="form-select" required>
                            <option value="">-- Choose City --</option>
                            @foreach($cities as $city => $pickupPoints)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="delivery_option" class="form-label">Delivery Option</label>
                        <select name="delivery_option" id="delivery_option" class="form-select" required>
                            <option value="pickup">Pickup Point (Free)</option>
                            <option value="door">Door-to-Door</option>
                        </select>
                    </div>

                    <div class="mb-3" id="pickup_point_div" style="display:none;">
                        <label for="pickup_point" class="form-label">Select Pickup Point</label>
                        <select name="pickup_point" id="pickup_point" class="form-select">
                            <option value="">-- Choose Pickup Point --</option>
                        </select>
                    </div>

                    <div class="mb-3" id="address_div">
                        <label for="address" class="form-label">Delivery Address</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>

                    <h5 class="mb-3 mt-4">Payment Method</h5>
                    <select name="payment_method" id="payment_method" class="form-select mb-3" required>
                        <option value="">-- Select Payment --</option>
                        <option value="cod">Cash on Delivery (+KSh 100)</option>
                        <option value="mpesa">M-Pesa</option>
                        <option value="card">Card Payment</option>
                    </select>

                    <div class="mb-3" id="mpesa_div" style="display:none;">
                        <label for="phone" class="form-label">M-Pesa Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>

                    <div id="card_div" style="display:none;">
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" name="card_number" id="card_number" class="form-control">
                        </div>
                        <div class="mb-3 d-flex gap-2">
                            <input type="text" name="card_expiry" placeholder="MM/YY" class="form-control">
                            <input type="text" name="card_cvv" placeholder="CVV" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h5 class="mb-3">Order Summary</h5>

                    <ul class="list-group mb-3">
                        @php $subtotal = 0; @endphp
                        @foreach($cart as $item)
                            @php $subtotal += $item['price'] * $item['quantity']; @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item['name'] }} x {{ $item['quantity'] }}
                                <span>KSh {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <p>Subtotal: <strong>KSh {{ number_format($subtotal, 2) }}</strong></p>
                    <p id="delivery_fee_text">Delivery Fee: <strong>KSh 0</strong></p>
                    <p id="payment_fee_text">Payment Fee: <strong>KSh 0</strong></p>
                    <h5>Total: <strong id="total_amount">{{ number_format($subtotal, 2) }}</strong></h5>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Place Order</button>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
const cities = @json($cities);
const citySelect = document.getElementById('city');
const deliveryOption = document.getElementById('delivery_option');
const pickupDiv = document.getElementById('pickup_point_div');
const pickupSelect = document.getElementById('pickup_point');
const addressDiv = document.getElementById('address_div');
const paymentMethod = document.getElementById('payment_method');
const mpesaDiv = document.getElementById('mpesa_div');
const cardDiv = document.getElementById('card_div');

const deliveryFeeText = document.getElementById('delivery_fee_text');
const paymentFeeText = document.getElementById('payment_fee_text');
const totalAmountText = document.getElementById('total_amount');

let subtotal = {{ $subtotal }};

// Update Pickup Points Dropdown
function updatePickupPoints() {
    const selectedCity = citySelect.value;
    pickupSelect.innerHTML = '<option value="">-- Choose Pickup Point --</option>';
    if (cities[selectedCity]) {
        cities[selectedCity].forEach(point => {
            const opt = document.createElement('option');
            opt.value = point;
            opt.textContent = point;
            pickupSelect.appendChild(opt);
        });
    }
}

// Update Fees and Total
function updateFees() {
    let deliveryFee = 0;
    if (deliveryOption.value === 'door') {
        if (citySelect.value === 'Nairobi') deliveryFee = 200;
        else if (citySelect.value === 'Mombasa') deliveryFee = 300;
        else if (citySelect.value === 'Kisumu') deliveryFee = 250;
        else deliveryFee = 400;
        addressDiv.style.display = 'block';
        pickupDiv.style.display = 'none';
    } else {
        deliveryFee = 0;
        addressDiv.style.display = 'none';
        pickupDiv.style.display = 'block';
    }

    let paymentFee = paymentMethod.value === 'cod' ? 100 : 0;

    deliveryFeeText.innerHTML = `Delivery Fee: <strong>KSh ${deliveryFee}</strong>`;
    paymentFeeText.innerHTML = `Payment Fee: <strong>KSh ${paymentFee}</strong>`;
    totalAmountText.innerHTML = (subtotal + deliveryFee + paymentFee).toFixed(2);
}

// Event Listeners
citySelect.addEventListener('change', () => {
    updatePickupPoints();
    updateFees();
});
deliveryOption.addEventListener('change', updateFees);
paymentMethod.addEventListener('change', () => {
    mpesaDiv.style.display = paymentMethod.value === 'mpesa' ? 'block' : 'none';
    cardDiv.style.display = paymentMethod.value === 'card' ? 'block' : 'none';
    updateFees();
});
</script>
@endsection
