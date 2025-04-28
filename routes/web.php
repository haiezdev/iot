<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminResetPasswordController;
use App\Http\Controllers\UnifiedLoginController;
use App\Http\Controllers\DeviceGroupController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CommandListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssignProfileController;
/*
|--------------------------------------------------------------------------
| Default route
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login.form'));

/*
|--------------------------------------------------------------------------
| Login & Logout chung (Admin + User)
|--------------------------------------------------------------------------
*/

Route::get('/login', [UnifiedLoginController::class, 'showLoginForm'])->name('login.form'); // hiển thị form login
Route::post('/login', [UnifiedLoginController::class, 'login'])->name('login');             // xử lý đăng nhập
Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('logout');          // logout chung

/*
|--------------------------------------------------------------------------
| DASHBOARD CHO USER (auth:web)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/operator/dashboard', fn() => view('users.operator.dashboard'))->name('operator.dashboard');
    Route::get('/supervisor/dashboard', fn() => view('users.supervisor.dashboard'))->name('supervisor.dashboard');
    Route::get('/teamlead/dashboard', fn() => view('users.teamlead.dashboard'))->name('teamlead.dashboard');

    // (Tuỳ chọn) route users.index nếu là danh sách người dùng chung
    Route::get('/users', [AdminController::class, 'index'])->name('users.index'); 
});

Route::middleware(['auth', 'teamlead'])->group(function () {
    Route::resource('device-groups', DeviceGroupController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('command-lists', CommandListController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('assign-profile', AssignProfileController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('assign-profile', AssignProfileController::class)->only([
        'index', 'create', 'store', 'destroy'
    ]);
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (auth:admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // Đăng xuất admin (nếu dùng riêng guard)
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // RESET PASSWORD ADMIN
    Route::get('forgot-password', [AdminResetPasswordController::class, 'showForgotForm'])->name('admin.forgot-password');
    Route::post('forgot-password', [AdminResetPasswordController::class, 'sendResetLink'])->name('admin.send-reset-link');
    Route::get('reset-password/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.reset-password.form');
    // Route::post('reset-password', [AdminResetPasswordController::class, 'resetPassword'])->name('admin.reset-password');
    Route::post('/admin/reset-password', [AdminResetPasswordController::class, 'resetToDefaultPassword'])->name('admin.reset-password');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.password.form');
        Route::post('change-password', [AdminController::class, 'updatePassword'])->name('admin.password.update');

        // CRUD người dùng
        Route::get('/users', [AdminController::class, 'listUsers'])->name('admin.users.index');
        Route::get('/users/create', [AdminController::class, 'createUserForm'])->name('admin.users.create-form');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });
    
});
