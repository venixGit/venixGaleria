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
				<h6 class="mb-3">LOGIN</h6>
				<input type="text" class="form-control" placeholder="Usuario">
				<input type="text" class="form-control mt-2" placeholder="Contrase??a">
				<div class="form-check text-left mt-3">
					<input class="form-check-input" type="checkbox" name="remember" id="remember_me" value="option1" >
					<label class="form-check-label text-sans text-muted" for="exampleRadios1">Mantener sesi??n activa
					</label>
				</div>
				<div class="d-flex justify-content-between">
					<div class="text-left mt-4">
						<a class="text-black" href="#">
						</a>
					</div>

				<a class="btn btn-link m-auto text-xl-left" href="{{route('recuperacion')}}">??Olvid?? su contrase??a?</a>
				<!-- <button class="btn btn-info m-4 mx-auto">Iniciar Sesi??n</button> -->
				<!-- El siguiente 'a' es temporal, debe usarse el boton comentado de arriba -->
				<a class="btn btn-info m-4 mx-auto" href="{{route('galeria')}}">Iniciar Sesi??n</a><br>				
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