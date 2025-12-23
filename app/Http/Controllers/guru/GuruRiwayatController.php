<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Chats;
use App\Models\Report_photos;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruRiwayatController extends Controller
{
    public function index()
    {
        $data = [
            'content' => 'guru.riwayat.index',
            'title' => 'Riwayat',
            'riwayat' => Reports::where('target_user_id', Auth::user()->id)->where('status', '!=', 'baru')->latest()->get()
        ];

        return view('layouts.guru.wrapper', $data);
    }

    public function detail($id) {
        $idDec = decrypt($id);
        $data = [
            'content' => 'guru.riwayat.detail',
            'title' => 'Riwayat',
            'riwayat' => Reports::find($idDec),
            'photo' => Report_photos::where('report_id', $idDec)->first(),
            'chats' => Chats::where('report_id', $idDec)->oldest()->get()
        ];
        return view('layouts.guru.wrapper', $data);
    }

    public function send(Request $request, $id) {
        $idDec = decrypt($id);
        $request->validate(['message' => 'required']);
        $data = [
            'report_id' => $idDec,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ];
        Chats::create($data);
        return redirect()->back();
    }

    public function selesai($id) {
        $idDec = decrypt($id);
        $where = Reports::find($idDec);
        $where->update(['status' => 'selesai']);
        return redirect()->back();
    }
}
