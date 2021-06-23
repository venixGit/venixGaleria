
// $('#txtPlabrasCredito').tagsinput({
//   itemText: 'label'
// });

function savePhoto(){
	let palabras = $("#txtPlabrasClave").val();
	console.log("palabras", palabras.split(','));
}

function showPhoto(control){
	$('#showImg').modal('show');
	console.log("control", control);
}

function previewPhoto() {
   imgPhoto.src=URL.createObjectURL(event.target.files[0]);
}