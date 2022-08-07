<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div id = 'cargarAlertas'>
    </div>   		<!---->

    <!--CREAR NUEVA VENTA-->
    <div class="card mt-4" >
        <div class="card-body">
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-8">
                    <h2 class = "text-center"><?php echo $titulo;?></h2>
                    </br>
                </div>
            </div>
            <h3 class = "text-center">Informacion Basica</h3>
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <?php echo __TextArea('ta-des','person','DESCRICION'); ?>
                    </div>
                </div>
            </div>
            </br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-4">
                    <button id = "btn_cli" class = "rounded-0 btn btn-outline-warning btn-sm p-3" style = "width:100%;">
                        <span class = "bi-person-circle"></span>
                        -- SELECCIONAR CLIENTE --
                    </button>
                </div>
                <div class="col-md-4">
                    <button id = "btn_usr" class = "rounded-0 btn btn-outline-warning btn-sm p-3" style = "width:100%;">
                        <span class = "bi-person-circle"></span>
                        -- ASIGNAR SOPORTISTA --
                    </button>
                </div>
            </div>
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <?php echo __Input('fec_ini','text','calendar-fill','__/__/__'); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                    <label class = "input-group-text"><span class = "bi-card"></span></label>
                      <select class = 'form-control' id = "sel_serv">
                        <option value = "0">-- Seleccionar Servicio --</option>
                        <?php
                            foreach ($serv as $srv) {
                                echo '<option value = "'.$srv['id'].'">'.$srv['descripcion'].'</option>';
                            }
                        ?>
                      </select>
                    </div>
                </div>
            </div>
            <br>
            <h3 class = "text-center">Informacion de Equipos</h3>
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                       <?php echo __Input('des_eqp','text','laptop','Descripcion de Equipo')?>
                    </div>
                </div>
            </div>
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="input-group">
                       <?php echo __Input('nro_eqp','text','cart-plus-fill','Nro Eqiupos')?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                       <button class = "rounded-0 btn btn-outline-info btn-sm p-2" id = "btn_sts" style = "width:100%">
                            <span class = "bi-check-square"></span>
                            -- Seleccionar Estatus --
                       </button>
                    </div>
                </div>
            </div>
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="input-group">
                       <?php echo __Input('cos_ser','text','check text-success','Costo Total')?>
                    </div>
                </div>
            </div>
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                       <button class = "rounded-0 btn btn-success btn-sm p-3 w-100" id = "btn_save_ticket" style = "">
                            Guardar Ticket
                       </button>
                    </div>
                </div>
            </div>
    </div>
</main>
</div>
</div>
  

<div class="modal fade" id="bs-modal-contenido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><span class = "bi-list"></span> Listados</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div id = "cargar_ventana"></div>
      </div>
    </div>
  </div>
</div>



<script type = "text/javascript" src="public/components.funcs.js"></script>
<script type = "text/javascript" src="public/plugins/DataTables/datatables.min.js"></script>
<script type = "text/javascript" src="public/plugins/Inputmask/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
<script type = "text/javascript" src="public/assets/system/jsTaller.js"></script>
</body>
</html>