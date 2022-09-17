$("#email").change(function(){

	$(".alert").remove();

	var email = $(this).val();
	
	var datos = new FormData();
	datos.append("validarEmail", email);

	$.ajax({

		url: "ajax/formularios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			//console.log(respuesta);
			if(respuesta.length>0){

				$("#email").val("");

				$("#email").parent().after(`
					
					<div class="alert alert-warning">

							<b>ERROR:</b>

							El correo electrónico ya existe en la base de datos,  por favor ingrese otro diferente
					</div>


				`);

			}
		}

	});
})


//
/*=============================================

=============================================*/
$("#logoHotel").change(function(){
$(".alert").remove();

	
	var imagen = this.files[0];
	
	/*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    	$("#logoHotel").val("");

    	$("#logoHotel").after(`

				<div class="alert alert-danger">¡La imagen debe estar en formato JPG o PNG!</div>
    		
    	`)

    	return;

    }else if(imagen["size"] > 2000000){

    	$("#logoHotel").val("");

    	$("#logoHotel").after(`

				<div class="alert alert-danger">¡La imagen no debe pesar más de 2MB!</div>
    		
    	`)

    	return;
    
    }else{
        $(".alert").remove();
    	 var datosImagen = new FileReader;

    	 datosImagen.readAsDataURL(imagen);

    	 $(datosImagen).on("load", function(event){

    	 	var rutaImagen = event.target.result;

    	 	$(".prevLogoHotel").attr("src", rutaImagen);

    	 })

    }

})


$("#logoHotelAct").change(function(){
$(".alert").remove();

    
    var imagen = this.files[0];
    
    /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $("#logoHotelAct").val("");

        $("#logoHotelAct").after(`

                <div class="alert alert-danger">¡La imagen debe estar en formato JPG o PNG!</div>
            
        `)

        return;

    }else if(imagen["size"] > 2000000){

        $("#logoHotelAct").val("");

        $("#logoHotelAct").after(`

                <div class="alert alert-danger">¡La imagen no debe pesar más de 2MB!</div>
            
        `)

        return;
    
    }else{
        $(".alert").remove();
         var datosImagen = new FileReader;

         datosImagen.readAsDataURL(imagen);

         $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;

            $(".prevlogoHotelAct").attr("src", rutaImagen);

         })

    }

})



/*=============================================

=============================================*/
$("#fotoReso").change(function(){
$(".alert").remove();

	
	var imagen = this.files[0];
	
	/*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    	$("#fotoReso").val("");

    	$("#fotoReso").after(`

				<div class="alert alert-danger">¡La imagen debe estar en formato JPG o PNG!</div>
    		
    	`)

    	return;

    }else if(imagen["size"] > 2000000){

    	$("#fotoReso").val("");

    	$("#fotoReso").after(`

				<div class="alert alert-danger">¡La imagen no debe pesar más de 2MB!</div>
    		
    	`)

    	return;
    
    }else{
        $(".alert").remove();
    	 var datosImagen = new FileReader;

    	 datosImagen.readAsDataURL(imagen);

    	 $(datosImagen).on("load", function(event){

    	 	var rutaImagen = event.target.result;

    	 	$(".prevfotoReso").attr("src", rutaImagen);
    	 	$("#rutaF").val(rutaImagen);

    	 })

    }

})


function ObtenerSolicitudId($solicitud_id)
{
    
    $.ajax({

        url:"ajax/solicitudes.ajax.php",
        type:'POST',
        data: {solicitud_id:$solicitud_id },
        beforeSend:function(){},
        success:function(respuesta){
            data=$.parseJSON(respuesta);
             if(data.length>0)
            {
                $('#idsol').val(data[0]['idsolicitud']);
                $('#comentrioHI').val(data[0]['descripcionsolicitud']);
                $('#valsol').val(data[0]['valoracionsolicitud']);
                $('#comentrioHF').val(data[0]['comentariosolicitud']);
                $('#comentrioR').val(data[0]['comentarioresolutor']);
            }
            
        }
    });
}


function EditaResolutorId($resolutor_id)
{
    var URLactual = window.location.href;
    var UrlFoto=URLactual.replace('resolutor','vistas/img/usuarios/resolutores/');
    $('#IdReso').val($resolutor_id);

    $.ajax({
        url:"ajax/resolutores.ajax.php",
        type:'POST',
        data: {resolutor_id:$resolutor_id },
        beforeSend:function(){},
        success:function(respuesta){
            data=$.parseJSON(respuesta);
            if(data.length>0)
            {
                $('#nom').val(data[0]['nombreresolutor']);
                $('#apaternoRes').val(data[0]['apellidoPresolutor']);
                $('#amaternoRes').val(data[0]['puestoresolutor']);
                
                
                if (data[0]['fotoresolutor']!=''){
                    rutaImagen=UrlFoto+data[0]['fotoresolutor'];
                }else{
                    rutaImagen=UrlFoto+ "default.png";
                } 
                $(".prevfotoReso").attr("src", rutaImagen);
                $('#fotoReso').val(rutaImagen);
            }
        }
    });
}

function EnviaResolutorId($resolutor_id){
  //      $('#idElimina').val($resolutor_id);
//}
//EnviaResolutorId
//function EliminaResolutorId()
//{
   // $id=$('#idElimina').val();
     $id=$resolutor_id;
    //var URLactual = window.location.href;
    //var UrlFoto=URLactual.replace('resolutor','vistas/img/usuarios/resolutores/');
    Swal.fire({
              title: '¿Está seguro de eliminar este colaborador?',
              text: "¡Si no lo está puede cancelar la acción!",
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Si, elimina el colaborador!',
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.ajax({
                    url:"ajax/resolutores.ajax.php",
                    type:'POST',
                    data: {Eliminarid:$id },
                    beforeSend:function(){},
                    success:function(respuesta){
                        console.log(respuesta);
                        //console.log($id);
                        if(respuesta=="ok")
                        {
                            //console.log(respuesta);
                            
                            Swal.fire('El colaborador se elimino correctamente','','success')
                                        return window.location.href = "resolutor";
                        }
                    }
                });
            }
            else
            {
                
            }
        })

 
    

}


function ActualizaRes()
{
    
    var id = $('#IdReso').val();
    var foto = $('#fotoReso');
    var nombre = $('#nom').val();
    var ape = $('#apaternoRes').val();
    var ame= $('#amaternoRes').val();
    var datos = new FormData();
    
    datos.append("id", id);
    datos.append("foto", fotoReso);
    datos.append("nombre", nombre);
    datos.append("apaterno",ape);
    datos.append("amaterno", ame);
    /*
    datos.append("id", IdReso);
    datos.append("foto", fotoReso);
    datos.append("nombre", nom);
    datos.append("apaterno",apaternoRes);
    datos.append("amaterno", amaternoRes);
    */
    //id=$('#SelectResolutor').val();
    //console.log(id);
    //id=id.substr(0,id.indexOf(" -"));
    //var idSol =$("#idH").val()
    //var id = document.getElementById('IdReso').value;

/*  id=$('#IdReso').val();
    foto=$('#rutaF').val();
    nombre=$('#nom').val();
    apaterno=$('#apaternoRes').val();
    amaterno=$('#amaternoRes').val();
*/  

    
    //parametros={"idreso":id,"fotoRes":foto,"nomRes":nombre,"ApaternoRes":apaterno,"AmaternoRes":amaterno}
    
    //getData();

    //console.log(table);
    //console.log(datos);
    $.ajax({

        url:"ajax/resolutores.ajax.php",
        /*
        type:'POST',
        data:parametros,
        beforeSend:function(){},
        */
                
        type:'POST',
        contentType:false,
        data: datos,
        processData:false,
        cache:false,
        dataType: "json",
        beforeSend:function(){},
        success:function(respuesta){
            console.log(respuesta);
            if(respuesta=="ok"){
                window.location.href = "resolutor";
                //table.ajax.reload();
            }else{
                console.log("campos vacios");
            }
        
            
        }
    }); return window.location.href = "resolutor";
}



function modificaHabita($idhotel,$IdHab,$QR) {
    var rutaQR=$QR;
    var idHabita=$IdHab;
    if($IdHab==0){
        $tipo=1;
    }else
    { $tipo=2;}
    const { value: numHabita } = Swal.fire({
      imageUrl: rutaQR,
      imageWidth: 200,
      imageHeight: 200,
      imageAlt: 'Custom image',
      title: 'Ingrese el Número de Habitación del este Qr',
      input: 'number',
      //inputValue: '',
      showCancelButton: true,
      inputAttributes: {
        autocapitalize: 'off',
        placeholder:'Indique el número de Habitación',
        required: true
      },
      inputValidator: (value) => {
        if (!value) {
          return 'Necesita agregar el número de Habitación!'
        }
        else
        {
            //alert($tipo);
            /*
               $.ajax({    
                    url:"ajax/resolutores.ajax.php",
                    type:'POST',
                    data: {idhbt:IdHabita},
                    beforeSend:function(){},
                    success:function(respuesta){
            */
            var $comentario=value;
            //alert($comentario+','+$idhotel+','+$tipo+','+idHabita);
            $.ajax({    
                url:"ajax/resolutores.ajax.php",
                type:'POST',
                data: { idhotel: $idhotel, idhab:idHabita, numHabita: $comentario},
                beforeSend:function(){},
                success:function(respuesta){
                    console.log(respuesta);
                    Swal.fire('Se ha actualizado correctamente','','success');
                    return window.location.href = "resolutor";
                }
            });
        }
      }
    })
        
         
    
}


function eliminaHabita($IdHab) {
    var IdHabita=$IdHab;

   if (IdHabita>0)
    { 

       Swal.fire({
              title: '¿Está seguro de Eliminar esta Habitación?',
              text: "¡Si no lo está puede cancelar la acción!",
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Si, elimina la Habitación!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({    
                    url:"ajax/resolutores.ajax.php",
                    type:'POST',
                    data: {idhbt:IdHabita},
                    beforeSend:function(){},
                    success:function(respuesta){
                        
                      //  if (respuesta=="ok"){
                            Swal.fire('La habitación se elimino correctamente','','success')
                            return window.location.href = "resolutor";
                       // }         
                    }
                });
                
                
            }
            else
            {
                
            }
        })

    }
}

  function ActivaInput(){
      $("#nombre").attr("readonly", false);
      $("#email").attr("readonly", false);
      $("#ubicacion").attr("disabled", false);
      $("#guardaDatos").attr("disabled", false);
      $("#cancelaDatos").attr("disabled", false);

  }
    function cancela(){
      $("#nombre").val($("#nombre2").val());
      $("#email").val($("#email2").val());
      $("#ubicacion").val($("#ubicacion2").val());
      $("#nombre").attr("readonly", true);
      $("#email").attr("readonly", true);
      
      $("#ubicacion").attr("disabled", true);
      $("#guardaDatos").attr("disabled", true);
      $("#cancelaDatos").attr("disabled", true);

  }
  function verificaDatos($IdHotel){
      var IdH=$IdHotel;
      var comentario="Por favor, verifique estos datos: \n";
      var Err=0;
      if ($("#nombre").val()==""){
        comentario =comentario + "Nombre del hotel. \n";
        Err++;
      }
      if ($("#email").val()==""){
        comentario =comentario + "Correo electrónico. \n";
        Err++;
      }
      console.log(estados($("#ubicacion").val().toLowerCase()));
      if ($("#ubicacion").val()=="" || !estados($("#ubicacion").val().toLowerCase())){
        comentario =comentario + "La ubicación del hotel. \n";
        Err++;
      }      

      if (Err>0){
            alert(comentario);
      }else{
            actualizaDatos(IdH);
      }
  }

function estados(ubicacion){
    switch (ubicacion){
        case 'aguascalientes':
            return true;
            break;
        case 'baja california':
        return true;
        break;      
        case 'baja california sur':
        return true;
        break;
        case 'campeche':
        return true;
        break;
        case 'chiapas':
            return true;
        break;
        case 'chihuahua':
            return true;
        break;
        case 'ciudad de méxico':
            return true;
        break;
        case 'coahuila':
            return true;
        break;
        case 'colima':
            return true;
        break;
        case 'durango':
            return true;
        break;
        case 'estado de méxico':
            return true;
        break;
        case 'guanajuato':
            return true;
        break;
        case 'guerrero':
            return true;
        break;
        case 'hidalgo':
            return true;
        break;
        case 'jalisco':
            return true;
        break;
        case 'michoacán':
            return true;
        break;
        case 'morelos':
            return true;
        break;
        case 'nayarit':
            return true;
        break;
        case 'nuevo león':
            return true;
        break;
        case 'oaxaca':
            return true;
        break;
        case 'puebla':
            return true;
        break;
        case 'querétaro':
            return true;
        break;
        case 'quintana roo':
            return true;
        break;
        case 'san luis potosí':
            return true;
        break;
        case 'sinaloa':
            return true;
        break;
        case 'sonora':
            return true;
        break;
        case 'tabasco':
            return true;
        break;
        case 'tamaulipas':
            return true;
        break;
        case 'tlaxcala':
            return true;
        break;
        case 'veracruz':
            return true;
        break;
        case 'yucatán':
            return true;
        break;
        case 'zacatecas':
            return true;
        break;
        case 'ciudad de mexico':
            return true;
        break;
        default:
            return false;
           
    }
}


  function ValidaPass($IdHotel){
      var IdH=$IdHotel;
      var comentario="Por favor, verifique: \n";
      var Err=0;

      if ($("#pwd").val()==""){
        comentario =comentario + "La contraseña que ingreso no es válida. \n";
        Err++;
      }else if ($("#pwd2").val()==""){
        comentario =comentario + "Confirme la nueva contraseña. \n";
        Err++;
      }else if ($("#pwd").val()!=$("#pwd2").val()){
        comentario =comentario + "Las contraseñas no coinciden. \n";
        Err++;
      }

      if (Err>0){
           // alert(comentario);
            Swal.fire(comentario,'','error');
      }else{
            actualizaPass(IdH);
      }
  }


function actualizaDatos($IdHotel) {
    var IdH=$IdHotel;
    if($("#nombre").val()!=""){
        var valNombre=$("#nombre").val();
    }
    if($("#email").val()!=""){
        var valEmail=$("#email").val();
    }
    if($("#ubicacion").val()!=""){
        var valUbicacion=$("#ubicacion").val();
    }


   if (IdH>0)
    { 

       Swal.fire({
              title: '¿Está seguro actualizar los datos?',
              text: "¡Si no lo está puede cancelar la acción!",
              icon: 'success',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Si, actualiza los datos!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({    
                    url:"ajax/resolutores.ajax.php",
                    type:'POST',
                    data: {ActualizaidHotel:IdH,ActualizaNombre:valNombre,ActualizaZona:valUbicacion,ActualizaEmail:valEmail},
                    beforeSend:function(){},
                    success:function(respuesta){
                        
                        if (respuesta=="ok"){
                            Swal.fire('Los datos se actualizaron correctamente','','success')
                            $("#nombre").attr("readonly", true);
                            $("#email").attr("readonly", true);
                            $("#ubicacion").attr("disabled", true);
                            $("#guardaDatos").attr("disabled", true);
                            $("#cancelaDatos").attr("disabled", true);
                            $("#mnNombre").text($("#nombre").val());
                        }         
                    }
                });
                
                
            }
            else
            {
                cancela();
            }
        })

    }
}


function actualizaPass($IdHotel) {
    var IdH=$IdHotel;
    if($("#pwd").val()!=""){
        var pass1=$("#pwd").val();
    }
    

   if (IdH>0)
    { 

       Swal.fire({
              title: '¿Está seguro actualizar la contraseña?',
              text: "¡Si no lo está puede cancelar la acción!",
              icon: 'success',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Si',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({    
                    url:"ajax/resolutores.ajax.php",
                    type:'POST',
                    data: {ActPassIdHotel:IdH,ActPass:pass1},
                    beforeSend:function(){},
                    success:function(respuesta){
                        console.log(respuesta)
                        if (respuesta=="ok"){
                            Swal.fire('La contraseña se Actualizo','','success')
                           
                        }         
                    }
                });
                
                
            }
        })

    }
}