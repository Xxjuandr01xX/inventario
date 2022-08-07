<?php
    class Proveedores extends CortrollerBase{
        public function __Construct(){
            parent::__Construct();
            session_start();
        }
        public function listado(){
            return $this->render("Proveedores/listado",["mensaje" => "Listado de Proveedores"]);
        }
        public function nuevo(){
            $nac = get_nacionalidades();
            return $this->render("Proveedores/nuevo",["mensaje" => "Registrar Proveedores","pais" => $nac]);
        }
        public function editar(){
            $cod       = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_STRING);
            $nac       = get_nacionalidades();
            $proveedor = get_proveedorById($cod);
            $prov_nac  = get_nacionalidadById($proveedor['id_nacionalidad_fk']);
            return $this->render("Proveedores/editar",["mensaje" => "Editar Informacion de Proveedor","prov_nac" => $prov_nac,"pais" =>$nac,"proveedor" =>$proveedor]);
            
        }
        public function delete(){
            $resp = '';
            $cod  = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_STRING);
            $res  = deleteProveedor($cod);
            if(!$res){
                $resp = '0';
            }else{
                $resp = '1';
            }
            echo $resp;
        
        }
        public function editarProveedor(){
            $nac    = filter_input(INPUT_POST, 'nac', FILTER_SANITIZE_STRING);
            $rif    = filter_input(INPUT_POST, 'rif', FILTER_SANITIZE_STRING);
            $den    = filter_input(INPUT_POST, 'den', FILTER_SANITIZE_STRING);
            $tel    = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
            $mail   = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
            $dir    = filter_input(INPUT_POST, 'dir', FILTER_SANITIZE_STRING);
            $id     = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

            $resp   = '';
            
            $result = updateProveedor($id,$nac,$den,$rif,$tel,$mail,$dir);
            if(!$result){
                $resp = '0';
            }else{
                $resp = '1';
            }
            echo $resp;
        }
        public function guardarProveedor(){
            $resp = '';
            $nac    = filter_input(INPUT_POST, 'nac', FILTER_SANITIZE_STRING);
            $rif    = filter_input(INPUT_POST, 'rif', FILTER_SANITIZE_STRING);
            $den    = filter_input(INPUT_POST, 'den', FILTER_SANITIZE_STRING);
            $tel    = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
            $mail   = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
            $dir    = filter_input(INPUT_POST, 'dir', FILTER_SANITIZE_STRING);
            $res    = saveProveedores($nac,$rif,$den,$tel,$mail,$dir);
            if(!$res){
                $resp = '0';
            }else if($res == 'duplicate'){
                $resp = 'duplicate';
            }else{
                $resp = '1';
            }
            echo $resp;
        }

        public function proveedoresTable(){
            $prvd = get_proveedores();
            $resp = '';
            if($prvd == NULL){
                $resp = __BtnAlert('warning',"NO HAY INFORMACION PARA MOSTRAR.");
            }else{
                $columnas = ["NOMBRE","RIF","TELEFONO","CORREO","DIRECCION","PAIS","ACCIONES"];
                $table = '<tbody class = "text-center">';
                foreach ($prvd as $prov) {
                   $table .= '<tr>'.
                                '<td>'.$prov['nombre'].'</td>'.
                                '<td>'.$prov['rif'].'</td>'.
                                '<td>'.$prov['telefono'].'</td>'.
                                '<td>'.$prov['correo'].'</td>'.
                                '<td>'.$prov['direccion'].'</td>'.
                                '<td>'.get_nacionalidadById($prov['id_nacionalidad_fk']).'</td>'.
                                '<td>
                                    <button class = "btn" onclick = "btn_edit('.$prov['id'].')"><span class = "bi-pencil"></span></button>
                                    <button class = "btn" onclick = "btn_delete('.$prov['id'].')"><span class = "bi-trash"></span></button>
                                </td>'.
                            '</tr>';
                }
                $table .= '</tbody>';
                $resp = __TableInit('prov-table','primary','white',$columnas).$table.__Tclose();
            }
            echo $resp;
        }
    }
?>