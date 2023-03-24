@extends('_petugas._layouts.master')

@section('tab_title', 'Pengaduan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaduan Ditolak</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Laporan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-3"><b>NIK</b></div>
                                <div class="col-9">{{ $data->nik }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3"><b>Nama Pelapor</b></div>
                                <div class="col-9">{{ $data->masyarakat->nama }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3"><b>Tanggal Pengaduan</b></div>
                                <div class="col-9">{{ date('d F Y', strtotime($data->tgl_pengaduan)) }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3"><b>Judul Laporan</b></div>
                                <div class="col-9">{{ $data->judul_laporan }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 mb-1"><b>Isi Laporan</b></div>
                                <div class="col-12">
                                    <div class="form-group m-0">
                                        <textarea class="form-control" style="height: 150px;" readonly>{{ $data->isi_laporan }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12"><b>Lampiran</b></div>
                                <div class="col-2">
                                    <img src="{{ asset('storage/dokumen/'.$data->foto) }}" alt="Lampiran" class="img-fluid" style="width:auto;max-width:100%;">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3"><b>Alasan Ditolak</b></div>
                                <div class="col-9">{{ $data->alasan_ditolak }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection