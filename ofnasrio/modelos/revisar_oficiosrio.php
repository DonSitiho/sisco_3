<?php

	if (empty($_POST['revisa_id'])){
		$errors[] = "no hay no de oficio";
	} elseif (!empty($_POST['revisa_id'])){
	require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	
  	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");
	 /*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */    
	
	$revisa_fasig = mysqli_real_escape_string($conexion,(strip_tags($_POST["revisa_fsolicitado"],ENT_QUOTES))); 
	$revisa_numofi = mysqli_real_escape_string($conexion,(strip_tags($_POST["revisa_nofi"],ENT_QUOTES)));
	$revisa_foficio = mysqli_real_escape_string($conexion,(strip_tags($_POST["revisa_foficio"],ENT_QUOTES)));

	$datosfecha = explode('-', $revisa_foficio);
	$anio = substr($datosfecha[0],2,2);	

	$revisa_soli = mysqli_real_escape_string($conexion,(strip_tags($_POST["revisa_solicitante"],ENT_QUOTES)));
	$revisa_idarea = intval($_POST["revisa_idarea"]);	
	$revisa_asuntofi = mysqli_real_escape_string($conexion,(strip_tags($_POST["revisa_asunto"],ENT_QUOTES)));		
	$revisa_iddest =intval($_POST['revisa_iddep']);
	$revisa_nomdest = mysqli_real_escape_string($conexion,(strip_tags($_POST["revisa_nomofi"],ENT_QUOTES)));			
	$revisa_cargodest = mysqli_real_escape_string($conexion,(strip_tags($_POST['revisa_cargofi'],ENT_QUOTES)));
	$revisa_nomrecibe = mysqli_real_escape_string($conexion,(strip_tags($_POST['revisa_nomrecibe'],ENT_QUOTES)));
	$revisa_fentrega = mysqli_real_escape_string($conexion,(strip_tags($_POST['revisa_fentrega'],ENT_QUOTES)));
	$revisa_fingreso = mysqli_real_escape_string($conexion,(strip_tags($_POST['revisa_fingreso'],ENT_QUOTES)));
	$revisa_folio = mysqli_real_escape_string($conexion,(strip_tags($_POST['revisa_rfolio'],ENT_QUOTES)));
	$revisa_id = intval($_POST['revisa_id']);	
	

	$sql = "UPDATE num_oficios SET 
	no_oficio = '$revisa_id',
	anio = '$anio',
	folio_oficio = '$revisa_folio',
	num_oficio ='$revisa_numofi',
	fecha_solicitado = '$revisa_fasig',
	fecha_oficio ='$revisa_foficio',
	nombre_oficio ='$revisa_nomdest',
	cargo_oficio ='$revisa_cargodest',
	id_dependencia ='$revisa_iddest',
	asunto_oficio ='$revisa_asuntofi',
	solicitante_oficio ='$revisa_soli',
	id_direccion ='$revisa_idarea',
	folio_relacionado = '',
	oficio_relacionado = '',
	estatus_oficio = 2,
	fecha_ingresofirma = '$revisa_fingreso',
	fecha_entregaoficio = '$revisa_fentrega',
	nombre_recibeoficio = '$revisa_nomrecibe',
	id_datos_c = 0 
	WHERE no_oficio = '$revisa_id'";

	

	$query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {

        $messages[] = "El Oficio ha sido actualizado con éxito.";
    } else {

        $errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
	{
		$errors[] = "desconocido.";
	}

	if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
	}
	
	if (isset($messages)){
		
		?>
		<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Bien hecho!</strong>
				<?php
					foreach ($messages as $message) {
							echo $message;
						}
					?>
		</div>
		<?php
	}
?>			