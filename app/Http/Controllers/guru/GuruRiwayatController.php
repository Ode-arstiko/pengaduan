<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Chat_photos;
use App\Models\Chats;
use App\Models\Report_photos;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function detail($id)
    {
        $idDec = decrypt($id);
        $data = [
            'content' => 'guru.riwayat.detail',
            'title' => 'Riwayat',
            'riwayat' => Reports::find($idDec),
            'photo' => Report_photos::where('report_id', $idDec)->first(),
            'chats' => Chats::where('report_id', $idDec)
                ->with(['sender', 'photos'])
                ->oldest()
                ->get()
        ];
        return view('layouts.guru.wrapper', $data);
    }

    public function send(Request $request, $id)
    {
        $idDec = decrypt($id);

        $request->validate([
            'message' => 'required',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp'
        ]);

        $chat = Chats::create([
            'report_id' => $idDec,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        if (!$chat) {
            return back()->with('error', 'Chat gagal disimpan');
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $fileName = time() . '_' . Str::random(10) . '.' . $photo->extension();
                $photo->move(public_path('assets/chat_photos'), $fileName);

                Chat_photos::create([
                    'chat_id' => $chat->id,
                    'photo_url' => $fileName
                ]);
            }
        }

        return redirect()->back();
    }

    public function selesai($id)
    {
        $idDec = decrypt($id);
        $where = Reports::find($idDec);
        $where->update(['status' => 'selesai']);
        return redirect()->back();
    }
}
