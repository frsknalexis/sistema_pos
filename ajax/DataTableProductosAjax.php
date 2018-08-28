<?php 

require_once '../controllers/ProductosControllers.php';
require_once '../models/ProductosModels.php';

require_once '../controllers/CategoriasControllers.php';
require_once '../models/CategoriasModels.php';


class TablaProductos {

	/*=======================================================
     MOSTRAR LA TABLA DE PRODUCTOS
	=======================================================*/
	public function mostrarTablaAjax() {

		$item = null;
		$valor = null;

		$productos = ProductosController::mostrarProductosController($item, $valor);

		echo '{
  "data": [';

  for($i = 0; $i < count($productos)-1; $i++) {

  	$item = "id_categoria";

  	$valor = $productos[$i]['id_categoria'];

  	$categoria = CategoriasController::mostrarCategoriaController($item, $valor);

  	  echo '[
      "' . ($i+1) . '",
      "' . $productos[$i]['imagen'] .'",
      "' . $productos[$i]['codigo'] . '",
      "' . $productos[$i]['descripcion'] . '",
      "' . $categoria['nombre_categoria'] . '",
      "' . $productos[$i]['stock'] . '",
      " S/. ' . number_format($productos[$i]['precio_compra'], 2) . '",
      " S/. ' . number_format($productos[$i]['precio_venta'], 2) . '",
      "' . $productos[$i]['fecha'] . '",
      "' . $productos[$i]['id_producto'] . '"
    ],';


  }

  $item = "id_categoria";

  $valor = $productos[count($productos) - 1]['id_categoria'];

  $categoria = CategoriasController::mostrarCategoriaController($item, $valor);


    echo '[
      "' . count($productos) . '",
      "' . $productos[count($productos) - 1]['imagen'] . '",
      "' . $productos[count($productos) - 1]['codigo'] . '",
      "' . $productos[count($productos) - 1]['descripcion'] . '",
      "' . $categoria['nombre_categoria'] . '",
      "' . $productos[count($productos) - 1]['stock'] . '",
      " S/. ' . number_format($productos[count($productos) - 1]['precio_compra'], 2) . '",
      " S/. ' . number_format($productos[count($productos) - 1]['precio_venta'], 2) . '",
      "' . $productos[count($productos) - 1]['fecha'] . '",
      "' . $productos[count($productos) - 1]['id_producto'] . '"
    ]
  ]
}';


	}


}

/*===========================================================
	ACTIVAR LA TABLA DE PRODUCTOS
===========================================================*/

$activar = new TablaProductos();
$activar->mostrarTablaAjax();


?>