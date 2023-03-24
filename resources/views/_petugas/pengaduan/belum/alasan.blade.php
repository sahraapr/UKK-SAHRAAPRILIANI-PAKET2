@extends('_petugas._layouts.master')

@section('tab_title', 'Pengaduan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaduan Belum Diproses</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-6 col-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>Alasan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('_petugas.pengaduan.tolak', $data->id_pengaduan) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    @foreach ($alasan as $item)  
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="alasan_ditolak" id="exampleRadios{{ $item->id }}" value="{{ $item->alasan }}">
                                            <label class="form-check-label" for="exampleRadios{{ $item->id }}">
                                                {{ $item->alasan }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('alasan_ditolak')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection