@extends('_petugas.alasan.index')

@section('edit')
    <div class="card">
        <div class="card-header">
            <h4>Edit Alasan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('petugas.alasan.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Alasan</label>
                    <input type="text" class="form-control @error('alasan') is-invalid @enderror" name="alasan" value="{{ old('alasan', $data->alasan) }}">
                    @error('alasan')
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