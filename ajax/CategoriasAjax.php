<?php 

require_once '../controllers/CategoriasControllers.php';
require_once '../models/CategoriasModels.php';

class Ajax {

	/*=======================================================
		EDITAR CATEGORIAS
	=======================================================*/
	public $idCategoria;

	public function AjaxEditarCategoria() {

		$item = "id_categoria";
		$valor = $this->idCategoria;

		$respuesta = CategoriasController::mostrarCategoriaController($item, $valor);

		echo json_encode($respuesta);

	}

	/*=======================================================
	VALIDAR NO REPETIR CATEGORIAS
	=======================================================*/

	public $validarCategoria;

	public function ajaxValidarCategoria() {

		$item = "nombre_categoria";

		$valor = $this->validarCategoria;
		
		$respuesta = CategoriasController::mostrarCategoriaController($item, $valor);

		echo json_encode($respuesta);
	}


}

if(isset($_POST['idCategoria'])) {

	$editar = new Ajax();
	$editar->idCategoria = $_POST['idCategoria'];
	$editar->AjaxEditarCategoria();
}

if(isset($_POST['validarCategoria'])) {

	$validar = new Ajax();
	$validar->validarCategoria = $_POST['validarCategoria'];
	$validar->ajaxValidarCategoria();
}


?>