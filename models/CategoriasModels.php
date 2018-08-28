<?php 

require_once 'db_Conexion.php';

class CategoriasModel {

	/**===============================================================
		REGISTRO DE CATEGORIAS
	================================================================*/
	public function agregarCategoriaModels($datosModel, $tabla) {

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_categoria) VALUES(:nombre_categoria)");
		$stmt->bindParam(":nombre_categoria", $datosModel, PDO::PARAM_STR);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();

	}

	/*=========================================================
		MOSTRAR CATEGORIAS
	=======================================================*/
	public function mostrarCategoriaModels($tabla, $item, $valor) {

		if($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
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
	EDITAR CATEGORIAS
	=======================================================*/
	public function editarCategoriaModels($datos, $tabla) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_categoria = :nombre_categoria WHERE id_categoria = :id_categoria");

		$stmt->bindParam(":nombre_categoria", $datos['categoria'], PDO::PARAM_STR);
		$stmt->bindParam("id_categoria", $datos['id_categoria'], PDO::PARAM_INT);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();

	}

	/*=======================================================
	ELIMINAR CATEGORIAS
	=======================================================*/
	public function eliminarCategoriaModels($tabla, $datosModel) {

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_categoria = :id_categoria");

		$stmt->bindParam(":id_categoria", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

	}
}

?>