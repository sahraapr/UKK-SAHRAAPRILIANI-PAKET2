<div class="modal fade" tabindex="-1" role="dialog" id="modalRegister">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="modal-body">
                    @if (session()->has('successRegis'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ session('successRegis') }}
                            </div>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap Anda" name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK Anda" name="nik" value="{{ old('nik') }}">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" placeholder="Contoh: 08123456789" name="telp" value="{{ old('telp') }}">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="laki-laki" name="jenis_kelamin" class="custom-control-input" value="laki-laki" {{ old('jenis_kelamin') == "jenis_kelamin" ? "checked" : "" }}>
                            <label class="custom-control-label" for="laki-laki" data-toggle="tooltip" data-placement="top" title="laki-laki">laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input" value="perempuan" {{ old('jenis_kelamin') == "jenis_kelamin" ? "checked" : "" }}>
                            <label class="custom-control-label" for="perempuan" data-toggle="tooltip" data-placement="top" title="perempuan">perempuan</label>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" class="form-control @error('usernameRegister') is-invalid @enderror" placeholder="Buat username Anda" name="usernameRegister">
                            @error('usernameRegister')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kata Sandi</label>
                            <input type="password" class="form-control @error('passwordRegister') is-invalid @enderror" placeholder="Buat kata sandi Anda" name="passwordRegister">
                            @error('passwordRegister')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                     <textarea name="alamat_lengkap" id="" cols="30" rows="10" class="form-control @error('alamat_lengkap') is-invalid @enderror" placeholder="Masukan Alamat" style="height:100px;"></textarea>
                             @error('isi_laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    <div class="text-center">
                        <p>Sudah memiliki akun? <a href="javascript:void(0)" onclick="openLogin()" data-dismiss="modal" aria-label="Close">Masuk</a></p>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="submit" class="btn btn-primary btn-shadow">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
@parent
    @if($errors->has('usernameRegister') || $errors->has('passwordRegister') || session()->has('successRegis') || $errors->has('nama') || $errors->has('nik') || $errors->has('telp'))
        <script>
            $(function() {
                $('#modalRegister').modal({
                    show: true
                });
            });
        </script>
    @endif
    <script>
        function openLogin() {
            $('#modalLogin').modal({
                show: true
            });
        }
    </script>
@endsection