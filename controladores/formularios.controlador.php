<?php

$document_root = $_SERVER['DOCUMENT_ROOT'];
require_once $document_root.'/apphoteles/codigo_qr/phpqrcode/qrlib.php';
//require($document_root.'/fpdf/fpdf.php');

		
class ControladorFormularios{
	/*=============================================
	Registro
	=============================================*/
	static public function ctrEmailEnvia($datos){
	    //date_default_timezone_set('UTC');
	    date_default_timezone_set("America/Mexico_City");
		$email=$datos["email"];
		$nombre=$datos["nombre"];
		$paquete=$datos["pk"];
		$fecha=date('l jS \of F Y');
		$asunto="Te damos la bienvenida";//	<img src="https://hospedaje.vixdrix.com/img/logo.jpg"  width="85%">
		$msg='<html> <head> <meta charset="UTF-8"> <title>¡El equipo de VixDrix te da la bienvenida!</title> </head>
			<body style="font-family: Arial, Helvetica, sans-serif;"> 
				<table> <tr> <td width="10%"> </td> <td width="20%">
				</td>
					<td width="70%"><h1 style="text-align: left;">¡El equipo de VixDrix te da la bienvenida!</h1></td>
					</tr>
				</table>
				<table>
					<tr><td ></td><td width="90%">
					<p style="text-align: justify;">Acabas de elegir la mejor herramienta para comenzar a ser parte de la era digital.
						Nuestro compromiso es que VixDrixd Hospedaje sea tan sencillo y valioso para tu negocio, que tus clientes y tu bolsillo lo amen.
						Lo valioso de tu negocio y la facilidad tecnológica de VixDrix, son el equipo perfecto. Estamos para ti vía soporte   <a href="mailto:soporte@vixdrix.com">soporte@vixdrix.com</a>, porque queremos que tu experiencia sea la mejor. </p>			
					<p>Estamos felices de verte  de este lado. </p> <p>Sinceramente, VixDrix, transformando negocios convencionales en digitales.</p>
					</td><td></td></tr>
				</table> 
				<h4 style="padding-left: 100px;">Tu cuenta: </h4>
				<table  width="80%" > 
					<tr><td width="10%"></td>	
					<td width="40%">Usuario:</td><td width="40%"><strong>'.$email.'</strong></td></tr><tr><td></td>
					<td>Nombre hotel:</td><td><strong>'.$nombre.'</strong></td></tr><tr><td></td>
					<td>Fecha de contratación:</td><td><strong>'.$fecha.'</strong></td></tr><tr><td></td>
					<td>Paquete contratado:</td><td><strong>Paquete ';
					if ($paquete==1){
					    $msg.='Free';
					}else if ($paquete==2){
					    $msg.='Profesional';
					}
					
					$msg.='</strong></td></tr>
				</table>
				<p style="padding-left: 100px;"><a href="https://hospedaje.vixdrix.com/ingreso"> Ingresa aquí por favor.</a> </p>
			</body></html>';
		
		$header='MIME-Version: 1.0' . "\r\n";
        $header.= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$header.="From: soporte@vixdrix.com"."\r\n";
		$header.="Reply-To: soporte@vixdrix.com"."\r\n";
		$mail=@mail($email,$asunto,$msg,$header);
        if ($mail){
            return "email enviado correctamente";
        }
	}
	
	static public function ctrEmailRecupera(){
	   if(isset($_POST["recuperaEmail"])){
            $respuesta = ModeloFormularios::mdlSeleccionarRegistros('hotel', 'emailHotel', $_POST["recuperaEmail"]);
            if(is_array($respuesta)){
                if ($respuesta["emailHotel"] == $_POST["recuperaEmail"]) 
				{
                	    date_default_timezone_set("America/Mexico_City");
                		$email=$respuesta["emailHotel"];
                		$nombre=$respuesta["nombreHotel"];
                		$fecha=date('l jS \of F Y');
                		$asunto="Recuperación de contraseña VixDrix Hospedaje";//	
                		$msg='<html> <head> <meta charset="UTF-8"> <title>El equipo de soporte técnico de VixDrix te ayuda</title> </head>
                			<body style="font-family: Arial, Helvetica, sans-serif;"> 
                				<table> <tr> <td width="10%"> </td> <td width="20%">
                				<img src="https://hospedaje.vixdrix.com/img/logo.jpg"  width="85%">
                				</td>
                					<td width="70%"><h1 style="text-align: left;">Hola '.$nombre.'</h1></td>
                					</tr>
                				</table>
                				<table>
                					<tr><td ></td><td width="90%">
                					<p style="text-align: justify;">Recibimos la petición para recuperar tu acceso a VixDrix Hospedaje solo <a href="https://hospedaje.vixdrix.com/recuperacion?token='.$respuesta["token"].'"> ingresa aquí por favor.</a></p>
                					</td><td></td></tr>
                				</table> 
                			</body></html>';
                		$header='MIME-Version: 1.0' . "\r\n";
                        $header.= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                		$header.="From: soporte@vixdrix.com"."\r\n";
                		$header.="Reply-To: soporte@vixdrix.com"."\r\n";
                		$mail=@mail($email,$asunto,$msg,$header);
                        if ($mail){
                            return "ok";
                        }
                        
                    
//					$respuesta["token"]
                        
					echo '<script>
                        alert("Por favor revisa tu correo electrónico para continuar con el proceso.");
					if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

					}

					window.location = "ingreso";

					</script>';
                    
				}
            }else{
                    echo '<div class="alert alert-danger">El correo electrónico no se encuentra registrado.</div>';
                    return 'error';
            }
            	       
	   }

	}	
	
	static public function ctrRegistro(){

		if(isset($_POST["registroNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"])  &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"])) 
			{ 

				/*=============================================
				VALIDACIÓN FOTO LADO SERVIDOR
				=============================================*/
				$archivo='';
				if(isset($_FILES["logoHotel"]["tmp_name"]) && !empty($_FILES["logoHotel"]["tmp_name"]))
				{

						/*=============================================
						CAPTURAR ANCHO Y ALTO ORIGINAL DE LA IMAGEN Y DEFINIR LOS NUEVOS VALORES
						=============================================*/

						list($ancho, $alto) = getimagesize($_FILES["logoHotel"]["tmp_name"]);

						$MaxAncho = 250;
						$MaxAlto = 250;
						$nuevoAlto= $alto;
						$nuevoAncho=$ancho;

						if ($ancho>$alto){
							if ($nuevoAncho>$MaxAncho){
								$nuevoAlto= ($MaxAncho / $nuevoAncho) * $nuevoAlto;
								$nuevoAncho= $MaxAncho;
							}
						}elseif($alto>$ancho){
							if ($nuevoAlto>$MaxAlto){
								$nuevoAncho= ($MaxAlto / $nuevoAlto) *$nuevoAncho;
								$nuevoAlto= $MaxAlto;						
							}
						}else{
							$nuevoAlto= $MaxAlto;
							$nuevoAncho= $MaxAncho;
						}
						


						/*=============================================
						CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
						=============================================*/

						$directorio = "vistas/img/usuarios/";

						/*=============================================
						DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
						=============================================*/

						if($_FILES["logoHotel"]["type"] == "image/jpeg"){

							$aleatorio = mt_rand(100, 9999);

							$archivo="Logo".$aleatorio.".jpg";
							$ruta = $directorio.$archivo;

							$origen = imagecreatefromjpeg($_FILES["logoHotel"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

						}else if($_FILES["logoHotel"]["type"] == "image/png"){

							$aleatorio = mt_rand(100, 9999);
							$archivo="Logo".$aleatorio.".png";
							$ruta = $directorio.$archivo;

							$origen = imagecreatefrompng($_FILES["logoHotel"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagealphablending($destino, FALSE);
				
							imagesavealpha($destino, TRUE);	

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

						}else{

							return "error-formato";	
						}

				}
				else
				{


						$ruta = "vistas/img/usuarios/default.png";
				}

				if (isset($_POST["pk"])){
					$pk=$_POST["pk"];
				}else
				{
					$_POST["pk"]=1;
					//$pk=0;
				}

				$tabla = "hotel";

				$token = md5($_POST["registroEmail"]."+".$_POST["registroPassword"]);

				$encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$nomfile='CodeQr'.mt_rand(100, 9999).'.png';

				$datos = array("email" => $_POST["registroEmail"],
								"token" => $token,
								"nombre" => strtoupper($_POST["registroNombre"]),
					            "password" => $encriptarPassword,
					            "logo" => $archivo,
					            "zona" =>strtoupper($_POST["registroZona"]),
					        	"codigoQr"=>$nomfile,
					        	"pk"=>$pk
					        );
					           
				$respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
				if ($respuesta=="ok"){
					$respuestaEmail=ControladorFormularios::ctrEmailEnvia($datos);
					$Id=ModeloFormularios::mdlBuscatoken($token);
					$url_actual = "http://" . $_SERVER["SERVER_NAME"].'/huesped/index.php?id='.$Id[0]['idHotel'];

					$dir='./vistas/img/qr/'.$Id[0]['idHotel'].'/';
					
					if (!file_exists($dir)){
						mkdir($dir);
					}

					$filename=$dir.$nomfile;
					$contenido=$url_actual;
					
					//QRcode::png($contenido,$filename,$level,$tamanio,$frameSize);
					ControladorFormularios::GeneraQR($contenido,$filename);
					for ($i = 1; $i <= 10; $i++) {
						$Idhab=0;
					    $Idhab=ModeloFormularios::mdlInsertaHabitacion($Id[0]['idHotel'],0);
					    $nomfile='CodeQr'.$Id[0]['idHotel'].'-'.$Idhab[0]['id'].'.png';
					    $filename=$dir.$nomfile;
						$url_actual = "http://" . $_SERVER["SERVER_NAME"].'/huesped/index.php?id='.$Idhab[0]['id'];
						$contenido=$url_actual;
						$act=ModeloFormularios::mdlActualizaHab($Idhab[0]['id'],0,'/'.$Id[0]['idHotel'].'/'.$nomfile);
						//QRcode::png($contenido,$filename,$level,$tamanio,$frameSize);
						ControladorFormularios::GeneraQR($contenido,$filename);
					}
				}
				echo '
				<script type="text/javascript">
					console.log ("'.$respuesta.'");
					console.log ("'.$respuestaEmail.'");
				</script>
				';
			//echo $respuesta;
				return $respuesta;

			}else{
				$respuesta = "error";

				if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"])==false)
				{
					
					echo '
						<script type="text/javascript">
							console.log ("'.$_POST["registroNombre"].'");
						</script>
						';

				}
				if(preg_match('/^[0-9a-zA-Z]+$/', $_POST["registroPassword"])==false)
				{
					
					echo '
						<script type="text/javascript">
							console.log ("'.$_POST["registroPassword"].'");
						</script>
						';

				}
				if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"])==false)
				{
					//$respuesta =$respuesta.$_POST["registroEmail"];
					echo '
						<script type="text/javascript">
							console.log ("'.$_POST["registroEmail"].'");
						</script>
						';
				}				
				return $respuesta;

			}

		}

	}

	/*=============================================
			Seleccionar Registros
	=============================================*/

	static public function ctrArchivoQR($idHotel, $idHabita, $numHabita)
	{	
		$document_root = $_SERVER['DOCUMENT_ROOT'];
		if($idHabita==0){ 
			if($numHabita>0)
			{ 
				$Idhab=0;
			    $Idhab=ModeloFormularios::mdlInsertaHabitacion($idHotel,$numHabita);
			}else
			{ 
				$Idhab=0;
			    $Idhab=ModeloFormularios::mdlInsertaHabitacion($idHotel,0);
			}
		}
		
		if ($idHabita==0){
	    	$nomfile='CodeQr'.$idHotel.'-'.$Idhab[0]['id'].'.png';
	    	$url_actual = 'http://'.$_SERVER["SERVER_NAME"].'/huesped/index.php?id='.$Idhab[0]['id'];
		}else{
	    	$nomfile='CodeQr'.$idHotel.'-'.$idHabita.'.png';
	    	$url_actual = 'http://'.$_SERVER["SERVER_NAME"].'/huesped/index.php?id='.$idHabita;
		}	    	

		$dir=$document_root.'/vistas/img/qr/'.$idHotel.'/';


	    $filename=$dir.$nomfile;
		$contenido=$url_actual;

		if ($idHabita==0){
			ControladorFormularios::GeneraQR($contenido,$filename);
			$act=ModeloFormularios::mdlActualizaHab($Idhab[0]['id'],$numHabita,'/'.$idHotel.'/'.$nomfile);
			//QRcode::png($contenido,$filename,$level,$tamanio,$frameSize);
		}else
		{
			$act=ModeloFormularios::mdlActualizaHab($idHabita,$numHabita,'/'.$idHotel.'/'.$nomfile);
		}

		$respuesta=$act;//"ok";
		
		return $respuesta;

	}

	

	static public function GeneraQR($contenido,$ruta){
		$tamanio=10;
		$level='H';
		$frameSize=3;
		QRcode::png($contenido,$ruta,$level,$tamanio,$frameSize);
	}




	static public function ctrSeleccionarRegistros($item, $valor,$tabla){



		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
		
		return $respuesta;

	}



	static public function ctrSeleccionarHabitaciones($idhotel){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarHabitaciones($idhotel);
		
		return $respuesta;

	}

	static public function ctrInsertaHabitaciones($idhotel, $habitacion){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlInsertaHabitacion($idhotel, $habitacion);
		
		return $respuesta;

	}


	static public function ctrEliminarHabitaciones($idhabitacion){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlEliminaHabitacion($idhabitacion);
		
		return $respuesta;

	}






	static public function ctrStatusSolicitudes($id){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlStatusSolicitudes($id);
		
		return $respuesta;

	}


	static public function ctrBuscaEmail($item, $valor){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlBuscaEmail($item, $valor);
		
		return $respuesta;

	}




	static public function ctrSeleccionarSolicitudes($item, $valor,$tabla){


		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
		
		return $respuesta;

	}




	/*=============================================
	Ingreso
	=============================================*/

	public function ctrIngreso(){

		if(isset($_POST["ingresoEmail"])){

			$tabla = "hotel";
			$item = "emailHotel";
			$valor = $_POST["ingresoEmail"];
			$valor=strtolower($valor);
			$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
			//$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

  			$encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			if(is_array($respuesta)){
				if(($respuesta["emailHotel"] == $valor) && ($respuesta["passwordHotel"] == $encriptarPassword))
				{

					ModeloFormularios::mdlActualizarIntentosFallidos($tabla, 0, $respuesta["token"]);
					//session_start();
					$_SESSION['ok'] = true;
					$_SESSION['IdHotel'] =$respuesta["idHotel"];
					$_SESSION['logoHotel'] =$respuesta["logoHotel"];
					$_SESSION['nombreHotel'] =$respuesta["nombreHotel"];
					$_SESSION['pk'] =$respuesta["pkHotel"];

					echo '<script>

					if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

					}

					window.location = "inicio";

					</script>';

				}
				else
				{

					if($respuesta["intentos_fallidos"] < 3)
					{

						$tabla = "hotel";

						$intentos_fallidos = $respuesta["intentos_fallidos"]+1;

						ModeloFormularios::mdlActualizarIntentosFallidos($tabla, $intentos_fallidos, $respuesta["token"]);

					}
					else
					{

						echo '<div class="alert alert-warning">RECAPTCHA Debes validar que no eres un robot</div>';
					}

					echo '<script>

					if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

					}

					</script>';

					echo '<div class="alert alert-danger">Error al ingresar al sistema, el email o la contraseña no coinciden</div>';
				}
			}
			else
			{ 

				echo '<script>

				if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

				}

				</script>';

				echo '<div class="alert alert-danger">Error al ingresar al sistema, el email o la contraseña no coinciden</div>';

			}
		}

	}

	public function ctrIngresoEn(){

		if(isset($_POST["ingresoEmail"])){

			$tabla = "hotel";
			$item = "emailHotel";
			$valor = $_POST["ingresoEmail"];
			$valor=strtolower($valor);
			$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
			//$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

  			$encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			if(is_array($respuesta)){
				if(($respuesta["emailHotel"] == $valor) && ($respuesta["passwordHotel"] == $encriptarPassword))
				{

					ModeloFormularios::mdlActualizarIntentosFallidos($tabla, 0, $respuesta["token"]);
					//session_start();
					$_SESSION['ok'] = true;
					$_SESSION['IdHotel'] =$respuesta["idHotel"];
					$_SESSION['logoHotel'] =$respuesta["logoHotel"];
					$_SESSION['nombreHotel'] =$respuesta["nombreHotel"];
					$_SESSION['pk'] =$respuesta["pkHotel"];

					echo '<script>

					if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

					}

					window.location = "eninicio";

					</script>';

				}
				else
				{

					if($respuesta["intentos_fallidos"] < 3)
					{

						$tabla = "hotel";

						$intentos_fallidos = $respuesta["intentos_fallidos"]+1;

						ModeloFormularios::mdlActualizarIntentosFallidos($tabla, $intentos_fallidos, $respuesta["token"]);

					}
					else
					{

						echo '<div class="alert alert-warning">RECAPTCHA Debes validar que no eres un robot</div>';
					}

					echo '<script>

					if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

					}

					</script>';

					echo '<div class="alert alert-danger">Error when entering the system, the email or the password do not match</div>';
				}
			}
			else
			{ 

				echo '<script>

				if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

				}

				</script>';

				echo '<div class="alert alert-danger">Error when entering the system, the email or the password do not match</div>';

			}
		}

	}


	public function ctrIngresoNombre()
	{

		if(isset($_POST["ingresoNombre"])){

			$tabla = "hotel";
			$item = "nombreHotel";
			$valor = $_POST["ingresoNombre"];

			$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

			$encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			if($respuesta["nombreHotel"] == $_POST["ingresoNombre"] && $respuesta["passwordHotel"] == $encriptarPassword){

				ModeloFormularios::mdlActualizarIntentosFallidos($tabla, 0, $respuesta["token"]);

				$_SESSION["validarIngreso"] = "ok";

				echo '<script>

					if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

					}

					window.location = "inicio";

				</script>';

			}else{

				if($respuesta["intentos_fallidos"] < 3){

					$tabla = "hotel";

					$intentos_fallidos = $respuesta["intentos_fallidos"]+1;
					
					ModeloFormularios::mdlActualizarIntentosFallidos($tabla, $intentos_fallidos, $respuesta["token"]);

				}else{

					echo '<div class="alert alert-warning">RECAPTCHA Debes validar que no eres un robot</div>';

				}
			
				echo '<script>

					if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

					}

				</script>';

				echo '<div class="alert alert-danger">Error al ingresar al sistema, el email o la contraseña no coinciden</div>';
			}
			
			

		}

	}

	static public function ctrActualizarResolutor()
	{
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
							$aleatorio = "resolutor".$aleatorio.".png";
							echo ('
							<script>
								window.console.log ("'.$directorio.$aleatorio.".png".'" );
							</script>
							');
							
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
								"fotoresolutor" =>$aleatorio,
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

		static public function ctrActualizarResolutor2($IdRes,$fotoRes,$nomRes,$ApRes,$AmRes)
		{
			if(isset($IdRes))
				{
				
				$datos = array( "id" => $IdRes,
								"fotoresolutor" => $fotoRes,
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

		/*=============================================
		Actualizar Registro
		=============================================*/
		static public function ctrActualizarRegistro(){

			if(isset($_POST["actualizarNombre"])){


				if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizarNombre"]) &&
				   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["actualizarEmail"])){

					$usuario = ModeloFormularios::mdlSeleccionarRegistros("registros", "token", $_POST["tokenUsuario"]);

					if($compararToken == $_POST["tokenUsuario"] && $_POST["idUsuario"] == $usuario["id"]){
						
						if($_POST["actualizarPassword"] != ""){

							if(preg_match('/^[0-9a-zA-Z]+$/', $_POST["actualizarPassword"])){

								$password = crypt($_POST["actualizarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

							}

						}else{

							$password = $_POST["passwordActual"];
						}

						$tabla = "hotel";

						$actualizarToken = md5($_POST["actualizarNombre"]."+".$_POST["actualizarEmail"]);

						$datos = array( "id" => $_POST["idUsuario"],
										"token" => $actualizarToken,
										"nombre" => $_POST["actualizarNombre"],
							           "email" => $_POST["actualizarEmail"],
							           "password" => $password);

						$respuesta = ModeloFormularios::mdlActualizarRegistro($tabla, $datos);

						return $respuesta;

					}else{

						$respuesta = "error";

						return $respuesta;

					}

				}else{

					$respuesta = "error";

					return $respuesta;

				}
		

			}


		}



	
		


		/*=============================================
		Eliminar Registro
		=============================================*/
		public function ctrEliminarRegistro(){

			if(isset($_POST["eliminarRegistro"])){

				$usuario = ModeloFormularios::mdlSeleccionarRegistros("registros", "token",  $_POST["eliminarRegistro"]);

				$compararToken = md5($usuario["nombre"]."+".$usuario["email"]);

				if($compararToken == $_POST["eliminarRegistro"]){

					$tabla = "hotel";
					$valor = $_POST["eliminarRegistro"];

					$respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);

					if($respuesta == "ok"){
/*
						echo '<script>

							if ( window.history.replaceState ) {

								window.history.replaceState( null, null, window.location.href );

							}

							window.location = "inicio";

						</script>';
*/
						$respuesta = "ok";					
					}else{
						$respuesta = "error";	
					}

				}
			

			}

		}
    }



class ControladorTareas{

	

	static public function ctrSeleccionarRegistros($item, $valor,$tabla){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
		
		return $respuesta;

	}


}



class ControladorBusqueda{

	static public function ctrBuscaLogo($id){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlBuscaLogo($id);
		
		return $respuesta;

	}

	static public function ctrSeleccionarRegistros($item, $valor,$tabla){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
		
		return $respuesta;

	}
}


class ControladorResolutor{

		static public function ctrSeleccionarResolutores($item, $valor,$tabla){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
		
		return $respuesta;

	}

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

}

class ControladorSeleccionaTabla{
		static public function ctrSeleccionarTabla($item, $valor,$status){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarTabla($status, $item, $valor);
		
		return $respuesta;

	}
}

class ControladorPendientes{
		static public function ctrBuscaPendientes($item, $valor){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlBuscaPendientes($item, $valor);
		
		return $respuesta;

	}
}

class ControladorTotalPendientes{
		static public function ctrTotalPendientes($item, $valor){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlTotalPendientes($item, $valor);
		
		return $respuesta;

	}
}
class ControladorStatusSolicitudes{
		static public function ctrStatusSolicitudes($id){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlStatusSolicitudes($id);
		
		return $respuesta;

	}

	
}

class ControladorActualizaStatus{
	static public function ctrActualizarStatus($idsol,$status,$comentario){

			if(isset($idsol))
			{
				
			$respuesta = ModeloFormularios::mdlActualizaStatus($idsol,$status,strtoupper($comentario));
				return $respuesta;
			}else
			{
						$respuesta = "error";
						return $respuesta;
			}
		}
}

class ControladorActualizarSolicitud
{
	static public function ctrActualizarSolicitud($solicitud,$resolutor)
	{

		if(isset($solicitud))
		{
			$datos = array( "id" => $solicitud,
							"resolutor" => $resolutor,
							"status" => 3);
			$respuesta = ModeloFormularios::mdlActualizarSolicitud($datos);
			return $respuesta;
		}
		else
		{
					$respuesta = "error";
					return $respuesta;
		}
	}

}

class ControladorValidaHotel{
		static public function ctrSeleccionarRegistros($item, $valor,$tabla){

		// = "hotel";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
		
		return $respuesta;

	}
}

class ControladorRegistroId{
		static public function ctrSeleccionarRegistrosId($item, $valor,$tabla){

		// = "hotel";

		$respuesta = ModeloResolutor::mdlSeleccionarRegistrosId($tabla, $item, $valor);
		
		return $respuesta;

	}

}


class ControladorBorrarResolutor{
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
}

class ControladorActualizaResolutor{
	static public function ctrActualizarResolutor($IdRes,$fotoRes,$nomRes,$ApRes,$AmRes){
//(,$,$,$,$
		if(isset($IdRes))
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

class ControladorActDatosHotel{

	static public function ctrDatosHotel($idHotel,$Nombre,$Email,$Zona){
		if (isset($idHotel)){
			$respuesta=ModeloActualizaDatos::mdlActualizaDatosHotel($idHotel,$Nombre,$Email,$Zona);

		}else{
			$respuesta="error";
		}
		return $respuesta;
	}
}

class ControladorActPassHotel{
	static public function ctrPasswordHotel($idHotel,$Password){
		if (isset($idHotel)){
			$encriptarPassword = crypt($Password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			$respuesta=ModeloActualizaPass::mdlActPassword($idHotel,$encriptarPassword);
		}else{
			$respuesta="error";
		}
		return $respuesta;
	}
}

class ControladorLogoHotel{
	static public function ctrActualizarLgHotel($IdHotel){
		$aleatorio='';
		if(isset($IdHotel) && isset($_FILES["logoHotelAct"]["tmp_name"]))
		{
			if(isset($_FILES["logoHotelAct"]["tmp_name"]) && !empty($_FILES["logoHotelAct"]["tmp_name"]))
			{
				/*=============================================
				CAPTURAR ANCHO Y ALTO ORIGINAL DE LA IMAGEN Y DEFINIR LOS NUEVOS VALORES
				=============================================*/
				list($ancho, $alto) = getimagesize($_FILES["logoHotelAct"]["tmp_name"]);
				$nuevoAncho = 128;
				$nuevoAlto = 128;
				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
				$directorio = "vistas/img/usuarios/";
				if($_FILES["logoHotelAct"]["type"] == "image/jpeg")
				{
						$aleatorio = mt_rand(100, 9999);
						$aleatorio = "Logo".$aleatorio.".jpg";
						$ruta = $directorio.$aleatorio;
						$origen = imagecreatefromjpeg($_FILES["logoHotelAct"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
				}
				else if($_FILES["logoHotelAct"]["type"] == "image/png")
				{
					$aleatorio = mt_rand(100, 9999);

					$aleatorio = "Logo".$aleatorio.".png";
					$ruta = $directorio.$aleatorio;
					$origen = imagecreatefrompng($_FILES["logoHotelAct"]["tmp_name"]);
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagealphablending($destino, FALSE);
					imagesavealpha($destino, TRUE);	
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
				}else
				{
						return "error";	
				}
			}
			else
			{
					$ruta = null;
			 }
			$datos = array( "id" => $IdHotel,
							"fotoHotel" => $aleatorio
							);
			$respuesta = ModeloActLogo::mdlActualizarLogo($datos);
			$_SESSION['logoHotel']=$ruta;
			$respuesta=$ruta;
			return $respuesta;
		}else
		{
				$respuesta = "error";
				return $respuesta;
		}
		
	}
	
	static public function ctrActualizarBuscaLogo($IdHotel){
		$rutaLogo = "http://" . $_SERVER["SERVER_NAME"]."/vistas/img/";

		if(isset($IdHotel)){
			$respuesta=ModeloFormularios::mdlSeleccionarRegistros('hotel','idHotel',intval($IdHotel));
			if(isset($respuesta)){
				if(is_null($respuesta['logoHotel'])){
					echo '<img src="'.$rutaLogo.'subirFoto.png" class="prevlogoHotelAct"  width="200" height="200">';
				}else{
					//$logoHtl=$respuesta['logoHotel'];	
					echo '<img src="'.$rutaLogo.'usuarios/'.$respuesta['logoHotel'].'" class="prevlogoHotelAct"  width="200" height="200">';
				}
				$respuesta="ok";
			}else
			{
				$respuesta="error";
			}
		}else{
			$respuesta="error";
		}
		return $respuesta;
	}	
}