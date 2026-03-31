<!DOCTYPE html>
<html>

<head>
    <title>Laporan Infrastruktur LaporDesa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background-color: #e0e0e0;
            text-align: center;
        }

        .foto-bukti {
            width: 90px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <h2 style="margin: 0;">SISTEM PELAPORAN INFRASTRUKTUR DESA (LAPORDESA)</h2>
        <p style="margin: 5px 0 0 0;">Dokumen Resmi Rekapitulasi Laporan Infrastruktur Warga</p>
        <small>Dicetak pada: {{ date('d F Y, H:i') }}</small>
    </div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Pelapor & Tanggal</th>

                <th width="35%">Detail Keluhan & Foto Warga</th>
                <th width="30%">Tindak Lanjut Admin & Foto</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->user->name }}</strong><br>
                        <small>{{ $item->created_at->format('d/m/Y H:i') }}</small>
                    </td>
                    <td>
                        <strong>{{ $item->title }}</strong><br>

                        {{ $item->description }}<br>
                        {{-- [PENTING] DomPDF wajib menggunakan public_path() agar bisa mencetak gambar asli --}}
                        @if ($item->image)
                            <img src="{{ public_path('storage/' . $item->image) }}" class="foto-bukti">
                        @endif
                    </td>
                    <td>
                        {{-- [LOGIKA TIMELINE PDF] Menampilkan balasan terakhir beserta fotonya --}}
                        @if ($item->responses->count() > 0)
                            <small><b>Update:</b>
                                {{ $item->responses->last()->created_at->format('d/m/Y') }}</small><br>
                            {{ $item->responses->last()->response_text }}<br>
                            @if ($item->responses->last()->image)
                                <img src="{{ public_path('storage/' . $item->responses->last()->image) }}"
                                    class="foto-bukti">
                            @endif
                        @else
                            <small style="color: red;">Belum ditindaklanjuti</small>
                        @endif
                    </td>
                    <td style="text-align: center; font-weight: bold;">
                        {{ strtoupper($item->status == '0' ? 'Pending' : $item->status) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
