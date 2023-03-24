@extends('_petugas._layouts.master')

@section('tab_title', 'Pengaduan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaduan Sedang Diproses</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pengaduan</th>
                                            <th>NIK</th>
                                            <th>Judul Laporan</th>
                                            <th>Kategori</th>
                                            <th>Privasi</th>
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
            ajax: "{{ route('_petugas.pengaduan.getProses') }}",
            columns: [
                {
                    data: 'tgl_pengaduan',
                    name: 'tgl_pengaduan'
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'judul_laporan',
                    name: 'judul_laporan'
                },
                {
                    data: 'kategori.nama',
                    name: 'kategori.nama'
                },
                {
                    data: 'privasi',
                    name: 'privasi',
                },
                {
                    data: 'status'
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
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, tolak',
                cancelButtonText: 'Batal',
            }).then((result) => {
                var url = "{{ route('petugas.masyarakat.delete', ':id') }}";
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