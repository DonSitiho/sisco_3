<?php
include_once 'plantillas/documento-declaracion.php';
include_once 'plantillas/navbar.php';
include_once 'plantillas/sidebar.php';


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



<div class="jumbotron ">
    <div class="row">
        <div class="col-md-4">
            <div><img src="images/Logo SECOEM 2015-2021.png" width="80%" alt=""></div>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div><img src="images/siscoHorizontal.png" width="90%" alt=""></div>
            <!--<h3>Sistema de Correspondencia de la SECOEM</h3>-->
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="table-wrapper">
        <form action="r_general.php" method="POST" target= "_blank">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Consulta General<b></b></h2>
                </div>
                <div class="col-sm-5">
                    <h2><b></b></h2>
                </div>
                <div class="col-sm-1">
                    <input type="image" src="images/printer6.png" alt="Enviar" width="40" height="">                   
                </div>               
            </div>
        </div>
        <div class='col-sm-12 mx-auto'>
            <div id="custom-search-input">
                    <div class="row">
                        <div class="col-6">  
                            <div class="form-group-material">
                                <label for="q2" class="" style="margin-buttom: 12px !important;">Selecciona:    </label>
                                <select class="form-control mb-3" id="q2" name="q2" required class="input-material" onkeyup="load(1);" >
                                    <option value="0">Todos los Remitentes...</option>
                                    <?php
                                    include_once ('ajax/conexion.php');
                                        $remitenet=mysqli_query($conexion, "SELECT * FROM dependencias");
                                        while($dep=mysqli_fetch_assoc($remitenet)){
                                        $emisor=$dep['identificador'].'-'.($dep['nombre']);
                                        echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">  
                            <div class="form-group-material">
                                <label for="q3" class="" style="margin-buttom: 12px !important;">Selecciona:    </label>
                                <select class="form-control mb-3" id="q3" name="q3" required class="input-material" onkeyup="load(1);">
                                    <option value="0">Todas las áreas de SECOEM...</option>
                                    <?php
                                    include_once ('ajax/conexion.php');
                                        $direccion=mysqli_query($conexion, "SELECT * FROM direcciones_secoem");
                                        while($row_direc=mysqli_fetch_assoc($direccion)){
                                            echo('<option value="'.$row_direc['id_direccion'].'">'.($row_direc['nombre_direccion']).'</option>');
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control" placeholder="Buscador en tiempo real - criterio 1" id="q" name="q" onkeyup="load(1);">
                            
                        </div>
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control" placeholder="Buscador en tiempo real - criterio 2" id="q1" name="q1" onkeyup="load(1);">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-2">

                           <!-- <input type="image" src="images/printer.png" alt="Enviar" width="60" height=""> -->
                            
                                <!--<input type="submit" class="btn btn-info" value="Imprimir Consulta">                      -->
 
                        </div>
                        <div class="input-group col-md-2">                     
                            <span class="input-group-btn text-right">
                                <button class="form-control btn btn-info" style = "margin-top : 12px !important;" type="button" onclick="load(1);">Generar Consulta </button>
                            </span>
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
<script>
src = "js/jquery.FloatLabel.js"
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


<!-- Edit Modal HTML -->
<?php include("html/modal_add_corresp.php");?>
<!-- Edit Modal HTML -->
<?php include("html/modal_edit_corresp.php");?>
<!-- Delete Modal HTML -->
<?php include("html/modal_delete_corresp.php");?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_view_corresp.php");?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_load_corresp.php");?>
<!-- Mostrar Modal HTML -->
<?php include("html/modal_delete_archivo.php");?>

<!--<script src="js/script.js"></script> -->
<script src="plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="plantilla/vendor/chart.js/Chart.min.js"></script>
<script src="plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Main File-->
<script src="plantilla/js/front.js"></script>
<script src="js/scriptcocorres.js"></script>



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
    function realizaProceso(q, q1, q2, q3){
        var parametros = {
            "query" : q,
            "query1" : q1,
            "query2" : q2,
            "query3" : q3
        };
        $.ajax({
            data: parametros,
            url: 'r_general.php',
            type: 'post',
            beforeSend: function(objeto){
				$("#loader").html("Cargando...");
              },
            
            }
        )
    }
</script>


<?php include_once 'plantillas/footer.php'; ?>

</body>

</html>