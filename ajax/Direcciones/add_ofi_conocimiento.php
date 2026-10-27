<?php

//llamamos nuestra variable de conexion
include_once('../../php/conexion.php');
if(isset($_POST['no_oficio'])){//Verificamos que nestra id de la correpsondencia llego
	//Almacenamos daros pos a variables locales
    $no_oficio=$_POST['no_oficio'];
	$fecha=$_POST['fecha'];
	$asunto=$_POST['asunto'];
	$destinatario=$_POST['destinatario'];
	$remitente=$_POST['remitente'];
	$original[] = $_POST['direccionMultiselect'];
    $nombre_archivo = $_FILES['doc_resp']['name'];
    $tipo_archivo = $_FILES['doc_resp']['type'];
    $documento=$_FILES['doc_resp'];
	$tipo_doc=$_POST['tipo'];//Tipo oficio

	if( isset($_POST['subdireccionMultiselect'])){		
		$copias[] = $_POST['subdireccionMultiselect'];
	}else{
		$copias[0] = [9999] ;
	}
	
	$respuesta = 0;
	
	$num_copias = count($copias);
	
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
	$t_destino = $_POST['t_destinatario'];

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

			$JsonObject = json_encode($copias);
			$copias_direcciones = str_replace("[[", "", $JsonObject);
			$copias_direcciones = str_replace("]]", "", $copias_direcciones);
			$copias_direcciones = str_replace('"', "", $copias_direcciones);
			$array_dir = explode ( ',', $copias_direcciones);
			$num_elem = count($array_dir);
			$array_view = array_fill(0, $num_elem, 0);
			$array_resp = array_fill(0, $num_elem, 0);
			$string_view = implode(',', $array_view);
			$string_resp = implode(',', $array_resp);

			if ( $t_destino == 0){
				
				// COMPROBAMOS SI FUE SELECCIONADA LA OPCIÓN "TODAS LAS AREAS DE SECOEM ["8888"]" 
				if($original[0]==[8888]){
				    
					// CREAR EL ARRAY DE DIRECCIONES
					$consulta_originales_copia=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion != '0' AND id_direccion != '9999' AND id_direccion != '8888' AND id_direccion != '$id_direccion'");
					
					$idsOriginal = array();
					$cont = 0;
					while ($row = @mysqli_fetch_array($consulta_originales_copia)) {
						$idsOriginal[$cont] = $row['id_direccion'];
						$cont++;
					}

					$string_JsonIds = json_encode($idsOriginal);
					$ids_direcciones = str_replace("[", "", $string_JsonIds);
					$string_JsonIds = str_replace("]", "", $ids_direcciones);
					$string_JsonIds = str_replace('"', "", $string_JsonIds);		
					// var_dump($idsOriginal);
					// exit;
					
					
				}else{ //ENTRA AQUI SI SE SELECCIONO UNA O MÁS ÁREAS DE SECOEM
					
					$string_JsonIds = json_encode($original);
					$ids_direcciones = str_replace("[[", "", $string_JsonIds);
					$ids_direcciones = str_replace("]]", "", $ids_direcciones);
					$string_JsonIds = str_replace('"', "", $ids_direcciones);				
					
				}

				$iddependencia = 9999;

			}else{
				//dependencias
				$iddependencia = $_POST['destino_externo_envio'];
				$string_JsonIds =  8888;
			}

			//generar el array de visializaciones del archivo original
			$array_dir_original = explode ( ',', $string_JsonIds);
			$num_dir_original = count($array_dir_original);
			//var_dump($array_dir_original);
			$array_view_original = array_fill(0, $num_dir_original, 0);
			$string_view_original = implode(',', $array_view_original);
			//var_dump($string_view_original);
			//exit;

			$insert_oficio="INSERT INTO `oficios_conocimiento` (`id`, `remitente`, `no_oficio`, `fecha`, `no_referencia`, `asunto`, `t_destino` ,`destinatario`, `id_direcciones`, `id_dependencia`, `doc_original`, `copias_direcciones`, `original_view`, `copias_view`, `copias_resp`, `tipo_documento`, `respuesta`, `revisado` ".$campo.")
			VALUES (NULL, '$remitente', '$no_oficio', '$fecha',  '$no_oficio', '$asunto', '$t_destino', '$destinatario', '$id_direccion', '$iddependencia', '$string_JsonIds', '$copias_direcciones', '$string_view_original', '$string_view', '$string_resp', '$tipo_doc', '$respuesta', 0 ".$valor.");";
			
			
			  
			if (mysqli_query($conexion,$insert_oficio)){ 

   				//recibo el último id
   	            $ultimo_id = mysqli_insert_id($conexion); 
				  
				$insert_docs=mysqli_query($conexion,"INSERT INTO `docs_conocimiento` (`id`, `nombre`, `ruta`, `fecha_cap`, `id_ofi_conocimiento`) VALUES (NULL, '$nombre_archivo', '$ruta', '$fecha_hora', '$ultimo_id');");
    
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