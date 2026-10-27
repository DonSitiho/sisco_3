<?php
if (empty($_POST['view_instruc'] ?? '')) {
	$errors[] = "No llego la Instrucción";
} elseif (!empty($_POST['view_instruc'])) {

	require_once("../conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	date_default_timezone_set('America/Mexico_City');
	setlocale(LC_TIME, 'es_MX.UTF-8');
	$fecha_actual = date("Y-m-d");
	$fecha_hora = date("Y-m-d H:i:s");

	$id_corr = (int) ($_POST['view_id'] ?? 0);
	$Asunto = strip_tags($_POST["view_asunto"] ?? '');
	$Asuntop = strip_tags($_POST["view_asuntop"] ?? '');
	$Obspart = strip_tags($_POST["view_obs_part"] ?? '');

	$Instruccion = strip_tags($_POST["view_instruc"] ?? '');
	$Observaciones = strip_tags($_POST["view_obs"] ?? '');

	$query = false;
	$total_copias = 0;
	$copias_ok = 0;

	try {
		$folio = trim($_POST['folio'] ?? '');
		$partes = explode('/', $folio);
		$newFolio = $partes[0] . '/' . ($partes[1] ?? '');
		$sacar_copias = mysqli_execute_query($conexion, "SELECT id_datos_c FROM `datos_correspondencia` WHERE `folio` = ? OR `folio` LIKE ?", [$newFolio, $newFolio . '/%']);

		while ($rows_copias = mysqli_fetch_assoc($sacar_copias)) {
			$idCorresp = $rows_copias['id_datos_c'];
			$total_copias++;
			$sql = "UPDATE `datos_correspondencia` SET  instrucciones_direcciones = ?, asunto_destinatario = ?, asunto_particular = ?, leyenda_destinatario = ?, obs_part = ? WHERE `datos_correspondencia`.`id_datos_c` = ?";
			if (mysqli_execute_query($conexion, $sql, [$Instruccion, $Asunto, $Asuntop, $Observaciones, $Obspart, $idCorresp])) {
				$copias_ok++;
			}
		}

		//AUTORIZAR ORIGINAL Y COPIAS
		// Se guardó bien solo si se encontró al menos un registro y se actualizaron todos
		$query = ($total_copias > 0 && $copias_ok === $total_copias);
	} catch (mysqli_sql_exception $e) {
		$query = false;
	}

	// if product has been added successfully
	if ($query) {
		$messages[] = "Se han Guardado los cambios ";
	} elseif ($total_copias === 0 && !isset($e)) {
		$errors[] = "No se encontró la correspondencia con el folio " . $folio;
	} else {
		$errors[] = "Lo sentimos, El guardado de la correspondencia Fallo. Por favor, regrese y vuelva a intentarlo!";
	}
} else {
	$errors[] = "desconocido.";
}

if (isset($errors)) {
	echo ('<script>
				Swal.fire({
	title: "¡Error del sistema!",
	text: ');
	echo json_encode(implode(' ', $errors), JSON_UNESCAPED_UNICODE | JSON_HEX_TAG);
	echo (',
	icon: "error",
	confirmButtonText: "Aceptar",
	buttonsStyling: false,
	customClass: {
		confirmButton: "btn btn-danger"
	}
});
				</script>');
}
if (isset($messages)) {

	echo ('<script>
				Swal.fire({
	title: "¡Bien hecho!",
	text: ');
	echo json_encode(implode(' ', $messages), JSON_UNESCAPED_UNICODE | JSON_HEX_TAG);
	echo (',
	icon: "info",
	confirmButtonText: "Aceptar",
	buttonsStyling: false,
	customClass: {
		confirmButton: "btn btn-success"
	}
});
				</script>');
}
