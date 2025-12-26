<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruNotifikasiController extends Controller
{
    public function index() {
        $data = [
            'content' => 'guru.notifikasi.index',
            'title' => 'Notifikasi',
            'notifications_guru' => Notifications::where('user_id', Auth::user()->id)->latest()->paginate(10)
        ];

        return view('layouts.wrapper', $data);
    }
}
