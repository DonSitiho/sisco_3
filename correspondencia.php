<?php
include_once 'plantillas/documento-declaracion.php';
include_once 'plantillas/navbar.php';
include_once 'plantillas/sidebar.php';
include_once("ajax/conexion.php");


date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual = date("Y-m-d");
$fecha_hora = date("Y-m-d H:i:s");
/*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */


if (isset($_POST['idcorr'])) {
    $idcorresp = $_POST['idcor'];
} else {
    $idcorresp = 0;
}

?>
<!-- <div class="container-fluid"> -->
<!-- <div class="jumbotron">
    <div class="row">
        <div class="col-md-4">
            <div><img src="images/Logo SECOEM 2015-2021.png" width="80%" alt=""></div>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div><img src="images/siscoHorizontal.png" width="90%" alt=""></div>
            <!--<h3>Sistema de Correspondencia de la SECOEM</h3>-->
<!-- </div>
    </div>
</div> -->
<!-- </div> <-->
<br><br>
<div class="container card">

    <div class="table-title" style="border-radius: 25px !important;">
        <div class="row" style="padding: 5px !important;">
            <div class="col-sm-6">
                <h2>Historial de la correspondencia recibida<b></b></h2>
            </div>
            <div class="col-sm-6">
                <a href="#addCorrespondenciaModal" class="btn btn-success" data-toggle="modal" style="border-radius: 25px !important;"><i
                        class="material-icons">&#xE147;</i> <span>Agregar nueva correspondencia</span></a>
            </div>
        </div>
    </div>
    <div class='col-sm-4 mx-auto'>
        <div id="custom-search-input">
            <div class="input-group col-md-12">
                <input type="text" class="form-control" placeholder="Buscar" id="q" onkeyup="load(1);" style="border-radius: 25px !important;" />
                <span class="input-group-btn">
                    <!-- <button class="btn btn-info" type="button" onclick="load(1);" style="border-radius: 25px !important;">
                            <i class="material-icons">search</i>
                        </button> -->
                </span>
            </div>
        </div>
    </div>
    <div class='clearfix'></div>
    <hr>
    <div id="loader"></div><!-- Carga de datos ajax aqui -->
    <div id="resultados"></div><!-- Carga de datos ajax aqui -->
    <div id="resultados1"></div><!-- Carga de datos ajax aqui -->
    <div class='outer_div'></div><!-- Carga de datos ajax aqui -->



</div>

<?php require_once("html/modal_cambiar_password.php"); ?>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    src = "js/jquery.FloatLabel.js"
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="librerias/select2/js/select2.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>

<!-- Edit Modal HTML -->
<?php include("html/modal_add_corresp.php"); ?>
<!-- Edit Modal HTML -->
<?php include("html/modal_edit_corresp.php"); ?>
<!-- Delete Modal HTML -->
<?php include("html/modal_delete_corresp.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_view_corresp.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_load_corresp.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_delete_archivo.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_add_dep.php"); ?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_add_area.php"); ?>

<!--<script src="js/script.js"></script> -->
<script src="plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="plantilla/vendor/chart.js/Chart.min.js"></script>
<script src="plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Main File-->
<script src="plantilla/js/front.js"></script>
<script src="js/scriptcorresp.js"></script>



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

<?php include_once 'plantillas/footer.php'; ?>

</body>

</html>