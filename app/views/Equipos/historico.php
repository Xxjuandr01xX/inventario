<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div id = 'cargarAlertas' style = "display:none;">
    </div>   		<!---->
<!--SECCIONES-->
    <div class = "card mt-3">
        <div class = "card-body">
            <nav class="nav justify-content-start bg-secondary">
                <li class="nav-item"><a href="?q=Equipos/ventas" class="nav-link text-white"><span class = "bi-plus"></span> <?php echo $pestanas[0];?></a></li>
                <li class="nav-item"><a href="?q=Equipos/historico" class="nav-link text-white"><span class = "bi-list"></span> <?php echo $pestanas[1];?></a></li>
            </nav>
        </div>
    </div>

    <!--CREAR NUEVA VENTA-->
    <div class="card mt-4" >
        <div class="card-body">
            <h3 class = "text-center"><?php echo $titulo;?></h3> 
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <div class="col-6 justify-content-start">
                            <div class="input-group">
                                <label for="" class="input-group-text"><span class = "bi-calendar-fill"></span> Inicio: </label>
                                <input type="text" name="" id="date_ini" class="form-control rounded-0" placeholder = "Desde">
                            </div>
                        </div>
                        <div class="col-6 justify-content-start">
                            <div class="input-group">
                                <label for="" class="input-group-text"><span class = "bi-calendar-fill"></span> Fin: </label>
                                <input type="text" name="" id="date_fin" class="form-control rounded-0" placeholder = "Hasta">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-4">
                    <button id = "btn_buscar" style = "width:100%;" class = "btn btn-success rounded-0"><span class = "bi-search"></span> Buscar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4" style = "display:none;" id = "table_seccion">
        <div class="card-body">
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-10">
                    <div id = "contenido_facturas"></div>
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
        <h5 class="modal-title" id="staticBackdropLabel"><span class = "bi-list"></span> DETALLE DE FACTURA</h5>
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
<script type = "text/javascript" src="public/assets/system/jsHistorico.js"></script>
</body>
</html>