<?php
if(isset($_POST['view_id']) ){
$id_corresp=$_POST['view_id'];
$nombre_archivo = $_FILES['doc_resp']['name'];
$tipo_archivo = $_FILES['doc_resp']['type'];

$documento=$_FILES['doc_resp'];
	
	//VERIFICAR SI EL DOCUMENTO ESTA LLEGANDO
	if(empty($nombre_archivo)){
		echo('<script>
				swal({
	title: "¡Error!",
	text: "Debes Adjuntar un archivo PDF!!",
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
 require_once('../../php/conexion.php');
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
		$modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '3', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");
		
		echo('<script>
				swal({
	title: "¡Bien hecho!",
	text: "La correspondencia se finalizo con el archivo: '.$nombre_archivo.'!",
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

	
	}// comprovacion si llega el documento
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