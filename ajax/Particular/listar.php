<?php
/* Connect To Database*/
require_once("../conexion.php");


$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
	$query = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables = "datos_correspondencia as dc";
	$campos = "dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom  ";




	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/


	$count_query   = mysqli_query($conexion, "SELECT count(*) AS numrows FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones  where dc.id_estatus1=1 AND SUBSTRING(dc.folio, 10, 2)='01' AND  (dc.id_datos_c LIKE '%" . $query . "%' OR dc.folio LIKE '%" . $query . "%' OR   
			  dc.f_recepcion LIKE '%" . $query . "%' OR dc.tipo_oficio LIKE '%" . $query . "%' OR 
			  dc.id_remitente LIKE '%" . $query . "%' OR dc.cargo LIKE '%" . $query . "%' OR 
			  dc.Nombre LIKE '%" . $query . "%' OR dc.num_oficio LIKE '%" . $query . "%' OR 
			  dc.f_oficio LIKE '%" . $query . "%' OR dc.id_destinatarios LIKE '%" . $query . "%' OR 						
			  dc.cargo_destinatario LIKE '%" . $query . "%' OR dc.asunto_destinatario LIKE '%" . $query . "%' OR dc.instrucciones_direcciones LIKE '%" . $query . "%' OR ds.nombre_direccion LIKE '%" . $query . "%'  OR d.nombre LIKE '%" . $query . "%' OR dependencias.nombre LIKE '%" . $query . "%') order by dc.folio ");

	if ($row = mysqli_fetch_array($count_query)) {
		$numrows = $row['numrows'];
	} else {
		echo mysqli_error($conexion);
	}
	$total_pages = ceil($numrows / $per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion, "SELECT $campos FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
																	where dc.id_estatus1=1 AND SUBSTRING(dc.folio, 10, 2)='01' AND (dc.id_datos_c LIKE '%" . $query . "%' OR dc.folio LIKE '%" . $query . "%' OR  
			  dc.f_recepcion LIKE '%" . $query . "%' OR dc.tipo_oficio LIKE '%" . $query . "%'  OR
			  dc.id_remitente LIKE '%" . $query . "%' OR dc.cargo LIKE '%" . $query . "%' OR 
			  dc.Nombre LIKE '%" . $query . "%' OR dc.num_oficio LIKE '%" . $query . "%' OR 
			  dc.f_oficio LIKE '%" . $query . "%' OR dc.id_destinatarios LIKE '%" . $query . "%' OR 				
			  dc.cargo_destinatario LIKE '%" . $query . "% ' OR dc.asunto_destinatario LIKE '%" . $query . "%' OR dc.instrucciones_direcciones LIKE '%" . $query . "%' OR dc.asunto_destinatario LIKE '%" . $query . "%' OR ds.nombre_direccion LIKE '%" . $query . "%' OR d.nombre LIKE '%" . $query . "%' OR dependencias.nombre LIKE '%" . $query . "%' ) order by dc.folio LIMIT $offset,$per_page");


	//loop through fetched data


	if ($numrows > 0) {

?>

		<div class="card">


			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-sm table-hover">
						<thead>

							<tr>
								<td colspan='12'>
									<?php
									echo paginate($page, $total_pages, $adjacents);
									?>
								</td>
							</tr>
							<tr class="text-center">

								<!--<th class='text-center'>Tipo</th>-->
								<th>Folio</th>

								<th># Oficio/ Fecha</th>
								<th>Nom_Remitente</th>

								<th>Remitente</th>
								<th>Turnado_A</th>
								<th>Destinatario</th>
								<th>f_Captura</th>
								<th>Resumen</th>
								<!--<th class='text-center' colspan="3">Asunto</th>-->
								<!--		<th class='text-center' colspan="6">Opciones</th>-->

							</tr>
						</thead>
						<tbody>
							<?php
							$finales = 0;



							while ($row = mysqli_fetch_array($query)) {
								$id_remitente = $row['id_remitente'];
								$id_destinatario = $row['id_destinatarios'];
								$nombre_direccion = mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS WHERE id_dependencia= '$id_remitente'");
								$datosRemitente = mysqli_fetch_assoc($nombre_direccion);
								$nombre_remitente = $datosRemitente['identificador'] . ' - ' . $datosRemitente['nombre'];

								$nombre_direccion1 = mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS WHERE id_dependencia= '$id_destinatario'");
								$datosRemitente1 = mysqli_fetch_assoc($nombre_direccion1);
								$nombre_destinatario = $datosRemitente1['identificador'] . ' - ' . $datosRemitente1['nombre'];

								$corres_id = $row['id_datos_c'];
								/*//SACAR COPIAS
								$sacar_folio=mysqli_query($conexion, "SELECT folio FROM datos_correspondencia WHERE id_datos_c='$corres_id'");
	                        $rows=mysqli_fetch_assoc($sacar_folio);
	                        $fiolioBruto=$rows['folio'];
	                        $newFolio = substr($fiolioBruto, 0, 9); // devuelve "d"
	                        $nom_direccion='';
	                        $sacar_copias=mysqli_query($conexion,"SELECT id_datos_c FROM `datos_correspondencia` WHERE `folio` LIKE '%$newFolio%'");
							$direcciones='';
							
	                        while($rows_copias=mysqli_fetch_assoc($sacar_copias)){
		                        $id_direcciones=$rows_copias['id_datos_c'];
		                        $buscar_id_direcciones=mysqli_query($conexion, "SELECT id_direcciones FROM datos_correspondencia WHERE id_datos_c='$id_direcciones'");
								while($rows_direcciones=mysqli_fetch_assoc($buscar_id_direcciones)){
									$direcciones=$rows_direcciones['id_direcciones'];
									$consulta_nombres=mysqli_query($conexion,"SELECT nombre_direccion FROM direcciones_secoem where id_direccion='$direcciones'");
									$row_nom=mysqli_fetch_assoc($consulta_nombres);
									$nom1=$row_nom['nombre_direccion'];
									if($row['nombre_direccion']==$nom1){
										$nom_direccion='Sin copias ';
									}else{
										
										$nom_direccion='*'.$nom1.' '.$nom_direccion;
									}
									
									
									
								}
								
	                        }*/
								//SACAR COPIAS

								$archivos = mysqli_execute_query($conexion, "SELECT * FROM documentos WHERE id_datos_c1 = ?", [$corres_id]);

								$Datos_Archivos = mysqli_fetch_assoc($archivos);
								$ruta = $Datos_Archivos['ruta'] ?? '';
								$nombre_documento = $Datos_Archivos['nombre_documento'] ?? '';
								$pdf = "  <a href='../" . $ruta . "' >" . $nombre_documento . "</a>";

								$corres_folio = $row['folio'];
								$corres_f_recep = $row['f_recepcion'];
								$corres_tip_ofi = $row['tipo_oficio'];
								$corres_idRemte = $nombre_remitente; //Cambiar al NOmbre
								$corres_nomDep = $row['nombre'];
								$corres_cargoRemte = $row['cargo'];
								$corres_nomRemte = $row['Nombre'];
								$corres_noOfi = $row['num_oficio'];
								$corres_fOfi = $row['f_oficio'];
								$corres_idDestino = $nombre_destinatario; //Cambiar a nombre
								$corres_nomDestino = $row['dnom'];
								$corres_cargoDest = $row['cargo_destinatario'];
								$corres_asuntoDoc = $row['asunto_destinatario'];
								$corres_asuntoDocp = $row['asunto_particular'];
								$corres_indica = $row['indicaciones_destinatario'];
								$corres_anexoDest = $row['anexo_destinatario'];
								$corres_idDireccion = $row['id_direcciones'];
								$corres_nomDireccion = $row['nombre_direccion'];
								$corres_f_turnado = $row['f_turnado'];
								$corres_instruccDir = $row['instrucciones_direcciones'];
								$corres_f_recepArea = $row['f_recepArea'];
								$corres_obs = $row['leyenda_destinatario'];
								$corres_status = $row['id_estatus1'];
								$corres_fechCap = $row['fecha_cap_c'];

								//******ACTUALIZACION 24-01-2022 */

								$corres_id_sub_oic   = $row['id_sub_oic'];
								$corres_id_depto     = $row['id_departamento'];
								//nombres SUBDIRECCION O Departamento
								$nombre_depto = "";
								$nombre_sub_dir = "";

								$finales++;

								if ($corres_id_sub_oic > 0) {

									$consulta_sub = mysqli_query($conexion, "SELECT nombre FROM subdirecciones_oic WHERE id = '$corres_id_sub_oic'");
									$row_Sub_dir = mysqli_fetch_assoc($consulta_sub);
									$nombre_sub_dir = '<p class="form-text text-muted text-info" style="margin: 0px !important;">' . $row_Sub_dir['nombre'] . '</p>';
									$boton_turnar = "Editar";
									$boton_turnar_class = "badge badge-warning";

									if ($corres_id_depto > 0) { //Turnado a departamento
										//echo "ENTRO";
										$consulta_depto = mysqli_query($conexion, "SELECT nombre_depto FROM departamentos WHERE id = '$corres_id_depto'");
										$row_depto = mysqli_fetch_assoc($consulta_depto);
										$nombre_depto = '<p class="form-text text-muted text-primary" style="margin: 0px !important;">' . $row_depto['nombre_depto'] . '</p>';
										//verificccar
										$boton_turnar = "Editar";
										$boton_turnar_class = "badge badge-warning";
									} else {

										$nombre_depto = ' ';
									}
								} else {
									$nombre_sub_dir = "";
									$boton_turnar   = "Turnar";
									$boton_turnar_class = "badge badge-info";
								}
								$c_o_o = substr($corres_folio, -1);
								switch ($corres_status) {
									case 1:
										$badge = '<span class="badge badge-warning">Pendiente</span>';
										break;
									case 2:
										$badge = '<span class="badge badge-primary">Autorizada</span>';
										break;
									case 3:
										$badge = '<span class="badge badge-info">En Seguimiento</span>';
										break;
									case 6:
										$badge = '<span class="badge badge-success">Finalizado</span>';
										break;
								}


								//******FIN ACTUALIZACION 25-01-2024 */

								if ($nombre_documento != "") {
									$tieneArchivo = "";
									$colorBtn = "icon bg-success";
								} else {
									$tieneArchivo = "";
									$colorBtn = "icon bg-blue";
								}
								//******ACTUALIZACION 24-01-2022 */
								if ($row['nom_capturista'] != "") {
									//echo 'entro';

									$idUser = $row['id_user'];
									$consultaImagen = mysqli_query($conexion, "SELECT * FROM imagenes_usuario WHERE id_usuario1 = $idUser");
									$Datos_Imagen = mysqli_fetch_assoc($consultaImagen);
									$imagen = $Datos_Imagen['ruta'];
									if ($imagen == "") {
										$imagen = "../../images/usuarios/universal.png";
									}

									$nom_user = $row['nom_capturista'];
								} else {
									echo 'no entro';
									$imagen = "../../images/usuarios/universal.png";
									$nom_user = "User Oficialia";
								}

								//******ACTUALIZACION 24-01-2022 */
							?>

								<tr class="<?php echo $text_class ?? ''; ?>" style="font-size: 92% !important;">

									<td class="text-center"><?php echo $corres_folio; ?> <br>

										<div class="" style="width: 55px !important; height: 55px !important;"><img src="<?= $imagen ?>" style="margin-right: 3px !important;
            width: 93% !important;
    height: 93% !important;
    border-radius: 900px !important;
    overflow: hidden !important;
border: 1px solid blue !important; " data-toggle="tooltip" data-placement="top" title="<?= $nom_user ?>">
											<?php echo ($tieneArchivo); //******ACTUALIZACION 24-01-2022 */
											?> </div>
									</td>

									<td class="text-center"><?php echo $corres_noOfi; ?><br><?php echo $corres_fOfi; ?></td>
									<td><?php echo $corres_nomRemte; ?></td>

									<td><?php echo $corres_nomDep; ?></td>

									<td>
										<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?= $corres_nomDireccion ?><br><?= $nombre_sub_dir ?><?= $nombre_depto ?></span></div>
									</td>

									<td><?php echo $corres_nomDestino; ?></td>
									<td class="text-center"><?php echo $corres_fechCap; ?></td>
									<!--<td colspan="3"><?php echo $corres_asuntoDoc; ?></td>-->

									<td>



										<a href="?idcor=<?php echo $corres_id; ?>" class="editar" data-target="#viewCorrespondenciaModal" data-toggle="modal"
											data-vfolio="<?php echo $corres_folio; ?>"
											data-vfrecep="<?php echo date("d-m-Y", strtotime($corres_f_recep)); ?>"
											data-vnofi="<?php echo $corres_noOfi; ?>"
											data-vfofi="<?php echo date("d-m-Y", strtotime($corres_fOfi)); ?>"
											data-vtofi="<?php echo $corres_tip_ofi; ?>"
											data-vidremi="<?php echo $corres_idRemte; ?>"
											data-vcargorem="<?php echo $corres_cargoRemte; ?>"
											data-vnomrem="<?php echo $corres_nomRemte; ?>"
											data-viddest="<?php echo $corres_idDestino; ?>"
											data-vcargodest="<?php echo $corres_cargoDest; ?>"
											data-vasuntodoc="<?php echo $corres_asuntoDoc; ?>"
											data-vasuntodocp="<?php echo $corres_asuntoDocp; ?>"
											data-vanexodest="<?php echo $corres_anexoDest; ?>"
											data-vindidest="<?php echo $corres_indica; ?>"
											data-viddirec="<?php echo $corres_nomDireccion; ?>"
											data-vfturnado="<?php echo $corres_f_turnado; ?>"
											data-vinstdir="<?php echo $corres_instruccDir; ?>"
											data-idirecciones="<?php echo ($corres_idDireccion); ?>"
											data-vfreceparea="<?php echo $corres_f_recepArea; ?>"
											data-vobs="<?php echo $corres_obs; ?>"
											data-vstatus="<?php echo $corres_status; ?>"
											data-vfcapt="<?php echo $corres_fechCap; ?>"
											data-direcciones="<?php echo $nom_direccion ?? ''; ?>"

											data-vid="<?php echo $corres_id; ?>" onclick="mostrararchivos('<?php echo $corres_id; ?>'); mostrarCopias('<?php echo $corres_folio; ?>');">
											<div class="statistic d-flex align-items-center ">
												<div class="<?php echo $colorBtn; ?>"><i class="icon-mail"></i></div>
											</div>
										</a>
									</td>


								</tr>
							<?php } ?>
							<tr>
								<td colspan='3'>
									<input type="hidden" name="numpag" id="numpag" required value="<?php echo $page; ?>" required>
								</td>
								<td colspan='12'>
									<?php
									$inicios = $offset + 1;
									$finales += $inicios - 1;
									echo "Mostrando $inicios al $finales de $numrows registros";
									?>
								</td>
							</tr>
							<tr>
								<td colspan='12'>
									<?php
									echo paginate($page, $total_pages, $adjacents);
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

		$.ajax({
			url: '../../html/Particular/archivoEnviarDato.php?id=' + id,
			success: function(data) {
				$('#resultados1').html(data);

			}
		})

	}

	function mostrarCopias(id) {

		$.ajax({
			url: '../../html/Particular/mostrarCopias.php?id=' + id,
			success: function(data) {
				$('#div_copias').html(data);

			}
		})

	}
</script>

<!--<script>
function enviarid()
{
 
valor="<?php echo $corres_id ?? ''; ?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
 
}
</script>-->