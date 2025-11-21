@extends('layouts.admin')
@section('title', 'Admin - Add User')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Add New User</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin">
                    <label class="form-check-label" for="is_admin">Admin</label>
                </div>

                <button type="submit" class="btn btn-primary">Add User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
