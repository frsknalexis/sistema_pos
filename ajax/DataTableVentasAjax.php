<?php 

require_once '../controllers/ProductosControllers.php';
require_once '../models/ProductosModels.php';

class TablaProductos {

	/*=====================================================
	MOSTRAR LA TABLA DEL PRODUCTO
	=====================================================*/
	public function mostrarTabla() {

		$item = null;
		$valor = null;

		$productos = ProductosController::mostrarProductosController($item, $valor);

		echo '{
  "data": [';

  for($i = 0; $i < count($productos)-1; $i++) {

  	  echo '[
      "' . ($i+1) . '",
      "' . $productos[$i]['imagen'] .'",
      "' . $productos[$i]['codigo'] . '",
      "' . $productos[$i]['descripcion'] . '",
      "' . $productos[$i]['stock'] . '",
      "' . $productos[$i]['id_producto'] . '"
    ],';


  }
    echo '[
      "' . count($productos) . '",
      "' . $productos[count($productos) - 1]['imagen'] . '",
      "' . $productos[count($productos) - 1]['codigo'] . '",
      "' . $productos[count($productos) - 1]['descripcion'] . '",
      "' . $productos[count($productos) - 1]['stock'] . '",
      "' . $productos[count($productos) - 1]['id_producto'] . '"
    ]
  ]
}';


	}


}

/*=========================================================
ACTIVAR LA TABLA DE PRODUCTOS
=========================================================*/

$activacion = new TablaProductos();
$activacion->mostrarTabla();

?>