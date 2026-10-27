<?php

	if (empty($_POST['edit_idC'])){
		$errors[] = "El id de la Tarjeta está vacio";
	} elseif (!empty($_POST['edit_idC'])){
	require_once ("../../php/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	
  	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=date("Y-m-d");
    $fecha_hora=date("Y-m-d H:i:s");
	 /*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */
	$id=intval($_POST['edit_idC']);
	$remitente = mysqli_real_escape_string($conexion,(strip_tags($_POST["remitente"],ENT_QUOTES)));
	$no_oficio = mysqli_real_escape_string($conexion,(strip_tags($_POST["no_oficio"],ENT_QUOTES))); 
	$fecha =$_POST["fecha"];
	$asunto = mysqli_real_escape_string($conexion,(strip_tags($_POST["asunto"],ENT_QUOTES))); 
	$destinatario = mysqli_real_escape_string($conexion,(strip_tags($_POST["destinatario"],ENT_QUOTES)));
	$tipo= mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_tipo"],ENT_QUOTES)));
	
	// REGISTER data into database
	$sql = "UPDATE `oficios_conocimiento` SET `remitente` = '$remitente', `no_oficio` = '$no_oficio', `fecha` = '$fecha', `asunto` = '$asunto', `destinatario` = '$destinatario', `tipo_documento` = '$tipo' WHERE `oficios_conocimiento`.`id` = $id;";	
    
   
    $query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "La Información ha sido editada con éxito.";
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