<?php
	
	/* Connect To Database*/
	require_once ("conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query2'], ENT_QUOTES)));
	$query3 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query3'], ENT_QUOTES)));
	$query4 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query4'], ENT_QUOTES)));

    //if($query3 == 10001){
	//	$query3 = ("5 AND dc.id_sub_oic = 56");
	//}
	//echo $query4;

	if ($query4 == 0){
		//echo 'entro';
		$tables="datos_correspondencia as dc";
		$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
		if ($query3==0){
			$sWhere="dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' ";		  
		}else{
			$sWhere="dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' AND dc.id_direcciones= ".$query3."";		  
		}
		$sWhere.=" order by dc.folio";
	}else{ //********************************** REMITENTE **************************************** */

		$tables="datos_correspondencia as dc";
	$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
	if ($query3==0){
		$sWhere="dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' AND id_remitente =  $query4";		  
	}else{
		$sWhere="dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' AND dc.id_direcciones= ".$query3." AND id_remitente =  $query4";		  
	}
	$sWhere.=" order by dc.folio";
	}
    
    

	
	
	
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
    
    $query = mysqli_query($conexion,"SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
																	WHERE $sWhere LIMIT $offset,$per_page"); 
    
    
    
	
	/*$query = mysqli_query($conexion,"SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
																	where dc.f_recepcion BETWEEN $sWhere LIMIT $offset,$per_page"); */
	
	
	//loop through fetched data
	
	
	if ($numrows>0){
		
	?>
		<div class="table-responsive">
			<table class="table table-sm table-striped table-hover">
				<thead>
					<tr>
						<th class='text-center'>id</th>
						<!--<th class='text-center'>Tipo</th>-->						
						<th>Folio</th>
						<th>FechaRecep</th>
						<th># Oficio</th>
						<th>FechaOficio</th>						
						<th>Remitente</th>
						<th>Turnado_A</th>
						<th>Destinatario</th>
						<th>fechaCaptura</th>
						<!--<th class='text-center' colspan="3">Asunto</th>-->
						<th class='text-center' colspan="2">Opciones</th>
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$corres_id=$row['id_datos_c'];
							$corres_folio=$row['folio'];							
							$corres_f_recep=$row['f_recepcion'];
							$corres_tip_ofi=$row['tipo_oficio'];
							$corres_idRemte=$row['id_remitente'];
							$corres_nomDep=$row['nombre'];							
							$corres_cargoRemte=$row['cargo'];
							$corres_nomRemte=$row['Nombre'];
							$corres_noOfi=$row['num_oficio'];							
							$corres_fOfi=$row['f_oficio'];
							$corres_idDestino=$row['id_destinatarios'];
							$corres_nomDestino=$row['dnom'];
							$corres_cargoDest=$row['cargo_destinatario'];							
							$corres_asuntoDoc=$row['asunto_destinatario'];
							$corres_indica=$row['indicaciones_destinatario'];
							$corres_anexoDest=$row['anexo_destinatario'];
							$corres_idDireccion=$row['id_direcciones'];
							$corres_nomDireccion=$row['nombre_direccion'];
							$corres_f_turnado=$row['f_turnado'];
							$corres_instruccDir=$row['instrucciones_direcciones'];
							$corres_f_recepArea=$row['f_recepArea'];
							$corres_obs=$row['leyenda_destinatario'];							
							$corres_status=$row['id_estatus1'];							
							$corres_fechCap=$row['fecha_cap_c'];	
                            
                            $corres_id_sub_oic   = $row['id_sub_oic'];
                            
							$corres_id_depto     = $row['id_departamento'];
							
							//nombres SUBDIRECCION O Departamento
							$nombre_depto = "";
							$nombre_sub_dir = "";
                            
							$finales++;
                            
                            if( $corres_id_sub_oic > 0 ){
                                
								//echo "Entro";

								$consulta_sub = mysqli_query($conexion, "SELECT nombre FROM subdirecciones_oic WHERE id = '$corres_id_sub_oic'");
								$row_Sub_dir = mysqli_fetch_assoc($consulta_sub);
								$nombre_sub_dir ='<p class="form-text text-muted text-info" style="margin: 0px !important;">'. $row_Sub_dir['nombre'].'</p>';
								$boton_turnar = "Editar";
								$boton_turnar_class = "badge badge-warning";
								
								if ($corres_id_depto > 0) {//Turnado a departamento
									//echo "ENTRO";
								$consulta_depto = mysqli_query($conexion, "SELECT nombre_depto FROM departamentos WHERE id = '$corres_id_depto'");
								$row_depto = mysqli_fetch_assoc($consulta_depto);
								$nombre_depto ='<p class="form-text text-muted text-primary" style="margin: 0px !important;">'. $row_depto['nombre_depto'].'</p>';
								//verificccar
								$boton_turnar = "Editar";
								$boton_turnar_class = "badge badge-warning";
								

								}else{
									//Consultar nombre subdireccion
								$nombre_depto =' ';
								//verificccar
								// if ($subdireccion != 0 ){
								// 	$boton_turnar = "Turnar";
								//    $boton_turnar_class = "badge badge-info";

								// }
								
								

								}
								

							}else{
								$nombre_sub_dir = "";
								$boton_turnar   = "Turnar";
								$boton_turnar_class = "badge badge-info";
							}
							$c_o_o = substr($corres_folio, -1);
							switch($corres_status){
									case 1:
									$badge='<span class="badge badge-warning">Pendiente</span>';
								break;
								case 2:
									$badge='<span class="badge badge-primary">Autorizada</span>';
								break;
								case 3:
									$badge='<span class="badge badge-info">En Seguimiento</span>';
									break;
								case 6:
									$badge='<span class="badge badge-success">Finalizado</span>';
									break;
							}
							
                            
						?>	
						<tr class="">
							<td ><?php echo $corres_id;?></td>
							<td ><?php echo $corres_folio;?></td>
							<td ><?php echo $corres_f_recep;?></td>
							<td ><?php echo $corres_noOfi;?></td>
							<td ><?php echo $corres_fOfi;?></td>
							<td ><?php echo $corres_nomDep;?></td>
							<td ><div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?=$corres_nomDireccion?><br><?=$nombre_sub_dir?><?=$nombre_depto?></span></div></td>
							<td ><?php echo $corres_nomDestino;?></td>
							<td ><?php echo $corres_fechCap;?></td>
							<!--<td colspan="3"><?php echo $corres_asuntoDoc;?></td>-->
							
							<td>
								<a href="?idcor=<?php echo $corres_id; ?>" class="editar"  data-target="#viewCorrespondenciaModal" data-toggle="modal" 
								data-vfolio="<?php echo $corres_folio;?>" 
								data-vfrecep="<?php echo $corres_f_recep;?>" 
								data-vnofi="<?php echo $corres_noOfi;?>" 
								data-vfofi="<?php echo $corres_fOfi;?>" 
								data-vtofi="<?php echo $corres_tip_ofi;?>" 
								data-vidremi="<?php echo $corres_idRemte;?>" 
								data-vcargorem="<?php echo $corres_cargoRemte;?>" 
								data-vnomrem="<?php echo $corres_nomRemte;?>" 
								data-viddest="<?php echo $corres_idDestino;?>" 
								data-vcargodest="<?php echo $corres_cargoDest;?>" 
								data-vasuntodoc="<?php echo $corres_asuntoDoc;?>" 
								data-vanexodest="<?php echo $corres_anexoDest;?>" 
								data-vindidest="<?php echo $corres_indica;?>" 
								data-viddirec="<?php echo $corres_idDireccion;?>" 
								data-vfturnado="<?php echo $corres_f_turnado;?>"
								data-vinstdir="<?php echo $corres_instruccDir;?>" 
								data-vfreceparea="<?php echo $corres_f_recepArea;?>"							
								data-vobs="<?php echo $corres_obs;?>" 
								data-vstatus="<?php echo $corres_status;?>" 
								data-vfcapt="<?php echo $corres_fechCap;?>" 
								data-vid="<?php echo $corres_id;?>" onclick="mostrararchivos();"><i class="material-icons" data-toggle="tooltip" title="Mostrar Correspondencia">&#xe8f4;</i></a>							
							</td>
							
							
						</tr>
						<?php }?>
						<tr>
							<td colspan='10'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";										
								?>
							</td>
						</tr>
						<tr>
							<td colspan='10'> 
								<?php 										
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

  
		  
