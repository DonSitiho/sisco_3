<?php
	
	/* Connect To Database*/
	require_once ("../conexion.php");

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	

     //Variables de los checkbOxes
	
	 session_start();
	$id_direccion=$_SESSION['id_direccion'];
	
	$id_usuario=$_SESSION['id_usuario'];
	$nivel_acceso=$_SESSION['nivel_acceso'];
	if($id_direccion==2 && $nivel_acceso==1){
		$decision=' ';
	}else{
		$decision=' us.id_direccion1='.$id_direccion.' AND';
	}
	
	$sWhere= " where".$decision."  (us.nombre_usr LIKE '%".$query."%' OR us.app LIKE '%".$query."%' OR   
	us.apm LIKE '%".$query."%' OR us.nick_name LIKE '%".$query."%')  order by us.nombre_usr  ";
	
   
	
	$tables="usuarios as us";
	$campos="us.*";
      
	//VERIFICAR DE QUE DIRECCION ES 
	

	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM " .$tables. " ".$sWhere);
	
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion,"SELECT $campos FROM ". $tables. " ".$sWhere." LIMIT $offset,$per_page");
	

	//loop through fetched data
	
	if ($numrows>0){
		
	?>
		<div class="card">
                  
                    
                    <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm table-hover table-bordered">
				<thead>
				<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
					<tr class="text-center">
						
						<!--<th class='text-center'>Tipo</th>-->						
						<th class="text-danger">Nombre Usuario</th>
						
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
										
						<th>Usuario</th>
					
						<th>Contraseña</th>
						<th>Denominacion del cargo</th>
						<th>Acciones</th>
						
						<!--<th class='text-center' colspan="3">Asunto</th>-->
				<!--		<th class='text-center' colspan="6">Opciones</th>-->
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){
							$idUsuario=$row['id_usuario'];
							$nombreUser=$row['nombre_usr'];
							$app=$row['app'];
							$apm=$row['apm'];
							$nickName=$row['nick_name'];
							$contrasena=$row['contrasena_usr'];
							$nivelAcceso=$row['nivel_acces'];
							$idDireccion=$row['id_direccion1'];
							$idSubdirecciones=$row['id_sub_oic'];
							$idDepto=$row['id_dep'];
							//Sacar subdireccion
							if($idSubdirecciones == 0 ){
								$consultaDireccion = mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE
								 id_direccion ='$idDireccion'");
								$rowDireccion = mysqli_fetch_assoc($consultaDireccion);
								$nombreSubdireccion = $rowDireccion['nombre_direccion'];
								
							}elseif($idDepto == 0 ){
								
								$consultaSub = mysqli_query($conexion, "SELECT * FROM subdirecciones_oic WHERE id ='$idSubdirecciones'");
								$rowSubdireccion = mysqli_fetch_assoc($consultaSub);
								$nombreSubdireccion = $rowSubdireccion['nombre'];

							}else{
								$consultaDep = mysqli_query($conexion, "SELECT * FROM departamentos WHERE
								 id ='$idDepto'");
								$rowDepto = mysqli_fetch_assoc($consultaDep);
								$nombreSubdireccion = $rowDepto['nombre_depto'];
							}
						?>	
						<tr class="text-center" style="font-size: 92% !important;">
							
							<td><?php echo $nombreUser;?></td>
							
							<td ><?php echo $app;?></td>
							<td ><?php echo $apm;?></td>
							
							<td ><?php echo $nickName;?></td>
							
							<td >********</td>
							<td style="font-size: 87% !important;"><?=$nombreSubdireccion?></td>
							<?php if($idSubdirecciones != 0 ){ ?>
							<td>
							
							
							
								<a href="" class="editar"  data-target="#editUsuarioModal" data-toggle="modal" 
								data-vnombre="<?php echo $nombreUser;?>" 
								data-vapp="<?php echo  $app;?>" 
								data-vapm="<?php echo $apm;?>" 
								data-vnickname="<?php echo $nickName;?>" 
								data-vcontrasena="<?php echo $contrasena;?>" 
								data-vnivelAcceso="<?php echo $nivel_acceso;?>" 
								data-viddireccion ="<?php echo $idSubdirecciones?>"
								
								data-vid="<?php echo $idUsuario;?>" > <div class="statistic d-flex align-items-center ">
								<span class="badge badge-warning">Editar</span></div></a>							
						    </td>
							<?php }else{?>
								<td>
							
							
							
							<a 
							
							data-vid="<?php echo $idUsuario;?>" > <div class="statistic d-flex align-items-center ">
							<span class="badge badge-default">Editar</span></div></a>							
						</td>
								<?php }?>
						</tr>
						<?php }?>
						<tr>
							<td colspan='12'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";										
								?>
							</td>
						</tr>
						<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			     </table>
                      </div>
                    </div>
                  </div>	

	
	
	<?php	
	}	
}

?> 

		  
