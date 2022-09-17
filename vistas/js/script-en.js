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

							The email already exists in the database, please enter a different one
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

				<div class="alert alert-danger">The image must be in JPG or PNG format!</div>
    		
    	`)

    	return;

    }else if(imagen["size"] > 2000000){

    	$("#logoHotel").val("");

    	$("#logoHotel").after(`

				<div class="alert alert-danger">The image must not be larger than 2MB!</div>
    		
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

                <div class="alert alert-danger">The image must be in JPG or PNG format!</div>
            
        `)

        return;

    }else if(imagen["size"] > 2000000){

        $("#logoHotelAct").val("");

        $("#logoHotelAct").after(`

                <div class="alert alert-danger">The image must not be larger than 2MB!</div>
            
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

				<div class="alert alert-danger">The image must be in JPG or PNG format!</div>
    		
    	`)

    	return;

    }else if(imagen["size"] > 2000000){

    	$("#fotoReso").val("");

    	$("#fotoReso").after(`

				<div class="alert alert-danger">The image must not be larger than 2MB!</div>
    		
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
              title: 'Are you sure you want to remove this contributor?',
              text: "If it is not, you can cancel the action!",
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Yes, remove the collaborator!',
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
                            
                            Swal.fire('The collaborator was deleted successfully','','success')
                                        return window.location.href = "enresolutor";
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
                window.location.href = "enresolutor";
                //table.ajax.reload();
            }else{
                console.log("campos vacios");
            }
        
            
        }
    }); return window.location.href = "enresolutor";
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
      title: 'Enter the East Room Number Qr',
      input: 'number',
      //inputValue: '',
      showCancelButton: true,
      inputAttributes: {
        autocapitalize: 'off',
        placeholder:'Indicate the room number',
        required: true
      },
      inputValidator: (value) => {
        if (!value) {
          return 'You need to add the room number!'
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
                    Swal.fire('has been updated successfully','','success');
                    return window.location.href = "enresolutor";
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
              title: 'Are you sure to Delete this Room?',
              text: "If it is not, you can cancel the action!",
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Yes, remove the Room!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({    
                    url:"ajax/resolutores.ajax.php",
                    type:'POST',
                    data: {idhbt:IdHabita},
                    beforeSend:function(){},
                    success:function(respuesta){
                        
                      //  if (respuesta=="ok"){
                            Swal.fire('The room was deleted successfully','','success')
                            return window.location.href = "enresolutor";
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
      var comentario="Please check these details: \n";
      var Err=0;
      if ($("#nombre").val()==""){
        comentario =comentario + "Name of the hotel. \n";
        Err++;
      }
      if ($("#email").val()==""){
        comentario =comentario + "Email. \n";
        Err++;
      }
      console.log(estados($("#ubicacion").val().toLowerCase()));
      if ($("#ubicacion").val()=="" || !estados($("#ubicacion").val().toLowerCase())){
        comentario =comentario + "The location of the hotel. \n";
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
      var comentario="Please check: \n";
      var Err=0;

      if ($("#pwd").val()==""){
        comentario =comentario + "The password I entered is not valid. \n";
        Err++;
      }else if ($("#pwd2").val()==""){
        comentario =comentario + "Confirm the new password. \n";
        Err++;
      }else if ($("#pwd").val()!=$("#pwd2").val()){
        comentario =comentario + "Passwords do not match. \n";
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
              title: 'Are you sure to update the data?',
              text: "If it is not, you can cancel the action!",
              icon: 'success',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Yes, update the data!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({    
                    url:"ajax/resolutores.ajax.php",
                    type:'POST',
                    data: {ActualizaidHotel:IdH,ActualizaNombre:valNombre,ActualizaZona:valUbicacion,ActualizaEmail:valEmail},
                    beforeSend:function(){},
                    success:function(respuesta){
                        
                        if (respuesta=="ok"){
                            Swal.fire('The data was updated successfully','','success')
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
              title: 'Are you sure to update the password?',
              text: "If it is not, you can cancel the action!",
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
                            Swal.fire('The password was updated','','success')
                           
                        }         
                    }
                });
                
                
            }
        })

    }
}