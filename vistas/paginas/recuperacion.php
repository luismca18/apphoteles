<?php
    $url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";
    //if (isset($_GET["token"])){
        $pos=stripos($_SERVER['REQUEST_URI'],'token=')+6;
        $tam=strlen($_SERVER['REQUEST_URI'])-$pos;
        $valor=substr($_SERVER['REQUEST_URI'],$pos,$tam);
        //$valor=$_SERVER['REQUEST_URI'];
         echo '<script type="text/javascript">
                    $(document).ready(function()
                      {
                          $("#token").val("'.$valor.'");
                          
                      });
              </script>
        ';
      
    
?>


<div class="container text-center" style="color: #0a4d9e;">
	<h1>Recuperación de contraseña de VixDrix Hospedaje</h1>
</div>

<div class="d-flex justify-content-center text-center">
<script src="vistas/js/script.js"></script>
	<form class="formulario p-5 bg-light"  id="formulario"  method="post">

		<div class="form-group formulario__grupo" id="grupo__password">
			<label for="pwd"  class="formulario__label">Contraseña nueva:</label>
			<div class="input-group  formulario__grupo-input">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-lock"></i>
					</span>
				</div>
				<input type="text" name="token" id="token" hidden>
				<input type="password" class="form-control" name="newPass"  id="pwd" maxlength="8" minlength="4" placeholder="Ingrese una contraseña con 4 dígitos.">
				<div class="input-group-prepend">
					<i class="formulario__validacion-estado-pwd fas fa-times-circle" id="ipassword"></i>
				</div>
				<div class="input-group-prepend">
				
					<button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
				</div>
			</div>
			<p class="formulario__input-error">Ingrese una contraseña con 4 dígitos.</p>
		</div>
		<div class="form-group formulario__grupo" id="grupo__password2">
			<label for="pwd"  class="formulario__label">Repetir Contraseña:</label>

			<div class="input-group  formulario__grupo-input">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-lock"></i>
					</span>
				</div>
                
				<input type="password" class="form-control" name="registroPassword2"  id="pwd2" maxlength="8" minlength="4"  placeholder="Repita la contraseña anterior.">
				
					<div class="input-group-prepend">
						<i class="formulario__validacion-estado-pwd fas fa-times-circle" id="ipassword2"></i>
					</div>
				
				<div class="input-group-prepend">
					<button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
				</div>
			</div>
			<p class="formulario__input-error">Ambas contraseñas deben de ser iguales.</p>
		</div>

		<?php 
            $actualiza=ModeloFormularios::mdlActualizaPass();
            if($actualiza=='ok'){
                echo '<script>
                        alert("Su contraseña se actualizó correctamente.");
					if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

					}

					window.location = "ingreso";

					</script>';

            }
	
		?>
		
		<button type="submit" class="btn btn-primary">Guardar</button>
		

	</form>

</div>
<script src="<?php echo $url_actual;?>js/recuperacion.js"></script>
<script src="<?php echo $url_actual;?>js/script.js"></script>