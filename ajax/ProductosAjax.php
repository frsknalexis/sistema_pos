<?php 

require_once '../controllers/ProductosControllers.php';
require_once '../models/ProductosModels.php';

require_once '../controllers/CategoriasControllers.php';
require_once '../models/CategoriasModels.php';


class AjaxProductos {


	/*=====================================================
	GENERAR CODIGO A PARTIR DE ID CATEGORIA
	=====================================================*/
	public $idCategoria;

	public function crearCodigoProductoAjax() {

		$item = "id_categoria";

		$valor = $this->idCategoria;


		$respuesta = ProductosController::mostrarProductosController($item, $valor);

		echo json_encode($respuesta);


	}

	/*=======================================================
		EDITAR PRODUCTOS
	=======================================================*/
	public $idProducto;
	public $traerProductos;
	public $nombreProducto;

	public function editarProductoAjax() {

		if($this->traerProductos == 'ok') {

			$item = null;
			$valor = null;

			$respuesta = ProductosController::mostrarProductosController($item, $valor);

			echo json_encode($respuesta);
		}
		elseif ($this->nombreProducto != "") {

			$item = "descripcion";
			$valor = $this->nombreProducto;

			$respuesta = ProductosController::mostrarProductosController($item, $valor);

			echo json_encode($respuesta);
		}
		else {

			$item = "id_producto";
			$valor = $this->idProducto;

			$respuesta = ProductosController::mostrarProductosController($item, $valor);

			echo json_encode($respuesta);

		}
	}
}

/*===========================================================
	GENERAR CODIGO A PARTIR DE ID CATEGORIA
===========================================================*/

if(isset($_POST['idCategoria'])) {

	$codigoProducto = new AjaxProductos();
	$codigoProducto->idCategoria = $_POST['idCategoria'];
	$codigoProducto->crearCodigoProductoAjax();
}

/*==========================================================
EDITAR PRODUCTOS
==========================================================*/
if(isset($_POST['idProducto'])) {

	$editarProducto = new AjaxProductos();
	$editarProducto->idProducto = $_POST['idProducto'];
	$editarProducto->editarProductoAjax();
}

/*========================================================
TRAER PRODUCTOS
========================================================*/
if(isset($_POST['traerProductos'])) {

	$traerProductos = new AjaxProductos();
	$traerProductos->traerProductos = $_POST['traerProductos'];
	$traerProductos->editarProductoAjax();
}

if(isset($_POST['nombreProducto'])) {

	$traerProductos = new AjaxProductos();
	$traerProductos->nombreProducto = $_POST['nombreProducto'];
	$traerProductos->editarProductoAjax();

}

?>