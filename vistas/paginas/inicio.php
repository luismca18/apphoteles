<?php

if(!isset($_SESSION["ok"])){

	echo '<script>window.location = "registro";</script>';

	return;

}else{

	if($_SESSION["ok"] != "ok"){

		echo '<script>window.location = "ingreso";</script>';
		header('Location: vistas/paginas/iniciosis.php');
		return;
	}
	
}



?>

