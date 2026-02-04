@extends('layouts.main')
@section('title', 'Detail Laporan')
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-white bg-primary">Detail Pengaduan</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Pelapor</th>
                            <td>: {{ $report->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>: {{ $report->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($report->status == '0')
                                    <span class="badge bg-danger">Pending</span>
                                @elseif($report->status == 'proses')
                                    <span class="badge bg-warning">Proses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Isi Laporan</th>
                            <td>: {{ $report->description }}</td>
                        </tr>
                    </table>
                    @if($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid rounded mt-3">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-info text-white">Verifikasi & Tanggapan</div>
                <div class="card-body">
                    <form action="{{ route('report.update', $report->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="fw-bold">Ubah Status:</label>
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="0" {{ $report->status == '0' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <small class="text-muted">*Pilih status untuk mengubah otomatis</small>
                        </div>
                    </form>
                    <hr>
                    <form action="{{ route('response.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <div class="mb-3">
                            <label class="fw-bold">Berikan Tanggapan:</label>
                            <textarea name="response_text" class="form-control" rows="4"
                                placeholder="Ketik balasan untuk warga..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">KIRIM
                            TANGGAPAN</button>
                    </form>
                    <div class="mt-4">
                        <h6 class="fw-bold">Riwayat Percakapan:</h6>
                        @if($report->responses->count() > 0)
                            @foreach($report->responses as $response)
                                <div class="alert alert-secondary p-2 mb-2">
                                    <small class="fw-bold text-dark">{{ $response->user->name }} (Admin)</small>
                                    <small class="text-muted float-end">{{ $response->created_at->diffForHumans() }}</small>
                                    <p class="mb-0 mt-1 text-dark small">{{ $response->response_text }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted small">Belum ada tanggapan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection