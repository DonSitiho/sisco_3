<?php

//llamamos nuestra variable de conexion
include_once('../../php/conexion.php');

if(isset($_POST['no_oficio_resp'])){//Verificamos que nestra id de la correpsondencia llego
	//Almacenamos daros pos a variables locales

    $id_inicial=$_POST['id_doc_ini'];
    $no_oficio=$_POST['no_oficio_resp'];
    $no_referencia=$_POST['no_referencia_resp'];
	$fecha=$_POST['fecha_resp'];
	$asunto=$_POST['asunto_resp'];
	$destinatario=$_POST['destinatario_resp'];
	$remitente=$_POST['remitente_resp'];
	//$original = $_POST['destino_envio_resp'];
	$id_original = $_POST['id_destino_resp'];
	//var_dump($original);
	$copias_direcciones = $_POST['ids_copias_resp'];
    $nombre_archivo = $_FILES['doc_resp_resp']['name'];
    $tipo_archivo = $_FILES['doc_resp_resp']['type'];
    $documento=$_FILES['doc_resp_resp'];
	$tipo_doc=$_POST['tipoResp'];//Tipo oficio
	$respuesta = 1;
	
	//$num_copias = count($copias);
	
	date_default_timezone_set('America/Mexico_City');
	setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_hora=date("Y-m-d");
	$random=rand(1, 10);
	session_start();
    $id_direccion=$_SESSION['id_direccion'];
	$id_usuario=$_SESSION['id_usuario'];
	$nivel_acceso=$_SESSION['nivel_acceso'];
	$subdireccion = $_SESSION['subdireccion'];
	$depto = $_SESSION['depto'];

	if($id_direccion==2 && $nivel_acceso==1){
		$campo=' ';
		$valor = ' ';
		
	}else{ 
		$campo=' ';
		$valor = ' ';

		if($subdireccion == 0 or $subdireccion == NULL ){
			
			echo "Direccion ";
			
		}elseif($depto == 0 or $subdireccion == NULL ){
			$campo=', `id_subdireccion` ';
			$valor = ", '".$subdireccion."' ";
			echo "subdireccion";
			
		}else{
			$campo=', `id_subdireccion`, `id_departamento`';
			$valor = ", '".$subdireccion."' ,". "'".$depto."'";
			echo "departamento ";
			
		}
		
	}

		//CREAR VARIABLE RUTA Y SE LE ASIGNA VALOR
		$ruta='../../Docs_conocimiento/'.$random.'_'.$nombre_archivo;
		//Comprobamos si el archivo se envio a su destino correctamente
	
   	    if (move_uploaded_file($documento['tmp_name'], $ruta)){

			// $JsonObject = json_encode($copias);
			// $copias_direcciones = str_replace("[[", "", $JsonObject);
			// $copias_direcciones = str_replace("]]", "", $copias_direcciones);
			// $copias_direcciones = str_replace('"', "", $copias_direcciones);
			$array_dir = explode ( ',', $copias_direcciones);
			$num_elem = count($array_dir);
			$array_view = array_fill(0, $num_elem, 0);
			$array_resp = array_fill(0, $num_elem, 0);
			$string_view = implode(',', $array_view);
			$string_resp = implode(',', $array_resp);
			
			$insert_oficio="INSERT INTO `oficios_conocimiento` (`id`, `remitente`, `no_oficio`, `fecha`, `no_referencia`, `asunto`, `destinatario`, `id_direcciones`, `doc_original`, `copias_direcciones`, `copias_view`, `copias_resp`, `tipo_documento`, `respuesta`, `revisado` ".$campo.")
			VALUES (NULL, '$remitente', '$no_oficio', '$fecha', '$no_referencia', '$asunto', '$destinatario', '$id_direccion', '$id_original', '$copias_direcciones', '$string_view', '$string_resp', '$tipo_doc', '$respuesta', 0 ".$valor.");";
			  
			if (mysqli_query($conexion,$insert_oficio)){ 

   				//recibo el último id
   	            $ultimo_id = mysqli_insert_id($conexion); 
				  
				$insert_docs=mysqli_query($conexion,"INSERT INTO `docs_conocimiento` (`id`, `nombre`, `ruta`, `fecha_cap`, `id_ofi_conocimiento`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$ultimo_id');");

				//realizar update al registro inicial

				$sql = "UPDATE `oficios_conocimiento` SET `id_referencia` = '$ultimo_id', `respuesta` = '$respuesta' WHERE `id` = $id_inicial";	
    
   
    			$query = mysqli_query($conexion,$sql);

    
            }else{ 

                echo "La inserción no se realizó"; 
            }
			
			
	    }else{//El archivo no se movio correctmente
		     //Mensaje de error!!!!!
			  echo('El archivo no se movio correctamente');
	    }
			
	
}else{//No llego el id de la correspondencia
	echo('No llego el id de la captura');
}
