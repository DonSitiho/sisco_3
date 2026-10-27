<!DOCTYPE html>
<?php
include('../../ajax/conexion.php');

header('Content-Type: text/html; charset=UTF-8');
session_start();

if (isset($_SESSION['nombre'])) {
  $id_direccion  = $_SESSION['id_direccion'];
  $Usuario       = $_SESSION['nombre'];
  $nom_direccion = $_SESSION['nombre_direccion'];
  $id_usuario    = $_SESSION['id_usuario'];
  $imagen        = $_SESSION['ruta'];
  $subdireccion  = $_SESSION['subdireccion'];
  $depto         = $_SESSION['depto'];
  $oficina       = $_SESSION['oficina'];
  $nivelAcceso   = $_SESSION['nivel_acceso'];
  $NombreAcceso  = $_SESSION['nombre_acceso'];
  $activo  = $_SESSION['activo'];
  //$cambioContraseña = $_SESSION['forzar_cambio_password'];
  //echo "DIRECCIÓN: ".$id_direccion."<br>";
  //echo "SUBDIRECCIÓN: ".$subdireccion."<br>";
  // echo "DEPARTAMENTO: ".$depto."<br>";
  // echo "OFICINA: ".$oficina."<br>";

  /* $Depdencencia = $_SESSION['id_direccion'];
	 $Departamento = $_SESSION['id_usuario'];
	$nombre_usr = $_SESSION[ 'nombre_usr' ];*/
} else {
  header('Location: ../../'); //Aqui lo redireccionas al lugar que quieras.
  die();
}

?>
<?php
//Dcicion Perrona xD
if ($oficina > 0) { // oficina
  //echo "entro".$oficina;
  $imprimir_pantalla = "Es un departamento";
  $where = "WHERE id_direcciones = '$id_direccion' AND  FIND_IN_SET('$oficina', id_oficina) AND id_estatus1 <> 1";
  //echo $where;

} elseif ($depto > 0) { // Departamento
  $imprimir_pantalla = "Es un departamento";

  $where = "WHERE id_direcciones = '$id_direccion' AND FIND_IN_SET('$depto', id_departamento) AND id_estatus1 <> 1";
} elseif ($subdireccion > 0) { // Sub direccion o OIC

  $where = "WHERE id_direcciones = '$id_direccion' AND FIND_IN_SET('$subdireccion', id_sub_oic) AND id_estatus1 <> 1";
} else { //Direccion

  $where = " WHERE id_direcciones = '$id_direccion' AND id_estatus1 <> 1";
}
$consultaTotalCorresp = mysqli_query($conexion, "SELECT id_estatus1 FROM `datos_correspondencia` $where ");
$result_total = mysqli_num_rows($consultaTotalCorresp);
$obj_estatus = ['bandeja' => 0, 'seguimiento' => 0, 'finalizados' => 0];
while ($registros = mysqli_fetch_assoc($consultaTotalCorresp)) {
  $id_estatus = $registros['id_estatus1'];
  switch ($id_estatus) {

    case 2:
      $obj_estatus['bandeja']++;
      break;
    case 3:
      $obj_estatus['seguimiento']++;
      break;
    case 6:
      $obj_estatus['finalizados']++;
      break;
  }
}
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISCO</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="../../plantilla/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="../../plantilla/vendor/font-awesome/css/font-awesome.min.css">
  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="../../plantilla/css/fontastic.css">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="../../plantilla/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="../../plantilla/css/custom.css">
  <link rel="stylesheet" href="../../js/multiselect/multi-select.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="../../images/header-icon.png">
  <script src="../../js/sweetalert/sweetalert.min.js"></script>

  <link rel="shortcut icon" href="../../css/custom.css">
  <link rel="stylesheet" href="../../css/card.css">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <link rel="stylesheet" href="../../css/css/bootstrap-multiselect.css">
  <link rel="stylesheet" href="../../css/estilos-crm.css">
  
  <!-- JQuery -->
  <!--
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  -->
  <script src="../../js/jquery-3.7.1.min.js"></script>
  
  <!-- Alertas Swal2 -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  -->
  
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="../../plantilla/vendor/DataTables/css/datatables.min.css">
  <!-- DataTables JS -->
  <script src="../../plantilla/vendor/DataTables/js/datatables.min.js"></script>
  
  <!-- Iconos bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

  <div class="page">
    <!-- Main Navbar-->
    <header class="header">
      <!-- <div class="conteiner-fluid" style="background-image:url(../../images/fondoPerfil.jpg) !important; height: 100% !important; background-size: cover;
   height: 100%;
   width: 100% ;
   text-align: center; position: absolute;  top: 40px; opacity: 0.9; " > </div> -->
      <nav class="navbar">

        <!-- Search Box-->
        <div class="search-box">
          <button class="dismiss"><i class="icon-close"></i></button>
          <form id="searchForm" action="#" role="search">
            <input type="search" placeholder="What are you looking for..." class="form-control">
          </form>
        </div>
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Navbar Header-->
            <div class="navbar-header">
              <!-- Navbar Brand --><a href="#" class="navbar-brand d-none d-sm-inline-block">
                <div class="brand-text d-none d-lg-inline-block"><span>SISCO - </span>SECOEM<strong> </strong></div>
                <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
              </a>
              <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

              <!-- Search-->
              <!-- <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>-->
              <!-- Notifications-->
              <!--    <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red badge-corner">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>10 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications </strong></a></li>
                  </ul>
                </li>-->
              <!-- Messages                        -->
              <!-- <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange badge-corner">10</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages   </strong></a></li>
                  </ul>
                </li>-->
              <!-- Languages dropdown    -->

              <!-- Logout    -->
              <li class="nav-item"><a href="../../ajax/General/Cerrar_sesion.php" class="nav-link logout"> <span class="d-none d-sm-inline">Cerrar Sesión</span><i class="fa fa-sign-out"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="page-content d-flex align-items-stretch">

      <!-- Side Navbar -->
      <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <a href="perfil_usuario.php">
            <div class="avatar" style=""><img src="<?php echo ($imagen) ?>" style="margin-right: 3px !important;
            width: 100% !important;
    height: 100% !important;
    border-radius: 900px !important;
    overflow: hidden !important;
border: 2px solid green !important;" alt="..." class="img-fluid rounded-circle img-responsive"></div>
          </a>
          <div class="title">
            <h1 class="h4 text-center"><?php echo ($Usuario); ?></h1><!-- meter nombre de usuario -->
            <p class="text-center"><?= $NombreAcceso ?></p><!-- meter Privilegios de usuario -->

          </div>
        </div>