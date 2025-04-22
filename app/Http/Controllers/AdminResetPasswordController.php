<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Admin;

class AdminResetPasswordController extends Controller
{
    public function showForgotForm() {
        return view('admin.forgot-password');
    }

    public function sendResetLink(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ], [
            'email.exists' => 'Email không tồn tại trong hệ thống.'
        ]);
        

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        $link = url("/admin/reset-password/{$token}?email={$request->email}");

        \Mail::raw("Click vào link sau để reset mật khẩu: $link", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset mật khẩu - AIoT Monitor');
        });

        return back()->with('message', 'Đã gửi link reset vào email!');
    }

    public function showResetForm(Request $request, $token) {
        return view('admin.reset-password', ['token' => $token, 'email' => $request->query('email')]);

    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6|confirmed',   
            'token' => 'required'
        ]);

        $reset = DB::table('password_resets')
                    ->where('email', $request->email)
                    ->where('token', $request->token)
                    ->first();

        if (!$reset) {
            return back()->withErrors(['token' => 'Token không hợp lệ!']);
        }

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }
        
        $admin->password = Hash::make($request->password);
        $admin->save();
        

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('admin.login')->with('message', 'Đã đổi mật khẩu thành công!');
    }
}
