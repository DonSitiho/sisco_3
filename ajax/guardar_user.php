<?php
	if (empty($_POST['nomuser'])){
		$errors[] = "Está vacío el nombre del Usuario.";
	} elseif (!empty($_POST['nomuser'])){
	require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    
	$usr_nomuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["nomuser"],ENT_QUOTES)));
	$usr_apuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["apuser"],ENT_QUOTES)));
	$usr_amuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["amuser"],ENT_QUOTES)));
	$usr_nickuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["nickuser"],ENT_QUOTES)));
	$usr_pasuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["pasuser"],ENT_QUOTES)));
	$usr_diruser=intval($_POST['diruser']);
	$usr_nivuser=intval($_POST['nivuser']);	
	
	// REGISTER data into database
    $sql = "INSERT INTO usuarios (nombre_usr,app,apm,nick_name,contrasena_usr,id_direccion1,nivel_acces) VALUES ('$usr_nomuser','$usr_apuser','$usr_amuser','$usr_nickuser','$usr_pasuser','$usr_diruser','$usr_nivuser')";
    $query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El Usuario ha sido guardado con éxito.";
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