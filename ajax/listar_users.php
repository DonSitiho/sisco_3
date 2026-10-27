<?php
	
	/* Connect To Database*/
	require_once ("conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="usuarios";
	$campos="*";
	$sWhere=" usuarios.id_usuario LIKE '%".$query."%' OR usuarios.nombre_usr LIKE '%".$query."%' OR usuarios.app LIKE '%".$query."%' OR usuarios.apm LIKE '%".$query."%' OR usuarios.nick_name LIKE '%".$query."%' OR usuarios.contrasena_usr LIKE '%".$query."%' OR usuarios.id_direccion1 LIKE '%".$query."%' OR usuarios.nivel_acces LIKE '%".$query."%'";
	$sWhere.=" order by usuarios.id_usuario";
	
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
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
						<th>Nombre </th>
						<th>A. Paterno</th>
						<th>A. Materno</th>
						<th>Nick-name </th>
						<th>Contraseña</th>						
						<th>Id-Area </th>
						<th>Nivel-Acceso</th>											
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$usr_id=$row['id_usuario'];	
							$usr_nom=$row['nombre_usr'];	
							$usr_app=$row['app'];	
							$usr_apm=$row['apm'];	
							$usr_nick=$row['nick_name'];	
							$usr_pass=$row['contrasena_usr'];	
							$usr_dir=$row['id_direccion1'];							
							$usr_nivel=$row['nivel_acces'];
							$finales++;
							
						?>	
						<tr class="<?php echo $text_class;?>">							
							<td ><?php echo $usr_id;?></td>
							<td ><?php echo $usr_nom;?></td>
							<td ><?php echo $usr_app;?></td>
							<td ><?php echo $usr_apm;?></td>
							<td ><?php echo $usr_nick;?></td>
							<td ><?php echo $usr_pass;?></td>
							<td ><?php echo $usr_dir;?></td>
							<td ><?php echo $usr_nivel;?></td>
							<td>
								<a href="#"  data-target="#editUserModal" class="edit" data-toggle="modal" data-id='<?php echo $usr_id?>' data-nom='<?php echo $usr_nom?>' data-app='<?php echo $usr_app?>' data-apm='<?php echo $usr_apm?>' data-nick='<?php echo $usr_nick?>' data-pass='<?php echo $usr_pass?>' data-idir='<?php echo $usr_dir?>' data-nivel='<?php echo $usr_nivel?>'><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								<a href="#deleteUserModal" class="delete" data-toggle="modal" data-id="<?php echo $usr_id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
								
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
		  
