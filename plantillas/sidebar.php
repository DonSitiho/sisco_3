<!-- chido *************************************************************** -->
<div class="page-content d-flex align-items-stretch">
    <!-- Side Navbar -->
    <nav class="side-navbar ">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
                 <div class="avatar" style=""><img src="<?php echo($newImage) ?>" style="width: 93% !important;
    height: 93% !important;
    border-radius: 900px !important;
    overflow: hidden !important;
  
border: 2px solid green !important;" alt="..." class="img-fluid rounded-circle img-responsive"></div>
            <div class="title">
                <h1 class="h4"><?php echo($Usuario); ?></h1>
                <p>Capturista</p>
            </div>
        </div>
         <!-- Sidebar Navidation Menus--><span class="heading">Perfil</span>
        <ul class="list-unstyled">
             <li class=""><a href="vistas/Oficialia/perfil_usuario.php"> <i class="icon-user"></i>Perfiles </a></li>
            <!-- Sidebar Navidation Menus--><span class="heading">Principal</span>
            <li class="active"><a href="correspondenciadia.php"> <i class="icon-home"></i>Inicio </a></li>
            <span class="heading">Correspondencia</span>
            <li><a href="#corresp" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-mail"></i>Correspondencia </a>
                <ul id="corresp" class="collapse list-unstyled ">
                    <li><a href="correspondenciadia.php">del Día</a></li>
                    <li><a href="correspondencia.php">Historial</a></li>
                </ul>


                <!-- <li><a href="estadistica.php"> <i class="icon-picture"></i>Estadística </a></li> -->
            <li><a href="#Dropdown1" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>Catálogos </a>
                <ul id="Dropdown1" class="collapse list-unstyled ">
                    <li><a href="dependencias.php">Dependencias</a></li>
                    <li><a href="areasecoem.php">Areas internas</a></li>
                </ul>
            </li>
            <!-- <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>Administración </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="usuarios.php">Usuarios</a></li>
                    <li><a href="estadistica.php">Estadística</a></li>
                </ul>
            </li>-->
            <!--   <li><a href="login.html"> <i class="icon-interface-windows"></i>Pág Login </a></li>-->
        </ul><span class="heading">Consultas</span>
        <ul class="list-unstyled">
            <li> <a href="c_general.php"> <i class="icon-padnote"></i>General</a></li>
            <li> <a href="c_pfecha.php"> <i class="material-icons">date_range</i>Por fecha </a></li>
            <!-- <li> <a href="c_prangofolios.php"> <i class="material-icons">date_range</i>Por folios </a></li> -->
        </ul>
        <!-- </ul><span class="heading">Reportes</span>
        <ul class="list-unstyled">
            <li> <a href="r_general.php"> <i class="icon-padnote"></i>General</a></li>
            <li> <a href="r_pfecha.php"> <i class="material-icons">date_range</i>Por fecha </a></li>
        </ul> -->
    </nav>

    <div class="content-inner">
        <!-- Page Header-->
        <header class="">
            <div class="">
                <nav class="navbar navbar-expand-sm navbar-light bg-light navbartamano">
                    <div class="row">


                        <div class="col-sm-4">

                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">

                                    <li class="nav-item dropdown active">
                                        <a class="nav-link" data-toggle="dropdown" href="#" role="button"
                                            aria-haspopup="true" aria-expanded="false">Correspondencia </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="correspondenciadia.php">del día</a>
                                            <a class="dropdown-item" href="correspondencia.php">Historial</a>
                                        </div>

                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link " data-toggle="dropdown" href="#" role="button"
                                            aria-haspopup="true" aria-expanded="false">Catálogos</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="dependencias.php">Dependencias</a>
                                            <a class="dropdown-item" href="areasecoem.php">Areas SECOEM</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link " data-toggle="dropdown" href="#" role="button"
                                            aria-haspopup="true" aria-expanded="false">Consultas</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="c_general.php">General</a>
                                            <a class="dropdown-item" href="c_pfecha.php">Por fecha</a>
                                            <a class="dropdown-item" href="c_prangofolios.php">Por folio</a> 

                                        </div>
                                    </li>
                                    <!-- <li class="nav-item dropdown">
                                        <a class="nav-link " data-toggle="dropdown" href="#" role="button"
                                            aria-haspopup="true" aria-expanded="false">Reportes</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="r_general.php">General</a>
                                            <a class="dropdown-item" href="r_pfecha.php">Por fecha</a>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2">
                            <div><img src="images/siscoHorizontal.png" width="90%" alt=""></div>
                            <!--<h3>Sistema de Correspondencia de la SECOEM</h3>-->
                        </div>
                    </div>
                </nav>
            </div>
        </header>
