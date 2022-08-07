<?php
	require_once "global/global.php";
	require_once "core/conexion.php";
	require_once "core/session.php";
	require_once "core/querys.class.php";
	require_once "core/library.php";
	require_once "core/controllerBase.php";
	require_once "core/frontal.func.php";
    require_once "core/funciones.php";
	
	//error_reporting(0);
	if (!isset($_GET['q']) || empty($_GET['q'])) {
		/**
		 * Inicializar Url
		 */
		header("Location:?q=".DEFAULT_CONTROLLER."/".DEFAULT_ACCION);
	}else{
		/**
		 * Crear objeto y lanzar controladores y metodos.
		 */
		$q    		   = $_GET['q'];
		$qArr 		   = explode("/", $q);
		$contolador    = $qArr[0];
		$method        = $qArr[1];
		$objController = validarControlador($contolador);
		lanzarAccion($objController,$method);
	}
	
?>