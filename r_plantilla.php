<?php

include ('ajax/conexion.php');

	function getPlantilla(){
   
		include ('ajax/conexion.php');
		$tables="datos_correspondencia as dc";
		$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";				
		$sWhere=" order by dc.id_datos_c";
		
		$query = $conexion -> query ("SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
															INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
															INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
															where $sWhere");
															

		$plantilla = '<div class="table-responsive">
			<table class="table table-sm table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">id</th>						
						<th>Folio</th>
						<th>FechaRecep</th>
						<th># Oficio</th>
						<th>FechaOficio</th>						
						<th>Remitente</th>
						<th>Turnado_A</th>
						<th>Destinatario</th>
						<th>fechaCaptura</th>						
						<th class="text-center" colspan="2">Opciones</th>						
					</tr>
				</thead>
				<tbody>'; 
				
				
						while ($row = mysqli_fetch_array($query)) {																		
							$corres_id=$row["id_datos_c"];
							$corres_folio=$row["folio"];							
							$corres_f_recep=$row["f_recepcion"];
							$corres_tip_ofi=$row["tipo_oficio"];
							$corres_idRemte=$row["id_remitente"];
							$corres_nomDep=$row["nombre"];							
							$corres_cargoRemte=$row["cargo"];
							$corres_nomRemte=$row["Nombre"];
							$corres_noOfi=$row["num_oficio"];							
							$corres_fOfi=$row["f_oficio"];
							$corres_idDestino=$row["id_destinatarios"];
							$corres_nomDestino=$row["dnom"];
							$corres_cargoDest=$row["cargo_destinatario"];							
							$corres_asuntoDoc=$row["asunto_destinatario"];
							$corres_indica=$row["indicaciones_destinatario"];
							$corres_anexoDest=$row["anexo_destinatario"];
							$corres_idDireccion=$row["id_direcciones"];
							$corres_nomDireccion=$row["nombre_direccion"];
							$corres_f_turnado=$row["f_turnado"];
							$corres_instruccDir=$row["instrucciones_direcciones"];
							$corres_f_recepArea=$row["f_recepArea"];
							$corres_obs=$row["leyenda_destinatario"];							
							$corres_status=$row["id_estatus1"];							
							$corres_fechCap=$row["fecha_cap_c"];															

				$plantilla .='<tr class="<?php echo $text_class;?>">
								<td ><?php echo $corres_id;?></td>
								<td ><?php echo $corres_folio;?></td>
								<td ><?php echo $corres_f_recep;?></td>
								<td ><?php echo $corres_noOfi;?></td>
								<td ><?php echo $corres_fOfi;?></td>
								<td ><?php echo $corres_nomDep;?></td>
								<td ><?php echo $corres_nomDireccion;?></td>
								<td ><?php echo $corres_nomDestino;?></td>
								<td ><?php echo $corres_fechCap;?></td>
								<!--<td colspan="3"><?php echo $corres_asuntoDoc;?></td>-->							
																	
							</tr>';
				
						
				$plantilla .='</tbody>			
						</table>
					</div>' ;
				return $plantilla;
			
		}
	}

?>