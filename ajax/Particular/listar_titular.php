<?php
	
	/* Connect To Database*/
	require_once ("../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	
	$query1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query1'], ENT_QUOTES)));
     //Variables de los checkbOxes
	
	 session_start();
	$id_direccion=$_SESSION['id_direccion'];
	$id_usuario=$_SESSION['id_usuario'];
	$nivel_acceso=$_SESSION['nivel_acceso'];
	if($id_direccion==2 && $nivel_acceso==1){
		$decision=' ';
	}elseif($id_direccion==2 && $nivel_acceso==2){
		$decision=' ';
	}else{
		$decision=' dc.id_direcciones='.$id_direccion.' AND';
	}
	
	
	if ($query==0 ){
		
        $sWhere= " where".$decision." dc.tipo_oficio = '0'  AND (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR   
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%'  OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%') order by dc.folio  ";
	}elseif($query==1){
		 $sWhere= " where".$decision."  dc.tipo_oficio = '0' AND SUBSTRING(dc.folio, length(dc.folio)-1,2) = '01' AND (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR   
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%'  OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%') order by dc.folio  ";
	
    }elseif($query==2){
		 $sWhere= " where".$decision." dc.tipo_oficio = '0'  AND SUBSTRING(dc.folio, length(dc.folio)-1,2) <> '01' AND (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR   
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%'  OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%') order by dc.folio  ";
	}elseif($query==3){
		 $sWhere= " where".$decision." dc.id_estatus1='2' AND dc.tipo_oficio = '0'  AND SUBSTRING(dc.folio, length(dc.folio)-1,2) <> '01' AND (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR   
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%'  OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%') order by dc.folio  ";
		}elseif($query==4){
		 $sWhere= " where".$decision." dc.id_estatus1='2' AND dc.tipo_oficio = '1'  AND SUBSTRING(dc.folio, length(dc.folio)-1,2) <> '01' AND (dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR   
			  dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
			  dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
			  dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
			  dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%".$query."%' OR dc.instrucciones_direcciones LIKE '%".$query."%' OR ds.nombre_direccion LIKE '%".$query."%'  OR d.nombre LIKE '%".$query."%' OR dependencias.nombre LIKE '%".$query."%') order by dc.folio  ";
	}else{				
       $sWhere= " where".$decision." dc.id_estatus1='2' AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR   
			  dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR 
			  dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR 
			  dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR 
			  dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%'  OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";
    }
	
	if($query1 != ""){
		 $sWhere= " where".$decision." dc.id_estatus1='2' AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR   
			  dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR 
			  dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR 
			  dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR 
			  dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR 						
			  dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%'  OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";
		
	}
       
	
	$tables="datos_correspondencia as dc";
	$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
      
	//VERIFICAR DE QUE DIRECCION ES 
	

	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones ".$sWhere);
	
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion,"SELECT $campos FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
																	".$sWhere." LIMIT $offset,$per_page");
	
	
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
						<th class="text-danger">Folio</th>
						
						<th># Oficio/ Fecha</th>
						<th>Nom_Remitente</th>
										
						<th>Remitente</th>
						<th>Turnado a:</th>
						<th>Estatus</th>
						
						
						<th>Tipo Correspondencia</th>
						<th>Resumen</th>
						<!--<th class='text-center' colspan="3">Asunto</th>-->
				<!--		<th class='text-center' colspan="6">Opciones</th>-->
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){
							$id_remitente=$row['id_remitente'];
							$id_destinatario=$row['id_destinatarios'];
							$nombre_direccion=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS WHERE id_dependencia= '$id_remitente'");
							$datosRemitente=mysqli_fetch_assoc($nombre_direccion);
							$nombre_remitente=$datosRemitente['identificador'].' - '.$datosRemitente['nombre'];
							
							$nombre_direccion1=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS WHERE id_dependencia= '$id_destinatario'");
							$datosRemitente1=mysqli_fetch_assoc($nombre_direccion1);
							$nombre_destinatario=$datosRemitente1['identificador'].' - '.$datosRemitente1['nombre'];
							
							$corres_id=$row['id_datos_c'];
							
							$archivos=mysqli_query($conexion, "SELECT * FROM documentos WHERE id_datos_c1= '$corres_id'");
							$Datos_Archivos=mysqli_fetch_assoc($archivos);
							$ruta=$Datos_Archivos['ruta'];
							$nombre_documento=$Datos_Archivos['nombre_documento'];
							$pdf="  <a href='../".$ruta."' >".$nombre_documento."</a>";
							$Datos_Archivos=mysqli_fetch_assoc($archivos);
							
							//verificar estatus
							$corres_status=$row['id_estatus1'];	
							switch($corres_status){
								case 1:
									$estatus='<span class="badge badge-warning">Pendiente</span>';
								break;
								case 2:
									$estatus='<span class="badge badge-info">Bandeja Entrada</span>';
								break;
								case 3:
									$estatus='<span class="badge badge-primary">En seguimiento</span>';
								break;
								case 6:
									$estatus='<span class="badge badge-secondary">Finalizado</span>';
								break;
							}
						
							$corres_folio=$row['folio'];							
							$corres_f_recep=$row['f_recepcion'];
							$corres_tip_ofi=$row['tipo_oficio'];
							$corres_idRemte=$nombre_remitente;//Cambiar al NOmbre
							$corres_nomDep=$row['nombre'];							
							$corres_cargoRemte=$row['cargo'];
							$corres_nomRemte=$row['Nombre'];
							$corres_noOfi=$row['num_oficio'];							
							$corres_fOfi=$row['f_oficio'];
							$corres_idDestino=$nombre_destinatario;//Cambiar a nombre
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
													
							$corres_fechCap=$row['fecha_cap_c'];				
							$finales++;
							$c_o_o = substr($corres_folio, -2);
							
							if($corres_tip_ofi==0){// Es para el titular
								if($c_o_o=='01'){
								//ES ORIGINAL TITULAR
									$tipo_corres='<span class="badge badge-success">Original-Titilar</span>';
							     }else{
								//ES COPIA DEL TITULAR
									$tipo_corres='<span class="badge badge-Secondary">Copia-Titilar</span>';
							     }      
							
							}else{
								//No es para el titular
								if($c_o_o=='01'){
								//ES ORIGINAL COPIA
									$tipo_corres='<span class="badge badge-info">Conocimiento-Original</span>';
							      }else{
								//ES COPIA DE la COPIA
									$tipo_corres='<span class="badge badge-Secondary">Conocimiento-Copia</span>';
							      }
									
							}
							
							
						?>	
						<tr class="<?php echo $text_class;?> text-center" style="font-size: 92% !important;">
							
							<td class="text-danger"><?php echo $corres_folio;?></td>
							
							<td class="text-center"><?php echo $corres_noOfi;?><br><?php echo $corres_fOfi;?></td>
							<td ><?php echo $corres_nomRemte;?></td>
							
							<td ><?php echo $corres_nomDep;?></td>
							
					
							<td style="font-size: 87% !important;"><?=$corres_nomDireccion?></td>
									<td ><?php echo $estatus;?></td>
							<td class="text-center"><?php echo $tipo_corres;?></td>
							<!--<td colspan="3"><?php echo $corres_asuntoDoc;?></td>-->
							
							<!-- VERIFICAREMOS SI LA CORRESPONDENCIA ES ORIGINAL O COPIA-->
							<?php
							$c_o_o = substr($corres_folio, -2);
							if($c_o_o=='01'){
								
							
							?>
							
							<td>
							
							
							
								<a href="?idcor=<?php echo $corres_id; ?>" class="editar"  data-target="#viewCorrespondenciaModal" data-toggle="modal" 
								data-vfolio="<?php echo $corres_folio;?>" 
								data-vfrecep="<?php echo date("d-m-Y",strtotime( $corres_f_recep));?>" 
								data-vnofi="<?php echo $corres_noOfi;?>" 
								data-vfofi="<?php echo date("d-m-Y",strtotime($corres_fOfi));?>" 
								data-vtofi="<?php echo $corres_tip_ofi;?>" 
								data-vidremi="<?php echo $corres_idRemte;?>" 
								data-vcargorem="<?php echo $corres_cargoRemte;?>" 
								data-vnomrem="<?php echo $corres_nomRemte;?>" 
								data-viddest="<?php echo $corres_idDestino;?>" 
								data-vcargodest="<?php echo $corres_cargoDest;?>" 
								data-vasuntodoc="<?php echo $corres_asuntoDoc;?>" 
								data-vanexodest="<?php echo $corres_anexoDest;?>" 
								data-vindidest="<?php echo $corres_indica;?>" 
								data-viddirec="<?php echo $corres_nomDireccion;?>" 
								data-vfturnado="<?php echo $corres_f_turnado;?>"
								data-vinstdir="<?php echo $corres_instruccDir;?>"
								data-idirecciones="<?php echo($corres_idDireccion); ?>" 
								data-vfreceparea="<?php echo $corres_f_recepArea;?>"							
								data-vobs="<?php echo $corres_obs;?>" 
								data-vstatus="<?php echo $corres_status;?>" 
								data-vfcapt="<?php echo $corres_fechCap;?>"
								 
								data-vid="<?php echo $corres_id;?>" onclick="mostrararchivos('<?php echo $corres_id;?>');"> <div class="statistic d-flex align-items-center "><div class="icon bg-green"><i class="icon-mail"></i></div></div></a>							
							</td>
						<?php
								}else{
								?>
								<td>
							
							
							
								<a href="?idcor=<?php echo $corres_id; ?>" class="editar"  data-target="#viewCorrespondenciaModalCopia" data-toggle="modal" 
								data-vfolio="<?php echo $corres_folio;?>" 
								data-vfrecep="<?php echo date("d-m-Y",strtotime( $corres_f_recep));?>" 
								data-vnofi="<?php echo $corres_noOfi;?>" 
								data-vfofi="<?php echo date("d-m-Y",strtotime($corres_fOfi));?>" 
								data-vtofi="<?php echo $corres_tip_ofi;?>" 
								data-vidremi="<?php echo $corres_idRemte;?>" 
								data-vcargorem="<?php echo $corres_cargoRemte;?>" 
								data-vnomrem="<?php echo $corres_nomRemte;?>" 
								data-viddest="<?php echo $corres_idDestino;?>" 
								data-vcargodest="<?php echo $corres_cargoDest;?>" 
								data-vasuntodoc="<?php echo $corres_asuntoDoc;?>" 
								data-vanexodest="<?php echo $corres_anexoDest;?>" 
								data-vindidest="<?php echo $corres_indica;?>" 
								data-viddirec="<?php echo $corres_nomDireccion;?>" 
								data-vfturnado="<?php echo $corres_f_turnado;?>"
								data-vinstdir="<?php echo $corres_instruccDir;?>"
								data-idirecciones="<?php echo($corres_idDireccion); ?>" 
								data-vfreceparea="<?php echo $corres_f_recepArea;?>"							
								data-vobs="<?php echo $corres_obs;?>" 
								data-vstatus="<?php echo $corres_status;?>" 
								data-vfcapt="<?php echo $corres_fechCap;?>"
								 
								data-vid="<?php echo $corres_id;?>" onclick="mostrararchivos1('<?php echo $corres_id;?>');"> <div class="statistic d-flex align-items-center "><div class="icon bg-yellow"><i class="icon-mail"></i></div></div></a>							
							</td>
						<?php
							}
							?>
							
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
					url: '../../html/Direcciones/archivoEnviarDato.php?id='+id,
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
					url: '../../html/Direcciones/archivoEnviarDato.php?id='+id,
					success: function( data ) {
						$('#resultados1C').html(data);
						
					}
				}
			)
		
}
</script>
         
<!--<script>
function enviarid()
{
 
valor="<?php echo $corres_id;?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
 
}
</script>-->
  
		  
