@extends('layouts.main')
@section('title', 'Tulis Pengaduan')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header bg-primary text-white">Tulis Laporan
                    Baru</div>
                <div class="card-body">
                    <form action="{{ route('user.lapor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Judul Laporan</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Jalan Berlubang"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Isi Keluhan</label>
                            <textarea name="description" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Lokasi Kejadian</label>
                            <input type="text" name="location" class="form-control" placeholder="Contoh: Depan Pasar Cibinong">
                        </div>
                        <div class="mb-3">
                            <label>Bukti Foto</label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">Format: JPG/PNG, Maks
                                2MB</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">KIRIM
                            LAPORAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection