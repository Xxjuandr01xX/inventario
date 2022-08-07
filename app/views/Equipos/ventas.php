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
            <div class="row clearfix d-flex justify-content-center">
                <div class="col-md-8">
                <center>
                    <button class = "btn btn-outline-success p-4 rounded-0 mt-5" id = "btn_add_client">
                        <span class = "bi-person-fill"></span>
                        -- SELECCIONAR CLIENTE --
                    </button>
                </center>
                </div>
            </div>

            <div class="row clearfix mt-4 d-flex justify-content-center">
                <div class="col-md-10">
                    <nav class="nav d-flex justify-content-end" style = "display:none;">
                        <li class="nav-item" id="add_item">
                            <a href="" id = "btn-modal-add" class="nav-link btn btn-outline-success btn-sm rounded-0">
                                <span class = "bi-bookmark-plus-fill"></span> Agregar Producto
                            </a>
                        </li>
                    </nav>
                </div>
            </div>

            <div class="row clearfix mt-4 justify-content-center" id = "row_table">
                <div class="col-md-10">
                    <table class="table table-responsive table-stripped table-hover rounded-0">
                        <thead class = "bg-secondary text-white text-center">
                            <tr>
                                <td><span class = "bi-ui-radios"></span> Codigo</td>
                                <td><span class = "bi-laptop"></span> Equipo</td>
                                <td><span class = "bi-caret-right-fill"></span> Cantudad</td>
                                <td><span class = "bi-caret-right-fill"></span> Precio </td>
                                <td><span class = "bi-caret-right-fill"></span> Total</td>
                                <td><span class = "bi-gear"></span> Acciones</td>
                            </tr>
                        </thead>
                        <tbody class = "text-center" id = "rows_prod">
                            
                        </tbody>
                    </table>
                </div>
            </div>

            

            <div class="row clearfix d-flex justify-content-center mt-4" >
                <div class="col-md-8 d-flex justify-content-center">
                    <button class = "btn btn-outline-success p-3" id = "btn_sale">
                        <span class = "bi-gear-fill"></span>
                        Procesar Compra
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
<script type = "text/javascript" src="public/assets/system/jsVentas.js"></script>
</body>
</html>