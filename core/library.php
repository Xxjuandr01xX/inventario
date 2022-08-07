<?php
	class Library{
		private $lib;
		public function __construct($library_name){
			/**
			 * Constructor de la clase para gestionar
			 * librerias externas.
			 */
			$this->lib = (String) $library_name;
		}
		public function set_validate_library(){
			/**
			 * Metodo para validar existencia de librerias
			 * externas
			 */
			$resp = false;
			foreach (LIBRARY_PATH as $name => $dir) {
				if($name == $tnis->lib){
					$resp = true;
				}else{
					$resp = false;
				}
			}
			return $resp;
		}
		public function __Load(){
			/**
			 * Metodo para cargar librerias externas
			 */
			$obj = null;
			if($this->set_validate_library() == true){
				foreach (LIBRARY_PATH as $name => $dir) {
					require_once $dir;
					$obj = new $name();
				}
			}else{
				$obj = "NULL LIBRARY";
			}
			return $obj;
		}
	}
?>