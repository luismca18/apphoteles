<?php
  $document_root = $_SERVER['DOCUMENT_ROOT'];
  if(isset($_POST["hotel_id"]))
  { 
     $IdHotelVal=$_POST["hotel_id"];
  }

  if(isset($_POST["idStatus"]))
  { 
     $IdSts=$_POST["idStatus"];
  }
  include $document_root."/controladores/formularios.controlador.php";
  include $document_root."/modelos/formularios.modelo.php";
  $url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";

echo '
        
                     ';


  echo ' <div class="table-responsive ">
    <table id="example2" class="table table-bordered table-striped  nowrap">
    <thead class="btn-info"><tr><th>Room</th></tr></thead><tbody>';
 
 
  $solicitudes =ControladorPendientes::ctrBuscaPendientes('idhotel',$IdHotelVal);
  $i=0;
  $list=array();
  if ($solicitudes==null){
  }else
  { 
    foreach ($solicitudes as $key => $value) 
    {
     
      echo '<tr role="row" class="odd">';
      echo '<td  tabindex="0" class="sorting_1">'.$value['numhabitacionhuesped'].'</td>';

      echo '</tr>';
   }
  }
  echo '</tbody></table></div><script></script>
  ';
