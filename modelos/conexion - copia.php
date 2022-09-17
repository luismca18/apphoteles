<?php 

class Conexion{

	static public function conectar(){

		#PDO("nombre del servidor; nombre de la base de datos", "usuario", "contraseña")

		$link = new PDO("mysql:host=localhost;dbname=u299032672_apphotel", 
			            "u299032672_apphotel", "xz;pE$7+V#v5");

		$link->exec("set names utf8");

		return $link;

	}

}
