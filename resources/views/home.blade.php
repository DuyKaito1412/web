@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Trang Chủ</h1>
    @guest
        <div>
            <a href="{{ route('login') }}" class="btn btn-primary">Đăng Nhập</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Đăng Ký</a>
        </div>
    @endguest

    @auth
        <p>Chào {{ auth()->user()->ho_ten }}!</p>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            Đăng Xuất
        </a>
    @endauth
</div>
@endsection
