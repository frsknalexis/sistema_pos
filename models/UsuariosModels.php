<?php 

require_once 'db_Conexion.php';

class UsuariosModel {

	/*==============================================
		MOSTRAR USUARIOS
	================================================*/

	public function mostrarUsuariosModels($item, $valor, $tabla) {

		if($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT id_usuario, nombre, usuario, password, perfil, foto, estado, ultimo_login, fecha FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();	
		}
		else {

			$stmt = Conexion::conectar()->prepare("SELECT id_usuario, nombre, usuario, password, perfil, foto, estado, ultimo_login, fecha FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();


		}

		$stmt->close();

	}

	/*==============================================
		REGISTRO DE USUARIOS
	===============================================*/

	public function agregarUsuarioModels($datosModel, $tabla) {

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES(:nombre, :usuario, :password, :perfil, :foto)");
		$stmt->bindParam(":nombre", $datosModel['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datosModel['usuario'], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel['password'], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datosModel['perfil'], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datosModel['foto'], PDO::PARAM_STR);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();
	}

	/*================================================
		EDITAR USUARIO
	================================================*/
	public function editarUsuarioModels($datosModel, $tabla) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

		$stmt->bindParam(":nombre", $datosModel['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel['password'], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datosModel['perfil'], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datosModel['foto'], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datosModel['usuario'], PDO::PARAM_STR);

		if($stmt->execute()) {

			return "Ok";
		}
		else {

			return "Error";
		}

		$stmt->close();

	}

	/*================================================
		ACTUALIZAR ESTADO DE USUARIOS
	================================================*/
	public function actualizarUsuarioModels($tabla, $item1, $valor1, $item2, $valor2) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

		if($stmt->execute()) {

			return 'Ok';
		}
		else {

			return 'Error';
		}

		$stmt->close();


	}

	/*===============================================
		ELIMINAR USUARIOS
	===============================================*/
	public function eliminarUsuarioModels($tabla, $datosModel) {

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");
		
		$stmt->bindParam(":id_usuario", $datosModel, PDO::PARAM_INT);

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