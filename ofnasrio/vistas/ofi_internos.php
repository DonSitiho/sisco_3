<?php
include '../plantillas/documento-declaracion.php';
include '../plantillas/navbar.php';
include '../plantillas/sidebar.php';

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual = strftime("%Y-%m-%d");
$fecha_hora = date("Y-m-d H:i:s");
/*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */

if (isset($_POST['idcorr'])) {
    $idcorresp = $_POST['idcor'];
} else {
    $idcorresp = 0;
}

$nivel_usuario = $_SESSION['nivel_acceso'];
?>

<section class="table" style="margin-top: -35px !important;">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <h3 class="h4">Oficios o Tarjetas internas</h3>
                            </div>
                        </div>
                        <div class="col-md-6">                           
                        </div>
                        <div class="col-md-3">
                            <a href="#addOfi" class="btn btn-success" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Agregar nuevo </span></a> 
                        </div>
                    </div> 
                </div>
                    <div class="row"> 
                        <div class="col-6">
                            <div class="form-group-material" id="elige_area_oficio">
                            <label for="q" class="" style="margin-buttom: 12px !important;">Direcciones: </label>
                            <select class="mi-selector form-control mb-6" id="q" name="q" required class="input-material"
                                onchange="load(1);">
                                    <option value="0">Selecciona una área ...</option>
                                    <?php
                                        $consulta=mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion !='0'");
                                        while($row=mysqli_fetch_assoc($consulta)){
                                          echo' <option value="'.$row['id_direccion'].'"> '.$row['nombre_direccion'].'</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group-material">
                            <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee su búsqueda ...
                            </label>
                            <input type="text" class="form-control" placeholder="Buscador en tiempo real " id="q1"
                                name="q1" onkeyup="load(1);">

                        </div>
                    <!-- </div>
                        <div class='col-6'>
                            <!--<div id="custom-search-input">-->
                            <!-- <div class="form-group-material">
                                <input type="text" id="q" onkeyup="load(1);" class="input-material">
                                <label for="register-username" class="label-material">Buscar</label>
                            </div>
                        </div>-->
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
<?php include_once '../plantillas/footer.php'; ?>

<!-- <?php include_once '../../plantillas/Direcciones/foother.php'?> -->
<?php include "modal_add_ofi.php";?>
<?php include "modal_view_ofi.php";?>

<?php include "modal_edit_ofi.php";?>



<?php include "modal_delete_oficon.php";?>


<script src="../controlador/controlador_Ofi_conocimiento1.js"></script>