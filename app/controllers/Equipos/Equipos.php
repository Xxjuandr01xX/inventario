<?php
    class Equipos extends CortrollerBase{
        public function __Construct(){
            parent::__Construct();
            session_start();
        }
        ////////////////PARA LANZAR PAGINAS//////////////////////////////////////////////////////
        public function gestionar(){
            $proveedores = get_proveedores();
            return $this->render("Equipos/Index",["mensaje" => "Catalogo de Equipos","prov" => $proveedores]);
        }
        public function ventas(){
            $pestanas = ["Nueva","Historico"];
            return $this->render('Equipos/ventas',["pestanas" => $pestanas]);
        }
        public function historico(){
            $pestanas = ["Nueva","Historico"];
            return $this->render('Equipos/historico',["pestanas" => $pestanas,"titulo" => "Historico de Ventas Realizadas"]);
        }
        //////////////JSEQUIPOS////////////////////////////////////////////////////////////
        public function insert_divice(){
            $cod        = filter_input(INPUT_POST, 'eq_cod', FILTER_SANITIZE_STRING);
            $den        = filter_input(INPUT_POST, 'eq_den', FILTER_SANITIZE_STRING);
            $mar        = filter_input(INPUT_POST, 'eq_mar', FILTER_SANITIZE_STRING);
            $mod        = filter_input(INPUT_POST, 'eq_mod', FILTER_SANITIZE_STRING);
            $cos        = filter_input(INPUT_POST, 'eq_costo', FILTER_SANITIZE_STRING);
            $iva        = filter_input(INPUT_POST, 'eq_iva', FILTER_SANITIZE_STRING);
            $pvp        = filter_input(INPUT_POST, 'eq_pvp', FILTER_SANITIZE_STRING);
            $ex_min     = filter_input(INPUT_POST, 'eq_exist_min', FILTER_SANITIZE_STRING);
            $ex_max     = filter_input(INPUT_POST, 'eq_exist_max', FILTER_SANITIZE_STRING);
            $id_prov    = filter_input(INPUT_POST, 'eq_prov', FILTER_SANITIZE_STRING);
            $verificar  = verificar_equipo($cod);
            $resp       = "";
            if($verificar == "0"){
                $insert   = insertar_equipo($cod,$den,$mar,$mod,$cos,$iva,$pvp,$ex_min,$ex_max,$id_prov);
                if($insert == "0"){
                    $resp = "0";
                }else if($insert == "1"){
                    $resp = "1";
                }else{
                    $resp = $insert;
                }
            }else if($verificar == "1"){
                $resp = "duplicate";
            }
            echo $resp;
        }
        public function formEdit(){
            $id    = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $resp  = null;
            foreach (getEquipoById($id) as $equipos) {
                $resp = $equipos;
            }
            echo json_encode($resp);
        }
        public function deleteDivice(){
            $id    = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $resp  = "";
            if(eliminarDelCatalogo($id) == "0"){
                $resp = "0";
            }else if(eliminarDelCatalogo($id) == "1"){
                $resp = "1";
            }
            echo $resp;
        }
        public function stockForm(){
           $id     = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
           $resp   = null; 
           foreach(getEquipoById($id) as $eq){
               $resp = $eq;
           }
           echo json_encode($resp);
        }
        public function cargarStock(){
            $id_equipo = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $cantidad  = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_STRING);
            $usuario   = getIdByUsername($_SESSION['user']);
            $resp      = "";
            if(guardarStock($id_equipo,$cantidad,$usuario) == "1"){
                $resp = "1";
            }else if(guardarStock($id_equipo,$cantidad,$usuario) == "0"){
                $resp = "0";
            }
            echo $resp;
        }
        public function actualizarEquipo(){
            $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $den     = filter_input(INPUT_POST, 'edit_den', FILTER_SANITIZE_STRING);
            $mar     = filter_input(INPUT_POST, 'edit_mar', FILTER_SANITIZE_STRING);
            $mod     = filter_input(INPUT_POST, 'edit_mod', FILTER_SANITIZE_STRING);
            $cos     = filter_input(INPUT_POST, 'edit_costo', FILTER_SANITIZE_STRING);
            $iva     = filter_input(INPUT_POST, 'edit_iva', FILTER_SANITIZE_STRING);
            $pvp     = filter_input(INPUT_POST, 'edit_pvp', FILTER_SANITIZE_STRING);
            $ex_min  = filter_input(INPUT_POST, 'edit_exist_min', FILTER_SANITIZE_STRING);
            $ex_max  = filter_input(INPUT_POST, 'edit_exist_max', FILTER_SANITIZE_STRING);
            $id_prov = filter_input(INPUT_POST, 'edit_prov', FILTER_SANITIZE_STRING);
            $resp    = "";
            if(editarEquipo($id,$den,$mar,$mod,$cos,$iva,$pvp,$id_prov,$ex_min,$ex_max) == "1"){
                $resp = "1";
            }else if(editarEquipo($id,$den,$mar,$mod,$cos,$iva,$pvp,$id_prov,$ex_min,$ex_max) == "0"){
                $resp = "0";
            }
            echo $resp;
        }
        public function tablaEquipos(){
            $columns = array("Codigo","Denominacion",'Marca','Modelo','Existencia','Costo','Iva','Pvp','Proveedor','Acciones');
            $resp = __TableInit('equipos','secondary','white',$columns);
            foreach(get_equipos() as $equipos){
                if (count($equipos) == 0) {
                    $resp = __BtnAlert('waring','NO HAY EQUIPOS EN EL CATALOGO');
                }else{
                    $resp .= '<tr>'.
                                    '<td>'.$equipos['cod_equipo'].'</td>'.
                                    '<td>'.$equipos['denominacion'].'</td>'.
                                    '<td>'.$equipos['marcar'].'</td>'.
                                    '<td class = "text-center">'.$equipos['modelo'].'</td>'.
                                    '<td class = "text-center">'.$equipos['cantidad'].'</td>'.
                                    '<td>'.$equipos['costo'].'</td>'.
                                    '<td>'.$equipos['iva'].'</td>'.
                                    '<td>'.$equipos['pvp'].'</td>'.
                                    '<td>'.getNameProveedor($equipos['id_proveedor_fk']).'</td>'.
                                    '<td><div class = "btn-group">'.
                                        '<button type="button" class="btn btn-warning btn-sm dropdown-toggle rounded-0" data-bs-toggle="dropdown" aria-expanded="false"><span class = "bi-gear-fill"></span> Opciones</button>'.
                                        '<ul class = "dropdown-menu">'.
                                        '<li><button class = "dropdown-item" onclick = "Delete('.$equipos['id'].');"><span class = "bi-trash-fill"></span> Eliminar</button></li>'.
                                        '<li><button class = "dropdown-item" onclick = "edit('.$equipos['id'].');"><span class = "bi-pencil-fill"></span> Editar</button></li>'.
                                        '<li><button class = "dropdown-item" onclick = "cargar('.$equipos['id'].');"><span class = "bi-download"></span> Cargar</button></li>'.
                                        '<li><button class = "dropdown-item" onclick = "print('.$equipos['id'].');"><span class = "bi-printer-fill"></span> Reporte</button></li>'
                                    .'</ul></div></td>'
                            .'</tr>';
                }
            }
            $resp .= __Tclose();
            echo $resp;
        }

        ///////JSVENTAS///////////

        public function listaClientes(){
            $resp = "";
            $clientes = getClientes();
            if($clientes == NULL){
                $resp = __BtnAlert('warning rounded-0','No hay Clientes Registrados');
            }else{
                $columns = [
                    "Nro",
                    "Dni",
                    "Nombre - Apellido",
                    "Seleccionar"
                ];
                $resp    = __TableInit('listaClientes','secondary','white',$columns);
                $y       = 0;
                foreach($clientes as $x){
                    $y++;
                    $resp .= '<tr>'.
                        '<td class = "text-center">'.$y.'</td>'.
                        '<td class = "text-center">'.$x['dni_nro'].'</td>'.
                        '<td class = "text-center">'.$x['nombre'].' '.$x['apellido'].'</td>'.
                        '<td class = "text-center">'.'<button onclick = "setBtnCliente('.$x['id'].')" class = "btn btn-outline-success btn-sm"><span class = "bi-check-circle-fill"></span></button>'.'</td>'.
                    '</tr>';
                }
            }
            $resp .= __Tclose();
            echo $resp;
        }

        public function setBtnCliente(){
            $id_cliente   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            foreach (clienteById($id_cliente) as $cliente) {
                echo json_encode($cliente);
            }
        }

        public function ventanaEquipos(){
            $resp    = "";
            $equipos = get_equipos();
            if($equipos == NULL){
                 $resp = __BtnAlert('warning rounded-0','No hay Productos en el Catalogo.');
            }else{
                $columns = [
                    'Codigo',
                    'Denominacion',
                    'Existencia',
                    'Seleccionar'
                ];
                $resp = __TableInit('listaProductos','secondary','white',$columns);
                foreach ($equipos as $eq) {
                    $resp .= '<tr>'.
                        '<td class = "text-center">'.$eq['cod_equipo'].'</td>'.
                        '<td class = "text-center">'.$eq['denominacion'].' - '.$eq['marcar'].' - '.$eq['modelo'].'</td>'.
                        '<td class = "text-center">'.$eq['cantidad'].'</td>'.
                        '<td class = "text-center">'.'<button onclick = "setInRow('.$eq['id'].','.$eq['cod_equipo'].');" class = "btn btn-outline-success btn-sm"><span class = "bi-chevron-double-right"></span></button>'.'</td>'.
                    '</tr>';
                }
            }
            $resp .= __Tclose();
            echo $resp;
        }

        public function setInRow(){
             $id_producto   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
             $resp          = "";
             foreach(getEquipoById($id_producto) as $eq){
                 $resp      = "<tr name = 'rows[]'>".
                                    "<td name = 'cod[]'>".$eq['cod_equipo']."</td>".
                                    '<td>'.$eq['denominacion'].' - '.$eq['marcar'].' - '.$eq['modelo'].'</td>'.
                                    "<td name = 'cant[]'></td>".
                                    "<td>".$eq['pvp']."</td>".
                                    "<td name = 'pres[]'></td>".
                                    "<td><button onclick = 'excluirDeLista(".$eq['cod_equipo'].")' class = 'btn btn-outline-warning btn-sm rounded-0'><span class = 'bi-arrow-90deg-right'></span></button><button class = 'btn btn-outline-success btn-sm rounded-0' onclick = 'cantidadProducto(".$eq['id'].")'><span class = 'bi-box-arrow-in-down'></span></button></td></tr>";
             }
             echo $resp;
        }

        public function formCargarCantidad(){
            $resp       = '<table class = "table table-stripped table-hover" id = "cargo-table">';
            $id_equipo  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $fila       = filter_input(INPUT_POST, 'nroFila', FILTER_SANITIZE_STRING);
            foreach (getEquipoById($id_equipo) as $eq) {
                $resp .= '<tr>'.
                            '<td class = "bg-secondary text-white text-end">Codigo: </td>'.
                            '<td>'.$eq['cod_equipo'].'</td>'.
                        '</tr>'.
                        '<tr>'.
                            '<td class = "bg-secondary text-white text-end">Denominacion: </td>'.
                            '<td>'.$eq['denominacion'].' - '.$eq['marcar'].' - '.$eq['modelo'].'</td>'.
                        '</tr>'.
                        '<tr>'.
                            '<td class = "bg-secondary text-white text-end">Existencia: </td>'.
                            '<td>'.$eq['cantidad'].'</td>'.
                        '</tr></table></br>';
            }

            $resp .= '<div class = "row clearfix d-flex justify-content-center">'.
                        '<div class = "col-md-8">'.
                            '<div class = "input-group">'.
                                '<label class = "input-group-text"><span class = "bi-box"></span></label>'.
                                '<input type = "text" class = "form-control" id = "input-cantidad">'.
                                '<button onclick = "calcularPresio('.$eq['cod_equipo'].','.$eq['pvp'].');" class = "btn btn-success"><span class = "bi-box-arrow-in-down" style = "width:100%;"></span> Agregar</button>'.
                            '</div>'.
                        '</div></br>';

            echo $resp;

            
        }

        public function verificarCantidad(){
            $cod_equipo  = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_STRING);
            $cantidad    = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_STRING);
            $resp        = "";
            foreach (getEquiposByCodigo($cod_equipo) as $eq) {
                if($cantidad >= $eq['existencia_minima']){
                    $resp = "0";
                }else{
                    $resp = "1";
                }
            }
            echo $resp;
        }

        public function proesarCompra(){
            $codigo_factura  = setFactureCode();
            $dni             = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
            $cliente         = getIdclienteByDni($dni);
            $codigos         = $_POST['codigos'];
            $cantidades      = $_POST['cantidades'];
            $precios_totales = $_POST['totales'];
            $id_usuario      = getIdByUsername($_SESSION['user']);
            $resp            = "";
            //echo crearFactura($codigo_factura,$cliente,$id_usuario);
            //echo detalleSalida($codigo_factura,$codigos,$cantidades,$precios_totales);
            //echo afectarExistencia($codigos,$cantidades);
            
            if(crearFactura($codigo_factura,$cliente,$id_usuario) == "1"){
                if(detalleSalida($codigo_factura,$codigos,$cantidades,$precios_totales) == "1"){
                   if(afectarExistencia($codigos,$cantidades) == "1"){
                        $resp = "1"; 
                   }else if(afectarExistencia($codigos,$cantidades) == "0"){
                        $resp = "0";                    
                   }
                }elseif (detalleSalida($codigo_factura,$codigos,$cantidades,$precios_totales) == "0") {
                    $resp = "0";
                }
            }else if(crearFactura($codigo_factura,$cliente,$id_usuario) == "0"){
                $resp = "0";
            }
            echo $resp;
        }

        ////////////////JSHISTORICO/////////////////////////////////////////////////
        public function buscarFacturas(){
            $inicio       = filter_input(INPUT_POST, 'ini', FILTER_SANITIZE_STRING);
            $fin          = filter_input(INPUT_POST, 'fin', FILTER_SANITIZE_STRING);
            $facturas     = getFacturesByDate($inicio,$fin);
            $resp         = "";
            if(count($facturas) < 1){
                $resp = __BtnAlert('warning','No hay Informacion para Mostrar.');
            }else{
                $columns = [
                    "Factura",
                    "Emision",
                    "Cliente",
                    "Vendedor",
                    "Acciones"
                ];
                $resp = __TableInit('lista-facturas','secondary','white',$columns);
                foreach ($facturas as $fact) {
                    $date = explode("-",$fact['fecha_emision']);
                    $resp .= "<tr>".
                                "<td>".$fact['cod_fact']."</td>".
                                "<td>".$date[2]."/".$date[1]."/".$date[0]."</td>".
                                "<td>".getClientNameById($fact['id_cliente_fk'])."</td>".
                                "<td>".getUserNameById($fact['id_usuario_fk'])."</td>".
                                "<td class = 'text-center'>".
                                    '<div class = "btn-group">'.
                                        '<buttton class = "btn btn-outline-success btn-sm rounded-0" onclick = "ver_detalle('.$fact['id'].');"><span class = "bi-eye-fill"></span> Detalle</buttton>'.
                                        '<buttton class = "btn btn-outline-warning btn-sm rounded-0"><span class = "bi-printer-fill"></span> Imprimir</buttton>'.
                                    '</div>'.
                                "</td>".
                             "</tr>";
                }
                $resp .= __Tclose();
            }
             echo $resp;
                /*
                $resp = __TableInit('lista_facturas','secondary','white',$columns);
                foreach($facturas as $dat){
                    $resp .= "<tr>".
                                "<td>".$dat['cod_fact']."</td>".
                                "<td>".$dat['fecha_emision']."</td>".
                                "<td>".getClientNameById($dat['id_cliente_fk'])."</td>".
                                "<td>".getUserNameById($dat['id_usuario_fk'])."</td>".
                                "<td>".
                                    '<div class = "btn-group">'.
                                        '<button class = "btn btn-outline-primary rounded-0 btn-sm"><span class = "bi-eye-fill"></span></button>'.
                                       ' <button class = "btn btn-outline-success rounded-0 btn-sm"><span class = "bi-printer-fill"></span></button>'.
                                    '</div>'.
                                "</td>".
                            "</tr>";
                }
                */
            //}
            //echo $resp;
        }

        public function detalleFactura(){
            $id   = filter_input(INPUT_POST, 'id_factura', FILTER_SANITIZE_STRING);
            $resp = "";
            $encabezado  = encabezadoFactura($id);
            $cod_factura = NULL;
            foreach($encabezado as $enc){
                $cod_factura = $enc['cod_fact'];
                $date = explode("-",$enc['fecha_emision']);
                $resp = '<div class = "row clearfix d-flex justify-content-center">'.
                            '<div class = "col-md-4 text-start">'.
                                '<p class = "text-center"><b><span class = "bi-person-fill"></span> Cliente </b> </br>'.getClientNameById($enc['id_cliente_fk']).'</p> '.
                                '<p class = "text-center"><b><span class = "bi-person-fill"></span> Vendedor </b> </br>'.getUserNameById($enc['id_usuario_fk']).'</p>'.
                            '</div>'.
                            '<div class = "col-md-4 text-end">'.
                                '<p class = "text-center"><b><span class = "bi-calendar-fill"></span> Fecha de Emision: </b> </br>'.$date[2]."/".$date[1]."/".$date[0].'</p>'.
                            '</div>'.
                        '</div><br>';
            }
            $columns = [
                "Nro",
                "Codigo",
                "Denominacion",
                "Cantidad",
                "Total"
            ];
            $resp .= __TableInit('desgloze-factura','secondary','white',$columns);
            $x = 0;
            $desgloze = desgloze($cod_factura);
            foreach($desgloze as $des){
                $x++;
                $resp .= "<tr class = 'text-center'>".
                            '<td>'.$x.'</td>'.
                            '<td>'.$des['cod_equipo'].'</td>'.
                            '<td>'.getNameEquipoByCod($des['cod_equipo']).'</td>'.
                            '<td>'.$des['cantidad'].'</td>'.
                            '<td>'.$des['precio_total'].'</td>'.
                         "</tr>";
            }
            $resp .= __Tclose();
            echo $resp;
        }

    }
?>