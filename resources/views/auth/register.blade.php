@extends('layouts.app')

@section('styles')
<style>
    .register-container {
        background: linear-gradient(135deg, #4a4eec 0%, #6a63ff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .register-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 500px;
    }
    .register-box h2 {
        text-align: center;
        color: #4a4eec;
        margin-bottom: 30px;
    }
    .form-control {
        border-radius: 25px;
        padding: 10px 20px;
    }
    .btn-register {
        border-radius: 25px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #4a4eec 0%, #6a63ff 100%);
        border: none;
    }
    .btn-register:hover {
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
<div class="register-container">
    <div class="register-box">
        <h2>Đăng Ký Tài Khoản</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control @error('ho_ten') is-invalid @enderror"
                       name="ho_ten" placeholder="Họ và Tên"
                       value="{{ old('ho_ten') }}" required autofocus>
                @error('ho_ten')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" placeholder="Địa chỉ Email"
                       value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="tel" class="form-control @error('so_dien_thoai') is-invalid @enderror"
                       name="so_dien_thoai" placeholder="Số Điện Thoại"
                       value="{{ old('so_dien_thoai') }}">
                @error('so_dien_thoai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" class="form-control @error('mat_khau') is-invalid @enderror"
                       name="mat_khau" placeholder="Mật Khẩu" required>
                @error('mat_khau')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" class="form-control"
                       name="mat_khau_confirmation" placeholder="Xác Nhận Mật Khẩu" required>
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
    </div>
</div>
@endsection
