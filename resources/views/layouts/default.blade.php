<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SmartShop Admin')</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    @include('includes.header')

    <div class="container mt-4 mb-4">
        @yield('content')
    </div>

    @include('includes.footer')

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
