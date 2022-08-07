<?php
    function insertar_equipo($cod,$den,$mar,$mod,$cos,$iva,$pvp,$ex_min,$ex_max,$id_prov){
        $sql = "INSERT INTO inv_equipos VALUES(null,'$cod','$den','$cos',$iva,$pvp,$ex_min,$ex_max,0,$id_prov ,'$mar','$mod')";
        $exec = new Querys('inv_equipos');
        $resp = "";
        $query = $exec->get_db()->query($sql); 
        if(!$query){
            $resp = "0";
        }else{
            $resp = "1";
        }
        return $resp;
    }
    function verificar_equipo($cod){
        $sql   = "SELECT * FROM inv_equipos WHERE cod_equipo = '$cod'";
        $exec  = new Querys('inv_equipos');
        $resp  = "";
        $query = $exec->get_db()->query($sql);
        if($query->num_rows > 0){
            $resp = "1";
        }else{
            $resp = "0";
        }
        return $resp;
    }
    function get_equipos(){
        $exec = new Querys('inv_equipos');
        return $exec->getAll();
    }
    function getEquipoById($id){
        $exec = $exec = new Querys('inv_equipos');
        return $exec->getById($id);
    }
    function eliminarDelCatalogo($id){
        $sql  = "DELETE FROM inv_equipos WHERE id = '$id'";
        $exec = new Querys('inv_equipos');
        $res  = $exec->get_db()->query($sql);
        $resp = "";
        if (!$res) {
            $resp = "0";
        }else {
            $resp = "1";
        }
        return $resp;
    }
    function editarEquipo($id,$den,$mar,$mod,$cos,$iva,$pvp,$prov,$ex_min,$ex_max){
        $sql       =  "UPDATE inv_equipos SET denominacion = '$den', marcar = '$mar', modelo = '$mod', costo = $cos, iva = $iva, pvp = $pvp, id_proveedor_fk = $prov, existencia_minima = $ex_min, existencia_maxima = $ex_max WHERE id = $id";
        $exec      =  new Querys('inv_equipos');
        $actualizar_equipo = $exec->get_db()->query($sql);
        $resp      = "";
        if(!$actualizar_equipo){
            $resp      = "0";
        }else{
            $resp      = "1";
        }
        return $resp;
    }
    function guardarStock($id,$cantidad,$usuario){
        $date     = date("y-m-d");
        $sql_I    = "INSERT INTO inv_cargo_equipos VALUES (null,$usuario,'$id','$cantidad','$date')"; 
        $sql_II   = "SELECT cantidad FROM inv_equipos WHERE id = '$id'";
        $sql_III  = "UPDATE inv_equipos SET cantidad = ";
        $exec     = new Querys('inv_cargo_equipos');
        $resp     = "";
        $insertar_existencia   = $exec->get_db()->query($sql_I);
        if(!$insertar_existencia){
            $resp = "0";
        }else{
            $buscar_cantidad = $exec->get_db()->query($sql_II);
            while ($x = $buscar_cantidad->fetch_assoc()) {
                $cantidad_existente = $x['cantidad'];
            }
            $cantidad_total =  $cantidad_existente+$cantidad;
            $match          =  $cantidad_total." WHERE id = ".$id;
            $sql_III       .=  $match;
            $actualizar_existencia = $exec->get_db()->query($sql_III);
            if (!$actualizar_existencia) {
                $resp = "0";
            }else{
                $resp = "1";
            }
        }
        return $resp;
    }

    function getEquiposByCodigo($codigo){
        $exec = new Querys('inv_equipos');
        return $exec->getLikeColumn('cod_equipo',$codigo);
    }

    function setFactureCode(){
        $sql = "SELECT cod_fact FROM inv_facturas ORDER BY cod_fact DESC LIMIT 0,1";
        $exec = new Querys('inv_facturas');
        $sqlResult = $exec->get_db()->query($sql);
        $formato   = "00000000";
        $resp      = "";
        $ultimoCodigo = null;
        while ($x = $sqlResult->fetch_assoc()) {
            $ultimoCodigo = $x['cod_fact'];
        }
        $nuevoNumero = $ultimoCodigo+1;
        $longitud   = strlen($nuevoNumero);
        if($longitud > 1){
            $reFormat         = substr($formato,$longitud);
            $codigoDefinitivo = $reFormat.$nuevoNumero;
            $resp             = $codigoDefinitivo;
        }else if($longitud == 1){
            $reFormat         = substr($formato,1);
            $codigoDefinitivo = $reFormat.$nuevoNumero;
            $resp             = $codigoDefinitivo;
        }
        return $resp;
    }

    function crearFactura($codigo_factura,$cliente,$id_usuario){
        $exec = new Querys('inv_facturas');
        $date = date('yyyy-mm-dd');
        $resp = "";
        $res  = $exec->get_db()->query("INSERT INTO inv_facturas VALUES(null,'$codigo_factura',$cliente,$id_usuario,$date)");
        if(!$res){
            $resp = "0";
        }else{
            $resp = "1";
        }
        return $resp;
    }



    function detalleSalida($codigo_factura,$codigos,$cantidades,$precios_totales){
        $resp         = "";
        $exec         = new Querys('inv_salidas_equipos');
        for($i = 0;$i < count($codigos);$i++){
            $sql = "INSERT INTO inv_salida_equipos VALUES(null,'$codigos[$i]',$cantidades[$i],$precios_totales[$i],'$codigo_factura')";
            $res = $exec->get_db()->query($sql);
            if(!$res){
                $resp  = "0";
            }else{
                $resp  = "1";     
            }
        }
        return $resp;
    }

    function afectarExistencia($codigos_productos,$cantidad){
        $resp  = "";
        $exec  = new Querys('inv_equipos');
        
        $existencia = [];
        for ($i=0; $i < count($codigos_productos) ; $i++) { 
            $sql = "SELECT cantidad FROM inv_equipos WHERE cod_equipo = '$codigos_productos[$i]'";
            $res = $exec->get_db()->query($sql);
            while ($rows = $res->fetch_assoc()) {
                $existencia[$i] = $rows['cantidad']; 
            }
        }
        $cantidadCalculada = [];
        for ($j=0; $j < count($codigos_productos) ; $j++) {
            $cantidadCalculada[$j] = $existencia[$j]-$cantidad[$j];
            $sql_I = "UPDATE inv_equipos SET cantidad = $cantidadCalculada[$j] WHERE cod_equipo = '$codigos_productos[$j]'";
            $res_I = $exec->get_db()->query($sql_I);
            if(!$res_I){
                $resp = "0";
            }else{
                $resp = "1";
            }
        }
        return $resp;
    }

    function getFacturesByDate($inicio,$fin){
        $exec = new Querys('inv_facturas');
        $data = $exec->EjecutarSql("SELECT * FROM inv_facturas a INNER JOIN inv_salida_equipos b ON a.cod_fact=b.cod_factura  WHERE fecha_emision BETWEEN '$inicio' AND '$fin'");
        return $data;
    }
    function getNameEquipoByCod($cod){
        $exec = new Querys('inv_equipos');
        $data = NULL;
        foreach ($exec->getByColumn('cod_equipo',$cod) as $eq) {
            $data = $eq['denominacion']." - ".$eq['marcar']." - ".$eq["modelo"];
        }
        return $data;
    }

    function encabezadoFactura($id){
        $exec = new Querys('inv_facturas');
        return $exec->getById($id);
    }

    function desgloze($codigo_factura){
        $exec = new Querys('inv_salida_equipos');
        return $exec->getByColumn('cod_factura',$codigo_factura);
    }
?>