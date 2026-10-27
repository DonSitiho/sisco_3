<?php

/* Connect To Database*/
require_once("../../php/conexion.php");
session_start();
$id_direccion = $_SESSION['id_direccion'];
$id_usuario = $_SESSION['id_usuario'];
$nivel_acceso = $_SESSION['nivel_acceso'];
$subdireccion = $_SESSION['subdireccion'];
$depto = $_SESSION['depto'];
if ($id_direccion == 2 && $nivel_acceso == 1) {
	$decision = ' ';
} else {
	if ($subdireccion == 0 or $subdireccion == NULL) {
		$decision = ' dc.id_direcciones=' . $id_direccion . ' AND';
	} elseif ($depto == 0 or $subdireccion == NULL) {
		$decision = ' dc.id_direcciones = ' . $id_direccion . ' AND FIND_IN_SET(' . $subdireccion . ', id_sub_oic) AND';
	} else {
		$decision = ' dc.id_direcciones = ' . $id_direccion . ' AND FIND_IN_SET(' . $depto . ', id_departamento) AND';
	}
}

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
	$query = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query2 = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['query2'], ENT_QUOTES)));
	$query4 = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['query4'], ENT_QUOTES)));
	//$query5 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query5'], ENT_QUOTES)));
	$query6 = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['query6'], ENT_QUOTES)));
	$direccion = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['direccion'], ENT_QUOTES)));

	$query3 = 0;
	$var = $query;
	$var2 = $query2;
	$var4 = $query4;
	$var6 = $query6;
	$direccion2 = $direccion;

	if (empty($query2)) {
		$query2 = $query;
	}
	if ($direccion == 0) {

		$tables = "datos_correspondencia as dc";
		$campos = "dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
		if ($query3 == 0) {
			if ($query6 == 0) {

				if ($query4 == 0) {

					$sWhere = $decision . " dc.id_estatus1!=1 AND dc.f_recepcion >='" . $query . "' AND dc.f_recepcion <= '" . $query2 . "' ";
				} else {

					$sWhere = $decision . " dc.id_estatus1!=1 AND dc.id_remitente ='" . $query4 . "' AND dc.f_recepcion >='" . $query . "' AND dc.f_recepcion <= '" . $query2 . "' ";
				}
			} else {

				if ($query4 == 0) {
					$sWhere = $decision . " dc.id_estatus1 = '" . $query6 . "' AND dc.f_recepcion >='" . $query . "' AND dc.f_recepcion <= '" . $query2 . "' ";
				} else {
					$sWhere = $decision . " dc.id_estatus1 = '" . $query6 . "' AND dc.id_remitente ='" . $query4 . "' AND dc.f_recepcion >='" . $query . "' AND dc.f_recepcion <= '" . $query2 . "' ";
				}
			}
		}
	} else {

		$tables = "datos_correspondencia as dc";
		$campos = "dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
		if ($query3 == 0) {
			$sWhere = "dc.id_direcciones ='$direccion' AND dc.id_estatus1!=1 AND dc.f_recepcion >='" . $query . "' AND dc.f_recepcion <= '" . $query2 . "' ";
		}
	}

	$sWhere .= " order by dc.folio";

	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row = mysqli_fetch_array($count_query)) {
		$numrows = $row['numrows'];
	} else {
		echo mysqli_error($conexion);
	}
	$total_pages = ceil($numrows / $per_page);
	//main query to fetch the data
	$query = mysqli_query($conexion, "SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones 
																	WHERE  $sWhere LIMIT $offset,$per_page");



	//loop through fetched data


	if ($numrows > 0) {

?>

		<div class="conteiner-fluid">

			<table class="table table-sm table-striped table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<td colspan='2'>

							<a href="../../ajax/Direcciones/generar_reporte.php?var=<?= $var ?>&var2=<?= $var2 ?>&direccion=<?= $direccion2 ?>&var4=<?= $var4 ?>&var6=<?= $var6 ?>" target="_blank"> <button class="btn btn-success" type="submit">Exportar a PDF</button></a><br><br>
							
							<a href="../../ajax/Direcciones/generar_reporte_excel.php?var=<?= $var ?>&var2=<?= $var2 ?>&direccion=<?= $direccion2 ?>&var4=<?= $var4 ?>&var6=<?= $var6 ?>"> <button class="btn btn-success" type="button">Exportar a Excel</button></a>

						</td>
						<td colspan='4'>
							<p class="text-center display-4" style="font-size: 2.0rem !important;">Vista preliminar del reporte</p>

						</td>
						<td colspan='10'>
							<?php
							//echo paginate( $page, $total_pages, $adjacents);
							?>
						</td>
					</tr>
					<tr class="text-center">

						<!--<th class='text-center'>Tipo</th>-->
						<th>Folio / Estatus</th>
						<th>FechaRecep</th>
						<th># Oficio</th>
						<th>FechaOficio</th>
						<th>Remitente</th>
						<th>Destinatario</th>
						<th>Turnado_A</th>
						<th>fechaCaptura</th>
						<!--<th class='text-center' colspan="3">Asunto</th>-->


					</tr>
				</thead>
				<tbody>
					<?php
					$finales = 0;
					while ($row = mysqli_fetch_array($query)) {
						$corres_id = $row['id_datos_c'];
						$corres_folio = $row['folio'];
						$corres_f_recep = $row['f_recepcion'];
						$corres_tip_ofi = $row['tipo_oficio'];
						$corres_idRemte = $row['id_remitente'];
						$corres_nomDep = $row['nombre'];
						$corres_cargoRemte = $row['cargo'];
						$corres_nomRemte = $row['Nombre'];
						$corres_noOfi = $row['num_oficio'];
						$corres_fOfi = $row['f_oficio'];
						$corres_idDestino = $row['id_destinatarios'];
						$corres_nomDestino = $row['dnom'];
						$corres_cargoDest = $row['cargo_destinatario'];
						$corres_asuntoDoc = $row['asunto_destinatario'];
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
						$finales++;
						switch ($corres_status) {
							case 2:
								$badge = '<span class="badge badge-primary">En Bandeja</span>';
								break;
							case 3:
								$badge = '<span class="badge badge-info">En Seguimiento</span>';
								break;
							case 6:
								$badge = '<span class="badge badge-success">Finalizado</span>';
								break;
						}
					?>
						<tr>

							<td class="text-danger"><?php echo "<center>" . $corres_folio . "<br>" . $badge . "</center>"; ?></td>
							<td><?php echo $corres_f_recep; ?></td>
							<td><?php echo $corres_noOfi; ?></td>
							<td><?php echo $corres_fOfi; ?></td>
							<td><?php echo $corres_nomDep; ?></td>
							<td><?php echo $corres_nomDestino; ?></td>
							<td><?php echo $corres_nomDireccion; ?></td>
							<td class="text-center"><?php echo $corres_fechCap; ?></td>
							<!--<td colspan="3"><?php echo $corres_asuntoDoc; ?></td>-->




						</tr>
					<?php } ?>
					<tr>
						<td colspan='10'>
							<?php
							$inicios = $offset + 1;
							$finales += $inicios - 1;
							echo "Mostrando $inicios al $finales de $numrows registros";
							?>
						</td>
					</tr>
					<tr>
						<td colspan='10'>
							<?php
							echo paginate($page, $total_pages, $adjacents);
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
<!--<script>
function enviarid()
{
 
valor="<?php echo $corres_id; ?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
 
}
</script>-->