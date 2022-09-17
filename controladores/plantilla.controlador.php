<?php

Class ControladorPlantilla{

	/*=============================================
	Llamada a la plantilla
	=============================================*/

	public function ctrTraerPlantilla(){

		#include() Se utiliza para invocar el archivo que contiene código html-php.
		include "vistas/plantilla.php";

	}


	public function ctrTraerPlantillaAdmin(){

		#include() Se utiliza para invocar el archivo que contiene código html-php.
		
		//require "vistas/plantillaadmin.php";
		header("Location: vistas/plantillaadmin.php");
		die();
	}
}