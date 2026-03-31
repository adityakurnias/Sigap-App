@extends('layouts.main')
@section('title', 'Beranda')
@section('content')
    <div class="container mt-5">
        <div class="p-5 mb-4 border-0 rounded-4 shadow text-center" style="background: linear-gradient(135deg, #ffffff 0%, #e8f5e9 100%);">
            <div class="container-fluid py-5">

                <h1 class="display-5 fw-bold text-primary mb-3">Sistem Pelaporan Infrastruktur
                    Desa (LaporDesa)</h1>
                <p class="col-md-8 mx-auto fs-5 text-muted">
                    Sampaikan laporan jalan berlubang, lampu jalan rusak, atau fasilitas
                    desa lainnya ke pihak RT/RW. Cepat, Aman, dan Transparan.
                </p>
                <div class="mt-4">
                    {{-- Tombol Utama --}}
                    <a href="{{ route('user.lapor') }}" class="btn btn-primary btn-lg px-5 gap-3 rounded-pill" style="box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.4);">
                        Lapor Kerusakan Sekarang
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
