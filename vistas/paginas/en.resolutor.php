<?php

                    include "controladores/formularios.controlador.php";
                    include "modelos/formularios.modelo.php";
$url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";


?>

<script type="text/javascript">
  $(document).ready(function()
  {
      $("#nombre").attr("readonly", true);
      $("#email").attr("readonly", true);
      $("#ubicacion").attr("disabled", true);
      $("#guardaDatos").attr("disabled", true);
      $("#cancelaDatos").attr("disabled", true);

 })
 
 	function checkText(e) {
	    tecla = (document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8) {
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /[A-Za-z0-9ÁÉÍÓÚÑáéíóúñ ]/;
	    tecla_final = String.fromCharCode(tecla).toUpperCase();
	   
	    return patron.test(tecla_final);
	}
	function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>
  <script src="<?php echo $url_actual;?>js/script-en.js"></script>
  <div class="content-wrapper" style="min-height:274px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header bg-secondary">
                <div class="card-title ">
                    <div class="text-center">
                        <h3>Hotel details</h3>

                    </div>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <?php 
                 $DatosHotel =ControladorFormularios::ctrSeleccionarRegistros('idHotel',$_SESSION['IdHotel'],'hotel'); 
              ?> 
              <div class="card-body">
                
                  <div class="form-group formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="formulario__label">Hotel name:</label>
                    <div class="input-group formulario__grupo-input">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control formulario__input" id="nombre" name="registroNombre" maxlength="150" onkeypress="return checkText(event)" onkeyup="mayus(this);" placeholder="Indique el nombre del hotel." <?php
                          echo 'value="'.$DatosHotel['nombreHotel'].'"';
                        ?>>
                        <input type="text" name="" id="nombre2" <?php
                          echo 'value="'.$DatosHotel['nombreHotel'].'"';
                        ?> hidden>
                      <i class="formulario__validacion-estado fas fa-times-circle" id="inombre"></i>
                    </div>
                    <p class="formulario__input-error">The name must be a maximum of 150 characters.</p>

                  </div>
                  <div class="form-group  formulario__grupo" id="grupo__email">
                    <label for="email"  class="formulario__label">Email:</label>

                    <div class="input-group  formulario__grupo-input">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-envelope"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control transformacion2  formulario__input" name="registroEmail"  id="email" maxlength="150" onkeypress="return checkEmail(event)" placeholder="Please enter a valid email." <?php
                      echo 'value="'.$DatosHotel['emailHotel'].'"';
                    ?> >
                    <input type="text" name="" id="email2" <?php
                          echo 'value="'.$DatosHotel['emailHotel'].'"';
                        ?> hidden>
                      <i class="formulario__validacion-estado fas fa-times-circle" id="iemail"></i>
                    </div>
                    <p class="formulario__input-error">You must enter a valid email.</p>

                  </div>
                  <div class="form-group formulario__grupo" id="grupo__ubicacion">
                    <label for="ubicacion"  class="formulario__label">Location:</label>
                    <div class="input-group  formulario__grupo-input">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-map-marked-alt"></i>
                        </span>
                      </div>
 
                    
                      <select required id="ubicacion" name="registroZona" class="custom-select">
                          <option value="">Select state</option>
                        <option value="Aguascalientes"  <?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Aguascalientes')){ echo 'selected';}?>>Aguascalientes</option>
                        <option value="Baja California"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Baja California')){ echo 'selected';}?>>Baja California</option>
                        <option value="Baja California Sur"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Baja California Sur')){ echo 'selected';}?>>Baja California Sur</option>
                        <option value="Campeche"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Campeche')){ echo 'selected';}?>>Campeche</option>
                        <option value="Chiapas"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Chiapas')){ echo 'selected';}?>>Chiapas</option>
                        <option value="Chihuahua"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Chihuahua')){ echo 'selected';}?>>Chihuahua</option>
                        <option value="Ciudad de México"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Ciudad de México')){ echo 'selected';}?>>Ciudad de México</option>
                        <option value="Coahuila"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Coahuila')){ echo 'selected';}?>>Coahuila</option>
                        <option value="Colima"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Colima')){ echo 'selected';}?>>Colima</option>
                        <option value="Durango"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Durango')){ echo 'selected';}?>>Durango</option>
                        <option value="Estado de México"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Estado de México')){ echo 'selected';}?>>Estado de México</option>
                        <option value="Guanajuato"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Guanajuato')){ echo 'selected';}?>>Guanajuato</option>
                        <option value="Guerrero"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Guerrero')){ echo 'selected';}?>>Guerrero</option>
                        <option value="Hidalgo"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Hidalgo')){ echo 'selected';}?>>Hidalgo</option>
                        <option value="Jalisco"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Jalisco')){ echo 'selected';}?>>Jalisco</option>
                        <option value="Michoacán"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Michoacán')){ echo 'selected';}?>>Michoacán</option>
                        <option value="Morelos"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Morelos')){ echo 'selected';}?>>Morelos</option>
                        <option value="Nayarit"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Nayarit')){ echo 'selected';}?>>Nayarit</option>
                        <option value="Nuevo León"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Nuevo León')){ echo 'selected';}?>>Nuevo León</option>
                        <option value="Oaxaca"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Oaxaca')){ echo 'selected';}?>>Oaxaca</option>
                        <option value="Puebla"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Puebla')){ echo 'selected';}?>>Puebla</option>
                        <option value="Querétaro"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Querétaro')){ echo 'selected';}?>>Querétaro</option>
                        <option value="Quintana Roo"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Quintana Roo')){ echo 'selected';}?>>Quintana Roo</option>
                        <option value="San Luis Potosí"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('San Luis Potosí')){ echo 'selected';}?>>San Luis Potosí</option>
                        <option value="Sinaloa"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Sinaloa')){ echo 'selected';}?>>Sinaloa</option>
                        <option value="Sonora"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Sonora')){ echo 'selected';}?>>Sonora</option>
                        <option value="Tabasco"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Tabasco')){ echo 'selected';}?>>Tabasco</option>
                        <option value="Tamaulipas"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Tamaulipas')){ echo 'selected';}?>>Tamaulipas</option>
                        <option value="Tlaxcala"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Tlaxcala')){ echo 'selected';}?>>Tlaxcala</option>
                        <option value="Veracruz"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Veracruz')){ echo 'selected';}?>>Veracruz</option>
                        <option value="Yucatán"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Yucatán')){ echo 'selected';}?>>Yucatán</option>
                        <option value="Zacatecas"<?php if (strtoupper($DatosHotel['zonaHotel'])==strtoupper('Zacatecas')){ echo 'selected';}?>>Zacatecas</option>

                      </select>

                    

                    <input type="text" name="" id="ubicacion2" <?php
                          echo 'value="'.$DatosHotel['zonaHotel'].'"';
                        ?> hidden>
                      <i class="formulario__validacion-estado fas fa-times-circle" id="iubicacion"></i>
                    </div>
                    <p class="formulario__input-error">The name must be a maximum of 150< characters.</p>
                  </div>
                                    
<div class="container-fluid"> 
                    <div class="row">
                    
                        <div class="col p-2">
                            <button class="btn btn-warning" onclick="ActivaInput();">
                                Edit data
                            </button>
                        </div>
                        <div class="col p-2">
                          <button class="btn btn-success" id="guardaDatos" onclick="verificaDatos(<?php echo $_SESSION['IdHotel'] ?>);">Save
                          </button>
                        </div>
                        <div class="col p-2">
                          <button class="btn btn-danger" id="cancelaDatos"  onclick="cancela();">   Cancel
                          </button>
                        </div>
                   
                        <div class="col p-2">
                        <button class="btn btn-primary btn-sm p-2" data-toggle="modal" data-target="#CambiaPassword">
                        Update password
                          </button>
                      </div>
                      <div class="col p-2">
                        <button class="btn btn-primary btn-sm p-2" data-toggle="modal" data-target="#CambiaLogo">
                          Update the logo
                        </button>
                      </div>
                      </div>
                  
                </div>
                </div>
            </div>
          </div>
        </div>    
      </div>
    </section>
    <!-- /.content -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-secondary">
                <div class="card-title col-11">
                  <div class="row">
                    <div class="col-8 text-left">
                      <h3>Collaborators</h3>   
                    </div>
                    <div class="col-4 text-left">
                            <button class="btn btn-warning btn-sm p-2" data-toggle="modal"data-target="#crearResolutor">Add new collaborator</button>
                    </div>
                  </div>
                </div>
                <div class="card-tools col-1">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                  <table class="table table-bordered table-striped" width="100%">
                    <thead>
                      <tr>
                        
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $resolutores =ControladorFormularios::ctrSeleccionarRegistros('idHotel',$_SESSION['IdHotel'],'resolutor');
                        foreach ($resolutores as $key => $value) {
                        echo '<tr>';
                                if (!isset($value["fotoresolutor"]) || $value["fotoresolutor"]==''){
                                  $rutaFotoReso=$url_actual.'img/usuarios/resolutores/default.png';
                                }else{
                                  $rutaFotoReso=$url_actual.'img/usuarios/resolutores/'.$value["fotoresolutor"];
                                }
                                echo '<td width=50px>
                                        <div class="image">
                                          <img src="'.$rutaFotoReso.'"  width=50px height=50px class="fotoRes img-circle elevation-2" id="fotoR" alt="User Image">
                                        </div>
                                      </td>';
                                echo '<td>'.$value["nombreresolutor"].'</td>
                                     <td>'.$value["puestoresolutor"].'</td>
                                        <td width=50px>
                                <div class="btn-group">
                                  <button class="btn btn-warning btn-sm"  id="btmodal" data-toggle="modal" data-target="#EditarResolutor" onclick="EditaResolutorId('.$value['idresolutor'].');"> <i class="fa fa-pencil-alt text-white"></i>
                                  </button>
                                 
                                    <button type="button" class="btn btn-danger btn-sm" onclick="EnviaResolutorId('.$value['idresolutor'].');">
                                      <i class="fa fa-trash-alt text-white"></i>
                                    </button>
                                                                
                              </td>
                            </tr>';
                              } 
                      ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header bg-secondary">
                <div class="card-title ">
                    <h3>Rooms</h3>
   
                    <?php
                                if($DatosHotel['pkHotel']>1){ 
                                    echo ' 
                                        <button class="btn btn-primary btn-sm p-2"    data-toggle="modal" data-target="#modificaHab" id="IdHab" onclick="modificaHabita('.$_SESSION['IdHotel'].',0,``)"Add new Room
                                        </button>';
                                }
                    ?>
                           
                </div>
                <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                </div>
              </div>
              <div class="card-body">
                  <div class="row">

                    <div class="col-12">
                      <table id="example1" class="table table-bordered table-striped  nowrap" role="grid" aria-describedby="example1_info" width="98%" >
                        
                        <thead>
                          <tr>
                            <th>Folio</th>
                            <th>Room</th>
                            <th>QR</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                                                  
                                <?php 
                                //include "../controladores/formularios.controlador.php";
                                //include "../modelos/formularios.modelo.php";

                                
                                $habitaciones =ControladorFormularios::ctrSeleccionarHabitaciones($_SESSION['IdHotel']);
                               
                                foreach ($habitaciones as $key => $value) {

                                echo '
                                <tr>';
                              
                                 echo ' 
                                    
                                  <td width=50px>'.$value["foliohabitaciones"].'</td>
                                  <td>'.$value["numhabitacionhuesped"].'</td>';


                                  if (!isset($value["qrhabitaciones"]) || $value["qrhabitaciones"]==''){
                                      $rutaQR='';
                                   }else{
                                        $rutaQR=$url_actual.'img/qr'.$value["qrhabitaciones"];
                                   }
                                   if (!isset($value["qrPdf"]) || $value["qrPdf"]==''){
                                      $rutaPDF='';
                                   }else{
                                        $rutaPDF=$url_actual.'img/qr'.$value["qrPdf"];
                                   }
                                 echo ' <td width=50px>
                                    <div class="image text-center">';
                                echo '
                                    <img src="'.$rutaQR.'"  width=50px height=50px class="fotoRes img-circle elevation-2 " id="qrHab" alt="User Image">
                                    ';
                                if (($value["numhabitacionhuesped"]>0))
                                { 

                                    if (!empty($rutaPDF)){ 
                                      echo '<a href="'.$url_actual.'paginas/descargaPdf.php?idh='.base64_encode($_SESSION['IdHotel']).'&hab='.base64_encode($value['numhabitacionhuesped']).'&qrHab='.base64_encode($value['qrhabitaciones']).'"  target="_blank"  class="btn btn-primary btn-sm btn-block">Download QR</a>';

                                    //echo '<a href="'.$rutaPDF.'" download="QR - Hab ('.$value["numhabitacionhuesped"].').pdf"  class="btn btn-primary btn-sm btn-block">Download QR</a>';
                                  /*
                                      echo '
                                      <button class="btn btn-primary btn-sm btn-block"    onclick="descargaAPDF('.$_SESSION['IdHotel'].','.$value['numhabitacionhuesped'].',`'.$value['qrhabitaciones'].'`);"> Download QR
                                      </button>
                                      ';
                                      */
                                    }
                                }
                                 echo '</div>
                                  </td>';
                                    
                                  echo'
                                  <td width=50px>
                                    <div class="btn-group">
                                      <button class="btn btn-warning btn-sm"   data-toggle="modal" data-target="#modificaHab" id="IdHab" onclick="modificaHabita('.$_SESSION['IdHotel'].','.$value['idhabitaciones'].',`'.$rutaQR.'`);"> <i class="fa fa-pencil-alt text-white"  title="Cam"></i>
                                      </button>
                                      ';
                                      if($DatosHotel['pkHotel']>1){ 
                                        echo ' 
                                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminaHabita('.$value['idhabitaciones'].');">
                                            <i class="fa fa-trash-alt text-white"></i>
                                        </button>';
                                      }
                                    echo ' 
                                      </div>
                                  </td>
                                </tr>';
                                  } 
                                ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
 
    <!-- Main content -->




    <!-- Main content -->





<div class="modal fade" role="dialog" id="crearResolutor">
 
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form method="POST"   enctype="multipart/form-data">
     
        <div class="modal-header bg-info">
          
            <h4 class="modal-title">Create collaborator</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

            
          
            <div class="form-group text-center">
              <input type="file" name="logoHotel" class="d-none" id="logoHotel">

              <label for="logoHotel" class="d-none d-md-block ">

              <img src="<?php echo $url_actual;?>/img/subirFoto.png" class="img-fluid  prevLogoHotel"  width="200" height="200">

              </label>
            </div>
            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-user"></i>
              </div>

              <input maxlength="20" id="name" type="text" onKeyUp="this.value=this.value.toUpperCase();" class="form-control" name="name"  required autocomplete="name" autofocus placeholder="Name">

             
            </div>

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-user"></i>
              </div>

              <input maxlength="20" id="apaterno" type="text" class="form-control"  onKeyUp="this.value=this.value.toUpperCase();" name="apaterno"  required autocomplete="secondname" autofocus placeholder="Paternal Surname">

             
            </div> 

            <div class="input-group col-xs-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-user"></i>
              </div>

              <input maxlength="20" id="amaterno" type="text"  onKeyUp="this.value=this.value.toUpperCase();" class="form-control" name="amaterno"  required autocomplete="secondname" autofocus placeholder="Employee position">

             
            </div> 
        </div>

        <div class="modal-footer d-flex justify-content-between">
     <?php 

    
    //include "./controladores/resolutor.controlador.php";
    //include "./modelos/resolutor.modelo.php";

    $registro = ControladorResolutor::ctrRegistro();

    if($registro == "ok"){
      //header("Refresh:1");
      echo '<script>

        if ( window.history.replaceState ) {

          window.history.replaceState( null, null, window.location.href );

        }

      </script>';
      echo '<script type="text/JavaScript"> location.reload(); </script>';
      echo '<div class="alert alert-success">User has been registered</div>';
    //header("Refresh:1");
    }

 

    ?>              
                       
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>

        </div>

      </form>

    </div> 

  </div> 

</div>



<div class="modal fade" role="dialog" id="EditarResolutor">
 
  <div class="modal-dialog" role="document">
   
    <div class="modal-content">

      <form method="POST"   enctype="multipart/form-data">
     
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Modify collaborator data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">
            
            <div class="form-group text-center">
              
              <input type="file" name="fotoReso" class="d-none" id="fotoReso" value="fotoReso">

              <label for="fotoReso" class="d-none d-md-block ">

              <img src="<?php echo $url_actual;?>/img/subirFoto.png" class="prevfotoReso img-fluid"  width="200" height="200">
              
              </label>
            </div>
            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-user"></i>
              </div>

              <input maxlength="20" id="nom" type="text" class="form-control" name="nom"  onKeyUp="this.value=this.value.toUpperCase();" required autocomplete="name" autofocus placeholder="Name">

             
            </div>

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-user"></i>
              </div>

              <input maxlength="20" id="apaternoRes" type="text" class="form-control" name="apaternoRes"  onKeyUp="this.value=this.value.toUpperCase();" required autocomplete="secondname" autofocus placeholder="Paternal Last Name">

             
            </div> 

            <div class="input-group col-xs-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-user"></i>
              </div>

              <input maxlength="20" id="amaternoRes" type="text" class="form-control" name="amaternoRes"  onKeyUp="this.value=this.value.toUpperCase();" required autocomplete="secondname" autofocus placeholder="Employee position">

             
            </div> 
            <input type="hidden" id="IdReso" name="IdReso">
            <input type="hidden" id="rutaF" name="rutaF">
        </div>

        <div class="modal-footer d-flex justify-content-between">
            
                       
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
            <?php
               
  
                  $Respuesta=ControladorFormularios::ctrActualizarResolutor();

                 //echo $url_actual.'/img/subirFoto.png"'; 

                  if ($Respuesta=='ok'){
                    echo " 
                    <script  type='text/javascript'>
                        Swal.fire('El colaborador se actualizó correctamente','','success');
                        if ( window.history.replaceState ) {
                            window.history.replaceState( null, null, window.location.href );
                        }
                        location.reload(); 
                    </script>
                    ";
                  }
              ?>
          <div>
            <button class="btn btn-primary"   type="submit"  >Save</button>

          </div>


        </div>

      </form>

    </div> 

  </div> 

</div>
  
      <div class="modal fade"  role="dialog" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Remove collaborator</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idElimina">
                <p>Are you sure you want to remove this contributor?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">NO</button>
              <button type="button" class="btn btn-outline-light" onclick="EliminaResolutorId();">YES</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


<div class="modal fade" role="dialog" id="CambiaPassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">Enter the new password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group formulario__grupo" id="grupo__password">
          <label for="pwd"  class="formulario__label">New password:</label>
          <div class="input-group  formulario__grupo-input">
            <div class="input-group-prepend">
              <span class="input-group-text">
                  <i class="fas fa-lock"></i>
              </span>
            </div>
            <input type="password" class="form-control" name="registroPassword"  id="pwd" maxlength="8" minlength="4" placeholder="Please enter a password with at least 4 characters.">

            <div class="input-group-prepend">
              <i class="formulario__validacion-estado-pwd fas fa-times-circle" id="ipassword"></i>
            </div>
            <div class="input-group-prepend">
              <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> 
              </button>
            </div>
          </div>
            <p class="formulario__input-error">You must enter a password with a minimum of 4 characters and a maximum of 8.</p>

        </div>
        <div class="form-group formulario__grupo" id="grupo__password2">
            <label for="pwd"  class="formulario__label">Confirm the new password:</label>
          <div class="input-group  formulario__grupo-input">
            <div class="input-group-prepend">
              <span class="input-group-text">
                  <i class="fas fa-lock"></i>
              </span>
            </div>
            <input type="password" class="form-control" name="registroPassword2"  id="pwd2" maxlength="8" minlength="4"  placeholder="Repeat the previous password.">

            <div class="input-group-prepend">
                  <i class="formulario__validacion-estado-pwd fas fa-times-circle" id="ipassword2"></i>
            </div>
            <div class="input-group-prepend">
                <button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
            </div>
          </div>
          <p class="formulario__input-error">Both passwords must be the same.</p>

        </div>            
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        <div>
            <button class="btn btn-primary" data-dismiss="modal" onclick="ValidaPass(<?php echo $_SESSION['IdHotel'] ?>);" >Save</button>
        </div>
      </div>
    </div> 
  </div> 
</div>

<div class="modal fade" role="dialog" id="CambiaLogo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">Update the hotel logo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="formulario p-1 bg-light" id="formulario"  method="post"  enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group text-center formulario__grupo-logo">
            <input type="file" name="logoHotelAct" class="d-none" id="logoHotelAct">
            <label for="logoHotelAct" class="d-none d-md-block formulario__label" >
              <?php
                  $logo=ControladorLogoHotel::ctrActualizarBuscaLogo($_SESSION['IdHotel']);
              ?>
            </label>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
          <div>
            <button type="submit" class="btn btn-primary"  >Save</button>
              <?php
                  $RespuestaLogo=ControladorLogoHotel::ctrActualizarLgHotel($_SESSION['IdHotel']);

                 //echo $url_actual.'/img/subirFoto.png"'; 
                 
                  if ($RespuestaLogo!='error'){
                      session_start();
                      $_SESSION['logoHotel']=$RespuestaLogo;
                    echo " 
                    <script>
                    $('#LogoHtel').attr('src','".$RespuestaLogo."');
                    //document.getElementById('LogoHtel').src='".$RespuestaLogo."';
                    //alert('".$_SESSION['logoHotel']."');
                        Swal.fire('Logo updated successfully','','success');
                        // window.location.assign('resolutor');
                         
                    </script>
                    ";
                  }
              ?>
          </div>
        </div>
      </form>
    </div> 
  </div>
</div>
<script src="<?php echo $url_actual;?>js/script-en.js"></script>

<script src="<?php echo $url_actual;?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>