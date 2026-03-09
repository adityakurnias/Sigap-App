<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/warga/dashboard', function () {
        return "Halo Warga! Ini halaman kamu.";
    })->name('user.dashboard');

    // Rute untuk Warga
    Route::get('/lapor', [ReportController::class, 'index'])->name('user.lapor');
    Route::post('/lapor', [ReportController::class, 'store'])->name('user.lapor.store');

    Route::get('/report/{report}', [ReportController::class, 'show'])->name('report.show');
    Route::put('/report/{report}', [ReportController::class, 'update'])->name('report.update');

    Route::post('/response', [ResponseController::class, 'store'])->name('response.store');

    Route::get('/report/export/pdf', [
        ReportController::class,
        'exportPdf'
    ])->name('report.export');

});
