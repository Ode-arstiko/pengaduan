<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{
    public function index() {
        $data = [
            'content' => 'admin.siswa.index',
            'title' => 'Siswa',
            'siswa' => User::where('role', 'siswa')->latest()->get()
        ];
        return view('layouts.admin.wrapper', $data);
    }

    public function create() {
        $data = [
            'content' => 'admin.siswa.create',
            'title' => 'Siswa'
        ];
        return view('layouts.admin.wrapper', $data);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8',
            'nama' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20'
        ]);
        $data['role'] = 'siswa';
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/profil/'), $filename);
            $data['profile'] = $filename;
        }
        User::create($data);
        return redirect('/admin/kelola-siswa')->with('storeSuccess', 'Berhasil menambahkan data Siswa!');
    }

    public function edit($id) {
        $idDec = decrypt($id);
        $data = [
            'content' => 'admin.siswa.edit',
            'title' => 'Siswa',
            'siswa' => User::find($idDec)
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
        return redirect()->back()->with('updateSuccess', 'Data Siswa berhasil di update!');
    }

    public function delete($id) {
        $idDec = decrypt($id);
        $where = User::find($idDec);
        if ($where->profile != null) {
            $gambarLama = public_path('assets/profil/' . $where->profile);
            unlink($gambarLama);
        }
        $where->delete();
        return redirect()->back()->with('deleteSuccess', 'Data Siswa berhasil di hapus!');
    }
}
