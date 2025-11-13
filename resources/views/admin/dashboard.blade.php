@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-primary">Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h5>Users</h5>
                <h3>{{ $userCount }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h5>Products</h5>
                <h3>{{ $productCount }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h5>Categories</h5>
                <h3>{{ $categoryCount }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm p-3">
                <h5>Messages</h5>
                <h3>{{ $messageCount }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
