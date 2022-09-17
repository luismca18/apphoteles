<?php

require_once "../controladores/datos.controlador.php";
require_once "../modelos/datos.modelo.php";

/*=============================================
Clase de AJAX
=============================================*/

class AjaxExcel{

	public $validarExcelOpc;
	public $validarExcelFechas;
	public $validarExceliHotel;

	public function ajaxValidarExcel(){
    $IdH = $this->validarExceliHotel;
    $OpcD = $this->validarExcelOpc;
    $FechasD = $this->validarExcelFechas;
    echo '<script type="text/javascript"> console.dir("'.$IdH.'");</script>'; 
		$respuesta = ControladorDatos::ctrMostrarRegistros($IdH,$OpcD,$FechasD);
		if (isset($respuesta)){
				//header("Content-Type: aplication/xls");
				//header("Content-Disposition: attachment; filename=reporte.xls");
        echo '<script type="text/javascript"> console.log("'.$validarExceliHotel.'");</script>'; 
				header('Content-Type: aplication/csv; charset=latin1');
				header('Content-Disposition: attachment; filename="reporte.csv"');
				$salida=fopen('php://output','w');
				//fputcsv($salida,array());
                        switch ($validarExcelOpc) {
                          case '1':
                            fputcsv($salida,array('STATUS','Resolutor','HABITACION','HUESPED','FECHA','SOLICITUD','VALORACION','COMENTARIOS');
                            break;
                          case '2':
                            fputcsv($salida,array('Nombre de la Tarea','Total de solicitudes'));
                            break;
                          case '3':
                            echo '<tr><th >Número de Habitación</th><th >Total de solicitudes</th></tr>';
                            break;
                          case '4':
                            echo '<tr><th >Nombre de la Tarea</th><th >Total de solicitudes</th></tr>';
                            break;
                        }
                    switch ($validarExcelOpc) {
                          case '1':
                          	fputcsv($salida,array($respuesta['status'],
                          							$respuesta['nombre_resolutor'],
                          							$respuesta['numhabitacionhuesped'],
                          							$respuesta['apellidoHuesped'],
                          							$respuesta['FechaHorasolicitud'],
                          							$respuesta['descripcionsolicitud'],
                          							$respuesta['valoracionsolicitud'],
                          							$respuesta['comentariosolicitud'],
                          							$respuesta['nombreTarea']
                          							));
                            /*
                            foreach ($respuesta as $key => $value) {
                              echo '<tr><td>'.$value["status"].'</td>';
                              echo '<td>'.$value["nombre_resolutor"].'</td>';
                              echo '<td>'.$value["numhabitacionhuesped"].'</td>';
                              echo '<td>'.$value["apellidoHuesped"].'</td>';
                              echo '<td>'.$value["FechaHorasolicitud"].'</td>';
                              echo '<td>'.$value["descripcionsolicitud"].'</td>';
                              echo '<td>'.$value["valoracionsolicitud"].'</td>';
                              echo '<td>'.$value["comentariosolicitud"]'</td>';
                              echo '<td>'.$value["nombreTarea"]'</td></tr>';
                            }
                            break;
                          case '2':
                          	foreach ($datosEst as $key => $value) {
                              echo '<tr><td>'.$value["nombreTarea"].'</td>';
                              echo '<td>'.$value["total"].'</td></tr>';
                            }
                            break;
                          case '3':
                            break;
                          case '4':*/
                            break;
                      }
                    //echo' </tbody></table> ';
                }

		//echo json_encode($respuesta);
	}




}



	$valExcel = new AjaxExcel();
	$valExcel -> validarExcelOpc = $_POST["opc"];
	$valExcel -> validarExcelFechas = $_POST["fechas"];
	$valExcel -> validarExceliHotel = $_POST["ihotel"];
	$valExcel -> ajaxValidarExcel();



