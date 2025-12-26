<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .keterangan {
            margin-bottom: 10px;
            font-size: 12px;
        }

        .keterangan span {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
            text-align: center;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>
<body>

{{-- KETERANGAN BULAN & TAHUN --}}
<div class="keterangan">
    <div>
        Laporan Bulan :
        <span>
            {{ $bulan ? \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : 'Semua Bulan' }}
        </span>
    </div>
    <div>
        Tahun :
        <span>{{ $tahun ?? 'Semua Tahun' }}</span>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th width="5%">NO</th>
            <th width="20%">JUDUL</th>
            <th width="40%">DESKRIPSI</th>
            <th width="15%">STATUS</th>
            <th width="20%">TANGGAL</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $report->title }}</td>
                <td>{{ $report->description }}</td>
                <td align="center">{{ strtoupper($report->status) }}</td>
                <td align="center">{{ $report->created_at->format('d-m-Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" align="center">Tidak ada data</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
