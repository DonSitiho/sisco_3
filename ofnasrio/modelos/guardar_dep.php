<?php
	if (empty($_POST['idendep'])){
		$errors[] = "Ingresa el Identificador de la Dependencia.";
	} elseif (!empty($_POST['idendep'])){
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    
	$dep_idendep = mysqli_real_escape_string($conexion,(strip_tags($_POST["idendep"],ENT_QUOTES)));
	$dep_sigladep = mysqli_real_escape_string($conexion,(strip_tags($_POST["sigladep"],ENT_QUOTES)));
	$dep_nomdep = mysqli_real_escape_string($conexion,(strip_tags($_POST["nomdep"],ENT_QUOTES)));
	
	

	// REGISTER data into database
    $sql = "INSERT INTO dependencias (identificador,sigla,nombre) VALUES ('$dep_idendep','$dep_sigladep','$dep_nomdep')";
    $query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "La Dependencia ha sido guardada con éxito.";
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