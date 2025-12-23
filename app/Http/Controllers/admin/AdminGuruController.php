<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminGuruController extends Controller
{
    public function index() {
        $data = [
            'content' => 'admin.guru.index',
            'title' => 'Guru',
            'guru' => User::where('role', '!=', 'siswa')->where('role', '!=', 'admin')->latest()->get()
        ];
        return view('layouts.admin.wrapper', $data);
    }

    public function create() {
        $data = [
            'content' => 'admin.guru.create',
            'title' => 'Guru'
        ];
        return view('layouts.admin.wrapper', $data);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8',
            'nama' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required'
        ]);
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/profil/'), $filename);
            $data['profile'] = $filename;
        }
        User::create($data);
        return redirect('/admin/kelola-guru')->with('storeSuccess', 'Berhasil menambahkan data Guru!');
    }

    public function edit($id) {
        $idDec = decrypt($id);
        $data = [
            'content' => 'admin.guru.edit',
            'title' => 'Guru',
            'guru' => User::find($idDec)
        ];
        return view('layouts.admin.wrapper', $data);
    }

    public function update(Request $request, $id) {
        $idDec = decrypt($id);
        $where = User::find($idDec);
        $data = $request->validate([
            'username' => 'required|string|unique:users,username,' . $idDec,
            'nama' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required'
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
        return redirect()->back()->with('updateSuccess', 'Data Guru berhasil di update!');
    }

    public function delete($id) {
        $idDec = decrypt($id);
        $where = User::find($idDec);
        if ($where->profile != null) {
            $gambarLama = public_path('assets/profil/' . $where->profile);
            unlink($gambarLama);
        }
        $where->delete();
        return redirect()->back()->with('deleteSuccess', 'Data Guru berhasil di hapus!');
    }
}
