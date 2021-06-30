
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
	console.log("idArticulo", idArticulo);
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
				var posicion = cadena.length;
				console.log("posicion", posicion);

				for (var i = 0; i < posicion; i++) {
			    // console.log(arr[i]);
			    $('#txtMostrarPalabra').html(cadena[i]);
			    console.log("cadena[i]", cadena[i]);
			  }
				// $.each(cadena, function(index,value){
				// 	$('#txtMostrarPalabra').val(value);
				//   console.log( index + " : " + value );
				//   console.log($('#txtMostrarPalabra').html(value));
				// });


				// console.log("respuesta[index].palabras_clave_articulo", respuesta.palabras_clave_articulo);
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