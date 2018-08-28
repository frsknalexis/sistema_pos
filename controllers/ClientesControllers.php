<?php 

class ClientesController {

	/*==============================================================
		REGISTRAR CLIENTES
	==============================================================*/
	public function agregarClientesController() {

		if(isset($_POST['nuevoCliente']) && isset($_POST['nuevoDni']) && isset($_POST['nuevoEmail']) && isset($_POST['nuevaDireccion']) &&  isset($_POST['nuevaFechaNacimiento'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoCliente']) && preg_match('/^[0-9]+$/', $_POST['nuevoDni']) && preg_match('/^[()\-0-9 ]+$/', $_POST['nuevoTelefono'])) {

				$tabla = "bdt04_clientes";

				$datosController = array("nombre" => $_POST['nuevoCliente'], "dni" => $_POST['nuevoDni'], "email" => $_POST['nuevoEmail'], "telefono" => $_POST['nuevoTelefono'], "direccion" => $_POST['nuevaDireccion'], "fecha_nacimiento" => $_POST['nuevaFechaNacimiento']);

				$respuesta = ClientesModel::agregarClientesModels($datosController, $tabla);

				if($respuesta == 'Ok') {

					echo '<script>
					swal({
						type: "success",
						title: "El Cliente ha sido guardado Correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {

							window.location = "clientes";
						}
					})</script>';
				}
				else {

					echo '<script>
					swal({
						type: "error",
						title: "Error al Guardar el Cliente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {

							window.location = "clientes";
						}
					})</script>';
				}



			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "¡El Cliente no puede ir vacio o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {

						window.location = "clientes";
					}
				})</script>';
			}
		}

	}

	/*==============================================================
    MOSTRAR CLIENTES
	==============================================================*/
	public function mostrarClientesController($item, $valor) {

		$tabla = "bdt04_clientes";

		$respuesta = ClientesModel::mostrarClientesModels($tabla, $item, $valor);

		return $respuesta;

	}

	/*==============================================================
		EDITAR CLIENTES
	==============================================================*/
	public function editarClienteController() {

		if(isset($_POST['idCliente']) && isset($_POST['editarCliente']) && isset($_POST['editarDni']) && isset($_POST['editarEmail']) && isset($_POST['editarTelefono']) && isset($_POST['editarDireccion']) && isset($_POST['editarFechaNacimiento'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarCliente']) && preg_match('/^[0-9]+$/', $_POST['editarDni']) && preg_match('/^[()\-0-9 ]+$/', $_POST['editarTelefono'])) {

				$tabla = "bdt04_clientes";

				$datosController = array("id_cliente" => $_POST['idCliente'], "nombre_cliente" => $_POST['editarCliente'], "documento" => $_POST['editarDni'], "email" => $_POST['editarEmail'], "telefono" => $_POST['editarTelefono'], "direccion" => $_POST['editarDireccion'], "fecha_nacimiento" => $_POST['editarFechaNacimiento']);

				$respuesta = ClientesModel::editarClienteModels($tabla, $datosController);

				if($respuesta == 'Ok') {

					echo '<script>
					swal({
						type: "success",
						title: "El Cliente ha sido Actualizado Correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {

							window.location = "clientes";
						}
					})</script>';
				}
				else {

					echo '<script>
					swal({
						type: "error",
						title: "Error al Actualizar el Cliente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {

							window.location = "clientes";
						}
					})</script>';
				}

			}

			else {

				echo '<script>
				swal({
					type: "error",
					title: "¡El Cliente no puede ir vacio o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {

						window.location = "clientes";
					}
				})</script>';
			}


		}

	}

	/*=============================================================
	ELIMINAR CLIENTES
	=============================================================*/
	public function eliminarClientesController() {

		if(isset($_GET['idCliente'])) {

			$tabla = "bdt04_clientes";

			$datosController = $_GET['idCliente'];

			$respuesta = ClientesModel::eliminarClientesModels($datosController, $tabla);

			if($respuesta == 'Ok') {

				echo '<script>
				swal({
					type: "success",
					title: "El Cliente ha sido Eliminado Correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {

					if(result.value) {

						window.location = "clientes";
					}
				})</script>';
			}
		}
	}


}

?>