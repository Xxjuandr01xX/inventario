<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div class = 'cargarAlertas'></div>
    <p class = "text-primary text-start"><span class = "bi-list text-primary"></span> CLIENTES/NUEVO CLIENTE</p>				<!---->
    <!--SECCIONES-->
    <div class = "card">
        <div class = "card-header text-center">
            <p><?php echo $titulo;?></p>
        </div>
        <div class = "card-body">			
            <!--formulario-->
            <div class="row clearfix d-flex justify-content-center mt-5">
                <div class="col-md-8 d-flex justify-content-end">
                    <div class="btn-group ">
                        <button id = "bs-modal-add" class="nav-link btn btn-warning rounded-0"><span class = "bi-plus-square"></span> Agregar</button>
                    </div>
                </div> 
            </div>
            <div class="row clearfix d-flex justify-content-center mt-5">
                <div class="col-md-8">
                    <div id="cargar_tabla_usuarios">
                        <table class="table table-stripped table-hover table-responsive" id = "listado-paises">
                            <thead class="bg-secondary text-white">
                                <tr class="text-center">
                                    <td>Nro</td>
                                    <td>Telefono</td>
                                    <td>Tipo Documento</td>
                                    <td>Descripcion</td>
                                    <td>Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 0; foreach ($paises as $nac) { $x++;?>
                                    <tr class="text-center">
                                        <td><?php echo $x; ?></td>
                                        <td><?php echo $nac['cod_nac']; ?></td>
                                        <td><?php echo $nac['tipo_doc']; ?></td>
                                        <td><?php echo $nac['desc_nac']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-warning btn-sm rounded-0" onclick = "ModalEditNac(<?php echo $nac['id']; ?>)">
                                                    <span class = "bi-pencil-fill"></span>
                                                </button>
                                                <button class="btn btn-danger btn-sm rounded-0" onclick = "deleteNacionalidad(<?php echo $nac['id']; ?>)">
                                                    <span class = "bi-trash"></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            <!--FIN-->							<!--FIN-->
        </div>
    </div>
</main>
</div>
</div>
<!--MODAL AGREGAR USUARIO-->
<div class="modal fade rounded-0" id="bs-modal-agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><span class = "bi-list"></span> Agregar Nuevo Pais</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row clearfix d-flex justify-content-center">
            <div class="col-md-4">
                <?php echo __Input('cod_tel','text','phone-fill','+058');?>
            </div>
            <div class="col-md-4">
                <?php echo __Input('tip_doc','text','person-bounding-box','V.-');?>
            </div>
          </div>
          </br>
          <div class="row clearfix d-flex justify-content-center">
            <div class="col-md-8">
                <?php echo __Input('des_nac','text','geo-alt-fill','VENEZUELA');?>
            </div>
          </div>
          </br>
          <div class="row clearfix d-flex justify-content-center">
            <div class="col-md-8 ">
                <button class="btn btn-success rounded-0 w-100" id = "btn-add-pais">
                    <span class = "bi-plus"></span>
                    Agregar Pais
                </button>
            </div>
          </div>
          </br>
      </div>
    </div>
  </div>
</div>

<!--MODAL CONTENIDO-->
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

<script src="public/components.funcs.js"></script>
<script src="public/plugins/DataTables/datatables.min.js"></script>
<script src="public/plugins/Inputmask/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
<script src="public/assets/system/jsPaises.js"></script>
</body>
</html>