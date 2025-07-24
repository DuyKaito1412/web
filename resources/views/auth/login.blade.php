@extends('layouts.app')

@section('styles')
<style>
    .login-container {
        background: linear-gradient(135deg, #4a4eec 0%, #6a63ff 100%);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 450px;
    }
    .login-box h2 {
        text-align: center;
        color: #4a4eec;
        margin-bottom: 30px;
    }
    .form-control {
        border-radius: 25px;
        padding: 10px 20px;
    }
    .btn-login {
        border-radius: 25px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #4a4eec 0%, #6a63ff 100%);
        border: none;
    }
    .btn-login:hover {
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-box">
        <h2>{{ $title ?? 'Đăng Nhập' }}</h2>
        <form method="POST" action="{{ isset($role) && $role == 'nhanvien' ? route('login.nhanvien.submit') : route('login') }}">
            @csrf
            @if(isset($role) && $role == 'nhanvien')
                <input type="hidden" name="role" value="nhanvien">
            @endif
            <div class="mb-3">
                <input type="tel" class="form-control @error('so_dien_thoai') is-invalid @enderror"
                       name="so_dien_thoai" placeholder="Số Điện Thoại"
                       value="{{ old('so_dien_thoai') }}" required autofocus>
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

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-login text-white">Đăng Nhập</button>
            </div>

            <div class="text-center mt-3">
                <p>Chưa có tài khoản? <a href="{{ route('register') }}" class="text-primary">Đăng ký ngay</a></p>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Nếu đang ở /user hoặc /admin sau khi đăng xuất, tự động chuyển về trang chủ
if (window.location.pathname.startsWith('/user') || window.location.pathname.startsWith('/admin')) {
    window.location.href = '/';
}
</script>
@endsection
