@extends('layouts.admin')
@section('title', 'Admin - Users')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Users</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-4">Add New User</a>

    <div class="d-flex justify-content-between mb-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name or email" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div>
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                <select name="sort" onchange="this.form.submit()" class="form-select">
                    <option value="">Sort by</option>
                    <option value="alphabetical" {{ request('sort') === 'alphabetical' ? 'selected' : '' }}>Alphabetical</option>
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Last Joined</option>
                </select>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse($users as $user)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">
                        <strong>Email:</strong> {{ $user->email }}<br>
                        <strong>Role:</strong> {{ $user->is_admin ? 'Admin' : 'User' }}

                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>

                    <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-success' }}"
                                onclick="return confirm('Are you sure?')">
                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this user permanently?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p>No users found.</p>
        @endforelse
    </div>
</div>
@endsection
