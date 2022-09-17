<?php

if(!isset($_SESSION["ok"])){

	echo '<script>window.location = "enregistro";</script>';

	return;

}else{

	if($_SESSION["ok"] != "ok"){

		echo '<script>window.location = "eningreso";</script>';
		header('Location: vistas/paginas/iniciosis.php');
		return;
	}
	
}



?>

