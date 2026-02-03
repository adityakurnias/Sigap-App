<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    public function index()
    {
        // LOGIKA: Ambil laporan DIMANA (Where) id pemiliknya == ID saya yang sedang login
        $myReports = Report::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.lapor', compact('myReports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $imagePath,
            'status' => '0',
        ]);
        return redirect()->back()->with('success', 'Laporan berhasil
dikirim!');
    }
}