<?php
	
	/* Connect To Database*/
	include('../../ajax/conexion.php');
	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");
	$hoy=date('Y-m-d');

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="datos_correspondencia as dc";
	$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
	
	include '../modelos/pagination2.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones  where dc.id_estatus1=1 AND (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR   
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%'  OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%') order by dc.folio DESC ");
	
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion,"SELECT $campos FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
																	where dc.id_estatus1=1 AND (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR  
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%'  OR
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 				
			  dc.cargo_destinatario LIKE '%".$query."% ' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%' OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%' ) order by dc.folio DESC LIMIT $offset,$per_page");
	
	
	//loop through fetched data
	
	
	if ($numrows>0){
		
	?>
		<div class="table-responsive">
			<table class="table table-sm table-striped table-hover table-responsive">
				<thead>
					<tr>
						<!--<th class='text-center'>id</th>-->
						<!--<th class='text-center'>Tipo</th>-->						
						<th class='text-center'>Folio</th>
						<th>FechaRecep</th>
						<th># Oficio/<br>FechaOficio</th>
						<!--<th>FechaOficio</th>						
						<th>Remitente</th>-->
						<th>Turnado_A</th>
						<!--<th>Destinatario</th>
						<th>fechaCaptura</th>-->
						<!--<th class='text-center' colspan="3">Asunto</th>-->
						<th class='text-center' colspan="6">Opciones</th>
						
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
							$corres_direcciones=$row['direcciones'];				
							$finales++;  
							
						?>	
						<tr class="<?php echo $text_class;?>">
							<!--<td ><?php echo $corres_id;?></td>-->
							<td ><?php echo $corres_folio;?><br>
							<?php 
							$nuevofolio = explode ("/", $corres_folio);
							$newfolio= $nuevofolio[2]; 
							$copias = (int)$newfolio;
							if($copias>1){
								?><h5><span class="badge badge-warning">Copia</span></h5></td><?php 
							}else{
								?><h5><span class="badge badge-success">Original</span></h5></td><?php 
							}
							
							?>							
							<td ><?php echo $corres_f_recep;?></td>
							<td ><?php echo $corres_noOfi;?><br><?php echo $corres_fOfi;?></td>
							<!--<td ><?php echo $corres_fOfi;?></td>-->
							<!--<td ><?php echo $corres_nomDep;?></td>-->
							<td ><?php echo $corres_nomDireccion;?></td>
							<!--<td ><?php echo $corres_nomDestino;?></td>
							<td ><?php echo $corres_fechCap;?></td>-->
							<!--<td colspan="3"><?php echo $corres_asuntoDoc;?></td>-->
							
							<td>
								<a href="?idcor=<?php echo $corres_id; ?>" class="editar"  data-target="#viewCorrespondenciaModals" data-toggle="modal" 
								data-vfolios="<?php echo $corres_folio;?>" 
								data-vfreceps="<?php echo $corres_f_recep;?>" 
								data-vnofis="<?php echo $corres_noOfi;?>" 
								data-vfofis="<?php echo $corres_fOfi;?>" 
								data-vtofis="<?php echo $corres_tip_ofi;?>" 
								data-vidremis="<?php echo $corres_idRemte;?>" 
								data-vcargorems="<?php echo $corres_cargoRemte;?>" 
								data-vnomrems="<?php echo $corres_nomRemte;?>" 
								data-viddests="<?php echo $corres_idDestino;?>" 
								data-vcargodests="<?php echo $corres_cargoDest;?>" 
								data-vasuntodocs="<?php echo $corres_asuntoDoc;?>" 
								data-vanexodests="<?php echo $corres_anexoDest;?>" 
								data-vindidests="<?php echo $corres_indica;?>" 
								data-viddirecs="<?php echo $corres_idDireccion;?>" 
								data-vfturnados="<?php echo $corres_f_turnado;?>"
								data-vinstdirs="<?php echo $corres_instruccDir;?>" 
								data-vfrecepareas="<?php echo $corres_f_recepArea;?>"							
								data-vobss="<?php echo $corres_obs;?>" 
								data-vstatuss="<?php echo $corres_status;?>" 
								data-vfcapts="<?php echo $corres_fechCap;?>" 
								data-viddirss="<?php echo $corres_direcciones;?>" 
								data-vids="<?php echo $corres_id;?>" onclick="mostrararchivosdos('<?php echo $corres_id;?>');muestraradioviewdos('<?php echo $corres_id;?>');"><i class="material-icons" data-toggle="tooltip" title="Mostrar Correspondencia">&#xe8f4;</i></a>							
							</td>
							<td>
								<?php
								$query2 = mysqli_query($conexion,"SELECT * FROM  documentos where documentos.id_datos_c1 = $corres_id");
								$checa_arch=0;
								while($row_archivos=mysqli_fetch_assoc($query2)){
									$checa_arch++;
								}
									if ($checa_arch>0){
										?>
										<a href="#loadCorrespondenciaModal" class="dep" data-toggle="modal" data-id="<?php echo $corres_id;?>" data-folio="<?php echo $corres_folio;?>"><i class="material-icons" data-toggle="tooltip" title="Subir Archivo">cloud_upload</i></a>
										<?php
									}else{
										?>
										<a href="#loadCorrespondenciaModal" class="prog" data-toggle="modal" data-id="<?php echo $corres_id;?>" data-folio="<?php echo $corres_folio;?>"><i class="material-icons" data-toggle="tooltip" title="Subir Archivo">cloud_upload</i></a>
										<?php
									}
									
								?>								
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
							<td colspan='3'>
								<input type="hidden" name="numpag" id="numpag" required value="<?php echo $page; ?>" required >										
							</td>		
							
						</tr>
				</tbody>			
			</table>
		</div>	

	
	
	<?php	
	}	
}
?>  
<script>
var nopag = document.getElementById("numpag").value;
</script>

<script>
	function recuperaradio(id) {
		
		$.ajax(
				{
					url: '../../ajax/recibeid.php?id='+id,
					success: function( data ) {						
						
						if(data==0){
							$('input:radio[name="edit_t_oficio"]').attr('checked', false);
                			$('input:radio[name="edit_t_oficio"]').filter('[value="0"]').attr('checked', true);
							document.getElementById("prueba").value = data
							document.getElementById("edit_id_remitente").disabled=false;
            				document.getElementById("edit_cargo").disabled=false;
							document.getElementById("edit_nombre").disabled=false;
							document.getElementById("edit_enviadopor").disabled=true;
							document.getElementById("edit_cargodest").disabled=true;    
						}
						if (data == 1){
                			$('input:radio[name="edit_t_oficio"]').attr('checked', false);
               				$('input:radio[name="edit_t_oficio"]').filter('[value="1"]').attr('checked', true);
							document.getElementById("prueba").value = data
							document.getElementById("edit_id_remitente").disabled=false;
							document.getElementById("edit_cargo").disabled=false;
							document.getElementById("edit_nombre").disabled=false;
							document.getElementById("edit_enviadopor").disabled=false;
							document.getElementById("edit_cargodest").disabled=false;
            			}
						
					}
				}
			)
		
}
function muestraradioviewdos(id) {
		
		$.ajax(
				{

					url: '../../ajax/recibeidview.php?id='+id,
					success: function( data ) {						
						
					

						if(data==0){
							$('input:radio[name="view_t_oficio"]').attr('checked', false);
                			$('input:radio[name="view_t_oficio"]').filter('[value="0"]').attr('checked', true);
            
						}
						if (data == 1){
                			$('input:radio[name="view_t_oficio"]').attr('checked', false);
               				$('input:radio[name="view_t_oficio"]').filter('[value="1"]').attr('checked', true);
            			}
						
					}
				}
			)
		
}





</script>
<script>
$(function() {
	$('#edit_keep-select').multiselect({});
	
});
</script>
