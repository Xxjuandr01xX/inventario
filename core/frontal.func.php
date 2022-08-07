<?php
	function validarControlador($controller_name){
		$src = CONTROLLER_PATH."{$controller_name}/".$controller_name.".php";
		$obj = null;
		if(!file_exists($src)){
			$src = CONTROLLER_PATH."/".DEFAULT_CONTROLLER."/".DEFAULT_CONTROLLER.".php";
		}
		require_once $src;
		$obj = new $controller_name();
		return $obj;
	}
	function validarAccion($objController,$accion_name){
		$resp = "";
		if (!method_exists($objController, $accion_name)){
			$resp = "0";
		}else{
			$resp = "1";
		}
		return $resp;
	}
	function lanzarAccion($objController,$accion_name){
		if($objController == null){
			echo "objeto NULL";
		}else{
			if(validarAccion($objController,$accion_name) == "0"){
				echo "metodo NULL";
			}else{
				$accion = $accion_name;
				$objController->$accion();
			}
		}
	}
?>