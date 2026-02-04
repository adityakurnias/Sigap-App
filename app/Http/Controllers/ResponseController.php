<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'report_id' => 'required|exists:reports,id',
            'response_text' => 'required',
        ]);
        // 2. Simpan ke Tabel Responses
        Response::create([
            'report_id' => $request->report_id,
            'user_id' => Auth::id(),
            'response_text' => $request->response_text,
        ]);
        return back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}
