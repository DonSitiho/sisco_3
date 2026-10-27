<?php
	if (empty($_POST['view_instruc'])){
		$errors[] = "No llego la Instrucción";
	} elseif (!empty($_POST['view_instruc'])){
		session_start();
		$id_usuario=$_SESSION['id_usuario'];
	require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
		
		require_once ("../../php/fecha_actual.php");
		$Asunto=mysqli_real_escape_string($conexion,(strip_tags($_POST["view_asunto"],ENT_QUOTES)));
        $Instruccion = mysqli_real_escape_string($conexion,(strip_tags($_POST["view_instruc"],ENT_QUOTES)));
		  $Observaciones = mysqli_real_escape_string($conexion,(strip_tags($_POST["view_obs"],ENT_QUOTES)));
	    $id_corr=$_POST['view_id'];
		//AUTORIZAR ORIGINAL Y COPIAS
		$folio=$_POST['folio'];
		$newFolio = substr($folio, 0, 9); // devuelve "00/00000/"
	    $sacar_copias=mysqli_query($conexion,"SELECT id_datos_c FROM `datos_correspondencia` WHERE `folio` LIKE '%$newFolio%' limit 10");
		while($rows_copias=mysqli_fetch_assoc($sacar_copias)){
			$idCorresp=$rows_copias['id_datos_c'];
			$sql1 = "UPDATE datos_correspondencia SET instrucciones_direcciones ='$Instruccion', id_estatus1='2', f_turnado='$fecha_actual', asunto_destinatario='$Asunto', leyenda_destinatario='$Observaciones'  WHERE datos_correspondencia.id_datos_c = '$idCorresp';";
					
					$query = mysqli_query($conexion,$sql1);
		}
		//AUTORIZAR ORIGINL Y COPIAS 
	$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) VALUES (NULL, '$id_usuario', '$fecha_hora', '4', '$id_corr')");
    // if product has been added successfully
	
	 
    if ($query ) {
        $messages[] = "Se ha Autorizado la correspondencia!";
    } else {
        $errors[] = "Lo sentimos, La Autorizacion de la correspondencia Fallo. Por favor, regrese y vuelva a intentarlo!";
    
		
	} 
if (isset($errors)){
	echo('<script>
				swal({
	title: "¡Error del sistema!",
	text: "');
	foreach ($errors as $error) {
		echo $error;
	}			
	echo('",
	icon: "error",
	buttons: {
		confirm: {
			text: "Aceptar",
			value: true,
			visible: true,
			className: "btn btn-danger",
			closeModal: true
		}
	}
});
				</script>');
			
}
			if (isset($messages)){
				
				echo('<script>
				swal({
	title: "¡Bien hecho!",
	text: "');
	foreach ($messages as $message) {
		echo $message;
	}			
	echo('",
	icon: "success",
	buttons: {
		confirm: {
			text: "Aceptar",
			value: true,
			visible: true,
			className: "btn btn-success",
			closeModal: true
		}
	}
});
				</script>');
				
				
			
}
		}else{
	echo('<script>
				swal({
	title: "¡Error del sistema!",
	text: "Debe seleccionar alguna direccion!",
	icon: "error",
	buttons: {
		confirm: {
			text: "Aceptar",
			value: true,
			visible: true,
			className: "btn btn-danger",
			closeModal: true
		}
	}
});
				</script>');
 }	
?>