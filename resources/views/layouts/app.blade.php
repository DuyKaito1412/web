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
    .custom-footer {
        width: 100%;
        background: linear-gradient(90deg, #4a4eec 0%, #6a63ff 100%);
        color: #fff;
        padding: 18px 0 12px 0;
        text-align: center;
        position: relative;
        bottom: 0;
        left: 0;
        font-size: 1.08rem;
        letter-spacing: 0.5px;
        z-index: 10;
        box-shadow: 0 -2px 16px 0 rgba(76,110,245,0.08);
        margin-top: 0;
    }
    .footer-content {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        font-weight: 500;
        font-family: 'Inter', sans-serif;
        opacity: 0.93;
    }
    .footer-name {
        font-weight: 700;
        color: #ffe082;
        letter-spacing: 1px;
        font-size: 1.12rem;
        text-shadow: 0 2px 8px #4a4eec44;
    }
    .footer-dot {
        color: #ffe082;
        font-size: 1.2em;
        margin: 0 2px;
    }
    .footer-year {
        color: #e0e0e0;
        font-size: 1em;
    }
    @media (max-width: 600px) {
        .custom-footer {font-size: 0.98rem; padding: 12px 0 8px 0;}
        .footer-content {gap: 4px;}
        .footer-name {font-size: 1rem;}
    }
    </style>

    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo-vnpt.png') }}" alt="VNPT Logo">
            </a>
            <div class="ms-auto">
                {{-- Removed login/register buttons from header --}}
            </div>
        </div>
    </nav>

    @yield('content')

    @if (request()->routeIs('home'))
    <footer class="custom-footer">
        <div class="footer-content">
            <span>Thiết kế & phát triển bởi</span>
            <span class="footer-name">Phạm Đạt Thành Duy</span>
            <span class="footer-dot">•</span>
            <span class="footer-year">© {{ date('Y') }}</span>
        </div>
    </footer>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
