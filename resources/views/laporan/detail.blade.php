@extends('_layouts.master')

@section('tab_title', 'Laporan')

@section('css')
@endsection

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="col-12 col-md-8 p-0 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="d-flex">
                                    <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="profil" class="img-fluid rounded-circle">
                                </div>
                            </div>
                            <div class="col-10 pl-0">
                                <div class="d-flex justify-content-between">
                                    <p class="text-primary m-0">{{ $data->masyarakat->nama }}</p>
                                    <div class="d-flex">
                                        @if ($data->status == '0')
                                            <span class="badge badge-light">Belum Diproses</span>
                                        @endif
                                        @if ($data->status == 'proses')
                                            <span class="badge badge-info">Diproses</span>
                                        @endif
                                        @if ($data->status == 'selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @endif
                                        @if ($data->status == 'ditolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                        <p class="text-muted m-0 pl-2">#{{ $data->id_pengaduan }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <small class="text-muted pr-2"><i class="fas fa-calendar pr-1"></i>{{ date('d M Y h.i', strtotime($data->created_at)) }}</small>
                                    <small class="text-muted"><i class="fas fa-bookmark pr-1"></i>{{ $data->kategori->nama }}</small>
                                </div>
                                <h4 class="text-primary mt-3">{{ $data->judul_laporan }}</h4>
                                <p>{{ $data->isi_laporan }}</p>
                                <div class="col-2 pl-0">
                                    <img src="{{ asset('storage/dokumen/'.$data->foto) }}" alt="Lampiran" class="img-fluid" style="width:auto;max-width:100%;">
                                </div>
                                <h2 class="section-title">Tanggapan</h2>
                                @if($data->tanggapan)
                                    <p>{{ $data->tanggapan->tanggapan }}</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection