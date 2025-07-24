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
    }

    .hero-section {
        position: relative;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--text-light);
        min-height: calc(100vh - 70px);
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
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
        padding: 80px 0;
    }

    .feature-item {
        text-align: center;
        padding: 30px;
        background-color: white;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px rgba(50,50,93,0.1);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(50,50,93,0.15);
    }

    .feature-item i {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .feature-item:hover i {
        transform: rotate(15deg);
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

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        .hero-subtitle {
            font-size: 1rem;
        }
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
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Bảo Mật Cao</h3>
                    <p>Hệ thống được bảo vệ bằng các giải pháp mã hóa và bảo mật tiên tiến nhất</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <i class="fas fa-chart-line"></i>
                    <h3>Hiệu Quả Tối Ưu</h3>
                    <p>Giao diện thân thiện, tối ưu hóa trải nghiệm người dùng và năng suất công việc</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <i class="fas fa-cogs"></i>
                    <h3>Linh Hoạt Mở Rộng</h3>
                    <p>Dễ dàng tùy chỉnh và mở rộng theo yêu cầu riêng của từng đơn vị</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
