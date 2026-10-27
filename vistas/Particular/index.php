<?php include_once("../../plantillas/Particular/header.php");
include("../../php/conexion.php");
$cant_corr = mysqli_query($conexion, "SELECT tipo_oficio FROM datos_correspondencia");
$c_t = 0;
$c_c = 0;
$c_o = 0;
while ($row_corr1 = mysqli_fetch_assoc($cant_corr)) {
  $tipo_doc = $row_corr1['tipo_oficio'];
  if ($tipo_doc == 0) {
    $c_o++;
  } else {
    $c_c++;
  }
  $c_t++;
}

?>
<!-- nav bar ******************************************************** nav nav**************-->


<ul class="list-unstyled">
  <!-- Sidebar Navidation Menus--><span class="heading">Usuario</span>
  <li class=""><a href="perfil_usuario.php"> <i class="icon-user"></i>Perfil </a></li>
  <!-- Sidebar Navidation Menus--><span class="heading">Menú-Correspondencia</span>
  <li class="active"><a href="index.php"> <i class="icon-home"></i>Principal </a></li>
  <li><a href="corr_autorizada.php"> <i class="fa fa-legal"></i>Autorizada </a></li>
  <li class=""><a href="corr_finalizado.php"> <i class="fa fa-address-card"></i>Finalizados </a></li>
  <li class=""><a href="../Direcciones/historial.php"> <i class="fa fa-mail"></i>Historial </a></li>
  <li class=""><a href="estadisticas.php"> <i class="fa fa-area-chart"></i>Estadisticas </a></li>
  <!-- Sidebar Navidation Menus--><span class="heading">Oficios del titular</span>
  <li class=""><a href="oficios_titular.php"> <i class="fa fa-mail"></i>Oficios </a></li>
  <li class=""><a href="Ofi_internos.php"> <i class="fa fa-id-badge"></i>Oficios y/o Tarjetas de conocimiento </a></li>

  <!--   <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>-->

</ul><span class="heading">Extras</span>
<ul class="list-unstyled">
  <li> <a href="c_rpfecha_part.php"> <i class="fa fa-id-badge"></i>Reporte por fecha </a></li>
  <!-- <li> <a href="c_prangofolios.php"> <i class="material-icons">date_range</i>Por folios </a></li> -->
</ul>
<ul class="list-unstyled">
  <li> <a href="../../ajax/General/Cerrar_sesion.php"> <i class="icon-close"></i>Cerrar Sesión </a></li>

</ul>
</nav>

<div class="content-inner">
  <!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <h2 class="no-margin-bottom"><?php echo ($nom_direccion); ?></h2>
    </div>
  </header>
  <!-- nav bar ******************************************************** nav nav**************-->
  <!-- ****************** hasta aqui llega el header ******************************************************   -->
  <!-- Breadcrumb-->
  <div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Principal</a></li>

    </ul>
  </div>

  <section class="dashboard-counts no-padding-bottom" style="margin-top: -35px !important;">
    <div class="container-fluid">
      <div class="row bg-white has-shadow" style="border-radius: 50px !important;">
        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="item d-flex align-items-center">
            <div class="icon bg-violet"><i class="icon-user"></i></div>
            <div class="title"><span>Total<br>Corresp.</span>
              <div class="progress">
                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
              </div>
            </div>
            <div class="number"><strong class="num"><?php echo ($c_t); ?></strong></div><!--meter total de correspondencia-->
          </div>
        </div>
        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="item d-flex align-items-center">
            <div class="icon bg-green"><i class="icon-bill"></i></div>
            <div class="title"><span>Corresp.<br>Titular</span>
              <div class="progress">
                <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
              </div>
            </div>
            <a href="corr_titular.php">
              <div class="number"><strong class="num"><?php echo ($c_o); ?></strong></div>
            </a><!--meter titular de correspondencia-->
          </div>
        </div>
        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="item d-flex align-items-center">
            <div class="icon bg-red"><i class="icon-padnote"></i></div>
            <div class="title"><span class="text-sm">Corresp.<br>Conoci.</span>
              <div class="progress">
                <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
              </div>
            </div>
            <div class="number"><strong class="num"><?php echo ($c_c); ?></strong></div><!--meter copias de correspondencia-->
          </div>
        </div>

        <!-- Item -->
        <div class="col-xl-3 col-sm-6">
          <div class="bar-chart  bg-white">

            <canvas id="barChartHome"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="tables" style="margin-top: -35px !important;">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="table-wrapper">

          <div class="table-title">
            <div class="row card-header ">
              <div class="col-md-8">
                <div class="d-flex align-items-center">
                  <h3 class="h4">Correspondencia Pendiente</h3>

                </div>
              </div>
              <div class='col-md-4 pull-right'>

                <div id="custom-search-input">
                  <div class="input-group col-md-12">

                    <div class="form-group-material">
                      <input type="text" id="q" onkeyup="load(1);" class="input-material">
                      <label for="register-username" class="label-material">Buscar</label>
                    </div>
                    <span class="input-group-btn">
                      <button class="btn btn-info btn-rounded" type="button" onclick="load(1);" style="border-radius: 50px !important;">
                        <i class="fa fa-search search-icon"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>





          <div class='clearfix'></div>

          <div id="loader"></div><!-- Carga de datos ajax aqui -->

          <div id="resultados"></div><!-- Carga de datos ajax aqui -->
          <div class='outer_div'></div><!-- Carga de datos ajax aqui -->



        </div>
      </div>
    </div>
  </section>
  <?php require_once("../../html/modal_cambiar_password.php"); ?>
  <?php if (!empty($_SESSION['password_actualizado'])): ?>
    <?php unset($_SESSION['password_actualizado']); ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {

        // Ocultar la modal si aún estuviera visible
        var modalEl = document.getElementById('cambiarPassword');
        if (modalEl) {
          var modal = bootstrap.Modal.getInstance(modalEl);
          if (modal) modal.hide();
        }

        // Mostrar Swal de éxito y redirigir
        Swal.fire({
          icon: 'success',
          title: '¡Contraseña actualizada!',
          text: 'Tu contraseña se guardó correctamente.',
          confirmButtonText: 'Continuar',
          confirmButtonColor: '#2563eb',
          allowOutsideClick: false,
          allowEscapeKey: false
        });
      });
    </script>
  <?php endif; ?>

  <!-- Page Footer-->
  <?php include("../../plantillas/Particular/foother.php"); ?>
  <?php include("../../ajax/Particular/chart_principal.php"); ?><!-- este va en el index -->
  <?php include("../../html/Particular/modal_view_corresp.php"); ?><!-- este va en el index -->
  <script src="../../js/Particular/controlador.js"></script><!-- este va en el index -->

  <script src="../../js/jquery.counterup.min.js"></script><!-- animacion contador --><!-- este va en el index -->
  <script src="../../js/jquery.waypoints.js"></script><!-- animacion contador --><!-- este va en el index -->
  <!-- este va en el index contador-->
  <script>
    $('.num').counterUp({
      delay: 20,
      time: 2000
    });
  </script>