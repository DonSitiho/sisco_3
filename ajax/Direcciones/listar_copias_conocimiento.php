<?php
	/* Connect To Database*/
	require_once ("../conexion.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	
	$query2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query2'], ENT_QUOTES)));
	$query3 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query3'], ENT_QUOTES)));
	$tables="oficios_conocimiento as oc";
	$campos="oc.*";
       session_start();
	$id_direccion1=$_SESSION['id_direccion'];
	$id_usuario1=$_SESSION['id_usuario'];
	$nivel_acceso1=$_SESSION['nivel_acceso'];
	$subdireccion1 = $_SESSION['subdireccion'];
	$depto1 = $_SESSION['depto'];
	//VERIFICAR DE QUE DIRECCION ES 
	if($id_direccion1==2 && $nivel_acceso1==1){
			
		$decision_copias1=' is_active = 1 AND  ';
	}else{ 
		if($subdireccion1 == 0 or $subdireccion1 == NULL ){
			$decision_copias1='is_active = 1 AND ( FIND_IN_SET('.$id_direccion1.', doc_original)  OR FIND_IN_SET('.$id_direccion1.', copias_direcciones)) AND';
			//$decision_copias=' id_direcciones='.$id_direccion.' AND';
		}elseif($depto1 == 0 or $subdireccion1 == NULL ){
			$decision_copias1=' is_active = 1 AND FIND_IN_SET('.$id_direccion1.', doc_original) AND FIND_IN_SET('.$subdireccion1.', id_subdireccion) AND';
		}else{
			$decision_copias1=' is_active = 1 AND FIND_IN_SET('.$id_direccion1.', doc_original) AND FIND_IN_SET('.$depto1.', id_departamento) AND';
		}
		
	} 


	if ($query2==0 ){
        $sWhere1= $decision_copias1." (oc.remitente LIKE '%".$query3."%' OR oc.no_oficio LIKE '%".$query3."%' OR   
        oc.fecha LIKE '%".$query3."%' OR oc.asunto LIKE '%".$query3."%' OR 
        oc.destinatario LIKE '%".$query3."%') ";
    }else{				
        $sWhere1= $decision_copias1." ( oc.remitente LIKE '%".$query3."%' OR oc.no_oficio LIKE '%".$query3."%' OR   
        oc.fecha LIKE '%".$query3."%' OR oc.asunto LIKE '%".$query3."%' OR 
        oc.destinatario LIKE '%".$query3."%' ) AND (oc.id_direcciones LIKE '%".$query2."%')";
    }
		$sWhere1.="ORDER BY oc.id DESC ";
		
	include 'pagination2.php';//include pagination file
	//pagination variables
	$page1 = (isset($_REQUEST['page1']) && !empty($_REQUEST['page1']))?$_REQUEST['page1']:1;
	$per_page1 = intval($_REQUEST['per_page1']); //how much records you want to show
	$adjacents1  = 4; //gap between pages after number of adjacents
	$offset1 = ($page1 - 1) * $per_page1;
	//Cuente el número total de filas en su tabla*/
	$count_query1   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM $tables  where $sWhere1");
	if ($row= mysqli_fetch_array($count_query1)){$numrows1 = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages1 = ceil($numrows1/$per_page1);
	//consulta principal para recuperar los datos
	$queryppal = mysqli_query($conexion,"SELECT * FROM $tables  where $sWhere1 LIMIT $offset1,$per_page1");
	//loop through fetched data
	
	if ($numrows1>0){
	?>
		<div class="card">
                    <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm table-hover table-bordered">
				<thead>
				<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate2( $page1, $total_pages1, $adjacents1);
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
						<th>tipo</th>
						<th>Opciones</th>
						<!--<th class='text-center' colspan="3">Asunto</th>-->
				<!--		<th class='text-center' colspan="6">Opciones</th>-->
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales1=0;
						while($row = mysqli_fetch_array($queryppal)){
							$id1=$row['id'];
							$remitente1=$row['remitente'];
							$no_oficio1=$row['no_oficio'];
							$fecha1=$row['fecha'];
							$noreferencia1=$row['no_referencia'];
							$idreferencia1=$row['id_referencia'];
							$asunto1=$row['asunto'];
							$destinatario1=$row['destinatario'];
							$id_direcciones1=$row['id_direcciones'];
							$original1=$row['doc_original'];
							$concopia1=$row['copias_direcciones'];
							$tipo1=$row['tipo_documento'];
							$respuesta1=$row['respuesta'];
							$ofi_status1=$row['ofi_status'];
                            $fecha_captura1=$row['fecha_captura'];
                            $nomRevisor1 = $row['nom_revisor'];
							$fechaRevisor1 =$row['fecha_revisado'];
							$revisado1 =$row['revisado'];
							$consulta_direcciones1=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion='$id_direcciones1'");
							$rowDireccion1=mysqli_fetch_assoc($consulta_direcciones1);
							$NombreDireccion1=$rowDireccion1['nombre_direccion'];

							$copias_array = explode(",",$concopia1);
							$arrayOriginal = explode(",",$original1);
							
							$array_num = count($copias_array);
							$direcciones_copias = "";
							for ($i = 0; $i < $array_num; ++$i){
								$consulta_direcciones_copia=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion='$copias_array[$i]'");
								$rowDireccionCopia=mysqli_fetch_assoc($consulta_direcciones_copia);
								$NombreDireccionCopia=$rowDireccionCopia['nombre_direccion'];
								$direcciones_copias .= $NombreDireccionCopia.",";
							}

							$finales1++;

							if($revisado1 == 1){
								$imagen_revisado = '<img src="../images/revisado.png" width="5%" title="'.$nomRevisor1." ". $fechaRevisor1.'" alt="">';
							}else{
								
								$imagen_revisado = '';
							}                            
							
							?>
						<tr class="text-center" style="font-size: 92% !important;">
						<td class="text-danger"><?=$no_oficio1?>
							
							<?=$imagen_revisado ?>
							</td>
							<td class="text-center"><?=$remitente1?></td>
							<td ><?=$fecha1?></td>
							<td ><?=$destinatario1?></td>
							<td ><?=$tipo1?></td>
							<td ><?=$NombreDireccion1?></td>
							<?php
							
							if(($original1 > '' OR $original1 != null) && (in_array($id_direccion1, $arrayOriginal))){
								?><td class="badge badge-success"><?='original'?></td>
								<td>
								<a href="#"><?=''?><i class="fa fa-eye" aria-hidden="true" title="Mostrar Documento" data-target="#viewOfiRecibidos" data-toggle="modal" 
								data-vremitente1="<?php echo $remitente1;?>" 
								data-voficio1="<?php echo $no_oficio1;?>" 
								data-vfecha1="<?php echo $fecha1;?>" 
								data-vasunto1="<?php echo $asunto1;?>" 
								data-vdestinatario1="<?php echo $destinatario1;?>" 
								data-vtipo1="<?php echo $tipo1;?>" 
								data-vid1="<?php echo $id1;?>" onclick="mostrararchivos2('<?php echo $id1;?>', 'true');"></i></a>

								
								
								<?php

								if(($original1>'' OR $original1 != null) && (in_array($id_direccion1, $arrayOriginal))){
									if ($respuesta1==0 OR $respuesta1==null) {
									?>
										<a href="#"><?=''?><i class="fa fa-reply-all" aria-hidden="true" data-target="#addOfiResp" data-toggle="modal" title="Responder"
										data-anoficio1="<?php echo $no_oficio1;?>"
										data-aremitente1="<?php echo $remitente1;?>" 
										data-arearemitente1="<?php echo $NombreDireccion1;?>" 
										data-id_dir_orig="<?php echo $id_direcciones1;?>"
										data-adestOrig1="<?php echo $NombreDireccion1;?>"
										data-aconcopia1="<?php echo $concopia1;?>" 
										data-adireccionescopia="<?php echo $direcciones_copias;?>" 
										data-iddocini="<?php echo $id1;?>"
										></i></a>
									<?php	
									} else {
										if($idreferencia1!=0 OR $idreferencia1!=NULL){
										
											$consulta_respuesta=mysqli_query($conexion, "SELECT * FROM oficios_conocimiento WHERE id ='$idreferencia1'");
											$rowrespuesta=mysqli_fetch_assoc($consulta_respuesta);
											$remitente2 = $rowrespuesta['remitente'];
											$no_oficio2 = $rowrespuesta['no_oficio'];
											$fecha2 = $rowrespuesta['fecha'];
											$asunto2 = $rowrespuesta['asunto'];
											$destinatario2 = $rowrespuesta['destinatario'];
											$tipo2 = $rowrespuesta['tipo_documento'];
											$id2 = $rowrespuesta['id'];
											// $NombreDireccion1=$rowDireccion1['nombre_direccion'];

										?>
											<a href="#"><?=''?><i class="fa fa-search" aria-hidden="true"  data-target="#viewCorrespondenciaModalCopia" data-toggle="modal" title="Ver Respuesta" 
											data-vremitente="<?php echo $remitente2;?>" 
											data-voficio="<?php echo $no_oficio2;?>" 
											data-vfecha="<?php echo $fecha2;?>" 
											data-vasunto="<?php echo $asunto2;?>" 
											data-vdestinatario="<?php echo $destinatario2;?>" 
											data-vtipo="<?php echo $tipo2;?>" 
											data-vid="<?php echo $id2;?>" onclick="mostrararchivos('<?php echo $id2;?>');"></i></a>
											
										<?php
										}else{

											$consulta_original=mysqli_query($conexion, "SELECT * FROM oficios_conocimiento WHERE id_referencia ='$id1'");
											$roworiginal=mysqli_fetch_assoc($consulta_original);
											$remitente3 = $roworiginal['remitente'];
											$no_oficio3 = $roworiginal['no_oficio'];
											$fecha3 = $roworiginal['fecha'];
											$asunto3 = $roworiginal['asunto'];
											$destinatario3 = $roworiginal['destinatario'];
											$tipo3 = $roworiginal['tipo_documento'];
											$id3 = $roworiginal['id'];
										?>
											<a href="#"><?=''?><i class="fa fa-search" aria-hidden="true"  data-target="#viewCorrespondenciaModalCopia" data-toggle="modal" title="Ver Original" 
											data-vremitente="<?php echo $remitente3;?>" 
											data-voficio="<?php echo $no_oficio3;?>" 
											data-vfecha="<?php echo $fecha3;?>" 
											data-vasunto="<?php echo $asunto3;?>" 
											data-vdestinatario="<?php echo $destinatario3;?>" 
											data-vtipo="<?php echo $tipo3;?>" 
											data-vid="<?php echo $id3;?>" onclick="mostrararchivos('<?php echo $id3;?>');"></i></a>

										<?php
										}
										
									}
								}	
							 ?>

								</td>
								
								<?php
								


							}else{?>
								<td class="badge badge-light"><?='copia'?></td>
								<td>
								<a href="#"><?=''?><i class="fa fa-eye" aria-hidden="true" title="Mostrar Documento" data-target="#viewOfiRecibidos" data-toggle="modal" 
								data-vremitente1="<?php echo $remitente1;?>" 
								data-voficio1="<?php echo $no_oficio1;?>" 
								data-vfecha1="<?php echo $fecha1;?>" 
								data-vasunto1="<?php echo $asunto1;?>" 
								data-vdestinatario1="<?php echo $destinatario1;?>" 
								data-vtipo1="<?php echo $tipo1;?>" 
								data-vid1="<?php echo $id1;?>" onclick="mostrararchivos2('<?php echo $id1;?>', 'true');"></i></a>
								</td>
								<?php
							}	
							?>
						
							
						</tr>
						<?php }?>
						<tr>
							<td colspan='12'> 
								<?php 
									$inicios1=$offset1+1;
									$finales1+=$inicios1 -1;
									echo "Mostrando $inicios1 al $finales1 de $numrows1 registros";										
								?>
							</td>
						</tr>
						<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate2( $page1, $total_pages1, $adjacents1);
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
						$('#resultados1').html(data);
					}
				}
			)
}
</script>
<script>
	function mostrararchivos1(id) {
	
		$.ajax(
				{
					url: '../../html/Direcciones/mostrar_doc_conocimiento.php?id='+id,
					success: function( data ) {
						$('#resultados1C').html(data);
						
					}
				}
			)
		
}
</script>
<script>
	function mostrararchivos2(id, $visto) {
	
		$.ajax(
				{
					url: '../../html/Direcciones/mostrar_doc_conocimiento.php?id='+id+'&visto='+$visto,
					success: function( data ) {
						$('#resultados2').html(data);
						
					}
				}
			)
		
}
</script>
<script>
	function mostrararchivos3(id) {
	
		$.ajax(
				{
					url: '../../html/Direcciones/mostrar_doc_conocimiento.php?id='+id,
					success: function( data ) {
						$('#resultados2C').html(data);
						
					}
				}
			)
		
}
</script>
<!--<script>
function enviarid()
{
valor="<?php echo $corres_id ?? '';?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
}
</script>-->