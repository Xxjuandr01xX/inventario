<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <div id = "cargarAlertas">
    </div>
    <p class = "text-primary text-start"><span class = "bi-list text-primary"></span> CLIENTES/EDITAR CLIENTE</p>				<!---->
    <!--SECCIONES-->
    <div class = "card">
        <div class = "card-header text-center">
            <p>EDITAR INFORMACION DE CLIENTES</p>
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
                            <label for="" class="input-group-text"><i class = "bi-map-fill text-primary"></i></label>
                            <select  id="select_pais" class = "form-control">
                                <?php
                                    if($pais[0]['id'] == $data[0]['id_nacionalidad_fk']){
                                        echo '<option value="'.$pais[0]['id'].'">'.$pais[0]['desc_nac'].'</option>';
                                    }else{
                                        echo '';
                                    }
                                ?>
                                <?php
                                    foreach ($pais as $nac) {
                                        if ($nac['id'] != $data[0]['id_nacionalidad_fk']) {
                                            echo '<option value="'.$nac['id'].'">'.$nac['desc_nac'].'</option>';
                                        }else{
                                            echo '<option value="0">--SELECCIONE EL PAIS --</option>';
                                        }
                                    }  
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <label for="" class="input-group-text"><span class = "bi-credit-card-2-back-fill text-primary"></span></label>
                            <input type="text" name="" id="input-cedula" class="form-control" placeholder = "CEDULA">
                        </div>
                    </div>
                </div> 
                <br> 
                <div class="row clearfix d-flex justify-content-center mt-4">
                    <div class="col-md-4">
                        <div class="input-group">
                            <label for="" class="input-group-text"><span class = "bi-person-fill text-primary"></span></label>
                            <input type="text" name="" id="input-nombre" class="form-control" placeholder = "NOMBRE">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <label for="" class="input-group-text"><span class = "bi-person-fill text-primary"></span></label>
                            <input type="text" name="" id="input-apellido" class="form-control" placeholder = "APELLIDO">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row clearfix d-flex justify-content-center mt-4">
                    <div class="col-md-4">
                        <div class="input-group">
                            <label for="" class="input-group-text"><span class = "bi-telephone-fill text-primary"></span></label>
                            <input type="text" name="" id="input-telefono" class="form-control" placeholder = "TELEFONO">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <label for="" class="input-group-text"><span class = "bi-envelope-fill text-primary"></span></label>
                            <input type="text" name="" id="input-email" class="form-control" placeholder = "CORREO">
                        </div>
                    </div>
                </div>
                
                <div class="row clearfix d-flex justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="input-group">
                            <label for="" class="input-group-text"><span class = "bi-geo-alt-fill text-primary"></span></label>
                            <textArea rows = "4" cols = "4" id="input-direccion" class="form-control" placeholder = "DIRECCION">
                            </textArea>
                        </div>
                    </div>
                </div> 
                <br>  
                <div class="row clearfix d-flex justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="input-group"><button class="btn btn-primary rounded-0" id = "btn-edit" style = "width:100%;">MODIFICAR</button></div>
                    </div>
                </div>
                <br>
            </div>
            <!--FIN-->							<!--FIN-->
        </div>
    </div>
</main>
</div>
</div>
<script src="public/components.funcs.js"></script>
<script src="public/plugins/Inputmask/Inputmask-5.x/dist/jquery.inputmask.min.js"></script>
<script src="public/assets/system/jsClientes.js"></script>
<script>
    <?php foreach($data as $cliente){?>
        var nombre      = document.getElementById('input-nombre').value     = "<?php echo $cliente['nombre']?>";
        var apellido    = document.getElementById('input-apellido').value   = "<?php echo $cliente['apellido']?>"; 
        var cedula      = document.getElementById('input-cedula').value     = "<?php echo $cliente['dni_nro']?>";
        var telefono    = document.getElementById('input-telefono').value   = "<?php echo $cliente['telefono']?>";
        var correo      = document.getElementById('input-email').value      = "<?php echo $cliente['correo']?>";
        var direccion   = document.getElementById('input-direccion').value  = "<?php echo $cliente['direccion']?>";
    <?php } ?>
</script>
</body>
</html>