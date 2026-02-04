@extends('layouts.main')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">Data Laporan Masuk</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelapor</th>
                        <th>Judul Laporan</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->title }}</td>
                            <td>
                                @if ($report->image)
                                    <img src="{{ asset('storage/' . $report->image)
                                                }}" width="100" class="rounded">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>
                                @if ($report->status == '0')
                                    <span class="badge bg-danger">Pending</span>
                                @elseif($report->status == 'proses')
                                    <span class="badge bg-warning">Proses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('report.show', $report->id) }}" class="btn btn-info btn-sm text-white">Cek
                                    Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada laporan
                                masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection