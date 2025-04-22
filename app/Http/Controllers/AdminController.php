<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.login'); // Chúng ta sẽ tạo view sau
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Kiểm tra thông tin đăng nhập
        $credentials = $request->only('email', 'password');

        // Sử dụng guard admin để đăng nhập
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        }

        // Nếu đăng nhập thất bại
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Đăng xuất
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

