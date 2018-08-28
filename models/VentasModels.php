<?php 

require_once 'db_Conexion.php';

class VentasModel {

	/*=======================================================
	MOSTRAR VENTAS
	=======================================================*/
	public function mostrarVentasModels($tabla, $item, $valor) {

		if($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_venta ASC");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch();
		}
		else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();
	}

	/*=======================================================
	REGISTRO DE VENTAS
	=======================================================*/
	public function ingresarVentasModels($tabla, $datosModel) {

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, subtotal, total_venta, metodo_pago) VALUES(:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :subtotal, :total_venta, :metodo_pago)");

		$stmt->bindParam(":codigo", $datosModel['codigo'], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datosModel['id_cliente'], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datosModel['id_vendedor'], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datosModel['productos'], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datosModel['impuesto'], PDO::PARAM_STR);
		$stmt->bindParam(":subtotal", $datosModel['neto'], PDO::PARAM_STR);
		$stmt->bindParam(":total_venta", $datosModel['total_venta'], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datosModel['metodo_pago'], PDO::PARAM_STR);

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