@extends("layouts.auth")

@section("style")
<style>
    html, body {
        height: 100%;
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
    }

    .form-signin {
        max-width: 420px;
        padding: 2rem;
        margin-top: 3rem;
    }

    .auth-card {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        background: #ffffff;
        padding: 2rem;
    }

    .auth-logo {
        display: block;
        margin: 0 auto 1rem;
        width: 70px;
        height: auto;
    }

    .form-floating label {
        color: #6c757d;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.02);
    }

    .text-center a {
        color: #007bff;
        text-decoration: none;
    }

    .text-center a:hover {
        text-decoration: underline;
    }

    footer {
        text-align: center;
        margin-top: 2rem;
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>
@endsection

@section("content")
<main class="form-signin w-100 m-auto d-flex justify-content-center align-items-center">
    <div class="auth-card">
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <img class="auth-logo" src="{{ asset('assets/img/smartshop.logo.svg')}}" alt="SmartShop Logo">
            <h1 class="h4 mb-3 fw-bold text-center">Create Your Account</h1>
            <p class="text-muted text-center mb-4">Join SmartShop and start shopping smarter!</p>

            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="name@example.com">
                <label for="floatingEmail">Email address</label>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input name="name" type="text" class="form-control" id="floatingName" placeholder="Enter name">
                <label for="floatingName">Full Name</label>
                @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-4">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">
                Sign Up
            </button>

            <div class="text-center">
                <p class="mb-1">Already have an account?</p>
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>

        <footer>&copy; 2025 SmartShop</footer>
    </div>
</main>
@endsection
