const formulario=document.getElementById('formulario');
const inputs =document.querySelectorAll('#formulario input');


const expresiones={
	nombre:/^[a-zA-Z0-9Á-ÿ\s]{4,50}$/,
	ubicacion:/^[a-zA-ZÁ-ÿ\s]{8,100}$/,
	password:/^.{4,8}$/,
	correo:/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,4})$/
	//correo:/^v+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
	///^[a-zA-ZÁ-ÿ\s]{8,100}$/,
}

const campos={
	nombre: false,
	email:false,
	ubicacion:false,
	password:false
	
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
        default:
        /*
        	if (ubicacion =='yucatan'||ubicacion =='ciudad de mexico'||ubicacion =='michoacan'||ubicacion =='nuevo leon'||ubicacion =='queretaro'||ubicacion =='san luis potosi'){
        		return true;	
        	}else{
        		return false;	
        	}
        	*/
        	return false;

	}
}

const validarFormulario = (e) => {
	//console.log(document.querySelector('#grupo__nombre i').classList);
	switch(e.target.name){
		case "registroNombre":
			validarCampo(expresiones.nombre,e.target,'nombre');	
		break;
		case "registroEmail":
			validarCampo(expresiones.correo,e.target,'email');
		break;
		case "registroZona":
			validarCampoU(expresiones.ubicacion,e.target,'ubicacion');
		break;
		case "registroPassword":
			validarCampo(expresiones.password,e.target,'password');
			validarPassword2();
		break;		
		case "registroPassword2":
			validarPassword2();
		break;					
	}
	
}


const validarPassword2 = () => {
		const inputPassword1=document.getElementById('pwd');
		const inputPassword2=document.getElementById('pwd2');
			if (inputPassword1.value!==inputPassword2.value){
				document.getElementById('grupo__password2').classList.add('formulario__grupo-incorrecto');
				document.getElementById('grupo__password2').classList.remove('formulario__grupo-correcto');
				document.getElementById('ipassword2').classList.add('fa-times-circle');
				document.getElementById('ipassword2').classList.remove('fa-check-circle');
				document.querySelector('#grupo__password2 .formulario__input-error').classList.add('formulario__input-error-activo');
				campos['password']=false;
			}else{
				document.getElementById('grupo__password2').classList.remove('formulario__grupo-incorrecto');
				document.getElementById('grupo__password2').classList.add('formulario__grupo-correcto');
				document.getElementById('ipassword2').classList.remove('fa-times-circle');
				document.getElementById('ipassword2').classList.add('fa-check-circle');
				document.querySelector('#grupo__password2 .formulario__input-error').classList.remove('formulario__input-error-activo');
				campos['password']=true;
			}
}
const validarCampo = (expresion,input,campo) => {
			if (expresion.test(input.value)){
				
				document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
				document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
				document.getElementById(`i${campo}`).classList.remove('fa-times-circle');
				document.getElementById(`i${campo}`).classList.add('fa-check-circle');
				document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
				campos[campo]=true;
			}else{

				document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
				document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
				document.getElementById(`i${campo}`).classList.remove('fa-check-circle');
				document.getElementById(`i${campo}`).classList.add('fa-times-circle');
				document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');				
				campos[campo]=false;
			}
		

}
const validarCampoU = (expresion,input,campo) => {
			if (estados(input.value.toLowerCase())) {
				
				document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
				document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
				document.getElementById(`i${campo}`).classList.remove('fa-times-circle');
				document.getElementById(`i${campo}`).classList.add('fa-check-circle');
				document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
				campos[campo]=true;
			}else{

				document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
				document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
				document.getElementById(`i${campo}`).classList.remove('fa-check-circle');
				document.getElementById(`i${campo}`).classList.add('fa-times-circle');
				document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');				
				campos[campo]=false;
			}
		

}
inputs.forEach((input)=>{
	input.addEventListener('keyup',validarFormulario);
	input.addEventListener('blur',validarFormulario);
});

formulario.addEventListener('submit',(e) => {
	
	if (campos.nombre&&campos.email&&campos.password){
		
		document.getElementById('formulario__mensaje-exito'.classList.add('formulario__mensaje-exito-activo'));
		setTimeout(()=>{
			document.getElementById('formulario__mensaje-exito'.classList.remove('formulario__mensaje-exito-activo'));
		},5000);
		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono)=>{
			icono.classList.remove('formulario__grupo-correcto');
		});
		formulario.reset();
	}else{
		e.preventDefault();
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(()=>{
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		},5000);

	}
});

