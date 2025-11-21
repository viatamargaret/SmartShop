<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="{{ route('home') }}">
            <span>
                @auth
                    Welcome, {{ Auth::user()->name }}
                @else
                    Welcome, Guest
                @endauth
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold text-primary' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('categories.index') ? 'active fw-semibold text-primary' : '' }}"
                        href="{{ route('categories.index') }}">Categories</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active fw-semibold text-primary' : '' }}"
                        href="{{ route('products.index') }}">Products</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('orders.index') ? 'active fw-semibold text-primary' : '' }}"
                        href="{{ route('orders.index') }}">Orders</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('cart.index') ? 'active fw-semibold text-primary' : '' }}"
                        href="{{ route('cart.index') }}">
                            <i class="bi bi-cart"></i> View Cart
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('chatbot.index') ? 'active fw-semibold text-primary' : '' }}"
                        href="{{ route('chatbot.index') }}">Help</a>
                </li>

                @auth
                    <li class="nav-item mx-2">
                        <a class="btn btn-outline-danger btn-sm px-3 fw-semibold" href="{{ route('logout') }}">
                            Logout
                        </a>
                    </li>
                @else
                    <li class="nav-item mx-2">
                        <a class="btn btn-primary btn-sm px-3 fw-semibold" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
