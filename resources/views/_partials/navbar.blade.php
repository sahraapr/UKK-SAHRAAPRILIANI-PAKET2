<nav class="navbar navbar-expand-lg main-navbar bg-primary w-100">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand sidebar-gone-hide">Pengaduan Masyarakat Cibeureum</a>
        <div class="navbar-nav">
            <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div>
        <div class="nav-collapse">
            <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                <i class="fas fa-ellipsis-v"></i>
            </a>
        </div>
        <div class="ml-auto d-flex align-items-center justify-content-center">
            @guest('masyarakat')    
                <div class="order-5">
                    <a href="javascript:void(0)" class="btn btn-outline-white" style="cursor: pointer" data-toggle="modal" data-target="#modalRegister">Daftar</a>
                </div>
            @endguest
            <ul class="navbar-nav navbar-right">
                @guest('masyarakat')
                    <a href="javascript:void(0)" class="nav-link font-weight-bold" style="cursor: pointer" data-toggle="modal" data-target="#modalLogin">Masuk</a><span class="text-white">
                @endguest
                @auth('masyarakat')
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::guard('masyarakat')->user()->nama }}</div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('laporan') }}" class="dropdown-item has-icon text-primary">
                                <i class="fas fa-sign-in-alt"></i> Laporan
                            </a>
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>