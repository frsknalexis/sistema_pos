<?php 

class ProductosController {

	/*========================================================
	MOSTRAR PRODUCTOS
	========================================================*/
	public function mostrarProductosController($item, $valor) {

		$tabla = "bdt03_productos";

		$respuesta = ProductosModel::mostrarProductosModels($tabla, $item, $valor);
		return $respuesta;

	}

	/*==============================================================
	AGREGAR PRODUCTOS
	==============================================================*/
	public function agregarProductosController() {

		if(isset($_POST['nuevoCodigo']) && isset($_POST['nuevaDescripcion']) && isset($_POST['nuevoStock']) && isset($_POST['nuevoPrecioCompra']) && isset($_POST['nuevoPrecioVenta'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevaDescripcion']) && preg_match('/^[0-9]+$/', $_POST['nuevoStock']) && preg_match('/^[0-9]+$/', $_POST['nuevoPrecioCompra']) && preg_match('/^[0-9]+$/', $_POST['nuevoPrecioVenta'])) {

				/*==================================================
					VALIDAR IMAGEN
				==================================================*/

				$ruta = "views/img/productos/default/anonymous.png";

				if(isset($_FILES['nuevaImagen']['tmp_name'])) {

					list($ancho, $alto) = getimagesize($_FILES['nuevaImagen']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "views/img/productos/" . $_POST['nuevoCodigo'];
					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES['nuevaImagen']['type'] == 'image/jpeg') {

						/*=========================================
						GUARDAR LA IMAGEN EN EL DIRECTORIO
						=========================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/productos/" . $_POST['nuevoCodigo'] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES['nuevaImagen']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES['nuevaImagen']['type'] == 'image/png') {

						/*=========================================
						GUARDAR LA IMAGEN EN EL DIRECTORIO
						=========================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/productos/" . $_POST['nuevoCodigo'] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES['nuevaImagen']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}

				}

				$tabla = "bdt03_productos";

				$datosController = array("id_categoria" => $_POST['nuevaCategoria'], "codigo" => $_POST['nuevoCodigo'], "descripcion" => $_POST['nuevaDescripcion'], "stock" => $_POST['nuevoStock'], "precio_compra" => $_POST['nuevoPrecioCompra'], "precio_venta" => $_POST['nuevoPrecioVenta'], "imagen" => $ruta);

				$respuesta = ProductosModel::agregarProductosModels($tabla, $datosController);

				if($respuesta == 'Ok') {

					echo '<script>
					swal({
						type: "success",
						title: "El Producto ha sido Guardado Correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {
							window.location = "productos";
						}
					})</script>';
				}
				else {

					echo '<script>
					swal({
						type: "error",
						title: "Error al Guardar el Producto!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {
							window.location = "productos";
						}
					})</script>';
				}

			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "¡El Producto no puede ir con los campos vacios o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {
						window.location = "productos";
					}
				})</script>';
			}
		}
	}


	/*=============================================================
		EDITAR PRODUCTOS
	=============================================================*/
	public function editarProductoController() {

		if(isset($_POST['editarCodigo']) && isset($_POST['editarDescripcion']) && isset($_POST['editarStock']) && isset($_POST['editarPrecioCompra']) && isset($_POST['editarPrecioVenta'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarDescripcion']) && preg_match('/^[0-9]+$/', $_POST['editarStock']) && preg_match('/^[0-9]+$/', $_POST['editarPrecioCompra']) && preg_match('/^[0-9]+$/', $_POST['editarPrecioVenta'])) {

				/*=================================================
				VALIDAR IMAGEN
				=================================================*/

				$ruta = $_POST['imagenActual'];

				if(isset($_FILES['editarImagen']['tmp_name']) && !empty($_FILES['editarImagen']['tmp_name'])) {

					list($ancho, $alto) = getimagesize($_FILES['editarImagen']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PRODUCTO
					=============================================*/

					$directorio = "views/img/productos/" . $_POST['editarCodigo'];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST['imagenActual']) && $_POST['imagenActual'] != "views/img/productos/default/anonymous.png") {

						unlink($_POST['imagenActual']);
					}
					else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES['editarImagen']['type'] == "image/jpeg") {

						/*=========================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=========================================*/
						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/productos/" . $_POST['editarCodigo'] . "/" . $aleatorio . ".jpg";
						$origen = imagecreatefromjpeg($_FILES['editarImagen']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES['editarImagen']['type'] == "image/png") {

						/*=========================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=========================================*/
						$aleatorio = mt_rand(100, 999);

						$ruta = "views/img/productos/" . $_POST['editarCodigo'] . "/" . $aleatorio . ".png";
						$origen = imagecreatefrompng($_FILES['editarImagen']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}

				}

				$tabla = "bdt03_productos";

				$datosController = array("id_categoria" => $_POST['editarCategoria'], "codigo" => $_POST['editarCodigo'], "descripcion" => $_POST['editarDescripcion'], "stock" => $_POST['editarStock'], "precio_compra" => $_POST['editarPrecioCompra'], "precio_venta" => $_POST['editarPrecioVenta'], "imagen" => $ruta);

				$respuesta = ProductosModel::editarProductosModels($datosController, $tabla);

				if($respuesta == 'Ok') {

					echo '<script>
					swal({
						type: "success",
						title: "El Producto ha sido Editado Correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {
							window.location = "productos";
						}
					})</script>';
				}
				else {

					echo '<script>
					swal({
						type: "error",
						title: "Error al Editar el Producto",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result) => {
						if(result.value) {
							window.location = "productos";
						}
					})</script>';
				}
		
			}
			else {

				echo '<script>
				swal({
					type: "error",
					title: "¡El Producto no puede ir con los campos vacios o llevar caracteres especiales!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {
						window.location = "productos";
					}
				})</script>';
			}
		}
	}

	/*=============================================================
		ELIMINAR PRODUCTOS
	=============================================================*/
	public function eliminarProductosController() {

		if(isset($_GET['idProducto'])) {

			$tabla = "bdt03_productos";

			$datosController = $_GET['idProducto'];

			if($_GET['imagenProducto'] != "" && $_GET['imagenProducto'] != "views/img/productos/default/anonymous.png") {

				unlink($_GET['imagenProducto']);
				rmdir('views/img/productos/' . $_GET['codigoProducto']);

			}

			$respuesta = ProductosModel::eliminarProductosModels($tabla, $datosController);

			if($respuesta == 'Ok') {

				echo '<script>
				swal({
					type: "success",
					title: "El Producto ha sido Eliminado Correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result) => {
					if(result.value) {

						window.location = "productos";
					}
				})</script>';
			}
		}
	}

	


}

?>