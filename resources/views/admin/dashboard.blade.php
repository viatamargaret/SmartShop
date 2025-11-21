@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-primary">Admin Dashboard</h2>

    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Users</h6>
                <h3 class="fw-bold">{{ $userCount }}</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Products</h6>
                <h3 class="fw-bold">{{ $productCount }}</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Categories</h6>
                <h3 class="fw-bold">{{ $categoryCount }}</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm p-3 text-center h-100">
                <h6 class="text-muted">Messages</h6>
                <h3 class="fw-bold">{{ $messageCount }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
