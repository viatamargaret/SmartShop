@extends('layouts.default')

@section('title', 'SmartShop Assistant')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold text-primary">💬 SmartShop Assistant</h2>

    {{-- Information section --}}
    <div class="alert alert-info shadow-sm mb-4">
        <h5 class="fw-bold"><i class="bi bi-info-circle"></i> What I Can Do 🤖</h5>
        <ul class="mb-0">
            <li>Answer questions about <strong>orders</strong>, <strong>deliveries</strong>, <strong>returns</strong>, and <strong>payments</strong>.</li>
            <li>Provide <strong>contact information</strong> and <strong>shop hours</strong>.</li>
            <li>Guide you to <strong>Products</strong> and <strong>Categories</strong> pages.</li>
            <li>Chat with you about <strong>SmartShop offers</strong> and <strong>discounts</strong>.</li>
        </ul>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Chat with SmartShop</h5>
            <a href="{{ route('chatbot.clear') }}" class="btn btn-outline-danger btn-sm">Clear Chats</a>
        </div>

        <div class="card-body" style="max-height: 500px; overflow-y: auto;" id="chat-messages">
            @forelse ($messages as $msg)
                @if ($msg->sender === 'user')
                    <div class="d-flex justify-content-end mb-3">
                        <div class="bg-primary text-white rounded p-3" style="max-width: 75%;">
                            <strong>You:</strong> {{ $msg->message }}
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-start mb-3">
                        <div class="bg-light border rounded p-3" style="max-width: 75%;">
                            <strong>Bot:</strong> {!! $msg->message !!}
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-muted text-center mt-3">No chats yet. Start a conversation below 👇</p>
            @endforelse
        </div>

        {{-- Chat input form --}}
        <form action="{{ route('chatbot.send') }}" method="POST" class="p-3 border-top bg-light">
            @csrf
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                <select name="language" class="form-select" style="max-width: 150px;">
                    <option value="English" selected>English</option>
                    <option value="Swahili">Swahili</option>
                </select>
                <button class="btn btn-primary px-4" type="submit">Send</button>
            </div>
        </form>
    </div>
</div>

{{-- Optional: Auto-scroll to the bottom on page load --}}
<script>
    const chatContainer = document.getElementById('chat-messages');
    chatContainer.scrollTop = chatContainer.scrollHeight;
</script>
@endsection
