<?php
	if (empty($_POST['edit_id'])){
		$errors[] = "ID está vacío.";
	} elseif (!empty($_POST['edit_id'])){
	require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    
	$id=intval($_POST['edit_id']);
	$usr_nomuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nomuser"],ENT_QUOTES)));
	$usr_apuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_apuser"],ENT_QUOTES)));
	$usr_amuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_amuser"],ENT_QUOTES)));
	$usr_nickuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nickuser"],ENT_QUOTES)));
	$usr_pasuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_pasuser"],ENT_QUOTES)));
	$usr_diruser = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_diruser"],ENT_QUOTES)));
	$usr_nivuser = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nivuser"],ENT_QUOTES)));
		
	// UPDATE data into database
    $sql = "UPDATE usuarios SET nombre_usr='".$usr_nomuser."', app='".$usr_apuser."', apm='".$usr_amuser."', nick_name='".$usr_nickuser."', contrasena_usr='".$usr_pasuser."', id_direccion1='".$usr_diruser."', nivel_acces='".$usr_nivuser."' WHERE id_usuario='".$id."' ";
    $query = mysqli_query($conexion,$sql);
    // if has been added successfully
    if ($query) {
        $messages[] = "La usrendencia ha sido actualizada con éxito.";
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