<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div class = 'cargarAlertas'></div>
    <p class = "text-primary text-start"><span class = "bi-list text-primary"></span> CLIENTES/NUEVO CLIENTE</p>				<!---->
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
                    <div id="cargar_tabla_Proveedores">
                    </div>
                </div> 
            </div>
            <!--FIN-->							<!--FIN-->
        </div>
    </div>
</main>
</div>
</div>
<script src="public/components.funcs.js"></script>
<script src="public/plugins/DataTables/datatables.min.js"></script>
<script src="public/plugins/Inputmask/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
<script src="public/assets/system/jsProveedores.js"></script>
</body>
</html>