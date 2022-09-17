

/*
init();

function init(){
	getData();
}

function getData(){
		table=$("#example1").DataTable({
		pageLength:10,
		responsive:true,
		processing:true,
		ajax:"ajax/solicitudes.ajax.php"
	});
}
*/



$("#guardacoment").click(function(event) {
  if ($("#idStatus").val()==1 || $("#idStatus").val()==3){
	var comentarioCierre=$("#comentrioR").val();
	var solicitudId=$("#idsol").val();
	var Idstatus=$("#idStatus").val();



		$.ajax({	
    	url:"ajax/solicitudes.ajax.php",
		type:'POST',
		data: {solicitud:solicitudId, status: Idstatus, comenta: comentarioCierre},
		beforeSend:function(){},
		dataType: "json",
		success:function(respuesta){
			console.log(respuesta);
		}
	});
}
})



$("#IdSolicitudRes").click(function(event) {
  	var href= $(this).attr('href');
  	var idh=href.substr(href.indexOf(".")+1,href.length-href.indexOf("."));
  	href=href.substr(0,href.indexOf("."))
  	//console.log(href);
   	$("#idH").val(href);
   	
	$.ajax({

    	url:"ajax/solicitudes.ajax.php",
		type:'POST',
		data: {solicitud_id:href },
		beforeSend:function(){},
		dataType: "json",
		success:function(respuesta){
			var data=$.parseJSON(respuesta);
			//console.log(respuesta);
			//console.log(href);
			 if(data.length>0)
			{
				$('#SelectResolutor').val(data[0]['idresolutor']);
			}
		
		}
	});
	
})


function ValorStatus($Idsoli,$sts) {

	if ($sts==2)
	{ 
		const { value: ComResolutor } = Swal.fire({
		  title: '¿Esta solicitud fue atendida correctamente?',
		  text: "¡Si no se atendió puede cancelar la acción!",
		  input: 'text',
		  icon: 'success',
		  //inputValue: '',
		  showCancelButton: true,
		  inputAttributes: {
		    autocapitalize: 'off',
		    placeholder:'Por favor, ingrese como se resolvió la solicitud',
		    maxLength:70,
		    required: true
		  },
		  inputValidator: (value) => {
		    if (!value) {
		      return '¡Necesita agregar un comentario!'
		    }
		    else
		    {
				
				var $comentario=value;
				//console.log($comentario);
	  			$.ajax({	
			    	url:"ajax/solicitudes.ajax.php",
					type:'POST',
					data: {solicitud:$Idsoli, status: $sts, comenta: $comentario},
					beforeSend:function(){},
					dataType: "json",
					success:function(respuesta){
						
						Swal.fire('La solicitud se atendió correctamente','','success')
					}
				});
		    }
		  }
		})
		
		 
	}
	else
	{
		
		const { value: ComResolutor } = Swal.fire({
		  title: '¿Está seguro de cancelar esta solicitud?',
		  text: "¡Si no lo está puede cancelar la acción!",
		  input: 'text',
		  icon: 'error',
		  //inputValue: '',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'No',
		  confirmButtonText: 'Si, cancela la solicitud',
		  inputAttributes: {
		    autocapitalize: 'off',
		    placeholder:'Por favor, ingrese como se resolvió la solicitud',
		    maxLength:70,
		    required: true
		  },
		  inputValidator: (value) => {
		    if (!value) {
		      return 'Necesita agregar un comentario!'
		    }
		    else
		    {
				
				var $comentario=value;
				//console.log($comentario);
	  			$.ajax({	
			    	url:"ajax/solicitudes.ajax.php",
					type:'POST',
					data: {solicitud:$Idsoli, status: $sts, comenta: $comentario},
					beforeSend:function(){},
					dataType: "json",
					success:function(respuesta){
						Swal.fire('La solicitud fue cancelada','','error')
						//Swal.fire('Solicitud Atendida correctamente','','success')
					}
				});
		    }
		  }
		})

 	}
}


function vresolutor($Idsoli) {
    var valor =$Idsoli;
  	//var href= $(this).attr('href');
  	//var idh=href.substr(href.indexOf(".")+1,href.length-href.indexOf("."));
  	//href=href.substr(0,href.indexOf("."))
  	//console.log(href);
   
   	$("#idSV").val(valor);
   	

}


function ActualizaResolutor()
{
	
	id=$('#SelectResolutor').val();
	var idSol =$("#idSV").val()
	parametros={"idsol":idSol,"idActualizaRes":id}
        
	$.ajax({

    	url:"ajax/solicitudes.ajax.php",
		type:'POST',
		data:parametros,
		beforeSend:function(){},
		success:function(respuesta){
			//console.log(respuesta);
			//console.log(id);
			//console.log(idSol);
			if(respuesta=="ok"){
				//window.location.href = "solicitudes";
				//table.ajax.reload();
				Actualiza=true;

			}else{
				console.log("campos vacios");
				//console.log(id);
				//console.log(idSol);

			}
		
			
		}
	});
	
}



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
				
				$('#folioHtl').val(data[0]['folioHotel']);
				$('#comentrioHI').val(data[0]['descripcionsolicitud']);
                $('#comentrioHF').val(data[0]['comentariosolicitud']);
                $('#comentrioR').val(data[0]['comentarioresolutor']);
                $('#idStatus').val(data[0]['statussolicitud']);
                $('#idsol').val($solicitud_id);
                var estrellas=data[0]['valoracionsolicitud'];
                //estrellas.substr(0,1);
                document.getElementById('S1').style.display="none";
                document.getElementById('S2').style.display="none";
                document.getElementById('S3').style.display="none";
                document.getElementById('S4').style.display="none";
                document.getElementById('S5').style.display="none";
                var valEstrella =parseInt(estrellas.substr(0,1));
            	//console.log (valEstrella);
                switch (valEstrella)
                {  
                	case 1:
                	    document.getElementById('S1').style.display="inline";
		                document.getElementById('S2').style.display="none";
		                document.getElementById('S3').style.display="none";
		                document.getElementById('S4').style.display="none";
		                document.getElementById('S5').style.display="none";
                	break;
                	case 2:
                	    document.getElementById('S1').style.display="inline";
		                document.getElementById('S2').style.display="inline";
		                document.getElementById('S3').style.display="none";
		                document.getElementById('S4').style.display="none";
		                document.getElementById('S5').style.display="none";                	
                	break;
                	case 3:
                	    document.getElementById('S1').style.display="inline";
		                document.getElementById('S2').style.display="inline";
		                document.getElementById('S3').style.display="inline";
		                document.getElementById('S4').style.display="none";
		                document.getElementById('S5').style.display="none";
		                break;
                	case 4:                	    
                		document.getElementById('S1').style.display="inline";
		                document.getElementById('S2').style.display="inline";
		                document.getElementById('S3').style.display="inline";
		                document.getElementById('S4').style.display="inline";
		                document.getElementById('S5').style.display="none";                	
                	break;
                	case 5:
                	    document.getElementById('S1').style.display="inline";
		                document.getElementById('S2').style.display="inline";
		                document.getElementById('S3').style.display="inline";
		                document.getElementById('S4').style.display="inline";
		                document.getElementById('S5').style.display="inline";               	
                	break;
                }
                $('#valsol').val(data[0]['valoracionsolicitud']);
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
                $('#amaternoRes').val(data[0]['apellidoMresolutor']);
                if (data[0]['fotoresolutor']!=''){
                	rutaImagen=UrlFoto+data[0]['fotoresolutor'];
                }else{
					rutaImagen=UrlFoto+ "default.png";
                } 
                $(".prevfotoReso").attr("src", rutaImagen);
			}
		}
	});
}

function EnviaResolutorId($resolutor_id){
		$('#idElimina').val($resolutor_id);
}
//EnviaResolutorId
function EliminaResolutorId()
{
	//var URLactual = window.location.href;
	//var UrlFoto=URLactual.replace('resolutor','vistas/img/usuarios/resolutores/');
	$id=$('#idElimina').val();
	$.ajax({
    	url:"ajax/resolutores.ajax.php",
		type:'POST',
		data: {Eliminarid:$id },
		beforeSend:function(){},
		success:function(respuesta){
			//console.log(respuesta);
			//console.log($id);
			if(respuesta=="ok")
			{
				//console.log(respuesta);
				return window.location.href = "resolutor";
			}
		}
	});
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

/*	id=$('#IdReso').val();
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
			//console.log(respuesta);
			if(respuesta=="ok"){
				window.location.href = "resolutor";
				//table.ajax.reload();
			}else{
				console.log("campos vacios");
			}
		
			
		}
	}); return window.location.href = "resolutor";
}


