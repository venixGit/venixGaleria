<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHOCO Gallery</title>
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

	<!--===========================
	=            fotos            =
	============================-->	
	<section>
		<div class="container">
			<div class="row py-2 d-flex justify-content-between">
				<button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#newImg">
				  Nueva Imagen
				</button>
				<!-- <button type="button" class="btn btn-outline-danger mt-2" data-toggle="modal" data-target="#newImg">
				  Cerrar Sesión
				</button> -->
				<!-- El siguiente 'a' es temporal, debe usarse el boton comentado de arriba -->
				<a class="btn btn-outline-danger mt-2" href="{{route('index')}}">Cerrar Sesión</a>
			</div>
			<section class="border mt-3 p-2">
				<div class="card-columns"> 
					<div class="card shadow" onclick="showPhoto(this)">
					    <img src="{{asset('img/fotos/img1.jpg')}}" class="card-img-top" alt="...">
						    <div class="card-body">
						    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Decierto</span>
						    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Roca</span>
						    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Saára</span>

							    <p class="card-text mt-1 text-sans">Recuerdo de un gran dia.</p>

							    <p class="mt-2 mb-0 pb-0 d-flex justify-content-between">
						      	<small class="text-muted">Hace 13 horas</small>
						      	</p>
					    </div>
				  </div>
				  
				  <div class="card shadow" onclick="showPhoto(this)">

				    <img src="{{asset('img/fotos/img4.jpg')}}" class="card-img-top" alt="...">
				    <div class="card-body">
					    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Decierto</span>
					    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Roca</span>
					    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Saára</span>
					      	<p class="card-text mt-1 text-sans">Recuerdo de un gran dia.</p>
					      	<p class="mt-2 mb-0 pb-0 d-flex justify-content-between">
				      	<small class="text-muted">Hace 13 horas</small>
				      </p>
				    </div>
				  </div>
				  
				  <div class="card shadow" onclick="showPhoto(this)">
				    <img src="{{asset('img/fotos/img3.jpg')}}" class="card-img-top" alt="...">
					    <div class="card-body">
					    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Decierto</span>
					    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Roca</span>
					    	<span class="badge badge-pill border border-info px-2 px-1 text-sans">#Saára</span>

					      	<p class="card-text mt-1 text-sans">Recuerdo de un gran dia.</p>

					      	<p class="mt-2 mb-0 pb-0 d-flex justify-content-between">
					      	<small class="text-muted">Hace 13 horas</small>
					      </p>
					    </div>
				  </div>
				</div>

				<div class="col-12 d-flex justify-content-end">
					<nav aria-label="Page navigation example mt-2">
					  <ul class="pagination pagination-sm justify-content-center|justify-content-end">
					    <li class="page-item disabled">
					      <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><</a>
					    </li>
					    <li class="page-item"><a class="page-link" href="#">1</a></li>
					    <li class="page-item"><a class="page-link" href="#">2</a></li>
					    <li class="page-item"><a class="page-link" href="#">3</a></li>
					    <li class="page-item">
					      <a class="page-link" href="#">></a>
					    </li>
					  </ul>
					</nav>
				</div>	
			</section>
		</div>
	</section>	

	<!--===========================
	=            footer           =
	============================-->	
	<section>
		<div class="bg-info p-3 text-center text-white">
			<h6>VenixCode Copyright ©  2021 Derechos Reservados</h6>
		</div>
	</section>	


	<!-- Modal new IMG-->
	<div class="modal fade" id="newImg" tabindex="-1" role="dialog" aria-labelledby="newImgTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="newImgTitle">Nueva Foto</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		    <div class="row">
		    	<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">

		    		<div class="input-group mb-3">
					  <div class="custom-file">
					    <input type="file" class="custom-file-input" id="imgNew" aria-describedby="inputGroupFileAddon04">
					    <label class="custom-file-label" for="imgNew" data-browse="Buscar">Buscar Imagen</label>
					  </div>
					</div>

		    		<img src="{{asset('img/app/blue_photo.svg')}}" class="img-fluid" alt="" style="max-height: 400px;">
		    		<!-- <img src="img/app/p1.jpg" alt="" style="height: 400px;"> -->

		    	</div>
		    	<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
		    		<div class="row">
		    			<div class="col-12">
			    			<label for="txtTitulo" class="font-weight-normal">Titulo</label>
							<div class="input-group mb-3">
							  <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" aria-describedby="txtTitulo" placeholder="Escribe un titulo">
							</div>
						</div>	
		    			<div class="col-12">
			    			<label for="txtPlabrasClave" class="font-weight-normal">Palabras Clave</label>
							<div class="input-group mb-3">

							  <input type="text" class="form-controls" id="txtPlabrasClave" name="txtPlabrasClave" value="" data-role="tagsinput" data-role="tagsinput" value="" placeholder="Palabra clave">
							</div>
						</div>
		    			<div class="col-12">
			    			<label for="txtHistoria" class="font-weight-normal">Historia</label>
							<div class="input-group mb-3">
							  <textarea name="txtHistoria" id="txtHistoria" name="txtHistoria" cols="30" rows="6" class="form-control" placeholder="Cuenta la historia de tu fotografia"></textarea>
							</div>
						</div>	
		    		</div>
		    	</div>
		    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-success" onclick="savePhoto()">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal show IMG-->
	<div class="modal fade" id="showImg" tabindex="-1" role="dialog" aria-labelledby="newImgTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-uppercase" id="showImgTitle">Detalle de Foto</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		    <div class="row">
		    	<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
		    		<img src="{{asset('img/fotos/img4.jpg')}}" class="img-fluid" alt="" style="height: 400px;">
		    	</div>
		    	<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
		    		<div class="row">
		    			<div class="col-12">				 
							 <h3 class="display-4" id="titleImg">Mi primer Viaje</h3>		    			
						</div>
						<div class="col-12">
							 <label id="fechaImg" class="text-muted"> <small>Hace 6 dias</small></label>
						</div>	
		    			<div class="col-12">
			    			 <label  id="palabrasClave" >
							  	<span class="badge badge-pill border border-info px-2 py-1">Rio</span>
							  	<span class="badge badge-pill border border-info px-2 py-1">Lago</span>
							  	<span class="badge badge-pill border border-info px-2 py-1">Naturaleza</span>
							  </label>
						</div>
		    			<div class="col-12">
						<hr class="m-0 p-0">
			    			<!-- <textarea class="text-sans mt-1" id="historyImg" ></textarea> -->
			    			<textarea name="pueb" id="" cols="30" rows="10" class="form-control text-sans">Un león que vagaba por el bosque se clavó una espina en la pata, y al encontrar un pastor, le pidió que se la extrajera. 

El pastor lo hizo, y el león, que estaba saciado porque acababa de devorar a otro pastor, siguió su camino sin hacerle daño. Algún tiempo después, el pastor fue condenado, a causa de una falsa acusación, a ser arrojado a los leones en el anfiteatro. Cuando las fieras estaban por devorarlo, una de ellas dijo:
—Este es el hombre que me sacó la espina de la pata.

Al oír esto, los otros leones honorablemente se abstuvieron, y el que habló se comió él solo al Pastor.
			    			</textarea>
						</div>	
		    		</div>
		    	</div>
		    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- script -->
	<script src="{{asset('js/script.js')}}"></script>
</body>
</html>