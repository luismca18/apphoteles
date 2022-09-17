<style>


/* selected link */
pass.a, pass.a:active, pass.a:hover, pass.a:link, pass.a:visited {
  color: blue;
}
</style>
<div class="container text-center" style="color: #0a4d9e;">
	<h1>VixDrix Hosting Password Recovery</h1>

</div>

<div class="d-flex justify-content-center text-center">
<script src="vistas/js/script-en.js"></script>
	<form class="p-5 bg-light" method="post">

		<div class="form-group">

			<label for="email">Enter your email:</label>


			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-envelope"></i>
					</span>
				</div>

				<input type="email" class="form-control transformacion2" name="recuperaEmail" id="email" maxlength="150" onkeyup="checkEmail(this);">
			
			</div>
			
		</div>



		<?php 

		    $registro = ControladorFormularios::ctrEmailRecupera();
		    
		    if ($registro=='ok'){
		        echo '<script>
                    alert("alert("Please check your email to continue with the process.");

					if ( window.history.replaceState ) {
					    window.history.replaceState( null, null, window.location.href );
					}

					window.location = "ingreso";

					</script>';
            }
		?>
		
		<button type="submit" class="btn btn-primary">Send</button>


	</form>

</div>