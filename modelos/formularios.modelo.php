<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];
include_once $document_root.'/apphoteles/codigo_qr/phpqrcode/qrlib.php';
//require_once ($document_root.'/fpdf/fpdf.php');
require_once "conexion.php";

class ModeloFormularios
{

	/*=============================================
	Registro
	=============================================*/

	static public function mdlRegistro($tabla, $datos){

		#statement: declaración

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(emailHotel, token, nombreHotel, passwordHotel,logoHotel,zonaHotel, codigoQrHotel, pkHotel) VALUES (:email, :token, :nombre, :password, :logo, :zona, :codigoQr, :pk)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
		$stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
		$stmt->bindParam(":codigoQr", $datos["codigoQr"], PDO::PARAM_STR);
		$stmt->bindParam(":pk", $datos["pk"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();

		$stmt = null;	

	}


	static public function mdlInsertaHabitacion($idhotel, $habitacion){


		$stmt = Conexion::conectar()->prepare("INSERT INTO habitaciones (idHotel, foliohabitaciones, numhabitacionhuesped) VALUES (:idhotel, 0, :habitacion);");

		$stmt->bindParam(":idhotel", $idhotel, PDO::PARAM_INT);
		$stmt->bindParam(":habitacion", $habitacion, PDO::PARAM_INT);

		if($stmt->execute()){
			$ultimo_id = Conexion::conectar()->prepare("SELECT max(idhabitaciones) as id FROM habitaciones WHERE idHotel=:idhotel;"); 
			$ultimo_id->bindParam(":idhotel", $idhotel, PDO::PARAM_INT);
			$ultimo_id->execute();
			return $ultimo_id -> fetchAll();
		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	static public function mdlGeneraQR($contenido,$ruta){
		$tamanio=10;
		$level='H';
		$frameSize=3;
		QRcode::png($contenido,$ruta,'H',10,3);
	}

	static public function mdlEliminaHabitacion($idhabitacion){

	
		$stmt = Conexion::conectar()->prepare("DELETE FROM habitaciones WHERE idhabitaciones = :idhabitacion");

		$stmt->bindParam(":idhabitacion", $idhabitacion, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	


	}


	static public function mdlBuscatoken($token){

				if($token != null){

					$stmt = Conexion::conectar()->prepare("SELECT idHotel from hotel where token=:token  LIMIT 1");
					$stmt->bindParam(":token", $token, PDO::PARAM_STR);
					$stmt->execute();

					return $stmt -> fetchAll();
				}else{
					return "error";
				}

		
	}


	static public function mdlBuscaLogo($id){

				if($id != null){

					$stmt = Conexion::conectar()->prepare("SELECT logoHotel from hotel where idHotel=:id  LIMIT 1");
					$stmt->bindParam(":id", $id, PDO::PARAM_STR);
					$stmt->execute();

					return $stmt -> fetchAll();
				}else{
					return "error";
				}

		
	}

	static public function mdlMuestraOpc01($datos)
	{
		//if (isset($datos)){
		$cad="select * from solicitud";
			
			$stmt = Conexion::conectar()->prepare($cad);
			//and FechaHorasolicitud BETWEEN '2021/20/09' and '2021/15/11
                    echo '<script type="text/javascript"> console.dir("'.$cad.'");</script>'; 
                       echo '<script type="text/javascript"> console.dir("'.$datos["fecha2"].'");</script>'; 
                          //echo '<script type="text/javascript"> console.dir("'.$stmt.'");</script>'; 
                         
			//$stmt->bindParam(":idhotel", $datos["idhtl"], PDO::PARAM_STR);
			//$stmt->bindParam(":fecha1", $datos["fecha1"], PDO::PARAM_STR);
			//$stmt->bindParam(":fecha2", $datos["fecha2"], PDO::PAR;AM_STR);


			//$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();
			//print_r(Conexion::conectar()->errorInfo());
			return $stmt -> fetchAll();
			//echo '<script type="text/javascript"> console.dir("'.json_encode($stmt ).'");</script>';
		
		$stmt->close();

		$stmt = null;	
	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	
	static public function mdlSeleccionarRegistros($tabla, $item, $valor){
		//$idhtl=$_SESSION['IdHotel'];
		if ($tabla=='hotel'){
				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( fechahoraHotel,'+00:00','-06:00'), '%d/%m/%Y') AS fechahoraHotel FROM $tabla
					  ORDER BY idHotel DESC");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( fechahoraHotel,'+00:00','-06:00'), '%d/%m/%Y') AS fechahoraHotel FROM $tabla WHERE $item = :$item ORDER BY idHotel DESC");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetch();
				}
		}elseif ($tabla=='solicitud'){
				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( FechaHorasolicitud,'+00:00','-06:00'), '%d/%m/%Y') AS FechaHorasolicitud FROM $tabla LEFT join resolutor C on solicitud.idresolutor=C.idresolutor where  date(CONVERT_TZ( FechaHorasolicitud,'+00:00','-06:00'))=date(CONVERT_TZ(now(),'+00:00','-06:00'))  ORDER BY idsolicitud DESC");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT folioHotel, idsolicitud,apellidoHuesped,upper(descripcionsolicitud) as descripcionsolicitud, valoracionsolicitud, upper(nombretarea) as comentariosolicitud, upper(comentarioHotel) as comentarioresolutor, statussolicitud, fotoresolutor, numhabitacionhuesped,DATE_FORMAT(FechaHorasolicitud, '%h:%i:%s') AS tiempo,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombre_resolutor,DATE_FORMAT(FechaHorasolicitud, '%d/%m/%Y') AS FechaHorasolicitud FROM $tabla LEFT join resolutor C on $tabla.idresolutor=C.idresolutor   left join tareas D on solicitud.idtarea =D.idTarea WHERE $tabla.$item = :$item and ( date(DATE_FORMAT(FechaHorasolicitud,'%d/%m/%Y'))=date(DATE_FORMAT(now(),'%d/%m/%Y')) or statussolicitud in (1,3))  ORDER BY idsolicitud");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetchAll();
				}
		}elseif ($tabla=='resolutor'){
				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor ,upper(puestoresolutor) as puestoresolutor FROM $tabla ORDER BY idresolutor DESC");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor ,upper(puestoresolutor)  as puestoresolutor FROM $tabla WHERE  $item = :$item ORDER BY idresolutor DESC");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetchAll();
				}
		 }elseif ($tabla=='tareas'){
				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  ORDER BY idtarea DESC");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY idtarea DESC");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetchAll();
				}
		}
		$stmt->close();

		$stmt = null;	
		

	}

	static public function mdlSeleccionarTabla($status, $item, $valor){


		if($item == null && $valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( FechaHorasolicitud,'+00:00','-06:00'), '%d/%m/%Y') AS FechaHorasolicitud FROM $tabla LEFT join resolutor C on solicitud.idresolutor=C.idresolutor where  date(CONVERT_TZ( FechaHorasolicitud,'+00:00','-06:00'))=date(CONVERT_TZ(now(),'+00:00','-06:00'))  ORDER BY idsolicitud DESC");

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{
			if ($status==0){ 
				$stmt = Conexion::conectar()->prepare("SELECT folioHotel, idsolicitud,apellidoHuesped,statussolicitud,fotoresolutor,numhabitacionhuesped,IF(statussolicitud=3,DATE_FORMAT(tiempoStatus, '%H:%i:%s'),DATE_FORMAT(FechaHorasolicitud, '%H:%i:%s')) AS tiempo,upper(trim(nombreresolutor)) as nombre_resolutor,upper(trim(apellidoPresolutor)) as apellidoResolutor,DATE_FORMAT(FechaHorasolicitud, '%d/%m/%Y') AS FechaHorasolicitud FROM solicitud LEFT join resolutor C on solicitud.idresolutor=C.idresolutor  WHERE (solicitud.$item = :$item and autorizado=1 and date(FechaHorasolicitud)=date(CONVERT_TZ(now(),'+00:00','-05:00')) and statussolicitud in (2,4)) or  (solicitud.$item = :$item and autorizado=1 and statussolicitud in (1,3)) ORDER BY idsolicitud;");
			
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt -> fetchAll();
			}else{


				$stmt = Conexion::conectar()->prepare("SELECT folioHotel, idsolicitud,apellidoHuesped,statussolicitud,fotoresolutor,numhabitacionhuesped,IF(statussolicitud=3,DATE_FORMAT(tiempoStatus, '%H:%i:%s'),DATE_FORMAT(FechaHorasolicitud, '%H:%i:%s')) AS tiempo,upper(trim(nombreresolutor)) as nombre_resolutor,upper(trim(apellidoPresolutor)) as apellidoResolutor,DATE_FORMAT(FechaHorasolicitud, '%d/%m/%Y') AS FechaHorasolicitud FROM solicitud LEFT join resolutor C on solicitud.idresolutor=C.idresolutor  WHERE (solicitud.$item = :$item and autorizado=1 and date(FechaHorasolicitud)=date(CONVERT_TZ(now(),'+00:00','-05:00'))  and statussolicitud=$status ) or (solicitud.$item = :$item and autorizado=1  and statussolicitud in (1,3) and statussolicitud=$status ) ORDER BY idsolicitud;");

				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				//$stmt->bindParam(":".$status, $status, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt -> fetchAll();
			}
		}


		$stmt->close();

		$stmt = null;	
		

	}



	static public function mdlBuscaPendientes($item, $valor){


		if($item == null && $valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( FechaHorasolicitud,'+00:00','-06:00'), '%d/%m/%Y') AS FechaHorasolicitud FROM $tabla LEFT join resolutor C on solicitud.idresolutor=C.idresolutor where  date(CONVERT_TZ( FechaHorasolicitud,'+00:00','-06:00'))=date(CONVERT_TZ(now(),'+00:00','-06:00'))  ORDER BY idsolicitud DESC");

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{
			 
				$stmt = Conexion::conectar()->prepare("SELECT numhabitacionhuesped, 'PARA VER ESTA SOLICITUD ACTUALICE SU PAQUETE' as mensaje FROM solicitud  WHERE solicitud.$item = :$item  AND autorizado=0 and ((date( FechaHorasolicitud)=date(now()) or statussolicitud in (1,3)))  ORDER BY idsolicitud;");
			
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt -> fetchAll();
			
		}


		$stmt->close();

		$stmt = null;	
		

	}

	static public function mdlTotalPendientes($item, $valor){


		if($item == null && $valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( FechaHorasolicitud,'+00:00','-06:00'), '%d/%m/%Y') AS FechaHorasolicitud FROM $tabla LEFT join resolutor C on solicitud.idresolutor=C.idresolutor where date(DATE_FORMAT(FechaHorasolicitud,'%d-%m-%Y'))=date(DATE_FORMAT(now(),'%d-%m-%Y'))  ORDER BY idsolicitud DESC;");

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{
			 
				$stmt = Conexion::conectar()->prepare("SELECT  count(*) as total FROM solicitud  WHERE solicitud.$item = :$item  AND autorizado=0 and ((date(DATE_FORMAT(FechaHorasolicitud,'%d-%m-%Y'))=date(DATE_FORMAT(now(),'%d-%m-%Y')) or statussolicitud in (1,3)))  ORDER BY idsolicitud;");
			
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt -> fetchAll();
			
		}


		$stmt->close();

		$stmt = null;	
		

	}


	static public function mdlSeleccionarHabitaciones($idhotel){


		

			$stmt = Conexion::conectar()->prepare("SELECT * from habitaciones where idHotel=:idhotel order by foliohabitaciones");

			$stmt->bindParam(":idhotel", $idhotel, PDO::PARAM_INT);
			
			$stmt->execute();

			return $stmt -> fetchAll();

		


		$stmt->close();

		$stmt = null;	
		

	}


	static public function mdlBuscaEmail($item, $valor)
	{
		//$idhtl=$_SESSION['IdHotel'];
				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( fechahoraHotel,'+00:00','-06:00'), '%d/%m/%Y') AS fechahoraHotel FROM hotel
					  ORDER BY idHotel DESC");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(CONVERT_TZ( fechahoraHotel,'+00:00','-06:00'), '%d/%m/%Y') AS fechahoraHotel FROM hotel WHERE emailHotel = :$item ORDER BY idHotel DESC");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetchAll();
				}

		
		$stmt->close();

		$stmt = null;	
		

	}
	


	/*=============================================
	Actualizar Registro
	=============================================*/
	static public function mdlActualizaStatus($idsol,$status,$comentario){
        if ($status	==2 or $status==4){
		    $stmt = Conexion::conectar()->prepare("UPDATE solicitud SET statussolicitud = $status,idresolutor=0, comentarioHotel = :$status WHERE idsolicitud =$idsol");
        }
		else{
		    $stmt = Conexion::conectar()->prepare("UPDATE solicitud SET statussolicitud = $status, comentarioHotel = :$status WHERE idsolicitud =$idsol");
		}
		$stmt->bindParam(":".$status, $comentario, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Actualizar HABITACION
	=============================================*/
	static public function mdlActualizaHab($id,$hab,$qr)
	{
		$document_root = $_SERVER['DOCUMENT_ROOT']."/vistas/img/qr";
		if (isset($hab) && isset($qr)){
			$pos=stripos($qr,'/',1);
			$pos2=stripos($qr,'.',1);
			$dirpdf=$document_root.substr($qr, 0,$pos).'/pdf';
			$dir=$document_root.$qr;
			$arcpdf=substr($qr, $pos+1,$pos2-$pos).'pdf';
			$qr2=substr($qr, 0,$pos).'/pdf'.'/'.$arcpdf;
			$idh=intval(substr($qr, 1,$pos-1));
			if (!file_exists($dirpdf)){
				mkdir($dirpdf);
			}
		}
			
		if (!isset($hab))
		{ 
			$stmt = Conexion::conectar()->prepare("UPDATE habitaciones SET numhabitacionhuesped = :hab, qrhabitaciones = :qr WHERE idhabitaciones =:id");		
			$stmt->bindParam(":hab", $hab, PDO::PARAM_INT);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":qr", $qr, PDO::PARAM_STR);	
			if($stmt->execute()){
				return "ok"; 
			}else{
				print_r(Conexion::conectar()->errorInfo());
			}
			$stmt->close();
			$stmt = null;	
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("UPDATE habitaciones SET numhabitacionhuesped = :hab, qrhabitaciones = :qr, qrPdf = :arcpdf WHERE idhabitaciones =:id");
			$stmt->bindParam(":hab", $hab, PDO::PARAM_INT);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":qr", $qr, PDO::PARAM_STR);
			$stmt->bindParam(":arcpdf", $qr2, PDO::PARAM_STR);
		
		if($stmt->execute()){
			return "ok";// 
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;	
		}

	}
	//////////////////actualiza status
	static public function mdlActualizarRegistro($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token = :token, nombreHotel=:nombre, emailHotel=:email, passwordHotel=:password, logoHotel=:logo WHERE idHotel = :idHotel");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}
	
	
		static public function mdlActualizaPass(){
	    
	    if (isset($_POST["newPass"])){
	    
	    $encriptarPassword = crypt($_POST["newPass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
	    
		$stmt = Conexion::conectar()->prepare("UPDATE hotel SET passwordHotel =:pass where token = :token ");

		
		$stmt->bindParam(":pass", $encriptarPassword , PDO::PARAM_STR);
		$stmt->bindParam(":token", $_POST["token"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}
		    
		}
/*

======================================================================================

									Solicitudes

======================================================================================
*/
	static public function mdlSeleccionarSolicitudes($id){
		$item="solicitud.idsolicitud";
		if(isset($id)){
/*
			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fechahoraSolicitud, '%d/%m/%Y') AS fechahoraSolicitud FROM $tabla LEFT join resolutor C on solicitud.idresolutor=C.idresolutor where  date(fechahoraSolicitud)=date(now())  ORDER BY idsolicitud DESC");

			$stmt->execute();

			return $stmt -> fetchAll();		}else{
*/
			$stmt = Conexion::conectar()->prepare("SELECT *,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombre_resolutor,DATE_FORMAT(CONVERT_TZ( fechahoraSolicitud,'+00:00','-06:00'), '%d/%m/%Y') AS fechahoraSolicitud FROM $tabla LEFT join resolutor C on solicitud.idresolutor=C.idresolutor   WHERE $item = :$item and date(CONVERT_TZ( fechahoraSolicitud,'+00:00','-06:00'))=date(CONVERT_TZ(now(),'+00:00','-06:00'))  ORDER BY idsolicitud DESC");

			$stmt->bindParam(":".$item, $id, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt -> fetchAll();
		}

		$stmt->close();

		$stmt = null;	
		

	}


	static public function mdlStatusSolicitudes($id){
		//$item="solicitud.idsolicitud";
		if(isset($id)){
/*
			$stmt = Conexion::conectar()->prepare("SELECT `statussolicitud`, count(`statussolicitud`) as total FROM solicitud 
WHERE solicitud.idHotel =".$id." and (date( FechaHorasolicitud)=date(now()) or statussolicitud in (1,3))   group by statussolicitud order by statussolicitud ;");
*/

			$stmt = Conexion::conectar()->prepare("select (SELECT  count(statussolicitud) as total FROM solicitud 
WHERE solicitud.idHotel  =".$id." and date(FechaHorasolicitud)=date(CONVERT_TZ(now(),'+00:00','-05:00'))  and statussolicitud in (2)) as atendida,
(SELECT  count(statussolicitud) as total FROM solicitud 
WHERE solicitud.idHotel  =".$id." and statussolicitud in (1)) as SinAsignar,
(SELECT  count(statussolicitud) as total FROM solicitud 
WHERE solicitud.idHotel  =".$id." and  statussolicitud in (3)) as EnProceso,
(SELECT  count(statussolicitud) as total FROM solicitud 
WHERE solicitud.idHotel  =".$id." and date(FechaHorasolicitud)=date(CONVERT_TZ(now(),'+00:00','-05:00'))  and statussolicitud in (4)) as cancelada;");

			//$stmt->bindParam(":".$item, $id, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt -> fetchAll();
		}

		$stmt->close();

		$stmt = null;	
		

	}

	static public function mdlActualizarSolicitud($datos){
	
	
				$stmt = Conexion::conectar()->prepare("UPDATE solicitud SET statussolicitud = 3, idresolutor=:idresolutor WHERE idsolicitud = :idsolicitud");

				//$stmt->bindParam(":status", $datos["status"], PDO::PARAM_INT);
				$stmt->bindParam(":idresolutor", $datos["resolutor"], PDO::PARAM_INT);
				$stmt->bindParam(":idsolicitud", $datos["id"], PDO::PARAM_INT);
			
	 	
		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

/*=============================================
	totales Registro
	=============================================*/

	static public function mdlTotalesRegistro($tabla,$item){
	
		$stmt = Conexion::conectar()->prepare("SELECT `statussolicitud`, count(`statussolicitud`) FROM $tabla WHERE `idHotel`=$item
group by `statussolicitud` ");

		$stmt->bindParam(":token", $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Eliminar Registro
	=============================================*/
	static public function mdlEliminarRegistro($tabla, $valor){
	
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE token = :token");

		$stmt->bindParam(":token", $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Actualizar Intentos fallidos
	=============================================*/

	static public function mdlActualizarIntentosFallidos($tabla, $valor, $token){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos_fallidos=:intentos_fallidos WHERE token = :token");

		$stmt->bindParam(":intentos_fallidos", $valor, PDO::PARAM_INT);
		$stmt->bindParam(":token", $token, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}



}

class ModeloResolutor{

	/*=============================================
	Registro
	=============================================*/

	static public function mdlRegistro($tabla, $datos){

		#statement: declaración

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idHotel,nombreresolutor, apellidoPresolutor, puestoresolutor, fotoresolutor) VALUES (:idhotel, :nombre, :apellidoP, :apellidoM, :foto)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
//		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		
		$stmt->bindParam(":idhotel", $datos["idhotel"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", strtoupper($datos["nombre"]), PDO::PARAM_STR);
		$stmt->bindParam(":apellidoP", strtoupper($datos["apellidoP"]), PDO::PARAM_STR);
		$stmt->bindParam(":apellidoM", strtoupper($datos["apellidoM"]), PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}


	static public function mdlSeleccionarRegistros($tabla, $item, $valor){

				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor, upper(puestoresolutor) as puestoresolutor FROM $tabla ORDER BY idresolutor");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor, upper(puestoresolutor) as puestoresolutor FROM $tabla WHERE $item = :$item ORDER BY idresolutor");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetchAll();
				}

				$stmt->close();

				$stmt = null;	
		

	}



	static public function mdlSeleccionarRegistrosId($tabla, $item, $valor){

				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor,upper(puestoresolutor) AS puestoresolutor FROM $tabla ORDER BY idresolutor");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT idresolutor,concat_ws('','img/usuarios/resolutores/',fotoresolutor) as ruta,fotoresolutor,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nomresolutor, upper(nombreresolutor) as nombreresolutor, upper(apellidoPresolutor) as apellidoPresolutor, upper(apellidoMresolutor) as apellidoMresolutor,upper(puestoresolutor) AS puestoresolutor FROM $tabla WHERE $item = :$item ORDER BY idresolutor");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetchAll();
				}

				$stmt->close();

				$stmt = null;	
		

	}


	/*=============================================
	Actualizar Registro
	=============================================*/

	static public function mdlActualizarResolutor($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE resolutor SET nombreresolutor = :nombre, apellidoPresolutor = :apeP, puestoresolutor = :apeM, fotoresolutor = :foto WHERE idresolutor = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", strtoupper($datos["nomresolutor"]), PDO::PARAM_STR);
		$stmt->bindParam(":apeP", strtoupper($datos["apresolutor"]), PDO::PARAM_STR);
		$stmt->bindParam(":apeM", strtoupper($datos["amresolutor"]), PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["fotoresolutor"], PDO::PARAM_STR);
		//$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

/*=============================================
	totales Registro
	=============================================*/

	static public function mdlTotalesRegistro($tabla,$item){
	
		$stmt = Conexion::conectar()->prepare("SELECT `statussolicitud`, count(`statussolicitud`) FROM $tabla WHERE `idHotel`=$item
group by `statussolicitud` ");

		$stmt->bindParam(":token", $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Eliminar Registro
	=============================================*/
	static public function mdlEliminarRegistro($valor){
	
		$stmt = Conexion::conectar()->prepare("DELETE FROM resolutor WHERE idresolutor = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}
	
}

class ModeloActualizaDatos{
	static public function mdlActualizaDatosHotel($idHotel,$Nombre,$Email,$Zona){
	
		$stmt = Conexion::conectar()->prepare("UPDATE hotel SET nombreHotel =:Nombre, emailHotel = :Email, zonaHotel=:Zona WHERE idHotel =$idHotel");
		$stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
		$stmt->bindParam(":Email", $Email, PDO::PARAM_STR);
		$stmt->bindParam(":Zona", $Zona, PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

}



class ModeloActualizaPass{
	static public function mdlActPassword($idHotel,$passEncrip){
	
		$stmt = Conexion::conectar()->prepare("UPDATE hotel SET passwordHotel =:passEncrip WHERE idHotel =$idHotel");
		$stmt->bindParam(":passEncrip", $passEncrip, PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

}


class ModeloActLogo{
	static public function mdlActualizarLogo($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE hotel SET logoHotel = :foto WHERE idHotel = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["fotoHotel"], PDO::PARAM_STR);
		//$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

}