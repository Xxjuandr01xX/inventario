<?php
    class Cfg extends CortrollerBase{
        public function __Construct(){
            parent::__Construct();
            session_start();
        }

        public function Usuarios(){
            return $this->render('Cfg/usuarios',["titulo" => "Gestion de Usuarios del Sistema.","roles" => getRolUsers()]);
        }
        public function Paises(){
            return $this->render('Cfg/paises',["titulo" => "Listado de Paises","paises"=>get_nacionalidades()]);
        }
        public function Servicios(){
            return $this->render('Cfg/servicios',["titulo" => "Gestion de Servicios Prestados en Soporte Tecnico.","serv" => getServices()]);
        }
        /////JSSERVICIOS////////////
        public function newService(){
            $den     = filter_input(INPUT_POST, 'den_service', FILTER_SANITIZE_STRING);
            $service = addNewService($den);
            if($service == "1"){
                echo "1";
            }else if($service == "0"){
                echo "0";
            }
        }
        public function deleteService(){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        }
        ////JSPAISES/////////////
        public function savePais(){
            $cod_tel = filter_input(INPUT_POST, 'cod_tel', FILTER_SANITIZE_STRING);
            $des_nac = filter_input(INPUT_POST, 'des_nac', FILTER_SANITIZE_STRING);
            $tip_doc = filter_input(INPUT_POST, 'tip_doc', FILTER_SANITIZE_STRING);
            $paises  = newPaises($cod_tel,$des_nac,$tip_doc);
            if($paises == "1"){
                echo "1";
            }else if($paises == "0"){
                echo "0";
            }
        }
        public function updateNacionalidades(){
            $cod_tel = filter_input(INPUT_POST, 'edt_cod_tel', FILTER_SANITIZE_STRING);
            $des_nac = filter_input(INPUT_POST, 'edt_tip_doc', FILTER_SANITIZE_STRING);
            $tip_doc = filter_input(INPUT_POST, 'edt_des_nac', FILTER_SANITIZE_STRING);
            $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $naci    = actualizarNacionalidades($id,$cod_tel,$des_nac,$tip_doc);
            if($naci == "1"){
                echo "1";
            }else if($naci == "0"){
                echo "0";
            }
        }
        public function deleteNac(){
             $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
             $delete  = eliminarNacionalidad($id);
            if($delete == "1"){
                echo "1";
            }else if($delete == "0"){
                echo "0";
            }
        }
        public function formEditarPais(){
            $id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $resp = "";
            foreach (getNacionalidadById($id) as $nac) {
                $resp = '<div class = "rows clearfix d-flex justify-content-center">'.
                            '<div class = "col-md-4">'.
                                '<div class = "input-group">'.
                                    '<label class = "input-group-text rounded-0"><span class = "bi-phone-fill"></span></label>'.
                                    '<input id = "edt_cod_tel" type = "text" class = "form-control rounded-0" placeholder = "+058" value = "'.$nac['cod_nac'].'"/>'.
                                '</div>'.
                            '</div>'.
                            '<div class = "col-md-4">'.
                                '<div class = "input-group">'.
                                    '<label class = "input-group-text rounded-0"><span class = "bi-person-bounding-box"></span></label>'.
                                    '<input id = "edt_tip_doc" type = "text" class = "form-control rounded-0" placeholder = "V.-" value = "'.$nac['tipo_doc'].'"/>'.
                                '</div>'.
                            '</div>'.
                        '</div></br>'.
                        '<div class = "rows clearfix d-flex justify-content-center">'.
                            '<div class = "col-md-8">'.
                                '<div class = "input-group">'.
                                    '<label class = "input-group-text"><span class = "bi-geo-alt-fill"></span></label>'.
                                    '<input id = "edt_des_nac" type = "text" class = "form-control rounded-0" placeholder = "VENEZUELA" value = "'.$nac['desc_nac'].'"/>'.
                                '</div>'.
                            '</div>'.
                        '</div></br>'.
                        '<div class = "rows clearfix d-flex justify-content-center">'.
                            '<div class = "col-md-4">'.
                                '<button class = "btn btn-warning w-100 rounded-0" onclick = "editarPais('.$nac['id'].')"><span class = "bi-pencil-square"></span> Editar Pais</button>'.
                            '</div>'.
                        '</div></br>';
            }
            echo $resp;
        }
        ////JSCFG///////
        public function tablaUsuarios(){
            $usuarios = getAllUsers();
            $resp     = "";
            if(count($usuarios) < 1){
                $resp = __BtnAlert("warning","No hay Usuarios Creados ...");
            }else{
                $columns = [
                    "Nro",
                    "Nombre de Usuario",
                    "Correo Electronico",
                    "Permisologia",
                    "Acciones"
                ];
                $resp = __TableInit('listado-usuarios','secondary','white',$columns);
                $x = 0;
                foreach ($usuarios as $usr) {
                    $x++;
                    $resp .= '<tr class = "text-center">'.
                                '<td>'.$x.'</td>'.
                                '<td>'.$usr['user_name'].'</td>'.
                                '<td>'.$usr['user_mail'].'</td>'.
                                '<td>'.getRolById($usr['id_rol_fk']).'</td>'.
                                '<td>'.setUsuariosAcciones($usr['id']).'</td>'.
                            '</tr>';
                }
                $resp .= __Tclose();
            }
            echo $resp;
        }

        public function setNewUser(){
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $userpass = filter_input(INPUT_POST, 'userpass', FILTER_SANITIZE_STRING);
            $usermail = filter_input(INPUT_POST, 'usermail', FILTER_SANITIZE_STRING);
            $userrol  = filter_input(INPUT_POST, 'userrol', FILTER_SANITIZE_STRING);
            $newUser = createNewUser($username,$userpass,$usermail,$userrol);
            if($newUser == "1"){
                echo "1";
            }else if($newUser == "0"){
                echo "0";
            }
        }

        public function eliminarUsuario(){
            $id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $user = deleteUser($id);
            if($user == "1"){
                echo "1";
            }else if($user == "0"){
                echo "0";
            }
        }
        public function updateUser(){
            $id         = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $username   = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $userpass   = filter_input(INPUT_POST, 'userpass', FILTER_SANITIZE_STRING);
            $usermail   = filter_input(INPUT_POST, 'usermail', FILTER_SANITIZE_STRING);
            $userrol    = filter_input(INPUT_POST, 'userrol', FILTER_SANITIZE_STRING);
            $user = ActualizarUsuario($id,$username,$userpass,$usermail,$userrol);
            if($user == "1"){
                echo "1";
            }else if($user == "0"){
                echo "0";
            }
        }
        public function formEditUser(){
            $id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $userEdit = getUsuarioById($id);
            $resp = "";
            if(count($userEdit) < 1){
                $resp = __BtnAlert("warning","La Informacion no se Puede Corroborar..");
            }else{
                foreach($userEdit as $edt){
                    $resp = '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<div class = "input-group">'.
                                        '<label class = "input-group-text"><span class = "bi-person-fill"></span></label>'.
                                        '<input id = "ed_username" type  = "text" class = "form-control" placeholder = "NOMBRE DE USUARIO" value = "'.$edt['user_name'].'"/>'.
                                    '</div>'.
                                '</div>'.
                            '</div></br>'.
                            '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<div class = "input-group">'.
                                        '<label class = "input-group-text"><span class = "bi-unlock-fill"></span></label>'.
                                        '<input id = "ed_userpass" type  = "password" class = "form-control" placeholder = "CONTRASEÑA" value = "'.$edt['user_pass'].'"/>'.
                                    '</div>'.
                                '</div>'.
                            '</div></br>'.
                            '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<div class = "input-group">'.
                                        '<label class = "input-group-text"><span class = "bi-envelope-fill"></span></label>'.
                                        '<input id = "ed_usermail" type  = "text" class = "form-control" placeholder = "CORREO ELECTRONICO" value = "'.$edt['user_mail'].'"/>'.
                                    '</div>'.
                                '</div>'.
                            '</div></br>'.
                            '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<div class = "input-group">'.
                                        '<label class = "input-group-text"><span class = "bar-chart-line-fill"></span></label>'.
                                        setRolSelectByUser().
                                    '</div>'.
                                '</div>'.
                            '</div></br>'.
                            '<div class = "row clearfix d-flex justify-content-center">'.
                                '<div class = "col-md-8">'.
                                    '<div class = "input-group">'.
                                        '<button class = "btn btn-warning w-100 rounded-0" onclick = "updateUser('.$edt['id'].');"><span class = "bi-reply-fill"></span> Actualizar</button>'.
                                    '</div>'.
                                '</div>'.
                            '</div></br>';
                }
            }
            echo $resp;
        }
    }
?>