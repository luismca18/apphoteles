<?php
  $document_root = $_SERVER['DOCUMENT_ROOT'];
  
  if(isset($_POST["hotel_id"]))
  { 
     $IdHotelVal=$_POST["hotel_id"];
  }else
  {
    $IdHotelVal=$_SESSION['IdHotel'];
  }

  if(isset($_POST["idStatus"]))
  { 
     $IdSts=$_POST["idStatus"];
  }else{
    $IdSts=0;
  }
  require_once $document_root."/controladores/formularios.controlador.php";
  require $document_root."/modelos/formularios.modelo.php";
  $url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";

  echo ' 
  <div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped  nowrap" role="grid" aria-describedby="example1_info">
    <thead class="btn-info">
      <tr>
        <th>Room</th>
        <th>Collaborator</th>
        <th hidden>TimeStamp</th>
        <th>Status</th>
        <th>TimeLine</th>
        <th>Changes</th>
      </tr>
    </thead>
    <tbody>'; 
      $Status=array(0,0,0,0,0);
      $solicitudes =ControladorSeleccionaTabla::ctrSeleccionarTabla('idhotel',$IdHotelVal,$IdSts);
      $i=0;
      $list=array();
      if ($solicitudes==null){
      }else
      { 
        foreach ($solicitudes as $key => $value) 
        {
          if($value['statussolicitud']==1) $Status[0]=$Status[0]+1;
          elseif($value['statussolicitud']==2) $Status[1]=$Status[1]+1;
          elseif($value['statussolicitud']==3) $Status[2]=$Status[2]+1;
          elseif($value['statussolicitud']==4) $Status[3]=$Status[3]+1;
          elseif($value['statussolicitud']==5) $Status[4]=$Status[4]+1;
      echo 
      '<tr role="row" class="odd">';
        echo 
        '<td  tabindex="0" class="sorting_1">
            <button class="btn btn-secondary btn-sm" id="btmodal" data-toggle="modal" data-target="#datosHuesped" onclick="ObtenerSolicitudId('.$value['idsolicitud'].');" >'.$value['numhabitacionhuesped'].
            '</button>
         </td>';
          if (!isset($value["fotoresolutor"]) || $value["fotoresolutor"]=='')
          {
            echo 
          '<td>';
            echo 
            '<div class="image">
                <button data-toggle="modal" data-target="#datosResolutor" id="IdSolicitudRes" class="btn btn-primary-outline" ';
                if ($value['statussolicitud']!=1 && $value['statussolicitud']!=3) {
                    echo ' disabled ';
                }else{
                    echo ' onclick="vresolutor('.$value['idsolicitud'].');"';
                }
                echo '> <img src="'.$url_actual.'img/usuarios/resolutores/default.png"  width=50px height=50px class="img-circle elevation-2" alt="User Image">';
          }else{
            echo 
            '<td > ';
            echo 
              '<div class="image">
                <button  data-toggle="modal" data-target="#datosResolutor" id="IdSolicitudRes"
                      class="btn btn-primary-outline"  ';
                if ($value['statussolicitud']!=1 && $value['statussolicitud']!=3) {
                    echo ' disabled ';
                }else{
                    echo ' onclick="vresolutor('.$value['idsolicitud'].');"';
                } 
                echo '> <img src="'.$url_actual.'img/usuarios/resolutores/'.$value["fotoresolutor"].'"  width=50px height=50px class="img-circle elevation-2" alt="User Image">
                     ';
          }
                        echo 
                      '<span class="d-block"><small>'.$value["nombre_resolutor"].'</small><span>
                      <span class="d-block"><small>'.$value["apellidoResolutor"].'</small><span>';
                        echo  
                '</button>
              </div>
            </td>';
              date_default_timezone_set('America/Mexico_City');
              $horaSis=substr($value['tiempo'],0,2);
              $minSis=substr($value['tiempo'],3,2);
              $horaTem= intval(date('H'));
              $minTem= intval(date('i'));
              if($horaTem<intval($horaSis))
              {
                $horaAct= (24+intval($horaTem)) - intval($horaSis);
              }else
              {
                $horaAct= intval($horaTem) - intval($horaSis);
              }   
              if($minTem<intval($minSis))
              {
                $minAct= (60+$minTem)-intval($minSis);
                $horaAct= $horaAct-1;
              }else{
                $minAct= $minTem-intval($minSis);
              }
              if($minAct<10) 
              {
                if ($horaAct>0)
                {
                  $Prcmin='100%';
                }else
                { 
                  $Prcmin=$minAct.'0%';
                }
                $minAct='0'.$minAct;
              }else
              {
                $Prcmin='100%';
              }
              if ($horaAct<10)
              {
                $horaAct='0'.$horaAct;
              }
              echo 
            '<td hidden>'.$horaAct.':'.$minAct.'</td>';
              echo 
            '<td>';
              switch ($value["statussolicitud"]) 
              {
                case 1:
                    if(intval($minAct)<3 and intval($horaAct)==0)
                    {
                        echo '<span class="badge badge-warning">Sin Asignar</span>
              </td>
              <td >';
                        echo 
                '<div class="info-box bg-gradient-warning" ><span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
                  <div class="info-box-content"><span class="info-box-text">Elapsed Time</span>
                    <span class="info-box-number">';
                        if ($horaAct>0){ echo $horaAct.' hours with '; }
                        if ($minAct>0){ echo $minAct.' minutes'; }
                        echo '</span><div class="progress">
                        <div class="progress-bar" style="width: '.$Prcmin.'">
                        </div>
                  </div>';
                    }
                    else
                    {
                        echo '<span class="badge badge-danger">Sin Asignar</span></td><td>';
                        echo '<div class="info-box bg-gradient-danger" style="font-size:small"><span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
                          <div class="info-box-content"><span class="info-box-text">Elapsed Time</span>
                            <span class="info-box-number">';
                        if ($horaAct>0){ echo $horaAct.' hours with '; }
                        if ($minAct>0){ echo $minAct.' minutes'; }
                        echo '</span><div class="progress">
                              <div class="progress-bar" style="width: '.$Prcmin.'"></div></div>';
                    }
                    break;
                case 2:
                    echo '<span class="badge badge-primary">Atendida</span></td><td>';
                    echo '<div class="info-box bg-gradient-primary"><span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                      <div class="info-box-content"><span class="info-box-text">Request attended</span>';
                    echo '<div class="progress"><div class="progress-bar" style="width: 100%"></div></div>';              
                    break;
                case 3:
                    echo '<span class="badge badge-success">en Proceso</span></td><td>';
                    echo '<div class="info-box bg-gradient-success"><span class="info-box-icon"><i class="fas fa-running"></i></span>
                      <div class="info-box-content"><span class="info-box-text">Elapsed Time</span>
                        <span class="info-box-number">';
                    if ($horaAct>0){ echo $horaAct.' hours with '; }
                    if ($minAct>=0){ echo $minAct.' minutes'; }
                    $Prcmin=intval((100/60)*$minAct);
                    $Prcmin=$Prcmin.'%';
                    if ($horaAct>0){$Prcmin='100%';}

                    echo '</span><div class="progress">
                          <div class="progress-bar" style="width: '.$Prcmin.'"></div></div>';
                  
                  break;
                case 4:
                    echo '<span class="badge badge-danger">Canceled</span></td><td>';
                    echo '<div class="info-box bg-gradient-danger"><span class="info-box-icon"><i class="fas fa-comment-slash"></i></span>
                      <div class="info-box-content"><span class="info-box-text">Request Cancelled</span>';
                    echo '<div class="progress"><div class="progress-bar" style="width: 100%"></div></div>';
                  break;
                default:
                  break;
              }
      echo'</td>';
      echo '<td>
          <div class="btn-group">
            <button  data-toggle="modal" data-target="#actualizaStatus" id="IdStatus1"
                  class="btn btn-danger btn-sm ml-3" ';
                  if ($value['statussolicitud']!=1 && $value['statussolicitud']!=3) {
                    echo ' disabled ';
                  }else{
                    echo '  onclick="ValorStatus('.$value['idsolicitud'].',4);" ';    
                  }
                echo ' >  
              <i class="fas fa-comment-slash text-white"> </i>
            </button>
            <button  data-toggle="modal" data-target="#actualizaStatus" id="IdStatus2"
                  class="btn btn-info btn-sm ml-3" ';
                  if ($value['statussolicitud']!=1 && $value['statussolicitud']!=3) {echo ' disabled ';}else{
                  echo ' onclick="ValorStatus('.$value['idsolicitud'].',2);"';}
                  echo '>
              <i class="fas fa-user-check text-white"> </i>
            </button>
          </div>
      </td>';
      echo '</tr>';
    } 
  }
  echo "</tbody></table></div>";
