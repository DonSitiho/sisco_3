<?php
$collapse = (int) ($_GET['collapse'] ?? 0);
$li       = (int) ($_GET['li'] ?? 0);

$nivelAcceso   = $nivelAcceso   ?? 0;
$subdireccion  = $subdireccion  ?? 0;
$id_direccion  = $id_direccion  ?? 0;
$depto         = $depto         ?? 0;
$activo        = $activo        ?? 0;
$obj_estatus   = $obj_estatus   ?? [];
$nom_direccion = $nom_direccion ?? '';

$dasboard    = '';
$perfil      = '';
$usuarios    = '';
$bandeja     = '';
$seguimiento = '';
$finalizado  = '';
$historial   = '';
$reporte     = '';
$ofiInterno  = '';
$class       = 'collapse';
$expanded    = 'false';
$class2      = 'collapse';
$expanded2   = 'false';


//Funcionalidad y color para menu lateral
if ($collapse === 0) {
  $dasboard = ($li === 1) ? 'active' : '';
  $perfil   = ($li === 2) ? 'active' : '';
  $usuarios = ($li === 3) ? 'active' : '';
}

//collapse Correspondencia Externa
if ($collapse === 1) {

  $class       = '';
  $expanded    = 'true';
  $bandeja     = ($li === 1) ? 'active' : '';
  $seguimiento = ($li === 2) ? 'active' : '';
  $finalizado  = ($li === 3) ? 'active' : '';
  $historial   = ($li === 4) ? 'active' : '';
  $reporte     = ($li === 5) ? 'active' : '';
} 

//collapse Correspondencia interna
if ($collapse === 2) {

  $class2     = '';
  $expanded2  = 'true';
  $ofiInterno = ($li === 1) ? 'active' : '';
} 

?>


<ul class="list-unstyled">

  <?php
  if ($nivelAcceso == 2 && $subdireccion == 0) {
    echo ' <!-- Sidebar Navidation Menus--><span class="heading">Menú</span>';
    echo '<li class="' . $dasboard . '"><a href="dashboard.php?collapse=0&li=1"> <i class="icon-home"></i>HOME </a> </li>';
  }
  ?>
  <!-- Sidebar Navidation Menus--><span class="heading">Correspondencia Externa</span>
  <li><a href="#CorrespExterna" aria-expanded="<?= $expanded ?>" data-toggle="collapse"> <i class="icon-interface-windows"></i>Corresp. Externa </a>
    <ul id="CorrespExterna" class="<?= $class ?> list-unstyled ">
      <li class="<?= $bandeja ?>"><a href="index.php?collapse=1&li=1"> Bandeja Principal <span class="badge badge-danger"><?= htmlspecialchars((string) ($obj_estatus['bandeja'] ?? 0)) ?></span></a> </li>
      <li class="<?= $seguimiento ?>"><a href="corr_seguimiento.php?collapse=1&li=2"> En Seguimiento <span class="badge badge-danger"><?= htmlspecialchars((string) ($obj_estatus['seguimiento'] ?? 0)) ?></span></a>
      <li class="<?= $finalizado ?>"><a href="corr_finalizada.php?collapse=1&li=3">Finalizada <span class="badge badge-danger"><?= htmlspecialchars((string) ($obj_estatus['finalizados'] ?? 0)) ?></span></a></li>
      <?php
      if ($id_direccion == 2 && $nivelAcceso == 2) {
        echo  '<li class="' . $historial . '"><a href="historial.php?collapse=1&li=4"> Historial </a></li> ';
      }
      ?>
      <li class="<?= $reporte ?>"><a href="corr_consulta.php?collapse=1&li=5">Reporte / consulta</a></li>
    </ul>
  </li>

  <!-- CORRESPONDENCIA INTERNA -->
  <!-- Sidebar Navidation Menus--><span class="heading">Correspondencia Interna</span>
  <li><a href="#CorrespInterna" aria-expanded="<?= $expanded2 ?>" data-toggle="collapse"> <i class="icon-interface-windows"></i>Corresp. Interna </a>
    <ul id="CorrespInterna" class="<?= $class2 ?> list-unstyled ">
      <li class="<?= $ofiInterno ?>"><a href="ofi_internos.php?collapse=2&li=1"> <i class="icon-padnote"></i>Oficios y/o Tarjetas de conocimiento </a></li>
    </ul>
  </li>
  </li>



  <!-- EXTRAS -->

  <span class="heading">Configuración</span>
  <li class="<?= $perfil ?>"><a href="perfil_usuario.php?collapse=0&li=2"> <i class="icon-user"></i>Perfil </a></li>
  <?php
  if ($id_direccion == 8888 && $nivelAcceso == 2 && $subdireccion == 0 && $depto == 0 && $activo == 1) {
    echo ' <li class="' . $usuarios . '"><a href="usuarios.php?collapse=0&li=3"> <i class="icon-user"></i> Usuarios </a></li>';
  } elseif (($subdireccion == 0 || $depto == 0) && $id_direccion != 8888 && $nivelAcceso == 2 && $activo == 1) {
    echo ' <li class="' . $usuarios . '"><a href="usuarios.php?collapse=0&li=3"> <i class="icon-user"></i> Usuarios </a></li>';
  }
  ?>
  <li> <a href="../../ajax/General/Cerrar_sesion.php"> <i class="icon-close"></i>Cerrar Sesión </a></li>

</ul>

</nav>



<!-- nombre de la direccion -->
<div class="content-inner">

  <!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <h2 class="no-margin-bottom text-center "><?= htmlspecialchars((string) $nom_direccion) ?> </h2>
    </div>
  </header>