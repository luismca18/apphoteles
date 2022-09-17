<?php 
//session_start();
?>

<?php
//.str_replace('plantillaadmin.php','',$_SERVER["REQUEST_URI"])
$url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";
$document_root = $_SERVER['DOCUMENT_ROOT'];

     
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hospedaje</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- ======================
	    plugins de ccs
======================-->


<link rel="stylesheet" href="<?php echo $url_actual;?>css/bootstrap.min.css" crossorigin="anonymous" >
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" href="<?php echo $url_actual;?>css/plugins/OverlayScrollbars.min.css" >
<link rel="stylesheet" href="<?php echo $url_actual;?>css/notie.css" >
<link rel="stylesheet" href="<?php echo $url_actual;?>css/estilos.css">
<link rel="stylesheet" href="<?php echo $url_actual;?>css/sweetalert2.css" >
<link rel="stylesheet" href="<?php echo $url_actual;?>css/plugins/adminlte.min.css" >
<link rel="stylesheet" href="<?php echo $url_actual;?>css/plugins/fontawesome-free/all.min.css" >
<link rel="stylesheet" href="<?php echo $url_actual;?>css/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Ionicons -->
<link rel="stylesheet" href="<?php echo $url_actual;?>css/ionicons.min.css">
<!-- DataTables -->
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo $url_actual;?>css/plugins/daterangepicker.css">

<link rel="stylesheet" href="<?php echo $url_actual;?>css/plugins/datatables-bs4/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $url_actual;?>css/plugins/datatables-responsive/responsive.bootstrap4.min.css">
<!-- Theme style -->
<!-- Google Font: Source Sans Pro -->
  



<style type="text/css">/* Chart.js */
	@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
</style>

<!-- ======================
	      plugins de JS
     ======================-->
     <script type="text/javascript">
	function mayus(e) {
	    e.value = e.value.toUpperCase();
	}
	function mostrarPassword(){
			var cambio1 = document.getElementById("pwd");
			var cambio2 = document.getElementById("pwd2");
			if(cambio1.type == "password"){
				cambio1.type = "text";
				$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
			}else{
				cambio1.type = "password";
				$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
			}
			if(cambio2.type == "password"){
				cambio2.type = "text";
				$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
			}else{
				cambio2.type = "password";
				$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
			}

	} 

	function checkText(e) {
	    tecla = (document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8) {
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /[A-Za-zÁÉÍÓÚáéíóú ]/;
	    tecla_final = String.fromCharCode(tecla).toUpperCase();
	   
	    return patron.test(tecla_final);
	}

	function checkNum(e) {
	    tecla = (document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8) {
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /[0-9]/;
	    tecla_final = String.fromCharCode(tecla).toUpperCase();
	   
	    return patron.test(tecla_final);
	}

	function checkTextN(e) {
	    tecla = (document.all) ? e.keyCode : e.which;

	    //Tecla de retroceso para borrar, siempre la permite
	    
	    if (tecla == 8) {
	        return true;
	    }

	    // Patron de entrada, en este caso solo acepta numeros y letras
	    patron = /[A-Za-zÁÉÍÓÚáéíóú.:,+*0-9 ]/;
	    tecla_final = String.fromCharCode(tecla).toUpperCase();
	   
	    return patron.test(tecla_final);
	}

	function checkEmail(e) {
				e.value = e.value.toLowerCase();
	}

</script>
<script src="<?php echo $url_actual;?>js/jquery.min.js"></script>
<script src="<?php echo $url_actual;?>js/script-en.js"></script>
<script src="<?php echo $url_actual;?>js/notie.js"></script>
<script src="<?php echo $url_actual;?>js/sweetalert2.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?php echo $url_actual;?>js/e632f1f723.js" crossorigin="anonymous"></script>

<script src="<?php echo $url_actual;?>js/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/chart.js/Chart.min.js"></script>

<script src="<?php echo $url_actual;?>js/popper.min.js"></script>
<script src="<?php echo $url_actual;?>js/bootstrap.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo $url_actual;?>js/plugins/adminlte.js"></script>

<script lang="javascript" src="<?php echo $url_actual;?>js/plugins/xlsx/dist/xlsx.full.min.js"></script>
<!-- 
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
 -->

</head>
<body class="sidebar-mini layout-fixed" style="height: auto;">
	<div class="wrapper">
		
	<?php	include_once "modulos/en.cabecera.php"; ?>
	<?php	include_once "modulos/en.sidebar.php"; ?>

	</div>	
	
