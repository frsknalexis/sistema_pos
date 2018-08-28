/*========================================================
CARGAR LA TABLA DINAMICA
========================================================*/

var table = $(".tablaProductos").DataTable({

	"ajax": "ajax/DataTableProductosAjax.php",
	"columnDefs": [{

		"targets": -1,
		"data": null,
		"defaultContent": '<div class="btn-group"><button class="btn btn-warning btnEditarProducto" idProducto data-toggle="modal" data-target="#modalEditarProducto"><i class="fa fa-pencil" title="Editar"></i></button><button class="btn btn-danger btnEliminarProducto" idProducto codigoProducto imagenProducto><i class="fa fa-close" title="Eliminar"></i></button></div>'
	},
	{
		"targets": -9,
		"data": null,
		"defaultContent": '<img src="" class="img-thumbnail imgTabla" width="40px">'
	}
	],
	"language": {
 		"sProcessing": "Procesando...",
 		"sLengthMenu": "Mostrar _MENU_ registros",
 		"sZeroRecords": "No se encontraron resultados",
 		"sEmptyTable": "Ningun dato disponible en esta tabla",
 		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
 		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
 		"sInfoFiltered": "(filtrado de un total _MAX_ registros)",
 		"sInfoPostFix": "",
 		"sSearch": "Buscar:",
 		"sUrl": "",
 		"sInfoThousands": ",",
 		"sLoadingRecords": "Cargando...",
 		"oPaginate": {
 			"sFirst": "Primero",
 			"sLast": "Ultimo",
 			"sNext": "Siguiente",
 			"sPrevious": "Anterior"
 		},
 		"oAria": {
 			"sSortAscending": "Activar para ordenar la columna de manera ascendente",
 			"sSortDescending": "Activar para ordenar la columan de manera descendente"
 		}


 	}

});

/*===========================================================
ACTIVAR BOTONES CON LOS ID'S CORRESPONDIENTES
===========================================================*/
  $('.tablaProductos tbody').on( 'click', 'button', function () {

  	if(window.matchMedia("(min-width:992px)").matches) {

  		var data = table.row( $(this).parents('tr') ).data();

  	}

  	else {

  		var data = table.row( $(this).parents("tbody tr ul li")).data();
  	}
        
        
        $(this).attr("idProducto", data[9]);
        $(this).attr("codigoProducto", data[2]);
        $(this).attr("imagenProducto", data[1]);        

    } );


/*==========================================================
FUNCION PARA CARGAR LAS IMAGENES
==========================================================*/

function cargarImagenes() {

	var imgTab = $(".imgTabla");

	for(var i=0; i < imgTab.length; i++) {

		var data = table.row($(imgTab[i]).parents("tr")).data();

		$(imgTab[i]).attr("src", data[1]);
	}


}

/*=========================================================
CARGAMOS LAS IMAGENES CUANDO ENTRAMOS A LA PAGINA POR PRIMERA VEZ
=========================================================*/
setTimeout(function() {

	cargarImagenes();

},3000)

/*=========================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL PAGINADOR
=========================================================*/

$(".dataTables_paginate").click(function() {

	cargarImagenes();
})

/*=========================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL BUSCADOR
=========================================================*/
$("input[aria-controls='DataTables_Table_0']").focus(function() {

	$(document).keyup(function(event) {

		event.preventDefault();
		cargarImagenes();

	});
});

/*=========================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL FILTRO 
DE CANTIDAD
=========================================================*/
$("select[name='DataTables_Table_0_length']").change(function() {

	cargarImagenes();
});

/*=========================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL FILTRO 
DE ORDENAR
=========================================================*/
$(".sorting").click(function() {
	cargarImagenes();
});

/*==========================================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CODIGO
==========================================================*/
$("#nuevaCategoria").change(function() {

	var idCategoria = $(this).val();

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/ProductosAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			if(!respuesta) {

				var nuevoCodigo = idCategoria+"01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			else {

					var nuevoCodigo = Number(respuesta["codigo"]) + 1;
			        $("#nuevoCodigo").val(nuevoCodigo);
			}

		}

	})


});

/*==========================================================
AGREGANDO PRECIO DE VENTA
==========================================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function() {

	if($(".porcentaje").prop("checked")) {

		var valorPorcentaje = $(".nuevoPorcentaje").val();
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
		var porcentajeEditado = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
	    console.log("porcentaje", porcentaje);
	    $("#nuevoPrecioVenta").val(porcentaje);
	    $("#nuevoPrecioVenta").prop("readonly", true);

	    $("#editarPrecioVenta").val(porcentajeEditado);
	    $("#editarPrecioVenta").prop("readonly", true);
	}

	
});

/*============================================================
CAMBIO DE PORCENTAJE
============================================================*/
$(".nuevoPorcentaje").change(function() {

	if($(".porcentaje").prop("checked")) {

		var valorPorcentaje = $(this).val();
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
		var porcentajeEditado = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly", true);

		$("#editarPrecioVenta").val(porcentajeEditado);
		$("#editarPrecioVenta").prop("readonly", true);

	}
});

$(".porcentaje").on("ifUnchecked", function() {

	$("#nuevoPrecioVenta").prop("readonly", false);
	$("#editarPrecioVenta").prop("readonly", false);
});

$(".porcentaje").on("ifChecked", function() {

	$("#nuevoPrecioVenta").prop("readonly", true);
	$("#editarPrecioVenta").prop("readonly", true);
});

/*========================================================
SUBIENDO LA FOTO DEL PRODUCTO
========================================================*/
$(".nuevaImagen").change(function() {

	var imagen = this.files[0];

	/*==================================================
	VALIDANDO QUE E FORMATO DE LA IMAGEN SEA JPG O PNG
	==================================================*/
	if(imagen['type'] != 'image/jpeg' && imagen['type'] != 'image/png') {

		$(".nuevaImagen").val("");

		swal({
			type: 'error',
			title: "Error al Subir la Imagen",
			text: "¡La Imagen debe estar en formato JPEG o PNG!",
			confirmButtonText: "¡Cerrar!"
		});

	}
	else if(imagen['size'] > 2000000) {

		$(".nuevaImagen").val("");

		swal({
			type: "error",
			title: "Error al Subir la Imagen",
			text: "¡La Imagen no puede pesar mas de 2MB!",
			confirmButtonText: "¡Cerrar!"
		});
	}
	else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event) {

			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen);

		});
	}

});


/*==========================================================
EDITAR PRODUCTOS
==========================================================*/
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function() {

	var idProducto = $(this).attr("idProducto");
	console.log("idProducto", idProducto);

	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({
		url: "ajax/ProductosAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			console.log("respuesta", respuesta);

			var datosCategoria = new FormData();
			datosCategoria.append("idCategoria", respuesta['id_categoria']);

			$.ajax({
				url: "ajax/CategoriasAjax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {
					console.log("respuesta", respuesta);
					$("#editarCategoria").val(respuesta['id_categoria']);
					$("#editarCategoria").html(respuesta['nombre_categoria']);
				}
			});

			$("#editarCodigo").val(respuesta['codigo']);
			$("#editarDescripcion").val(respuesta['descripcion']);
			$("#editarStock").val(respuesta['stock']);
			$("#editarPrecioCompra").val(respuesta['precio_compra']);
			$("#editarPrecioVenta").val(respuesta['precio_venta']);

			if(respuesta['imagen'] != "") {

				$("#imagenActual").val(respuesta['imagen']);
				$(".previsualizar").attr("src", respuesta['imagen']);


			}
			


		}
	});
});

/*===========================================================
ELIMINAR PRODUCTOS
===========================================================*/
$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function() {

	var idProducto = $(this).attr("idProducto");
	var codigoProducto = $(this).attr("codigoProducto");
	var imagenProducto = $(this).attr("imagenProducto");

	swal({
		title: '¿Esta Seguro de Eliminar el Producto?',
		text: '¡Si no lo esta puede Cancelar la accion!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: '¡Si, eliminar Producto!'
	}).then((result) => {
		window.location = 'index.php?ruta=productos&idProducto='+idProducto+'&codigoProducto='+codigoProducto+'&imagenProducto='+imagenProducto;
	});
});
