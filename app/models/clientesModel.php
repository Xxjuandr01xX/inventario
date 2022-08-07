<?php
    function __TablaClientes(){
        /**
         * 
         */
        $exec = new Querys('inv_clientes');
        return $exec->EjecutarSql('SELECT a.id,a.nombre,a.apellido, a.dni_nro,a.telefono,a.correo,b.desc_nac,a.direccion FROM inv_clientes a INNER JOIN inv_nacionalidades b ON a.id_nacionalidad_fk = b.id');
    }
    function clienteById($id){
        $exec = new Querys('inv_clientes');
        return $exec->getById($id);
    }
    function delete_cliente($id){
        $exec = new Querys('inv_clientes');
        $result = $exec->get_db()->query("DELETE FROM inv_clientes WHERE id = ".$id);
        return $result;
    }

    function saveCliente($dni,$nac,$nombre,$apellido,$telefono,$correo,$direccion){
        $exec = new Querys('inv_clientes');
        $verify = new Querys('inv_clientes');
        $cliente_old = $verify->getById($id);
        if($cliente_old[0]['dni_nro'] != $dni){
            $result = $exec->get_db()->query("INSERT INTO inv_clientes VALUES(null,'$nac','$dni','$nombre','$apellido','$telefono','$correo','$direccion')");
            return $result;
        }else{
            return NULL;
        }
    }
    function updateCliente($id,$nac,$nombre,$apellido,$telefono,$correo,$direccion){
        $exec = new Querys('inv_clientes');
        $result = $exec->get_db()->query("UPDATE inv_clientes SET id_nacionalidad_fk = $nac, nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', correo = '$correo', direccion = '$direccion' WHERE id = '$id'");
        return $result;
    }

    function getClientes(){
        $exec = new Querys('inv_clientes');
        return $exec->getAll();
    }
    function getIdclienteByDni($dni){
        $exec    = new Querys('inv_clientes');
        $cliente = null;
        foreach ($exec->getByColumn('dni_nro',$dni) as $cli) {
            $cliente = $cli['id'];
        }
        return $cliente;
    }

    function getDniClienteById($id){
        $exec    = new Querys('inv_clientes');
        $cliente = null;
        foreach ($exec->getById($id) as $cli) {
            $cliente = $cli['dni_nro'];
        }
        return $cliente;
    }
    function getClientNameById($id){
        $exec = new Querys('inv_clientes');
        $nombre = null;
        foreach ($exec->getById($id) as $data) {
            $nombre = $data['nombre']." ".$data["apellido"];
        }
        return $nombre;
    }
?>