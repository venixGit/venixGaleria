<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="icon" href="{{asset('img/app/logo.png')}}">
	<!--===============================
	=            CSS STYLE            =
	================================-->
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<link href="{{asset('css/style.css')}}" rel="stylesheet">
	<link href="vendor/tagsinput/css/tagsinput.css" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Benne&family=Open+Sans:wght@600&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&family=Viaoda+Libre&display=swap" rel="stylesheet">
	<!--====  End of CSS STYLE  ====-->


	<!--===============================
	=            JS SCRIPT            =
	================================-->
	<!-- bootstrap -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<script src="{{asset('vendor/tagsinput/js/tagsinput.js')}}"></script>
	<!--====  End of JS SCRIPT  ====-->	
</head>
<body>
	<!--============================
	=            navbar            =
	=============================-->		
	<section>
		<nav class="bg-info py-2">
			<div class="row d-flex justify-content-center">
				<div class="col-12 text-center">
					<img src="{{asset('img/app/logo.png')}}" alt="logo.png" class="img-fluid">
				</div>
				<div class="col-12 text-center">
					<h1 class="display-2 text-white text-sans">PHOCO GALLERY</h1>
				</div>
				<div class="col-10 col-sm-10 col-md-8 col-lg-10 col-xl-6 mb-3 text-center">
					<input type="text" class="form-control form-control-lg text-center mb-4" placeholder="Buscar Imagen">
					<button class="btn btn-outline-light">Buscar</button>
				</div>
			</div>
		</nav>
	</section>

	<!-- Seccion de fotos -->
	<div class="container">
		<div class="row py-2 d-flex justify-content-between">
			<button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#newImg">
				Nueva Imagen
			</button>
			<!-- <button type="button" class="btn btn-outline-danger mt-2" data-toggle="modal" data-target="#newImg">
			Cerrar Sesión
			</button> -->
			<!-- El siguiente 'a' es temporal, debe usarse el boton comentado de arriba -->
			<a class="btn btn-outline-danger mt-2" href="{{url('/logout')}}">Cerrar Sesión</a>
		</div>
	
		<section class="border mt-3 p-2">
				 @yield('photos')
		</section>
	</div>

	<!--===========================
	=            footer           =
	============================-->	
	<section>
		<div class="bg-info p-3 text-center text-white">
			<h6>VenixCode Copyright ©  2021 Derechos Reservados</h6>
		</div>
	</section>

	<!-- script -->
	<script src="{{asset('js/script.js')}}"></script>
</body>
</html>