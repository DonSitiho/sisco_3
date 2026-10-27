<?php
	if (empty($_POST['view_instruc'])){
		$errors[] = "No llego la Instrucción";
	} elseif (!empty($_POST['view_instruc'])){
		
	require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$id_corr=$_POST['view_id'];
    $Instruccion = mysqli_real_escape_string($conexion,(strip_tags($_POST["view_instruc"],ENT_QUOTES)));
	
		
	// sacar fecha actual del sistema
		date_default_timezone_set('America/Mexico_City');
              setlocale(LC_TIME, 'es_MX.UTF-8');
             $fecha_actual=strftime("%Y-%m-%d");
             $fecha_hora=date("Y-m-d H:i:s");
// REGISTER data into database
    $sql = "UPDATE datos_correspondencia SET instrucciones_direcciones ='$Instruccion', id_estatus1='2', f_turnado='$fecha_actual'  WHERE datos_correspondencia.id_datos_c = '$id_corr';";
    $query = mysqli_query($conexion,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "Se ha Autorizado la correspondencia con Nº ".$id_corr;
    } else {
        $errors[] = "Lo sentimos, La Autorizacion de la correspondencia Fallo. Por favor, regrese y vuelva a intentarlo!";
    }
		
	} else 
	{
		$errors[] = "desconocido.";
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
?>