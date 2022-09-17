<style>

 .pass  a:link {
  
  color: #0a4d9e;
  font-weight: normal;
  text-align: center;
  text-decoration: none;
  
}
.pass a:active {
  color: red;
  font-weight: normal;
  text-align: center;
  text-decoration: none;
  
}

.pass a:hover {
  color: #0a4d9e;
  font-weight: normal;
  text-align: center;
  text-decoration: none;

}


}
</style>
<div class="container text-center" style="color: #0a4d9e;">
	<h1>Ingrese a VixDrix Hospedaje</h1>
</div>

<div class="d-flex justify-content-center text-center">
<script src="vistas/js/script.js"></script>
	<form class="p-5 bg-light" method="post">

		<div class="form-group">

			<label for="email">Correo electrónico:</label>

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-envelope"></i>
					</span>
				</div>

				<input type="email" class="form-control transformacion2" name="ingresoEmail" id="email" maxlength="150" onkeyup="checkEmail(this);">
			
			</div>
			
		</div>

		<div class="form-group">
			<label for="pwd">Contraseña:</label>

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-lock"></i>
					</span>
				</div>

				<input type="password" class="form-control" name="ingresoPassword" id="pwd" maxlength="8" minlength="4">
				<div class="input-group-prepend">
					
				<button id="show_password" class="btn btn-primary" type="button"  onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
					
				</div>
			</div>
			

		</div>

		<?php 

		$ingreso = new ControladorFormularios();
		$ingreso -> ctrIngreso();

		?>
		
		<button type="submit" class="btn btn-primary">Ingresar</button>
		<div class="pt-4 pass"><a href="newpass"  >¿Olvidaste la contraseña?</a></div>

	</form>

</div>