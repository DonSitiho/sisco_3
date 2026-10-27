<?php


if (empty($_POST['folio'])) {
	$errors[] = "Ingresa un número de folio";
} elseif (!empty($_POST['folio'])) {
	require_once("conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code

	date_default_timezone_set('America/Mexico_City');
	setlocale(LC_TIME, 'es_MX.UTF-8');

	$fecha_actual = date("Y-m-d");
	$fecha_hora = date("Y-m-d H:i:s");
	/*$fechaDesde= date('Y-m-d',strtotime('-5 day')); */

	$add_folio = mysqli_real_escape_string($conexion, (strip_tags($_POST["folio"], ENT_QUOTES)));
	$add_frecep = mysqli_real_escape_string($conexion, (strip_tags($_POST["f_recepcion"], ENT_QUOTES)));
	$add_numofi = mysqli_real_escape_string($conexion, (strip_tags($_POST["num_oficio"], ENT_QUOTES)));
	$add_fofi = mysqli_real_escape_string($conexion, (strip_tags($_POST["f_oficio"], ENT_QUOTES)));
	$add_tofi = mysqli_real_escape_string($conexion, (strip_tags($_POST["t_oficio"], ENT_QUOTES)));

	if ($add_tofi == 0) {
		$add_idrmte = intval($_POST["id_remitente"]);
		$add_cargormte = mysqli_real_escape_string($conexion, (strip_tags($_POST["cargo"], ENT_QUOTES)));
		$add_nombrermte = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
		$add_iddest = 0;
		$add_cargodest = 'Lic. Francisco Ramírez Flores, Secretario de Contraloría';
	} elseif ($add_tofi == 1) {
		$add_idrmte = intval($_POST["id_remitente"]);
		$add_cargormte = mysqli_real_escape_string($conexion, (strip_tags($_POST["cargo"], ENT_QUOTES)));
		$add_nombrermte = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
		$add_iddest = intval($_POST['enviadopor']);
		$add_cargodest = mysqli_real_escape_string($conexion, (strip_tags($_POST['cargodest'], ENT_QUOTES)));
	}

	//echo $add_iddest, "   ", $add_cargodest, "  ", $add_idrmte, "  ", $add_cargormte, "  ", $add_nombrermte;

	//******ACTUALIZACION 24-01-2022 */
	if (!isset($_SESSION)) {
		session_start();
	}
	$idUsuario = $_SESSION['id_usuario'];
	$nomUsuario = $_SESSION['nombre'];
	//******ACTUALIZACION 24-01-2022 */

	$add_asunto = mysqli_real_escape_string($conexion, (strip_tags($_POST["asunto"], ENT_QUOTES)));
	$add_asuntoP = mysqli_real_escape_string($conexion, (strip_tags($_POST["asunto"], ENT_QUOTES)));
	$add_anexo = mysqli_real_escape_string($conexion, (strip_tags($_POST["anexo"], ENT_QUOTES)));

	$add_area = intval($_POST["areainterna"]);
	//$add_fturnado = mysqli_real_escape_string($conexion,(strip_tags($_POST["f_turnado"],ENT_QUOTES)));

	$add_instruc = mysqli_real_escape_string($conexion, (strip_tags($_POST["instruc"], ENT_QUOTES)));
	$add_obs = mysqli_real_escape_string($conexion, (strip_tags($_POST["obs"], ENT_QUOTES)));



	//******ACTUALIZACION 24-01-2022 */
	$sql = "	INSERT INTO `datos_correspondencia` (`id_datos_c`,`id_user`,`nom_capturista`, `folio`, `f_recepcion`, `tipo_oficio`, `id_remitente`, 
			`cargo`, `Nombre`, `num_oficio`, `f_oficio`, `id_destinatarios`, `cargo_destinatario`, `asunto_destinatario`,
			`asunto_particular`, `indicaciones_destinatario`, `anexo_destinatario`, `leyenda_destinatario`, `id_direcciones`, `f_turnado`, 
			`instrucciones_direcciones`, `f_recepArea`, `id_estatus1`, `fecha_cap_c`, `fecha_finalizacion`) 
		     VALUES (NULL, 	$idUsuario, '$nomUsuario' , '$add_folio', '$add_frecep', '$add_tofi', '$add_idrmte', '$add_cargormte', '$add_nombrermte', '$add_numofi', '$add_fofi', 
			 '$add_iddest', '$add_cargodest ', '$add_asunto', '$add_asuntoP', '', '$add_anexo', '$add_obs', '$add_area', '0000-00-00',
		     '$add_instruc', '0000-00-00 00:00:00', '1', '$fecha_hora', '0000-00-00 00:00:00')";

	//******ACTUALIZACION 24-01-2022 */

	/*  $sql = "	INSERT INTO `datos_correspondencia` (`id_datos_c`, `folio`, `f_recepcion`, `tipo_oficio`, `id_remitente`, `cargo`, 
	  `Nombre`, `num_oficio`, `f_oficio`, `id_destinatarios`, `cargo_destinatario`, `asunto_destinatario`, `indicaciones_destinatario`,
	   `anexo_destinatario`, `leyenda_destinatario`, `id_direcciones`, `f_turnado`, `instrucciones_direcciones`, `f_recepArea`, `id_estatus1`,
		`fecha_cap_c`) VALUES (NULL, '$add_folio', '$add_frecep', '$add_tofi', '$add_idrmte', '$add_cargormte', '$add_nombrermte', '$add_numofi', '$add_fofi',
		 '1', 
		'$add_cargodest', '$add_asunto', '$add_indica', 'M,NDMSDNSMA', 'D,MSN,DSNM,NDS,MN', '1', '2020-01-02', 'DJKSHKJDHSKHDKSH SKJHKJDHSKJ',
		 '2020-01-02', '1', '2019-11-15 00:00:00');";

	/* $sql = "	INSERT INTO `datos_correspondencia` (`id_datos_c`, `folio`, `f_recepcion`, `tipo_oficio`, `id_remitente`, 
	 		 		`cargo`, `Nombre`, `num_oficio`, `f_oficio`, `id_destinatarios`, `cargo_destinatario`, `asunto_destinatario`,
	   				`indicaciones_destinatario`, `anexo_destinatario`, `leyenda_destinatario`, `id_direcciones`, `f_turnado`, 
	   				`instrucciones_direcciones`, `f_recepArea`, `id_estatus1`, `fecha_cap_c`) 
	   			VALUES (NULL, '$add_folio', '$add_frecep', '$add_tofi', '$add_idrmte', '$add_cargormte', '$add_nombrermte', '$add_numofi', '$add_fofi', 
	   				'$add_iddest', '$add_cargodest ', '$add_asunto', '$add_indica', '$add_anexo', '$add_obs', '$add_area', '$add_fturnado',
					'$add_instruc', '$add_freceparea', '1', '$fecha_actual')";

//echo $sql;

	// REGISTER data into database
    /*$sql = "INSERT INTO datos_addondencia (id_datos_c, folio, f_recepcion, tipo_oficio, id_remitente, cargo, 
											   Nombre, num_oficio, f_oficio, id_destinatarios, cargo_destinatario, 
											   asunto_destinatario, indicaciones_destinatario, anexo_destinatario, 
											   leyenda_destinatario, id_direcciones, f_turnado, instrucciones_direcciones, f_recepArea,
											   id_estatus1, fecha_cap_c) 
			VALUES (NULL, '$add_folio', '$add_frecep', '$add_tofi', '$add_idrmte', '$add_cargormte', '$add_nombrermte', '$add_numofi', 
					'$add_fofi', '$add_iddest', '$add_cargodest', '$add_asunto', '$add_indica', '$add_anexo', '$add_obs', 
					'$add_area', '$add_fturnado', '$add_instruc', '$add_freceparea', '1', '$fecha_actual')";*/

	$query = mysqli_query($conexion, $sql);
	// if product has been added successfully
	if ($query) {

		$messages[] = "La Correspondencia ha sido guardada con éxito.";
	} else {

		$errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
	}
} else {
	$errors[] = "desconocido.";
}

if (isset($errors)) {

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

if (isset($messages)) {

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