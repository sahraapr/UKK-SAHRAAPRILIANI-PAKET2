@extends('_layouts.master')

@section('tab_title', 'Beranda')

@section('css')
@endsection

@section('content')
    <section class="section">
        <div class="section-header d-flex flex-column justify-content-center bg-transparent shadow-none">
            <h1>Layanan Pengaduan masyarakat Desa Cibeureum</h1>
            <!-- <p>Sampaikan saja disini</p> -->
        </div>

        <div class="section-body">
            <div class="col-12 col-md-8 p-0 mx-auto mb-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <p class="text-white font-weight-bold m-0" style="font-size:1.3rem;">Sampaikan Laporan atau Keluhan Anda Langsung Kepada Pihak Berwenang</p>
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
                                    <option class="select-option" value="Company Website">Agama</option>
                                    <option class="select-option" value="Landing Page">Hukum</option>
                                    <option class="select-option" value="Online Shop">Sosial</option>
                                    <option class="select-option" value="Landing Page">Lingkungan</option>
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
                                    <input type="radio" id="anonim" name="privasi" class="custom-control-input" value="anonim" {{ old('privasi') || session('privasi') == "anonim" ? "checked" : "" }}>
                                    <label class="custom-control-label" for="anonim" data-toggle="tooltip" data-placement="top" title="Nama pelapor akan disamarkan.">Anonim</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="rahasia" name="privasi" class="custom-control-input" value="rahasia" {{ old('privasi') || session('privasi') == "rahasia" ? "checked" : "" }}>
                                    <label class="custom-control-label" for="rahasia" data-toggle="tooltip" data-placement="top" title="Laporan tidak akan terlihat di publik.">Rahasia</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Lapor!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3 d-flex">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/img/steps/tulis.svg') }}" alt="tulis" class="img-fluid" style="width: auto; max-width: 100%;">
                            <h5 class="mt-4">1. Tulis Laporan</h5>
                            <p>Tulis laporan atau keluhan Anda dengan memperhatikan tata bahasa yang baik dan benar</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/img/steps/processing.svg') }}" alt="processing" class="img-fluid" style="width: auto; max-width: 100%;">
                            <h5 class="mt-4">2. Proses Verifikasi</h5>
                            <p>Tunggu laporan atau keluhan Anda diverifikasi oleh petugas</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/img/steps/act.svg') }}" alt="act" class="img-fluid" style="width: auto; max-width: 100%;">
                            <h5 class="mt-4">3. Tindak Lanjut</h5>
                            <p>Laporan atau keluhan Anda sedang ditindak lanjut</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/img/steps/verification.svg') }}" alt="verification" class="img-fluid" style="width: auto; max-width: 100%;">
                            <h5 class="mt-4">4. Selesai</h5>
                            <p>Laporan atau keluhan Anda telah selesai ditindak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-exclamation"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Laporan</h4>
                        </div>
                        <div class="card-body">
                            {{ $semua_laporan }}
                        </div></div>
                </div>
            </div>
        </div>
    </section>
@endsection