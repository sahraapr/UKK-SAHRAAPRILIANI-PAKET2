<?php

namespace App\Http\Controllers\Petugas\Auth;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('_petugas.auth.register');
    }

    public function register(Request $request) {
        $validate = $request->validate([
            'nama_petugas' => 'required',
            'telp' => 'required|unique:petugas,telp',
            'username' => 'required|unique:petugas,username',
            'password' => 'required|min:8'
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => 'administrator',
            'status' => false,
            'created_at' => now()
        ]);

        return back()->with('success', 'Berhasil registrasi! Tunggu petugas memverifikasi akun Anda.');
    }
}
