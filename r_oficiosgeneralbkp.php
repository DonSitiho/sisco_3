<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<?php

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");

require_once __DIR__ . '/vendor/autoload.php';


require_once ("ajax/conexion.php");

$css = file_get_contents('css/stylerep.css');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter']);

$mpdf->setFooter('Página '.'{PAGENO}'.' de '.'{nbpg}');


include ("ajax/conexion.php");

	$query = intval($_POST['q']);
	$query1 = mysqli_real_escape_string($conexion,(strip_tags($_POST['q1'], ENT_QUOTES)));
	$query2 =  intval($_POST['q2']);
	$query3 = intval($_POST['q3']);


	$sWhere = "";
	
	
	if ($query2==0 AND $query3==0 AND $query==0){
	$sWhere.=" o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
			  o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
			  o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
			  o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
			  o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
			  o.estatus_oficio LIKE '%".$query1."%'";
	
	}elseif($query2==0 AND $query==0 AND $query3>0){
		$sWhere.=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.id_direccion = '".$query3."')";
	

	}elseif($query2>0 AND $query3==0 AND $query==0){				
		$sWhere.=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.id_dependencia = '".$query2."')";

	}elseif($query2==0 AND $query3==0 AND $query>0){				
		$sWhere.=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.estatus_oficio = '".$query."')";

	}elseif($query2>0 AND $query3==0 AND $query>0){	
		$sWhere.=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.id_dependencia = '".$query2."') AND (o.estatus_oficio = '".$query."') ";

	}elseif($query2==0 AND $query3>0 AND $query>0){	
		$sWhere.=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.id_direccion = '".$query3."') AND (o.estatus_oficio = '".$query."') ";
	}else{

		$sWhere.=" (o.no_oficio LIKE '%".$query1."%' OR o.fecha_solicitado LIKE '%".$query1."%' OR  
					o.nombre_oficio LIKE '%".$query1."%' OR o.id_dependencia LIKE '%".$query1."%' OR 
					o.fecha_oficio LIKE '%".$query1."%' OR o.cargo_oficio LIKE '%".$query1."%' OR 
					o.asunto_oficio LIKE '%".$query1."%' OR o.solicitante_oficio LIKE '%".$query1."%' OR 
					o.id_direccion LIKE '%".$query1."%' OR o.folio_relacionado LIKE '%".$query1."%' OR 
					o.estatus_oficio LIKE '%".$query1."%') AND (o.estatus_oficio = '".$query."') AND (o.id_dependencia = '".$query2."') AND (o.id_direccion = '".$query3."')";

	}


$tables="num_oficios as o";
$campos="o.*, d.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
$sWhere.="order by o.no_oficio DESC";
	

$query = $conexion -> query ("SELECT $campos FROM  $tables INNER JOIN dependencias AS d ON d.id_dependencia=o.id_dependencia where $sWhere");
                                                  
//$query=$conexion->query("SELECT * FROM datos_correspondencia");

$plantilla = '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <header class="container">    
            <div>
                <img id="logo" src="images/Logo SECOEM 2015-2021.png" width="20%" alt="">
                <img id="marca" src="images/siscoHorizontal.png" width="20%" alt="">
                <div class="center">
                    <h2 class="name"><b>OFICINA DEL SECRETARIO PARTICULAR</b><br>REPORTE DE OFICIOS ASIGNADOS</h2>                             
                    <div class="date">Fecha del Reporte: '.$fecha_hora.'</div>                
                </div>           
            </div>             
    </header>
    

    <table>
        <thead>
            <tr>                				
                <th>No Oficio</th>
                <th colspan="3">Fecha_solicitado<br>Fecha_oficio</th>				
                <th>Dependencia<br>(destino)</th>										
                <th>Nombre<br>Cargo</th>						
                <th colspan="4">Asunto</th>
                <th>Solicitó</th>
                <th colspan="2">Area</th>
                <th>Status/<br>OficioRel</th>
                <th></th>             						                
            </tr>
        </thead>
        <tbody>';

        while ($row = mysqli_fetch_array($query)) {																		
            $ofi_id=$row['no_oficio'];
			$ofi_fsolicitado=$row['fecha_solicitado'];							
			$ofi_foficio=$row['fecha_oficio'];
			$ofi_iddep=$row['id_dependencia'];
			$ofi_nomDestino=$row['dnom'];
			$ofi_nomofi=$row['nombre_oficio'];
			$ofi_cargofi=$row['cargo_oficio'];
			$ofi_asunto=$row['asunto_oficio'];							
			$ofi_solicitante=$row['solicitante_oficio'];
			$ofi_idarea=$row['id_direccion'];

			$consul=mysqli_query($conexion, "SELECT * FROM dependencias WHERE id_dependencia='$ofi_idarea'");
							$row1=mysqli_fetch_assoc($consul);
							$nombre_dependencia=$row1['nombre'];

		
			$ofi_foliorel=$row['folio_relacionado'];							
			$ofi_status=$row['estatus_oficio'];							
       
        $plantilla .='<tr class="<?php echo $text_class;?>">                        
                        <td>'.$ofi_id.'</td>
                        <td colspan="3">'.$ofi_fsolicitado.'<br>'.$ofi_foficio.'</td>
                        <td>'.$ofi_nomDestino.'</td>
                        <td>'.$ofi_nomofi.'<br>'.$ofi_cargofi.'</td>
                        <td colspan="4">'.$ofi_asunto.'</td>
                        <td>'.$ofi_solicitante.'</td>
						<td colspan="2">'.$nombre_dependencia.'</td> 
						<td >';
																				
							if($ofi_status==1){ 
							$plantilla .='<h5><span class="badge badge-warning">Asignado</span></h5></td>';
							}else if($ofi_status==2){
							$plantilla .='<h5><span class="badge badge-success">Revisado</span></h5></td>'; 
							}else if($ofi_status==3){
							$plantilla .='<h5><span class="badge badge-info">Vinculado</span></h5>';
							}else if($ofi_status==4){
							$plantilla .='<h5><span class="badge badge-danger">Cancelado</span></h5></td>';
							}													
						'</td>                      
                        <td>'.$ofi_status.'<br>'.$ofi_foliorel.'</td>
                        <td>'.'                   '.'</td>
                       
                     </tr>';
			
}

$plantilla .='</table>


</tbody>';


$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output();



?>