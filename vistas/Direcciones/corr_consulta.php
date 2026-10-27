<?php include_once('../../plantillas/Direcciones/header.php') ?>

<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>

<!-- ************************************** contenido ***************************** -->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
        <li class="breadcrumb-item active">Consulta</li>
    </ul>
</div>

<section class="tables" style="margin-top: -35px !important;">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="table-wrapper">
                <div class="container-fluid card">
                    <div class="card-header">
                        <h1 class="text-center display-4" style="font-size: 2.1rem !important;">Consulta / Reporte </h1>
                    </div>
                    <hr>
                    <?php
                    $id_direccion = $_SESSION['id_direccion'];
                    $id_usuario = $_SESSION['id_usuario'];
                    $nivel_acceso = $_SESSION['nivel_acceso'];
                    //VERIFICAR DE QUE DIRECCION ES 
                    if ($id_direccion == 2 && $nivel_acceso == 1) { ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group-material" id="elige_area_oficio">
                                    <label for="q" class="" style="margin-buttom: 12px !important;">Direcciones: </label>
                                    <select class="mi-selector form-control mb-6" id="direccion" name="direccion" required
                                        class="input-material" onchange="load(1);">
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
                            <div class="col-md-4">
                                <div class="form-group-material">
                                    <label for="fecha-inicial" class="label-material text-primary">Fecha Inicial</label>
                                    <input id="q" name="q" type="date" name="registerUsername" required
                                        class="input-material">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-material">
                                    <label for="fecha-final" class="label-material text-primary">Fecha final</label>
                                    <input id="q1" name="q1" type="date" name="registerUsername" required
                                        class="input-material">
                                </div>
                            </div>
                        </div>


                    <?php } else {
                    ?>
                        <select class="mi-selector form-control mb-6" id="direccion" name="direccion" required
                            class="input-material" onchange="load(1);" hidden="">
                            <option value="0">Todas las direcciones</option>
                            <?php
                            $consulta = mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion !='0'");
                            while ($row = mysqli_fetch_assoc($consulta)) {
                                echo ' <option value="' . $row['id_direccion'] . '"> ' . $row['nombre_direccion'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group-material">
                                    <label for="fecha-inicial" class="label-material text-primary">Fecha Inicial (obligatorio)</label>
                                    <input id="q" name="q" type="date" name="registerUsername" value="2022-02-15" required class="input-material">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-material">
                                    <label for="fecha-final" class="label-material text-primary">Fecha final (obligatorio)</label>
                                    <input id="q1" name="q1" type="date" value="<?php echo date("Y-m-d"); ?>" name="registerUsername" required class="input-material">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group-material">
                                    <label for="q6" class="label-material text-primary" style="margin: 6px !important;">Selecciona un Estatus de la correspondencia (opcional)</label>
                                    <select class="form-control mb-3" id="q6" name="q6" required
                                        class="input-material" onkeyup="load(1);" style="border-radius: 25px !important;">
                                        <option value="0">Todos...</option>
                                        <option value="2">Bandeja Principal (Pendiente)</option>
                                        <option value="3">Seguimiento</option>
                                        <option value="6">Finalizada</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group-material">
                                    <label for="q4" class="label-material text-primary" style="margin-bottom: 8px !important;">Selecciona un
                                        Remitente (opcional)</label>
                                    <select class="form-control mb-3" id="q4" name="q4" required
                                        class="input-material" onkeyup="load(1);" style="border-radius: 25px !important;">
                                        <option value="0">Remitente...</option>
                                        <?php
                                        $remitenet = mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
                                        while ($dep = mysqli_fetch_assoc($remitenet)) {
                                            $emisor = $dep['sigla'] . '-' . ($dep['nombre']);
                                            echo ('<option value="' . $dep['id_dependencia'] . '">' . $emisor . '</option>');
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-6">
                                <!-- <div class="form-group-material">
                                    <label for="q5" class="label-material text-primary" style="margin-bottom: 8px !important;">
                                        Teclee su búsqueda ... (opcional)
                                    </label>
                                    <input type="text" class="form-control"
                                        placeholder="Buscador en tiempo real " id="q5" name="q5"
                                        onkeyup="load(1);">
                                </div> -->
                            </div>


                        </div>

                    <?php
                    }
                    ?>

                    <div class="card-foother">
                        <center>
                            <button class="btn btn-danger text-center btn-sm" onclick="load(1);">Generar</button>
                            <button class="btn btn-primary text-center btn-sm" onclick="imprimir(1);">Imprimir</button>
                        </center>
                        <br>
                    </div>
                </div>

                <div class='clearfix'></div>

                <div id="loader"></div><!-- Carga de datos ajax aqui -->

                <div id="resultados"></div><!-- Carga de datos ajax aqui -->
                <div class='outer_div card'></div><!-- Carga de datos ajax aqui -->

</section>
<!-- Page Footer-->
<?php include_once('../../plantillas/Direcciones/foother.php') ?>



<script src="../../js/Direcciones/script_consulta_new.js"></script>

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