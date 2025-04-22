<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AdminController extends Controller
{
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
// public function showCreateUserForm() {
//     return view('admin.create-user');
// }

// public function createUser(Request $request) {
//     $request->validate([
//         'name' => 'required|string',
//         'email' => 'required|email|unique:users',
//         'password' => 'required|min:6',
//         'role' => 'required|in:operator,supervisor,team_lead',
//     ]);

//     User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//         'role' => $request->role,
//     ]);

//     return back()->with('message', 'Tạo người dùng thành công!');
// }
// Danh sách
public function listUsers() {
    $users = User::all();
    return view('users.index', compact('users'));
}

// Form tạo
public function createUserForm() {
    return view('users.create');
}

// Lưu user mới
public function storeUser(Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:operator,supervisor,team_lead',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('users.index')->with('message', 'Tạo người dùng thành công!');
}

// Form sửa
public function editUser($id) {
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}

// Cập nhật
public function updateUser(Request $request, $id) {
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|in:operator,supervisor,team_lead',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('users.index')->with('message', 'Cập nhật thành công!');
}

// Xoá
public function deleteUser($id) {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('users.index')->with('message', 'Xoá thành công!');

}
}

