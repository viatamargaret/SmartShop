<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SmartShop')</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @yield('style')
</head>
<body class="bg-light">

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="{{ route('admin.dashboard') }}">
                <span>
                    @auth
                        Welcome, {{ Auth::user()->name }}
                    @else
                        Welcome, Guest
                    @endauth
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="adminNavbar">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('admin.users.index') }}">
                            Users
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('admin.categories.index') }}">
                            Categories
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('admin.products.index') }}">
                            Products
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->routeIs('admin.messages') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('admin.messages') }}">
                            Messages
                        </a>
                    </li>

                    @auth
                        <li class="nav-item mx-2">
                            <a class="btn btn-outline-danger btn-sm px-3 fw-semibold" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item mx-2">
                            <a class="btn btn-primary btn-sm px-3 fw-semibold" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    @include('includes.footer')

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
