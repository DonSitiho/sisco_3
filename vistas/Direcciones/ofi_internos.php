<?php include_once('../../plantillas/Direcciones/header.php');

$consultaOfi = mysqli_query($conexion, "SELECT id FROM oficios_conocimiento WHERE is_active = 1 AND FIND_IN_SET($id_direccion, copias_direcciones) OR doc_original = $id_direccion");
$totalRecibidos = mysqli_num_rows($consultaOfi);
$consultaOfiEnv = mysqli_query($conexion, "SELECT id FROM oficios_conocimiento WHERE is_active = 1 AND id_direcciones =$id_direccion AND doc_original <> ''");
$totalEnv = mysqli_num_rows($consultaOfiEnv);
?>
<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>
<!-- ************************************** contenido ***************************** -->




<div class="breadcrumb-holder container-fluid" >


    <h2 style="text-align:center; padding-top: 0.5em;">Oficios o Tarjetas internas</h2>
    <br>
    <!-- Nav tabs -->
    
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active h2" data-toggle="tab" href="#home"> Enviadas <span
                    class="badge badge-danger"><?=$totalEnv?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link h2" data-toggle="tab" href="#menu2"> Recibidas <span
                    class="badge badge-danger"><?=$totalRecibidos?></span></a>
        </li>
    </ul>
</div>
<!-- Tab panes -->
<div class="tab-content" >
    <div id="home" class="container tab-pane active" ><br>

        <section class="table table-responsive" style="margin-top: -35px !important;">

            <div class="container-fluid card"><br>
                <div class="col-md-12">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <h1 class="card-title text-center"><span class="badge badge-info ">CORRESPONDENCIA
                                    ENVIADA</span></h1>
                            <div class="row">
                                <div class="col-md-9">
                                </div>
                                <div class="col-md-3">
                                    <a href="#addOfi" class="btn btn-success" data-toggle="modal"> <span>Agregar nuevo
                                        </span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php

                $id_direccion = $_SESSION['id_direccion'];
                $id_usuario = $_SESSION['id_usuario'];
                $nivel_acceso = $_SESSION['nivel_acceso'];
                //VERIFICAR DE QUE DIRECCION ES 
                if ($id_direccion == 2 && $nivel_acceso == 1) {
                ?>
                            <div class="col-6">
                                <div class="form-group-material" id="elige_area_oficio">
                                    <label for="q" class="" style="margin-buttom: 12px !important;">Direcciones:
                                    </label>
                                    <select class="mi-selector form-control mb-6" id="q" name="q" required
                                        class="input-material" onchange="load(1);">
                                        <option value="0">Todas las direcciones</option>
                                        <?php
                        $consulta = mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion != '0' ");
                        while ($row = mysqli_fetch_assoc($consulta)) {
                          echo ' <option value="' . $row['id_direccion'] . '"> ' . $row['nombre_direccion'] . '</option>';
                        }
                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group-material">
                                    <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee su búsqueda
                                        ...
                                    </label>
                                    <input type="text" class="form-control" placeholder="Buscador en tiempo real "
                                        id="q1" name="q1" onkeyup="load(1);">

                                </div>

                            </div>
                            <?php
                } else { ?>
                            <select class="mi-selector form-control mb-6" id="q" name="q" required
                                class="input-material" onchange="load(1);" hidden>
                                <option value="0">Todas las direcciones</option>
                                <?php
                    $consulta = mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion !='0'");
                    while ($row = mysqli_fetch_assoc($consulta)) {
                      echo ' <option value="' . $row['id_direccion'] . '"> ' . $row['nombre_direccion'] . '</option>';
                    }
                    ?>
                            </select>

                            <div class="col-12">
                                <div class="form-group-material">
                                    <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee su búsqueda
                                        ...
                                    </label>
                                    <input type="text" class="form-control" placeholder="Buscador en tiempo real "
                                        id="q1" name="q1" onkeyup="load(1);">

                                </div>

                            </div>
                            <?php
                }
                ?>
                            <div class='clearfix'></div>
                            <div id="loader"></div><!-- Carga de datos ajax aqui -->
                            <div id="resultados"></div><!-- Carga de datos ajax aqui -->
                            <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>

        <section class="table table-responsive" style="margin-top: -35px !important;">
            <div class="container-fluid card"><br>
                <div class="col-md-12">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <h1 class="card-title text-center"><span class="badge badge-primary ">CORRESPONDENCIA
                                    RECIBIDA</span></h1>


                        </div>
                        <div class="row">
                            <?php

                $id_direccion = $_SESSION['id_direccion'];
                $id_usuario = $_SESSION['id_usuario'];
                $nivel_acceso = $_SESSION['nivel_acceso'];
                //VERIFICAR DE QUE DIRECCION ES 
                if ($id_direccion == 2 && $nivel_acceso == 1) {
                ?>
                            <div class="col-6">
                                <div class="form-group-material" id="elige_area_oficio">
                                    <label for="q2" class="" style="margin-buttom: 12px !important;">Direcciones:
                                    </label>
                                    <select class="mi-selector form-control mb-6" id="q2" name="q2" required
                                        class="input-material" onchange="cargar(1);">
                                        <option value="0">Todas las direcciones</option>
                                        <?php
                        $consulta = mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion !='0'");
                        while ($row = mysqli_fetch_assoc($consulta)) {
                          echo ' <option value="' . $row['id_direccion'] . '"> ' . $row['nombre_direccion'] . '</option>';
                        }
                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group-material">
                                    <label for="q3" class="" style="margin-buttom: 12px !important;">Teclee su búsqueda
                                        ...
                                    </label>
                                    <input type="text" class="form-control" placeholder="Buscador en tiempo real "
                                        id="q3" name="q3" onkeyup="cargar(1);">

                                </div>

                            </div>
                            <?php


                } else { ?>

                            <select class="mi-selector form-control mb-6" id="q2" name="q2" required
                                class="input-material" onchange="cargar(1);" hidden>
                                <option value="0">Todas las direcciones</option>
                                <?php
                    $consulta = mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion !='0'");
                    while ($row = mysqli_fetch_assoc($consulta)) {
                      echo ' <option value="' . $row['id_direccion'] . '"> ' . $row['nombre_direccion'] . '</option>';
                    }
                    ?>
                            </select>

                            <div class="col-12">
                                <div class="form-group-material">
                                    <label for="q3" class="" style="margin-buttom: 12px !important;">Teclee su búsqueda
                                        ...
                                    </label>
                                    <input type="text" class="form-control" placeholder="Buscador en tiempo real "
                                        id="q3" name="q3" onkeyup="cargar(1);">

                                </div>

                            </div>
                            <?php
                }
                ?>

                        </div>


                        <div class='clearfix'></div>
                        <div id="loader2"></div><!-- Carga de datos ajax aqui -->
                        <div id="resultados"></div><!-- Carga de datos ajax aqui -->
                        <div class='outer_div2'></div><!-- Carga de datos ajax aqui -->
                    </div>
                </div>
            </div>
        </section>


    </div>
</div>
</div>

<!-- Page Footer-->
<?php include_once('../../plantillas/Direcciones/foother.php') ?>
<?php include("../../html/Direcciones/modal_add_ofi.php"); ?>
<?php include("../../html/Direcciones/modal_add_ofi_resp.php"); ?>
<?php include("../../html/Direcciones/modal_edit_ofi_resp.php"); ?>

<?php include("../../html/Direcciones/modal_edit_ofi.php"); ?>

<?php include("../../html/Direcciones/modal_view_Ofi.php"); ?>
<?php include("../../html/Direcciones/modal_view_Ofi_recibidas.php"); ?>
<script src="../../js/Direcciones/controlador_ofi_conocimiento_new.js"></script>




<!-- MODIFICAR -->

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