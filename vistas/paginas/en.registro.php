<?php
$pk=0;
$url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
$document_root =  "http://" . $_SERVER["SERVER_NAME"];
  if(isset($_POST["pk"]))
  { 
     $pk=$_POST["pk"];
  }else{
  	$pk=1;
  }
  /*
if(!isset($_GET["pagina"])){
	$url_actual=$url_actual;
}else
{
	if ($_GET["pagina"] == "registro1" ) {
		$url_actual=substr($url_actual,0,strlen($url_actual)-9);
		$pk=1;
	}elseif ($_GET["pagina"] == "registro2" ) {
		$url_actual=substr($url_actual,0,strlen($url_actual)-9);
		$pk=2;
	}elseif ($_GET["pagina"] == "registro" ) {
		$url_actual=substr($url_actual,0,strlen($url_actual)-8);
	}
	else
	{
		if ($_GET["pagina"] == "inicio1" ) {
			$pk=1;
			$url_actual=substr($url_actual,0,strlen($url_actual)-7);	
		}elseif ($_GET["pagina"] == "inicio2" ) {
			$pk=2;
			$url_actual=substr($url_actual,0,strlen($url_actual)-7);	
		}elseif ($_GET["pagina"] == "inicio" ) {
			$url_actual=substr($url_actual,0,strlen($url_actual)-6);	
		}
	}
}
*/

	

?>
	
	<div class="container-flex justify-content-center text-right">

    <div class="row cuerpo">
    <div class="col-12 area">
    	<span >English</span >
    	<span >|</span >
    	<a href="registro"><span >Español</span ></a>
	</div>
	</div>
	</div>
<div class="container text-center" style="color: #0a4d9e;">
	<h1><b>Register Hotel data</b></h1>
</div>
<div class="container-flex justify-content-center text-center">

    <div class="row cuerpo">
    <div class="col-12 area">
	<form class="formulario p-1 bg-light" id="formulario"  method="post"  enctype="multipart/form-data">

		<div class="form-group formulario__grupo" id="grupo__nombre">
			<label for="nombre" class="formulario__label">Hotel name:</label>


			<div class="input-group formulario__grupo-input">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-user"></i>
					</span>
				</div>

				<input type="text" class="form-control formulario__input" id="nombre" name="registroNombre" maxlength="150" onkeypress="return checkText(event)" onkeyup="mayus(this);" placeholder="Indicate the name of the hotel." >
				
				<i class="formulario__validacion-estado fas fa-times-circle" id="inombre"></i>

				
				
			</div>
			<p class="formulario__input-error">The name must be a maximum of 150 characters.</p>

			
		</div>

		<div class="form-group  formulario__grupo" id="grupo__email">
			<label for="email" class="formulario__label">Email:</label>


			<div class="input-group  formulario__grupo-input">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-envelope"></i>
					</span>
				</div>

				<input type="text" class="form-control transformacion2  formulario__input" name="registroEmail"  id="email" maxlength="150" onkeyup="checkEmail(this);" placeholder="Indique un correo electrónico válido." >
				<i class="formulario__validacion-estado fas fa-times-circle" id="iemail"></i>
				
			</div>
			<p class="formulario__input-error">You must enter a valid email.</p>

		</div>


		<div class="form-group formulario__grupo" id="grupo__ubicacion">
			<label for="ubicacion"  class="formulario__label">Location:</label>

			<div class="input-group  formulario__grupo-input">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-map-marked-alt"></i>
					</span>
				</div>
	
  				<select required id="ubicacion" name="registroZona" class="custom-select">
  						<option value="">Select state</option>
						<option value="Aguascalientes">Aguascalientes</option>
						<option value="Baja California">Baja California</option>
						<option value="Baja California Sur">Baja California Sur</option>
						<option value="Campeche">Campeche</option>
						<option value="Chiapas">Chiapas</option>
						<option value="Chihuahua">Chihuahua</option>
						<option value="Ciudad de México">Ciudad de México</option>
						<option value="Coahuila">Coahuila</option>
						<option value="Colima">Colima</option>
						<option value="Durango">Durango</option>
						<option value="Estado de México">Estado de México</option>
						<option value="Guanajuato">Guanajuato</option>
						<option value="Guerrero">Guerrero</option>
						<option value="Hidalgo">Hidalgo</option>
						<option value="Jalisco">Jalisco</option>
						<option value="Michoacán">Michoacán</option>
						<option value="Morelos">Morelos</option>
						<option value="Nayarit">Nayarit</option>
						<option value="Nuevo León">Nuevo León</option>
						<option value="Oaxaca">Oaxaca</option>
						<option value="Puebla">Puebla</option>
						<option value="Querétaro">Querétaro</option>
						<option value="Quintana Roo">Quintana Roo</option>
						<option value="San Luis Potosí">San Luis Potosí</option>
						<option value="Sinaloa">Sinaloa</option>
						<option value="Sonora">Sonora</option>
						<option value="Tabasco">Tabasco</option>
						<option value="Tamaulipas">Tamaulipas</option>
						<option value="Tlaxcala">Tlaxcala</option>
						<option value="Veracruz">Veracruz</option>
						<option value="Yucatán">Yucatán</option>
						<option value="Zacatecas">Zacatecas</option>

					</select>

  				
				<i class="formulario__validacion-estado fas fa-times-circle" id="iubicacion"></i>
				
			</div>
			<p class="formulario__input-error">Must be a state from the displayed list.</p>
		</div>

		<div class="form-group formulario__grupo" id="grupo__password">
			<label for="pwd"  class="formulario__label">Password:</label>

			<div class="input-group  formulario__grupo-input">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-lock"></i>
					</span>
				</div>

				<input type="password" class="form-control" name="registroPassword"  id="pwd" maxlength="8" minlength="4" placeholder="Enter a 4-digit password.">
				<div class="input-group-prepend">
					<i class="formulario__validacion-estado-pwd fas fa-times-circle" id="ipassword"></i>
				</div>
				<div class="input-group-prepend">
				
					<button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
					
				</div>
				
				
			</div>
			<p class="formulario__input-error">Enter a password with 4 digits.</p>

		</div>
		<div class="form-group formulario__grupo" id="grupo__password2">
			<label for="pwd" class="formulario__label">Repeat Password:</label>


			<div class="input-group  formulario__grupo-input">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-lock"></i>
					</span>
				</div>

				<input type="password" class="form-control" name="registroPassword2"  id="pwd2" maxlength="8" minlength="4"  placeholder="Repeat the previous password.">
				
					<div class="input-group-prepend">
						<i class="formulario__validacion-estado-pwd fas fa-times-circle" id="ipassword2"></i>
					</div>
				
				<div class="input-group-prepend">
					<button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
				</div>
			</div>
			<p class="formulario__input-error">Both passwords must be the same.</p>
		</div>
		<div class="form-group text-center formulario__grupo-logo">
			<input type="file" name="logoHotel" class="d-none" id="logoHotel">

			<label for="logoHotel" class="d-none d-md-block formulario__label" >

			<img src="<?php echo $document_root;?>/vistas/img/uploadimage.png" class="prevLogoHotel"  width="200" height="200">

			</label>
		</div>

		<div class="formulario__mensaje mb-3" id="formulario__mensaje">
			<p><i class="fas fa-exclamation-triangle"></i><b>Error:</b>Please fill in the data correctly.</p>
		</div>
			<input type="number" id="pk" name="pk" hidden value="<?php echo $pk;?>">
		<div class="formulario__grupo formulario__grupo-btn-enviar" id="formulario__mensaje">
			<button type="submit" class="formulario__btn btn btn-primary">Send</button>
			<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">The Hotel was successfully registered</p>
		</div>

		<?php 

		$registro = ControladorFormularios::ctrRegistro();

		if($registro == "ok"){

			echo '<script>

				if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

				}

			</script>';

			echo '<div class="alert alert-success p-3">The VixDrix Hosting team has sent an email to your account with your access data</div>';
			echo '<script>

		
							alert("The VixDrix Hosting team has sent an email to your account with your access data");
							window.location.href = "eningreso";
					

				</script>';
		}else if(strpos($registro,"ok")!=false){
		    		

		
			echo '<script>

		
							alert("The VixDrix Hosting team has sent an email to your account with your access data".$registro);
							window.location.href = "eningreso";
					

				</script>';
		}


		if(strpos($registro,"error")!=false) {

			echo '<script>

				if ( window.history.replaceState ) {
					console.log("'.$registro.'");
					window.history.replaceState( null, null, window.location.href );

				}

			</script>';

			echo '<div class="alert alert-danger">Error, special characters are not allowed</div>';

		}

		?>
		
		

	</form>
	</div>
	</div>

</div>


<script src="<?php echo $url_actual2;?>js/formulario.js"></script>
<script src="<?php echo $url_actual2;?>js/script-en.js"></script>
</body>
</html>