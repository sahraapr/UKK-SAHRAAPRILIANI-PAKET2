<div class="modal fade" tabindex="-1" role="dialog" id="modalLogin">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('authenticate') }}">
                @csrf

                <div class="modal-body">
                    @if (session()->has('errorLogin') || session()->has('error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ session('errorLogin') }}
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username Anda" name="username">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan kata sandi Anda" name="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <p>Belum memiliki akun? <a href="javascript:void(0)" onclick="openRegister()" data-dismiss="modal" aria-label="Close">Daftar sekarang</a></p>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="submit" class="btn btn-primary btn-shadow">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
@parent
    @if($errors->has('username') || $errors->has('password') || session()->has('errorLogin') || session()->has('error'))
        <script>
            $(function() {
                $('#modalLogin').modal({
                    show: true
                });
                $('#modalRegister').modal({
                    show: false
                });
            });
        </script>
    @endif
    <script>
        function openRegister() {
            $('#modalRegister').modal({
                show: true
            });
        }
    </script>
@endsection