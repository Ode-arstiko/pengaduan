<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $aduan_terbaru = Reports::where('target_user_id', Auth::user()->id)->latest()->limit(2)->get();

        $data = [
            'content' => 'guru.dashboard.index',
            'title' => 'Dashboard',
            'total_aduan' => Reports::where('target_user_id', Auth::user()->id)->count(),
            'aduan_aktif' => Reports::where('target_user_id', Auth::user()->id)->where('status', '!=', 'selesai')->where('status', '!=', 'ditolak')->count(),
            'aduan_selesai' => Reports::where('target_user_id', Auth::user()->id)->where('status', 'selesai')->count(),
            'aduan_ditolak' => Reports::where('target_user_id', Auth::user()->id)->where('status', 'ditolak')->count(),
            'aduan_terbaru' => $aduan_terbaru,
        ];

        return view('layouts.wrapper', $data);
    }
}
