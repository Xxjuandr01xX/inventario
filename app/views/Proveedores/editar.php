<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div id = 'cargarAlertas' style = "display:none;"></div>
    <p class = "text-primary text-start"><span class = "bi-list text-primary"></span> PROVEEDORES/EDITAR PROVEEDOR</p>				<!---->
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
                        <div class="input-group">
                            <label for="" class="input-group-text"><span class = "bi-map-fill text-primary"></span></label>
                            <select  id="select-pais" class = "form-control">
                                <?php
                                    foreach($pais as $nac){
                                        if($nac['desc_nac'] == $prov_nac){
                                            echo '<option value = "'.$nac['id'].'">'.$prov_nac.'</option>';
                                        }else{
                                            echo '<option value = "'.$nac['id'].'">'.$nac['desc_nac'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
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
                        <?php echo __Btn('primary','EDITAR','edit-proveedor');?>
                    </div>
                </div>

            </div>
            <!--FIN-->							<!--FIN-->
        </div>
    </div>
</main>
</div>
</div>
<script>
    
        var input_rif       = document.getElementById('input-rif').value    ="<?php echo $proveedor['rif'];?>"; 
        var input_den       = document.getElementById('input-den').value    ="<?php echo $proveedor['nombre'];?>"; 
        var input_tel       = document.getElementById('input-tel').value    ="<?php echo $proveedor['telefono'];?>";  
        var input_mail      = document.getElementById('input-mail').value   ="<?php echo $proveedor['correo'];?>";
        var textArea_dir    = document.getElementById('textArea-dir').value ="<?php echo $proveedor['direccion'];?>";
</script>
<script type = "text/javascript" src="public/components.funcs.js"></script>
<script type = "text/javascript" src="public/plugins/DataTables/datatables.min.js"></script>
<script type = "text/javascript" src="public/plugins/Inputmask/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
<script type = "text/javascript" src="public/assets/system/jsProveedores.js"></script>
</body>
</html>