function $_GET(NAME_GET) {
	var loc = document.location.href;
	var posicionVars = 0;
	
	for (var i = 0; i < loc.length; i++) {
		if (loc.charAt(i) == '?') {
			posicionVars = i;//CAPTURAMOS LA POSICION DEL '?'
			break;
		} else {
			var lastLoc = loc.length - 1;
	        if (lastLoc == i) {
	          return null;
	        }
		}
		//alert(a.charAt(i));
		//alert(a.indexOf('s'));
	}

	if (posicionVars==0) {
		return null;
	} else {
		var afterDir = "";
		posicionVars++;//INCREMENTAMOS +1 PARA EXCLUIR EL '?'
		for (var i = posicionVars; i < loc.length; i++) {
			afterDir+=loc.charAt(i);
		}

		var _GETS = afterDir.split('&');//SEPARAMOS POR VARIABLE CON SU VALOR

		for (var i = 0; i < _GETS.length; i++) {
			var tmp = _GETS[i];
			var arr = tmp.split('=')[0];//SEPARAMOS PERO SOLO PARA EXTRAER EL NOMBRE DE VARIABLE
			
			if (arr==NAME_GET) {//BUSCAMOS EL NOMBRE DE VARIABLE SOLICITADO
				return tmp.replace(NAME_GET+"=","");
				break;
			} else {
				var last = _GETS.length - 1;
		        if (last == i) {
		          return null;
		        }
			}
		}
	}
}

function alert_top_primary(id,mensaje){
	$("#" + id).html(
		'<div class="alert alert-primary " role="alert">' +
		mensaje +
		'</div>'
	).slideDown(1500);
}

function alert_top_warning(id,mensaje){
	$("#" + id).html(
		'<div class="alert alert-warning " role="alert">' +
		mensaje +
		'</div>'
	).slideDown(1500);
}

function alert_top_danger(id,mensaje){
	$("#" + id).html(
		'<div class="alert alert-danger " role="alert">' +
		mensaje +
		'</div>'
	).slideDown(1500);		
}


function alert_top_success(id,mensaje){
	$("#" + id).html(
		'<div class="alert alert-success " role="alert">' +
		mensaje +
		'</div>'
	).slideDown(1500);
}

function alert_top_info(id,mensaje){
	$("#" + id).html(
		'<div class="alert alert-info alert-sm " role="alert">' +
		mensaje +
		'</div>'
	).slideDown(1500);
}

function set_dataTable(id,options){
	$("#"+id).dataTable(options);
}

function set_date_picker(id){
	$("#"+id).datepicker({
		"format" : "dd/mm/yyyy"
	});
}

function create_carrousel(id,options){
	
}

function __Url(section,page){
	window.location.href = "?q="+section+"/"+page;
}

function set_input_mask(idInput,mascara){
	$("#"+idInput).Inputmask({
		"mask" : mascara
	})
}