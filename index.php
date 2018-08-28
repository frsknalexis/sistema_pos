<?php 

require_once 'controllers/plantilla.php';
require_once 'controllers/UsuariosControllers.php';
require_once 'controllers/CategoriasControllers.php';
require_once 'controllers/ProductosControllers.php';
require_once 'controllers/ClientesControllers.php';
require_once 'controllers/VentasControllers.php';

require_once 'models/UsuariosModels.php';
require_once 'models/CategoriasModels.php';
require_once 'models/ProductosModels.php';
require_once 'models/ClientesModels.php';
require_once 'models/VentasModels.php';

$plantilla = new PlantillaController();
$plantilla->plantillas();


?>