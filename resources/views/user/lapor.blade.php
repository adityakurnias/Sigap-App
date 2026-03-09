@extends('layouts.main')
@section('title', 'Tulis Pengaduan')
@section('content')
    <div class="row">
        <div class="alert alert-info" role="alert">
            <marquee direction="left" scrollamount="8">
                👋 Selamat Datang, <strong>{{ Auth::user()->name }}</strong>! Silakan
                laporkan keluhan Anda dengan jujur dan sopan. Admin kami siaga 24 Jam untuk
                melayani Anda.
            </marquee>
        </div>
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

                            {{-- 1. INPUT ALAMAT (Akan terisi otomatis, tapi bisa diedit manual) --}}
                            <input type="text" name="location" id="location_text" class="form-control mb-2"
                                placeholder="Geser marker di peta, alamat akan muncul di sini..." required>
                            {{-- 2. WADAH PETA --}}
                            <div id="map" style="height: 300px; border-radius: 10px; border: 1px solid #ccc;"></div>
                            {{-- 3. KOORDINAT TERSEMBUNYI (Untuk Database) --}}
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Setting Awal Peta (Jakarta)
                                var map = L.map('map').setView([-6.200000, 106.816666], 13);
                                // Pasang Ubin Peta
                                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    maxZoom: 19,
                                    attribution: '© OpenStreetMap'
                                }).addTo(map);
                                // Buat Marker
                                var marker = L.marker([-6.200000, 106.816666], {
                                    draggable: true
                                }).addTo(map);
                                // --- FUNGSI BARU: AMBIL NAMA JALAN (REVERSE GEOCODING) ---
                                function getAddress(lat, lng) {
                                    // Pasang loading text biar user tau sistem lagi mikir
                                    document.getElementById("location_text").value = "Sedang mencari nama lokasi...";
                                    // Panggil API Nominatim (Gratis)
                                    fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Masukkan nama jalan ke Input Teks
                                            document.getElementById("location_text").value =
                                                data.display_name;
                                        })
                                        .catch(error => {

                                            document.getElementById("location_text").value =
                                                "Alamat tidak ditemukan(Isi manual saja)";
                                            console.error('Error:', error);
                                        });
                                }
                                // Event: Saat Marker Digeser
                                marker.on('dragend', function(e) {
                                    var coord = marker.getLatLng();
                                    document.getElementById("latitude").value = coord.lat;
                                    document.getElementById("longitude").value = coord.lng;
                                    // Panggil Fungsi Ambil Alamat
                                    getAddress(coord.lat, coord.lng);
                                });
                                // Event: Saat Peta Diklik
                                map.on('click', function(e) {
                                    marker.setLatLng(e.latlng);
                                    document.getElementById("latitude").value = e.latlng.lat;
                                    document.getElementById("longitude").value = e.latlng.lng;
                                    // Panggil Fungsi Ambil Alamat
                                    getAddress(e.latlng.lat, e.latlng.lng);
                                });
                            });
                        </script>

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
                                    {{-- KOLOM 1: DATA LAPORAN --}}
                                    <td>
                                        <strong>{{ $item->title }}</strong><br>
                                        <small class="text-muted">{{ $item->created_at->format('d/m/Y H:i') }}</small>
                                        {{-- Foto Laporan Warga --}}
                                        @if ($item->image)
                                            <br>
                                            <img src="{{ asset('storage/' . $item->image) }}" width="80"
                                                class="mt-2 rounded">
                                        @endif
                                    </td>
                                    {{-- KOLOM 2: STATUS & BALASAN --}}
                                    <td>
                                        {{-- Label Status --}}
                                        @if ($item->status == '0')
                                            <span class="badge bg-danger">Menunggu</span>
                                        @elseif($item->status == 'proses')
                                            <span class="badge bg-warning">Diproses</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                        {{-- Pesan Balasan Admin --}}
                                        @if ($item->responses->count() > 0)
                                            <div class="mt-2 p-2 border rounded bg-light">
                                                <small><strong>Admin:</strong>
                                                    {{ $item->responses->last()->response_text }}</small>

                                                {{-- [FIX] MENAMPILKAN FOTO BALASAN ADMIN --}}

                                                @if ($item->responses->last()->image)
                                                    <br>

                                                    <img src="{{ asset('storage/' . $item->responses->last()->image) }}"
                                                        width="100" class="mt-1 rounded border">
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
