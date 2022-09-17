<?php
  $document_root = $_SERVER['DOCUMENT_ROOT'];
  if(isset($_POST["hotel_id"]))
  { 
     $IdHotelVal=$_POST["hotel_id"];
  }
  include $document_root."/controladores/formularios.controlador.php";
  include $document_root."/modelos/formularios.modelo.php";
  $url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";
  $Status=array(0,0,0,0,0);
  $solicitudes =ControladorFormularios::ctrStatusSolicitudes($IdHotelVal);
  $i=0;
  $list=array();
  if ($solicitudes==null){
  }else{ 
    $Status[0]=0;
    $Status[1]=0;
    $Status[2]=0;
    $Status[3]=0;
    $Status[4]=0;
    foreach ($solicitudes as $key => $value) 
    {
        
        if($value['statussolicitud']==1) $Status[0]=$value['total'];
        elseif($value['statussolicitud']==2) $Status[1]=$value['total'];
        elseif($value['statussolicitud']==3) $Status[2]=$value['total'];
        elseif($value['statussolicitud']==4) $Status[3]=$value['total'];
        elseif($value['statussolicitud']==5) $Status[4]=$value['total'];
    }
  }

  echo '<button type="button" class="btn btn-sm info-box mb-3 bg-warning" onclick="Seleccion(1)"">
          <span class="info-box-icon">
          <i class="fas fa-exclamation-triangle"></i></span>
          <div class="info-box-content">
             <span class="info-box-text">Unassigned</span>

            <span class="info-box-number">'.$Status[0].'</span>
          </div>
              <!-- /.info-box-content -->
        </button>
<!-- /.info-box -->
        <button class="btn btn-sm info-box mb-3  bg-success" onclick="Seleccion(3)">
          <span class="info-box-icon"><i class="fas fa-running"></i></span>
          <div class="info-box-content">
             <span class="info-box-text">In Process</span>

            <span class="info-box-number">'.$Status[2].'</span>
          </div>
          <!-- /.info-box-content -->
        </button>
<!-- /.info-box -->
        <button class="btn btn-sm info-box mb-3  bg-danger" onclick="Seleccion(4)">
          <span class="info-box-icon"><i class="fas fa-comment-slash"></i></span>
          <div class="info-box-content">
             <span class="info-box-text">Cancelled</span>

            <span class="info-box-number">'.$Status[3].'</span>
          </div>
          <!-- /.info-box-content -->
        </button>

<!-- /.info-box -->
        <button class="btn btn-sm info-box mb-3  bg-info" onclick="Seleccion(2)">
          <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
          <div class="info-box-content">
              <span class="info-box-text">Attended</span>

            <span class="info-box-number">'.$Status[1].'</span>
          </div>
        <!-- /.info-box-content -->
        </button>

  ';
