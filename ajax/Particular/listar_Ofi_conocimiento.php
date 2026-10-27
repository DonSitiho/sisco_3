<?php
	
	/* Connect To Database*/
	require_once ("../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query1'], ENT_QUOTES)));

	$tables="oficios_conocimiento as oc";
	$campos="oc.*";
       session_start();
	$id_direccion=$_SESSION['id_direccion'];
	$id_usuario=$_SESSION['id_usuario'];
	$nivel_acceso=$_SESSION['nivel_acceso'];
	
	
	//VERIFICAR DE QUE DIRECCION ES 
	

	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM $tables  where oc.is_active = 1 AND ( oc.remitente LIKE '%".$query."%' OR oc.no_oficio LIKE '%".$query."%' OR   
			  oc.fecha LIKE '%".$query."%' OR oc.asunto LIKE '%".$query."%' OR 
			  oc.destinatario LIKE '%".$query."%') ORDER BY oc.fecha desc ");
	
	
	
	
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion,"SELECT * FROM $tables  where oc.is_active = 1 AND ( oc.remitente LIKE '%".$query."%' OR oc.no_oficio LIKE '%".$query."%' OR   
			  oc.fecha LIKE '%".$query."%' OR oc.asunto LIKE '%".$query."%' OR 
			  oc.destinatario LIKE '%".$query."%') ORDER BY oc.fecha desc LIMIT $offset,$per_page ");
	
	
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
					
						<th>nº_oficio</th>
						<th>remitente</th>
					
										
						<th>fecha</th>
					
						<th>destinatario</th>
						<th>Tipo_documento</th>
						<th>Direccion</th>
						<th>Opciones</th>
							
						<!--<th class='text-center' colspan="3">Asunto</th>-->
				<!--		<th class='text-center' colspan="6">Opciones</th>-->
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){
							
							$id=$row['id'];
							$remitente=$row['remitente'];
							$no_oficio=$row['no_oficio'];
							$fecha=$row['fecha'];
							$asunto=$row['asunto'];
							$destinatario=$row['destinatario'];
							$id_direcciones=$row['id_direcciones'];
							$tipo=$row['tipo_documento'];
							$status_oficio = $row['ofi_status'];
							$fechaCaptura = $row['fecha_captura'];
							$nomRevisor = $row['nom_revisor'];
							$fechaRevisor =$row['fecha_revisado'];
							$revisado =$row['revisado'];
							$consulta_direcciones=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion='$id_direcciones'");
							$rowDireccion=mysqli_fetch_assoc($consulta_direcciones);
							$NombreDireccion=$rowDireccion['nombre_direccion'];
							$finales++;

							if($revisado == 1){
								$imagen_revisado = '<img src="../../images/revisado.png" width="8%" title="'.$nomRevisor." ". $fechaRevisor.'" alt="">';
							}else{
								
								$imagen_revisado = '';
							}
							?>
						<tr class="text-center" style="font-size: 92% !important;">
						      
						    <td class="text-danger"><?=$no_oficio?>
							<br>
							<?=$imagen_revisado ?>
							</td>
							<td class="text-center"><?=$remitente?></td>
							
							
							
							<td ><?=$fecha?></td>
							
							
							
							<td ><?=$destinatario?></td>
							<td ><?=$tipo?></td>
							<td ><?=$NombreDireccion?></td>
							
							<td>
							
							
								
								<a href="" class="badge badge-primary"  data-target="#viewCorrespondenciaModalCopia" data-toggle="modal" 
								data-vremitente="<?php echo $remitente;?>" 
								data-voficio="<?php echo $no_oficio;?>" 
								data-vfecha="<?php echo $fecha;?>" 
								data-vasunto="<?php echo $asunto;?>" 
								data-vdestinatario="<?php echo $destinatario;?>" 
								data-vtipo="<?php echo $tipo;?>" 
								data-vid="<?php echo $id;?>" onclick="mostrararchivos('<?php echo $id;?>');">Ver información</a>						
							</td>
						
								
						
							
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
<script>
	function mostrararchivos(id) {
	
		$.ajax(
				{
					url: '../../html/Direcciones/mostrar_doc_conocimiento.php?id='+id,
					success: function( data ) {
						$('#resultados15').html(data);
						
						
					}
				}
			)
		
}
</script>

         
<!--<script>
function enviarid()
{
 
valor="<?php //echo $corres_id;?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
 
}
</script>-->
  
		  
