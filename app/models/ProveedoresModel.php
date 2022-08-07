<?php
    function get_proveedores(){
        $exec = new Querys('inv_proveedores');
        return $exec->getAll();
    }
    function deleteProveedor($id){
        $exec = new Querys('inv_proveedores');
        $res  = $exec->get_db()->query("DELETE FROM inv_proveedores WHERE id = $id");
        return $res;
    }
    function saveProveedores($nac,$rif,$den,$tel,$mail,$dir){
         $exec      = new Querys('inv_proveedores');
         $verificar = $exec->get_db()->query("SELECT * FROM inv_proveedores WHERE nombre LIKE '%$den%'");
         if($verificar){
             $res = 'duplicate';
         }else{
            $res = $exec->get_db()->query("INSERT INTO inv_proveedores VALUES(null,'$nac','$rif','$den','$tel','$mail','$dir')");    
         }
         
        return $res;
    }
    function get_proveedorById($cod){
        $exec = new Querys('inv_proveedores');
        $data = null;
        foreach ($exec->getById($cod) as $nacionalidad) {
            $data = $nacionalidad;
        }
        return $data;
    }

    function updateProveedor($id,$nac,$den,$rif,$tel,$mail,$dir){
        $exec = new Querys('inv_proveedores');
        return $exec->get_db()->query("UPDATE inv_proveedores SET nombre = '$den', rif = '$rif', telefono = '$tel', correo = '$mail', direccion = '$dir', id_nacionalidad_fk = '$nac' WHERE id = '$id'");
    }

    function getNameProveedor($id_proveedor){
        $exec   = new Querys('inv_proveedores');
        $nombre = "";
        foreach ($exec->getById($id_proveedor) as $proveedor) {
            $nombre = $proveedor['nombre'];
        }
        return $nombre;
    }
?>