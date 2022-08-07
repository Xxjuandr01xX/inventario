<?php
	class CortrollerBase{
		public function __construct(){
			require_once "core/library.php";
			foreach(glob('app/models/*.php') as $modelo){
                require_once $modelo;
            }
		}
		public function render($view,$data){
            //$helper = new Helper();
			foreach($data as $id_assoc => $value){
                ${$id_assoc} = $value;
            }
            require_once "app/views/".$view.".php";
		}
	}
?>