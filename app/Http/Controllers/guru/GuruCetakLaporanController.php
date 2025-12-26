<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GuruCetakLaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $reports = Reports::whereIn('status', ['selesai', 'ditolak'])
            ->when($bulan, function ($q) use ($bulan) {
                $q->whereMonth('created_at', $bulan);
            })
            ->when($tahun, function ($q) use ($tahun) {
                $q->whereYear('created_at', $tahun);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layouts.wrapper', [
            'content' => 'guru.cetaklaporan.index',
            'title'   => 'Cetak Laporan',
            'reports' => $reports,
            'bulan'   => $bulan,
            'tahun'   => $tahun,
        ]);
    }

    public function cetakPdf(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $reports = Reports::whereIn('status', ['selesai', 'ditolak'])
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('guru.cetaklaporan.pdf', [
            'reports' => $reports,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
