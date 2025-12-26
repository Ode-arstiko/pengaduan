<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Chats;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruLaporanController extends Controller
{
    public function index()
    {
        $data = [
            'content' => 'guru.laporan.index',
            'title' => 'Laporan',
            'reports' => Reports::where('target_user_id', Auth::user()->id)->where('status', 'baru')->latest()->get()
        ];

        return view('layouts.wrapper', $data);
    }

    public function send(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'message' => 'required',
        ]);
        $data = [
            'message' => $request->message,
            'report_id' => $request->report_id,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id
        ];

        $whereReport = Reports::find($data['report_id']);
        $whereReport->update(['status' => $request->status]);
        Chats::create($data);

        return redirect()->back();
    }
}
