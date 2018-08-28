<?php 

require_once '../controllers/ClientesControllers.php';
require_once '../models/ClientesModels.php';

class Ajax {

	/*=======================================================
	EDITAR CLIENTES
	=======================================================*/
	public $idCliente;

	public function AjaxEditarCliente() {

		$item = "id_cliente";

		$valor = $this->idCliente;

		$respuesta = ClientesController::mostrarClientesController($item, $valor);

		echo json_encode($respuesta);


	}
}

if(isset($_POST['idCliente'])) {

	$editar = new Ajax();
	$editar->idCliente = $_POST['idCliente'];
	$editar->AjaxEditarCliente();
}

?>