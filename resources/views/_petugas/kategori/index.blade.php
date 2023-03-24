@extends('_petugas._layouts.master')

@section('tab_title', 'Kategori')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-3 col-12">
                    @if(Route::is('_petugas.kategori'))
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Kategori</h4>
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
                                <form action="{{ route('_petugas.kategori.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="">Nama Kategori</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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
            ajax: "{{ route('_petugas.kategori.getKategori') }}",
            columns: [
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
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
                var url = "{{ route('_petugas.kategori.delete', ':id') }}";
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
    </script>
@endsection