@extends('layouts.main')
@section('title', 'Daftar Akun Warga')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Registrasi Warga Baru</h5>

                </div>
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">

                            <label class="form-label">NIK</label>
                            <input type="number" name="nik" class="form-control" placeholder="Masukkan NIK" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Sesuai KTP"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>

                            <input type="text" name="username" class="form-control" placeholder="Buat Username Unik"
                                required>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>

                            <input type="password" name="password" class="form-control" placeholder="Minimal 6 Karakter"
                                required>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>

                            <input type="number" name="telp" class="form-control" placeholder="08..." required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">DAFTAR SEKARANG</button>

                        <div class="text-center mt-3">

                            <small>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></small>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
