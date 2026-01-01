<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 25px;
            color: #000;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            font-size: 11px;
            margin: 4px 0 0;
        }

        .divider {
            border-bottom: 2px solid #000;
            margin: 10px 0 15px;
        }

        /* ===== INFO ===== */
        .info {
            margin-bottom: 12px;
            font-size: 12px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 2px 0;
        }

        /* ===== TABLE ===== */
        table.data {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* PENTING */
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
            font-size: 11px;

            /* ===== PAKSA TEXT WRAP ===== */
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }

        table.data th {
            background: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        table.data tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* ===== ALIGN ===== */
        .text-center {
            text-align: center;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: -12px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
        }

        .page-number:before {
            content: counter(page);
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <h1>Laporan Data</h1>
        <p>Rekapitulasi Laporan</p>
    </div>

    <div class="divider"></div>

    {{-- INFO --}}
    <div class="info">
        <table>
            <tr>
                <td width="15%">Bulan</td>
                <td width="2%">:</td>
                <td width="83%">
                    <strong>
                        {{ $bulan ? \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : 'Semua Bulan' }}
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td>
                    <strong>{{ $tahun ?? 'Semua Tahun' }}</strong>
                </td>
            </tr>
        </table>
    </div>

    {{-- TABLE --}}
    <table class="data">
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
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $report->title }}</td>
                    <td>{{ $report->description }}</td>
                    <td class="text-center">{{ strtoupper($report->status) }}</td>
                    <td class="text-center">{{ $report->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        Halaman <span class="page-number"></span>
    </div>

</body>
</html>