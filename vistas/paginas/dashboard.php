<?php
                    
$url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";
date_default_timezone_set("America/Mexico_City");
?>
<script >
  function pasarMin()
  {
        var value = $("#fec1").val();
       $("#fec2").attr("min", value);
       //console.log(value);
  }

</script>
<div class="content-wrapper" style="min-height:274px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
         
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-10">            
            <form method="post">
              <div class="card card-primary">
              <div class="card-header">
                <h1 class="card-title">Estadísticas</h1>
              </div>
              <div class="card-body">
                
                <!-- /.form group -->
                <!-- Date range -->
                <div class="form-group">
                  
                  
                    <label>Seleccione el tipo de Estadistica:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-list-ol"></i>
                      </span>
                    </div>
                    <select class="custom-select" id="Opc" PLACEHOLDER="SELECCIONE UNA OPCION" name="OpcDatos">
                          <option value="1">Resumen de solicitudes</option>
                          <option value="2">Servicios solicitados por huésped</option>
                          <option value="3">Ranking de habitaciones con más solicitudes</option>
                          <option value="4">Calificación a los Colaboradores</option>
                          
                        </select>
                  </div>
                </div>
                <div class="form-group">

                  <label>Elija un rango de fechas:</label>
                  
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Fecha incial:
                      </span>
                    </div>
                    <input type="date" class="form-control float-right" id="fec1" name="fecha1" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>" 
 onchange="pasarMin();">
                  
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Fecha final:
                      </span>
                    </div>
                    <input type="date" class="form-control float-right" id="fec2" name="fecha2" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>" >
                  </div>                  
                  <!-- /.input group -->
                </div>
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-info">Buscar</button>
               </div>
              </div>            
            </form>
          </div>



          <div class="col-12">            
            <?php
            
            include "./controladores/datos.controlador.php";
            if (!empty($_POST['OpcDatos'])){
            $datosEst =  ControladorDatos::ctrMostrarRegistros($_SESSION['IdHotel'],$_POST['OpcDatos'],$_POST['fecha1'],$_POST['fecha2']);

            if (isset($datosEst)){
              echo ' 
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Resultados</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">                  
                <div class="col-sm-12">
                  <table id="tblExport" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="tblExport_info">
                      <thead>';
                        switch ($_POST["OpcDatos"]) {
                          case '1':
                            echo '<tr role="row"><th >Status</th><th >Colaborador</th><th >Habitación</th><th >Fecha</th><th >Solicitud</th><th >Valoración</th><th>Comentarios</th><th>Tarea</th></tr>';
                            break;
                          case '2':
                            echo '<tr role="row"><th >Nombre de la tarea</th><th >Total de solicitudes</th></tr>';
                            break;
                          case '3':
                            echo '<tr role="row"><th >Número de habitación</th><th >Total de solicitudes</th></tr>';
                            break;
                          case '4':
                            echo '<tr role="row"><th >Nombre del colaborador</th><th >Promedio de calificación de servicios</th><th >Total de servicios atendidos</th></tr>';
                            break;
                          case '5':
                            echo '<tr role="row"><th >Nombre del colaborador</th><th >Promedio de calificación de servicios</th><th >Total de servicios atendidos</th></tr>';
                            break;                            
                        }
                            echo'
                      </thead>
                    <tbody>';
                    switch ($_POST["OpcDatos"]) {
                          case '1':
                            foreach ($datosEst as $key => $value) {
                              echo '
                              <tr role="row" class="odd">';
                              echo ' 
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["status"].'</div>
                                </td>';
                                echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["nombre_resolutor"].'</div>';
                                  echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["numhabitacionhuesped"].'</div>';
                                  echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["FechaHorasolicitud"].'</div>';
                                  echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["descripcionsolicitud"].'</div>';
                                  echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["valoracionsolicitud"].'</div>';
                                  echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["comentariosolicitud"].'</div>';
                                  echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["nombreTarea"].'</div>';
                                echo '
                                </tr>
                                ';
                            }
                            break;
                          case '2':
                          foreach ($datosEst as $key => $value) {
                              echo '
                              <tr role="row" class="odd">';
                                echo ' 
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["nombreTarea"].'</div>
                                </td>';
                                echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["total"].'</div>
                                </td>';
                                echo '
                              </tr>
                                ';
                            }
                            break;
                          case '3':
                          //numhabitacionhuesped
                             foreach ($datosEst as $key => $value) {
                              echo '
                              <tr role="row" class="odd">';
                                echo ' 
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["numhabitacionhuesped"].'</div>
                                </td>';
                                echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["total"].'</div>
                                </td>';
                                echo '
                              </tr>
                                ';
                            }
                            break;
                          case '4':
                          foreach ($datosEst as $key => $value) {
                              echo '
                              <tr role="row" class="odd">';
                                echo ' 
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["nombre_resolutor"].'</div>
                                </td>';
                                echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["total"].'</div>
                                </td>';
                                echo '
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">'.$value["TotalS"].'</div>
                                </td>';                                
                                echo '
                              </tr>
                                ';
                            }
                            break;
                      }
                    echo' </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">';
              if (!empty($datosEst)){
                //
                echo ' 
                <button id="btnExport" class="btn btn-info" onclick="fnExportToExcel(';
                echo "'xlsx','Reporte'";
                echo ')">Exportar a Excel</button>
                ';
              }
              echo ' 
            </div>
            <!-- /.card-footer -->
          </div>';
                }   }
                        ?>

          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

<!-- jQuery -->
<script src="<?php echo $url_actual;?>js/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $url_actual;?>js/script.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $url_actual;?>js/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/chart.js/Chart.min.js"></script>
<!-- DataTables -->
<script src="<?php echo $url_actual;?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/adminlte.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/demo.js"></script>
<!-- Select2 -->
<script src="<?php echo $url_actual;?>js/plugins/select2/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo $url_actual;?>js/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo $url_actual;?>js/plugins/moment.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $url_actual;?>js/plugins/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo $url_actual;?>js/plugins/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $url_actual;?>js/plugins/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $url_actual;?>js/plugins/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $url_actual;?>js/plugins/jquery/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $url_actual;?>js/plugins/jquery/demo.js"></script>
<!-- Page script -->



<script>
  function fnExportToExcel(fileExtension,fileName){
    var elt=document.getElementById("tblExport");
    var wb=XLSX.utils.table_to_book(elt,{sheet:"hoja1"});
    return XLSX.writeFile(wb,fileName+"."+fileExtension || ('MySheetName.'+(fileExtension||'xlsx')));

  }
</script>