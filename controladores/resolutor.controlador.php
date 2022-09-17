<?php
//include "modelos/formularios.modelo.php";
class ControladorResolutor{

	/*=============================================
	Registro
	=============================================*/

	static public function ctrRegistro(){

		if(isset($_POST["name"])){

			if(isset($_FILES["logoHotel"]["tmp_name"]) && !empty($_FILES["logoHotel"]["tmp_name"])){

					/*=============================================
					CAPTURAR ANCHO Y ALTO ORIGINAL DE LA IMAGEN Y DEFINIR LOS NUEVOS VALORES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["logoHotel"]["tmp_name"]);

					$nuevoAncho = 128;
					$nuevoAlto = 128;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/resolutores/";

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["logoHotel"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100, 9999);
						$aleatorio = "resolutor".$aleatorio.".jpg";
						$ruta = $directorio.$aleatorio;

						$origen = imagecreatefromjpeg($_FILES["logoHotel"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

					}else if($_FILES["logoHotel"]["type"] == "image/png"){

						$aleatorio = mt_rand(100, 9999);
						echo ('
						<script>
							window.console.log ("'.$directorio.$aleatorio.".png".'" );
						</script>
						');
						$aleatorio = "resolutor".$aleatorio.".png";
						$ruta = $directorio.$aleatorio;

						$origen = imagecreatefrompng($_FILES["logoHotel"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}else{

						return "error-formato";	
					}

				}else{

					$aleatorio="default.png";
					$ruta = "";
				}


				$tabla = "resolutor";

				

				$idhtl=$_SESSION['IdHotel'];
				$datos = array( "idhotel" => $idhtl,
								"nombre" => $_POST["name"],
								"apellidoP" => $_POST["apaterno"],
								"apellidoM" => $_POST["amaterno"],
					            "foto" => $aleatorio);
//					           "email" => $_POST["registroEmail"],
				$respuesta = ModeloResolutor::mdlRegistro($tabla, $datos);
				echo $respuesta;
				return $respuesta;

			}else{

				$respuesta = "error";

				return $respuesta;

			}

		

	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	static public function ctrSeleccionarRegistros($item, $valor,$tabla){

		// = "hotel";

		$respuesta = ModeloResolutor::mdlSeleccionarRegistros($tabla, $item, $valor);
		
		return $respuesta;

	}



	static public function ctrSeleccionarRegistrosId($item, $valor,$tabla){

		// = "hotel";

		$respuesta = ModeloResolutor::mdlSeleccionarRegistrosId($tabla, $item, $valor);
		
		return $respuesta;

	}

	/*=============================================
	Actualizar Registro
	=============================================*/
	
	/*=============================================
	Eliminar Registro
	=============================================*/
		static public function ctrEliminarRegistro($val)
		{

			if(isset($val))
			{
				$respuesta = ModeloResolutor::mdlEliminarRegistro($val);
				if($respuesta == "ok"){
					/*
					echo '<script>
						if ( window.history.replaceState ) {
							window.history.replaceState( null, null, window.location.href );
						}
						window.location = "inicio";
					</script>';
					*/
					$respuesta="ok";
				}else{
					$respuesta="error";
				}
				return $respuesta;
			}

		}

static public function ctrActualizarResolutor($IdRes,$fotoRes,$nomRes,$ApRes,$AmRes){
//(,$,$,$,$
		if(isset($IdRes))
			{
			
			if(isset($_FILES["fotoRes"]["tmp_name"]) && !empty($_FILES["fotoRes"]["tmp_name"])){

					/*=============================================
					CAPTURAR ANCHO Y ALTO ORIGINAL DE LA IMAGEN Y DEFINIR LOS NUEVOS VALORES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoRes"]["tmp_name"]);

					$nuevoAncho = 128;
					$nuevoAlto = 128;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/resolutores/";
				if($_FILES["fotoRes"]["type"] == "image/jpeg")
				{

						$aleatorio = mt_rand(100, 9999);
						$aleatorio = "resolutor".$aleatorio.".jpg";
						$ruta = $directorio.$aleatorio;

						$origen = imagecreatefromjpeg($_FILES["fotoRes"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

				}
				else if($_FILES["fotoRes"]["type"] == "image/png")
				{

						$aleatorio = mt_rand(100, 9999);
						echo ('
						<script>
							window.console.log ("'.$directorio.$aleatorio.".png".'" );
						</script>
						');
						$aleatorio = "resolutor".$aleatorio.".png";
						$ruta = $directorio.$aleatorio;

						$origen = imagecreatefrompng($_FILES["fotoRes"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

				}
				else
				{

						return "error-formato";	
				}

			}
			else
			{
					$ruta = "";
			 }

			$datos = array( "id" => $IdRes,
							"fotoresolutor" => $ruta,
							"nomresolutor" => $nomRes,
							"apresolutor" => $ApRes,
							"amresolutor" => $AmRes,
							
							);

			$respuesta = ModeloResolutor::mdlActualizarResolutor($datos);

			return $respuesta;


		}else
		{

					$respuesta = "error";

					return $respuesta;

		}

		


	}


}



class ControladorActResolutor

{


		static public function ctrActualizarResolutor(){
//(,$,$,$,$
		if(isset($_POST["IdReso"]))
		{
			if(isset($_FILES["fotoReso"]["tmp_name"]) && !empty($_FILES["fotoReso"]["tmp_name"])){

					/*=============================================
					CAPTURAR ANCHO Y ALTO ORIGINAL DE LA IMAGEN Y DEFINIR LOS NUEVOS VALORES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoReso"]["tmp_name"]);

					$nuevoAncho = 128;
					$nuevoAlto = 128;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/resolutores/";
				if($_FILES["fotoReso"]["type"] == "image/jpeg")
				{

						$aleatorio = mt_rand(100, 9999);
						$aleatorio = "resolutor".$aleatorio.".jpg";
						$ruta = $directorio.$aleatorio;

						$origen = imagecreatefromjpeg($_FILES["fotoReso"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

				}
				else if($_FILES["fotoReso"]["type"] == "image/png")
				{

						$aleatorio = mt_rand(100, 9999);
						echo ('
						<script>
							window.console.log ("'.$directorio.$aleatorio.".png".'" );
						</script>
						');
						$aleatorio = "resolutor".$aleatorio.".png";
						$ruta = $directorio.$aleatorio;

						$origen = imagecreatefrompng($_FILES["fotoReso"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

				}
				else
				{

						return "error-formato";	
				}

			}
			else
			{
					$ruta = "";
			 }

			$datos = array( "id" => $_POST["IdReso"],
							"fotoresolutor" =>$ruta,
							"nomresolutor" => $_POST["nom"],
							"apresolutor" => $_POST["apaternoRes"],
							"amresolutor" => $_POST["amaternoRes"]
							
							);
			$respuesta = ModeloResolutor::mdlActualizarResolutor($datos);

			return $respuesta;

		}
		else
		{
					$respuesta = "error";
 					return $respuesta;
		}

    }

/*
			
			$datos = array( "id" => $IdRes,
							"fotoresolutor" => $fotoRes,
							"nomresolutor" => $nomRes,
							"apresolutor" => $ApRes,
							"amresolutor" => $AmRes,
							
							);
*/

	

}