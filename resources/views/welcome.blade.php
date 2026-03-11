@extends('layouts.main')
@section('title', 'Beranda')
@section('content')
    <div class="container mt-5">
        <div class="p-5 mb-4 bg-white border rounded-4 shadow-sm text-center">
            <div class="container-fluid py-5">

                <h1 class="display-5 fw-bold text-primary mb-3">Sistem Informasi
                    Pengaduan (SIGAP)</h1>
                <p class="col-md-8 mx-auto fs-5 text-muted">
                    Sampaikan keluhan, saran, dan aspirasi Anda mengenai
                    infrastruktur dan layanan publik di lingkungan kita. Cepat, Aman, dan
                    Transparan.
                </p>
                <div class="mt-4">
                    {{-- Tombol Utama --}}
                    <a href="{{ route('user.lapor') }}" class="btn btn-primary btn-lg px-4 gap-3 shadow-sm rounded-pill">
                        Tulis Pengaduan Sekarang
                    </a>
                    {{-- Tampilkan tombol daftar HANYA JIKA pengunjung belum login (@guest) --}}
                    @guest

                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4 ms-2 rounded-pill">
                            Daftar Akun Baru
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
