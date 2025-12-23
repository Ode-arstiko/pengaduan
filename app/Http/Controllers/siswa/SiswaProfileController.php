<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaProfileController extends Controller
{
    public function index()
    {
        $data = [
            'content' => 'siswa.profile.index',
            'title' => 'Profil Saya',
            'user' => User::find(Auth::user()->id)
        ];
        return view('layouts.siswa.wrapper', $data);
    }

    public function update(Request $request, $id)
    {
        $idDec = decrypt($id);
        $where = User::find($idDec);
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20'
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'min:8'
            ]);
            $data['password'] = $request->password;
        }

        if ($request->hasFile('profile')) {
            if ($where->profile) {
                $gambarLama = public_path('assets/profil/' . $where->profile);
                unlink($gambarLama);
            }
            $file = $request->file('profile');
            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/profil/'), $filename);
            $data['profile'] = $filename;
        }

        $where->update($data);
        return redirect()->back()->with('updateSuccess', 'Profil diperbarui!');
    }
}
