<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminResetPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('admin.forgot-password');
    }

    public function resetToDefaultPassword(Request $request)
    {
        // Lấy admin đầu tiên (vì chỉ có 1 admin)
        $admin = Admin::first();

        if (!$admin) {
            return back()->withErrors(['admin' => 'Không tìm thấy tài khoản admin.']);
        }

        // Reset mật khẩu về mặc định
        $admin->password = Hash::make('matkhau123');
        $admin->save();

        return redirect()->route('login.form')->with('message', 'Mật khẩu đã được đặt lại thành mật khẩu mặc định.');
    }
}
