<?php include_once('../../plantillas/Direcciones/header.php') ?>



<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>

<!-- ************************************** contenido ***************************** -->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">
                <h1 style="font-family: 'Dancing Script', cursive;">Bandeja principal</h1>
            </a></li>

    </ul>
</div>
<!-- banner informativo -->

<section class="dashboard-counts no-padding-bottom" style="margin-top: -35px !important;">
    <div class="container-fluid">
        <div class="row bg-white has-shadow" style="border-radius: 25px !important;">
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span> Total Corresp.<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                        </div>
                    </div>
                    <div class="number"><strong class="num"><?= $result_total ?></strong></div>
                    <!--meter total de correspondencia-->
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-blue"><i class="icon-bill"></i></div>
                    <div class="title"><span>Corresp.<br>bandeja</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-blue"></div>
                        </div>
                    </div>
                    <div class="number"><strong class="num"><?= $obj_estatus['bandeja'] ?></strong></div>
                    <!--meter titular de correspondencia-->
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-padnote"></i></div>
                    <div class="title"><span class="text-sm">Corresp. en seguimiento.</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                        </div>
                    </div>
                    <div class="number"><strong class="num"><?= $obj_estatus['seguimiento'] ?></strong></div>
                    <!--meter copias de correspondencia-->
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-padnote"></i></div>
                    <div class="title"><span class="text-sm">Corresp. finalizados.</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                    <div class="number"><strong class="num"><?= $obj_estatus['finalizados'] ?></strong></div>
                    <!--meter copias de correspondencia-->
                </div>
            </div>

            <!-- Item -->
            <!-- <div class="col-xl-3 col-sm-6">
                  <div class="bar-chart  bg-white">
                    
                    <canvas id="barChartHome"></canvas>
                  </div>
                </div> -->
        </div>
    </div>
</section>
<!-- fin de banner informativo -->

<section class="tables" style="margin-top: -35px !important;">

    <div class="container-fluid">

        <div class="col-md-12">
            <div class="table-wrapper">

                <div class="table-title">
                    <div class="row card-header " style="border-radius: 25px !important;">
                        <!-- <div class="row">
           	<div class="col-md-12">
                <div class="d-flex align-items-center">
                      <h3 class="h4">Correspondencia Asignada</h3>
                     
                     </div>
                    </div>
           </div> -->

                        <div class='col-md-12 pull-right'>

                            <div id="custom-search-input">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group-material" id="elige_area_oficio">
                                            <label for="q" class="" style="margin-buttom: 12px !important;">Direcciones:
                                            </label>
                                            <select class="mi-selector form-control mb-6" id="q" name="q" required
                                                class="input-material" onchange="load(1);"
                                                style="border-radius: 25px !important;">
                                                <option value="0">Selecciona un tipo de oficio ...</option>

                                                <option value="1" class="text-success">Original Titular</option>
                                                <option value="2" class="text-info">Conocimiento-Original</option>
                                                <option value="3">Copia-Titular</option>
                                                <option value="4">Conocimiento-Copia</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group-material">
                                            <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee su
                                                búsqueda ...
                                            </label>
                                            <input type="text" class="form-control" placeholder="Buscador en tiempo real " id="q1" name="q1" onkeyup="load(1);" style="border-radius: 25px !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card" style="margin-bottom: 0px !important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div class="">
                                        <!-- <input type="checkbox" class="custom-control-input" id="Original_titular" onkeyup="load(1);"> -->
                                        <label class="custom-control-label" for="Original_titular"><span class="badge badge-success">Original-Titular

                                            </span></label>
                                    </div><small class="text-center">Adjuntar Respuesta (Obligatorio)</small>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="custom-control custom-checkbox">
                                        <!-- <input type="checkbox" class="custom-control-input" id="Con_original" onkeyup="load(1);"> -->
                                        <label class="custom-control-label" for="Con_original"><span class="badge badge-info">Conocimiento-Original
                                            </span></label>
                                    </div> <small class="text-center">Opcion a adjuntar repuesta</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="custom-control custom-checkbox">
                                        <!-- <input type="checkbox" class="custom-control-input" id="copia_titular" onkeyup="load(1);"> -->
                                        <label class="custom-control-label" for="copia_titular"><span class="badge badge-light">Copia-Titular

                                            </span></label>
                                    </div><small class="text-center">De conocimiento</small>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="custom-control custom-checkbox">
                                        <!-- <input type="checkbox" class="custom-control-input" id="conoci_copia" onkeyup="load(1);"> -->
                                        <label class="custom-control-label" for="conoci_copia"><span class="badge badge-light">Conocimiento-Copia


                                            </span></label>
                                    </div><small class="text-center">De conocimiento</small>
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
    document.addEventListener('DOMContentLoaded', function () {

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
<?php include_once('../../plantillas/Direcciones/foother.php') ?>

<?php include("../../html/Direcciones/modal_view_corresp_original.php"); ?>
<!-- MODIFICAR -->
<?php include("../../html/Direcciones/modal_turnar_corresp.php"); ?>
<?php include("../../html/Direcciones/modal_view_corresp_copia.php"); ?>



<!-- MODIFICAR -->
<script src="../../js/Direcciones/controlador.js"></script><!-- MODIFICAR -->
<script src="../../js/Direcciones/combos.js"></script><!-- MODIFICAR -->


<script src="../../js/jquery.counterup.min.js"></script><!-- animacion contador -->
<!-- este va en el index -->
<script src="../../js/jquery.waypoints.js"></script><!-- animacion contador -->
<!-- este va en el index-->
<!-- este va en el index contador-->
<script>
    $('.num').counterUp({
        delay: 20,
        time: 2000
    });
</script>