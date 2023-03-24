<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $laporan_saya = Pengaduan::with('kategori', 'masyarakat', 'tanggapan')->where('nik', Auth::guard('masyarakat')->user()->nik)->latest()->paginate(5, ['*'], 'laporan_saya');
        $laporan = Pengaduan::with('kategori', 'masyarakat', 'tanggapan')->where('privasi', '!=', 'rahasia')->where('status', '!=', 'ditolak')->latest()->paginate(10, ['*'], 'laporan');

        return view('laporan.laporan', compact('kategori', 'laporan_saya', 'laporan'));
    }

    public function detail($id)
    {
        $data = Pengaduan::with('kategori', 'masyarakat', 'tanggapan')->findOrFail($id);

        return view('laporan.detail', compact('data'));
    }
}
