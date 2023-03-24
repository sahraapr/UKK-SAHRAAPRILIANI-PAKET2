<?php

namespace App\Http\Controllers\Petugas\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('_petugas.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('petugas')->attempt($credentials)) {
            if(Auth::guard('petugas')->user()->status) {
                $request->session()->regenerate();

                // if(Auth::guard('petugas')->user()->level == 'petugas') {
                //     return redirect()->route('petugas.dashboard');
                // }
                return redirect()->route('_petugas.dashboard');
            }
            Auth::guard('petugas')->logout();

            return back()->with('error', 'Akun Anda belum aktif.');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::guard('petugas')->logout();

        $request->session()->invalidate();

        return redirect()->route('_petugas.login');
    }
}
