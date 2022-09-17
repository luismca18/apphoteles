const formulario=document.getElementById('formulario');
const inputs =document.querySelectorAll('#formulario input');


const expresiones={
	password:/^.{4,8}$/,

}

const campos={
	password:false
}

const validarFormulario = (e) => {
	//console.log(document.querySelector('#grupo__nombre i').classList);
	switch(e.target.name){
		case "newPass":
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


inputs.forEach((input)=>{
	input.addEventListener('keyup',validarFormulario);
	input.addEventListener('blur',validarFormulario);
});

formulario.addEventListener('submit',(e) => {
	
	if (campos.password){
		
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

