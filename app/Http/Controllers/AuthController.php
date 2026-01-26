<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    // 1. Tampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // 2. Proses Data Login (Si Satpam)
    public function login(Request $request)
    {
        // Validasi input dulu
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Cek ke Database (Satpam Bekerja)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Buat Session Baru (Gelang Tiket)
// Cek Role: Jika Admin ke Dashboard, Jika Warga ke Laporan
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard'); // Nanti kita buat
            }
        }
        // Jika Gagal Login
        return back()->withErrors([
            'email' => 'Email atau Password salah!',
        ]);
    }
    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}