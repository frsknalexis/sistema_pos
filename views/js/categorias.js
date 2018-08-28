/*=====================================================
 EDITAR CATEGORIAS
=====================================================*/
$(document).on("click", ".btnEditarCategoria", function() {

	var idCategoria = $(this).attr("idCategoria");

	console.log("idCategoria", idCategoria);

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		url: "ajax/CategoriasAjax.php",
		method: "POST",
		dataType: "json",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {
			console.log("respuesta", respuesta);
			$('#editarCategoria').val(respuesta['nombre_categoria'])
			$('#idCategoria').val(respuesta['id_categoria']);
		}
	});
});

/*=======================================================
ELIMINAR CATEGORIA
=======================================================*/
$(document).on("click", ".btnEliminarCategorias", function() {

	var idCategoria = $(this).attr("idCategoria");

	swal({
		title: "¿Esta Seguro de Eliminar la Categoria?",
		text: '¡Si no lo esta puede Cancelar la accion!',
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Si, eliminar Categoria!"
	
	}).then((result) => {
		if(result.value) {

			window.location = 'index.php?ruta=categorias&idCategoria='+idCategoria;

		}

	});
})

/*=========================================================
REVISAR SI LA CATEGORIA YA ESTA REGISTRADA
=========================================================*/
$("#nuevaCategoria").change(function() {

	$(".alert").remove();

	var categoria = $(this).val();
	console.log("categoria", categoria);

	var datos = new FormData();
	datos.append("validarCategoria", categoria);

	$.ajax({

		url: "ajax/CategoriasAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			if(respuesta) {

				console.log("respuesta", respuesta);
				$('#nuevaCategoria').parent().after('<div class="alert alert-warning">Esta Categoria ya existe en la Base de Datos</div>');
				$('#nuevaCategoria').val("");
			}
		}
	});
})