@extends('layouts.admin')
@section('title', 'Admin - Edit Category')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Category</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

                <button type="submit" class="btn btn-warning">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
