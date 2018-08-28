/*=============================================
	SUBIENDO LA FOTO DEL USUARIO
 ============================================*/
$('.nuevaFoto').change(function() {

	var imagen = this.files[0];

	/*========================================
	  VALIDANDO QUE EL FORMATO DE LA IMAGEN SEA
	  JPG O PNG
	=========================================*/
	if(imagen['type'] != 'image/jpeg' && imagen['type'] != 'image/png') {

		$('.nuevaFoto').val("");

		swal({
			title: "Error al subir la Imagen",
			text: "¡La Imagen debe estar en formato JPEG o PNG",
			type: 'error',
			confirmButtonText: "¡Cerrar!"

		});
	}
	else if(imagen['size'] > 2000000) {

		$('.nuevaFoto').val("");

		swal({
			title: "Error al subir la Imagen",
			text: "¡La Imagen no debe pesar mas de 2MB",
			type: 'error',
			confirmButtonText: "¡Cerrar!"
		});
	}
	else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event) {

			var rutaImagen = event.target.result;
			$('.previsualizar').attr("src", rutaImagen);


		});




	}
});

/*=============================================
	EDITAR USUARIO
 ============================================*/
$(document).on("click", ".btnEditUsuarios", function(){

 	var idUsuario = $(this).attr("idUsuario");
 	console.log("idUsuario", idUsuario);
 	var datos = new FormData();
 	datos.append("idUsuario", idUsuario);

 	$.ajax({
 		url: "ajax/UsuariosAjax.php",
 		method: "POST",
 		dataType: "json",
 		data: datos,
 		cache: false,
 		contentType: false,
 		processData: false,
 		success: function(respuesta) {
 			console.log("respuesta", respuesta);
 			$('#editarNombre').val(respuesta['nombre']);
 			$('#editarUsuario').val(respuesta['usuario']);
 			$('#editarPerfil').html(respuesta['perfil']);
 			$('#editarPerfil').val(respuesta['perfil']);
 			$('#passwordActual').val(respuesta['password']);
 			$('#fotoActual').val(respuesta['foto']);

 			if(respuesta['foto'] != "") {

 				$('.previsualizar').attr("src", respuesta['foto']);
 			}
 		}
 	});
 });

/*==============================================
ACTIVAR USUARIO
==============================================*/
$(document).on("click", ".btnActivar", function() {

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({

		url: "ajax/UsuariosAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {


		}

	});

	if(estadoUsuario == 0) {

		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		$(this).html("Desactivado");
		$(this).attr('estadoUsuario', 1);
	}
	else {

		$(this).removeClass("btn-danger");
		$(this).addClass("btn-success");
		$(this).html("Activado");
		$(this).attr('estadoUsuario', 0);
	}

});

/*===========================================
REVISAR SI EL USUARIO YA ESTA REGISTRADO
===========================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();
	console.log("usuario", usuario);

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	$.ajax({

		url: "ajax/UsuariosAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			if(respuesta) {

				console.log("respuesta", respuesta);
				$('#nuevoUsuario').parent().after('<div class="alert alert-warning">Este Usuario ya existe en la Base de Datos</div>');
				$('#nuevoUsuario').val("");
			}
		}
	})
});

/*$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/UsuariosAjax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})*/

/*====================================================
ELIMINAR USUARIO
====================================================*/
$(document).on("click",".btnEliminarUsuarios", function() {

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("Usuario");

	swal({
		title: '¿Esta Seguro de Eliminar el Usuario?',
		text: '¡Si no lo esta puede Cancelar la accion!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: '¡Si, eliminar Usuario!'


	}).then((result) => {
		if(result.value) {

			window.location = 'index.php?ruta=usuarios&Usuario='+usuario+'&idUsuario='+idUsuario+'&fotoUsuario='+fotoUsuario;
		}
	});
});