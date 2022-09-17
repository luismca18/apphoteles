<?php


	header("Content-Type:application/xls");
	header("Content-Disposition:attechment;filename='reporte.xlsx'");
	echo '
<script type="text/javascript">
	
	console.log ("'.$_POST["OpcDatos"].'");

</script>>
';
?>

                  <table>
                      <thead>
                      	<?php
                        switch ($_POST["OpcDatos"]) {
                          case '1':
                            echo '<tr role="row"><th >STATUS</th><th >Resolutor</th><th >HABITACION</th><th>HUESPED</th><th >FECHA</th><th >SOLICITUD</th><th >VALORACION</th><th>COMENTARIOS</th><th>TAREA</th></tr>';
                            break;
                          case '2':
                            echo '<tr role="row"><th >Nombre de la Tarea</th><th >Total de solicitudes</th></tr>';
                            break;
                          case '3':
                            echo '<tr role="row"><th >Número de Habitación</th><th >Total de solicitudes</th></tr>';
                            break;
                          case '4':
                            echo '<tr role="row"><th >Nombre de la Tarea</th><th >Total de solicitudes</th></tr>';
                            break;
                        }
                            ?>
                      </thead>
                    <tbody>
                    	<?php
                    	include "./controladores/datos.controlador.php";
            			$datosEst =  ControladorDatos::ctrMostrarRegistros($_SESSION['IdHotel'],$_POST['OpcDatos'],$_POST['fechas']);
                    	switch ($_POST["OpcDatos"]) {
                          case '1':
                             foreach ($datosEst as $key => $value) {
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
                          case '4':
                          break;
                        }
                        ?>
                    </tbody>
                  </table>

