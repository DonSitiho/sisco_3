<?php
if (isset($_POST['id-corr1']) && isset($_POST['cantidad'])) {
	include('conexion.php');

	/*$identificado=141;
	$cantidad=1;*/
	date_default_timezone_set('America/Mexico_City');
	setlocale(LC_TIME, 'es_MX.UTF-8');
	$fecha_actual = date("Y-m-d");
	$fecha_hora = date("Y-m-d H:i:s");

	//$id_usuario=$_POST['id_usuario_c'];
	$identificado = (int)$_POST['id-corr1'];
	$cantidad = (int)$_POST['cantidad'];

	//******ACTUALIZACION 23-10-2026 */
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	$idUsuario = $_SESSION['id_usuario'] ?? 0;
	$nomUsuario = $_SESSION['nombre'] ?? '';

	if ($identificado <= 0  || $cantidad < 1 || $cantidad > 30) {
		$errors[] = "Datos inválidos. La cantidad debe estar entre 1 y 50.";
	} elseif ($idUsuario == 0) {
		$errors[] = "Tu sesión expiró. Vuelve a iniciar sesión.";
	} else {

		try {
			mysqli_begin_transaction($conexion);

			$duplicar_datos = mysqli_execute_query($conexion, "SELECT * FROM datos_correspondencia WHERE id_datos_c = ?", [$identificado]);
			$encontrado = false;
			//$campos_c = mysqli_fetch_assoc($duplicar_datos);

			while ($campos_c = mysqli_fetch_assoc($duplicar_datos)) {
				$encontrado = true;

				$duplicar_folio = $campos_c['folio'];
				$duplicar_frecep = $campos_c['f_recepcion'];
				$duplicar_numofi = $campos_c['num_oficio'];
				$duplicar_fofi = $campos_c['f_oficio'];
				$duplicar_tofi = $campos_c['tipo_oficio'];

				if ($duplicar_tofi == 0) {

					$duplicar_iddest = 0;
					$duplicar_cargodest = 'Lic. Francisco Ramírez Flores, Secretario de Contraloría';
					$duplicar_idrmte = $campos_c["id_remitente"];
					$duplicar_cargormte = $campos_c["cargo"];
					$duplicar_nombrermte = $campos_c["Nombre"];
				} elseif ($duplicar_tofi == 1) {
					$duplicar_iddest = $campos_c['id_destinatarios'];
					$duplicar_cargodest = $campos_c['cargo_destinatario'];
					$duplicar_idrmte = $campos_c["id_remitente"];
					$duplicar_cargormte = $campos_c["cargo"];
					$duplicar_nombrermte = $campos_c["Nombre"];
				}

				$duplicar_asunto = $campos_c['asunto_destinatario'];
				$duplicar_anexo = $campos_c['anexo_destinatario'];
				$duplicar_indica = $campos_c['indicaciones_destinatario'];
				$duplicar_area = $campos_c['id_direcciones'];
				$duplicar_fturnado = $campos_c['f_turnado'];
				$duplicar_freceparea = $campos_c['f_recepArea'];
				$duplicar_instruc = $campos_c['instrucciones_direcciones'];
				$duplicar_obs = $campos_c['leyenda_destinatario'];
				$duplicar_idestatus = $campos_c['id_estatus1'];
				$duplicar_fcaptcorres = $campos_c['fecha_cap_c'];
			}

			if(!$encontrado){
				throw new Exception("No se encontró el registro a duplicar.");
			}

			$nuevo_folio = explode("/", trim($duplicar_folio));
			$anio = $nuevo_folio[0];
			$nuevoFolio = $nuevo_folio[1] ?? '';

			if($nuevoFolio===''){
				throw new Exception("El folio original no tiene el formato esperado.");
			}

			// Último sufijo ya usado para este folio, para no repetir
			$consulta_max = mysqli_execute_query($conexion, "SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(folio, '/', -1) AS UNSIGNED)), 1) AS ultimo
															FROM datos_correspondencia
															WHERE folio LIKE ? FOR UPDATE", [$anio . '/' . $nuevoFolio . '/%']);
			$ultimo = (int)mysqli_fetch_assoc($consulta_max)['ultimo'];

			$sql = "INSERT INTO `datos_correspondencia` (`id_datos_c`, `id_user`, `nom_capturista`, `folio`, `f_recepcion`, `tipo_oficio`, `id_remitente`,
									`cargo`, `Nombre`, `num_oficio`, `f_oficio`, `id_destinatarios`, `cargo_destinatario`, `asunto_destinatario`,
									`indicaciones_destinatario`, `anexo_destinatario`, `leyenda_destinatario`, `id_direcciones`, `f_turnado`,
									`instrucciones_direcciones`, `f_recepArea`, `id_estatus1`, `fecha_cap_c`,`fecha_finalizacion`)
						VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0000-00-00 00:00:00', ?, ?, '0000-00-00 00:00:00')";

			for ($i = 1; $i <= $cantidad; $i++) {
				$consec = $ultimo + $i;

				if ($consec < 10) {
					$folio = $anio . '/' . $nuevoFolio . '/0' . $consec;
				} else {
					$folio = $anio . '/' . $nuevoFolio . '/0' . $consec;
				}

				$query = mysqli_execute_query($conexion, $sql, [
					$idUsuario,
					$nomUsuario,
					$folio,
					$duplicar_frecep,
					$duplicar_tofi,
					$duplicar_idrmte,
					$duplicar_cargormte,
					$duplicar_nombrermte,
					$duplicar_numofi,
					$duplicar_fofi,
					$duplicar_iddest,
					$duplicar_cargodest,
					$duplicar_asunto,
					$duplicar_indica,
					$duplicar_anexo,
					$duplicar_obs,
					$duplicar_area,
					$duplicar_fturnado,
					$duplicar_instruc,
					$duplicar_idestatus,
					$duplicar_fcaptcorres
				]);
			}
			mysqli_commit($conexion);

			$messages[] = "El Registro ha sido duplicado $cantidad vez/veces con éxito.";
		} catch (mysqli_sql_exception $e) {
			mysqli_rollback($conexion);
			if($e->getCode()==1062){
				$errors[] = "El folio ya existe. Por favor, vuelva a intentarlo.";
			}else{
				$errors[] = "Lo sentimos, el proceso falló. Por favor, regrese y vuelva a intentarlo.";
			}
		}
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
			echo htmlspecialchars($error);
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
			echo htmlspecialchars($message);
		}
		?>
	</div>
<?php
}
?>