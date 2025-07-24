<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu đăng ký
        $validator = Validator::make($request->all(), [
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mat_khau' => 'required|string|min:8|confirmed',
            'so_dien_thoai' => 'nullable|string',
        ]);

        // Nếu validate thất bại
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo người dùng mới
        $user = User::create([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'mat_khau' => $request->mat_khau, // Sẽ được mã hóa bởi mutator
            'so_dien_thoai' => $request->so_dien_thoai,
            'vai_tro' => 'user', // Mặc định
            'trang_thai_hoat_dong' => 1
        ]);

        // Đăng nhập sau khi đăng ký
        Auth::login($user);

        // Luôn điều hướng về panel user sau khi đăng ký
        return redirect('/user')
            ->with('success', 'Đăng ký thành công!');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm(Request $request)
    {
        $role = $request->get('role');
        $title = 'Đăng nhập';
        if ($role === 'nhanvien') {
            $title = 'Đăng nhập Nhân viên';
        }
        return view('auth.login', compact('role', 'title'));
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $role = $request->get('role');
        $credentials = $request->only('so_dien_thoai', 'mat_khau');
        if ($role === 'nhanvien') {
            $user = \App\Models\User::where('so_dien_thoai', $credentials['so_dien_thoai'])
                ->whereIn('vai_tro', ['admin', 'nhanvien_truc', 'nhanvien_ky_thuat'])
                ->first();
        } else {
            $user = \App\Models\User::where('so_dien_thoai', $credentials['so_dien_thoai'])
                ->where('vai_tro', 'user')
                ->first();
        }
        if ($user && \Illuminate\Support\Facades\Hash::check($credentials['mat_khau'], $user->mat_khau)) {
            \Illuminate\Support\Facades\Auth::login($user);
            // Redirect theo vai trò
            if ($user->vai_tro === 'admin') {
                return redirect('/admin');
            } elseif ($user->vai_tro === 'nhanvien_truc') {
                return redirect('/nhanVienTruc');
            } elseif ($user->vai_tro === 'nhanvien_ky_thuat') {
                return redirect('/nhanVienKyThuat');
            } else {
                return redirect('/user');
            }
        }
        return back()->withErrors(['so_dien_thoai' => 'Thông tin đăng nhập không đúng'])->withInput();
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        // Hủy session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Nếu là request AJAX (Filament), trả về JSON để frontend tự chuyển hướng
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['redirect' => url('/')]);
        }

        // Luôn quay về trang chủ sau khi đăng xuất
        return redirect('/')->with('success', 'Đã đăng xuất thành công!');
    }
}
