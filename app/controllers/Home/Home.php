<?php
	class Home extends CortrollerBase{
		public function __construct(){
			parent::__construct();
			//session_start();
		}
		public function Index(){
            /**
              * METODO PARA LANZAR PAGINA INDEX.
              */
            return $this->render('login/login',["titulo" => "SISTEMA DE INVENTARIO."]);
		}
        public function verificar(){
            /**
              * METODO PARA VALIDAR EL ACCESO DE LOS USUARIOS AL SISTEMA
              */
            $resp     = "";
            $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
            foreach(getUsuario($username) as $usuarios){
                if($usuarios['user_name'] == $_POST['user'] && $usuarios['user_pass'] == $_POST['pass']){
                    session_start();
                    $_SESSION['user'] = $usuarios['user_name'];
                    $_SESSION['rol']  = $usuarios['id_rol_fk'];
                    $_SESSION['mail'] = $usuarios['user_mail'];
                    $resp = "1";
                }else{
                    $resp = "0";
                }
            }
            echo $resp;
        }
	}
?>