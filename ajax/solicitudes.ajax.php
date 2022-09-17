<?php

include "../controladores/formularios.controlador.php";
include "../modelos/formularios.modelo.php";

/*=============================================
Clase de AJAX
=============================================*/

class AjaxSolicitud{

	public $validarHotel;

	public function ajaxValidarHotel(){

		$item = "idHotel";
		$valor = $this->validarHotel;

		$respuesta = ControladorValidaHotel::ctrSeleccionarRegistros($item,$valor,'solicitud');
		
		echo json_encode($respuesta);
	}

	public $validarSolicitud;

	public function ajaxValidarsolicitud(){

		$item = "idsolicitud";
		$valor = $this->validarSolicitud;

		$respuesta = ControladorBusqueda::ctrSeleccionarRegistros($item,$valor,'solicitud');
		
		echo json_encode($respuesta);
	}


	public $validarResId;
	public $validarResIdSol;
	

	public function ajaxValidarResolutor(){

		$IdSol = $this->validarResIdSol;
		$IdRes = $this->validarResId;
		

		$respuesta = ControladorActualizarSolicitud::ctrActualizarSolicitud($IdSol,$IdRes);
		//if ($respuesta=="ok"){
		
			echo ($respuesta);
		//	header("Location: solicitudes");
		//}
		
	}

	public $valStatus;

	public function ajaxValidarStatus(){

		$item = "idHotel";
		$valor = $this->validarStatus;

		$respuesta = ControladorStatusSolicitudes::ctrStatusSolicitudes($valor);
		
		echo json_encode($respuesta);
	}

	public $StsValor;

	public function ajaxActualizaStatus(){

		$id = $this->validaridSolSts;
		$valor = $this->validarStatus;
		$comentario = $this->validarComenta;


		$respuesta = ControladorActualizaStatus::ctrActualizarStatus($id,$valor,$comentario);

		echo json_encode($respuesta);
	}


	public $PValor;

	public function ajaxBuscaPend(){

		$id = $this->validarPitem;
		$valor = $this->validarPvalor;
		///ControladorTotalPendientes::ctrTotalPendientes('idhotel',$_SESSION['IdHotel']);
		$respuesta = ControladorTotalPendientes::ctrTotalPendientes($id,$valor);

		echo json_encode($respuesta);		
	}


}


if(isset($_POST["hotel_id"])){

	$valSolicitud = new AjaxSolicitud();
	$valSolicitud -> validarHotel = $_POST["hotel_id"];
	$valSolicitud -> ajaxValidarHotel();

}


if(isset($_POST["solicitud_id"])){

	$valSolicitud = new AjaxSolicitud();
	$valSolicitud -> validarSolicitud = $_POST["solicitud_id"];
	$valSolicitud -> ajaxValidarsolicitud();

}

if(isset($_POST["idActualizaRes"])){

	$valResolutor = new AjaxSolicitud();
	$valResolutor -> validarResIdSol = $_POST["idsol"];
	$valResolutor -> validarResId = $_POST["idActualizaRes"];
	$valResolutor -> ajaxValidarResolutor();

}


if(isset($_POST["hotelSt"])){

	$valStatus = new AjaxSolicitud();
	$valStatus -> validarStatus= $_POST["hotelSt"];
	$valStatus -> ajaxValidarStatus();

}

if(isset($_POST["solicitud"]) && isset($_POST["status"])){

	$StsValor = new AjaxSolicitud();
	$StsValor -> validaridSolSts= $_POST["solicitud"];
	$StsValor -> validarStatus= $_POST["status"];
	$StsValor -> validarComenta= $_POST["comenta"];	
	$StsValor -> ajaxActualizaStatus();

}


if(isset($_POST["item"]) && isset($_POST["valorItem"])){

	$PValor = new AjaxSolicitud();
	$PValor -> validarPitem= $_POST["item"];
	$PValor -> validarPvalor= $_POST["valorItem"];
	$PValor -> ajaxBuscaPend();

}