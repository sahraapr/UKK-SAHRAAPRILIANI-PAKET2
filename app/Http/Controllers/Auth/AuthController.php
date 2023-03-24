<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('masyarakat')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->with('errorLogin', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();

        $request->session()->invalidate();

        return redirect()->route('dashboard');
    }

    public function register(Request $request) {
        $validate = $request->validate([
            'nama' => 'required',
            'nik' => 'required|min:16|max:16|unique:masyarakat,nik',
            'telp' => 'required|unique:masyarakat,telp',
            'usernameRegister' => 'required|unique:masyarakat,username',
            'passwordRegister' => 'required|min:8',
            'jenis_kelamin' => 'required|unique:masyarakat,jenis_kelamin',
            'alamat_lengkap' => 'required|unique:masyarakat,alamat_lengkap'
        ]);

        Masyarakat::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'username' => $request->usernameRegister,
            'password' => Hash::make($request->passwordRegister),
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat_lengkap
        ]);

        return back()->with('successRegis', 'Registrasi berhasil!');
    }
}
