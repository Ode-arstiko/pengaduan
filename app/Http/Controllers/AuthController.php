<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function doRegister(Request $request) {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8',
            'nama' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20'
        ]);
        $data['role'] = 'siswa';

        User::create($data);
        Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ]);
        return redirect('/siswa');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('/admin');
            } elseif ($user->role == 'siswa') {
                return redirect('/siswa');
            } elseif (in_array($user->role, [
                'kepala-sekolah',
                'waka-kesiswaan',
                'waka-kurikulum',
                'BK',
                'tata-usaha'
            ])) {
                return redirect('/guru');
            }
        } else {
            return redirect()->back()->with('loginError', 'Username atau Password anda salah!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
