@extends('_petugas._layouts.master')

@section('tab_title', 'Pengaduan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaduan Belum Diproses</h1>
        </div>

        <div class="section-body">
            @if (Auth::guard('petugas')->user()->level == 'administrator')    
                <div class="text-right mb-3">
                    <a href="{{ route('_petugas.pengaduan.print', $data->id_pengaduan) }}" class="btn btn-primary btnPrint"><i class="fas fa-file-pdf"></i> Generate</a>
                </div>
            @endif
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
                        </div>
                        <div class="card-footer text-right d-flex ml-auto">
                            <form action="{{ route('_petugas.pengaduan.terima', $data->id_pengaduan) }}" method="post">
                                @csrf

                                <button class="btn btn-icon btn-success mr-1" type="submit"><i class="fas fa-check"></i></button>
                            </form>
                            <a href="{{ route('_petugas.pengaduan.halTolak', $data->id_pengaduan) }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.btnPrint').printPage();
        })
    </script>
@endsection