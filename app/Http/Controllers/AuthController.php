<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.lapor');
            }
        }
        return back()->withErrors([
            'username' => 'Username atau Password salah!',
        ]);
    }

    // 1. Menampilkan Form Daftar
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    // 2. Proses Simpan Warga Baru
    public function register(Request $request)
    {

        // VALIDASI: Pastikan NIK & Username belum pernah dipakai
        $data = $request->validate([
            'nik' => 'required|numeric|unique:users',
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'telp' => 'required|numeric',
        ]);
        // CREATE: Simpan ke Database
        User::create([
            'nik' => $data['nik'],
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => $data['password'], // Di-hash otomatis oleh model User
            'telp' => $data['telp'],
            'role' => 'masyarakat', // Default role otomatis Masyarakat
        ]);
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function dashboard()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('reports'));
    }
}
