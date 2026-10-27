<?php
	if (empty($_POST['reasigna_id'])){
		$errors[] = "Id vacío.";
	} elseif (!empty($_POST['reasigna_id'])){
	require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	
	date_default_timezone_set('America/Mexico_City');
	$fecha_hora=date("Y-m-d H:i:s");	 
	
	session_start();
	$id_usuario=$_SESSION['id_usuario'];	
	
	$id=$_POST['reasigna_id'];	

	// DELETE FROM  database
    $sql = "UPDATE num_oficios set
	estatus_oficio = '1'
	where no_oficio ='$id'";

	$query = mysqli_query($conexion,$sql);
	
	
	

    // if product has been added successfully
    if ($query) {
		
		$messages[] = "El Registro ha sido re-asignado con éxito.";
		
		$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_oficios_acciones (id_bitacora, id_usuario, fecha_captura, id_accion, id_oficiosrio) 
												VALUES (NULL, '$id_usuario', '$fecha_hora', '8', '$id')");

    } else {
        $errors[] = "Lo sentimos, la re-asignación falló. Por favor, regrese y vuelva a intentarlo.";
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