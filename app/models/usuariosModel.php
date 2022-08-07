<?php

	function getUsuario($usuario){
        $consulta =  new Querys("inv_usuarios");
        return $consulta->getLikeColumn("user_name",$usuario);
	}
    
    function perfilUsuarioById($id){
        $consulta = new Querys("aln_perfil");
        return $consulta->getByid($id);
    }

    function getRolUsers(){
        $exec = new Querys('inv_rol');
        return $exec->getAll();
    }

    function getIdByUsername($username){
        $exec = new Querys('inv_usuarios');
        $id  = null;
        foreach ($exec->getLikeColumn('user_name',trim($username)) as $x){
            $id = $x['id'];
        }
        return $id;
    }
    function getUserNameById($id){
        $exec = new Querys('inv_usuarios');
        $username = null;
        foreach($exec->getById($id) as $data){
            $username = $data['user_name'];
        }
        return $username;
    }

    function getusuariosForTickets(){
        $exec = new Querys('inv_usuarios');
        $res  = $exec->get_db()->query("SELECT a.id,a.user_name,a.user_mail,b.rol_desc FROM inv_usuarios a INNER JOIN inv_rol b ON a.id_rol_fk = b.id WHERE b.id IN('1','2')");
        $resultSet = [];
        while ($x = $res->fetch_assoc()) {
            $resultSet[] = $x;
        }
        return $resultSet;
    }

    function rolIdByUserId($id_usuario){
        $exec = new Querys('inv_usuarios');
        $rolUser = null;
        foreach($exec->getById($id_usuario) as $user){
            $rolUser = $user['id_rol_fk'];
        }
        return $rolUser;
    }

    function getAllUsers(){
        $exec = new Querys('inv_usuarios');
        return $exec->getAll();
    }

    function getRolById($id){
      $exec = new Querys('inv_rol');
      $rolDesc  = null;
      foreach($exec->getById($id) as $rol){
          $rolDesc = $rol['rol_desc'];
      }
      return $rolDesc; 
    }

    function setUsuariosAcciones($id){
         $exec     = new Querys('inv_usuarios');
         $acciones = "";
         foreach($exec->getById($id) as $user){
             if($user['id'] == 1){
                 $acciones = '<button class = "btn btn-ligth btn-sm rounden-0">BLOQUEADO</button>';
             }else{
                 $acciones = '<div class = "btn-group">'.
                                '<button class = "btn btn-warning btn-sm" onclick = "modalEdit('.$user['id'].');"><span class = "bi-pencil-fill"></span></button>'.
                                '<button class = "btn btn-danger btn-sm" onclick = "deleteUser('.$user['id'].');"><span class = "bi-trash"></span></button>'.
                            '</div>';
             }
         }
         return $acciones;
    }

    function createNewUser($username,$userpass,$usermail,$userrol){
        $sql  = "INSERT INTO inv_usuarios VALUES(null,'$username','$userpass',$userrol,'$usermail')";
        $exec = new Querys('inv_usuarios');
        $res  = $exec->get_db()->query($sql);
        $resp = "";
        if(!$res){
            $resp = "0";
        }else{
            $resp = "1";
        }
        return $resp;
    }

    function deleteUser($id){
        $sql  = "DELETE FROM inv_usuarios WHERE id = '$id'";
        $exec = new Querys('inv_usuarios');
        $res  = $exec->get_db()->query($sql);
        $resp = "";
        if(!$res){
            $resp = "0";
        }else{
            $resp = "1";
        }
        return $resp;
    }

    function getUsuarioById($id){
        $exec = new Querys('inv_usuarios');
        return $exec->getById($id);
    }

    function setRolSelectByUser(){
        $exec = new Querys('inv_rol');
        $resp = '<select class = "form-control rounded-0" id = "rol-select">';
        foreach($exec->getAll() as $usr){
            $resp .= '<option value = "'.$usr['id'].'">'.$usr['rol_desc'].'</option>';
        }
        $resp .= '</select>';
        return $resp;
    }

    function ActualizarUsuario($id,$username,$userpass,$usermail,$userrol){
        $exec = new Querys('inv_usuarios');
        $sql  = "UPDATE inv_usuarios SET user_name = '$username', user_pass = '$userpass', user_mail = '$usermail', id_rol_fk = '$userrol' WHERE id = '$id'";
        $res  = $exec->get_db()->query($sql);
        $resp = "";
        if(!$res){
            $resp = "0";
        }else{
            $resp = "1";
        }
        return $resp;
    }
?>