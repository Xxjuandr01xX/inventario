$(document).ready(function(){
	/**
	 * ARCHIVO PARA MANUPULACION E INTERACCIONES DEL
	 * SISTEMA DE LOGUEO DE USUARIOS.
	 */
	 
	 //validar url
	 
	 var q = $_GET('q');
	 
	 if(q == 'Home/Index'){
	 
		 var input-correo     = $("").val();
		 var input-contrasena = $("").val();
		 
		 $("#btn-submit").on('click',function(e){
			 e.preventDefault();
			 if(input-correo == "" || input-correo.length == 0){
				$("").val("");
				$("").focus();
				alert_top_warning("","ASEGURECE DE LLENAR EL CAMPO DE CORREO ELECTRONICO.")
			 }else if(input-contrasena == "" || input-contrasena.length == 0){
				$("").val("");
				$("").focus();
				alert_top_warning("","ASEGURECE DE LLENAR EL CAMPO DE CONTRASEÑA")
			 }else{
				var request = $.ajax({
									methos 		: 'POST',
									url    		: '',
									data        : {}
								});
				request.done(function(){});
			 }
		 });
	 }else{
		document.write = "OPERACION NULA";
	 }
});