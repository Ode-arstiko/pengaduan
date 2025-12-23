<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'content' => 'guru.dashboard.index',
            'title' => 'Dashboard'
        ];

        return view('layouts.guru.wrapper', $data);
    }
}
