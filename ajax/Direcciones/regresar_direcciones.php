<?php
if(isset($_POST['view_id']) ){
	require_once('../../php/conexion.php');
    $id_corresp=$_POST['view_id'];

	$consulta_corresp    = mysqli_query($conexion, "SELECT direccion_que_turna
												 FROM datos_correspondencia
												 WHERE id_datos_c = '$id_corresp'");
	$row_consulta_corres = mysqli_fetch_assoc($consulta_corresp);

	$direccion_que_turna = $row_consulta_corres['direccion_que_turna'];
	$direccion_que_turna = intval($direccion_que_turna);

	if( $direccion_que_turna != NULL ){

	
	
	
	$nombre_archivo = $_FILES['doc_resp']['name'];
	$tipo_archivo = $_FILES['doc_resp']['type'];
	
	$documento=$_FILES['doc_resp'];
	//VERIFICAR SI EL DOCUMENTO ESTA LLEGANDO
	if(empty($nombre_archivo)){// si no llega solo se turna
		
		if(session_start()){
			$id_direccion  = $_SESSION['id_direccion'];
		}else{
			session_start();
		}
		//consultamos si el campon "direccion_que_tuerna" tiene datos en caso de ser cierto sacamos el dato
		
	
		
		//SI EL DOCUMENTO SE ALMACENO CORRECTAMENTE EN LA CARPETA DOCS_RESPUESTA ALMACENAMOS EN NUESTRA BD
		// $insert_docs=mysqli_query($conexion,"INSERT INTO `docs_finalizados` (`id_docs`, `nombre_docs`, `ruta_docs`, `fecha_cap`, `id_corresp1`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$id_corresp');");
		$modificar_estatus=mysqli_query($conexion," UPDATE `datos_correspondencia` 
													SET `id_direcciones` = '$direccion_que_turna', `direccion_que_turna` = 'NULL'
													WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");
		
		$consultaDireccion = mysqli_query($conexion, "SELECT nombre_direccion FROM direcciones_secoem WHERE id_direccion = '$direccion_que_turna'" );
		$rowConsultaDir = mysqli_fetch_assoc($consultaDireccion);
		$NombreDireccion = $rowConsultaDir['nombre_direccion'];
	
		echo('<script>
				swal({
	title: "¡Bien hecho!",
	text: "La correspondencia se Regreso a la : '.$NombreDireccion.' ",
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
		
	
	
	if (!((strpos($tipo_archivo, "pdf")))) {

	
	echo('<script>
				swal({
	title: "¡Error!",
	text: "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .pdf<br><li></td></tr></table>",
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
	 }else{
	//FSACAR FECHA Y HORA DEL SISTEMA
	
		date_default_timezone_set('America/Mexico_City');
		setlocale(LC_TIME, 'es_MX.UTF-8');
	   $fecha_hora=date("Y-m-d H:i:s");
	
		//sacar numero ramdom
		$random=rand(1, 10);
		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_respuesta/'.$id_corresp.'_'.$random.'_'.$nombre_archivo;
	   if (move_uploaded_file($documento['tmp_name'], $ruta)){
		//SI EL DOCUMENTO SE ALMACENO CORRECTAMENTE EN LA CARPETA DOCS_RESPUESTA ALMACENAMOS EN NUESTRA BD
		$insert_docs=mysqli_query($conexion,"INSERT INTO `docs_finalizados` (`id_docs`, `nombre_docs`, `ruta_docs`, `fecha_cap`, `id_corresp1`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$id_corresp');");
	
		$modificar_estatus=mysqli_query($conexion," UPDATE `datos_correspondencia` 
		                                            SET `id_direcciones` = '$direccion_que_turna', `direccion_que_turna` = 'NULL'
		                                            WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");

$consultaDireccion = mysqli_query($conexion, "SELECT nombre_direccion FROM direcciones_secoem WHERE id_direccion = '$direccion_que_turna'" );
$rowConsultaDir = mysqli_fetch_assoc($consultaDireccion);
$NombreDireccion = $rowConsultaDir['nombre_direccion'];
	
		echo('<script>
				swal({
	title: "¡Bien hecho!",
	text: "La correspondencia se Regreso a la : '.$NombreDireccion.' adjuntando el archivo: '.$nombre_archivo.'!",
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
	text: "Ocurrió algún error al subir el fichero. No pudo guardarse.!",
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
	}
	
	
	// }// comprovacion si llega el documento
	
	}

	}else{
		echo('<script>
				swal({
	title: "¡Error!",
	text: "Ocurrió error al regresar por que la correspondencia no tiene el id de la direccion!",
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
	text: "El documento no se almaceno correctamente!",
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