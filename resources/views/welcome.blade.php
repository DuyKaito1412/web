@extends('layouts.app')

@section('styles')
            <style>
    :root {
        --primary-color: #4a4eec;
        --secondary-color: #6a63ff;
        --text-light: #ffffff;
        --text-dark: #333333;
    }

    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        min-height: 100vh;
        /* Xoá nền gradient động ở đây */
        background: #f4f6f9;
    }
    /* Áp dụng nền gradient động cho hero-section */
    .hero-section {
        position: relative;
        background: linear-gradient(-45deg, var(--primary-color), var(--secondary-color), #a18cd1, #fbc2eb);
        background-size: 400% 400%;
        animation: gradientBG 12s ease infinite;
        color: var(--text-light);
        min-height: calc(100vh - 70px);
        display: flex;
        align-items: center;
        overflow: hidden;
        z-index: 1;
    }
    @keyframes gradientBG {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: inherit;
        filter: blur(16px) brightness(0.8);
        z-index: 0;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
        animation: fadeInDown 1.2s cubic-bezier(.39,.575,.565,1) both;
    }
    @keyframes fadeInDown {
        0% {opacity: 0; transform: translateY(-40px);}
        100% {opacity: 1; transform: translateY(0);}
    }
    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 20px;
        background: linear-gradient(to right, #ffffff, #e0e0e0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .hero-subtitle {
        font-size: 1.3rem;
        color: rgba(255,255,255,0.85);
        max-width: 700px;
        margin: 0 auto 40px;
        line-height: 1.6;
    }
    .auth-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
    }
    .auth-buttons .btn {
        padding: 12px 35px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .btn-light {
        background-color: white;
        color: var(--primary-color);
    }
    .btn-light:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.3);
    }
    .btn-outline-light {
        border: 2px solid white;
        color: white;
    }
    .btn-outline-light:hover {
        background-color: white;
        color: var(--primary-color);
        transform: translateY(-5px);
    }
    .feature-section {
        background-color: #f4f6f9;
        padding: 80px 0 100px 0;
    }
    .feature-item {
        text-align: center;
        padding: 30px;
        background-color: white;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(50,50,93,0.1);
        transition: all 0.3s ease;
        animation: fadeInUp 1.1s cubic-bezier(.39,.575,.565,1) both;
    }
    .feature-item:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 20px 40px rgba(50,50,93,0.15);
    }
    .feature-item i {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }
    .feature-item:hover i {
        transform: rotate(15deg) scale(1.1);
    }
    .feature-item h3 {
        margin-bottom: 15px;
        color: var(--text-dark);
        font-weight: 700;
    }
    .feature-item p {
        color: #6c757d;
        line-height: 1.6;
    }
    .creator-signature {
        text-align: center;
        font-size: 1rem;
        color: #888;
        opacity: 0.6;
        margin-top: 32px;
        letter-spacing: 0.5px;
        user-select: none;
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
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        .hero-subtitle {
            font-size: 1rem;
        }
    }
    .feature-link {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: box-shadow 0.3s, transform 0.3s, background 0.3s;
    }
    .feature-link:hover, .feature-link:focus {
        background: linear-gradient(135deg, #4a4eec22 0%, #6a63ff22 100%);
        box-shadow: 0 24px 48px rgba(76,110,245,0.18);
        transform: translateY(-12px) scale(1.04);
        color: #4a4eec;
        outline: none;
    }
            </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Hệ Thống Báo Lỗi VNPT Sơn La</h1>
        <p class="hero-subtitle">Giải pháp quản lý và theo dõi sự cố kỹ thuật chuyên nghiệp, mang đến trải nghiệm nhanh chóng và hiệu quả</p>

        @guest
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn btn-light">Đăng Nhập</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light">Đăng Ký</a>
            <a href="{{ route('login', ['role' => 'nhanvien']) }}" class="btn btn-outline-light">Đăng nhập Nhân viên</a>
        </div>
        @endguest
    </div>
</div>

<div class="feature-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="https://digishop.vnpt.vn" target="_blank" rel="noopener" class="feature-item feature-link">
                    <i class="fas fa-wifi"></i>
                    <h3>FiberVNN</h3>
                    <p>Dịch vụ Internet cáp quang tốc độ cao, ổn định, đáp ứng mọi nhu cầu học tập, làm việc và giải trí.</p>
                </a>
            </div>
            <div class="col-md-4">
                <a href="https://digishop.vnpt.vn" target="_blank" rel="noopener" class="feature-item feature-link">
                    <i class="fas fa-tv"></i>
                    <h3>MyTV</h3>
                    <p>Truyền hình tương tác với hàng trăm kênh đặc sắc, kho phim khổng lồ và nhiều tiện ích giải trí hấp dẫn.</p>
                </a>
            </div>
            <div class="col-md-4">
                <a href="https://digishop.vnpt.vn" target="_blank" rel="noopener" class="feature-item feature-link">
                    <i class="fas fa-network-wired"></i>
                    <h3>Dịch vụ khác của VNPT</h3>
                    <p>Hỗ trợ đa dạng các dịch vụ: điện thoại cố định, di động, giải pháp công nghệ thông tin cho doanh nghiệp và cá nhân.</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
