<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $laporan_pending = Pengaduan::where('status', '0')->count();
        $laporan_proses = Pengaduan::where('status', 'proses')->count();
        $laporan_selesai = Pengaduan::where('status', 'selesai')->count();
        $laporan_ditolak = Pengaduan::where('status', 'ditolak')->count();
        $semua_laporan = Pengaduan::count();

        return view('_petugas.dashboard', compact('laporan_pending', 'laporan_proses', 'laporan_selesai', 'laporan_ditolak', 'semua_laporan'));
    }
}
