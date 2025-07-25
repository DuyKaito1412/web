@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    body {
        min-height: 100vh;
        background: linear-gradient(-45deg, #4a4eec, #6a63ff, #a18cd1, #fbc2eb);
        background-size: 400% 400%;
        animation: gradientBG 12s ease infinite;
    }
    @keyframes gradientBG {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .register-box {
        background: rgba(255,255,255,0.97);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(76, 110, 245, 0.15), 0 2px 4px rgba(0,0,0,0.04);
        padding: 48px 36px 32px 36px;
        width: 100%;
        max-width: 500px;
        animation: fadeInUp 1s cubic-bezier(.39,.575,.565,1) both;
    }
    @keyframes fadeInUp {
        0% {opacity: 0; transform: translateY(40px);}
        100% {opacity: 1; transform: translateY(0);}
    }
    .register-box h2 {
        text-align: center;
        color: #4a4eec;
        margin-bottom: 32px;
        font-weight: 800;
        letter-spacing: 1px;
    }
    .input-group {
        position: relative;
        margin-bottom: 22px;
    }
    .input-group .fa {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #6a63ff;
        font-size: 1.1rem;
        opacity: 0.8;
    }
    .form-control {
        border-radius: 30px;
        padding: 12px 20px 12px 44px;
        border: 1.5px solid #e0e0e0;
        font-size: 1rem;
        transition: border 0.2s;
        box-shadow: none;
    }
    .form-control:focus {
        border: 1.5px solid #4a4eec;
        outline: none;
        box-shadow: 0 0 0 2px #4a4eec22;
    }
    .btn-register {
        border-radius: 30px;
        padding: 12px 0;
        background: linear-gradient(135deg, #4a4eec 0%, #6a63ff 100%);
        border: none;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 4px 16px rgba(76, 110, 245, 0.13);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-register:hover {
        opacity: 0.95;
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 8px 24px rgba(76, 110, 245, 0.18);
    }
    .text-center.mt-3 {
        margin-top: 18px !important;
    }
    .creator-signature {
        text-align: center;
        font-size: 0.95rem;
        color: #888;
        opacity: 0.6;
        margin-top: 32px;
        letter-spacing: 0.5px;
        user-select: none;
    }
    @media (max-width: 600px) {
        .register-box {padding: 28px 8px 20px 8px;}
    }
</style>
@endsection

@section('content')
<div class="register-container">
    <div class="register-box">
        <h2>Đăng Ký Tài Khoản</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <span class="fa fa-user"></span>
                <input type="text" class="form-control @error('ho_ten') is-invalid @enderror"
                       name="ho_ten" placeholder="Họ và Tên"
                       value="{{ old('ho_ten') }}" required autofocus>
                @error('ho_ten')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group">
                <span class="fa fa-envelope"></span>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" placeholder="Địa chỉ Email"
                       value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group">
                <span class="fa fa-phone"></span>
                <input type="tel" class="form-control @error('so_dien_thoai') is-invalid @enderror"
                       name="so_dien_thoai" placeholder="Số Điện Thoại"
                       value="{{ old('so_dien_thoai') }}">
                @error('so_dien_thoai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group">
                <span class="fa fa-lock"></span>
                <input type="password" class="form-control @error('mat_khau') is-invalid @enderror" id="register-password"
                       name="mat_khau" placeholder="Mật Khẩu" required>
                <span class="fa fa-eye password-toggle" id="toggle-register-password" style="position:absolute; right:18px; top:50%; transform:translateY(-50%); cursor:pointer; color:#aaa;"></span>
                @error('mat_khau')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group">
                <span class="fa fa-lock"></span>
                <input type="password" class="form-control" id="register-password-confirm"
                       name="mat_khau_confirmation" placeholder="Xác Nhận Mật Khẩu" required>
                <span class="fa fa-eye password-toggle" id="toggle-register-password-confirm" style="position:absolute; right:18px; top:50%; transform:translateY(-50%); cursor:pointer; color:#aaa;"></span>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-register text-white">
                    Đăng Ký
                </button>
            </div>

            <div class="text-center mt-3">
                <p>Đã có tài khoản? <a href="{{ route('login') }}" class="text-primary">Đăng nhập ngay</a></p>
            </div>
        </form>
        <div class="creator-signature">Phạm Đạt Thành Duy</div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Hiện/ẩn mật khẩu
function setupTogglePassword(inputId, toggleId) {
    const input = document.getElementById(inputId);
    const toggle = document.getElementById(toggleId);
    toggle.addEventListener('click', function() {
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    if (!toggle.classList.contains('fa-eye')) {
        toggle.classList.add('fa-eye');
    }
}
setupTogglePassword('register-password', 'toggle-register-password');
setupTogglePassword('register-password-confirm', 'toggle-register-password-confirm');
</script>
@endsection
