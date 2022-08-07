<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div id = 'cargarAlertas' style = "display:none;">
    </div>
    <p class = "text-primary text-start"><span class = "bi-list text-primary"></span>EQUIPOS/GESTION</p>
    
    <div class="row clearfix">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="btn-group">
                <a href="#" id = "bs-btn-modal" class = "btn btn-outline-primary btn-sm rounded-0"><span class = "bi-plus-circle-fill"></span> Agregar Equipo</a>
                <a href="#" id = "" class = "btn btn-outline-primary btn-sm rounded-0"><span class = "bi-printer-fill"></span> Reporte General</a>
            </div>
        </div>
    </div>	
    
    </br>			<!---->
    <!--SECCIONES-->
    <div class = "card">
        <div class = "card-header text-center">
            
        </div>
        <div class = "card-body">
            <h1 class = "text-center text-primary">
                <span class = "bi-laptop"></span>
                <?php echo $mensaje;?>
            </h1>			

            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-12">
                    <div id="cargar-Tabla-equipos">
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
</div>
</div>
    <!--Modal Administrable-->
    <!--FIN-->

    <!--Modal agregar-->
        <div class="modal fade" id="bs-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style = "text-aling:center;">Agregar Equipo a Catalogo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id = "">
                     <div class="row clearfix">
                        <div class="col-md-12">
                            <?php echo __Input('eq-cod','text','laptop text-primary','00000001');;?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <?php echo __Input('eq-den','text','laptop text-primary','DENOMINACION');;?>
                        </div>
                    </div>

                   

                    <div class="row clearfix">
                        <div class="col-md-6">
                            <?php echo __Input('eq-mar','text','pencil-square text-primary','MARCA');?>
                        </div>
                        <div class="col-md-6">
                            <?php echo __Input('eq-mod','text','pencil-square text-primary','MODELO');?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-4">
                            <?php echo __Input('eq-costo','text','cash text-primary','COSTO');?>
                        </div>
                        <div class="col-md-4">
                            <?php echo __Input('eq-iva','text','cash text-primary','IVA');?>
                        </div>
                        <div class="col-md-4">
                            <?php echo __Input('eq-pvp','text','cash text-primary','PVP');?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6">
                            <?php echo __Input('eq-exist-min','text','eye text-primary','EX. MINIMA');?>
                        </div>
                        <div class="col-md-6">
                            <?php echo __Input('eq-exist-max','text','eye text-primary','EX. MAXIMA');?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <?php echo __select('eq-prov','person-check-fill text-primary',$prov,'nombre');?>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-8">
                            <button style = "width:100%;" class = "btn btn-primary" id = "btn-save"><span class = "bi-plus text-white"></span> Guardar</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    <!--Modal agregar-->

    <!-- Modal -->
<div class="modal fade" id="bs-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Actializar Registro de Equipos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row clearfix">
                        <div class="col-md-12">
                            <?php echo __Input('edit_den','text','laptop text-primary','DENOMINACION');;?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6">
                            <?php echo __Input('edit_mar','text','pencil-square text-primary','MARCA');?>
                        </div>
                        <div class="col-md-6">
                            <?php echo __Input('edit_mod','text','pencil-square text-primary','MODELO');?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-4">
                            <?php echo __Input('edit_costo','text','cash text-primary','COSTO');?>
                        </div>
                        <div class="col-md-4">
                            <?php echo __Input('edit_iva','text','cash text-primary','IVA');?>
                        </div>
                        <div class="col-md-4">
                            <?php echo __Input('edit_pvp','text','cash text-primary','PVP');?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-6">
                            <?php echo __Input('edit_exist_min','text','eye text-primary','EX. MINIMA');?>
                        </div>
                        <div class="col-md-6">
                            <?php echo __Input('edit_exist_max','text','eye text-primary','EX. MAXIMA');?>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <?php echo __select('edit_prov','person-check-fill text-primary',$prov,'nombre');?>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-8">
                            <button style = "width:100%;" class = "btn btn-outline-primary" id = "btn_edit"><span class = "bi-upload text-white"></span> Actualizar Equipo</button>
                        </div>
                    </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bs-cargar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cargar Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  onclick = "closeModal();" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row clearfix d-flex justify-content-center">
            <div class="col-md-8">
                <h4 class = "text-center"><span class = "bi-ui-checks text-primary"></span> Detalle de Equipo</h4>
            </div>
          </div>
          <div class="row clearfix d-flex justify-content-center">
            <div class="col-md-10">
                <table class="table table-stripped table-responsive table-hover">
                    <tr>
                        <td class = "text-end">Denominacion: </td>
                        <td class = "text-start" id = "td-denominacion"></td>
                    </tr>
                    <tr>
                        <td class = "text-end">Marca: </td>
                        <td class = "text-start" id = "td-marca"></td>
                    </tr>
                    <tr>
                        <td class = "text-end">Modelo: </td>
                        <td class = "text-start" id = "td-modelo"></td>
                    </tr>
                </table>
            </div>
          </div>
      </div>

      <div class="row clearfix d-flex justify-content-center">
        <div class="col-md-5">
            <div class="input-group">
                <label for="" class="input-group-text"><span class = "bi-arrow-right-square-fill text-primary"></span></label>
                <input type="text" name="" class="form-control" id = "stock-input" placeholder = "CANTIDAD">
            </div>
        </div>
        <br>
        <div class="col-md-5">
            <div class="input-group">
                <button id = "btn-cargar" class = "btn btn-outline-primary" style = "width:100%;"><span class = "bi-plus"></span> cargar</button>
            </div>
        </div>
        <br>
        <br>
        <br>
      </div>
    </div>
  </div>
</div>



<script type = "text/javascript" src="public/components.funcs.js"></script>
<script type = "text/javascript" src="public/plugins/DataTables/datatables.min.js"></script>
<script type = "text/javascript" src="public/plugins/Inputmask/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
<script type = "text/javascript" src="public/assets/system/jsEquipos.js"></script>
</body>
</html>