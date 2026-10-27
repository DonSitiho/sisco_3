<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if(isset($_SESSION['nombre'])){
	 $Usuario = $_SESSION['nombre'];
}else{
 header('Location: ../');//Aqui lo redireccionas al lugar que quieras.
     die() ;

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
<?php
	include('../php/fecha_actual.php');
	?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

   <!-- iconos de bootstrap -->
     <link href="../bootstrap/icons/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <!-- Bootstrap core CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../bootstrap/css/simple-sidebar.css" rel="stylesheet">
 <!-- Custom styles for this template-->
  <link href="../bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
<!-- graficas -->
  <script src="../Highcharts-7.1.1/code/highcharts.js"></script>
<script src="../Highcharts-7.1.1/code/highcharts-3d.js"></script>
<script src="../Highcharts-7.1.1/code/modules/exporting.js"></script>
<script src="../Highcharts-7.1.1/code/modules/export-data.js"></script>
   <script src="../bootstrap/js/myjava.js"></script>
   <!-- fin graficas -->
 <!-- NAVBAR -->

 <script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/myjava.js"></script>
<script src="../bootstrap/js/totales.js"></script>
<script src="../graficas/graficas.min.js"></script>
 </head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
       
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon ">
          <img src="../img/figura2.png" width="37px">
        </div>
        <div class="sidebar-brand-text mx-3">SISTEMA-REPORTES<sup>2020</sup></div>
      </a>
      
     


      <!-- Divider -->
    <!--  <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
     <!-- <li class="nav-item active">
        <a class="nav-link" href="../vistas/PuntoVenta.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Punto de Venta</span></a>
      </li>-->

      <!-- Divider -->
    <!--  <hr class="sidebar-divider">-->
      
      

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="../vistas/PaginaInicio.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Inicio</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
     

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-table"></i>
          <span>Reportes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tipos de Reportes:</h6>
             <a class="collapse-item" href="../vistas/Reportes_General.php">General</a>
            <a class="collapse-item" href="Reportes.php">Declaraciones</a>
            <a class="collapse-item" href="../vistas/Reportes_Dep.php">Dependencias</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="../vistas/Graficas.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Graficas</span></a>
      </li>

      <!-- Divider -->
      

      <!-- Heading -->
       <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="../vistas/cumplimiento_Dep.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Cumplimiento Dep</span></a>
          
          <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="../vistas/declaraciones.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Declaraciones</span></a>
          
            <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="../vistas/Reporte_Total.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Padrón completo</span></a>

      <!-- Nav Item - Charts -->
       <!-- Nav Item - Pages Collapse Menu -->
    
       <hr class="sidebar-divider">
        <li class="nav-item">
        <a class="nav-link" href="../php/Cerrar_sesion.php">
          <i class="fa fa-power-off"></i>
          <span>Cerrar Sesión</span></a>
      <!-- <hr class="sidebar-divider">
      <div class="sidebar-heading">
       XXXXX
      </div>

      <!-- Nav Item - Tables -->
     <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Reportes</span></a>

      </li>-->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
       <center> <button class="rounded-circle border-0" id="sidebarToggle"></button></center>
      </div>

    </ul>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
    
      <div class="container-fluid">
        
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
   
  </head>
  <body>
   
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm" style="">
  <h5 class="my-0 mr-md-auto font-weight-normal">Bienvenido: <?php echo($_SESSION['nombre']) ?></h5>
  <nav class="my-2 my-md-0 mr-md-3" >
    <a class="p-2 text-dark" href="#">Fecha de Acceso: <?php echo($fecha_actual) ?></a>
    <a class="p-2 text-dark" href="../php/Cerrar_sesion.php">
          <i class="fa fa-power-off"></i>
          </a>
    <!--<a class="p-2 text-dark" href="#">Enterprise</a>
    <a class="p-2 text-dark" href="#">Support</a>
    <a class="p-2 text-dark" href="#">Pricing</a>-->
  </nav>
 <!-- <a class="btn btn-outline-primary" href="#">Sign up</a>-->
</div>