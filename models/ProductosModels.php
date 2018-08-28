<?php 

require_once 'db_Conexion.php';

class ProductosModel {

	/*=====================================================
	MOSTRAR PRODUCTOS
	=====================================================*/
	public function mostrarProductosModels($tabla, $item, $valor) {

		if($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_producto DESC");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		}
		else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

	}

	/*=======================================================
		AGREGAR PRODUCTOS
	=======================================================*/
	public function agregarProductosModels($tabla, $datosModel) {

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta) VALUES(:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta)");

		$stmt->bindParam(":id_categoria", $datosModel['id_categoria'], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datosModel['codigo'], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel['descripcion'], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel['imagen'], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datosModel['stock'], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datosModel['precio_compra'], PDO::PARAM_INT);
		$stmt->bindParam(":precio_venta", $datosModel['precio_venta'], PDO::PARAM_INT);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();
	}

	/*=======================================================
		EDITAR PRODUCTOS
	=======================================================*/
	public function editarProductosModels($datosModel, $tabla) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datosModel['id_categoria'], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datosModel['descripcion'], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel['imagen'], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datosModel['stock'], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datosModel['precio_compra'], PDO::PARAM_INT);
		$stmt->bindParam(":precio_venta", $datosModel['precio_venta'], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datosModel['codigo'], PDO::PARAM_STR);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();

	}

	/*=======================================================
	ELIMINAR PRODUCTOS
	=======================================================*/
	public function eliminarProductosModels($tabla, $datosModel) {

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");
		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();
	}

	/*================================================
		ACTUALIZAR PRODUCTOS
	================================================*/
	public function actualizarProductosModels($tabla, $item1, $valor1, $valor) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_producto = :id_producto");
		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $valor, PDO::PARAM_INT);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();


	}

}

?>