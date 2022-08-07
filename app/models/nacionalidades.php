<?php
    function get_nacionalidades(){
        $nacionalidades = new Querys('inv_nacionalidades');
        return $nacionalidades->getAll();
    }

    function get_nacionalidadById($id){
        $nacionalidades = new Querys('inv_nacionalidades');
        $descripcion    = "";
        foreach ($nacionalidades->getById($id) as $nac) {
            $descripcion    = $nac['desc_nac'];
        }
        return $descripcion;
    }

    function getNacionalidadById($id){
        $exec = new Querys('inv_nacionalidades');
        return $exec->getById($id);
    }

    function newPaises($cod_tel,$des_nac,$tip_doc){
        $exec = new Querys('inv_nacionalidades');
        $res  = $exec->get_db()->query("INSERT INTO inv_nacionalidades VALUES(null,'$cod_tel','$tip_doc','$des_nac')"); 
        $resp = "";
        if(!$res){
            $resp =  "0";
        }else{
            $resp =  "1";
        }
        return $resp;
    }

    function actualizarNacionalidades($id,$cod_tel,$des_nac,$tip_doc){
        $exec = new Querys('inv_nacionalidades');
        $res  = $exec->get_db()->query("UPDATE inv_nacionalidades SET cod_nac = '$cod_tel', tipo_doc = '$tip_doc', desc_nac = '$des_nac' WHERE id = '$id'"); 
        $resp = "";
        if(!$res){
            $resp =  "0";
        }else{
            $resp =  "1";
        }
        return $resp;
    }

    function eliminarNacionalidad($id){
        $exec = new Querys('inv_nacionalidades');
        $res  = $exec->get_db()->query("DELETE FROM inv_nacionalidades WHERE id = '$id'"); 
        $resp = "";
        if(!$res){
            $resp =  "0";
        }else{
            $resp =  "1";
        }
        return $resp;
    }
?>