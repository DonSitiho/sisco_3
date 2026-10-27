<?php
	if (empty($_POST['edit_id'])){
		$errors[] = "ID está vacío.";
	} elseif (!empty($_POST['edit_id'])){
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    
	$dep_idendep = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_idendep"],ENT_QUOTES)));
	$dep_sigladep = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_sigladep"],ENT_QUOTES)));
	$dep_nomdep = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nomdep"],ENT_QUOTES)));
	
	
	$id=intval($_POST['edit_id']);
	// UPDATE data into database
    $sql = "UPDATE dependencias SET identificador='".$dep_idendep."', sigla='".$dep_sigladep."', nombre='".$dep_nomdep."' WHERE id_dependencia='".$id."' ";
    $query = mysqli_query($conexion,$sql);
    // if has been added successfully
    if ($query) {
        $messages[] = "La Dependencia ha sido actualizada con éxito.";
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