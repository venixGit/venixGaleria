<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Venix Gallery</title>
	<link rel="icon" href="{{asset('img/app/logo.png')}}">

	<!--===============================
	=            CSS STYLE            =
	================================-->
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link href="{{ asset('css/style.css')}}" rel="stylesheet">
	<link href="{{asset('vendor/tagsinput/css/tagsinput.css')}}" rel="stylesheet">

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
<body class="bg-dark">
	<!--============================
	=            navbar            =
	=============================-->		
<section class="vertical-align">
	<div class="card m-auto border-0 bg-dark col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">
	  <div class="card-body">
	    <nav class="bg-info py-2">
			<div class="row d-flex justify-content-center mt-2">
				<div class="col-12 text-center">
					<img src="{{asset('img/app/logo.png')}}" alt="logo.png" class="img-fluid" style="height: 80px;">
				</div>
				<div class="col-12 text-center">
					<h5 class="text-white text-sans">VenixCode Gallery</h5>
				</div>
			</div>
		</nav>
		<div class="form-group bg-light border pb-2 px-4 pt-4 text-center">
			<form action="">
				<p class="mt-2 mb-0 pb-0 d-flex justify-content-between">¿Olvidó su contraseña? No hay problema, simplemente dejenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer una contraseña nueva.</p>
				<input type="email" class="form-control" placeholder="Email">
				<!-- <button class="btn btn-info m-4 mx-auto">Iniciar Sesión</button> -->
				<!-- El siguiente 'a' es temporal, debe usarse el boton comentado de arriba -->
				<a class="btn btn-info m-4 mx-auto" href="{{route('index')}}">
					Enviar enlace para restablecer contraseña
				</a><br>				
				</div>
			</form>	
		</div>
	  </div>
	</div>
</section>
	<!-- script -->
	<script src="{{asset('js/script.js')}}"></script>
</body>
</html>