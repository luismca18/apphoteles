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
<script src="<?php echo $url_actual;?>js/script.js"></script>
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
                                    <h3>Contáctanos</h3>
                                </div>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table id="example2" class="table table-bordered table-striped  nowrap">
                                    <thead class="btn-info">
                                        <tr>
                                            <th class="text-center">Youtube</th>
                                            <th class="text-center">Whatsapp</th>
                                            <th class="text-center">Correo Electrónico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center" width="33%"><a href="https://www.youtube.com/channel/UCJEjPcrhHj7j3kCCYfPGHOw" target="_blank"><i class="fa-brands fa-youtube fa-3x" style="color:red;"></i></a></td>
                                            <td class="text-center"><a href="https://wa.me/+0527441420770?text=Necesito%20ayuda%20con%20VixDrix%20Hopedaje" target="_blank"><i class="fa-brands fa-whatsapp fa-3x"  style="color:#60c370;"></i></a></td>
                                            <td class="text-center" width="33%"><a href="mailto:sorporte@vixdrix.com" target="_blank"><i class="fa-solid fa-at fa-3x" ></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>    
            </div>
        </div>
    </section>
</div>
 

<script src="<?php echo $url_actual;?>js/script.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>