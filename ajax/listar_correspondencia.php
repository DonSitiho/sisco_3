<?php
	
	/* Connect To Database*/
	require_once ("conexion.php");
	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=date("Y-m-d");
    $fecha_hora=date("Y-m-d H:i:s");
	$hoy=date('Y-m-d');

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="datos_correspondencia as dc";
	$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones  where  (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR   
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%'  OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%') order by dc.folio DESC");
	
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion,"SELECT $campos FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
																	where  (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR  
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
						<th class='text-center'>Capturista /Folio /Estatus</th>
						<th>FechaRecep</th>
						<th># Oficio/<br>FechaOficio</th>
						<!--<th>FechaOficio</th>-->						
						<th>Remitente</th>
						<th>Turnado_a</th>
						<th>Destinatario</th>
						<th>fechaCaptura</th>
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
							$corres_fOfi= $row['f_oficio'];
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
									
							
							$extraer1=substr($corres_noOfi, 0,17);
							$extraer2=substr($corres_noOfi,17);
							if(empty($extraer2)){
								$salto='';
							}else{
								$salto='<br>';
							}
							//******ACTUALIZACION 24-01-2022 */
							if( $row['nom_capturista'] != "" ){
								//echo 'entro';
								
								$idUser = $row['id_user'];
								$consultaImagen = mysqli_query($conexion, "SELECT * FROM imagenes_usuario WHERE id_usuario1 = $idUser");
								$Datos_Imagen=mysqli_fetch_assoc($consultaImagen);
								if($Datos_Imagen == null){
                                    $imagen = "images/usuarios/universal.png";
								}else{
									$imagen = substr($Datos_Imagen['ruta'], 6); 
									//echo $imagen;
									//$imagen = $Datos_Imagen['ruta'];
								}
							
								
								$nom_user = $row['nom_capturista'];

							}else{
								//echo 'no entro';
								$imagen = "images/usuarios/universal.png";
								$nom_user = "User Oficialia";

							}
							
							//******ACTUALIZACION 24-01-2022 */	
						?>	
						<tr>
						
							<!--<td ><?php echo $corres_id;?></td>-->
							<td ><center>
							<div class="" style="width: 40px !important; height: 40px !important;">
								   <img src="<?=$imagen?>"style="
								    margin-right: 3px !important;
									width: 93% !important;
									height: 93% !important;
									border-radius: 900px !important;
									overflow: hidden !important;
									border: 1px solid blue !important;"
									data-toggle="tooltip" data-placement="top" title="<?=$nom_user?>">
								</div>
								<?php echo $corres_folio;?><br>
							
							<?php 
							
							if($corres_status==1){
								?><h5><span class="badge badge-warning">Pendiente</span></h5></td><?php 
							}else if($corres_status==2){
								?><h5><span class="badge badge-primary">Autorizado</span></h5></td><?php 
							}else if($corres_status==3){
								?><h5><span class="badge badge-secondary">Seguimiento</span></h5></td><?php 
							}else if($corres_status==6){
								?><h5><span class="badge badge-success">Finalizado</span></h5></td><?php 
							}	
												
							?>
							</center>
							</td>
							<td >
							<?php echo $corres_f_recep;?>
						       
						    </td>
							<td ><?php echo($extraer1); echo($salto);?><?php echo($extraer2); ?><br><?php echo $corres_fOfi;?></td>
							<!--<td ><?php echo $corres_fOfi;?></td>-->
							<td ><?php echo $corres_nomDep;?></td>
							<td ><div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?=$corres_nomDireccion?><br><?=$nombre_sub_dir?><?=$nombre_depto?></span></div></td>
							<td ><?php echo $corres_nomDestino;?></td>
							<td ><?php echo $corres_fechCap;?></td>
							<!--<td colspan="3"><?php echo $corres_asuntoDoc;?></td>-->
							<td >	
								<?php																	
									if ($corres_status=$row['id_estatus1']==1){
										?>
										<a href="?idcor=<?php echo $corres_id; ?>" data-target="#editCorrespondenciaModal" class="edit" data-toggle="modal" 
											data-folio="<?php echo $corres_folio;?>" 
											data-frecep="<?php echo $corres_f_recep;?>" 
											data-nofi="<?php echo $corres_noOfi;?>" 
											data-fofi="<?php echo $corres_fOfi;?>" 
											data-tofi="<?php echo $corres_tip_ofi;?>" 
											data-idremi="<?php echo $corres_idRemte;?>" 
											data-cargorem="<?php echo $corres_cargoRemte;?>" 
											data-nomrem="<?php echo $corres_nomRemte;?>" 
											data-iddest="<?php echo $corres_idDestino;?>" 
											data-cargodest="<?php echo $corres_cargoDest;?>" 
											data-asuntodoc="<?php echo $corres_asuntoDoc;?>" 
											data-anexodest="<?php echo $corres_anexoDest;?>" 
											data-indidest="<?php echo $corres_indica;?>" 
											data-iddirec="<?php echo $corres_idDireccion;?>" 
											data-fturnado="<?php echo $corres_f_turnado;?>"
											data-instdir="<?php echo $corres_instruccDir;?>" 
											data-freceparea="<?php echo $corres_f_recepArea;?>"							
											data-obs="<?php echo $corres_obs;?>" 
											data-status="<?php echo $corres_status;?>" 
											data-fcapt="<?php echo $corres_fechCap;?>" 
											data-id="<?php echo $corres_id;?>" onclick="recuperaradio('<?php echo $corres_id;?>');"><i class="material-icons" data-toggle="tooltip" title="Editar Correspondencia" >&#xE254;</i></a>								
										<?php										
									}else if($corres_status=$row['id_estatus1']>1){
										?>
										<a href="#" class="inhabilitado" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="inhabilitado">&#xE254;</i></a>
										<?php										
									}								
								?>							
								
							</td>
							<td>
								<?php																	
									if ($corres_status=$row['id_estatus1']==1){
										?>
										<a href="#deleteCorrespondenciaModal" class="delete" data-toggle="modal" data-id="<?php echo $corres_id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
										<?php										
									}else if($corres_status=$row['id_estatus1']>1){
										?>
										<a href="#" class="inhabilitado" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="inhabilitado">&#xE872;</i></a>
										<?php										
									}								
								?>														
							</td>
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
								data-vid="<?php echo $corres_id;?>" onclick="mostrararchivos('<?php echo $corres_id;?>');muestraradioview('<?php echo $corres_id;?>');"><i class="material-icons" data-toggle="tooltip" title="Mostrar Correspondencia">&#xe8f4;</i></a>							
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
										<a href="#loadCorrespondenciaModal" class="dep" data-toggle="modal" data-id="<?php echo $corres_id;?>"><i class="material-icons" data-toggle="tooltip" title="Subir Archivo">cloud_upload</i></a>
										<?php
									}else{
										?>
										<a href="#loadCorrespondenciaModal" class="prog" data-toggle="modal" data-id="<?php echo $corres_id;?>"><i class="material-icons" data-toggle="tooltip" title="Subir Archivo">cloud_upload</i></a>
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
							<td colspan='9'> 
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
<script>
var nopag = document.getElementById("numpag").value;
</script>

<!--<script>
function enviarid()
{
 
valor="<?php echo $corres_id;?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
 
}


</script>-->


<script>
	function recuperaradio(id) {
		
		$.ajax(
				{
					url: 'ajax/recibeid.php?id='+id,
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
	
function muestraradioview(id) {
		
		$.ajax(
				{
					url: 'ajax/recibeidview.php?id='+id,
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
		  
