<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNPT Sơn La</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-brand img {
            max-height: 40px;
            margin-right: 10px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1rem;
            font-weight: normal;
        }
    </style>

    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo-vnpt.png') }}" alt="VNPT Sơn La Logo">
                VNPT Sơn La
            </a>
            <div class="ms-auto">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Đăng Nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Đăng Ký</a>
                @endguest
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
