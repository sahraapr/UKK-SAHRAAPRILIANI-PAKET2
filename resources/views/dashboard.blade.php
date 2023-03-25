@extends('_layouts.master')

@section('tab_title', 'Beranda')

@section('css')
@endsection

@section('content')
    <section class="section">
        <div class="section-header d-flex flex-column justify-content-center bg-transparent shadow-none">
            <h1>Layanan Pengaduan masyarakat Cibeureum</h1>
            <p>Sampaikan Laporan Anda Langsung Kepada Pihak Yang Berwenang!</p>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-8 p-0 mx-auto mb-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <p class="text-white font-weight-bold m-0" style="font-size:1.3rem;">FORM PENGADUAN</p>
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
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3 d-flex">
                    <div class="card">
                        
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