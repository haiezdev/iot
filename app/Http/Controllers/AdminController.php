<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
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
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login')->with('message', 'Đăng xuất thành công!');
    }

    public function dashboard()
{
    return view('admin.dashboard');
}

public function showChangePasswordForm()
{
    return view('admin.change-password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $admin = Auth::guard('admin')->user();

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    return back()->with('message', 'Đổi mật khẩu thành công!');
}
    
}

