<?php
    function __Active($opciones){
      /**
        * FUNCION PARA VALIDAR OPCIONES DE MENUS.
        */
      $url_var = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
      foreach($opciones as $op){
        if($op == $url_var){
          echo "active";
        }
      }
    }
    /**
      * CONSTANTES PARA FUNCIONES DE ENCRYPTACION Y DESEMCRYPTACION.
      */
    function __Option($arr,$position){
      /**
        * FUNCION PARA REDIRECCIONAR PAGINAS SEGUN LAS OPCIONES.
        */
      echo "?q=".$arr[$position];
    }
    function dateToLabel($date){
      /**
        * 
        */
        $sep = explode($date, '-');
        return $sep[3].'/'.$sep[2].'/'.$sep[1];
    }
    function labelToDate($date){
      /**
        * 
        */
        $sep = explode($date, '/');
        return $sep[3].'-'.$sep[2].'-'.$sep[1];
    }
    function encrypt($string) {
	    $key='./1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	    $result = '';
	    for($i=0; $i<strlen($string); $i++) {
  			$char = substr($string, $i, 1);
  			$keychar = substr($key, ($i % strlen($key))-1, 1);
  			$char = chr(ord($char)+ord($keychar));
  			$result.=$char;
	    }
	    return base64_encode($result);
	}

	function decrypt($string) {
		$key='./1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
			$char  = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
  
  function __BtnAlert($color,$mensaje){
    /**
     * Funcion para crear botones de alerta
     * @param $color primary,success,danger,warning,info,secondary
     * @param $mensaje mensaje a ostrar en el boton. 
     */
    return '<button class = "btn p-5 btn-'.$color.' btn-lg" style = "width:100%;">'.$mensaje.'</button>';
  }

  function __Input($id,$type,$icon,$pholder){
    return '<div class = "input-group">'.
             '<label class = "input-group-text rounded-0"><span class = "bi-'.$icon.'"></span></label>'.
             '<input type = "'.$type.'" class = "form-control rounded-0" id = "'.$id.'" placeholder = "'.$pholder.'">'.
           '</div>'.
        '</br>';
  }

  function __Btn($color,$msg,$id){
    return '<button style = "width:100%;" class = "rounded-0 btn btn-'.$color.'" id = "'.$id.'">'.$msg.'</button>';
  }

  function __select($id,$icon,$arr,$text){
    $html = '<div class = "input-group">'.
                '<label  class = "input-group-text"><span class = "bi-'.$icon.'"></span></label>'.
                '<select class = "form-control rounded-0" id = "'.$id.'">'.
                  '<option value = "0"> -- SELECCIONE -- </option>';
    foreach ($arr as $opt) {
      $html .= '<option value = "'.$opt['id'].'">'.$opt[$text].'</option>';
    }
    $html .= '</select></div>';
    return $html;
  }
  function __TextArea($id,$icon,$placeholder){
    return '<div class = "input-group">'.
              '<label class = "input-group-text"><span class = "bi-'.$icon.'"></span></label>'.
              '<textArea class = "form-control" cols = "3" rows = "3" id = "'.$id.'" placeholder = "'.$placeholder.'"></textArea>'.
            '</div>';
  }
  function __TableInit($id,$bg,$text,$columns){
   $inicio = '<table class = "table table-hover table-responsive table-stripped rounded-0" id = "'.$id.'">';
   $header = '<thead class = "bg-'.$bg.' text-center text-'.$text.'"><tr>';
   for($x = 0;$x < count($columns);$x++){
     $header .= '<td>'.$columns[$x].'</td>';
   }
   $header .= '</tr></thead>';
   return $inicio.$header;
  }
  function __Tclose(){
    return '</tbody></table>';
  }
?>