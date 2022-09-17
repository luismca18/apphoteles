<?php

require_once "conexion.php";

class ModeloResolutor{

	/*=============================================
	Registro
	=============================================*/

	static public function mdlRegistro($tabla, $datos){

		#statement: declaración

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idHotel,nombreresolutor, apellidoPresolutor, apellidoMresolutor, fotoresolutor) VALUES (:idhotel, :nombre, :apellidoP, :apellidoM, :foto)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
//		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		
		$stmt->bindParam(":idhotel", $datos["idhotel"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	static public function mdlSeleccionarRegistros($tabla, $item, $valor){

				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor FROM $tabla ORDER BY idresolutor");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor FROM $tabla WHERE $item = :$item ORDER BY idresolutor");

					$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt -> fetchAll();
				}

				$stmt->close();

				$stmt = null;	
		

	}



	static public function mdlSeleccionarRegistrosId($tabla, $item, $valor){

				if($item == null && $valor == null){

					$stmt = Conexion::conectar()->prepare("SELECT `idresolutor`,`fotoresolutor`,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nombreresolutor FROM $tabla ORDER BY idresolutor");

					$stmt->execute();

					return $stmt -> fetchAll();

				}else{

					$stmt = Conexion::conectar()->prepare("SELECT idresolutor,concat_ws('','img/usuarios/resolutores/',fotoresolutor) as ruta,fotoresolutor,upper( concat_ws(' ',trim(nombreresolutor), trim(apellidoPresolutor), trim(apellidoMresolutor))) as nomresolutor, upper(nombreresolutor) as nombreresolutor, upper(apellidoPresolutor) as apellidoPresolutor, upper(apellidoMresolutor) as apellidoMresolutor FROM $tabla WHERE $item = :$item ORDER BY idresolutor");

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
	
		$stmt = Conexion::conectar()->prepare("UPDATE resolutor SET nombreresolutor = :nombre, apellidoPresolutor = :apeP, apellidoMresolutor = :apeM, fotoresolutor = :foto WHERE idresolutor = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nomresolutor"], PDO::PARAM_STR);
		$stmt->bindParam(":apeP", $datos["apresolutor"], PDO::PARAM_STR);
		$stmt->bindParam(":apeM", $datos["amresolutor"], PDO::PARAM_STR);
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