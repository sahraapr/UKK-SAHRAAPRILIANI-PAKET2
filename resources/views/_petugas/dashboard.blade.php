@extends('_petugas._layouts.master')

@section('tab_title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="far fa-clock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belum Diproses</h4>
                        </div>
                        <div class="card-body">
                            {{ $laporan_pending }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-hourglass"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Diproses</h4>
                        </div>
                        <div class="card-body">
                            {{ $laporan_proses }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ $laporan_selesai }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Ditolak</h4>
                        </div>
                        <div class="card-body">
                            {{ $laporan_ditolak }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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