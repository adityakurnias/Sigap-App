<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - SIGAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- KONFIGURASI PWA AGAR BISA DI-INSTALL --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta name="theme-color" content="#0d6efd">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">SIGAP APLIKASI</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    {{-- LOGIKA 1: Jika yang datang adalah TAMU --}}
                    @guest
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Daftar Akun</a>
                        </li>
                    @endguest
                    {{-- LOGIKA 2: Jika yang datang adalah PENGGUNA RESMI --}}
                    @auth
                        {{-- Jika dia ADMIN, tampilkan menu Dashboard --}}
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item"><a class="nav-link text-white fw-bold"
                                    href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                            {{-- Jika dia WARGA, tampilkan menu Lapor (Admin tidak akan bisa melihat ini!) --}}
                        @elseif(Auth::user()->role == 'warga')
                            <li class="nav-item"><a class="nav-link text-white" href="{{ route('user.lapor') }}">Tulis
                                    Pengaduan</a></li>
                        @endif
                        {{-- Tombol Logout untuk Semua --}}
                        <li class="nav-item ms-2">
                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button class="btn btn-danger btn-sm mt-1 rounded-pill px-3">Logout</button>

                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">@yield('content')</div>
</body>

</html>
