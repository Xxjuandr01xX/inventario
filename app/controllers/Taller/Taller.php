<?php
    class Taller extends CortrollerBase{
        public function __construct(){
			parent::__construct();
			session_start();
		}
        public function nuevo(){
            $serviciosArr = getServices();
            return $this->render('Taller/nuevo',["titulo"=>"Crear Nuevas Incidencias.","serv" => $serviciosArr]);
        }

        public function listado(){
            return $this->render('Taller/Listado',["titulo"=>"Gestion de Incidencias"]);
        }
        ////////JSTALLERLIS///////////////////////////////////
        public function actualizarTicket(){
            $id             = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $fec_fin        = filter_input(INPUT_POST, 'fec_fin', FILTER_SANITIZE_STRING);
            $observacion    = filter_input(INPUT_POST, 'observ', FILTER_SANITIZE_STRING);
            $estatus_ticket = filter_input(INPUT_POST, 'sts_ticket', FILTER_SANITIZE_STRING); 
            $estado_equipo  = filter_input(INPUT_POST, 'est_equipo', FILTER_SANITIZE_STRING);
            $resp = "";

            $update = actualizarIncidencia($id,$fec_fin,$observacion,$estatus_ticket,$estado_equipo);
            if($update == "1"){
                $resp = "1";
            }else if($update == "0"){
                $resp = "0";
            }
            echo $update;
        }
        public function EliminarTicket(){
            $id        = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $respuesta = deleteTicketById($id);
            if($respuesta == "1"){
                echo "1";
            }else if($respuesta == "0"){
                echo "0";
            }
        }
        public function getFormChange(){
            $id            = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $ticket        = getTicketById($id); 
            $ticket_equipo = getTicketEquipoByid($id);
            $resp          = "";

            //echo count($ticket);
            
            if(count($ticket) < 1){
                $resp = __BtnAlert("warning","No hay Informacion para Mostrar....");
            }else{
                foreach($ticket as $tick){
                    $date_ini = explode("-",$tick['fec_ini']);
                    $date_fin = explode("-",$tick['fec_fin']);
                    $resp = '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<label><span class = "bi-circle"></span> Descripcion: </label>'.
                                    '<h5>'.$tick['des_ticket'].'</h5>'.
                                '</div>'.
                             '</div></br>'.
                            '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-4">'.
                                    '<label><span class = "bi-person-circle"></span> Cliente: </label> </br>'.
                                    '<b>'.getClientNameById($tick['id_cliente_FK']).'</b>'.
                                '</div>'.
                                '<div class = "col-md-4">'.
                                    '<label><span class = "bi-person-circle"></span> Asignado a: </label> </br>'.
                                    '<b>'.getUserNameById($tick['id_usuario_fk']).'</b>'.
                                '</div>'.
                             '</div></br>'.
                             '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-4">'.
                                    '<label><span class = "bi-calendar"></span> Fecha de Inicio: </label> </br>'.
                                    '<b class = "text-center">'.$date_ini[2]."/".$date_ini[1]."/".$date_ini[0].'</b>'.
                                '</div>'.
                                '<div class = "col-md-4">'.
                                    '<label><span class = "bi-cash text-success"></span> Costo: </label> '.
                                    '<b>'.$tick['costo_servicio'].'</b>'.
                                '</div>'.
                             '</div></br>'.
                             '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-4">'.
                                    '<label><span class = "bi-circle-fill"></span> Estatus: </label>'.
                                    setEditableEstatus($tick['id']).
                                '</div>'.
                                '<div class = "col-md-4">'.
                                    '<label><span class = "bi-calendar"></span> Fecha de Culminacion: </label>'.
                                    setEditableFecha($tick['id']).
                                '</div>'.
                             '</div></br>'.
                             '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<label><span class = "bi-eye-fill"></span> Observacion: </label></br>'.
                                    setEditableTextArea($tick['id']).
                                '</div>'.
                             '</div></br>'.
                             '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<label><span class = "bi-clipboard-check text-success"></span> Tipo de Servicio: </label> '.
                                    setTipoServicioById($tick['id']).
                                '</div>'.
                             '</div></br>';
                }
                foreach ($ticket_equipo as $det) {
                    $resp .= '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<label><span class = "bi-laptop-fill"></span> <span class = "bi-phone-fill"></span> Equipo: </label>'.
                                    '<h5>'.$det['des_equipo'].'</h5>'.
                                '</div>'.
                             '</div></br>'.
                             '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-4">'.
                                    '<label class = "text-center"><span class = "bi-circle"></span> Cantidad: </label> '.
                                    '<b class = "text-center">'.$det['cantidad'].'</b>'.
                                '</div>'.
                                '<div class = "col-md-4">'.
                                    '<label><span class = "bi-check text-success"></span> Estado del Equipo: </label> '.
                                    getEstadoEquipoById($det['id_ticket_fk']).
                                '</div>'.
                             '</div></br></br>'.setBtnTicket($det['id_ticket_fk']);
                             
                }
            }
            echo $resp;
        }
        public function getTicketTable(){
            $ticket  = getTicketInfo();
            $resp    = "";
            if(count($ticket) < 1){
                $resp = __BtnAlert('info','No hay Tickets Registrados.');
            }else{
                $columns = [
                    "Nro",
                    "Codigo",
                    "Descripcion",
                    "Asignado a",
                    "Inicio",
                    "Estatus",
                    "Acciones"
                ];
                $resp =  __TableInit('listado-tickets','secondary','white',$columns);
                $x    = 0;
                foreach($ticket as $tick){
                    $date = explode("-",$tick['fec_ini']);
                    $x++;
                    if(rolIdByUserId($tick['id_usuario_fk']) == 1){
                        $resp .= '<tr class = "text-center">'.    
                                    '<td>'.$x.'</td>'.
                                    '<td>'.$tick['cod_ticket'].'</td>'.
                                    '<td>'.$tick['des_ticket'].'</td>'.
                                    '<td>'.getUserNameById($tick['id_usuario_fk']).'</td>'.
                                    '<td>'.$date[2]."/".$date[1]."/".$date[0].'</td>'.
                                    '<td>'.tagEstausTicket($tick['sts_ticket']).'</td>'.
                                    '<td>'.
                                        '<div class = "btn-group">'.
                                            '<button type="button" class="btn btn-ligth btn-sm dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false"><span class = "bi-gear-fill"></span> Elegir</button>'.
                                            '<ul class = "dropdown-menu">'.
                                                '<button class = "btn rounded-0 " onclick = "change('.$tick['id'].');"><span class = "bi-eye"></span> Detalle</button>'.
                                                '<button class = "btn rounded-0 " onclick = "pdf('.$tick['id'].');"><span class = "bi-printer"></span> Imprimir</button>'.
                                                '<button class = "btn rounded-0 " onclick = "delete_ticket('.$tick['id'].');"><span class = "bi-trash"></span> Eliminar</button>'.
                                            '</ul>'.
                                        '</div>'.
                                    '</td>'.
                                  '</tr>';
                    }else{
                        if(getIdByUsername($_SESSION['user']) == $tick['id_usuario_fk']){
                            $resp .= '<tr class = "text-center">'.    
                                    '<td>'.$x.'</td>'.
                                    '<td>'.$tick['cod_ticket'].'</td>'.
                                    '<td>'.$tick['des_ticket'].'</td>'.
                                    '<td>'.getClientNameById($tick['id_cliente_FK']).'</td>'.
                                    '<td>'.getUserNameById($tick['id_usuario_fk']).'</td>'.
                                    '<td>'.$date[2]."/".$date[1]."/".$date[0].'</td>'.
                                    '<td>'.tagEstausTicket($tick['sts_ticket']).'</td>'.
                                    '<td>'.
                                        '<div class = "btn-group">'.
                                            '<button type="button" class="btn btn-ligth btn-sm dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false"><span class = "bi-gear-fill"></span> Elegir</button>'.
                                            '<ul class = "dropdown-menu">'.
                                                '<button class = "btn rounded-0 " onclick = "change('.$tick['id'].');"><span class = "bi-eye"></span> Detalle</button>'.
                                                '<button class = "btn rounded-0 " onclick = "pdf('.$tick['id'].');"><span class = "bi-printer"></span> Imprimir</button>'.
                                            '</ul>'.
                                        '</div>'.
                                    '</td>'.
                                  '</tr>';
                        }
                    }
                }

                $resp .= __Tclose();
            }
            echo $resp;
        }
        /////////JS TALLER////////////////////////////////////

        public function setModalUsuarios(){
            $usuarios = getusuariosForTickets();
            $resp     = "";
            if(count($usuarios) < 1){
                $resp = __BtnAlert('warning',"No hay Clientes Registrados.");
            }else{
                $columns = [
                    "Nro",
                    "Nombre de Usuario",
                    "Seleccionar"
                ];
                $resp    = __TableInit('lista-usuarios','secondary','white',$columns);
                $x = 0;
                foreach($usuarios as $usr){
                    $x++;
                    $resp .= '<tr class = "text-center">'.
                                '<td>'.$x.'</td>'.
                                '<td>'."<span class = 'bi-person-circle'></span> - ".$usr['user_name'].'</td>'.
                                '<td>'.
                                    '<button class = "btn btn-warning btn-sm" onclick = "btnUsuarios('.$usr['id'].');"><span class = "bi-arrow-right-circle-fill"></span></button>'.
                                '</td>'.
                             '</tr>';
                }
                $resp .= __Tclose();
            }
            echo $resp;
        }

        public function setBtnUsuario(){
            $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            echo "<span class = 'bi-person-circle'></span> - ".getUserNameById($id);
        }

        public function setModalClientes(){
            $clientes = getClientes();
            $resp     = "";
            if(count($clientes) < 1){
                $resp = __BtnAlert('warning',"No hay Clientes Registrados.");
            }else{
                $columns = [
                    "Nro",
                    "Nombre",
                    "Seleccionar"
                ];
                $resp    = __TableInit('lista-clientes','secondary','white',$columns);
                $x = 0;
                foreach($clientes as $cli){
                    $x++;
                    $resp .= '<tr class = "text-center">'.
                                '<td>'.$x.'</td>'.
                                '<td>'."<span class = 'bi-person-circle'></span> - ".$cli['nombre']." ".$cli['apellido'].'</td>'.
                                '<td>'.
                                    '<button class = "btn btn-warning btn-sm" onclick = "btnCliente('.$cli['id'].');"><span class = "bi-arrow-right-circle-fill"></span></button>'.
                                '</td>'.
                             '</tr>';
                }
                $resp .= __Tclose();
            }
            echo $resp;
        }

        public function setBtnCliente(){
            $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            echo "<span class = 'bi-person-circle'></span> - ".getDniClienteById($id)." : ".getClientNameById($id);
        }

        public function setModalStatusEq(){
             $status = getStatusEquipos();
            $resp     = "";
            if(count($status) < 1){
                $resp = __BtnAlert('warning',"No hay Informacion para Mostrar");
            }else{
                $columns = [
                    "Nro",
                    "Descripcion",
                    "Seleccionar"
                ];
                $resp    = __TableInit('lista-sts','secondary','white',$columns);
                $x = 0;
                foreach($status as $sts){
                    $x++;
                    $resp .= '<tr class = "text-center">'.
                                '<td>'.$x.'</td>'.
                                '<td>'."<span class = 'bi-check'></span> - ".$sts['descripcion'].'</td>'.
                                '<td>'.
                                    '<button class = "btn btn-warning btn-sm" onclick = "btnStatusEquipo('.$sts['id'].');"><span class = "bi-arrow-right-circle-fill"></span></button>'.
                                '</td>'.
                             '</tr>';
                }
                $resp .= __Tclose();
            }
            echo $resp;
        }

        public function setBtnStatusEquipo(){
            $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            echo "<span class = 'bi-check'></span> - ".getStatusById($id);
        }

        public function newTicket(){
            $cod_ticket     = setTicketCode();
            $des_ticket     = filter_input(INPUT_POST, 'des_ticket', FILTER_SANITIZE_STRING);
            $cli_ticket     = filter_input(INPUT_POST, 'cli_ticket', FILTER_SANITIZE_STRING);
            $usr_ticket     = filter_input(INPUT_POST, 'usr_ticket', FILTER_SANITIZE_STRING);
            $fec_ini        = filter_input(INPUT_POST, 'fec_ini', FILTER_SANITIZE_STRING);
            $serv_ticket    = filter_input(INPUT_POST, 'serv_ticket', FILTER_SANITIZE_STRING);
            $des_equipo     = filter_input(INPUT_POST, 'des_equipo', FILTER_SANITIZE_STRING);
            $nro_equipo     = filter_input(INPUT_POST, 'nro_equipo', FILTER_SANITIZE_STRING);
            $est_equipo     = filter_input(INPUT_POST, 'est_equipo', FILTER_SANITIZE_STRING);
            $cos_servicio   = filter_input(INPUT_POST, 'cos_servicio', FILTER_SANITIZE_STRING);

            $id_cliente_fk = getIdclienteByDni($cli_ticket);
            $id_usuario_fk = getIdByUsername($usr_ticket);
            $id_estado_fk  = idEstadoByDescripcion($est_equipo);
            
            $ticket = guardarNuevoTicket($cod_ticket,$des_ticket,$id_cliente_fk,$id_usuario_fk,$fec_ini,$serv_ticket,$des_equipo,$nro_equipo,$id_estado_fk,$cos_servicio);
            $resp   = "";
            if($ticket == "1"){
                $resp = "1";
            }else if($ticket == "0"){
                $resp = "0";
            }
            echo $resp;
        }

    }
?>