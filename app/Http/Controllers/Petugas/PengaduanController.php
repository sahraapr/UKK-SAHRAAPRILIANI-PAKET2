<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alasan;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function belumDiproses()
    {
        return view('_petugas.pengaduan.belum.index');
    }

    public function sedangDiproses()
    {
        return view('_petugas.pengaduan.proses.index');
    }

    public function selesaiDiproses()
    {
        return view('_petugas.pengaduan.selesai.index');
    }

    public function ditolak()
    {
        return view('_petugas.pengaduan.ditolak.index');
    }

    public function detailBelum($id)
    {
        $data = Pengaduan::with('masyarakat')->findOrFail($id);

        return view('_petugas.pengaduan.belum.detail', compact('data'));
    }

    public function detailProses($id)
    {
        $data = Pengaduan::with('masyarakat')->findOrFail($id);

        return view('_petugas.pengaduan.proses.detail', compact('data'));
    }

    public function detailSelesai($id)
    {
        $data = Pengaduan::with('masyarakat', 'tanggapan')->findOrFail($id);

        return view('_petugas.pengaduan.selesai.detail', compact('data'));
    }

    public function detailDitolak($id)
    {
        $data = Pengaduan::with('masyarakat', 'tanggapan')->findOrFail($id);

        return view('_petugas.pengaduan.ditolak.detail', compact('data'));
    }

    public function prntDetail($id)
    {
        $data = Pengaduan::with('masyarakat')->findOrFail($id);

        return view('_petugas.pengaduan.print', compact('data'));
    }

    public function getBelum()
    {
        $data = Pengaduan::with('kategori')->where('status', '0')->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->editColumn('tgl_pengaduan', function ($row) {
            return date('d/m/Y h:i', strtotime($row->tgl_pengaduan));
        })
        ->editColumn('status', function ($row) {
            return '<span class="badge badge-light">Belum Diproses</span>';
        })
        ->addColumn('action', function ($row) {
            $id = $row->id_pengaduan;
            $detail = route('_petugas.pengaduan.belum.detail', $id);

            $actionbtn = '<a href="'. $detail .'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
            return $actionbtn;
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function getProses()
    {
        $data = Pengaduan::with('kategori')->where('status', 'proses')->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->editColumn('tgl_pengaduan', function ($row) {
            return date('d/m/Y h:i', strtotime($row->tgl_pengaduan));
        })
        ->editColumn('status', function ($row) {
            return '<span class="badge badge-info">Diproses</span>';
        })
        ->addColumn('action', function ($row) {
            $id = $row->id_pengaduan;
            $detail = route('_petugas.pengaduan.proses.detail', $id);

            $actionbtn = '<a href="'. $detail .'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
            return $actionbtn;
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function getSelesai()
    {
        $data = Pengaduan::with('kategori')->where('status', 'selesai')->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->editColumn('tgl_pengaduan', function ($row) {
            return date('d/m/Y h:i', strtotime($row->tgl_pengaduan));
        })
        ->editColumn('status', function ($row) {
            return '<span class="badge badge-success">Selesai</span>';
        })
        ->addColumn('action', function ($row) {
            $id = $row->id_pengaduan;
            $detail = route('_petugas.pengaduan.selesai.detail', $id);

            $actionbtn = '<a href="'. $detail .'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
            return $actionbtn;
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function getDitolak()
    {
        $data = Pengaduan::with('kategori')->where('status', 'ditolak')->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->editColumn('tgl_pengaduan', function ($row) {
            return date('d/m/Y h:i', strtotime($row->tgl_pengaduan));
        })
        ->editColumn('status', function ($row) {
            return '<span class="badge badge-danger">Ditolak</span>';
        })
        ->addColumn('action', function ($row) {
            $id = $row->id_pengaduan;
            $detail = route('_petugas.pengaduan.ditolak.detail', $id);

            $actionbtn = '<a href="'. $detail .'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
            return $actionbtn;
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function terima($id)
    {
        Pengaduan::findOrFail($id)->update([
            'status' => 'proses'
        ]);

        alert()->success('Berhasil!', 'Laporan diterima!')->persistent(true, false)->autoClose(3000);

        return redirect()->route('_petugas.pengaduan.belumDiproses');
    }

    public function halamanTolak($id)
    {
        $data = Pengaduan::findOrFail($id);
        $alasan = Alasan::all();

        return view('_petugas.pengaduan.belum.alasan', compact('data', 'alasan'));
    }

    public function tolak(Request $request)
    {
        Pengaduan::findOrFail($request->id)->update([
            'status' => 'ditolak',
            'alasan_ditolak' => $request->alasan_ditolak
        ]);

        alert()->success('Berhasil!', 'Berhasil ditolak!')->persistent(true,false)->autoClose(3000);

        return redirect()->route('_petugas.pengaduan.belumDiproses');
    }

    public function tanggapan(Request $request, $id)
    {
        $validate = $request->validate([
            'tanggapan' => 'required'
        ]);

        Tanggapan::create([
            'id_pengaduan' => $id,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas
        ]);

        Pengaduan::findOrFail($id)->update([
            'status' => 'selesai'
        ]);

        alert()->success('Berhasil!', 'Berhasil menanggapi laporan!');

        return redirect()->route('_petugas.pengaduan.sedangDiproses');
    }
}
