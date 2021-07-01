
/**
 * En esta funcion lo que estoy haciendo es validar cada input, a su vez validar que el tamaño y tipo de archivo
 * sea el especifico para una imagen, tambien se detiene el evento submit con event,preventDefault(), 
 * y cuando todo este correcto que vuelva a ejecutar el evento
 * @return {[type]} [description]
 */
function savePhoto(){
	let palabras = $("#palabras_clave").val();
/*=============================================
=            Validacion de inputs          =
=============================================*/
	if ($("#titulo").val() == "") {
		event.preventDefault();
		Swal.fire({
	  icon: 'error',
	  title: 'Requerido',
	  text: '¡El titulo es requerido!',
		})

	}else	if ($("#palabras_clave").val() == "") {
		event.preventDefault();
		Swal.fire({
	  icon: 'error',
	  title: 'Requerido',
	  text: '¡Ingrese al menos una palabra clave!',
		})

	}
	else	if ($("#historia").val() == "") {
		event.preventDefault();
		Swal.fire({
	  icon: 'error',
	  title: 'Requerida',
	  text: '¡La historia de la fotografía es requerida!',
		})

	}else{
		Swal.fire({
         icon: 'success',
         title: 'Su fotografía ha sido guardada correctamente',
         showConfirmButton: false,
         timer: 2000 
     })
		// estoy llamando al id del form de la vista
		document.getElementById('guardarImagen').submit();
	}


	if ($("#imagen").val() == "") {
			event.preventDefault();
			Swal.fire({
		  icon: 'error',
		  title: 'Requerida',
		  text: '¡La imagen es requerida!',
			})

		}else{

		/*=============================================
		=        Cargando la imagen temporal           =
			=============================================*/		
			
		// if ($('.nuevaImagen').val() != "") {
			event.preventDefault();
			// console.log("Hay una imagen");

			var imagen = $('#imagen')[0].files[0];
			// console.log("la imagen es imagen", imagen);

			/*=========================================================
			=            Validando tipo y tamaño de imagen            =
			=========================================================*/			
			
			if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
					event.preventDefault();
		   		$('.nuevaImagen').val("");
		      Swal.fire({
		        position: "center",
		        icon: "error",
		        title: "Error al subir la imagen",
		        text: "¡La imagen debe estar en formato JPG o PNG!",
		        showConfirmButton: true,
		        confirmButtonText: "¡Cerrar!",
		      });

		  	}else if (imagen["size"] > 3000000) {
		  		event.preventDefault();
		    	$('.nuevaImagen').val("");
		      Swal.fire({
		        position: "center",
		        icon: "error",
		        title: "Error al subir la imagen",
		        text: "¡La imagen no debe pesar más de 5MB!",
		        showConfirmButton: true,
		        confirmButtonText: "¡Cerrar!",
		      });
		    }else{
		    	event.preventDefault();
		    	var datosImagen = new FileReader();
					datosImagen.readAsDataURL(imagen);
		      $(datosImagen).on("load", function (event) {
		        var rutaImagen = event.target.result;
		        $(".verFoto").attr("src", rutaImagen);
		      });	
		    }

		}
}

// console.log("$('#_token').val()", $('#_token').val());
function showPhoto(idArticulo){	 
	/*================================================
	=            MOSTRAR DETALLE DE FOTOS            =
	================================================*/
	
	var datos = new FormData();
	datos.append("idArticulo", idArticulo);
	datos.append("_token", $('#_token').val());
	// console.log("idArticulo de primer tarjeta", idArticulo);
	$.ajax({
		url: "/detalle",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			console.log("respuesta", respuesta);
			if (respuesta != "NO") {
				$('#titleModalSpan').html(respuesta.titulo_articulo);
				$('#titleImg').html(respuesta.titulo_articulo);
				$('#fechaImg').html(respuesta.fecha);
				$('#textHistoriaArticulo').val(respuesta.historia_articulo);
				
				//separando mis palabras claves
				var cadena = respuesta.palabras_clave_articulo.split(",");
				console.log("cadena", cadena);
				var posicion = cadena.length;

				cadena.forEach(añadirPalabras);
				function añadirPalabras(datos, index){
					let span = `<span class="badge badge-pill border border-info px-2 py-1">`+ '#' + datos +`</span>`;
					$('#palabrasClave').append(span);
				}
				// $.map(cadena, function(index,v){

				// 		let span = `<span class="badge badge-pill border border-info px-2 py-1">`+ '#' + index.v +`</span>`;
				// 		console.log("index", index);
				// 		$('#palabrasClave').append(span);
				// 		console.log("span", span);

				// });
				
				// console.log("posicion", posicion);
			 	// for (var i = 0; i < posicion; i++) {
				 //   // $('#txtMostrarPalabra').text(cadena[1]);
				 //   let mostrarEspan = `<span class="badge badge-pill border border-info px-2 py-1">`+ '#' +respuesta.palabras_clave_articulo.split(",") +`</span>`;
				 //   	$('#palabrasClave').append(mostrarEspan);
				 //   console.log("cadena[i]", cadena[i]);
			  // 	}

		
				$('#imgMostrarFoto').attr('src','/mostrarImg?img='+respuesta.img_articulo);
				$('#showImg').modal('show');
			}else{
				console.log("upps ha ocurrido un error");
			}
		},
	});
}

function mostrarFotoInicio(idImagen){
	console.log("idImagen", idImagen);
}

function previewPhoto() {
   imgPhoto.src=URL.createObjectURL(event.target.files[0]);
}