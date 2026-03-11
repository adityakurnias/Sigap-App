<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;
// [1] RUANG TAMU (LANDING PAGE)
// Dulu langsung melempar ke /login, sekarang kita arahkan ke tampilan beranda
Route::get('/', function () {
    return view('welcome');
});

// [2] JALUR TAMU (Belum Login / Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// [3] JALUR MEMBER (Sudah Login / Auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Rute Khusus Admin
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/report/export/pdf', [ReportController::class, 'exportPdf'])->name('report.export');
    Route::post('/response', [ResponseController::class, 'store'])->name('response.store');
    // Rute Khusus Warga
    Route::get('/lapor', [ReportController::class, 'index'])->name('user.lapor');
    Route::post('/lapor', [ReportController::class, 'store'])->name('user.lapor.store');

    // Rute Tampil Detail (Bisa diakses Admin untuk mengubah status)
    Route::get('/report/{report}', [ReportController::class, 'show'])->name('report.show');
    Route::put('/report/{report}', [ReportController::class, 'update'])->name('report.update');
});
