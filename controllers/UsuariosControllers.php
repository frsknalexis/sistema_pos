<?php 

class UsuariosController {

	/*===================================================
		INGRESO DE USUARIOS
	=====================================================*/
	public function ingresoUsuario() {

		if(isset($_POST['ingUsuario']) && isset($_POST['ingPassword'])) {

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {

				$encriptar = crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$' );

				$tabla = 'bdt01_usuarios';

				$item = "usuario";
				$valor = $_POST['ingUsuario'];

				$respuesta = UsuariosModel::mostrarUsuariosModels($item, $valor, $tabla);

				if(($respuesta['usuario'] == $_POST['ingUsuario']) && ($respuesta['password'] == $encriptar)){

					if($respuesta['estado'] == 1) {
					$_SESSION['iniciarSesion'] = 'ok';
					$_SESSION['id_usuario'] = $respuesta['id_usuario'];
					$_SESSION['nombre'] = $respuesta['nombre'];
					$_SESSION['usuario'] = $respuesta['usuario'];
					$_SESSION['perfil'] = $respuesta['perfil'];
					$_SESSION['foto'] = $respuesta['foto'];

					/*=====================================
					REGISTRAR FECHA PARA SABER EL ULTIMO LOGIN
					=====================================*/

					date_default_timezone_set('America/Lima');

					$fecha = date('Y-m-d');
					$hora = date('H:i:s');

					$fechaActual = $fecha . ' ' . $hora;

					$item1 = 'ultimo_login';
					
					$valor1 = $fechaActual;

					$item2 = 'id_usuario';

					$valor2 = $respuesta['id_usuario'];

					$ultimoLogin = UsuariosModel::actualizarUsuarioModels($tabla, $item1, $valor1, $item2, $valor2);

					if($ultimoLogin == 'Ok') {

						echo '<script>window.location="inicio";</script>';
					}
				}
				else {

					echo '<br><div class="alert alert-danger">El Usuario esta Desactivado</div>';
				}
			}
				else {
					echo '<br><div class="alert alert-danger">Error al Ingresar al Sistema, vuelve a intentarlo.</div>';
				}
			}


		}
	}

	/*===================================================
		REGISTRO DE USUARIOS
	===================================================*/
	public function agregarUsuarioController() {

		if(isset($_POST['nuevoNombre']) && isset($_POST['nuevoUsuario']) && isset($_POST['nuevoPassword'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoUsuario']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])) {

				/*=======================================
					VALIDAR IMAGEN
				=======================================*/

				$ruta = "";

				if(isset($_FILES['nuevaFoto']['tmp_name'])) {

					list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*===================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					===================================*/

					$directorio = "views/img/usuarios/" . $_POST['nuevoUsuario'];

					mkdir($directorio, 0755);

					/*===================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					===================================*/
					if($_FILES['nuevaFoto']['type'] == 'image/jpeg') {

						/*===============================
						GUARDAR LA IMAGEN EN EL DIRECTORIO
						===============================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/usuarios/" . $_POST['nuevoUsuario'] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES['nuevaFoto']['type'] == 'image/png') {

						/*===============================
						GUARDAR LA IMAGEN EN EL DIRECTORIO
						===============================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/usuarios/" . $_POST['nuevoUsuario'] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}

				}

				$tabla = 'bdt01_usuarios';

				$encriptar = crypt($_POST['nuevoPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("nombre" => $_POST['nuevoNombre'], "usuario" => $_POST['nuevoUsuario'], "password" => $encriptar, "perfil" => $_POST['nuevoPerfil'], "foto" => $ruta);

				$respuesta = UsuariosModel::agregarUsuarioModels($datosController, $tabla);

				if($respuesta == 'Ok') {

					echo '<script>
					swal({
						type: "success",
						title: "El Usuario ha sido Guardado Correctamente",
						ShowConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {
							window.location = "usuarios";
						}
					});
					</script>';
				}
				else {

					echo '<script>
					swal({
						type: "error",
						title: "Error al Guardar el Usuario, intenta nuevamente",
						ShowConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {
							window.location = "usuarios";
						}

					});
					</script>';
				}
			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
					ShowConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {
						window.location = "usuarios";
					}

				});
				</script>';

			}
		}

	}

	/*=====================================================
		MOSTRAR USUARIOS
	=====================================================*/
	public function mostrarUsuarioController($item, $valor) {

		$tabla = 'bdt01_usuarios';

		$respuesta = UsuariosModel::mostrarUsuariosModels($item, $valor, $tabla);

		return $respuesta;

	}

	/*=====================================================
		EDITAR USUARIO
	=====================================================*/
	public function editarUsuarioController() {

		if(isset($_POST['editarNombre']) && isset($_POST['editarUsuario'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])) {

				/*=======================================
					VALIDAR IMAGEN
				=======================================*/

				$ruta = $_POST['fotoActual'];

				if(isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES['editarFoto']['tmp_name'])) {

					list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=====================================
						CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=====================================*/
					$directorio = "views/img/usuarios/" . $_POST['editarUsuario'];

					/*=====================================
						PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=====================================*/
					if(!empty($_POST['fotoActual'])) {

						unlink($_POST['fotoActual']);
					}
					else {

						mkdir($directorio, 0755);
					}

					/*=====================================
						DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=====================================*/
					if($_FILES['editarFoto']['type'] == "image/jpeg") {

						/*=================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=================================*/
						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/usuarios/" . $_POST['editarUsuario'] . "/" . $aleatorio . ".jpg";
						$origen = imagecreatefromjpeg($_FILES['editarFoto']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES['editarFoto']['type'] == "image/png") {

						/*=================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=================================*/
						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/usuarios/" . $_POST['editarUsuario'] . "/" . $aleatorio . ".png";
						$origen = imagecreatefrompng($_FILES['editarFoto']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

					}
				}

				$tabla = 'bdt01_usuarios';

				if($_POST['editarPassword'] != "") {

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPassword'])) {

						$encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					}
					else {

						echo '<script>
						swal({
							type: "error",
							title: "¡La Contraseña no puede ir vacio o llevar caracteres especiales!",
							ShowConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result) => {
							if(result.value) {
								window.location = "usuarios";
							}
						});
				</script>';
					}
				}
				else {

					$encriptar = $_POST['passwordActual'];
				}

				$datosController = array("nombre" => $_POST['editarNombre'], "usuario" => $_POST['editarUsuario'], "password" => $encriptar, "perfil" => $_POST['editarPerfil'], "foto" => $ruta);

				$respuesta = UsuariosModel::editarUsuarioModels($datosController, $tabla);

				if($respuesta == 'Ok') {

					echo '<script>
					swal({
						type: "success",
						title: "El Usuario ha sido Editado Correctamente",
						ShowConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {
							window.location = "usuarios";
						}
					});
					</script>';
				}

			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "¡El Nombre del Usuario no puede ir vacio o llevar caracteres especiales!",
					ShowConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {
						window.location = "usuarios";
					}

				});
				</script>';
			}
		}
	}

	/*=====================================================
		ELIMINAR USUARIOS
	=====================================================*/
	public function eliminarUsuarioController() {

		if(isset($_GET['idUsuario'])) {

			$tabla = "bdt01_usuarios";

			$datos = $_GET['idUsuario'];

			if($_GET['fotoUsuario'] != "") {

				unlink($_GET['fotoUsuario']);
				rmdir('views/img/usuarios/' . $_GET['Usuario']);
			}

			$respuesta = UsuariosModel::eliminarUsuarioModels($tabla, $datos);

			if($respuesta == 'Ok') {

				echo '<script>
				swal({
					type: "success",
					title: "El Usuario ha sido Eliminado Correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {

						window.location = "usuarios";
					}
				})</script>';
			}
		}
	}


}

?>
