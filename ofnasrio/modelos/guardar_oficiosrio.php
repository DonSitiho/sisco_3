<?php

	if (empty($_POST['f_asignado'])){
		$errors[] = "Ingresa fecha solicitado";
	} elseif (!empty($_POST['f_asignado'])){
	require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	
  	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
	$fecha_hora=date("Y-m-d H:i:s");
	
	session_start();
	$id_usuario=$_SESSION['id_usuario'];
	 /*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */    

	 $datosfecha = explode('-', $fecha_actual);
	 $anio = substr($datosfecha[0],2,2);
	 
	 //$sql = "SELECT count(*) as numofi FROM num_oficios WHERE anio = '$anio'";
	 //$result = $conexion->query($sql);
	 //$fila = $result->fetch_assoc();
	 //$no_ofi = $fila['numofi']+1;
    
	 $sql = "SELECT * FROM num_oficios WHERE anio = '$anio' order by CAST(folio_oficio AS UNSIGNED) DESC";
	 $result = $conexion->query($sql);
	 $fila = $result->fetch_assoc();
	 $no_ofi = $fila['folio_oficio']+1;
	 
	 if ($no_ofi<10){
		 $folio='00'.$no_ofi;
		 $folio=ltrim($folio);
	 }
	 elseif($no_ofi>=10 && $no_ofi<100){
		 $folio='0'.$no_ofi;
		 $folio=ltrim($folio);
	 }
	 elseif($no_ofi>=100 && $no_ofi<10000){
		 $folio=$no_ofi;
		 $folio=ltrim($folio);
	 }        
	
	$add_fasig = mysqli_real_escape_string($conexion,(strip_tags($_POST["f_asignado"],ENT_QUOTES))); 
	$add_soli = mysqli_real_escape_string($conexion,(strip_tags($_POST["solicitante"],ENT_QUOTES)));
	$add_idarea = intval($_POST["area_interna"]);	
	$add_asuntofi = mysqli_real_escape_string($conexion,(strip_tags($_POST["asunto_ofi"],ENT_QUOTES)));		
	$add_iddest =intval($_POST['idDestino']);
	$add_nomdest = mysqli_real_escape_string($conexion,(strip_tags($_POST["nomDest"],ENT_QUOTES)));			
	$add_cargodest = mysqli_real_escape_string($conexion,(strip_tags($_POST['cargoDest'],ENT_QUOTES)));
	

	$sql = "INSERT INTO `num_oficios`(`no_oficio`, `folio_oficio`,  `anio`, `fecha_solicitado`, `fecha_oficio`, `nombre_oficio`, `cargo_oficio`, `id_dependencia`, `asunto_oficio`,
						 `solicitante_oficio`, `id_direccion`, `folio_relacionado`, `estatus_oficio`)
 			VALUES (NULL, '$folio', '$anio', '$add_fasig', '0000-00-00', '$add_nomdest', '$add_cargodest', '$add_iddest', '$add_asuntofi', '$add_soli', '$add_idarea', '0000-00-00', '1');";



	$query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {

		$messages[] = "El oficio ha sido guardado con éxito.";
		
		$id_insert=mysqli_insert_id($conexion);
		$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_oficios_acciones (id_bitacora, id_usuario, fecha_captura, id_accion, id_oficiosrio) 
											VALUES (NULL, '$id_usuario', '$fecha_hora', '1', '$id_insert')");

    } else {

        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
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