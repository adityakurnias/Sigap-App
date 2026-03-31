@extends('layouts.main')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="container mt-4 mb-5">
        {{-- HEADER & TOMBOL EXPORT --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <h2 class="fw-bold text-primary mb-0">Dashboard LaporDesa</h2>
                <p class="text-muted mb-0">Pusat Kendali Laporan Infrastruktur Desa</p>
            </div>
            <div>

                <a href="{{ route('report.export') }}" class="btn btn-danger btn-lg shadow-sm rounded-pill px-4">

                    Download Laporan PDF
                </a>
            </div>
        </div>
        {{-- KOTAK STATISTIK PINTAR (Otomatis Menghitung Data Database) --}}
        <div class="row mb-4">
            <div class="col-md-3 mb-3">

                <div class="card bg-primary bg-gradient text-white shadow border-0 rounded-4 pt-2">

                    <div class="card-body">

                        <h6 class="text-uppercase fw-bold mb-1">Total
                            Laporan</h6>
                        <h2 class="fw-bold">{{ $reports->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-danger bg-gradient text-white shadow border-0 rounded-4 pt-2">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold mb-1">Menunggu</h6>
                        <h2 class="fw-bold">{{ $reports->where('status', '0')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning bg-gradient text-dark shadow border-0 rounded-4 pt-2">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold mb-1">Diproses</h6>
                        <h2 class="fw-bold">{{ $reports->where('status', 'proses')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">

                <div class="card bg-success bg-gradient text-white shadow border-0 rounded-4 pt-2">

                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold mb-1">Selesai</h6>
                        <h2 class="fw-bold">{{ $reports->where('status', 'selesai')->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
        {{-- TABEL DATA MODERN --}}
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-secondary">Daftar Laporan Infrastruktur Masuk</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Tanggal Lapor</th>
                                <th>Pelapor</th>
                                <th>Judul Laporan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center pe-4">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $index => $item)
                                <tr>

                                    <td class="ps-4"><strong>{{ $index + 1 }}</strong></td>
                                    <td><small class="text-muted">{{ $item->created_at->format('d M Y, H:i') }} WIB</small>
                                    </td>
                                    <td><span class="fw-bold">{{ $item->user->name }}</span></td>
                                    <td>{{ Str::limit($item->title, 40) }}</td>

                                    <td class="text-center">
                                        @if ($item->status == '0')
                                            <span class="badge bg-danger rounded-pill px-3 py-2">Menunggu</span>
                                        @elseif($item->status == 'proses')
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Diproses</span>
                                        @else
                                            <span class="badge bg-success rounded-pill px-3 py-2">Selesai</span>
                                        @endif
                                    </td>

                                    <td class="text-center pe-4">
                                        <a href="{{ route('report.show', $item->id) }}"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold">Proses
                                            Data</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
