<?php
namespace App\Http\Controllers;

use App\Models\Report;
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
            'email' => ['required', 'email'],
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
            'email' => 'Email atau Password salah!',
        ]);
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