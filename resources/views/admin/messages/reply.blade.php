@extends('layouts.admin')
@section('title', 'Admin - Reply Message')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Reply to Message from {{ $message->name }}</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Message:</strong> {{ $message->message }}</p>

            <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Reply</label>
                    <textarea name="reply" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Reply</button>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
