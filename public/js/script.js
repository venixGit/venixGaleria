
// $('#txtPlabrasCredito').tagsinput({
//   itemText: 'label'
// });

function savePhoto(){
	let palabras = $("#txtPlabrasClave").val();
	console.log("palabras", palabras.split(','));
}

// console.log("$('#_token').val()", $('#_token').val());
function showPhoto(idArticulo){	 
	var datos = new FormData();
	datos.append("idArticulo", idArticulo);
	datos.append("_token", $('#_token').val());
	// console.log("idArticulo", idArticulo);
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
				
				var cadena = respuesta.palabras_clave_articulo.split(",");
				var posicion = cadena.length;
				console.log("cadena: ", posicion);

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