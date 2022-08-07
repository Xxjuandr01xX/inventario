<?php require_once 'app/views/Index/head.php';?>
<?php require_once 'app/views/Index/header.php';?>
<?php require_once 'app/views/Index/forms.php';?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><!---->
    <!---->
    <!--SECCIONES-->
    <div class = "card mt-3 mb-3 shadow rounded-0">
        <div class = "card-body">
            <!--BOTONES-->
            <div class="row">
                <div class="col-md-4">
                    <buttom class=" p-4 w-100 btn btn-outline-primary rounded-0">
                        CLIENTES
                    </buttom>
                </div>
                <div class="col-md-4">
                    <buttom class=" p-4 w-100 btn btn-outline-primary rounded-0">
                        SERVICIOS AL MES
                    </buttom>
                </div>
                <div class="col-md-4">
                    <buttom class=" p-4 w-100 btn btn-outline-primary rounded-0">
                        VENTAL AL MES
                    </buttom>
                </div>
            </div>
		  <!--FIN-->					
    <!--TABLA Y SLIDER-->
    <div class="row clearfix d-flex justify-content-center mt-5">
        
        <div class = "col-md-8">
            <div class = "card rounded-0 shadow">
                <div class = "card-heder bg-secondary text-white text-center p-2">
                   <span class="bi-list"></span> SERVICIOS
                </div>
                <div class = "card-body">
                    <table class="table table-stripped table hover" id = "cargar-dataTable">
                        <thead class="bg-primary">
                            <tr class = "text-center text-white">
                                <td>Cod de ticket</td>
                                <td>Descripcion</td>
                                <td>Cliente</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>				
        <div class = "col-md-4">
            <div class = "card rounded-0 shadow">
                <div class = "card-header bg-secondary text-center text-white">
                    PRODUCTOS MAS VENDIDOS ESTE MES
                </div>
                <div class = "card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="box-shadow: 1px 0px 0px 0px rgba(0,0,0,0.5);">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="public/img/cr1.jpg" class="d-block image-fluid w-100" alt="..." style="height: 420px;">
                            </div>
                            <div class="carousel-item">
                                <img src="public/img/cr2.jpg" class="d-block image-fluid w-100" alt="..." style="height: 420px;">
                            </div>
                            <div class="carousel-item">
                                <img src="public/img/cr3.jpg" class="d-block image-fluid w-100" alt="..." style="height: 420px;">
                            </div>
                            <div class="carousel-item">
                                <img src="public/img/cr4.jpg" class="d-block image-fluid w-100" alt="..." style="height: 420px;">
                            </div>
                            <div class="carousel-item">
                                <img src="public/img/cr5.jpg" class="d-block image-fluid w-100" alt="..." style="height: 420px;">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FIN-->							<!--FIN-->
    </div>
    </div>
</main>
</div>
</div>
<script type = "text/javascript" src="public/assets/system/jsDash.js"></script>
</body>
</html>