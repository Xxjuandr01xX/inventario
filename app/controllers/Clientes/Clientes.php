<?php
    class Clientes extends CortrollerBase{
        public function __Construct(){
            parent::__Construct();
            session_start();
        }
        public function nuevo(){
            return $this->render('Clientes/nuevo',["titulo" => "Agregar Nuevo Cliente.","pais" => get_nacionalidades()]);
        }
        public function listado(){
            return $this->render('Clientes/listado',["titulo"=>"Gestion de Clientes"]);
        }
        public function editar(){
            $id             = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_STRING);
            $data           = clienteById($id);
            $nacionalidad   = get_nacionalidades();
            return $this->render('Clientes/editar',["titulo"=>"Gestion de Clientes","data"=>$data,"pais" => $nacionalidad]);
        }
        public function save(){
            $resp  = '';
            $nac                = filter_input(INPUT_POST, 'nacionalidad', FILTER_SANITIZE_STRING);
            $dni                = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
            $nombre             = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $apellido           = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
            $telefono           = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
            $correo             = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_STRING);
            $direccion          = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
            $query = saveCliente($dni,$nac,$nombre,$apellido,$telefono,$correo,$direccion);
            if($query != NULL){
                $resp = "1";
            }else {
                $resp = "0";
            }
            echo $resp;
        }
        public function eliminarCliente(){
            $id    = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $resp  = '';
            $query = delete_cliente($id);
            if($query != NULL){
                $resp = "1";
            }else {
                $resp = "0";
            }
            echo $resp;
        }
        public function editarClientes(){
            $id                 = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $nac                = filter_input(INPUT_POST, 'nacionalidad', FILTER_SANITIZE_STRING);
            $dni                = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
            $nombre             = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $apellido           = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
            $telefono           = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
            $correo             = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_STRING);
            $direccion          = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
            $resp  = '';
            $query = updateCliente($id,$nac,$dni,$nombre,$apellido,$telefono,$correo,$direccion);
            if($query != NULL){
                $resp = "1";
            }else {
                $resp = "0";
            }
            echo $resp;
        }
        public function tablaClientes(){
            $resp = '0';
            $sql = __TablaClientes();
            if($sql){
                $resp = '<table class = "table table-responsive text-centertable-stripped tabler-bordered table-hover" id = "clientesTable">';
                $resp .= '<thead class = "bg-primary text-white text-center">';
                $resp .= '<tr>';
                $resp .= '<td>NOMBRE</td>';
                $resp .= '<td>APELLIDO</td>';
                $resp .= '<td>DNI</td>';
                $resp .= '<td>TELEFONO</td>';
                $resp .= '<td>CORREO</td>';
                $resp .= '<td>PAIS</td>';
                $resp .= '<td>DIRECCION</td>';
                $resp .= '<td>ACCIONES</td>';
                $resp .= '</tr>';
                $resp .= '</thead>';
                $resp .= '<tbody>';
                foreach($sql as $registros){
                    $resp .= '<tr>'.
                                '<td>'.$registros['nombre'].'</td>'.
                                '<td>'.$registros['apellido'].'</td>'.
                                '<td>'.$registros['dni_nro'].'</td>'.
                                '<td>'.$registros['telefono'].'</td>'.
                                '<td>'.$registros['correo'].'</td>'.
                                '<td>'.$registros['desc_nac'].'</td>'.
                                '<td>'.$registros['direccion'].'</td>'.
                                '<td>'.
                                    '<button class = "btn btn-warning btn-sm" onclick="__formEditar('.$registros['id'].');"><span class = "bi-pencil"></span></button>'.
                                    '<button class = "btn btn-danger btn-sm" onclick="eliminarClliente('.$registros['id'].');"><span class = "bi-trash"></span></button>'
                                .'</td>'.
                             '</tr>';
                }
                $resp .= '</tbody>';
                $resp .= '</table>';
                
            }else {
                $resp = __BtnAlert('warning','NO HAY INFORMACION PARA MOSTAR.');
            }
            echo $resp;
        }
        //////////JSTaller///////////////////////
        public function getClientes(){
            $resp = "";
            foreach (getClientes() as $cli) {
                $resp = '<option value = "'.$cli['id'].'">'.$cli['nombre']." ".$cli['apellido'].'</option>';
            }
            echo $resp;
        }
    }
    
?>