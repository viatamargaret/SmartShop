@extends('layouts.admin')
@section('title', 'Admin - Categories')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Categories</h2>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-4">Add New Category</a>

    <div class="row">
        @forelse($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p>No categories found.</p>
        @endforelse
    </div>
</div>
@endsection
