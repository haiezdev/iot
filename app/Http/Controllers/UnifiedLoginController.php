<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UnifiedLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // sử dụng lại form cũ
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Thử đăng nhập với guard admin
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Nếu không phải admin → thử với user (operator/supervisor/teamlead)
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'operator':
                    return redirect()->intended(route('operator.dashboard'));
                case 'supervisor':
                    return redirect()->intended(route('supervisor.dashboard'));
                case 'team_lead':
                    return redirect()->intended(route('teamlead.dashboard'));
                default:
                    Auth::logout();
                    return back()->withErrors(['email' => 'Tài khoản không hợp lệ.']);
            }
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }
    public function logout(Request $request)
    {
        // Nếu đang đăng nhập với guard admin
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        // Nếu đang đăng nhập với guard web (user thường)
        if (Auth::guard('web')->check()) {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Đã đăng xuất thành công!');
    }
}

