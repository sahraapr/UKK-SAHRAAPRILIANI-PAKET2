@extends('_petugas._layouts.master')

@section('tab_title', 'Administrator')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Administrator</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-3 col-12">
                    @if(Route::is('petugas.administrator'))
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Administrator</h4>
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
                                <form action="{{ route('petugas.administrator.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="">Nama Petugas</label>
                                        <input type="text" class="form-control @error('nama_petugas') is-invalid @enderror" name="nama_petugas" value="{{ old('nama_petugas') }}">
                                        @error('nama_petugas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nomor Telepon</label>
                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}">
                                        @error('telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}">
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
                                        <label class="d-block">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineradio1" value="1" name="status">
                                            <label class="form-check-label" for="inlineradio1">Aktif</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineradio2" value="0" name="status">
                                            <label class="form-check-label" for="inlineradio2">Tidak Aktif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        @yield('edit')
                    @endif
                </div>
                <div class="col-md-9 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Nomor Telepon</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        var dataTable = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: true,
            ajax: "{{ route('petugas.administrator.getAdministrator') }}",
            columns: [
                {
                    data: 'nama_petugas',
                    name: 'nama_petugas'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'telp',
                    name: 'telp'
                },
                {
                    data: 'status',
                    render: function ( data, type, row ) {
                        if ( type === 'display' ) {
                                console.log(row);
                                if (row.status == 1) {
                                    return '<label class="custom-switch p-0"><input data-id="'+row.id_petugas+'" type="checkbox" name="status" class="custom-switch-input toggle-status" checked><span class="custom-switch-indicator"></span><span class="custom-switch-description">Aktif</span></label>';
                                } else {
                                    return '<label class="custom-switch p-0"><input data-id="'+row.id_petugas+'" type="checkbox" name="status" class="custom-switch-input toggle-status"><span class="custom-switch-indicator"></span><span class="custom-switch-description">Tidak Aktif</span></label>';
                                }
                        }
                        return data;
                    },
                    orderable: false, searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            rowCallback: function ( row, data ) {
                $('input.toggle-status', row)
                .prop('checked', data.status == 1 );
            },
            language: {
                emptyTable: 'Tidak ada data dalam table',
                lengthMenu: 'Tampilkan _MENU_ entri',
                search: 'Pencarian:',
                info: 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri',
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                paginate: {
                    previous: '<i class="fas fa-chevron-left"></i>',
                    next: "<i class='fas fa-chevron-right'></i>",
                }
            },
            dom: "<'row'<'col-sm-5'l><'col-sm-7'f>>Tgrtip",
        });

        function deleteData(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                var url = "{{ route('petugas.administrator.delete', ':id') }}";
                url = url.replace(':id', id);
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.success) {
                                Swal.fire({
                                        title: 'Berhasil!',
                                        text: res.message,
                                        icon: 'success',
                                        timer: 3000,
                                    }
                                ).then(function() {
                                    dataTable.ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Data gagal dihapus.',
                                        icon: 'error',
                                        timer: 3000,
                                    }
                                );
                            }
                        }
                    });
                }
            });
        }

        $(document).on('change','.toggle-status',function(e)
        {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('petugas.administrator.changeStatus') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    'status': status,
                    'id': id
                },
                success: function(res) {
                    dataTable.draw();
                }
            });
        });
    </script>
@endsection