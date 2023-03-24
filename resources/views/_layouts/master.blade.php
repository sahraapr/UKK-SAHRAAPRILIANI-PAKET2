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
	<style>
		body.layout-3 .main-content {
			padding-top: 107px !important;
		}
	</style>
    @yield('css')

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body class="layout-3">
	<div id="app">
		<div class="main-wrapper container">
			@include('_partials.navbar')

			<!-- Main Content -->
			<div class="main-content">
                @yield('content')
				@include('auth.login')
				@include('auth.register')
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
    @yield('scripts')

	<!-- Template JS File -->
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
