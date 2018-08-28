/*=================================================
CARGAR LA TABLA DINAMICA
=================================================*/

var table2 = $(".tablaVentas").DataTable({

	"ajax": "ajax/DataTableVentasAjax.php",
	"columnDefs": [{

		"targets": -1,
		"data": null,
		"defaultContent": '<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idProducto><i class="fa fa-plus" title="Agregar"></i> Agregar</button></div>'
	},
	{
		"targets": -2,
		"data": null,
		"defaultContent": '<div class="btn-group"><button class="btn btn-success limiteStock"></button></div>'

	},
	{
		"targets": -5,
		"data": null,
		"defaultContent": '<img src="" class="img-thumbnail imgTablaVenta" width="40px">'
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

/*========================================================
ACTIVAR BOTONES CON LOS ID'S CORRESPONDIENTES
========================================================*/
$(".tablaVentas tbody").on("click", "button.agregarProducto", function() {

	if(window.matchMedia("(min-width:992px)").matches) {

  		var data = table2.row( $(this).parents('tr') ).data();

  	}

  	else {

  		var data = table2.row( $(this).parents("tbody tr ul li")).data();

  	}	

  	$(this).attr("idProducto", data[5]);
});

/*=================================================
FUNCION PARA CARGAR LAS IMAGENES
=================================================*/
function cargarImagenesProductos() {

	var imgTab = $(".imgTablaVenta");

	var limiteStock = $(".limiteStock");

	for(var i=0; i < imgTab.length; i++) {

		var data = table2.row($(imgTab[i]).parents("tr")).data();

		$(imgTab[i]).attr("src", data[1]);

		if(data[4] <= 10) {

			$(limiteStock[i]).addClass("btn-danger");
			$(limiteStock[i]).html(data[4]);

		}
		else if(data[4] > 11 && data[4] <= 15) {

			$(limiteStock[i]).addClass("btn-warning");
			$(limiteStock[i]).html(data[4]);
		}
		else {

			$(limiteStock[i]).addClass("btn-success");
			$(limiteStock[i]).html(data[4]);
		}
	}

}

/*=================================================
CARGAMOS LAS IMAGENES CUANDO ENTRAMOS A LA PAGINA
POR PRIMERA VEZ
=================================================*/
setTimeout(function() {

	cargarImagenesProductos();
}, 3000)

/*=========================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL PAGINADOR
=========================================================*/

$(".dataTables_paginate").click(function() {

	cargarImagenesProductos();

});
/*=========================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL BUSCADOR
=========================================================*/
$("input[aria-controls='DataTables_Table_0']").focus(function() {

	$(document).keyup(function(event) {

		event.preventDefault();
		cargarImagenesProductos();
	})
});

/*========================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL FILTRO
DE CANTIDAD
========================================================*/
$("select[name='DataTables_Table_0_length']").change(function() {
	cargarImagenesProductos();
});

/*=======================================================
CARGAMOS LAS IMAGENES CUANDO INTERACTUAMOS CON EL FILTRO
DE ORDENAR
=======================================================*/
$(".sorting").click(function() {
	cargarImagenesProductos();
});

/*=======================================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=======================================================*/
$(".tablaVentas tbody").on("click", "button.agregarProducto", function() {

	var idProducto = $(this).attr("idProducto");
	
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");

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
			var descripcion = respuesta['descripcion'];
			var stock = respuesta['stock'];
			var precio_venta = respuesta['precio_venta'];

			$(".nuevoProducto").append('<div class="row" style="padding:5px 15px">'+
				'<div class="col-xs-6" style="padding-right: 0px;">'+
				'<div class="input-group">'+
				'<span class="input-group-addon">'+
				'<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'">'+
				'<i class="fa fa-times"></i></button></span>'+
				'<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
				'</div></div>'+
				'<div class="col-xs-3 ingresoCantidad">'+
				'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
				'</div>'+
				'<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="ion ion-social-usd"></i></span>'+
				'<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio_venta+'" name="nuevoPrecioProducto" value="'+precio_venta+'" readonly required>'+
				'</div></div></div>');

			//SUMAR TOTAL DE PRECIOS

			sumarTotalPrecios();
			//AGREGAR IMPUESTO
			agregarImpuesto();
			//PONER FORMATO AL PRECIO DE LOS PRODUCTOS
			$(".nuevoPrecioProducto").number(true, 2);
			//AGRUPAR PRODUCTOS EN JSON
			listarProductos();
		}
	})
});
/*===================================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTON
===================================================*/
$(".formularioVenta").on("click", "button.quitarProducto", function() {

	$(this).parent().parent().parent().parent().remove();
	var idProducto = $(this).attr("idProducto");
	
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass("btn-default");
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

	if($(".nuevoProducto").children().length == 0) {

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total", 0);

	}
	else {

		//SUMARL TOTAL DE PRECIOS

		sumarTotalPrecios();

		//AGREGAR IMPUESTO
		agregarImpuesto();

		//AGRUPAR PRODUCTOS EN JSON
		listarProductos();

	}

	
});
/*===================================================
AGREGANDO PRODUCTOS DESDE EL BOTON PARA DISPOSITIVOS
===================================================*/
$(".btnAgregarProducto").click(function() {

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url: "ajax/ProductosAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$(".nuevoProducto").append('<div class="row" style="padding:5px 15px">'+
				'<div class="col-xs-6" style="padding-right: 0px;">'+
				'<div class="input-group">'+
				'<span class="input-group-addon">'+
				'<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto>'+
				'<i class="fa fa-times"></i></button></span>'+
				'<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>'+
				'<option>Seleccione el Producto</option>'+
				'</select>'+
				'</div></div>'+
				'<div class="col-xs-3 ingresoCantidad">'+
				'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+
				'</div>'+
				'<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="ion ion-social-usd"></i></span>'+
				'<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal="" value="" readonly required>'+
				'</div></div></div>');

			//AGREGAR LOS PRODUCTOS AL SELECT
			respuesta.forEach(funcionForEach);

			function funcionForEach(item, index) {

				$(".nuevaDescripcionProducto").append('<option idProducto="'+item.id_producto+'" value="'+item.descripcion+'">'+item.descripcion+'</option>');
			}

			//SUMAR TOTAL PRECIOS

			sumarTotalPrecios();

			//AGREGAR IMPUESTO
			agregarImpuesto();

		
			//PONER FORMATO AL PRECIO DE LOS PRODUCTOS
			$(".nuevoPrecioProducto").number(true, 2);

		}
	});
});

/*=====================================================
SELECCIONAR EL PRODUCTO
=====================================================*/
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function() {

	var nombreProducto = $(this).val();

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
	datos.append("nombreProducto", nombreProducto);

	$.ajax({
		url: "ajax/ProductosAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			
			$(nuevaCantidadProducto).attr("stock", respuesta['stock']);
			$(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta['stock'])-1);
			$(nuevoPrecioProducto).val(respuesta['precio_venta']);
			$(nuevoPrecioProducto).attr("precioReal", respuesta['precio_venta']);

			//AGRUPAR PRODUCTOS EN JSON
			listarProductos();


		}
	});

});

/*===================================================
MODIFICAR LA CANTIDAD
===================================================*/
$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function() {

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - Number($(this).val());
	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))) {

		$(this).val(1);

		swal({
			title: "La Cantidad Supera al Stock",
			text: "¡Solo hay "+$(this).attr("stock")+" unidades!",
			type: "error",
			confirmButtonText: "¡Cerrar!" 
		});

	}

	//SUMAR TOTAL PRECIOS
	sumarTotalPrecios();
	//AGREGAR IMPUESTO
	agregarImpuesto();

	//AGRUPAR PRODUCTOS EN JSON
	listarProductos();
});

/*=======================================================
SUMAR TODOS LOS PRECIOS
=======================================================*/
function sumarTotalPrecios() {

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];

	for(var i=0; i < precioItem.length; i++) {

		arraySumaPrecio.push(Number($(precioItem[i]).val()));

	}
	function sumarArrayPrecios(total, numero) {

		return total + numero;
	}
	
	var SumaTotalPrecio = arraySumaPrecio.reduce(sumarArrayPrecios);
	$("#nuevoTotalVenta").val(SumaTotalPrecio);
	$("#totalVenta").val(SumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total", SumaTotalPrecio);
}

/*=========================================================
FUNCION AGREGAR IMPUESTO
=========================================================*/
function agregarImpuesto() {

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#totalVenta").val(totalConImpuesto);
	$("#nuevoPrecioImpuesto").val(precioImpuesto);
	$("#nuevoPrecioNeto").val(precioTotal);
}
/*=======================================================
CUANDO CAMBIA EL IMPUESTO
=======================================================*/
$("#nuevoImpuestoVenta").change(function() {

	agregarImpuesto();
});

/*====================================================
FORMATO AL PRECIO FINAL
====================================================*/
$("#nuevoTotalVenta").number(true, 2);

/*====================================================
SELECCIONAR METODO DE PAGO
====================================================*/
$("#nuevoMetodoPago").change(function() {

	var metodo = $(this).val();
	console.log("metodo", metodo);

	if(metodo == "Efectivo") {

		$(this).parent().parent().removeClass("col-xs-6");
		$(this).parent().parent().addClass("col-xs-4");
		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
			'<div class="col-xs-4">'+
			'<div class="input-group">'+
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+
			'</div></div>'+
			'<div class="col-xs-4 capturarCambioEfectivo" style="padding-left:0px;">'+
			'<div class="input-group">'+
			'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
			'<input type="text" class="form-control" id="nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="000000" readonly required>'+
			'</div></div>');

		//AGREGAR FORMATO AL PRECIO
		$("#nuevoValorEfectivo").number(true, 2);
		$("#nuevoCambioEfectivo").number(true, 2);

		//LISTAR METODO DE PAGO EN LA ENTRADA

		listarMetodos();

	}
	else {

		$(this).parent().parent().removeClass("col-xs-4");
		$(this).parent().parent().addClass("col-xs-6");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
			'<div class="col-xs-6" style="padding-left:0px;">'+
            '<div class="input-group">'+
            '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Codigo de Transaccion" required>'+
            '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
            '</div></div>');
	}
});

/*=======================================================
CAMBIO EN EFECTIVO
=======================================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function() {

	var efectivo = $(this).val();

	var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children(".capturarCambioEfectivo").children().children("#nuevoCambioEfectivo");

	nuevoCambioEfectivo.val(cambio);
});

/*=======================================================
CAMBIO DE TRANSACCION
=======================================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function() {

	//LISTAR METODO DE PAGO EN LA ENTRADA
	listarMetodos();
});

/*=======================================================
LISTAR TODOS LOS PRODUCTOS
=======================================================*/
function listarProductos() {

	var listarProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto")

	var precio_venta = $(".nuevoPrecioProducto");

	for(var i=0; i<descripcion.length; i++) {

		listarProductos.push({"id":$(descripcion[i]).attr("idProducto"),
			                  "descripcion":$(descripcion[i]).val(),
			                  "cantidad":$(cantidad[i]).val(),
			                  "stock":$(cantidad[i]).attr("nuevoStock"),
			                  "precio":$(precio_venta[i]).attr("precioReal"),
			                  "total":$(precio_venta[i]).val()});
	}

	$("#listaProductos").val(JSON.stringify(listarProductos));

}

/*====================================================
LISTAR METODO DE PAGO
====================================================*/
function listarMetodos() {

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo") {

		$("#listaMetodoPago").val("Efectivo");

	}
	else {

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
	}


}

/*=====================================================
BOTON EDITAR VENTA
=====================================================*/
$(document).on("click", ".btnEditarVentas", function() {

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;
});