<?php
     $nivel_usuario=$_SESSION['nivel_acceso'];
?>

<div class="page-content d-flex align-items-stretch">
    <nav class="side-navbar shrinked">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="../../images/avatar-9.jpg" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
                <h1 class="h4"><?php echo($Usuario);?></h1>
                <p></p>
            </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Perfil</span>
        <ul class="list-unstyled">
            <li class="active"><a href="../vistas/oficiosrio.php"> <i class="icon-home"></i>Inicio </a></li>
            <li><a href="#corresp" aria-expanded="false" data-toggle="collapse"> <i class="icon-mail"></i>Oficios </a>
                <ul id="corresp" class="collapse list-unstyled ">
                    <li><a href="#">del Día</a></li>
                    <li><a href="#">Historial</a></li>
                </ul>            
            </li>
           
        </ul>
        <span class="heading">Consultas</span>
        <ul class="list-unstyled">
            <li> <a href="../vistas/c_oficios_general.php"> <i class="icon-padnote"></i>General</a></li>
            <?php if($nivel_usuario<>4){ ?>
            <li> <a href="../vistas/ofi_internos.php"> <i class="icon-padnote text-info"></i>oficios/tarjetas</a></li>
            <?php } ?>
        </ul>
        <span class="heading">Catálogos</span>
        <ul class="list-unstyled">
            <li> <a href="dependencias2.php"> <i class="icon-padnote"></i>Dependencias</a></li>
        </ul>
    </nav>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-light bg-light navbartamano">
            <div class="row">

                <div class="col-md-12">
                <center><h1 class="text-black" style="color: black !important;">Oficina del Secretario Particular</h1></center>
                </div>
               
            </div>
        </nav>
    