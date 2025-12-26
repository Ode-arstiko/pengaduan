<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruCetakLaporanController extends Controller
{
    public function index()
    {
        $data = [
            'content' => 'guru.cetaklaporan.index',
            'title' => 'Cetak Laporan',
        ];

        return view('layouts.wrapper', $data);
    }
}
