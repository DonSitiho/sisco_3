<?php
if(isset($_POST['view_id'])){//Verificamos que nestra id de la correpsondencia llego
	//Almacenamos daros pos a variables locales
     $id_docs_finalizados=$_POST['view_id'];
     $nombre_archivo = $_FILES['doc_resp']['name'];
     $tipo_archivo = $_FILES['doc_resp']['type'];
     $documento=$_FILES['doc_resp'];
	
	$folio=$_POST['view_folio_input'];//Folio
	
	$tipo_oficio=$_POST['view_t_oficioinput'];//Tipo oficio
   //llamamos nuestra variable de conexion
	
include_once('../../php/conexion.php');
	//Sacamos la fecha actual del sistema
	date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, 'es_MX.UTF-8');
       $fecha_hora=date("Y-m-d H:i:s");
	
	if($tipo_oficio==0){//Tiene que finalizar con archivo
		//Realizamos la consulta
$consultarArchivos="SELECT id_corresp1 FROM docs_finalizados WHERE id_corresp1='$id_docs_finalizados';";
	//Ejecutammos nuestra consulta
$qslArchivos=mysqli_query($conexion,$consultarArchivos);
	//Variable para almacenar si llegan datos de la BD
$rowsArchivos=mysqli_fetch_row($qslArchivos);
//Comprobaremos si tiene registros nuestra consulta
	if($rowsArchivos){//Si tenemos Registros podra finalizar
		/*echo('Si!! tienes registros');*/
		//Verificamos si quieren adjuntar otro ducumento a la correspondencia
		
		//********TIENE ARCHIVOS RELACIONADOS*****************
		
		//VERIFICAMOS SI QUIERE ADJUNTAR ALGUN DOCUMENTO
		if($nombre_archivo){//Quiere finalizar y adjuntar archivo
			
			//sacar numero ramdom Para que no replicar el nombre de otro archivo
	    $random=rand(1, 10);
		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_respuesta/'.$id_docs_finalizados.'_'.$random.'_'.$nombre_archivo;
		//Comprovamos si el archivo se envio a su destino correctamente
   	      if (move_uploaded_file($documento['tmp_name'], $ruta)){
			  //Insertamos a nuestra BD los datos de documento
		      $insert_docs=mysqli_query($conexion,"INSERT INTO `docs_finalizados` (`id_docs`, `nombre_docs`, `ruta_docs`, `fecha_cap`, `id_corresp1`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$id_docs_finalizados');");
			  //Modificamos el estatus de la correspondencia
		       $modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_docs_finalizados';");
		
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
	      }else{//El archivo no se movio correcatmente
		     //Mensaje de error!!!!!
			  
	      }
			
			echo('<br>Tiene documento y quiere adjuntar otro');
		}else{//Solo quiere finalizar
			//Modificamos el estatus y ingresamos la fecha de finalizacion
			$modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_docs_finalizados';");
			//Mostramos mensaje de finalizacion
			  echo('<script>
				            swal({
	                          title: "¡Bien hecho!",
	                          text: "La correspondencia se finalizo Correctamente",
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
		
		/*echo('Nombre_documentos: '.$nombre_archivo);*/
	}else{//No podra finalizar hasta que adjunte un archivo
		
		//********NO TIENE ARCHIVOS **********
		
		if($nombre_archivo){//Quiere finalizar y adjuntar archivo
			
			//sacar numero ramdom Para que no replicar el nombre de otro archivo
	    $random=rand(1, 10);
		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_respuesta/'.$id_docs_finalizados.'_'.$random.'_'.$nombre_archivo;
		//Comprovamos si el archivo se envio a su destino correctamente
   	      if (move_uploaded_file($documento['tmp_name'], $ruta)){
			  //Insertamos a nuestra BD los datos de documento
		      $insert_docs=mysqli_query($conexion,"INSERT INTO `docs_finalizados` (`id_docs`, `nombre_docs`, `ruta_docs`, `fecha_cap`, `id_corresp1`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$id_docs_finalizados');");
			  //Modificamos el estatus de la correspondencia
		       $modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_docs_finalizados';");
		
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
	      }else{//El archivo no se movio correcatmente
		     //Mensaje de error!!!!!
			  
	      }
			
			
		}else{//Solo quiere finalizar PERO NO TIENE ARCHIVOS ADJUNTOS*****
			//MOSTRAR EERROR POR QUE NO TIENE ARCHIVOS NI QUIERE ADJUNTAR
			 echo('<script>
				            swal({
	                          title: "NO PUEDES FINALIZAR EL PROCESO",
	                          text: "Tienes que adjuntar un archivo PDF para poder Finalizar, ¡Vuelve a intentarlo!",
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
	}
	}else{//Puede finalizar sin archivo
		
		if($nombre_archivo){//Quiere finalizar y adjuntar archivo
			
			//sacar numero ramdom Para que no replicar el nombre de otro archivo
	    $random=rand(1, 10);
		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_respuesta/'.$id_docs_finalizados.'_'.$random.'_'.$nombre_archivo;
		//Comprovamos si el archivo se envio a su destino correctamente
   	      if (move_uploaded_file($documento['tmp_name'], $ruta)){
			  //Insertamos a nuestra BD los datos de documento
		      $insert_docs=mysqli_query($conexion,"INSERT INTO `docs_finalizados` (`id_docs`, `nombre_docs`, `ruta_docs`, `fecha_cap`, `id_corresp1`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$id_docs_finalizados');");
			  //Modificamos el estatus de la correspondencia
		       $modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_docs_finalizados';");
		
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
	      }else{//El archivo no se movio correcatmente
		     //Mensaje de error!!!!!
			  
	      }
			
			
		}else{//Solo quiere finalizar PERO NO TIENE ARCHIVOS ADJUNTOS*****
		//Finalizamos correspondencia
			 $modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_docs_finalizados';");
			
			 echo('<script>
				            swal({
	                          title: "Finalizaste la correspondencia con exito",
	                          text: "Se finalizo sin adjuntar ningun archivo",
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
	
/*if()*/	
	
	
}else{//No llego el id de la correspondencia
	echo('No llego el id de la correspondencia');
}


?>