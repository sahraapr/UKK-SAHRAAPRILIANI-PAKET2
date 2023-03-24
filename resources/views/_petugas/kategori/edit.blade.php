@extends('_petugas.kategori.index')

@section('edit')
    <div class="card">
        <div class="card-header">
            <h4>Edit Kategori</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('_petugas.kategori.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Nama Kategori</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $data->nama) }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection