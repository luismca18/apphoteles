
<?php
session_start();
$url_actual = "http://" . $_SERVER["SERVER_NAME"]. $_SERVER["REQUEST_URI"];
$url_actual2 = "http://" . $_SERVER["SERVER_NAME"]. "/vistas/";

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Hospedaje</title>

	<!--=====================================
	PLUGINS DE CSS
	======================================-->	

	<!-- Latest compiled and minified CSS -->
	<link rel="icon" type="image/png" href="img/favicon.png">
	<link rel="stylesheet" href="<?php echo $url_actual2;?>css/bootstrap.min.css">
	<link rel ="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel ="stylesheet">
	<link rel ="stylesheet" href="<?php echo $url_actual2;?>css/estilos.css">
	<!--=====================================
	PLUGINS DE JS
	======================================-->	

	<!-- jQuery library -->
	
	
	<script src="<?php echo $url_actual2;?>js/jquery.min.js"></script>
	<script scr="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<!-- Popper JS -->
	<script src="<?php echo $url_actual2;?>js/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="<?php echo $url_actual2;?>js/bootstrap.min.js"></script>

	<!-- Latest compiled Fontawesome-->
<script src="<?php echo $url_actual2;?>js/e632f1f723.js" crossorigin="anonymous"></script>



	
	<script src="https://www.google.com/recaptcha/api.js?render=_reCAPTCHA_site_key"></script>
	
  <style type="text/css"> 

 .nav-item a:link {
  
  color: white;
  font-weight: normal;
  text-align: center;
  text-decoration: none;
  
}
.nav-item a:active {
  background-color: #0a4d9e;
  border: 2px solid white;
  color: white;
  font-weight: normal;
  text-align: center;
  text-decoration: none;
  
}

.nav-item a:hover {
  color: #0a4d9e;
  font-weight: normal;
  background-color: white;
  text-align: center;
  text-decoration: none;
  border: none;
}

   
   </style> 
	<script type="text/javascript">
function mayus(e) {
    e.value = e.value.toUpperCase();
}
	function mostrarPassword(){
			var cambio1 = document.getElementById("pwd");
			var cambio2 = document.getElementById("pwd2");
			if(cambio1.type == "password"){
				cambio1.type = "text";
				$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
			}else{
				cambio1.type = "password";
				$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
			}
			if(cambio2.type == "password"){
				cambio2.type = "text";
				$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
			}else{
				cambio2.type = "password";
				$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
			}

	} 

	function checkText(e) {
	    tecla = (document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8) {
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /[A-Za-z0-9ÁÉÍÓÚÑáéíóúñ ]/;
	    tecla_final = String.fromCharCode(tecla).toUpperCase();
	   
	    return patron.test(tecla_final);
	}

	function checkNum(e) {
	    tecla = (document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8) {
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /[0-9]/;
	    tecla_final = String.fromCharCode(tecla).toUpperCase();
	   
	    return patron.test(tecla_final);
	}

	function checkTextN(e) {
	    tecla = (document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8) {
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /[A-Za-zÁÉÍÓÚáéíóú.:,+*0-9 ]/;
	    tecla_final = String.fromCharCode(tecla).toUpperCase();
	   
	    return patron.test(tecla_final);
	}
/*
	function checkEmail(e) {

	    tecla = e.value;//(document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8){
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,4})$/;
	    //patron =/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,4})$/;
		//patron =/^[\da-z_\.-]+@[\da-z\.-]+\.[a-z\.]{2,4}$/;
	    //patron =/^[a-zA-Z0-9_\.\-]+\@[a-zA-Z0-9\-]+\.+[a-zA-Z0-9]{2,4}/;
	    //patron =/[^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$]/i

	    tecla_final = String.fromCharCode(tecla); //.toUpperCase();   //.toLowerCase();
	    console.log(patron.test(tecla_final));
	    console.log(tecla_final);
	    if (patron.test(tecla_final)){
	    	return tecla_final;
	    }
	    //tecla_final=String.fromCharCode(tecla).toLowerCase();
	    //return tecla_final;
	}
	*/
function checkEmail(e) {
			e.value = e.value.toLowerCase();
}
	</script>
</head>
<body>

	<div class="container-fluid"  style="background-color: #0a4d9e;" >
		
		<div class="container ">
			<ul class="nav nav-pills py-2 nav-justified">
   <li class="navbar-brand logo-menu">
      <img src="./img/logo.jpg" alt="HotelesApp" style="width:200px;" >
     </li>			
			<?php if (isset($_GET["pagina"])){ ?>

				<?php if ($_GET["pagina"] == "enregistro"){  ?>

					<li class="nav-item">
						<a class="nav-link active" href="enregistro">Register</a>
					</li>

				<?php }else{  ?>

					<li class="nav-item">
						<a class="nav-link" href="enregistro">Register</a>
					</li>
					
				<?php } ?>

				<?php if ($_GET["pagina"] == "eningreso"){  ?>

					<li class="nav-item">
						<a class="nav-link active" href="eningreso">Login</a>
					</li>

				<?php }else {  ?>

					<li class="nav-item">
						<a class="nav-link" href="eningreso">Login</a>
					</li>
					
				<?php } ?>



			<?php }else{?>

				<!-- GET: $_GET["variable"] Variables que se pasan como parámetros Vía URL ( También conocido como cadena de consulta a través de la URL) 
				Cuando es la primera variable se separa con ?
				las que siguen a continuación se separan con &
				-->

				<li class="nav-item">
					<a class="nav-link active" href="enregistro">Register</a>
				</li>

				<li class="nav-item">
					<a class="nav-link " href="eningreso">Login</a>
				</li>


				
			<?php } ?>

			</ul>

		</div>

	</div>

	<!--=====================================
	CONTENIDO
	======================================-->



			<?php 
						require_once "controladores/plantilla.controlador.php";
						require_once "controladores/formularios.controlador.php";
						require_once "modelos/formularios.modelo.php";
				#ISSET: isset() Determina si una variable está definida y no es NULL
/*
				if(!isset($_GET["pagina"])){
					//include "paginas/inicio.php";

				}
				else
				{ 
					if($_GET["pagina"] == "registro" ||
					   $_GET["pagina"] == "ingreso" ||
					   $_GET["pagina"] == "salir"){

						//include "paginas/".$_GET["pagina"].".php";

					}elseif ($_GET["pagina"] == "inicio"||
					   $_GET["pagina"] == "resolutor" ||
					   $_GET["pagina"] == "solicitudes"||
					   $_GET["pagina"] == "tareas") {


						$plantilla = new ControladorPlantilla();
						$plantilla -> ctrTraerPlantillaAdmin();

				  }else{

						include "paginas/error404.php";
					}
					

				}

				*/

			 ?>






