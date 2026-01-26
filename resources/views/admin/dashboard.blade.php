@extends('layouts.main')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="alert alert-success">
        <h4>Selamat Datang, {{ Auth::user()->name }}!</h4>
        <p>Anda login sebagai: <strong>{{ Auth::user()->role }}</strong></p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pengaduan</h5>
                    <p class="card-text display-4">0</p>
                </div>
            </div>
        </div>
    </div>
@endsection