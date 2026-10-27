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

<div class="container-fluid">
    <div class="table-wrapper table-responsive">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h3>Oficios asignados por la Oficina del C. Secretario<b></b></h3>
                </div>

                <div class="col-sm-4">
                    <?php if ($nivel_usuario == 3) { ?>
                        <a href="#reservarOficiosrioModal" class="btn btn-warning" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Reservar</span></a><a href="#addOficiosrioModal" onclick="consultanumofi();" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Asignar nuevo Oficio</span></a>
                        <!-- <a href="#" onclick="rellenaofi();"class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Rellena oficios</span></a> -->

                    <?php }   ?>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group-material">
                    <input id="q2" type="number" name="q3" placeholder="Año" min="20" max="99" required class="input-material" onkeyup="load(1);">
                </div>
            </div>
            <div class="input-group col-md-4">
                <input type="text" class="form-control" placeholder="No. Oficio" id="q" onkeyup="load(1);" />
                <span class="input-group-btn">
                    <button class="btn btn-info btn-sm" type="button" onclick="load(1);" style="border-radius: 35px !important;">
                        <i class="material-icons">search</i>
                    </button>
                </span>
            </div>
            <div class="input-group col-md-4">
                <input type="text" class="form-control" placeholder="Buscar" id="q1" onkeyup="load(1);" />
                <span class="input-group-btn">
                    <button class="btn btn-info btn-sm" type="button" onclick="load(1);" style="border-radius: 25px !important;">
                        <i class="material-icons">search</i>
                    </button>
                </span>
            </div>


        </div>

        <div class='clearfix'></div>
        <hr>
        <div id="loader"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados1"></div><!-- Carga de datos ajax aqui -->
        <div class='outer_div'></div><!-- Carga de datos ajax aqui -->


    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="../../librerias/select2/js/select2.min.js"></script>

<!-- Edit Modal HTML -->
<?php include("../vistas/modal_add_oficiosrio.php"); ?>
<!-- Edit Modal HTML -->
<?php include("../vistas/modal_edit_oficiosrio.php"); ?>
<!-- Delete Modal HTML -->
<?php include("../vistas/modal_delete_oficiosrio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_view_oficiosrio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_copiar_oficiosrio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_reservar_oficiosrio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_revisa_oficiosrio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_vincula_oficiosrio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_reasignar_oficiosrio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_load_oficios_srio.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_view_oficiosrev.php"); ?>

<!--<script src="js/script.js"></script> -->
<script src="../../plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="../../plantilla/vendor/chart.js/Chart.min.js"></script>
<script src="../../plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Main File-->
<script src="../../plantilla/js/front.js"></script>
<script src="../controlador/scriptoficiosnuevo.js"></script>




<script>
    function consultanumofi() {

        $.ajax({

            url: '../modelos/consulta_nofi.php',
            success: function(data) {

                document.getElementById("new_ofi").value = data;
            }
        })
    }
</script>

<script>
    function rellenaofi() {

        $.ajax({

            url: '../modelos/llenar_folios.php',
            success: function(data) {}
        })
    }
</script>


<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
<script>
    $('.js-float-label-wrapper').FloatLabel({
        populatedClass: 'custom-populated-class',
        focusedClass: 'custom-focused-class'
    });
</script>

<?php include_once '../plantillas/footer.php'; ?>
<script>
    $(document).ready(function() {

        $(".mi-selector").select2({
            dropdownAutoWidth: true
        });
    });

    $(document).ready(function() {

        $("#edit_idarea").select2({
            dropdownAutoWidth: true
        });
    });
</script>


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

<script src="../../js/sweetalert2.all.min.js"></script>



</body>

</html>