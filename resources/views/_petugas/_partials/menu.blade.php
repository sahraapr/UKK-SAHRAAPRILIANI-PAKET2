<ul class="sidebar-menu">
    <li class="menu-header">Menu</li>
    <li class="{{ Route::is('_petugas.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('_petugas.dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
    <li class="dropdown {{ Route::is('_petugas.pengaduan.belumDiproses', '_petugas.pengaduan.sedangDiproses', '_petugas.pengaduan.selesaiDiproses', '_petugas.pengaduan.ditolak') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-flag"></i><span>Pengaduan</span></a>
        <ul class="dropdown-menu">
            <li class="{{ Route::is('_petugas.pengaduan.belumDiproses') ? 'active' : '' }}">
                <a href="{{ route('_petugas.pengaduan.belumDiproses') }}" class="nav-link">Belum Diproses</a>
            </li>
            <li class="{{ Route::is('_petugas.pengaduan.sedangDiproses') ? 'active' : '' }}">
                <a href="{{ route('_petugas.pengaduan.sedangDiproses') }}" class="nav-link">Sedang Diproses</a>
            </li>
            <li class="{{ Route::is('_petugas.pengaduan.selesaiDiproses') ? 'active' : '' }}">
                <a href="{{ route('_petugas.pengaduan.selesaiDiproses') }}" class="nav-link">Selesai Diproses</a>
            </li>
            <li class="{{ Route::is('_petugas.pengaduan.ditolak') ? 'active' : '' }}">
                <a href="{{ route('_petugas.pengaduan.ditolak') }}" class="nav-link">Ditolak</a>
            </li>
        </ul>
    </li>
    <li class="{{ Route::is('_petugas.kategori', '_petugas.kategori.edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('_petugas.kategori') }}"><i class="fas fa-th-large"></i> <span>Kategori</span></a></li>
    <li class="{{ Route::is('_petugas.alasan', '_petugas.alasan.edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('_petugas.alasan') }}"><i class="fas fa-align-justify"></i> <span>Alasan</span></a></li>
    @if(Auth::user()->level == 'petugas')
        <li class="{{ Route::is('petugas.masyarakat', 'petugas.masyarakat.edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('petugas.masyarakat') }}"><i class="fas fa-users"></i> <span>Masyarakat</span></a></li>
        <li class="{{ Route::is('petugas.administrator', 'petugas.administrator.edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('petugas.administrator') }}"><i class="fas fa-users-cog"></i> <span>Administrator</span></a></li>
    @endif
</ul>
