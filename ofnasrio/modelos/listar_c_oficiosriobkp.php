<?php
	
	/* Connect To Database*/
	require_once ("../../ajax/conexion.php");
	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");
	$hoy=date('Y-m-d');

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){

	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query1'], ENT_QUOTES)));
	$query2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query2'], ENT_QUOTES)));
	$query3 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query3'], ENT_QUOTES)));
	
	$tables="num_oficios as o";
	$campos="o.*, d.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
	
	
	if ($query2==0 AND $query3==0 AND $query==0){
	$sWhere=" o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
			  o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
			  o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
			  o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
			  o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
			  o.estatus_oficio LIKE '%".$query1."%'";
	
	}elseif($query2==0 AND $query==0 AND $query3>0){
		$sWhere=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.id_direccion = '".$query3."')";
	

	}elseif($query2>0 AND $query3==0 AND $query==0){				
		$sWhere=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.id_dependencia = '".$query2."')";

	}elseif($query2==0 AND $query3==0 AND $query>0){				
		$sWhere=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.estatus_oficio = '".$query."')";

	}elseif($query2>0 AND $query3==0 AND $query>0){	
		$sWhere=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.id_dependencia = '".$query2."') AND (o.estatus_oficio = '".$query."') ";

	}elseif($query2==0 AND $query3>0 AND $query>0){	
			$sWhere=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
						o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
						o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
						o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
						o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
						o.estatus_oficio LIKE '%".$query1."%') AND (o.id_direccion = '".$query3."') AND (o.estatus_oficio = '".$query."') ";
	}else{

		$sWhere=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.estatus_oficio = '".$query."') AND (o.id_dependencia = '".$query2."') AND (o.id_direccion = '".$query3."')";

	}

	$sWhere.="order by o.no_oficio DESC";
				

	
	include '../../ajax/pagination.php';  //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	$query = mysqli_query($conexion,"SELECT $campos FROM  $tables INNER JOIN dependencias AS d ON d.id_dependencia=o.id_dependencia																	 																  
																  where $sWhere LIMIT $offset,$per_page");
	
	
	//loop through fetched data
	// INICIAR SESSION
	session_start();
	$nivel_usuario=$_SESSION['nivel_acceso'];
	
	if ($numrows>0){
		
	?>
	
		<div class="table-responsive">
			<table class="table table-striped  table-hover table-responsive">
				<thead>
					<tr>
						<!--<th class='text-center'>id</th>-->
						<!--<th class='text-center'>Tipo</th>-->						
						<th  class='text-center'>No Oficio</th>
						<th colspan='3'>Fecha<br>solicitado</th>				
						<th>Dependencia<br>(destino)</th>										
						<th>Nombre<br>Cargo</th>						
						<th colspan='3'>Asunto</th>
						<th>Solicitó</th>
						<th colspan='2'>Area</th>
						<th>Status/<br>OficioRel</th>						
						<th class='text-center' colspan="6">Opciones</th>
						
					</tr>
				</thead>
				<tbody>	 
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$ofi_id=$row['no_oficio'];
							$ofi_fsolicitado=$row['fecha_solicitado'];							
							$ofi_foficio=$row['fecha_oficio'];
							$ofi_iddep=$row['id_dependencia'];
							$ofi_nomDestino=$row['dnom'];
							$ofi_nomofi=$row['nombre_oficio'];
							$ofi_cargofi=$row['cargo_oficio'];
							$ofi_asunto=$row['asunto_oficio'];							
							$ofi_solicitante=$row['solicitante_oficio'];
							$ofi_idarea=$row['id_direccion'];
							//consult6a
							$consul=mysqli_query($conexion, "SELECT * FROM dependencias WHERE id_dependencia='$ofi_idarea'");
							$row1=mysqli_fetch_assoc($consul);
							$nombre_dependencia=$row1['nombre'];
							
							$ofi_foliorel=$row['folio_relacionado'];							
							$ofi_status=$row['estatus_oficio'];									
							$finales++;
							//color de fila
							if($ofi_status==4){
								$color='background:rgba(255, 242, 242) !important;';
								}else{
								$color='';	
								}		
						?>	<!--//CREAR DECISION PARA MOSTRAR ICONOS-->
						<tr class="<?php echo $text_class;?>" style="<?php echo($color); ?>">							
							<td class='text-center' ><strong><font color="red"><?php echo $ofi_id;?></font></strong></td>
							<td colspan="3"><?php echo $ofi_fsolicitado;?></td>							
							<td ><?php echo $ofi_nomDestino;?></td>
							<td ><?php echo $ofi_nomofi;?>.<br>.<?php echo $ofi_cargofi;?></td>							
							<td colspan='3'><?php echo $ofi_asunto;?></td>
							<td ><?php echo $ofi_solicitante;?></td>
							<td colspan='2'><?php echo $nombre_dependencia;?></td>
							<td >
								<?php 
								
								if($ofi_status==1){
									?><h5><span class="badge badge-warning">Asignado</span></h5></td><?php 
								}else if($ofi_status==2){
									?><h5><span class="badge badge-success">Revisado</span></h5></td><?php 
								}else if($ofi_status==3){
									?><h5><span class="badge badge-info">Vinculado</span></h5><?php echo $ofi_foliorel;?></td><?php 
								}else if($ofi_status==4){
									?><h5><span class="badge badge-danger">Cancelado</span></h5></td><?php 
								}							
								?>	
							</td>	
								<!-- AQUI VA A IR LA VARIABLE -->				


							<?php if($nivel_usuario==3){ ?>
							<td>	<!-- ICONO DE EDITAR -->									
								<a href=" " data-target="#editOficiosrioModal" class="edit" data-toggle="modal" 									
									data-efsolicitado="<?php echo $ofi_fsolicitado;?>" 
									data-efoficio="<?php echo $ofi_foficio;?>" 									
									data-enomofi="<?php echo $ofi_nomofi;?>" 
									data-ecargofi="<?php echo $ofi_cargofi;?>" 
									data-eiddep="<?php echo $ofi_iddep;?>" 
									data-easunto="<?php echo $ofi_asunto;?>" 
									data-esolicitante="<?php echo $ofi_solicitante;?>" 
									data-eidarea="<?php echo $ofi_idarea;?>" 
									data-efoliorel="<?php echo $ofi_foliorel;?>" 	
									data-estatus="<?php echo $ofi_status;?>"
									data-eid="<?php echo $ofi_id;?>"><i class="material-icons" data-toggle="tooltip" title="Editar oficios" >&#xE254;</i></a>																												
							</td><!-- ICONO DE EDITAR -->	
							<td><!-- ICONO DE ELIMINAR -->									
								<a href="#deleteOficiosrioModal" class="delete" data-toggle="modal" data-id="<?php echo $ofi_id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>											
							</td><!-- ICONO DE ELIMINAR -->	
							<td><!-- ICONO DE MOSTRAR -->	
								<a href=" " class="editar"  data-target="#viewOficiosrioModal" data-toggle="modal" 								
									data-vfsolicitado="<?php echo $ofi_fsolicitado;?>"
									data-vfoficio="<?php echo $ofi_foficio;?>" 	 
									data-vnomofi="<?php echo $ofi_nomofi;?>" 
									data-vcargofi="<?php echo $ofi_cargofi;?>" 
									data-viddep="<?php echo $ofi_iddep;?>" 
									data-vasunto="<?php echo $ofi_asunto;?>" 
									data-vsolicitante="<?php echo $ofi_solicitante;?>" 
									data-vidarea="<?php echo $ofi_idarea;?>" 
									data-vfoliorel="<?php echo $ofi_foliorel;?>" 	
									data-vstatus="<?php echo $ofi_status;?>"																			
									data-vid="<?php echo $ofi_id;?>"><i class="editar material-icons" data-toggle="tooltip" title="Mostrar oficios">&#xe8f4;</i></a>							
							</td><!-- ICONO DE MOSTRAR -->	
							<td><!-- ICONO DE COPIAR -->									
								<a href=""  data-target="#copiarOficiosrioModal" class="delete" data-toggle="modal" data-id="<?php echo $ofi_id;?>"><i class="material-icons" data-toggle="tooltip" title="Copiar">&#xe14d;</i></a>											
							</td><!-- ICONO DE COPIAR -->
							<?php } elseif($nivel_usuario==4){ ?>
								
							<!-- <td>	<!-- ICONO DE EDITAR -->									
								<!-- <a href=" " data-target="#editOficiosrioModal" class="edit" data-toggle="modal" 									
									data-efsolicitado="<?php echo $ofi_fsolicitado;?>" 
									data-efoficio="<?php echo $ofi_foficio;?>" 									
									data-enomofi="<?php echo $ofi_nomofi;?>" 
									data-ecargofi="<?php echo $ofi_cargofi;?>" 
									data-eiddep="<?php echo $ofi_iddep;?>" 
									data-easunto="<?php echo $ofi_asunto;?>" 
									data-esolicitante="<?php echo $ofi_solicitante;?>" 
									data-eidarea="<?php echo $ofi_idarea;?>" 
									data-efoliorel="<?php echo $ofi_foliorel;?>" 	
									data-estatus="<?php echo $ofi_status;?>"
									data-eid="<?php echo $ofi_id;?>"><i class="material-icons" data-toggle="tooltip" title="Editar oficios" >&#xE254;</i></a>																												 -->
							<!-- </td> -->
							<!-- ICONO DE EDITAR -->	
							<td ><!-- ICONO DE REVISAR OFICIOS -->										
								<a href=" " data-target="#revisaOficiosrioModal" class="edit" data-toggle="modal" 									
									data-rfsolicitado="<?php echo $ofi_fsolicitado;?>" 
									data-rfoficio="<?php echo $ofi_foficio;?>" 									
									data-rnomofi="<?php echo $ofi_nomofi;?>" 
									data-rcargofi="<?php echo $ofi_cargofi;?>" 
									data-riddep="<?php echo $ofi_iddep;?>" 
									data-rasunto="<?php echo $ofi_asunto;?>" 
									data-rsolicitante="<?php echo $ofi_solicitante;?>" 
									data-ridarea="<?php echo $ofi_idarea;?>" 
									data-rfoliorel="<?php echo $ofi_foliorel;?>" 	
									data-rstatus="<?php echo $ofi_status;?>"
									data-rid="<?php echo $ofi_id;?>"><i class="material-icons" data-toggle="tooltip" title="Revisar oficios" >&#xe8b6;</i></a>																												
							</td><!-- ICONO DE REVISAR OFICIOS -->	
							<td><!-- ICONO DE VINCULAR -->									
								<a href=""  data-target="#vinculaOficiosrioModal" class="delete" data-toggle="modal" 									 
								   data-vinid="<?php echo $ofi_id;?>"><i class="material-icons" data-toggle="tooltip" title="Vincular">&#xe250;</i></a>																			
							</td><!-- ICONO DE VINCULAR -->
							<?php }  ?>														
														
							
						</tr>
				<?php }?>
						<tr>
							<td colspan='17'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";										
								?>
							</td>
						</tr>
						<tr>
							
							<td colspan='10'> 
								<input type="hidden" name="numpagofi" id="numpagofi" required value="<?php echo $page; ?>" required >										
								<?php 										
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		</div>	
						
	
	
	<?php	
	}else{
		echo ' No existen Registros ';
	}	
}
?>      
