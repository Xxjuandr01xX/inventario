<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar-light-theme sidebar collapse">
<div class="position-sticky pt-3">
<ul class="nav flex-column">
    <li class = "nav-item">
        <h1 class = "text-start">
            <span class = "bi-person-circle text-white " style = "margin-left:20px;"></span>
            <p class = "h4 float-end text-white mt-3" style = "margin-right:85px;">
                Admin
            </p>
        </h1>
        <a class = "nav-link bg-secondary text-white text-center" href = "#">
            Hola, <?php echo $_SESSION['user'];?>.
            <b><i class = "bi-circle-fill text-success"></i><b>
            </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  rounded-0" aria-current="page" href="#" id="enlace2">
                    <span class="bi-laptop"></span>
                    Equipos
                </a>
                <ul class="nav flex-column text-start  bg-secondary" id="submenu2">
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($equipos);?>" href="<?php __Option($equipos,0);?>">
                            <span class="bi-box"></span>&nbsp;&nbsp; Gestionars&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($equipos);?>" href="<?php __Option($equipos,1);?>">
                            <span class="bi-cart-check"></span>&nbsp;&nbsp; Ventas&nbsp;&nbsp;
                        </a>
                    </li>
                </ul>
            </li>

             <li class="nav-item">
                <a class="nav-link rounded-0" aria-current="page" href="#" id="enlace6">
                    <span class="bi-wrench"></span>
                    Taller
                </a>
                <ul class="nav flex-column text-start  bg-secondary" id="submenu6">
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($equipos);?>" href="<?php __Option($taller,0);?>">
                            <span class="bi-bookmark-plus-fill"></span>&nbsp;&nbsp; Crear Insidencia&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-ite">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($equipos);?>" href="<?php __Option($taller,1);?>">
                            <span class="bi-bar-chart-line-fill"></span>&nbsp;&nbsp; Gestionar Insidencias&nbsp;&nbsp;
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a class="nav-link rounded-0" aria-current="page" href="#" id="enlace3">
                    <span class="bi-person-circle"></span>
                    Proveedores
                </a>
                <ul class="nav flex-column text-start bg-secondary" id="submenu3">
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($proveedores);?>" href="<?php __Option($proveedores,0);?>">
                            <span class="bi-plus"></span>&nbsp;&nbsp;Nuevo&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($proveedores);?>" href="<?php __Option($proveedores,1);?>">
                            <span class="bi-list"></span>&nbsp;&nbsp;Listado&nbsp;&nbsp;
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link rounded-0" aria-current="page" href="#" id="enlace4">
                    <span class="bi-person-circle"></span>
                    Clientes
                </a>
                <ul class="nav flex-column text-start bg-secondary" id="submenu4">
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($clientes);?>" href="<?php __Option($clientes,0);?>">
                            <span class="bi-plus"></span>&nbsp;&nbsp;Nuevo&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($clientes);?>" href="<?php __Option($clientes,1);?>">
                            <span class="bi-list"></span>&nbsp;&nbsp;Listado&nbsp;&nbsp;
                        </a>
                    </li>
                </ul>
            </li>

             <li class="nav-item">
                <a class="nav-link  rounded-0" aria-current="page" href="#" id="enlace5">
                    <span class="bi-gear-fill"></span>
                    Configuracion
                </a>
                <ul class="nav flex-column text-start  bg-secondary" id="submenu5">
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($Cfg);?>" href="<?php __Option($Cfg,0);?>">
                            <span class="bi-person-bounding-box"></span>&nbsp;&nbsp; Usuarios&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($Cfg);?>" href="<?php __Option($Cfg,1);?>">
                            <span class="bi-geo-alt-fill"></span>&nbsp;&nbsp; Paises&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($Cfg);?>" href="<?php __Option($Cfg,2);?>">
                            <span class="bi-briefcase-fill"></span>&nbsp;&nbsp; Servicios&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($Cfg);?>" href="<?php __Option($Cfg,3);?>">
                            <span class="bi-clipboard-data"></span>&nbsp;&nbsp; Estatus Tickets&nbsp;&nbsp;
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link  text-white rounded-0 <?php __Active($Cfg);?>" href="<?php __Option($Cfg,4);?>">
                            <span class="bi-reception-4"></span>&nbsp;&nbsp; Estados Equipos&nbsp;&nbsp;
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>