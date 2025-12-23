<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Report_photos;
use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLaporanController extends Controller
{
    public function index() {
        $data = [
            'content' => 'siswa.laporan.index',
            'title'   => 'Laporan',
            'sendto' => User::where('role', '!=', 'admin')->where('role', '!=', 'siswa')->get()
        ];

        return view('layouts.siswa.wrapper', $data);
    }

    public function send(Request $request) {
        $data = $request->validate([
            'target_user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $data['reporter_id'] = Auth::user()->id;
        
        $report = Reports::create($data);

        if($request->hasFile('photos')) {
            $no = 1;
            foreach ($request->file('photos') as $file) {
                $filename = date('YmdHis') . $no . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/photos/'), $filename);
                $data = [
                    'report_id' => $report->id,
                    'photo_url' => $filename
                ];
                Report_photos::create($data);
                $no++;
            }
        }
        return redirect()->back();
    }
}
