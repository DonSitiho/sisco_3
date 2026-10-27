<?php
	
	/* Connect To Database*/
	require_once ("conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="dependencias";
	$campos="*";
	$sWhere=" dependencias.identificador LIKE '%".$query."%' OR dependencias.sigla LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%'";
	$sWhere.=" order by dependencias.id_dependencia";
	
	
	include 'pagination.php'; //include pagination file
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
	$query = mysqli_query($conexion,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	
		
	
	if ($numrows>0){
		
	?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class='text-center'>#</th>
						<th>Identificador </th>
						<th>Sigla</th>
						<th>Dependencia </th>						
						<th></th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$dep_id=$row['id_dependencia'];	
							$dep_ident=$row['identificador'];							
							$dep_sigla=$row['sigla'];
							$dep_nombre=$row['nombre'];
							$finales++;
							
						?>	
						<tr class="<?php echo $text_class ?? '';?>">							
							<td ><?php echo $dep_id;?></td>
							<td ><?php echo $dep_ident;?></td>
							<td ><?php echo $dep_sigla;?></td>
							<td ><?php echo $dep_nombre;?></td>
							<td>
								<a href="#"  data-target="#editDepModal" class="edit" data-toggle="modal" data-ident='<?php echo $dep_ident?>' data-sigla='<?php echo $dep_sigla?>' data-nombre='<?php echo $dep_nombre?>' data-id='<?php echo $dep_id; ?>'><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								<a href="#deleteDepModal" class="delete" data-toggle="modal" data-id="<?php echo $dep_id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								
							</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan='6'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		</div>	
	
	<?php	
	}	
}
?>          
		  
