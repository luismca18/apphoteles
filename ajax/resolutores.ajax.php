<?php


include "../controladores/formularios.controlador.php";
include "../modelos/formularios.modelo.php";

$url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";
/*=============================================
Clase de AJAX
=============================================*/

class AjaxResolutor{

	public $validarResolutor;

	public function ajaxValidarResolutorId(){

		$item = "idresolutor";
		$valor = $this->validarResolutor;

		$respuesta = ControladorRegistroId::ctrSeleccionarRegistrosId($item,$valor,'resolutor');
		
		echo json_encode($respuesta);
		//echo $url_actual;
	}
	public $BorraId;
	public function ajaxBorraId(){

		$item = "idresolutor";
		$valor = $this->BorraId;
		//$respuesta=$valor;
		$respuesta = ControladorBorrarResolutor::ctrEliminarRegistro($valor);
		
		echo ($respuesta);
		//echo $url_actual;
	}

	public $validarResId;
	//public $validarResIdSol;
	public $validarfotoRes;
	public $validarnomRes;
	public $validarApRes;
	public $validarAmRes;
	

	public function ajaxValidarResolutores(){

		//$IdSol = $this->validarResIdSol;
		$IdRes = $this->validarResId;
		$fotoRes = $this->validarfotoRes;
		$nomRes = $this->validarnomRes;
		$ApRes = $this->validarApRes;
		$AmRes = $this->validarAmRes;

		$respuesta = ControladorActualizaResolutor::ctrActualizarResolutor($IdRes,$fotoRes,$nomRes,$ApRes,$AmRes);
		if ($respuesta=="ok"){
			
			echo ($respuesta);
		//	header("Location: solicitudes");
		}
		
	}
//////////////////////////////////////////////////////

	public $validaHabita;
	public function ajaxValidarEliminaHabita(){

		//$IdSol = $this->validarResIdSol;
		$idhabita = $this->validaHabita;

		$respuesta = ControladorFormularios::ctrEliminarHabitaciones($idhabita);
		if ($respuesta=="ok"){
			
			echo ($respuesta);
		//	header("Location: solicitudes");
		}
	}


	public $validaHtl;
	public $validaIHab;
	public $validaNHab;
	public $validaTipo;

	public function ajaxValidarInsertaHabita(){

		$idhtl = $this->validaHtl;
		$idhabita = $this->validaIHab;
		$nhabita = $this->validaNHab;
		//$tipo = $this->validaTipo;

		$respuesta = ControladorFormularios::ctrArchivoQR($idhtl,$idhabita,$nhabita);
		if ($respuesta=="ok"){
			echo ($respuesta);
		}
	}

	public $validaPDFHtl;
	public $validaNumHab;
	public $validaPDFqr;
	

	public function ajaxValidarPdf(){

		$idhtl = $this->validaPDFHtl;
		$Nhabita = $this->validaNumHab;
		$pdfqr = $this->validaPDFqr;
		//$tipo = $this->validaTipo;

		$respuesta = ControladorFormularios::ctrPdf($idhtl,$Nhabita,$pdfqr);
		if ($respuesta=="ok"){
			echo ($respuesta);
		}
	}


	public $validaDesHtl;
	public $validaDesQR;
	public $validaDesNHab;
	

	public function ajaxValidarDescargaHabita(){

		$idhtl = $this->validaDesHtl;
		$Qrhabita = $this->validaDesQR;
		$nhabita = $this->validaDesNHab;
	
		$respuesta = ControladorFormularios::ctrPdf($idhtl,$nhabita,$Qrhabita);
		if ($respuesta=="ok"){
			echo ($respuesta);
		}
	}


	public $actHotel;
	public $actNombre;
	public $actEmail;
	public $actZona;
	

	public function ajaxActualizaDatosHotel(){

		$aHotel = $this->actHotel;
		$aNombre = $this->actNombre;
		$aEmail = $this->actEmail;
		$aZona = $this->actZona;	
		
		$respuesta = ControladorActDatosHotel::ctrDatosHotel($aHotel,$aNombre,$aEmail,$aZona);
		if ($respuesta=="ok"){
			echo ($respuesta);
		}
	}

	public $actPassHotel;
	public $actPassword;

	public function ajaxActualizaPassHotel(){

		$aPHotel = $this->actPassHotel;
		$aPassword = $this->actPassword;	
		
		$respuesta = ControladorActPassHotel::ctrPasswordHotel($aPHotel,$aPassword);
		if ($respuesta=="ok"){
			echo ($respuesta);
		}
	}
}

if(isset($_POST["resolutor_id"])){

	$valSolicitud = new AjaxResolutor();
	$valSolicitud -> validarResolutor = $_POST["resolutor_id"];
	$valSolicitud -> ajaxValidarResolutorId();

}
if(isset($_POST["Eliminarid"])){

	$valElimina = new AjaxResolutor();
	$valElimina -> BorraId = $_POST["Eliminarid"];
	$valElimina -> ajaxBorraId();

}
if(isset($_POST["id"])){

	$valResolutor = new AjaxResolutor();
	$valResolutor -> validarResId = $_POST["id"];
	$valResolutor -> validarfotoRes = $_POST["foto"];
	$valResolutor -> validarnomRes = $_POST["nombre"];
	$valResolutor -> validarApRes = $_POST["apaterno"];
	$valResolutor -> validarAmRes = $_POST["amaterno"];
	$valResolutor -> ajaxValidarResolutores();

}



if(isset($_POST["idhbt"])){

	$valEliminaH = new AjaxResolutor();
	$valEliminaH -> validaHabita = $_POST["idhbt"];
	$valEliminaH -> ajaxValidarEliminaHabita();

}


if(isset($_POST["idhotel"])){

	$valInsertaH = new AjaxResolutor();
	$valInsertaH -> validaHtl = $_POST["idhotel"];
	$valInsertaH -> validaIHab = $_POST["idhab"];
	$valInsertaH -> validaNHab = $_POST["numHabita"];
	
	$valInsertaH -> ajaxValidarInsertaHabita();

}


if(isset($_POST["idpdfhotel"])){

	$valPdfH = new AjaxResolutor();
	$valPdfH -> validaPDFHtl = $_POST["idpdfhotel"];
	$valPdfH -> validaNumHab = $_POST["numhabit"];
	$valPdfH -> validaPDFqr = $_POST["pdfqr"];
	$valPdfH -> ajaxValidarPdf();

}

if(isset($_POST["Desidhotel"])){

	$valDescargaH = new AjaxResolutor();
	$valDescargaH -> validaDesHtl = $_POST["Desidhotel"];
	$valDescargaH -> validaDesQR = $_POST["DesQR"];
	$valDescargaH -> validaDesNHab = $_POST["DesnumHabita"];
	
	$valDescargaH -> ajaxValidarDescargaHabita();

}

if(isset($_POST["ActualizaidHotel"])){

	$actualizaDatos = new AjaxResolutor();
	$actualizaDatos -> actHotel = $_POST["ActualizaidHotel"];
	$actualizaDatos -> actNombre = $_POST["ActualizaNombre"];
	$actualizaDatos -> actZona = $_POST["ActualizaZona"];
	$actualizaDatos -> actEmail = $_POST["ActualizaEmail"];
	
	$actualizaDatos -> ajaxActualizaDatosHotel();

}


if(isset($_POST["ActPassIdHotel"])){

	$actualizaPassDatos = new AjaxResolutor();
	$actualizaPassDatos -> actPassHotel = $_POST["ActPassIdHotel"];
	$actualizaPassDatos -> actPassword = $_POST["ActPass"];	
	$actualizaPassDatos -> ajaxActualizaPassHotel();

}
