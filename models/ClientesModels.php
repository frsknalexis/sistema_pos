<?php 

require_once 'db_Conexion.php';

class ClientesModel {

	/*=======================================================
		REGISTRAR CLIENTES
	=======================================================*/
	public function agregarClientesModels($datosModel, $tabla) {

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_cliente, documento, email, telefono, direccion, fecha_nacimiento) VALUES(:nombre_cliente, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");

		$stmt->bindParam(":nombre_cliente", $datosModel['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datosModel['dni'], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel['telefono'], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel['direccion'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datosModel['fecha_nacimiento'], PDO::PARAM_STR);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();
	}

	/*=======================================================
	MOSTRAR CLIENTES
	=======================================================*/
	public function mostrarClientesModels($tabla, $item, $valor) {

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
	EDITAR CLIENTES
	=======================================================*/
	public function editarClienteModels($tabla, $datosModel) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_cliente = :nombre_cliente, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE id_cliente = :id_cliente");
		$stmt->bindParam(":id_cliente", $datosModel['id_cliente'], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_cliente", $datosModel['nombre_cliente'], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datosModel['documento'], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datosModel['telefono'], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel['direccion'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datosModel['fecha_nacimiento'], PDO::PARAM_STR);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();
	}

	/*=======================================================
		ELIMINAR CLIENTES
	=======================================================*/
	public function eliminarClientesModels($datosModel, $tabla) {

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id_cliente");

		$stmt->bindParam(":id_cliente", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();
	}

	/*================================================
		ACTUALIZAR CLIENTES
	================================================*/
	public function actualizarClientesModels($tabla, $item1, $valor1, $valor) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_cliente = :id_cliente");
		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $valor, PDO::PARAM_INT);

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