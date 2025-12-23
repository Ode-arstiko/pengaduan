<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    public function index() {
        $aduan_terbaru = Reports::where('reporter_id', Auth::user()->id)->latest()->limit(2)->get();

        $data = [
            'content' => 'siswa.dashboard.index',
            'title' => 'Dashboard',
            'total_aduan' => Reports::where('reporter_id', Auth::user()->id)->count(),
            'aduan_aktif' => Reports::where('reporter_id', Auth::user()->id)->where('status', '!=', 'selesai')->where('status', '!=', 'ditolak')->count(),
            'aduan_selesai' => Reports::where('reporter_id', Auth::user()->id)->where('status', 'selesai')->count(),
            'aduan_ditolak' => Reports::where('reporter_id', Auth::user()->id)->where('status', 'ditolak')->count(),
            'aduan_terbaru' => $aduan_terbaru,
        ];
        return view('layouts.siswa.wrapper', $data);
    }
}
