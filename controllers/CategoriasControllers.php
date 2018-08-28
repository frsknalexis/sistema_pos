<?php 

class CategoriasController {

/*==========================================================
REGISTRO DE CATEGORIAS
==========================================================*/
public function agregarCategoriaController() {

	if(isset($_POST['nuevaCategoria'])) {

		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevaCategoria'])) {

			$tabla = "bdt02_categorias";

			$datosController = $_POST['nuevaCategoria'];

			$respuesta = CategoriasModel::agregarCategoriaModels($datosController, $tabla);

			if($respuesta == 'Ok') {

				echo '<script>
				swal({
					type: "success",
					title: "La Categoria ha sido Guardada Correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {

					if(result.value) {
						window.location = "categorias";
					}
				})</script>';
			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "Error al Guardar la Categoria!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result.value) => {

					if(result.value) {
						window.location = "categorias";
					}
				})
				</script>';
			}




		}
		else {

			echo '<script>
			swal({
				type: "error",
				title: "¡La Categoria no puede ir vacia o llevar caracteres especiales!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
			}).then((result) => {

				if(result.value) {
					window.location = "categorias";
				}
			})</script>';
		}
	}

}

/*====================================================================
 MOSTRAR CATEGORIAS
==================================================================*/
public function mostrarCategoriaController($item, $valor) {

	$tabla = "bdt02_categorias";

	$respuesta = CategoriasModel::mostrarCategoriaModels($tabla, $item, $valor);

	return $respuesta;
}

/*==================================================================
 EDITAR CATEGORIAS
==================================================================*/
public function editarCategoriaController() {

	if(isset($_POST['editarCategoria']) && isset($_POST['idCategoria'])) {

		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ  ]+$/', $_POST['editarCategoria'])) {

			$tabla = "bdt02_categorias";

			$datosController = array( "categoria" => $_POST['editarCategoria'], "id_categoria" => $_POST['idCategoria']);

			$respuesta = CategoriasModel::editarCategoriaModels($datosController, $tabla);

			if($respuesta == 'Ok') {

				echo '<script>
				swal({
					type: "success",
					title: "La Categoria ha sido Actualizada Correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {
						window.location = "categorias";
					}
				})</script>';
			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "Error al Actualizar la Categoria",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {
						window.location = "categorias";
					}
				})</script>';
			}


		}
		else {

			echo '<script>
			swal({
				type: "error",
				title: "¡La Categoria no puede ir vacia o llevar caracteres especiales!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
			}).then((result) => {
				if(result.value) {
					window.location = "categorias";
				}
			})</script>';
		}
	}

}

/*============================================================
ELIMINAR CATEGORIAS
============================================================*/
public function eliminarCategoriaController() {

	if(isset($_GET['idCategoria'])) {

		$tabla = "bdt02_categorias";

		$datos = $_GET['idCategoria'];

		$respuesta = CategoriasModel::eliminarCategoriaModels($tabla, $datos);

		if($respuesta == 'Ok') {

			echo '<script>
			swal({
				type: "success",
				title: "La Categoria ha sido Eliminada Correctamente",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
			}).then((result) => {
				if(result.value) {

					window.location = "categorias";
				}
			})</script>';
		}
	}
}

}


?>