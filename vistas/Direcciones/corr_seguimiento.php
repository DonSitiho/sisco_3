<?php include_once('../../plantillas/Direcciones/header.php') ?>


<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>

<!-- ************************************** contenido ***************************** -->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
        <li class="breadcrumb-item active">Seguimiento de la Correspondencia</li>
    </ul>
</div>

<section class="tables" style="margin-top: -35px !important;">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="table-wrapper">

                <div class="table-title">
                    <div class="row card-header ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center">
                                    <h3 class="h4">Correspondencia Asignada</h3>

                                </div>
                            </div>
                        </div>

                        <div class='col-md-12 pull-right'>

                            <div id="custom-search-input">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group-material" id="elige_area_oficio">
                                            <label for="q" class="" style="margin-buttom: 12px !important;">Direcciones:
                                            </label>
                                            <select class="mi-selector form-control mb-6" id="q" name="q" required
                                                class="input-material" onchange="load(1);">
                                                <option value="0">Selecciona un tipo de oficio ...</option>

                                                <option value="1" class="text-success">Original Titular</option>
                                                <option value="2" class="text-info">Conocimiento-Original</option>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group-material">
                                            <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee su
                                                búsqueda ...
                                            </label>
                                            <input type="text" class="form-control"
                                                placeholder="Buscador en tiempo real " id="q1" name="q1"
                                                onkeyup="load(1);">
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
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Original_titular"
                                            onkeyup="load(1);">
                                        <label class="custom-control-label" for="Original_titular"><span
                                                class="badge badge-success">Original-Titular

                                            </span></label>
                                    </div><small class="text-center">Adjuntar Respuesta (Obligatorio)</small>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Con_original"
                                            onkeyup="load(1);">
                                        <label class="custom-control-label" for="Con_original"><span
                                                class="badge badge-info">Conocimiento-Original
                                            </span></label>
                                    </div> <small class="text-center">Opcion a adjuntar repuesta</small>
                                </div>

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
<!-- Page Footer-->
<?php include_once('../../plantillas/Direcciones/foother.php') ?>


<?php include("../../html/Direcciones/modal_view_corresp_seguimiento.php");?>
<script src="../../js/Direcciones/controlador_seguimiento.js"></script>

<!-- <script src="../../js/jquery.counterup.min.js"></script>-->
<!-- animacion contador -->
<!-- este va en el index -->
<!--  <script src="../../js/jquery.waypoints.js"></script>-->
<!-- animacion contador -->
<!-- este va en el index -->
<!-- este va en el index contador-->
<!-- <script>
	$('.num').counterUp({delay:20, time:2000});	   
</script>-->