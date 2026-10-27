<?php
session_start();
include_once('../../conexion/conexion.php');

header('Content-Type: text/html; charset=UTF-8');

$id_direccion = $_SESSION['id_direccion'];

if (isset($_SESSION['nombre']) && $id_direccion == 0) {

  $Usuario = $_SESSION['nombre'];
  $nom_direccion = $_SESSION['nombre_direccion'];
  $id_usuario = $_SESSION['id_usuario'];
  $imagen = $_SESSION['ruta'];
  /* $Depdencencia = $_SESSION['id_direccion'];
	$Departamento = $_SESSION['id_usuario'];
	$nombre_usr = $_SESSION[ 'nombre_usr' ];*/

  $errores = $_SESSION['errores'] ?? [];
  $datos   = $_SESSION['datos']   ?? [];
  $exito   = $_SESSION['exito']   ?? '';
  // LIMPIAR SESSION
  unset($_SESSION['errores'], $_SESSION['datos'], $_SESSION['exito']);
} else {
  header('Location: index.php'); //Aqui lo redireccionas al lugar que quieras.
  die();
}

$consulta_user = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'");
$rows_user = mysqli_fetch_assoc($consulta_user);
$nombre_user = $rows_user['nombre_usr'];
$app = $rows_user['app'];
$apm = $rows_user['apm'];
$nick_name = $rows_user['nick_name'];

?>
<!DOCTYPE html>
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
</head>

<body>
  <div class="page">
    <!-- Main Navbar-->
    <header class="header">
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
                <div class="brand-text d-none d-lg-inline-block"><span>SISCO -</span><strong> SECOEM</strong></div>
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
      <nav class="side-navbar ">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar" style=""><img src="<?php echo ($imagen) ?>" style="width: 93% !important;
    height: 93% !important;
    border-radius: 900px !important;
    overflow: hidden !important;
  
border: 2px solid green !important;" alt="..." class="img-fluid rounded-circle img-responsive"></div>
          <div class="title">
            <h1 class="h4"><?php echo ($Usuario); ?></h1>
            <p>Capturista</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Perfil</span>
        <ul class="list-unstyled">
          <li class="active"><a href="#"> <i class="icon-user"></i>Perfil </a></li>
          <!-- Sidebar Navidation Menus--><span class="heading">Principal</span>
          <li class=""><a href="../../correspondenciadia.php"> <i class="icon-home"></i>Inicio </a></li>
          <span class="heading">Correspondencia</span>
          <li class=""><a href="../../correspondenciadia.php"> <i class="icon-mail"></i>Del dia </a></li>
          <li class=""><a href="../../correspondencia.php"> <i class="icon-mail"></i>Historiala </a></li>
          <span class="heading">Catálogos</span>
          <li class=""><a href="../../dependencias.php"> <i class="icon-interface-windows"></i>Dependencias </a></li>
          <li class=""><a href="../../areasecoem.php"> <i class="icon-interface-windows"></i>Areas internas </a></li>
          <!-- <li><a href="estadistica.php"> <i class="icon-picture"></i>Estadística </a></li> -->
          <span class="heading">Consultas</span>
          <li class=""><a href="../../c_general.php"> <i class="icon-padnote"></i>General </a></li>
        </ul>


      </nav>

      <div class="content-inner">
        <!-- Page Header-->
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom"><?php echo ($nom_direccion); ?></h2>
          </div>
        </header>
        <!-- ******************************************      hasta aqui llega el header *************************-->
        <br>
        <section class="client no-padding-top">
          <div class="conteiner-fluid" style="background-image:url(images/fondo.gif) !important; height: 100% !important; background-size: cover;
   height: 100%;
   width: 100% ;
   text-align: center; position: absolute;  top: 40px; opacity: 0.9;  filter: blur(6px);"> </div>
          <div class="container-fluid" style="position: absolute; left: 0.5%; top: 13%;">
            <div class="row">
              <!-- Work Amount  -->
              <div class="col-lg-8">
                <div class="work-amount card" style="border-radius: 25px !important">
                  <div class="card-close">
                    <div class="dropdown">
                      <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                      <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3>Datos del Usuario</h3><small></small>
                    <?php if ($exito !== ''): ?>
                      <div class="alert alert-success exito" role="alert">
                        <?= htmlspecialchars($exito) ?>
                      </div>
                    <?php endif; ?>

                    <?php if (isset($errores['general'])): ?>
                      <p style="color: red;"><?= htmlspecialchars($errores['general']) ?></p>
                    <?php endif; ?>

                    <br>
                    <form action="../../ajax/Oficialia/perfil_usr.php" method="POST">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group-material">
                            <input type="text" name="id_user" value="<?php echo ($id_usuario); ?>" hidden="">
                            <input id="nombre_usr" type="text" name="nombre_usr" class="input-material" value="<?= htmlspecialchars($datos['nombre_usr'] ?? $rows_user['nombre_usr']) ?>">
                            <label for="nombre_usr" class="label-material">Nombre</label>
                            <?php if (isset($errores['nombre_usr'])): ?>
                              <span class="error" style="color: red; font-size: 13px; display: block; margin-top: 5px;">
                                <?= $errores['nombre_usr'] ?>
                              </span>
                            <?php endif; ?>

                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group-material">
                            <input id="app_usr" type="text" name="app_usr" required class="input-material" value="<?= htmlspecialchars($datos['app'] ?? $rows_user['app']) ?>"
                              <label for="app_usr" class="label-material">Apellido Paterno</label>
                            <?php if (isset($errores['app_usr'])): ?>
                              <span class="error" style="color: red; font-size: 13px; display: block; margin-top: 5px;">
                                <?= $errores['app_usr'] ?>
                              </span>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group-material">
                            <input id="apm_usr" type="text" name="apm_usr" required class="input-material" value="<?= htmlspecialchars($datos['apm'] ?? $rows_user['apm']) ?>"
                              <label for="apm_usr" class="label-material">Apellido Materno</label>
                            <?php if (isset($errores['apm_usr'])): ?>
                              <span class="error" style="color: red; font-size: 13px; display: block; margin-top: 5px;">
                                <?= $errores['apm_usr'] ?>
                              </span>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group-material">
                            <input id="usuario" type="text" name="usuario" required class="input-material" disabled value="<?php echo ($nick_name); ?>"
                              <label for="usuario" class="label-material">Usuario</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group-material">
                            <input id="contraseña_usr" type="password" name="contraseña_usr" class="input-material" value="">
                            <label for="contraseña_usr" class="label-material">Contraseña</label>
                            <?php if (isset($errores['contraseña_usr'])): ?>
                              
                              
                            <?php endif; ?>
                          </div>
                        </div>


                      </div>
                      <center><button class="btn btn-sm btn-primary" style="border-radius: 20px !important;">Actualizar Datos</button></center>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Client Profile -->
              <div class="col-lg-4">
                <div class="client card" style="border-radius: 25px !important">
                  <div class="card-close">
                    <div class="dropdown">
                      <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                      <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
                    </div>
                  </div>
                  <div class="card-body text-center">
                    <div class="client-avatar"><img src="<?php echo ($imagen); ?>" alt="..." class="img-fluid rounded-circle" style="width: 93% !important;
    height: 93% !important;
    border-radius: 900px !important;
    overflow: hidden !important;">
                      <div class="status bg-green"></div>
                    </div>
                    <div class="client-title">
                      <h3><?php echo ($nombre_user . ' ' . $app); ?></h3><span>Administrador</span><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Cambiar imagen</a>
                    </div>
                    <div class="collapse" id="collapseExample">
                      <div class="card card-body">
                        <form method="post" action="../../php/Cambiar_imagen.php" enctype="multipart/form-data">
                          <div class="form-group">


                            <input type="file" class="form-control font-weight-bold" name="imagen"
                              id="doc_resp" required>
                          </div>

                          <input type="submit" class="btn btn-primary" style="border-radius: 25px !important" value="Cambiar">
                        </form>
                      </div>
                    </div>
                    <!-- <div class="client-info">
                        <div class="row">
                          <div class="col-4"><strong>20</strong><br><small>Photos</small></div>
                          <div class="col-4"><strong>54</strong><br><small>Videos</small></div>
                          <div class="col-4"><strong>235</strong><br><small>Tasks</small></div>
                        </div>
                      </div>-->
                    <!-- <div class="client-social d-flex justify-content-between"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a><a href="#" target="_blank"><i class="fa fa-twitter"></i></a><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a><a href="#" target="_blank"><i class="fa fa-instagram"></i></a><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></div>-->
                  </div>
                </div>
              </div>
              <!-- Total Overdue             -->

            </div>
          </div>
        </section>

        <footer class="main-footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <p>Secretaría de Contraloría del estado de Michoacán &copy; 2018-2021</p>
              </div>
              <div class="col-sm-6 text-right">
                <p>Desarrollado por <a href="http://www.secoem.michoacan.gob.mx/" class="external">Depto. Informática</a></p>
                <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <!-- JavaScript files-->

  <script src="../../plantilla/vendor/jquery/jquery.min.js"></script>
  <script src="../../plantilla/vendor/popper.js/umd/popper.min.js"> </script>
  <script src="../../plantilla/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="../../plantilla/vendor/chart.js/Chart.min.js"></script>
  <script src="../../plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
  <script src="../../js/multiselect/jquery.multi-select.js"></script>
  <script src="../../js/multiselect/jquery.slimscroll.js"></script>
  <!-- Main File-->

  <script src="../../plantilla/js/front.js"></script>
  <script type="10ebbf4666eff8b7847248c9-text/javascript">
    $('#my-select, #pre-selected-options').multiSelect()
  </script>
  <script type="10ebbf4666eff8b7847248c9-text/javascript">
    $('#callbacks').multiSelect({
      afterSelect: function(values) {
        alert("Select value: " + values);
      },
      afterDeselect: function(values) {
        alert("Deselect value: " + values);
      }
    });
  </script>
  <script type="10ebbf4666eff8b7847248c9-text/javascript">
    $('#keep-order').multiSelect({
      keepOrder: true
    });
  </script>

  <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="10ebbf4666eff8b7847248c9-|49" defer=""></script>

</body>

</html>
../../