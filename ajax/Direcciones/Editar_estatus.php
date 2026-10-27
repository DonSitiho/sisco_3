<?php

	if (empty($_POST['estatus'])){
		$errors[] = "No llego la Instrucción";
	} else{
	
	require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	date_default_timezone_set('America/Mexico_City');
              setlocale(LC_TIME, 'es_MX.UTF-8');
             $fecha_actual=strftime("%Y-%m-%d");
             $fecha_hora=date("Y-m-d H:i:s");
		
	$id_corr=mysqli_real_escape_string($conexion,$_POST['view_id']);
	$estatus=mysqli_real_escape_string($conexion,$_POST["estatus"]);
   
		
    //AUTORIZAR ORIGINAL Y COPIAS
		
			 $sql = "UPDATE `datos_correspondencia` SET  id_estatus1='$estatus' WHERE `datos_correspondencia`.`id_datos_c` = '$id_corr' LIMIT 1;";
            $query = mysqli_query($conexion,$sql);
	
		//AUTORIZAR ORIGINL Y COPIAS 
		
	// sacar fecha actual del sistema
		
// REGISTER data into database
		
  
	
	
    // if product has been added successfully
    if ($query) {
        $messages[] = "Se ha Editado Con exito ";
    } else {
        $errors[] = "Lo sentimos, Al editar la correspondencia Fallo. Por favor, regrese y vuelva a intentarlo!";
    }
		
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
	icon: "info",
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