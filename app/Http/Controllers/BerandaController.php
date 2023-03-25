<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();

        $laporan_pending = Pengaduan::where('status', '0')->count();
        $laporan_proses = Pengaduan::where('status', 'proses')->count();
        $laporan_selesai = Pengaduan::where('status', 'selesai')->count();
        $laporan_ditolak = Pengaduan::where('status', 'ditolak')->count();
        $semua_laporan = Pengaduan::count();

        return view('dashboard', compact('kategori', 'semua_laporan'));
    }

    public function lapor(Request $request)
    {
        $validate = $request->validate([
            'judul_laporan' => 'required',
            'isi_laporan' => 'required',
            'id_kategori' => 'required',
            'foto' => 'required|max:2048'
        ]);
        
        if(Auth::guard('masyarakat')->check()) {
            if ($request->file('foto')) {
                $file = $request->file('foto');
    
                $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/dokumen/', $fileName);
            }

            Pengaduan::create([
                'tgl_pengaduan' => now(),
                'nik' => Auth::guard('masyarakat')->user()->nik,
                'judul_laporan' => $request->judul_laporan,
                'isi_laporan' => $request->isi_laporan,
                'id_kategori' => $request->id_kategori,
                'foto' => $fileName,
                'privasi' => $request->privasi ? $request->privasi : 'publik'
            ]);

            session()->forget(['judul_laporan', 'isi_laporan', 'id_kategori', 'privasi']);

            return back()->with('success', 'Laporan berhasil dikirim. Mohon tunggu tanggapan dari petugas.');
        }

        session()->put([
            'judul_laporan' => $request->judul_laporan,
            'isi_laporan' => $request->isi_laporan,
            'id_kategori' => $request->id_kategori,
            'privasi' => $request->privasi ? $request->privasi : 'privat'
        ]);

        return back()->with('error', 'Anda harus masuk terlebih dahulu!');
    }
}
