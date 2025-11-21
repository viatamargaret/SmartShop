@extends('layouts.admin')
@section('title', 'Admin - Chatbot Messages')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Chatbot Messages</h2>

    <div class="row">
        @forelse($messages as $message)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p><strong>User:</strong> {{ $message->user_name ?? 'Guest' }}</p>
                    <p><strong>Message:</strong> {{ $message->message }}</p>
                    <p><small class="text-muted">{{ $message->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
        </div>
        @empty
            <p>No messages found.</p>
        @endforelse
    </div>
</div>
@endsection
