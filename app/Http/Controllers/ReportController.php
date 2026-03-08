<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    public function index()
    {
        // Query: "Tampilkan laporan milik SAYA saja"
        // Logika: WHERE user_id = ID Saya yang sedang login
        $reports = Report::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')

            ->get();

        return view('user.lapor', compact('reports'));
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

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Report $report)
    {
        $report->load(['user', 'responses.user']);
        return view('admin.detail', compact('report'));
    }
    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'status' => 'required|in:0,proses,selesai',
        ]);

        $report->update($data);
        return back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}
