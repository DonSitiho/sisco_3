<?php
    
    //Procedimiento a realizar
if(isset($_GET['id'])){
    
$id_corres=$_GET['id'];	
include('../../php/conexion.php');

//SI LLEGA LA VARIABLE DE VISTO SE PROCEDE A MODIFICAR EL REGISTRO
if(isset($_GET['visto'])){
	//Fecha local
	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
	//consulta al registro vizualizado
	$consulta_oficios=mysqli_query($conexion,"SELECT copias_view, copias_direcciones, doc_original, original_view FROM oficios_conocimiento WHERE id='$id_corres'");
    $registro = mysqli_fetch_assoc($consulta_oficios);
	
	//FUNCION PARA COPIAS
	$arrayCopias   = $registro['copias_direcciones'];
	$arrayOriginal = $registro['doc_original'];
	$array         = explode ( ',', $arrayCopias ); //Convertir varchar separado por comas en un array
	$arrayO        = explode ( ',', $arrayOriginal ); 
	session_start();
	$clave  = array_search($_SESSION['id_direccion'], $array); // sacamos la posicion del id direccion
	$claveO = array_search($_SESSION['id_direccion'], $arrayO); // sacamos la posicion del id direccion
  // echo 'POSICION COPIA'.$clave.'<br>';
   //echo 'POSICION'.$claveO.'<br>';
	if ( in_array($_SESSION['id_direccion'], $array)){
		//Aqui van la funcion para las copias
		echo 'entro copia '. $clave;
		$arrayView = $registro['copias_view'];
		$arrayView = explode ( ',', $arrayView ); //Convertir varchar separado por comas en un array
		//var_dump($arrayView[$clave]);
		//var_dump($arrayView[$clave]);
		if($arrayView[$clave] == "0" ){
			$arrayView[$clave] = ('Visto por '.$_SESSION['nombre'].' el '. date('d-m-Y h:i:s a', time()));//insertamos los datos de vizualizacion
			//convertimos el array a string
			$string_view = implode(',', $arrayView);
			//modificamos el campo de view_direcciones de nuestro registro seleccionado
			$update_oficio="UPDATE oficios_conocimiento SET copias_view = '$string_view' WHERE id = $id_corres";
			//echo $update_oficio;
					
					
					
					if (mysqli_query($conexion,$update_oficio)){ //Ejecutamos la modificacion y verificamos la misma
						//echo "true";
					}else{
						//echo "false";
					}

		}

	}else{
		//echo 'NOO entro copia '.$clave.'<br>';
	}

	if (  in_array($_SESSION['id_direccion'], $arrayO)){
		//Aqui van la funcion para las copias
		//echo 'entro oRIGINAL';
		$arrayView = $registro['original_view'];
		$arrayView = explode ( ',', $arrayView ); //Convertir varchar separado por comas en un array
		//var_dump($arrayView[$clave]);
		//var_dump($arrayView[$clave]);
		if($arrayView[$claveO] == "0" ){
			$arrayView[$claveO] = ('Visto por '.$_SESSION['nombre'].' el '. date('d-m-Y h:i:s a', time()));//insertamos los datos de vizualizacion
			//convertimos el array a string
			$string_view = implode(',', $arrayView);
			//modificamos el campo de view_direcciones de nuestro registro seleccionado
			$update_oficio="UPDATE oficios_conocimiento SET original_view = '$string_view' WHERE id = $id_corres";
			//echo $update_oficio;
					
					
					
					if (mysqli_query($conexion,$update_oficio)){ //Ejecutamos la modificacion y verificamos la misma
						echo "true";
					}else{
						echo "false";
					}

		}
	}else{
		echo 'NOO entro ORIGINAL '. $claveO;
	}


   

	
   
	

}
	//CONSULTAR LOS DOCUMENTOS DE LA CORRESPONDENCIA
	$consulta_archivos=mysqli_query($conexion,"SELECT * FROM docs_conocimiento WHERE id_ofi_conocimiento='$id_corres'");
	$num_rows = mysqli_num_rows($consulta_archivos);
	//CONSULTAR LOS DOCUMENTOS FINALIZADOS
	
	echo('<div class="row">
	<div class="col-md-12">
		<div class="card" style="border-radius:25px !important;">


			<div class="card-body">
				<div class="card-header text-center notice notice-danger redondeo-center">
					<h3 style="color: rgba(8,16,104,1.00)">Archivos Adjuntos</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							
							<table class="table table-striped table-sm">
								<thead style="border-radius: 25px !important;">
									<tr>

										<th class="text-center">Nombre del Archivo</th>
										<th class="text-center">Ver Archivo</th>

									</tr>
								</thead>
								<tbody>');
	if ($num_rows!=0){
		
	while($obtener_Datos=mysqli_fetch_assoc($consulta_archivos)){
		echo('<tr>
										<td class="text-center">'.$obtener_Datos['nombre'].'</td>
										<td class="text-center">
											<ul class="list-unstyled">
												<li class="active"><a title="'.$obtener_Datos['nombre'].'" href="'.$obtener_Datos['ruta'].'" target="_blank"><img src="../../images/pdf.ico" width="13%;" alt="'.$obtener_Datos['nombre'].'" /></a>
												</li>
												<ul></ul>
										</td>
									</tr>');
		//imprimir en pantalla los documentos finalizados

	}
		
		echo('
								</tbody>
							</table>
						</div>
					</div>');
}else{
echo "<center><h7>No hay archivos vinculados a esta correspondencia</h7></center>";
}
									
		
		  echo(' </div>
	      </div>');

	
}else{
	echo('Error en la funcion mostrararchivos no llego el id > listar.php');
}



?>