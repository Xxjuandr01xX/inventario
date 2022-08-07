<?php
    function getServices(){
        $exec = new Querys('inv_ticket_servicios');
        return $exec->getAll();
    }

    function getStatusEquipos(){
        $exec = new Querys('inv_ticket_equipos_estados');
        return $exec->getAll();
    }

    function getEstadoEquipoById($id){
        $exec   = new Querys('inv_tickets');
        $estado = "";
        foreach($exec->getById($id) as $tic){
            if($tic['sts_ticket'] == 3 || $tic['sts_ticket'] == 4){
                $exec_II = new Querys('inv_ticket_equipos');
                foreach ($exec_II->getByColumn('id_ticket_fk',$tic['id']) as $eqp) {
                    $sql      = "SELECT * FROM inv_ticket_equipos_estados WHERE id = '$eqp[est_equipo]'";
                    $exec_III = new Querys('inv_ticket_equipos_estados');
                    $res_III  = $exec->get_db()->query($sql);
                    while($x = $res_III->fetch_assoc()){
                        $estado = '<b>'.$x['descripcion'].'<b>';
                    }
                }
            }else{
                $exec_III = new Querys('inv_ticket_equipos_estados');
                $estado   = '<select class = "form-control" id = "sts-select">';
                foreach($exec_III->getAll() as $est){
                    $estado   .= '<option value = "'.$est['id'].'">'.$est['descripcion'].'</option>';
                }
                 $estado .= "</select>";
            }
        }
        return $estado;
    }

    function setTicketCode(){
        $exec      = new Querys('inv_tickets');
        $sql_I     = "SELECT cod_ticket FROM inv_tickets ORDER BY cod_ticket desc LIMIT 0,1";
        $res_I     = $exec->get_db()->query($sql_I);
        $ultimoNro = null;
        $formato   = "00000000";
        $resultado = null;
        while ($x = $res_I->fetch_assoc()) {
            $ultimoNro = $x['cod_ticket'];
        }
        $suma          = $ultimoNro+1;
        $nroCaracteres = strlen($suma);
        if($nroCaracteres > 0){
            $sustr      = substr($formato,$nroCaracteres);
            $resultado  = $sustr.$suma;
        }else{
            $formato   = "0000000";
            $resultado = $formato."1";
        }
        return $resultado;
    }

    function idEstadoByDescripcion($descripcion){
        $exec = new Querys('inv_ticket_equipos_estados');
        $id   = null;
        foreach($exec->getLikeColumn('descripcion',trim($descripcion)) as $estado){
            $id  = $estado['id'];
        }
        return $id;
    }

    function guardarNuevoTicket($cod_ticket,$des_ticket,$id_cliente_fk,$id_usuario_fk,$fec_ini,$serv_ticket,$des_equipo,$nro_equipo,$id_estado_fk,$cos_servicio){
        $exec   = new Querys('inv_tickets');
        $sql_I  = "INSERT INTO inv_tickets VALUES(null,'$cod_ticket','$des_ticket',$id_cliente_fk,$id_usuario_fk,'$fec_ini',null,1,$cos_servicio,null,$serv_ticket)"; 
        $res    = $exec->get_db()->query($sql_I); 
        $resp   = "";
        if(!$res){
           $resp = "0";
        }else{
            $insert_id     = mysqli_insert_id($exec->get_db());
            $sql_II        = "INSERT INTO `inv_ticket_equipos` VALUES (NULL, $insert_id, '$des_equipo', $nro_equipo,$id_estado_fk, '$fec_ini',null);";
            $res_II        = $exec->get_db()->query($sql_II);
            //echo $sql_II;
            
            if(!$res_II){
                $resp = "0";
            }else{
                $resp = "1";
            }
        }

        return $resp;
        
    }

    function getTicketInfo(){
        $exec   = new Querys('inv_tickets');
        return $exec->getAll();
    }

    function tagEstausTicket($id_estatus){
        $exec   = new Querys('inv_ticket_estatus');
        $resp   = "";
        foreach($exec->getById($id_estatus) as $est){
            if($est['id'] == 1){
                $resp = "<button class = 'btn btn-sm btn-info'>".$est['descripcion']."</button>";
            }else if($est['id'] == 2){
                $resp = "<button class = 'btn btn-sm btn-warning'>".$est['descripcion']."</button>";
            }else if($est['id'] == 3){
                $resp = "<button class = 'btn btn-sm btn-success'>".$est['descripcion']."</button>";
            }else if($est['id'] == 4){
                $resp = "<button class = 'btn btn-sm btn-danger'>".$est['descripcion']."</button>";
            }
        }
        return $resp;
    }

    function getEstatus(){
         $exec   = new Querys('inv_ticket_estatus');
         return $exec->getAll();
    }

    function getTicketById($id){
        $exec   = new Querys('inv_tickets');
        return $exec->getById($id);
    }

    function getTicketEquipoByid($id){
        $exec   = new Querys('inv_ticket_equipos');
        $sql    = "SELECT * FROM inv_ticket_equipos WHERE id_ticket_fk = $id";
        $resultSet = [];
        $res = $exec->get_db()->query($sql);
        while ($x = $res->fetch_assoc()) {
            $resultSet[] = $x;
        }
        return $resultSet;
    }

    function deleteTicketById($id){
        $sql    = "DELETE FROM inv_tickets WHERE id = '$id'";
        $sql_II = "DELETE FROM inv_ticket_equipos WHERE id_ticket_fk = '$id'"; 
        $exec   = new Querys('inv_tickets');
        $res    = $exec->get_db()->query($sql);
        $resp   = "";
        if(!$res){
            $resp = "0";
        }else{
            $res_II = $exec->get_db()->query($sql_II);
            if(!$res_II){
                $resp = "0";
            }else{
                $resp = "1";
            }
        }

        return $resp;
    }
    function actualizarIncidencia($id,$fec_fin,$observacion,$estatus_ticket,$estado_equipo){
        $sql_I  = "SELECT fec_ini FROM inv_tickets WHERE id = '$id'";
        $sql_II = "UPDATE inv_tickets SET fec_fin = '$fec_fin', observacion = '$observacion', sts_ticket = '$estatus_ticket' WHERE id = '$id'";
        $exec   = new Querys('inv_tickets');
        $res_I  = $exec->get_db()->query($sql_I);
        $inicio = null;
        $resp   = "";
        while ($x = $res_I->fetch_assoc()) {
            $inicio = $x['fec_ini'];
        }
        $fec_inicio = strtotime($inicio."00:00:00");
        $fec_final  = strtotime($fec_fin."00:00:00");
        if($fec_inicio < $fec_final){
            $res_II = $exec->get_db()->query($sql_II);
            if(!$res_II){
                $resp = "0";
            }else{
                $sql_III = "UPDATE inv_ticket_equipos SET est_equipo = '$estado_equipo' WHERE id_ticket_fk = '$id'";
                $res_III = $exec->get_db()->query($sql_III);
                if(!$res_III){
                    $resp = "0";
                }else{
                     $resp = "1";
                }
            }
        }else{
            $resp = "time";
        }
        return $resp;
    }

    function setEditableEstatus($id){
        $exec     = new Querys('inv_tickets');
        $response = "";
        foreach ($exec->getById($id) as $x) {
            if($x['sts_ticket'] == 3){
                $response = ' <b class = "text-center text-success"> RESUELTO</b>';
            }else if($x['sts_ticket'] == 4){
                $response = ' <b class = "text-center text-danger"> CERRADO</b>';
            }else{
                 $exec_II = new Querys('inv_ticket_estatus');
                 $response = '<select class = "form-control" id = "sel-est">';
                 foreach($exec_II->getAll() as $y){
                     $response .= '<option value = "'.$y['id'].'">'.$y['descripcion'].'</option>';
                 }
                 $response .= '</select>';
            }
        }
        return $response;
    }

    function setEditableTextArea($id){
        $exec     = new Querys('inv_tickets');
        $response = "";
        foreach($exec->getById($id) as $txt){
            if($txt['sts_ticket'] == 3){
                $response = '</br></br> <b class = "text-center">'.$txt['observacion'].'</b>';
            }else if($txt['sts_ticket'] == 4){
                $response = '</br></br> <b class = "text-center">'.$txt['observacion'].'</b>';
            }else{
                $response = '<textArea class = "form-control" cols = "3" rows = "3" id = "text-obs"></textArea>';
            }
        }
        return $response;
    }

    function setEditableFecha($id){
        $exec     = new Querys('inv_tickets');
        $response = "";
        foreach($exec->getById($id) as $dat){
            if($dat['sts_ticket'] == 3){
                $fec_fin = explode("-",$dat['fec_fin']);
                $response = '</br><b class = "text-center">'.$fec_fin[2]."/".$fec_fin[1]."/".$fec_fin[0].'</b>';
            }else if($dat['sts_ticket'] == 4){
                $fec_fin = explode("-",$dat['fec_fin']);
                $response = '</br><b class = "text-center">'.$fec_fin[2]."/".$fec_fin[1]."/".$fec_fin[0].'</b>';
            }else{
                $response = '<input type = "text" id = "dat_fin" class = "form-control" placeholder = "__/__/____" value = "'.$dat['fec_fin'].'"/>';
            }
        }
        return $response;
    }

    function setBtnTicket($id){
        $exec     = new Querys('inv_tickets');
        $response = "";
        foreach($exec->getById($id) as $x){
            if($x['sts_ticket'] == 3){
                $response = '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<button class = "btn btn-primary w-100 rounded-0" onclick = "imprimir_ticket('.$x['id'].')"><span class = "bi-printer-fill"></span> Imprimir</button>'.
                                '</div>'.
                            '</div>';
            }else if($x['sts_ticket'] == 4){
                $response = '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<button class = "btn btn-primary w-100 rounded-0" onclick = "imprimir_ticket('.$x['id'].')"><span class = "bi-printer-fill"></span> Imprimir</button>'.
                                '</div>'.
                            '</div>';
            }else{
                $response = '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<button class = "btn btn-success w-100 rounded-0" onclick = "actualizar_ticket('.$x['id'].')"><span class = "bi-reply-fill"></span> Actualizar</button>'.
                                '</div>'.
                            '</div>';
            }
        }
        return $response;
    }

    function setTipoServicioById($id){
        $exec     = new Querys('inv_tickets');
        $exec_II  = new Querys('inv_ticket_servicios');
        $response = "";
        foreach($exec->getById($id) as $tic){
            foreach($exec_II->getById($tic['id_tipo_servicio']) as $tpe){
                $response = '<b>'.$tpe['descripcion'].'</b>';
            }
        }
        return $response;
    }

    function getStatusById($id){
        $exec = new Querys('inv_ticket_equipos_estados');
        $estado = null;
        foreach($exec->getById($id) as $est){
            $estado = $est['descripcion'];
        }
        return $estado;
    }

    function addNewService($den){
        $exec   =  new Querys('inv_ticket_servicios');
        $res    =  $exec->get_db()->query("INSERT INTO inv_ticket_servicios VALUES(null,'$den')");
        $resp   =  "";
        if(!$res){
            $resp = "0";
        }else{
            $resp = "1";
        }
        return $resp;
    }
   
?>