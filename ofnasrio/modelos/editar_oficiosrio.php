<?php

	if (empty($_POST['edit_fsolicitado'])){
		$errors[] = "Ingresa fecha solicitado";
	} elseif (!empty($_POST['edit_fsolicitado'])){
	require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	
  	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");
	 /*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */    

	 session_start();
	 $id_usuario=$_SESSION['id_usuario'];
	
	$edit_fasig = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_fsolicitado"],ENT_QUOTES))); 
	$edit_soli = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_solicitante"],ENT_QUOTES)));
	$edit_idarea = intval($_POST["edit_idarea"]);	
	$edit_asuntofi = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_asunto"],ENT_QUOTES)));		
	$edit_iddest =intval($_POST['edit_iddep']);
	$edit_nomdest = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nomofi"],ENT_QUOTES)));			
	$edit_cargodest = mysqli_real_escape_string($conexion,(strip_tags($_POST['edit_cargofi'],ENT_QUOTES)));
	$edit_id = intval($_POST['edit_id']);	
	

	$sql = "UPDATE num_oficios SET 
	fecha_solicitado = '$edit_fasig',
	nombre_oficio = '$edit_nomdest',
	cargo_oficio = '$edit_cargodest', 
	id_dependencia = '$edit_iddest', 
	asunto_oficio = '$edit_asuntofi', 
	solicitante_oficio = '$edit_soli', 
	id_direccion = '$edit_idarea' 
	
	WHERE no_oficio = $edit_id";	


	$query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {

		$messages[] = "El Oficio ha sido actualizado con éxito.";
		
		$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_oficios_acciones (id_bitacora, id_usuario, fecha_captura, id_accion, id_oficiosrio) 
												VALUES (NULL, '$id_usuario', '$fecha_hora', '2', '$edit_id')");

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