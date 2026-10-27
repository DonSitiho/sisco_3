
<?php
include '../ofnasrio/plantillas/documento-declaracion.php';
include '../ofnasrio/plantillas/navbar.php';
include '../ofnasrio/plantillas/sidebar.php';

session_start();
$nivel_usuario = $_SESSION['nivel_acceso'];

  	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");
	 /*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */
	 
	 
	 if(isset($_POST['idcorr'])){
		 $idcorresp = $_POST['idcor'];
	 }else{
		 $idcorresp = 0;
	 }
$consulta_user=mysqli_query($conexion,"SELECT * FROM usuarios WHERE id_usuario='$id_usuario'");
$rows_user=mysqli_fetch_assoc($consulta_user);
$nombre_user=$rows_user['nombre_usr'];
$app=$rows_user['app'];
$apm=$rows_user['apm'];
$nick_name=$rows_user['nick_name'];
$pass=$rows_user['contrasena_usr'];
?>

<div class="container-fluid">
    <div class="table-wrapper table-responsive">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h3>Oficios asignados por la Oficina del C. Secretario</h3>
                </div>
    
                <div class="col-sm-4">
                
                    <?php
                    
                    if($nivel_usuario==3){ ?>
                        <a href="#reservarOficiosrioModal" class="btn btn-warning" data-toggle="modal" id="btn_reservar">
                    
                            <i class="material-icons">&#xE147;</i> <span>Reservar</span></a><a href="#addOficiosrioModal" class="btn btn-success" data-toggle="modal">
                            <i class="material-icons">&#xE147;</i> <span>Asignar nuevo Oficio</span>
                    
                        </a>
                    <?php } ?> 
                </div>
            </div>
        </div>
        <div class='col-sm-4 mx-auto'>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control" placeholder="Buscar" id="q" onkeyup="load(1);" />
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="button" onclick="load(1);">
                            <i class="material-icons">search</i>
                        </button>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="../../librerias/select2/js/select2.min.js"></script>

<!-- Edit Modal HTML -->
<?php include("../vistas/modal_add_oficiosrio.php");?>
<!-- Edit Modal HTML -->
<?php include("../vistas/modal_edit_oficiosrio.php");?>
<!-- Delete Modal HTML -->
<?php include("../vistas/modal_delete_oficiosrio.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_view_oficiosrio.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_copiar_oficiosrio.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_reservar_oficiosrio.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_revisa_oficiosrio.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_vincula_oficiosrio.php");?>

<!--<script src="js/script.js"></script> -->
<script src="../../plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="../../plantilla/vendor/chart.js/Chart.min.js"></script>
<script src="../../plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Main File-->
<script src="../../plantilla/js/front.js"></script>
<script src="../controlador/scriptoficiosrio.js"></script>



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

</body>

</html>