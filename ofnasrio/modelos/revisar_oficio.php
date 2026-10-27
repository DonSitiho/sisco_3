<?php
if(isset($_POST['id_oficio']) ){
	
	include_once('../conexion/conexion.php');
	if(session_start()){
		$Usuario = $_SESSION['nombre'];
	}else{
		session_start();
		$Usuario = $_SESSION['nombre'];
	}
	$idOficio = $_POST['id_oficio'];
	date_default_timezone_set('America/Mexico_City');
	setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_hora=date("Y-m-d H:i:s");

	$modificar_registro = mysqli_query($conexion,"UPDATE `oficios_conocimiento` 
	                                              SET `revisado` = '1', `nom_revisor` = '$Usuario', `fecha_revisado` = '$fecha_hora'
												  WHERE `oficios_conocimiento`.`id` = $idOficio;");
	if( $modificar_registro ){

		echo('<script>
			swal({
 title: "¡Bien hecho!",
text: "Se a marcado como revisado el oficio",
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
	}else{
		echo('<script>
			swal({
title: "¡Error!",
text: "Error al hacer el cambio en la base de datos! Notificar al administrador",
icon: "danger",
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
	


	 
	
}else{
	echo('<script>
				swal({
	title: "¡Error!",
	text: "El identificador del oficio no llego, Notificar al administrador",
	icon: "danger",
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