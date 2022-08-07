<?php
	class Dashboard extends CortrollerBase{
		function __construct(){
			parent::__construct();
			session_start();
		}
		public function Index(){
            /**
              * METODO PARA LANZAR PAGINA INDEX.
              */
			$this->render('Dashboard/main',["mensaje" => "Pagina Principal"]);
		}

	}
?>