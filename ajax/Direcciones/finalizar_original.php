<?php
if(isset($_POST['view_id']) ){
	//Variables
$folio=$_POST['view_folio_input'];
$c_o_o = substr($folio, -1);	
	//tipo de correspondencia
$tipo_corresp=$_POST['view_t_oficioinput'];
	// id de la correspondencia
$id_corresp=$_POST['view_id'];
	//Datos del archivo adjunto
$nombre_archivo = $_FILES['doc_resp']['name'];
$tipo_archivo = $_FILES['doc_resp']['type'];
$documento=$_FILES['doc_resp'];
	//FSACAR FECHA Y HORA DEL SISTEMA
 require_once('../../php/conexion.php');
 date_default_timezone_set('America/Mexico_City');
 setlocale(LC_TIME, 'es_MX.UTF-8');
 $fecha_hora=date("Y-m-d H:i:s");
	//sacar numero ramdom
$random=rand(1, 10);
	//Condicion si es para el titular o es de conocimiento
if($tipo_corresp==0){
	//**************Es original***************
	if($nombre_archivo){
		if (!((strpos($tipo_archivo, "pdf")))) {
   	echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .pdf<br><li></td></tr></table>";
}else{
	
		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_respuesta/'.$id_corresp.'_'.$random.'_'.$nombre_archivo;
   	if (move_uploaded_file($documento['tmp_name'], $ruta)){
		//SI EL DOCUMENTO SE ALMACENO CORRECTAMENTE EN LA CARPETA DOCS_RESPUESTA ALMACENAMOS EN NUESTRA BD
		$insert_docs=mysqli_query($conexion,"INSERT INTO `docs_finalizados` (`id_docs`, `nombre_docs`, `ruta_docs`, `fecha_cap`, `id_corresp1`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$id_corresp');");
		$modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");
		
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
	}else{//No podra finalizar hasta adjuntar algun documento
		echo('<script>
				swal({
	title: "¡No puedes Finalizar!",
	text: "No puedes Finalizar hasta adjuntar un documento con la respuesta!!",
	icon: "warning",
	buttons: {
		confirm: {
			text: "Aceptar",
			value: true,
			visible: true,
			className: "btn btn-warning",
			closeModal: true
		}
	}
});
				</script>');
	}
	
	//***********Fin funcion de original ****************
}else{
//******************es de conocimiento**************
	//Verificaremos si quiere adjuntar un documento
	if($nombre_archivo){//quiere adjuntar
		echo('Quiere adjuntar');
		if (!((strpos($tipo_archivo, "pdf")))) {//Verificamos si es pdf
   	    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .pdf<br><li></td></tr></table>";
			
        }else{//Si es PDF entonces....
	
		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_respuesta/'.$id_corresp.'_'.$random.'_'.$nombre_archivo;
   	if (move_uploaded_file($documento['tmp_name'], $ruta)){
		//SI EL DOCUMENTO SE ALMACENO CORRECTAMENTE EN LA CARPETA DOCS_RESPUESTA ALMACENAMOS EN NUESTRA BD
		$insert_docs=mysqli_query($conexion,"INSERT INTO `docs_finalizados` (`id_docs`, `nombre_docs`, `ruta_docs`, `fecha_cap`, `id_corresp1`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$id_corresp');");
		//Modificamos estatus de la correspondencia
		$modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");
		
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
	}else{//No quiere adjuntar
		echo('No!! Quiere adjuntar');
		//Solo modificamos estatus
		$modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");
		//Mensaje
		echo('<script>
				swal({
	title: "¡Bien hecho!",
	text: "La correspondencia se finalizo sin Adjuntar ningun documento",
	icon: "info",
	buttons: {
		confirm: {
			text: "Aceptar",
			value: true,
			visible: true,
			className: "btn btn-info",
			closeModal: true
		}
	}
});
				</script>');
	}
}
	

	
}else{
	echo('<script>
				swal({
	title: "¡Error!",
	text: "No llego el identificador de la correspondencia",
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