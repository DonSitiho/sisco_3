<?php

/* Connect To Database*/
require_once("../../php/conexion.php");
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual = date("Y-m-d");
$fecha_hora = date("Y-m-d H:i:s");
$hoy = date('Y-m-d');


$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
	$query = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['query'] ?? '')));
	$query1 = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['query1'] ?? '')));

	$tables = "num_oficios as o";
	$campos = "o.*, d.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";



	include '../../ajax/pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$decicion = '';
	if ($query != '') {
		$decicion = "o.folio_oficio = '" . $query . "' AND";
		echo $decicion;
	} else {
		$decicion = '';
		echo $decicion;
	}


	$count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $tables INNER JOIN dependencias AS d ON d.id_dependencia=o.id_dependencia	where " . $decicion . "   (o.fecha_solicitado LIKE '%" . $query1 . "%' OR  																											  
																											o.num_oficio LIKE '%" . $query1 . "%' OR o.nombre_oficio LIKE '%" . $query1 . "%' OR o.id_dependencia LIKE '%" . $query1 . "%' OR 
																											o.fecha_oficio LIKE '%" . $query1 . "%' OR o.cargo_oficio LIKE '%" . $query1 . "%' OR 
																											o.asunto_oficio LIKE '%" . $query1 . "%' OR o.solicitante_oficio LIKE '%" . $query1 . "%' OR 
																											o.id_direccion LIKE '%" . $query1 . "%' OR o.folio_relacionado LIKE '%" . $query1 . "%' OR 
																											o.estatus_oficio LIKE '%" . $query1 . "%' OR o.fecha_entregaoficio LIKE '%" . $query1 . "%' OR  
																											o.nombre_recibeoficio LIKE '%" . $query1 . "%' OR d.nombre LIKE '%" . $query1 . "%') order by o.no_oficio DESC");

	if ($row = mysqli_fetch_array($count_query)) {
		$numrows = $row['numrows'];
	} else {
		echo mysqli_error($conexion);
	}
	$total_pages = ceil($numrows / $per_page);
	//main query to fetch the data
	$query = mysqli_query($conexion, "SELECT $campos FROM  $tables INNER JOIN dependencias AS d ON d.id_dependencia=o.id_dependencia																	 
																	
																	where " . $decicion . "   (o.fecha_solicitado LIKE '%" . $query1 . "%' OR  
			  o.num_oficio LIKE '%" . $query1 . "%' OR  o.nombre_oficio LIKE '%" . $query1 . "%' OR o.id_dependencia LIKE '%" . $query1 . "%' OR 
			  o.fecha_oficio LIKE '%" . $query1 . "%' OR o.cargo_oficio LIKE '%" . $query1 . "%' OR 
			  o.asunto_oficio LIKE '%" . $query1 . "%' OR o.solicitante_oficio LIKE '%" . $query1 . "%' OR 
			  o.id_direccion LIKE '%" . $query1 . "%' OR o.folio_relacionado LIKE '%" . $query1 . "%' OR 
			  o.estatus_oficio LIKE '%" . $query1 . "%' OR o.fecha_entregaoficio LIKE '%" . $query1 . "%' OR 
			  o.nombre_recibeoficio LIKE '%" . $query1 . "%' OR d.nombre LIKE '%" . $query1 . "%') order by o.no_oficio DESC LIMIT $offset,$per_page");


	//loop through fetched data
	// INICIAR SESSION
	session_start();
	$nivel_usuario = $_SESSION['nivel_acceso'];

	if ($numrows > 0) {

?>
		<div class="container-fluid card" style="border-radius: 2% !important;">

			<table class="table table-striped  table-hover table-responsive table-sm">
				<thead>

					<tr>
						<td colspan='3'>
							<input type="hidden" name="numpagofi" id="numpagofi" required value="<?php echo $page; ?>" required>
						</td>
						<td colspan='12'>
							<?php
							echo paginate($page, $total_pages, $adjacents);
							?>
						</td>
					</tr>
					<tr class="text-center">
						<!--<th class='text-center'>id</th>-->
						<!--<th class='text-center'>Tipo</th>-->
						<th class='text-center'>No Oficio</th>
						<th colspan='3'>Fecha<br>solicitado</th>
						<th>Dependencia<br>(destino)</th>
						<th>Nombre<br>Cargo</th>
						<th colspan='3'>Asunto</th>
						<th>Solicitó</th>
						<th colspan='2'>Area</th>
						<th>Estatus</th>

						<th class='text-center' colspan="6">Opciones</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$finales = 0;
					while ($row = mysqli_fetch_array($query)) {
						$ofi_id = $row['no_oficio'];
						$ofi_folio = $row['folio_oficio'];
						$ofi_numofi = $row['num_oficio'];
						$ofi_fsolicitado = $row['fecha_solicitado'];
						$ofi_foficio = $row['fecha_oficio'];
						$ofi_iddep = $row['id_dependencia'];
						$ofi_nomDestino = $row['dnom'];
						$ofi_nomofi = $row['nombre_oficio'];
						$ofi_cargofi = $row['cargo_oficio'];
						$ofi_asunto = $row['asunto_oficio'];
						$ofi_solicitante = $row['solicitante_oficio'];
						$ofi_idarea = $row['id_direccion'];
						//consult6a
						$consul = mysqli_query($conexion, "SELECT * FROM dependencias WHERE id_dependencia='$ofi_idarea'");
						$row1 = mysqli_fetch_assoc($consul);
						$nombre_dependencia = $row1['nombre'];

						$ofi_foliorel = $row['folio_relacionado'];
						$ofi_status = $row['estatus_oficio'];
						$ofi_fingreso = $row['fecha_ingresofirma'];
						$ofi_fentrega = $row['fecha_entregaoficio'];
						$ofi_nomrecibe = $row['nombre_recibeoficio'];


						$finales++;
						//color de fila
						if ($ofi_status == 4) {
							$color = 'background:rgba(255, 242, 242) !important;';
						} else {
							$color = '';
						}
					?>
						<!--//CREAR DECISION PARA MOSTRAR ICONOS-->
						<tr class="<?php echo $text_class ?? ''; ?>" style="<?php echo ($color); ?>">
							<td class='text-center'>
								<strong>
									<font color="red">
										<?php echo $ofi_folio; ?>
									</font>
								</strong>
							</td>
							<td colspan="3">
								<?php echo $ofi_fsolicitado; ?><br>
								<?php echo $ofi_numofi; ?>
							</td>
							<td>
								<?php echo $ofi_nomDestino; ?>
							</td>
							<td>
								<?php echo $ofi_nomofi; ?>.<br>.
								<?php echo $ofi_cargofi; ?>
							</td>
							<td colspan='3'>
								<?php echo $ofi_asunto; ?>
							</td>
							<td>
								<?php echo $ofi_solicitante; ?>
							</td>
							<td colspan='2'>
								<?php echo $nombre_dependencia; ?>
							</td>

							<td>
								<?php

								if ($ofi_status == 1) {
								?>
									<h5><span class="badge badge-warning">Asignado</span></h5>
							</td>
						<?php
								} else if ($ofi_status == 2) {
						?>
							<h5><span class="badge badge-success">Revisado</span></h5>
							</td>
						<?php
								} else if ($ofi_status == 3) {
						?>
							<h5><span class="badge badge-info">Vinculado</span></h5>
							<?php echo $ofi_foliorel; ?>
							</td>
						<?php
								} else if ($ofi_status == 4) {
						?>
							<h5><span class="badge badge-danger">Cancelado</span></h5>
							</td>
						<?php
								}
						?> </td>




						<!-- ICONO DE REVISAR OFICIOS -->
						<td>
							<!-- ICONO DE MOSTRAR -->
							<a href=" " class="editar" data-target="#viewOficiosrevModal" data-toggle="modal" data-vrnumofi="<?php echo $ofi_numofi; ?>" data-vrfsolicitado="<?php echo $ofi_fsolicitado; ?>" data-vrfoficio="<?php echo $ofi_foficio; ?>" data-vrnomofi="<?php echo $ofi_nomofi; ?>" data-vrcargofi="<?php echo $ofi_cargofi; ?>" data-vriddep="<?php echo $ofi_iddep; ?>" data-vrasunto="<?php echo $ofi_asunto; ?>" data-vrsolicitante="<?php echo $ofi_solicitante; ?>" data-vridarea="<?php echo $ofi_idarea; ?>" data-vrfoliorel="<?php echo $ofi_foliorel; ?>" data-vrstatus="<?php echo $ofi_status; ?>"
								data-vrfolio="<?php echo $ofi_folio; ?>" data-vrfingreso="<?php echo $ofi_fingreso; ?>" data-vrfentrega="<?php echo $ofi_fentrega; ?>" data-vrnomrecibe="<?php echo $ofi_nomrecibe; ?>" data-vrid="<?php echo $ofi_id; ?>" onclick="mostraroficios('<?php echo $ofi_id; ?>');">
								<div class="statistic d-flex align-items-center ">
									<div class="icon bg-blue"><i class="icon-mail"></i></div>
								</div>
							</a>
						</td>
						<!-- ICONO DE MOSTRAR -->
						</tr>
					<?php } ?>
					<tr>
						<td colspan='19'>
							<?php
							$inicios = $offset + 1;
							$finales += $inicios - 1;
							echo "Mostrando $inicios al $finales de $numrows registros";
							?>
						</td>
					</tr>
					<tr>
						<td colspan='3'>
							<input type="hidden" name="numpagofi" id="numpagofi" required value="<?php echo $page; ?>" required>
						</td>
						<td colspan='12'>
							<?php
							echo paginate($page, $total_pages, $adjacents);
							?>
						</td>
					</tr>
				</tbody>
			</table>

		</div>


<?php
	} else {
		echo ' No existen Registros ';
	}
}
?>

<script>
	function mostraroficios(id) {

		$.ajax({
			url: '../../ajax/Particular/mostrar_oficios.php?id=' + id,
			success: function(data) {
				$('#mostrar').html(data);

			}
		})

	}
</script>