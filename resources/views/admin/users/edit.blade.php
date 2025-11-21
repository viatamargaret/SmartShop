@extends('layouts.admin')
@section('title', 'Admin - Edit User')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit User</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (leave blank to keep current)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin"
                        {{ $user->is_admin ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_admin">Admin</label>
                </div>

                <button type="submit" class="btn btn-warning">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
