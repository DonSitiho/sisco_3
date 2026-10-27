<?php include("../../plantillas/Particular/header.php");
include_once("../../php/conexion.php");
$cant_corr = mysqli_query($conexion, "SELECT tipo_oficio, id_estatus1  FROM datos_correspondencia");
$c_t = 0;
$c_c = 0;
$c_o = 0;
$c_f = 0;
while ($row_corr1 = mysqli_fetch_assoc($cant_corr)) {
  $tipo_doc = $row_corr1['tipo_oficio'];
  $estatus = $row_corr1['id_estatus1'];
  if ($tipo_doc == 0) {
    $c_o++;
  } else {
    $c_c++;
  }
  if ($estatus == 6) {
    $c_f++;
  }
  $c_t++;
}
?>
<!-- *************************** menu *****************-->


<ul class="list-unstyled">
  <!-- Sidebar Navidation Menus--><span class="heading">Usuario</span>
  <li class=""><a href="perfil_usuario.php"> <i class="icon-user"></i>Perfil </a></li>
  <!-- Sidebar Navidation Menus--><span class="heading">Menú</span>
  <li><a href="index.php"> <i class="icon-home"></i>Principal </a></li>
  <li class=""><a href="corr_autorizada.php"> <i class="fa fa-legal"></i>Autorizada </a></li>
  <li class=""><a href="corr_finalizado.php"> <i class="fa fa-address-card"></i>Finalizados </a></li>
  <li class=""><a href="../Direcciones/historial.php"> <i class="fa fa-mail"></i>Historial </a></li>
  <li class="active"><a href="estadisticas.php"> <i class="fa fa-area-chart"></i>Estadisticas </a></li>
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
  <!-- ********************************** meni *****************-->
  <!-- Breadcrumb-->
  <div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
      <li class="breadcrumb-item active">Estadisticas</li>
      <li>
        <!-- collapse -->
      </li>
    </ul>
  </div>

  <section class="dashboard-counts no-padding-bottom" style="margin-top: -35px !important;">
    <div class="container-fluid">
      <div class="row bg-white has-shadow">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Global</a>
            <?php
            $consultaDirecciones = mysqli_query($conexion, "Select * from direcciones_secoem");
            //var_dump ( $consultaDirecciones->num_rows);
            //$c =1;
            while ($row =  mysqli_fetch_array($consultaDirecciones)) {
              //echo $row['id_direccion'];
              echo ' <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="recuperaradio(' . $row['id_direccion'] . ');">' . $row['siglas'] . '</a>';


              //$c++;
            }
            ?>

          </div>
        </nav>

      </div>
    </div>
  </section>
  <!-- Dashboard Header Section    -->
  <section class="dashboard-header" style="margin-top: -35px !important;">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="container-fluid">
          <div class="row">
            <!-- Statistics -->
            <div class="statistics col-lg-3 col-12">
              <div class="statistic d-flex align-items-center bg-white has-shadow">
                <div class="icon bg-secondary"><i class="fa fa-envelope"></i></div>
                <div class="number"><strong class="num"><?php echo ($c_t); ?></strong><br><small>Corresp. Total</small></div>
              </div>

              <div class="statistic d-flex align-items-center bg-white has-shadow">
                <div class="icon bg-green"><i class="fa fa-envelope-o"></i></div>
                <a href="corr_titular.php">
                  <div class="number"><strong class="num"><?php echo ($c_o); ?></strong><br><small>Secretario</small></div>
                </a>
              </div>

              <div class="statistic d-flex align-items-center bg-white has-shadow">
                <div class="icon bg-orange"><i class="fa fa-envelope-square"></i></div>
                <div class="number"><strong class="num"><?php echo ($c_c); ?></strong><br><small>Conocimiento Secretario</small></div>
              </div>
              <div class="statistic d-flex align-items-center bg-white has-shadow">
                <div class="icon bg-primary"><i class="fa fa-envelope-open"></i></div>
                <div class="number"><strong class="num"><?php echo ($c_f); ?></strong><br><small>C. Finalizadas</small></div>
              </div>
            </div>
            <!-- Line Chart            -->
            <div class="chart col-lg-9 col-12">
              <div class="bar-chart-example card">
                <div class="card-close">
                  <div class="dropdown">
                    <button type="button" id="closeCard6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                    <div aria-labelledby="closeCard6" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                  </div>
                </div>
                <div class="card-header d-flex align-items-center">
                  <h3 class="h4">Estadisticas Generales</h3>
                </div>
                <div class="card-body">
                  <h3 class="text-center">Áreas SECOEM</h3>
                  <canvas id="barChartExample2"></canvas>
                </div>
                <div></div>
                <div class="card-body">
                  <H3 class="text-center">Órganos Internos de Control</H3>
                  <canvas id="barChartExample3"></canvas>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="container-fluid" id="graficas">

        </div>
      </div>

    </div>
  </section>
  <!-- Projects Section-->
  <!-- Page Footer-->

  <!-- JavaScript files-->
  <?php include("../../plantillas/Particular/foother.php");
  include('../../ajax/Particular/estadistica_global.php'); ?>



  <!-- Main File-->


  <script src="../../js/Particular/controlador_autorizada.js"></script><!-- va en esta pagina-->

  <script>
    function recuperaradio(id) {
      $.ajax({
        url: '../../ajax/Particular/estadistica_direcciones.php?id=' + id,
        success: function(data) {
          $('#graficas').html(data);
        }
      })
    }
  </script>

  <script src="../../js/jquery.counterup.min.js"></script><!-- animacion contador -->
  <!-- este va en el index -->
  <script src="../../js/jquery.waypoints.js"></script><!-- animacion contador -->
  <!-- este va en el index -->
  <script>
    $('.num').counterUp({
      delay: 20,
      time: 1000
    });
  </script>

  </body>

  </html>