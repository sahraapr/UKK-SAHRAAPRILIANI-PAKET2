@extends('_layouts.master')

@section('tab_title', 'Laporan')

@section('css')
@endsection

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <p class="text-white font-weight-bold m-0" style="font-size:1.3rem;">FORM PENGADUAN MASYARAKAT CIBEUREUM</p>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))    
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('lapor') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <input type="text" name="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" id="" placeholder="Ketik judul laporan Anda *" value="{{ session()->has('judul_laporan') ? session('judul_laporan') : old('judul_laporan') }}">
                                    @error('judul_laporan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="isi_laporan" id="" cols="30" rows="10" class="form-control @error('isi_laporan') is-invalid @enderror" placeholder="Ketik isi laporan Anda *" style="height:100px;">{{ session()->has('isi_laporan') ? session('isi_laporan') : old('isi_laporan') }}</textarea>
                                    @error('isi_laporan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select name="id_kategori" id="" class="form-control @error('id_kategori') is-invalid @enderror">
                                        <option value="" selected disabled>--- Pilih Kategori ---</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}" {{ old('id_kategori') || session('id_kategori') == $item->id ? "selected" : "" }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="file" name="foto" id="" class="form-control @error('foto') is-invalid @enderror">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="rahasia" name="privasi" class="custom-control-input" value="rahasia" {{ old('privasi') || session('privasi') == "rahasia" ? "checked" : "" }}>
                                        <label class="custom-control-label" for="rahasia" data-toggle="tooltip" data-placement="top" title="Laporan tidak akan terlihat di publik.">Rahasia</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h2 class="section-title">Laporan Terbaru</h2>
                    <div class="card">
                        <div class="card-body">
                            @foreach ($laporan as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="d-flex flex-column px-3">
                                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="profil" class="img-fluid rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col-10 pl-0">
                                        <div class="d-flex justify-content-between">
                                            @if ($item->privasi == 'anonim')
                                                <p class="m-0">Anonim</p>
                                            @endif
                                            @if ($item->privasi == 'publik')
                                                <p class="text-primary m-0">{{ $item->masyarakat->nama }}</p>
                                            @endif
                                            <div class="d-flex">
                                                @if ($item->status == '0')
                                                    <span class="badge badge-light">Belum Diproses</span>
                                                @endif
                                                @if ($item->status == 'proses')
                                                    <span class="badge badge-info">Diproses</span>
                                                @endif
                                                @if ($item->status == 'selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @endif
                                                <p class="text-muted m-0 pl-2">#{{ $item->id_pengaduan }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <small class="text-muted pr-2"><i class="fas fa-calendar pr-1"></i>{{ date('d M Y h.i', strtotime($item->created_at)) }}</small>
                                            <small class="text-muted"><i class="fas fa-bookmark pr-1"></i>{{ $item->kategori->nama }}</small>
                                        </div>
                                        <h4 class="mt-3"><a href="{{ route('laporan.detail', $item->id_pengaduan) }}">{{ $item->judul_laporan }}</a></h4>
                                        <p>{{ $item->isi_laporan }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <div class="card-footer text-right pt-0">
                            <div class="d-inline-block">
                                {{  $laporan->links()  }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <h2 class="section-title mt-0">Laporan Saya</h2>
                    <div class="card">
                        <div class="card-body">
                            @foreach ($laporan_saya as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="profil" class="img-fluid rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col-10 pl-0">
                                        <div class="d-flex justify-content-between">
                                            <p class="text-primary m-0">{{ $item->masyarakat->nama }}</p>
                                            <div class="d-flex">
                                                @if ($item->status == '0')
                                                    <span class="badge badge-light">Belum Diproses</span>
                                                @endif
                                                @if ($item->status == 'proses')
                                                    <span class="badge badge-info">Diproses</span>
                                                @endif
                                                @if ($item->status == 'selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @endif
                                                @if ($item->status == 'ditolak')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                                <p class="text-muted m-0 pl-2">#{{ $item->id_pengaduan }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <small class="text-muted pr-2"><i class="fas fa-calendar pr-1"></i>{{ date('d M Y h.i', strtotime($item->created_at)) }}</small>
                                            <small class="text-muted"><i class="fas fa-bookmark pr-1"></i>{{ $item->kategori->nama }}</small>
                                        </div>
                                        <h4 class="mt-3"><a href="{{ route('laporan.detail', $item->id_pengaduan) }}">{{ $item->judul_laporan }}</a></h4>
                                        <p>{{ $item->isi_laporan }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <div class="card-footer text-right pt-0">
                            <div class="d-inline-block">
                                {{  $laporan_saya->links()  }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection