<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Kiểm tra nếu chưa đăng nhập thì hiển thị trang chào mừng
    if (!Auth::check()) {
        return view('welcome');
    }

    // Nếu đã đăng nhập, điều hướng theo vai trò
    $user = Auth::user();
    if ($user->vai_tro === 'user') {
        return redirect('/user');
    } elseif ($user->vai_tro === 'admin') {
        return redirect('/admin');
    }

    // Mặc định về trang chủ
    return view('welcome');
})->name('home');

// Các route đăng nhập, đăng ký
Route::middleware(['web', 'guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route đăng nhập nhân viên (dùng chung controller, phân biệt qua param role)
Route::get('/login/nhanvien', [AuthController::class, 'showLoginForm'])->name('login.nhanvien');
Route::post('/login/nhanvien', [AuthController::class, 'login'])->name('login.nhanvien.submit');

// Route đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('web');

// Admin routes
Route::middleware(['auth', 'admin.access'])->group(function () {
    // Các route dành riêng cho admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Panel nhân viên trực
Route::get('/nhanvien-truc/dashboard', function () {
    if (!Auth::check() || Auth::user()->vai_tro !== 'nhanvien_truc') {
        return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
    }
    return view('nhanvien_truc.dashboard');
})->name('nhanvien_truc.dashboard');

// Panel nhân viên kỹ thuật
Route::get('/nhanvien-ky-thuat/dashboard', function () {
    if (!Auth::check() || Auth::user()->vai_tro !== 'nhanvien_ky_thuat') {
        return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
    }
    return view('nhanvien_ky_thuat.dashboard');
})->name('nhanvien_ky_thuat.dashboard');
