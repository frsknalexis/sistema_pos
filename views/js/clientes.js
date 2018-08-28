/*==================================================
EDITAR CLIENTES
==================================================*/
$(document).on("click", ".btnEditarClientes", function() {

	var idCliente = $(this).attr("idCliente");
	console.log("idCliente", idCliente);

	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({
		url: "ajax/ClientesAjax.php",
		method: "POST",
		dataType: "json",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			console.log("respuesta", respuesta);
			$("#editarCliente").val(respuesta['nombre_cliente']);
			$("#editarDni").val(respuesta['documento']);
			$("#editarEmail").val(respuesta['email']);
			$("#editarTelefono").val(respuesta['telefono']);
			$("#editarDireccion").val(respuesta['direccion']);
			$("#editarFechaNacimiento").val(respuesta['fecha_nacimiento']);
			$("#idCliente").val(respuesta['id_cliente']);

		}

	});
});

/*====================================================
ELIMINAR CLIENTES
====================================================*/
$(document).on("click", ".btnEliminarClientes", function() {

	var idCliente = $(this).attr("idCliente");
	console.log("idCliente", idCliente);

	swal({
		title: "¿Esta Seguro de Eliminar el Cliente?",
		text: "¡Si no lo esta, puede Cancelar la accion!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Si, eliminar Cliente!"

	}).then((result) => {
		if(result.value) {

			window.location = 'index.php?ruta=clientes&idCliente='+idCliente;

		}
	});

});