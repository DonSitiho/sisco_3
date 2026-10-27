<?php

	if (empty($_POST['edit_id'])){
		$errors[] = "El id de la correspondencia está vacio";
	} elseif (!empty($_POST['edit_id'])){
	require_once ("conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	
  	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=date("Y-m-d"); 
    $fecha_hora=date("Y-m-d H:i:s");
	 /*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */
	$id=intval($_POST['edit_id']);
	$corres_folio = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_folio"],ENT_QUOTES)));
	$corres_frecep = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_f_recepcion"],ENT_QUOTES))); 
	$corresp_numofi = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_num_oficio"],ENT_QUOTES)));
	$corres_fofi = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_f_oficio"],ENT_QUOTES))); 
	$corresp_tofi = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_t_oficio"],ENT_QUOTES)));
	
	if($corresp_tofi==0){
		$corresp_idrmte = intval($_POST["edit_id_remitente"]);
		$corresp_cargormte = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cargo"],ENT_QUOTES)));
		$corresp_nombrermte = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nombre"],ENT_QUOTES)));	
		$corresp_iddest = 0;
		$corresp_cargodest ='Lic. Francisco Ramírez Flores, Secretario de Contraloría';
		
	}elseif($corresp_tofi==1){
		$corresp_idrmte = intval($_POST["edit_id_remitente"]);
		$corresp_cargormte = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_cargo"],ENT_QUOTES)));
		$corresp_nombrermte = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_nombre"],ENT_QUOTES)));	
		$corresp_iddest =intval($_POST['edit_enviadopor']);
		$corresp_cargodest = mysqli_real_escape_string($conexion,(strip_tags($_POST['edit_cargodest'],ENT_QUOTES)));
		
	}

	
	$corresp_asunto = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_asunto"],ENT_QUOTES)));
	$corresp_anexo = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_anexo"],ENT_QUOTES)));
	
	$corresp_area = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_areainterna"],ENT_QUOTES)));
	//$corresp_fturnado = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_f_turnado"],ENT_QUOTES)));
	
	$corresp_instruc = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_instruc"],ENT_QUOTES)));
	$corresp_obs = mysqli_real_escape_string($conexion,(strip_tags($_POST["edit_obs"],ENT_QUOTES)));
	
	//******ACTUALIZACION 24-01-2022 */
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	$idUsuario = $_SESSION['id_usuario'];
	$nomUsuario = $_SESSION['nombre'];
	//******ACTUALIZACION 24-01-2022 */
	

	// REGISTER data into database
	$sql = "UPDATE datos_correspondencia SET 
	id_user = $idUsuario,
	nom_capturista ='$nomUsuario',
	folio = '$corres_folio',
	f_recepcion = '$corres_frecep', 
	tipo_oficio = '$corresp_tofi', 
	id_remitente= '$corresp_idrmte', 
	cargo = '$corresp_cargormte', 
	Nombre = '$corresp_nombrermte', 
	num_oficio= '$corresp_numofi', 
	f_oficio = '$corres_fofi', 
	id_destinatarios = '$corresp_iddest', 
	cargo_destinatario= '$corresp_cargodest', 
	asunto_destinatario = '$corresp_asunto', 	
	anexo_destinatario = '$corresp_anexo', 
	id_direcciones = '$corresp_area', 
	instrucciones_direcciones = '$corresp_instruc', 
	leyenda_destinatario = '$corresp_obs' 
	WHERE id_datos_c = '$id'";	

   
    $query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "La correspondencia ha sido editada con éxito.";
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