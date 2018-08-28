<?php 

class VentasController {

	/*==============================================================
	MOSTRAR VENTAS
	==============================================================*/
	public function mostrarVentasController($item, $valor) {

		$tabla = "bdt05_ventas";

		$respuesta = VentasModel::mostrarVentasModels($tabla, $item, $valor);

		return $respuesta;
	}
	/*==============================================================
	CREAR VENTA
	==============================================================*/
	public function crearVentaController() {

		if(isset($_POST['nuevaVenta']) && isset($_POST['seleccionarCliente']) && isset($_POST['idVendedor']) && isset($_POST['listaProductos']) && isset($_POST['nuevoPrecioImpuesto']) && isset($_POST['nuevoPrecioNeto']) && isset($_POST['totalVenta']) && isset($_POST['nuevoMetodoPago'])) {

			/*======================================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			======================================================*/

			$listaProductos = json_decode($_POST['listaProductos'], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados, $value['cantidad']);
				
				$tablaProducto = "bdt03_productos";

				$item = "id_producto";

				$valor = $value['id'];

				$traerProductos = ProductosModel::mostrarProductosModels($tablaProducto, $item, $valor);


				$item1a = "cantidad_ventas";

				$valor1a = $value['cantidad'] + $traerProductos['cantidad_ventas'];

				$nuevasVentas = ProductosModel::actualizarProductosModels($tablaProducto, $item1a, $valor1a, $valor);

				$item1b = "stock";

				$valor1b = $value['stock'];

				$nuevoStock = ProductosModel::actualizarProductosModels($tablaProducto, $item1b, $valor1b, $valor);


			}

			$tablaClientes = "bdt04_clientes";

			$item = "id_cliente";

			$valor = $_POST['seleccionarCliente'];

			$traerCliente = ClientesModel::mostrarClientesModels($tablaClientes, $item, $valor);

			$item1a = "total_compras";

			$valor1a = array_sum($totalProductosComprados) + $traerCliente['total_compras'];

			$comprasCliente = ClientesModel::actualizarClientesModels($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Lima');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$fechaActual = $fecha . ' ' . $hora;

			$valor1b = $fechaActual;

			$ultimaCompra = ClientesModel::actualizarClientesModels($tablaClientes, $item1b, $valor1b, $valor);



			/*======================================================
			GUARDAR LA COMPRA
			======================================================*/

			$tablaVentas = "bdt05_ventas";

			$datosController = array("id_vendedor" => $_POST['idVendedor'], "id_cliente" => $_POST['seleccionarCliente'], "codigo" => $_POST['nuevaVenta'], "productos" => $_POST['listaProductos'], "impuesto" => $_POST['nuevoPrecioImpuesto'], "neto" => $_POST['nuevoPrecioNeto'], "total_venta" => $_POST['totalVenta'], "metodo_pago" => $_POST['listaMetodoPago']);

			$respuesta = VentasModel::ingresarVentasModels($tablaVentas, $datosController);

			if($respuesta == 'Ok') {

				echo '<script>
				swal({
					type: "success",
					title: "La Venta ha sido Guardada Correctamente",
					showConfirmButton: true,
					confirmButtonText: "¡Cerrar!",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {

						window.location = "ventas";
					}
				})</script>';
			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "Error al Guardar la Venta",
					showConfirmButton: true,
					confirmButtonText: "¡Cerrar!",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {

						window.location = "ventas";
					}
				})</script>';
			}


		}


	}
}

?>