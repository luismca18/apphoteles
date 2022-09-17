<?php

require_once "modelos/datos.modelo.php";
class ControladorDatos{
	
	static public function ctrMostrarRegistros($id_H,$Opc,$Fecha1,$Fecha2){

		if (isset($Fecha1) && isset($Fecha2)){ 
			/*$tamFec=strlen($Fechas);
			$fecha01=trim(substr($Fechas,0,10));
			$fecha02=trim(substr($Fechas,13,23));
			$fecha01=trim(str_replace('-','/',$fecha01));
			$fecha02=trim(str_replace('-','/',$fecha02));*/
				
			$fecha01=$Fecha1;
			$fecha02=$Fecha2;
			
			$datos = array("idhtl" => $id_H,
							"fecha1" => $fecha01,
						     "fecha2" => $fecha02
						   );

			if ($Opc=="1"){
				$respuesta = ModeloDatos::mdlMuestraOpc01($datos);

			}elseif ($Opc=="2"){
				$respuesta = ModeloDatos::mdlMuestraOpc02($datos);
			}elseif ($Opc=="3"){
				$respuesta = ModeloDatos::mdlMuestraOpc03($datos);
			}elseif ($Opc=="4"){
				$respuesta = ModeloDatos::mdlMuestraOpc04($datos);
			}
			
			echo '<script type="text/javascript"> console.dir('.json_encode($respuesta).');</script>'; 
		
			return $respuesta;

		}
	}

}