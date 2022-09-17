<?php

$url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";
$document_root = $_SERVER['DOCUMENT_ROOT'];

?>
<script src="<?php echo $url_actual;?>js/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $url_actual;?>js/sweetalert2.js"></script>

<script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
    $(document).ready(function(){
      $('.toast').toast('show');
      var el1 = document.getElementById("vtnFiltro01");
          el1.setAttribute("style", "display:none;");
      var el2 = document.getElementById("vtnFiltro02");
          el2.setAttribute("style", "display:none;");
      var el3 = document.getElementById("vtnFiltro03");
          el3.setAttribute("style", "display:none;");
      var el4 = document.getElementById("vtnFiltro04");
          el4.setAttribute("style", "display:none;");  
      var vtnPend = document.getElementById("pendientes");
          vtnPend.setAttribute("style", "display:none;");            
        console.log(Notification.permission);
    });

</script>
<script type="text/javascript">

  //var audio = new Audio('<?php echo $url_actual;?>Bell.mp3');
  var Filtro=0;
  var Actualiza=false;
  var NewSol=false;
  var oculto=true;
  var seg =0;
  function Seleccion($valor){
    Filtro=$valor;
    Actualiza=true;
    var el1 = document.getElementById("vtnFiltro01");
        el1.setAttribute("style", "display:none;");
    var el2 = document.getElementById("vtnFiltro02");
        el2.setAttribute("style", "display:none;");
    var el3 = document.getElementById("vtnFiltro03");
        el3.setAttribute("style", "display:none;");
    var el4 = document.getElementById("vtnFiltro04");
        el4.setAttribute("style", "display:none;");    
    $('.toast').toast('show');
    if (Filtro>0)
    {
        switch (Filtro)
        {

          case 1:
          {   
              var el1 = document.getElementById("vtnFiltro01");
              el1.setAttribute("style", "display:block;");
              var el2 = document.getElementById("vtnFiltro02");
              el2.setAttribute("style", "display:none;");
              var el3 = document.getElementById("vtnFiltro03");
              el3.setAttribute("style", "display:none;");
              var el4 = document.getElementById("vtnFiltro04");
              el4.setAttribute("style", "display:none;");    
              break;
            }
          case 2:
          {
              var el2 = document.getElementById("vtnFiltro02");
              el2.setAttribute("style", "display:block;");
              var el1 = document.getElementById("vtnFiltro01");
              el1.setAttribute("style", "display:none;");
              var el3 = document.getElementById("vtnFiltro03");
              el3.setAttribute("style", "display:none;");
              var el4 = document.getElementById("vtnFiltro04");
              el4.setAttribute("style", "display:none;"); 
              break;
            }
          case 3:
          {
              var el3 = document.getElementById("vtnFiltro03");
              el3.setAttribute("style", "display:block;");
              var el1 = document.getElementById("vtnFiltro01");
              el1.setAttribute("style", "display:none;");
              var el2 = document.getElementById("vtnFiltro02");
              el2.setAttribute("style", "display:none;");
              var el4 = document.getElementById("vtnFiltro04");
              el4.setAttribute("style", "display:none;");                  
              break;
          }
          case 4:
          {
              var el4 = document.getElementById("vtnFiltro04");
              el4.setAttribute("style", "display:block;");
              var el1 = document.getElementById("vtnFiltro01");
                  el1.setAttribute("style", "display:none;");
              var el2 = document.getElementById("vtnFiltro02");
                  el2.setAttribute("style", "display:none;");
              var el3 = document.getElementById("vtnFiltro03");
                  el3.setAttribute("style", "display:none;");
              break;
          }

        }
    }
    else
    {
             var el4 = document.getElementById("vtnFiltro04");
              el4.setAttribute("style", "display:none;");
              var el1 = document.getElementById("vtnFiltro01");
                  el1.setAttribute("style", "display:none;");
              var el2 = document.getElementById("vtnFiltro02");
                  el2.setAttribute("style", "display:none;");
              var el3 = document.getElementById("vtnFiltro03");
                  el3.setAttribute("style", "display:none;");
             
        
    }
    ActulizaTabla(Filtro);
   // tiempoReal();
  }
  
  		function showNotification(){
				var notification = new Notification('Solicitud Nueva', { 
					body: "Hay una solicitud, revisa el módulo de recepción.", 
					icon:"https://hospedaje.vixdrix.com/img/favicon.png"
				});
				notification.onclick=(e)=>{
					window.location.href="https://hospedaje.vixdrix.com/solicitudes";
				}
		}
  function ActulizaTabla(estado){
        if(Filtro==0)
        {
             var el4 = document.getElementById("vtnFiltro04");
              el4.setAttribute("style", "display:none;");
              var el1 = document.getElementById("vtnFiltro01");
                  el1.setAttribute("style", "display:none;");
              var el2 = document.getElementById("vtnFiltro02");
                  el2.setAttribute("style", "display:none;");
              var el3 = document.getElementById("vtnFiltro03");
                  el3.setAttribute("style", "display:none;");
        
        }
        $.post('vistas/paginas/tablaSolicitudes.php',{hotel_id: <?php echo $_SESSION['IdHotel'];?>,idStatus: estado}, function(htmlexterno){
            $("#miTabla").html(htmlexterno);
            $(document).ready(function() {
              var table =$("#example1").DataTable({
              "columns": [{ "width": null },{ "width": null },{ "width": null},{ "width": null },{ "width": "30%" },{ "width": "20%" }],
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "order": [[2, "desc"]],
              "info": false,
              "responsive": true,
              "autoWidth": false,
              "bDestroy": true,
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
              }
            });
          });
        });

}
  function tiempoReal()  {
   

    var totalNew=0;
    var totalSANew=0;
    var totalSAOld=0;

    var totalOld=parseInt($("#Valor1").text())+parseInt($("#Valor2").text())+parseInt($("#Valor3").text())+parseInt($("#Valor4").text());
    var hoy = new Date();

    totalSAOld=parseInt($("#Valor1").text());
    seg=parseInt(hoy.getSeconds());
    $.ajax({

        url:"ajax/solicitudes.ajax.php",
        type:'POST',
        data: {hotelSt: <?php echo $_SESSION['IdHotel'];?>},
        beforeSend:function(){},
        dataType: "json",
        success:function(respuesta){
          
           if ((respuesta.length>0) || (seg==0))
           { 
            
            totalNew=parseInt(respuesta[0]["SinAsignar"])+parseInt(respuesta[0]["EnProceso"])+parseInt(respuesta[0]["cancelada"])+parseInt(respuesta[0]["atendida"]);
            totalSANew=parseInt(respuesta[0]["SinAsignar"]);
            
            if (totalSANew>totalSAOld){
 
                  if(Notification.permission==="granted")
                  {
                    showNotification();
                  }else if (Notification.permission!=="denied")
                  {
                    Notification.requestPermission().then(permission=>{
                           if (permission==="granted"){
                             showNotification();
                            }
                         });
                  }
                
            }
            //sonido(valorSonido);
            //$("#Valor1").addEventListener('change',sonido(valorSonido));
             
            if (($("#Valor1").text()!=respuesta[0]["SinAsignar"]) || ($("#Valor2").text()!=respuesta[0]["EnProceso"]) || ($("#Valor3").text()!=respuesta[0]["cancelada"]) ||($("#Valor4").text()!=respuesta[0]["atendida"]))
            { 
             $("#Valor1").text(respuesta[0]["SinAsignar"]);
             $("#Valor2").text(respuesta[0]["EnProceso"]);
             $("#Valor3").text(respuesta[0]["cancelada"]);
             $("#Valor4").text(respuesta[0]["atendida"]);
             Actualiza=true;
             Filtro=0;
            }else {
              Actualiza=false;
            }
            /*
            console.log(respuesta[0]["SinAsignar"]);
            console.log(parseInt($("#Valor1").text()));
            */
        
            
            if (seg==0)
            {
              Actualiza=true;
              //NewSol=true;
            }
            
            //console.log(Actualiza);

          }
        
        }
    });
    //console.log(Actualiza);
    if (Actualiza==true)
    { 
        ActulizaTabla(Filtro);
        var datos;
        
        $.post('ajax/solicitudes.ajax.php',{item: 'idhotel',valorItem: <?php echo $_SESSION['IdHotel'] ?>},function(result){
              datos=$.parseJSON(result);
              totalActual=parseInt(datos[0]["total"]);
              if (totalActual>0){
                var vPendiente = document.getElementById("pendientes");
                vPendiente.setAttribute("style", "display:block;"); 
                  <?php if ($_SESSION['pk']==1){ 
                  echo ' 
                   $.post("vistas/paginas/tablaPendientes.php",{hotel_id: '.$_SESSION['IdHotel'].',idStatus: Filtro}, function(htmlexterno){
                    $("#Tabla2").html(htmlexterno);
                    $(document).ready(function() {
                      var table =$("#example2").DataTable({
                      "bDestroy": true,
                      "paging": true,
                      "lengthChange": false,
                      "columnDefs": [{ 
                            "className": "text-center"
                      }],
                      "searching": false,
                      "info": false,
                      "responsive": true,
                      "autoWidth": false,
                      "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                       }
                     });
                   });
                  });';
                    
                 }
        
                ?>
              }else if (totalActual==0)
              {
                var vPendiente = document.getElementById("pendientes");
                vPendiente.setAttribute("style", "display:none;"); 
              }
        });
        
    }
    
 
  }
  setInterval(tiempoReal,1000);

  </script>
<script src="<?php echo $url_actual;?>js/sweetalert2.js"></script>



<div id="cuerpo" class="content-wrapper" style="min-height:274px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Servicios solicitados por huésped</h1>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-10 col-md-10 col-lg-10">            
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title mr-3 mt-2">Total de Solicitudes</h3>
                <div id="vtnFiltro01" class="toast bg-warning" data-autohide="false" > 
                  <div class="toast-header"> 
                    <strong id="etiqueta" class="mr-auto">Sin Asignar</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"  onclick="Seleccion(0)">x</button>
                  </div>
                </div>
                <div id="vtnFiltro02" class="toast bg-info" data-autohide="false" > 
                  <div class="toast-header"> 
                    <strong id="etiqueta" class="mr-auto">Atendidas</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"  onclick="Seleccion(0)">x</button>
                  </div>
                </div>
                <div id="vtnFiltro03" class="toast bg-success" data-autohide="false" > 
                  <div class="toast-header"> 
                    <strong id="etiqueta" class="mr-auto">En Proceso</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"  onclick="Seleccion(0)">x</button>
                  </div>
                </div>
                <div id="vtnFiltro04" class="toast bg-danger" data-autohide="false" > 
                  <div class="toast-header"> 
                    <strong id="etiqueta" class="mr-auto">Canceladas</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"  onclick="Seleccion(0)">x</button>
                  </div>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <div >  
                     <div id="miTabla">
                     
                     </div>
                  </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          <div class="col-sm-2 col-md-2 col-lg-2" id="totales">
            <!-- Info Boxes Style 2 -->
          
            <button type="button" class="btn btn-sm info-box mb-3 bg-warning" onclick="Seleccion(1)">
              <span class="info-box-icon">
              <i class="fas fa-exclamation-triangle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sin Asignar</span>
                <span class="info-box-number"><val id="Valor1">0</val></span>
              </div>
              <!-- /.info-box-content -->
           </button>
            <!-- /.info-box -->
            <button class="btn btn-sm info-box mb-3  bg-success" onclick="Seleccion(3)">
              <span class="info-box-icon"><i class="fas fa-running"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">En Proceso</span>
                <span class="info-box-number"><val id="Valor2">0</val></span>
              </div>
              <!-- /.info-box-content -->
            </button>
            <!-- /.info-box -->
            <button class="btn btn-sm info-box mb-3  bg-danger" onclick="Seleccion(4)">
              <span class="info-box-icon"><i class="fas fa-comment-slash"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Canceladas</span>
                <span class="info-box-number"><val id="Valor3">0</val></span>
              </div>
              <!-- /.info-box-content -->
            </button>
            <!-- /.info-box col-sm-3 col-md-6-->
            <button class="btn btn-sm info-box mb-3  bg-info" onclick="Seleccion(2)">
              <span class="info-box-icon"><i class="fas fa-user-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Atendidas</span>
                <span class="info-box-number"><val id="Valor4">0</val></span>
              </div>
              <!-- /.info-box-content -->
            </button>
            <!-- /.info-box -->
          </div>
        </div>
      </div>
      <input type="number" id="total" value=10 hidden>
      <div class="container-fluid" id="pendientes"  
      <?php 

      include "./controladores/formularios.controlador.php";
      include "./modelos/formularios.modelo.php";
      

      $total =ControladorTotalPendientes::ctrTotalPendientes('idhotel',$_SESSION['IdHotel']);
      $totalpk=0;
      $totalpk=$total[0]['total'];
      if ($_SESSION['pk']==2 ) {
                echo 'style="display: none;"';}
      elseif ($_SESSION['pk']<=1 && $totalpk>0){
              echo '';}
      elseif ($_SESSION['pk']==1 && $totalpk==0 ) 
        
        {echo 'style="display: none;"';}
      ?>>
        <div class="row">
          <div class="col-sm-2 col-md-2 col-lg-2">
          </div>    
          <div class="col-sm-6 col-md-6 col-lg-6">            
            <div class="card card-success">
              <div class="card-header">
                <div class="text-center">
                <h3 class="card-title mr-3 mt-2">Total de Solicitudes pendientes</h3>
                <a href="http://www.vixdrix.com/elige-tu-plan/">
                <button type="button" class="btn btn-danger btn-lg mt-3" >Has agotado los tickets  mensuales gratuitos, actualiza tu plan para poder ver los tickets nuevos, click aquí
                </button></a>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <div >  
                     <div id="Tabla2">
                    
                     </div>
                  </div>
                <!-- /.table-responsive -->
                <input id="idSV" name="Id_solicitud" type="hidden">
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
        </div>
                    
      </div>
    </section>
    <!-- /.content -->
</div>


<div class="modal fade" role="dialog" id="datosHuesped">
 
  <div class="modal-dialog" role="document">
   
    <div class="modal-content">

        <div class="modal-header bg-info">
          
          <h4 class="modal-title text center">Datos de la solicitud</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Folio:</label><br>
                <input type="text" id="folioHtl" name="" disabled></input>
              </div>
              <div class="form-group col-md-6">
                <label>Solicitud del Huésped:</label>
                <input type="text" id="comentrioHF" name="" disabled ></input>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>
                Comentario del Huésped:</label>
                <textarea type="text" id="comentrioHI" name="" disabled rows="5" cols="20" style=" resize: none;" maxlength="100"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Nota del Hotel:</label>
                <textarea type="text" id="comentrioR" name=""  rows="5" cols="20" style=" resize: none;" maxlength="100" onkeyup="mayus(this);"></textarea>
              </div>
              <label id="idsol" hidden></label>
              <label id="idStatus" hidden></label>
              <label for="recipient-name" class="col-form-label" id="valsol" disabled>
                Calificación para el colaborador:</label>
                <div class="mt-2 ml-2">
                <span class="fa fa-star star" style="display: none;" id="S1"></span>
                <span class="fa fa-star star" style="display: none;" id="S2"></span>
                <span class="fa fa-star star" style="display: none;" id="S3"></span>
                <span class="fa fa-star star" style="display: none;" id="S4"></span>
                <span class="fa fa-star star" style="display: none;" id="S5"></span>
                </div>
            </div>            
        </div>

        <div class="modal-footer d-flex justify-content-between">
            <div>
               <button type="button" class="btn btn-danger" data-dismiss="modal" id="guardacoment">Cerrar</button>
            </div>
       </div>
    </div> 
  </div> 
</div>


<div class="modal fade" role="dialog" id="datosResolutor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text center">Seleccione el colaborador</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

            <div class="row">
              <div class="form-group col-md-10">
                <label>
                Nombre del colaborador:</label>
                <select class="form-control" id="SelectResolutor">
                  <?php
                   //include "./controladores/formularios.controlador.php";
                    //include "./modelos/formularios.modelo.php";
                    $resolutores =ControladorResolutor::ctrSeleccionarResolutores('idHotel',$_SESSION['IdHotel'],'resolutor');
                           foreach ($resolutores as $key => $value) {
                            echo '<option value="'.$value["idresolutor"].'">'.$value["nombreresolutor"].'</option>';
                            }
                  ?>
                </select>
                <input id="idH" name="IdHotel" type="hidden">
                <input id="idS" name="Id_solicitud" type="hidden">
              </div>
              
            </div>            
        </div>

        <div class="modal-footer d-flex justify-content-between">
            <div class="col-sm-12 justify-content">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
               <button type="button" class="btn btn-info" data-dismiss="modal" onclick="ActualizaResolutor();">Asignar colaborador</button>
            </div>
        </div>


    </div> 

  </div> 
</div>

  <!-- jQuery -->
<script src="<?php echo $url_actual;?>js/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $url_actual;?>js/solicitudes.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $url_actual;?>js/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo $url_actual;?>js/sweetalert2.js"></script>

<script src="<?php echo $url_actual;?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE App -->

<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>

<!-- page script -->



