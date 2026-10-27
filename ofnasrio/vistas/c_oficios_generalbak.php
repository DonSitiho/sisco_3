<?php
include '../plantillas/documento-declaracion.php';
include '../plantillas/navbar.php';
include '../plantillas/sidebar.php';


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

?>

<div class="container-fluid">
    <div class="table-wrapper">
        <form action="../../r_oficiosgeneral.php" method="POST" target="_blank">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Consulta General<b></b></h2>
                    </div>
                    <div class="col-sm-5">
                        <h2><b></b></h2>
                    </div>
                    <div class="col-sm-1">
                        <input type="image" src="../../images/printer6.png" alt="Enviar" width="40" height="">
                    </div>
                </div>
            </div>

            <div id="custom-search-input">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group-material" id="elige_area_oficio">
                        <label for="q2" class="" style="margin-buttom: 12px !important;">Dependencias: </label>
                        <select class="mi-selector form-control mb-6" id="q2" name="q2" required class="input-material"
                                onkeyup="load(1);">
                                <option value="0">Selecciona una Dependencia ...</option>
                                <?php
                                    $remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
                                    while($dep=mysqli_fetch_assoc($remitenet)){
                                    $emisor=$dep['sigla'].'-'.($dep['nombre']);
                                    echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="col-6">
                        <div class="form-group-material">
                            <label for="q3" class="" style="margin-buttom: 12px !important;">Área interna: </label>
                            <select class="mi-selector form-control mb-3" id="q3" name="q3" required class="input-material"
                                onkeyup="load(1);">
                                <option value="0">Selecciona el área que solicita ...</option>
                                <?php
                                    $remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS where identificador = '005' OR identificador='006-1' OR identificador='006-2'");
                                    while($dep=mysqli_fetch_assoc($remitenet)){
                                    $emisor=$dep['sigla'].'-'.($dep['nombre']);
                                    echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group-material">
                            <label for="q3" class="" style="margin-buttom: 12px !important;">Selecciona el estatus del oficio: </label>
                            <select class="form-control mb-3" id="q" name="q" required class="input-material"
                                onkeyup="load(1);">
                                <option value='0'>Todos... </option>
                                <option value='1'>Asignados</option>
                                <option value='2'>Revisados</option>
                                <option value='3'>Vinculados</option>
                                <option value='4'>Cancelados</option>
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="input-group col-md-2">
                        <span class="input-group-btn text-right">
                            <button class="form-control btn btn-info" style="margin-top : 12px !important;"
                                type="button" onclick="load(1);">Generar Consulta </button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class='clearfix'></div>
<hr>
<div id="loader"></div><!-- Carga de datos ajax aqui -->
<div id="resultados"></div><!-- Carga de datos ajax aqui -->
<div class='outer_div'></div><!-- Carga de datos ajax aqui -->


</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


<!-- Edit Modal HTML -->
<!-- <?php include("html/modal_add_corresp.php");?> -->
<!-- Edit Modal HTML -->
<!-- <?php include("html/modal_edit_corresp.php");?> -->
<!-- Delete Modal HTML -->
<!-- <?php include("html/modal_delete_corresp.php");?> -->
<!-- Mostrar Modal HTML -->
<!-- <?php include("html/modal_view_corresp.php");?> -->
<!-- Mostrar Modal HTML -->
<!-- <?php include("html/modal_load_corresp.php");?> -->
<!-- Mostrar Modal HTML -->
<!-- <?php include("html/modal_delete_archivo.php");?> -->

<!--<script src="js/script.js"></script> -->
<script src="../../plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="../../plantilla/vendor/chart.js/Chart.min.js"></script>
<script src="../../plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="../../librerias/select2/js/select2.min.js"></script>
<!-- Main File-->
<script src="../../plantilla/js/front.js"></script>
<script src="../controlador/scriptconofi.js"></script>



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
<script>
function realizaProceso(q, q1, q2, q3) {
    var parametros = {
        "query": q,
        "query1": q1,
        "query2": q2,
        "query3": q3
    };
    $.ajax({
        data: parametros,
        url: 'r_general.php',
        type: 'post',
        beforeSend: function(objeto) {
            $("#loader").html("Cargando...");
        },

    })
}
</script>
<script>
$(document).ready(function() {
    $('.mi-selector').select2({
        width: 'resolve' // need to override the changed default    
    });

});
</script>

<?php include_once '../plantillas/footer.php'; ?>

</body>

</html>