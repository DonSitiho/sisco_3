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

<div class="jumbotron text-right">
    <h3>Sistema de Control de Correspondencia de la SECOEM</h3>
</div>

    <div class="container-fluid">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Módulo de Reportes<b></b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addCorrespondenciaModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar nueva Correspondencia</span></a>
					</div>
                </div>
            </div>
			<div class='col-sm-4 mx-auto'>
				<div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);" />
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
			<div class='outer_div'></div><!-- Carga de datos ajax aqui -->
            
			
        </div>
	</div> 
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script> src="js/jquery.FloatLabel.js"</script>
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
	<script src="js/scriptcorresp.js"></script>

	

	<script>
	    $(document).ready(function(){
			$('#sidebarCollapse').on('click',function(){
				$('#sidebar').toggleClass('active');
			});
		});  
		
	</script>
	<script>
		$( '.js-float-label-wrapper' ).FloatLabel({
			populatedClass : 'custom-populated-class',
			focusedClass : 'custom-focused-class'
		});
	</script>

<?php include_once 'plantillas/footer.php'; ?>

</body>
</html>                                		                            