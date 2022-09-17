<?php

require_once "conexion.php";

class ModeloDatos{

	/*=============================================
	Registro
	=============================================*/


	static public function mdlMuestraOpc01($datos){
		if (isset($datos)){
			$stmt = Conexion::conectar()->prepare("SELECT 
			(case statussolicitud when 1 then 'SIN ASIGNAR' WHEN 2 THEN 'TERMINADAS' WHEN 3 THEN 'EN PROCESO' WHEN 4 THEN 'CENCELADAS'  end) as  status, if(A.idresolutor=0,'ÁREA DE RECEPCIÓN', upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor)))) as nombre_resolutor, numhabitacionhuesped,apellidoHuesped,FechaHorasolicitud,descripcionsolicitud,valoracionsolicitud,comentariosolicitud,nombreTarea FROM solicitud A left join resolutor b on A.idresolutor=b.idresolutor left join tareas c on A.idtarea=c.idTarea WHERE A.idHotel=:idhotel and date(FechaHorasolicitud) BETWEEN :fecha1 and :fecha2
			order by statussolicitud, FechaHorasolicitud;");

			$stmt->bindParam(":idhotel", $datos["idhtl"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha1", $datos["fecha1"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha2", $datos["fecha2"], PDO::PARAM_STR);

		$stmt->execute();

			return $stmt -> fetchAll();
		}
		else{
			return 'error';
		}
		$stmt->close();

		$stmt = null;	
	}


	static public function mdlMuestraOpc02($datos){
		if (isset($datos)){
			$stmt = Conexion::conectar()->prepare("SELECT count(solicitud.idtarea) as total, tareas.nombreTarea from solicitud LEFT join tareas on solicitud.idtarea = tareas.idTarea where solicitud.idHotel=:idhotel  and date(FechaHorasolicitud) BETWEEN :fecha1 and :fecha2 group by solicitud.idtarea order by count(solicitud.idtarea) desc;");

			$stmt->bindParam(":idhotel", $datos["idhtl"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha1", $datos["fecha1"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha2", $datos["fecha2"], PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetchAll();
		}
		else{
			return 'error';
		}
		$stmt->close();

		$stmt = null;	
	}



	static public function mdlMuestraOpc03($datos){
		if (isset($datos)){

				$stmt = Conexion::conectar()->prepare("SELECT count(numhabitacionhuesped) as total,numhabitacionhuesped FROM `solicitud` where idHotel=:idhotel and date(FechaHorasolicitud) BETWEEN :fecha1 and :fecha2 group by numhabitacionhuesped order by count(numhabitacionhuesped) desc;");
			

			$stmt->bindParam(":idhotel", $datos["idhtl"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha1", $datos["fecha1"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha2", $datos["fecha2"], PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetchAll();
		}
		else{
			return 'error';
		}
		$stmt->close();

		$stmt = null;	
	}


	static public function mdlMuestraOpc04($datos){
		if (isset($datos)){
			$stmt = Conexion::conectar()->prepare("SELECT if(A.idresolutor=0,'ÁREA DE RECEPCIÓN', upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor)))) as nombre_resolutor, (SUM(`valoracionsolicitud`)/count(A.idresolutor)) as total,count(A.idresolutor) as TotalS from solicitud as A LEFT join resolutor as B on A.idresolutor=B.idresolutor where A.idHotel=:idhotel and date(FechaHorasolicitud) BETWEEN :fecha1 and :fecha2 group by A.idresolutor order by (SUM(`valoracionsolicitud`)/count(A.idresolutor)) desc ;");

			$stmt->bindParam(":idhotel", $datos["idhtl"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha1", $datos["fecha1"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha2", $datos["fecha2"], PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetchAll();
		}
		else{
			return 'error';
		}
		$stmt->close();

		$stmt = null;	
	}


}