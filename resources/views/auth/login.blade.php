@extends('layouts.main')
@section('title', 'Login Aplikasi')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Silakan Masuk</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-bold">Username</label>

                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda"
                                required>

                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>

                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password"
                                required>

                        </div>

                        <button type="submit" class="btn btn-primary w-100">LOGIN</button>

                    </form>
                    <div class="text-center mt-3">
                        <small>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
