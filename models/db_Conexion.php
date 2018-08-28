<?php 

class Conexion {

	public function conectar() {
		$link = new PDO("mysql:host=localhost; dbname=db_pos", "root", "");

		$link->exec("SET NAMES utf8");
		
		return $link;
	}
}

?>