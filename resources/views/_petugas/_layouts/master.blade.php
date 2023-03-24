<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>@yield('tab_title') | {{ config('app.name') }}</title>

	<!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome-5.7.2/css/all.css') }}">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.13.2/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.6.0/css/select.bootstrap4.min.css') }}">
    @yield('css')

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			@include('_petugas._partials.nav')
			<div class="main-sidebar sidebar-style-2">
				<aside id="sidebar-wrapper">
					<div class="sidebar-brand">
						<a href="index.html">Lapor!n</a>
					</div>
					<div class="sidebar-brand sidebar-brand-sm">
						<a href="index.html">LPR</a>
					</div>
					@include('_petugas._partials.menu')
				</aside>
			</div>

			<!-- Main Content -->
			<div class="main-content">
                @yield('content')
			</div>
		</div>
	</div>

	<!-- General JS Scripts -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> -->
	<script src="{{ asset('assets/modules/jquery-3.6.0.min.js') }}"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
	<script src="{{ asset('assets/modules/popper.min.js') }}"></script>
	<script src="{{ asset('assets/modules/bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> -->
	<script src="{{ asset('assets/modules/jquery.nicescroll.min.js') }}"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
	<script src="{{ asset('assets/modules/momment.min.js') }}"></script>
	<script src="{{ asset('assets/js/stisla.js') }}"></script>

	<!-- JS Libraies -->
	<!-- datatables -->
	<script src="{{ asset('assets/modules/datatables/DataTables-1.13.2/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/modules/datatables/DataTables-1.13.2/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/modules/datatables/Select-1.6.0/js/select.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
	<!-- sweetalert -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
	<script src="{{ asset('assets/modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    @yield('scripts')
	@include('sweetalert::alert')

	<!-- Template JS File -->
	<script src="{{ asset('assets/js/jquery.printPage.js') }}"></script>
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
