<?php
if(isset($_POST['no_oficio'])){//Verificamos que nestra id de la correpsondencia llego
	//Almacenamos daros pos a variables locales
    $no_oficio=$_POST['no_oficio'];
	$fecha=$_POST['fecha'];
	$asunto=$_POST['asunto'];
	$destinatario=$_POST['destinatario'];
	$remitente=$_POST['remitente'];
	
     $nombre_archivo = $_FILES['doc_resp']['name'];
     $tipo_archivo = $_FILES['doc_resp']['type'];
     $documento=$_FILES['doc_resp'];
      $tipo_doc=$_POST['tipo'];//Tipo oficio
	  $id_direccion=$_POST['id_direccion'];
	  
   //llamamos nuestra variable de conexion
	
include_once('../conexion/conexion.php');
	//Sacamos la fecha actual del sistema
	date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, 'es_MX.UTF-8');
       $fecha_hora=date("Y-m-d");
	
       $random=rand(1, 10);
    
	
		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_conocimiento/'.$random.'_'.$nombre_archivo;
		//Comprovamos si el archivo se envio a su destino correctamente
	
   	      if (move_uploaded_file($documento['tmp_name'], $ruta)){
			  
			  $insert_oficio="INSERT INTO `oficios_conocimiento` (`id`, `remitente`, `no_oficio`, `fecha`, `asunto`, `destinatario`, `id_direcciones`, `tipo_documento`, `ofi_status`, `fecha_captura`, `revisado`) VALUES (NULL, '$remitente', '$no_oficio', '$fecha', '$asunto', '$destinatario', '$id_direccion', '$tipo_doc', 1, '$fecha_hora', 0);";
			  
			  if (mysqli_query($conexion,$insert_oficio)){ 

   	//recibo el último id
   	             $ultimo_id = mysqli_insert_id($conexion); 
				  
				   $insert_docs=mysqli_query($conexion,"INSERT INTO `docs_conocimiento` (`id`, `nombre`, `ruta`, `fecha_cap`, `id_ofi_conocimiento`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$ultimo_id');");
    
                }else{ 
                	echo "La inserción no se realizó"; 
              }
			
			
	      }else{//El archivo no se movio correcatmente
		     //Mensaje de error!!!!!
			  echo('El archivo no se movio correctamente');
	      }
			
	
	
/*if()*/	
	
	
}else{//No llego el id de la correspondencia
	echo('No llego el id de la captura');
}


?>