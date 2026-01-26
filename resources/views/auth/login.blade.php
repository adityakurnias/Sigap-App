@extends('layouts.main')
@section('title', 'Login Pengguna')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Silakan Masuk</div>
                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection