<?php
	////////////EXTERNAL_LIBRARY/////////////////////////////////
	define("LIBRARY_PATH",[
		"Smarty"     => "core/library/Smarty/Smarty.class.php",
		"Fpdf"       => "core/library/fpdf/fpdf.php",
		"PhpMailer"  => "core/library/phpmailer/src/PHPMailer.php",
		"PhpQrcode"  => "core/library/phpqrcode/phpqrcode.php",
		"PhpExcel"   => "core/library/SED-master/SED-master/SED.php"
	]);
	////////////REQUEST////////////////////////////////

	define("URI", $_SERVER["REQUEST_URI"]);

	define("DEFAULT_CONTROLLER","Home");

	define("DEFAULT_ACCION","Index");

	define("REQUEST_METHOD", $_SERVER["REQUEST_METHOD"]);

	/////////////RUTAS DE LA APLICACION/////////////////

	define("VIEWS_PATH","app/views/");

	define("CONTROLLER_PATH","app/controllers/");

	define("MODELS_PATH","app/controllers/");


?>