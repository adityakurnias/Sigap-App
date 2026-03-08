@extends('layouts.main')
@section('title', 'Tulis Pengaduan')
@section('content')
    <div class="row">
        {{-- KOLOM KIRI: FORM LAPOR --}}
        <div class="col-md-5">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Tulis Laporan Baru</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.lapor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">

                            <label>Judul Laporan</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Jalan Berlubang"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Isi Keluhan</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Lokasi Kejadian</label>
                            <input type="text" name="location" class="form-control" placeholder="Contoh: Depan Pasar">
                        </div>
                        <div class="mb-3">
                            <label>Bukti Foto</label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">Format:
                                JPG/PNG, Maks 2MB</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">KIRIM LAPORAN</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- KOLOM KANAN: TABEL RIWAYAT --}}
        <div class="col-md-7">
            <div class="card shadow">

                <div class="card-header bg-success text-white">Riwayat Laporan Saya</div>

                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Judul</th>

                                <th>Status & Balasan</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($reports as $item)
                                <tr>

                                    <td>{{ $item->created_at->format('d/m/y') }}</td>
                                    <td>
                                        <strong>{{ $item->title }}</strong><br>
                                        <small class="text-muted">{{ Str::limit($item->description, 30) }}</small>
                                    </td>
                                    <td>

                                        {{-- STATUS --}}
                                        @if ($item->status == '0')
                                            <span class="badge bg-danger">Menunggu</span>
                                        @elseif($item->status == 'proses')
                                            <span class="badge bg-warning">Diproses</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                        {{-- PESAN BALASAN ADMIN --}}
                                        @if ($item->responses->count() > 0)
                                            <div class="mt-2 p-1 border rounded bg-light">
                                                <small><strong>Admin:</strong>{{ $item->responses->last()->response_text }}</small>
                                                @if ($item->responses->last()->image)
                                                    <img src="{{ asset('storage/' . $item->responses->last()->image) }}" alt="Bukti" class="img-fluid mt-2">
                                                @endif
                                            </div>
                                        @endif
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
