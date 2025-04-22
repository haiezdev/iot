<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminResetPasswordController;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// TẮT Auth::routes() nếu bạn không dùng login cho người dùng thường
// Auth::routes();

// Route::get('/test-mail', function () {
//     Mail::raw("Test mail thành công rồi nè!", function ($message) {
//         $message->to('test@example.com')
//                 ->subject('Test gửi mail qua Mailtrap');
//     });

//     return 'Đã gửi mail! Mở Mailtrap kiểm tra nhé.';
// });

// ADMIN LOGIN / LOGOUT ROUTES
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // RESET PASSWORD
    Route::get('forgot-password', [AdminResetPasswordController::class, 'showForgotForm'])->name('admin.forgot-password');
    Route::post('forgot-password', [AdminResetPasswordController::class, 'sendResetLink'])->name('admin.send-reset-link');
    Route::get('reset-password/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.reset-password.form');
    Route::post('reset-password', [AdminResetPasswordController::class, 'resetPassword'])->name('admin.reset-password');

    // CÁC ROUTE CHỈ DÀNH CHO ADMIN ĐÃ ĐĂNG NHẬP
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('admin/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.password.form');
        Route::post('admin/change-password', [AdminController::class, 'updatePassword'])->name('admin.password.update');

    });
});
