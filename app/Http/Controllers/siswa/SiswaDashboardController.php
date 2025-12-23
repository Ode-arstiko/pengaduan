<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function index() {
        $data = [
            'content' => 'siswa.dashboard.index',
            'title' => 'Dashboard'
        ];
        return view('layouts.siswa.wrapper', $data);
    }
}
