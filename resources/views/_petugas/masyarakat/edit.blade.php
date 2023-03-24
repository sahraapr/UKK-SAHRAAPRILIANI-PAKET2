@extends('_petugas.masyarakat.index')

@section('edit')
    <div class="card">
        <div class="card-header">
            <h4>Edit Masyarakat</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('petugas.masyarakat.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">NIK</label>
                    <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $data->nik) }}">
                    @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $data->nama) }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp', $data->telp) }}">
                    @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $data->username) }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
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