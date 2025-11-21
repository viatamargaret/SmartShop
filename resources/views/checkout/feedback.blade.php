@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">We’d love your feedback</h2>
    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Rating (1–5)</label>
            <input type="number" name="rating" min="1" max="5" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Comment</label>
            <textarea name="comment" rows="4" class="form-control" placeholder="Share your thoughts..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Feedback</button>
    </form>
</div>
@endsection
