<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    // 1. Menampilkan Form Lapor
    public function index()
    {
        return view('user.lapor');
    }
    // 2. Memproses Data & Foto (Jantung Materi Hari Ini)
    public function store(Request $request)
    {
        // A. Validasi (Cek Kelengkapan)
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);
        // B. Logika Upload Foto (Anti-Error)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan foto ke folder 'storage/app/public/reports'
            $imagePath = $request->file('image')->store('reports', 'public');
        }
        // C. Simpan ke Database
        Report::create([
            'user_id' => Auth::id(), // Otomatis ambil ID warga yang login
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $imagePath, // Simpan alamat fotonya saja
            'status' => '0', // Default Pending
        ]);
        return redirect()->back()->with('success', 'Laporan berhasil
dikirim!');
    }
}