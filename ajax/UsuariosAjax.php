<?php 

require_once '../controllers/UsuariosControllers.php';
require_once '../models/UsuariosModels.php';

class Ajax {

	/*================================================
		EDITAR USUARIOS
	================================================*/
	public $idUsuario;

	public function AjaxEditarUsuario() {

		$item = "id_usuario";
		$valor = $this->idUsuario;
		$respuesta = UsuariosController::mostrarUsuarioController($item, $valor);
		echo json_encode($respuesta);

	}

	/*================================================
		ACTIVAR USUARIOS
	================================================*/
	public $activarId;
	public $activarUsuario;

	public function AjaxActivarUsuario() {

		$tabla = "bdt01_usuarios";
		
		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id_usuario";
		$valor2 = $this->activarId;

		$respuesta = UsuariosModel::actualizarUsuarioModels($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*================================================
	VALIDAR NO REPETIR USUARIO
	================================================*/

	public $validarUsuario;

	public function ajaxValidarUsuario() {

		$item = "usuario";

		$valor = $this->validarUsuario;

		$respuesta = UsuariosController::mostrarUsuarioController($item, $valor);

		echo json_encode($respuesta);

	}


}


if(isset($_POST['idUsuario'])) {

	$editar = new Ajax();
	$editar->idUsuario = $_POST['idUsuario'];
	$editar->AjaxEditarUsuario();
}

if(isset($_POST['activarUsuario'])) {

	$activarUsuario = new Ajax();
	$activarUsuario->activarUsuario = $_POST['activarUsuario'];
	$activarUsuario->activarId = $_POST['activarId'];
	$activarUsuario->AjaxActivarUsuario();

}

if(isset($_POST['validarUsuario'])) {

	$newuser = new Ajax();
	$newuser->validarUsuario = $_POST['validarUsuario'];
	$newuser->ajaxValidarUsuario();

};







?>