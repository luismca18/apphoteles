<?php
	class Router {
		public $route;
		public function __construct($route){
			
			$session_options=array(
					'use_only_cookies'=>1,
					//'auto_start'=>1,
					'read_and_close'=>true
				);
				$login_form=new ViewController();
			if(!isset($_SESSION)) {
				session_start($session_options);
	     	}
			if(!isset($_SESSION['ok'])) $_SESSION['ok']=false;
			if($_SESSION['ok']==true){
				if($route=='inicio') $login_form->load_view('inicio');
				elseif($route=='tareas') $login_form->load_view('tareas');
				elseif($route=='salir') $login_form->load_view('salir');
				elseif($route=='resolutor') $login_form->load_view('resolutor');
				elseif($route=='solicitudes') $login_form->load_view('solicitudes');
				elseif($route=='dashboard') $login_form->load_view('dashboard');
				elseif ($route=='ingreso') $login_form->load_view('ingreso');
				elseif ($route=='soporte') $login_form->load_view('soporte');
				elseif ($route=='huesped') $login_form->load_view('huesped');
				elseif($route=='eninicio') $login_form->load_view('eninicio');
				elseif($route=='entareas') $login_form->load_view('entareas');
				elseif($route=='ensalir') $login_form->load_view('ensalir');
				elseif($route=='enresolutor') $login_form->load_view('enresolutor');
				elseif($route=='ensolicitudes') $login_form->load_view('ensolicitudes');
				elseif($route=='endashboard') $login_form->load_view('endashboard');
				elseif ($route=='eningreso') $login_form->load_view('eningreso');
				elseif ($route=='ensoporte') $login_form->load_view('ensoporte');
				elseif ($route=='enhuesped') $login_form->load_view('enhuesped');
				elseif($route=='enregistro') $login_form->load_view('enregistro');
				else {
					if($route=='registro') $login_form->load_view('registro');
					else
					{ 
						$login_form=new ViewController();
						$login_form->load_view('registro');
					}
				}
					
				

			}else{
				if($route=='ingreso') {
					$login_form=new ViewController();
					$login_form->load_view('ingreso');
				 }
				elseif ($route=='newpass')
				{ 
				    $login_form->load_view('newpass');
				}
				elseif ($route=='recuperacion')
				{ 
				    $login_form->load_view('recuperacion');
				}				
				elseif($route=='eningreso') {
					$login_form=new ViewController();
					$login_form->load_view('eningreso');
				 }
				elseif ($route=='ennewpass')
				{ 
				    $login_form->load_view('ennewpass');
				}
				elseif ($route=='enrecuperacion')
				{ 
				    $login_form->load_view('enrecuperacion');
				}				
				elseif ($route=='enregistro')
				{ 
					$login_form=new ViewController();
					$login_form->load_view('enregistro');
				}
				else
				{ 
					$login_form=new ViewController();
					$login_form->load_view('registro');
				}
			}
		}

		public function __destruct(){
			//unset($this);
		}
	}