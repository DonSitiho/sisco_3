<?php include_once('../../plantillas/Direcciones/header.php') ?>
<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>

<!-- ************************************** contenido ***************************** -->
<?php
	if(($subdireccion == 0 or $depto == 0) && $nivelAcceso == 2){
		
		
    ?>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
        <li class="breadcrumb-item active">Regitros de usuarios</li>
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
                                    <h3 class="h4">Usuarios del Area</h3>

                                </div>
                            </div>
                        </div>

                        <div class='col-md-12 pull-right'>

                            <div id="custom-search-input">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group-material">
                                            <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee su
                                                búsqueda ...
                                            </label>
                                            <input type="text" class="form-control"
                                                style="border-radius: 25px !important;"
                                                placeholder="Buscador en tiempo real " id="q" name="q"
                                                onkeyup="load(1);">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group-material">
                                            <label for="q1" class="" style="margin-buttom: 12px !important;">
                                                .</label>
                                            <a href="#addUsuarioModal" class="btn btn-success" data-toggle="modal"
                                                style="border-radius: 25px !important;"><span>Agregar Usuario</span></a>
                                        </div>
                                    </div>
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
    <?php 	} else{
              echo "No tienes permiso para ingresar a esta ventana";
            }
    ?>
</section>
<!-- Page Footer-->
<?php include_once('../../plantillas/Direcciones/foother.php') ?>

<?php include("../../html/Direcciones/modal_add_usuario.php");?>
<?php include("../../html/Direcciones/modal_edit_usuario.php");?>

<script src="../../js/Direcciones/controlador_alta_usuarios.js"></script>

<!-- <script src="../../js/jquery.counterup.min.js"></script>-->
<!-- animacion contador -->
<!-- este va en el index -->
<!--  <script src="../../js/jquery.waypoints.js"></script>-->
<!-- animacion contador -->
<!-- este va en el index -->
<!-- este va en el index contador-->
<!--       <script>
				 $('.num').counterUp({delay:20, time:2000});	   
  
 </script>-->