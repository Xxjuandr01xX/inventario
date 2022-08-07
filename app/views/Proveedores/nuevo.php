<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div id = 'cargarAlertas' style = "display:none;"></div>
    <p class = "text-primary text-start"><span class = "bi-list text-primary"></span> PROVEEDORES/NUEVO PROVEEDOR</p>				<!---->
    <!--SECCIONES-->
    <div class = "card">
        <div class = "card-header text-center">
            <p><?php echo $mensaje;?></p>
        </div>
        <div class = "card-body">
            <h1 class = "text-center text-primary">
                <span class = "bi-person-circle"></span>
            </h1>			
            <!--formulario-->
            <div class="row clearfix d-flex justify-content-center mt-5">
                <div class="row clearfix d-flex justify-content-center">
                    <div class="col-md-4">
                        <?php echo __select('select-pais','map-fill text-primary',$pais,'desc_nac');?>
                    </div>
                    <div class="col-md-4">
                        <?php echo __Input('input-rif','text','file-x-fill text-primary','J-xxxxxxx');?>
                    </div>
                </div> 

                <div class="row clearfix d-flex justify-content-center">
                    <div class="col-md-4">
                        <?php echo __Input('input-den','text','credit-card-fill text-primary','DENOMINACION');?>
                    </div>
                    <div class="col-md-4">
                        <?php echo __Input('input-tel','text','phone-fill text-primary','(0414) - xxxxxxx');?>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <?php echo __Input('input-mail','text','envelope-fill text-primary','CORREO ELECTRONICO');?>
                    </div>
                </div>

                <div class="row clearfix justify-content-center mb-4">
                    <div class="col-md-8">
                        <?php echo __TextArea('textArea-dir','geo-alt-fill text-primary','DIRECCION');?>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <?php echo __Btn('primary','GUARDAR','save-proveedor');?>
                    </div>
                </div>

            </div>
            <!--FIN-->							<!--FIN-->
        </div>
    </div>
</main>
</div>
</div>
<script type = "text/javascript" src="public/components.funcs.js"></script>
<script type = "text/javascript" src="public/plugins/DataTables/datatables.min.js"></script>
<script type = "text/javascript" src="public/plugins/Inputmask/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
<script type = "text/javascript" src="public/assets/system/jsProveedores.js"></script>
</body>
</html>