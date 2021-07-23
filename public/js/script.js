/**
 * Una funcion encargada de mostrar un titulo a mi modal, de insertar
 * ademas en el id de mi form le mando la ruta del action para que cada vez que se presione el boton
 *
 */
function showModalNewImg(){
	let tag = event.item;
	$("#newImgTitle").html("Nueva Foto");
	$("#saveImagen").html("Guardar");
	$("#frmGuardarImagen").attr("action", "/savefotos");

	$("#titulo").val("");
	$("#palabras_clave").tagsinput('removeAll');
	$("#historia").val("");

	$("#newImg").modal("show");
}

/**
 * En esta funcion lo que estoy haciendo es validar cada input, a su vez validar que el tamaño y tipo de archivo
 * sea el especifico para una imagen, tambien se detiene el evento submit con event,preventDefault(),
 * y cuando todo este correcto que vuelva a ejecutar el evento
 * @return {[type]} [description]
 */
function savePhoto(){
	let palabras = $("#palabras_clave");
	let imagen = $("#imagen");
	let titulo = $("#titulo");
	let historia = $("#historia");
/*=============================================
=            Validacion de inputs          =
=============================================*/
	if ($("#imagen").val() == '' && $('#urlOldFoto').val() == '') {
		//addClass me mostrar que input esta con el error
			imagen.addClass('is-invalid');
			Swal.fire({
				  icon: 'error',
				  title: 'Requerida',
				  text: '¡La imagen es requerida!',
			})
			return false;
		}else{
			//me limpia los inputs
			imagen.removeClass('is-invalid');
		}

	if ($("#titulo").val() == '') {
		titulo.addClass('is-invalid');
		Swal.fire({
			  icon: 'error',
			  title: 'Requerido',
			  text: '¡El titulo es requerido!',
		})
		return false;

	}else{
			titulo.removeClass('is-invalid');
	}

	if (palabras.val() == "") {
		palabras.addClass('is-invalid');
		Swal.fire({
			  icon: 'error',
			  title: 'Requerido',
			  text: '¡Ingrese al menos una palabra clave!',
		})
		return false;

	}else{
		palabras.removeClass('is-invalid');
	}

	if ($("#historia").val() == "") {
		historia.addClass('is-invalid');
		Swal.fire({
			  icon: 'error',
			  title: 'Requerida',
			  text: '¡La historia de la fotografía es requerida!',
		})
		return false;

	}else{
		palabras.removeClass('is-invalid');
	}

		Swal.fire({
				  title: '¿Está seguro?',
				  text: "¡Confirma sí desea publicar la fotografía!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#17A2B8',
				  cancelButtonColor: '#d33',
				  confirmButtonText: '¡Sí, publicar!'
				}).then((result) => {
				  if (result.isConfirmed) {

				  	let formulario = document.getElementById("frmGuardarImagen");
				  	formulario.submit();

				  }
				})
}


// console.log("$('#_token').val()", $('#_token').val());
function showPhoto(idFotografia, fecha){
	console.log("fecha diff", fecha);
	/*================================================
	=            MOSTRAR DETALLE DE FOTOS            =
	================================================*/

	let datos = new FormData();
	// datos.append("idfoto", idArticulo);
	datos.append("idFotografia", idFotografia);
	datos.append("_token", $('#_token').val());
	console.log("idFotografia de primer tarjeta", idFotografia);
	$.ajax({
		// url: "{{route('mostraDetalle')}}",
		url: "/detalle",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (resp) {
			let respuesta = resp.detalleFotos;
			let fecha = resp.fecha;
			console.log("fecha", fecha);
			console.log("respuesta", respuesta);
			// console.log("resp", resp);
			if (respuesta != "NO") {
				$('#idFotoUpdate').val(respuesta.id_foto);
				$('#idFotoDelete').val(respuesta.id_foto);
				console.log("$('#idFotoDelete')", $('#idFotoDelete').val());
				$('#urlOldFoto').val(respuesta.img_foto);
				// console.log("$('#idOldFoto')", $('#urlOldFoto'));
				// if (true) {}
				// console.log("idOld", idOld);
				// console.log("$('#idFotoUpdate')", $('#idFotoUpdate').val());
				// console.log("respuesta.id_foto", respuesta.id_foto);
				$('#titleModalSpan').html(respuesta.titulo_foto);
				$('#titleImg').html(respuesta.titulo_foto);
				// let fecha = respuesta.updated_at;
				$('#fechaImg').html(fecha);
				$('#textHistoriaFoto').val(respuesta.historia_foto);

				//obtengo las palabras claves de la tabla relacionada
				let palabras = respuesta.palabras_claves;

				// Limpia el div de palabras clave
				$('#palabrasClave').empty();
				//recorro dentro de un foreach el arreglo de las palabras que mando desde el controlador
				palabras.forEach(añadirPalabras);
				function añadirPalabras(datos, index){
					let span = `<span class="badge badge-pill border border-info px-2 py-1">`+ '#' + datos.nombre +`</span>`;
					$('#palabrasClave').append(span);
				}

				$('#imgMostrarFoto').attr('src','/mostrarImg?img='+respuesta.img_foto);
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
   // imgPhoto.src=URL.createObjectURL(event.target.files[0]);
   //
		var imagen = $('#imagen')[0].files[0];
	// console.log("la imagen es imagen", imagen);

	/*=========================================================
	=            Validando tipo y tamaño de imagen            =
	=========================================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

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

    	var datosImagen = new FileReader();
			datosImagen.readAsDataURL(imagen);
      $(datosImagen).on("load", function (event) {
        var rutaImagen = event.target.result;
        $(".verFoto").attr("src", rutaImagen);
      });
    }
}

function editarModal(){

  let idFotoDetalle = document.getElementById('idFotoUpdate').value;
	$("#newImgTitle").html("Editar Foto");
	$("#saveImagen").html("Actualizar Foto");
	$('#showImg').modal('hide');
	$("#frmGuardarImagen").attr("action", "/updateFoto");

  let datos = new FormData();
  datos.append("idFotoDetalle", idFotoDetalle);
  datos.append("_token", $('#_token').val());
  console.log('idFoto del detalle: ', idFotoDetalle);
	// Limpia el div de palabras clave
	$('#palabras_clave').tagsinput('removeAll');
  $.ajax({
		// url: "{{route('mostraDetalle')}}",
		url: "/editarDetalle",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (resp) {
			let respuesta = resp.editarDetalleFoto;
			console.log("respuesta editar", respuesta);
			// console.log("resp", resp);
			if (respuesta != "NO") {
				$('#imgPhoto').attr('src','/mostrarImg?img='+respuesta.img_foto);
				$('#titulo').val(respuesta.titulo_foto);
				let palabras = respuesta.palabras_claves;
				// console.log("palabras", palabras[2]['nombre']);
				// console.log("palabras nombre", palabras.nombre);
				palabras.forEach(añadirPalabras);
				function añadirPalabras(datos, index){
					let pal = datos.nombre;
					// console.log("datos", datos.nombre);
					// let span = `<span class="badge badge-pill border border-info px-2 py-1">`+ '#' + datos.nombre +`</span>`;

					$('#palabras_clave').tagsinput('add', pal);
				}
				$('#historia').val(respuesta.historia_foto);
			}else{
				console.log("upps ha ocurrido un error");
			}
		},
	});

	// if ($('#idFotoUpdate').val() != "") {

	// 	console.log('hay un id');
	// 	console.log('id de foto:', idFotoDetalle);
	// }
	// console.log("idFotoDetalle", idFotoDetalle);
}

function eliminaPhoto(){
	Swal.fire({
				  title: '¿Está seguro?',
				  text: "¡Confirma sí desea eliminar la fotografía!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#17A2B8',
				  cancelButtonColor: '#d33',
				  confirmButtonText: '¡Sí, Eliminar!'
				}).then((result) => {
				  if (result.isConfirmed) {

				  	let formulario = document.getElementById("frmDeletePhoto");
				  	formulario.submit();

				  }
				})
}
