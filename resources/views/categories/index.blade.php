@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="fw-bold mb-4 text-center">Shop by Category</h2>

            <div class="row">
                @forelse($categories as $category)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $category->name }}</h5>
                                <p class="text-muted small">{{ Str::limit($category->description, 80) }}</p>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-primary btn-sm">
                                    View Products
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No categories found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
