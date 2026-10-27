<?php

include('fecha_actual.php');
include('conexion.php');

$Fecha_recepcion=$_POST['f_recepcion'];
$f_oficio=$_POST['f_oficio'];
$id_usuario=$_POST['id_usuario'];
$copia=$_POST['t_oficio'];
$remitente=$_POST['remitente'];
$cargo=$_POST['cargo'];
$nombre=($_POST['nombre']);
$n_oficio=$_POST['num_oficio'];
$destinatario=$_POST['destinatario'];
$cargo_dest=($_POST['cargo_d']);
$asunto= $_POST['asunto'];
$destacar=($_POST['destacar']);
$anexoa=($_POST['anexo']);
$leyenda=($_POST['leyenda']);
$direccion=$_POST['direccion'];
$Direccion=$direccion[0];
$instrucciones=($_POST['instrucciones']);
$id = $_POST['id-prod'];// id de la correspondencia
$proceso = $_POST['pro'];// estatus del envio del formulario


//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

$consulta1=mysqli_query($conexion, "SELECT * FROM datos_correspondencia ORDER by id_datos_c DESC LIMIT 1");

while($row1=mysqli_fetch_assoc($consulta1)){
	$folio=9444+$row1['id_datos_c'];
	$folio='09/'.$folio.'/01';
	$folio=ltrim($folio);
}

switch($proceso){
	case 'Registro':
		
		/*$registro1 =mysqli_query($conexion, "INSERT INTO datos_correspondencia (id_datos_c, folio, f_recepcion, tipo_oficio, id_remitente, cargo, Nombre, num_oficio, f_oficio, id_destinatarios, cargo_destinatario, asunto_destinatario, indicaciones_destinatario, anexo_destinatario, leyenda_destinatario, id_direcciones, instrucciones_direcciones) VALUES (NULL, '$folio', '$Fecha_recepcion', '$copia', '$remitente', '$cargo', '$nombre', '$n_oficio', '$f_oficio', '$destinatario', '$cargo_dest', '$asunto', '$destacar', '$anexoa', '$leyenda', '$Direccion', '$instrucciones')");*/
		
		if(count($direccion)>1){
		
		foreach($direccion as $Direccion_nuevo){
		
			$registro1 =mysqli_query($conexion, "INSERT INTO datos_correspondencia (id_datos_c, folio, f_recepcion, tipo_oficio, id_remitente, cargo, Nombre, num_oficio, f_oficio, id_destinatarios, cargo_destinatario, asunto_destinatario, indicaciones_destinatario, anexo_destinatario, leyenda_destinatario, id_direcciones, instrucciones_direcciones, id_estatus1, fecha_cap_c) 
												 VALUES (NULL, '$folio', '$Fecha_recepcion', '$copia', '$remitente', '$cargo', '$nombre', '$n_oficio', '$f_oficio', '$destinatario', '$cargo_dest', '$asunto', '$destacar', '$anexoa', '$leyenda', '$Direccion_nuevo', '$instrucciones', '1', '$fecha_hora')");
		
			$id_insert=mysqli_insert_id($conexion);
			
			$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) 
												VALUES (NULL, '$id_usuario', '$fecha_hora', '1', '$id_insert')");
			
			
		}
		
	    }else{
			
			$registro1 =mysqli_query($conexion, "INSERT INTO datos_correspondencia (id_datos_c, folio, f_recepcion, tipo_oficio, id_remitente, cargo, Nombre, num_oficio, f_oficio, id_destinatarios, cargo_destinatario, asunto_destinatario, indicaciones_destinatario, anexo_destinatario, leyenda_destinatario, id_direcciones, instrucciones_direcciones, id_estatus1, fecha_cap_c) 
												VALUES (NULL, '$folio', '$Fecha_recepcion', '$copia', '$remitente', '$cargo', '$nombre', '$n_oficio', '$f_oficio', '$destinatario', '$cargo_dest', '$asunto', '$destacar', '$anexoa', '$leyenda', '$Direccion', '$instrucciones', '1', '$fecha_hora')");			
			
			$id_insert=mysqli_insert_id($conexion);			
			
			$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) 
												VALUES (NULL, '$id_usuario', '$fecha_hora', '1', '$id_insert')");			
		}

	break;
	
	case 'Edicion':
	
		/*$registro2 = mysqli_query($conexion, "UPDATE datos_correspondencia SET f_recepcion = '$Fecha_recepcion', tipo_oficio = '$copia', id_remitente= '$remitente', cargo = '$cargo', Nombre = '$nombre', num_oficio= '$n_oficio', f_oficio = '$f_oficio', id_destinatarios = '$destinatario', cargo_destinatario= '$cargo_dest', asunto_destinatario = '$asunto', indicaciones_destinatario = '$destacar', anexo_destinatario = '$anexoa', leyenda_destinatario = '$leyenda', id_direcciones = '$Direccion', instrucciones_direcciones = '$instrucciones'     WHERE id_datos_c = '$id'");*/
		echo('La direccion tiene: '.count($direccion));
		if(count($direccion)>1){
			
			echo('paso primer condicion');
			
			$sacar_datos_Consulta=mysqli_query($conexion,"Select * from datos_correspondencia WHERE id_datos_c='$id'");
			
			while($row_datos=mysqli_fetch_assoc($sacar_datos_Consulta)){
				
				$folio1=$row_datos['folio'];
				$f_recepcion1=$row_datos['f_recepcion'];
				$tipo_oficio1=$row_datos['tipo_oficio'];
				$id_remitente1=$row_datos['id_remitente'];
				$cargo1=$row_datos['cargo'];
				$nombre1=$row_datos['Nombre'];
				$num_oficio1=$row_datos['num_oficio'];
				$f_oficio1=$row_datos['f_oficio'];
				$id_destinatarios1=$row_datos['id_destinatarios'];
				$cargo_destinatario1=$row_datos['cargo_destinatario'];
				$asunto_destinatario1=$row_datos['asunto_destinatario'];
				$indicaciones_destinatario1=$row_datos['indicaciones_destinatario'];
				$anexo_destinatario1=$row_datos['anexo_destinatario'];
				$leyenda_destinatario1=$row_datos['leyenda_destinatario'];
				$id_direcciones1=$row_datos['id_direcciones'];
				$instrucciones_direcciones1=$row_datos['instrucciones_direcciones'];
				$id_estatus1=$row_datos['id_estatus1'];
				$fecha_cap_c=$row_datos['fecha_cap_c'];
				
			}
			
			$contador=1;
				
			foreach($direccion as $Direccion_nuevo){
			
				if($contador>1)	{
					
					echo('paso segunda condicion');
					
					
					$Insertar =mysqli_query($conexion, "INSERT INTO datos_correspondencia (id_datos_c, folio, f_recepcion, tipo_oficio, id_remitente, cargo, Nombre, num_oficio, f_oficio, id_destinatarios, cargo_destinatario, asunto_destinatario, indicaciones_destinatario, anexo_destinatario, leyenda_destinatario, id_direcciones, instrucciones_direcciones, id_estatus1, fecha_cap_c) 
														VALUES (NULL, '$folio1', '$f_recepcion1', '$tipo_oficio1', '$id_remitente1', '$cargo1', '$nombre1', '$num_oficio1', '$f_oficio1', '$id_destinatarios1', '$cargo_destinatario1', '$asunto_destinatario1', '$indicaciones_destinatario1', '$anexo_destinatario1', '$leyenda_destinatario1', '$Direccion_nuevo', '$instrucciones_direcciones1','$id_estatus1', '$fecha_cap_c')");
					
					$id = mysqli_insert_id($conexion); 
					
					
					$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) 
														VALUES (NULL, '$id_usuario', '$fecha_hora', '1', '$id')");					
					
				}
					
					$registro2 = mysqli_query($conexion, "UPDATE datos_correspondencia SET f_recepcion = '$Fecha_recepcion', tipo_oficio = '$copia', id_remitente= '$remitente', cargo = '$cargo', Nombre = '$nombre', num_oficio= '$n_oficio', f_oficio = '$f_oficio', 
														  	id_destinatarios = '$destinatario', cargo_destinatario= '$cargo_dest', asunto_destinatario = '$asunto', indicaciones_destinatario = '$destacar', anexo_destinatario = '$anexoa', leyenda_destinatario = '$leyenda', 
														  	id_direcciones = '$Direccion', instrucciones_direcciones = '$instrucciones'     
														  WHERE id_datos_c = '$id'");				
					
					$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) VALUES (NULL, '$id_usuario', '$fecha_hora', '2', '$id')");
				
					$ejecutamosConsulta2 = $conexion->query($registro2);
					
					$contador++;
			}
			
		}else{
				
				$registro2 = mysqli_query($conexion, "UPDATE datos_correspondencia SET f_recepcion = '$Fecha_recepcion', tipo_oficio = '$copia', id_remitente= '$remitente', cargo = '$cargo', Nombre = '$nombre', num_oficio= '$n_oficio', f_oficio = '$f_oficio', id_destinatarios = '$destinatario', cargo_destinatario= '$cargo_dest', asunto_destinatario = '$asunto', indicaciones_destinatario = '$destacar', anexo_destinatario = '$anexoa', leyenda_destinatario = '$leyenda', id_direcciones = '$Direccion', instrucciones_direcciones = '$instrucciones'     WHERE id_datos_c = '$id'");
				
				$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) VALUES (NULL, '$id_usuario', '$fecha_hora', '2', '$id')");
		}
	
	break;
}

// imprimimos en nuestro div el contenido con el resutado

echo('
   <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
					<div class="row">
						<div class="col-md-8">
							<h4 class="card-title ">Correspondencia</h4>
							<link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
							<p class="card-category"> Historial de correspondencia agregada</p>
						</div>
						<div class="col-md-4">
							<button onClick="myFunction()" type="button" class="btn btn-round btn-secondary">Agregar Correspondencia</button>                 	
						</div>	
					</div>                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
						<thead class=" text-primary">
							<th>#</th>
							<th>Remitente</th>
							<th>Cargo</th>
							<th>Folio</th>
							<th>Fecha Recep</th>
							<th># Oficio</th>
							<th>Fecha Ofi</th>
							<th>Asunto</th>
							<th>Opciones</th>
							<th>Subir</th>
							<th>Archivo</th>					 	
						</thead>
                      	<tbody>');
                       
						$consulta=mysqli_query($conexion, 'SELECT datos_correspondencia.*, dependencias.* 
														   FROM datos_correspondencia, dependencias
														   WHERE datos_correspondencia.id_remitente=dependencias.id_dependencia');
							
							
						
						while($row=mysqli_fetch_assoc($consulta)){
							$id_correspondencia=$row['id_datos_c'];								
							$archivos=mysqli_query($conexion,"SELECT * FROM documentos WHERE id_datos_c1 = '$id_correspondencia'");								
							
							$c_arch=0;
							$rutas_archivos=array();  
							$nombres_archivo=array();
							
							while($row_archivos=mysqli_fetch_assoc($archivos)){
								$rutas_archivos[$c_arch]=$row_archivos['ruta'];
								$nombres_archivo[$c_arch]=$row_archivos['nombre_documento'];
								$c_arch++;							
							}
							 
						echo('<tr>
							<td>'.($row['id_datos_c']).'</td>
                            <td>'.($row['nombre']).'</td>
                            <td>'.($row['cargo']).'</td>
                            <td>'.$row['folio'].'</td>
                            <td>'.$row['f_recepcion'].'</td>
							<td>'.$row['num_oficio'].'</td>
							<td>'.$row['f_oficio'].'</td>
							<td>'.($row['asunto_destinatario']).'</td>
                            <td class="td-actions text-right" >
                              	<a   href="javascript:editarProducto('.$row['id_datos_c'].');" class="btn btn-warning btn-link btn-sm"  title="Editar" >
								 <button class="btn btn-warning btn-round"><i class="material-icons">edit</i></button></a>
								 
								<a href="javascript:Elimina_producto('.$row['id_datos_c'].');"  title="Eliminar" class="btn btn-danger btn-link btn-sm">
									<button class="btn btn-danger btn-round"><i class="material-icons" >close</i></button></a>
                            </td>
							<td class="td-actions text-right">
                         		<button class="btn btn-success btn-round" data-id="'.$row['id_datos_c'].'" data-toggle="modal" data-target="#exampleModal">      
								<i class="material-icons">cloud_upload</i></button>
							</td>');
						
							if($c_arch>0){
								for($i=0; $i<$c_arch; $i++){
									$existencia_archivos.='<a href="'.$rutas_archivos[$i].'"  title="'.$nombres_archivo[$i].'" class="btn btn-danger btn-link btn-sm" target="_blank">
										<button class="btn btn-info btn-round"><i class="material-icons" >picture_as_pdf</i></button></a>';
								}
							}else{
								$existencia_archivos='---__---';
							
							}	  
							echo(' <td class="td-actions text-right">'.$existencia_archivos.' </td>');
						echo('</tr>');
							
							$existencia_archivos='';
								
						}
					
                       
                    echo('</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>           
          </div>
        </div>
');



?>
<script type="text/javascript">

$(document).ready(function() {
    $('#dtBasicExample').DataTable({
        "order": [0, 'desc']
    });
    $('.dataTables_length').addClass('bs-select');
});

</script>