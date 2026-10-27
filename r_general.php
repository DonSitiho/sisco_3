<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<?php

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=date("Y-m-d");
    $fecha_hora=date("Y-m-d H:i:s");

require_once __DIR__ . '/vendor/autoload.php';


require_once ("ajax/conexion.php");

$css = file_get_contents('css/stylerep.css');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal-L']);

$mpdf->setFooter('Página '.'{PAGENO}'.' de '.'{nbpg}');


include ("ajax/conexion.php");

$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
$query1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
$query2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
$query3 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q3'], ENT_QUOTES)));;
//$query2 = (int)$query_2;
//$query3 = (int)$query_3;
$sWhere = "";


if ($query2=='0' AND $query3=='0'){
    $sWhere.="(dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR  
              dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
              dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
              dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
              dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
              dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%$query%') AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR  
              dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR 
              dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR 
              dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR 
              dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR 						
              dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%$query1%')";		  
              
}elseif($query2=='0' AND $query3>'0'){
    
    $sWhere.="(dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR  
              dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
              dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
              dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
              dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
              dc.cargo_destinatario LIKE '%".$query."%' OR dc.asunto_destinatario LIKE '%$query%') AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR  
              dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR 
              dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR 
              dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR 
              dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR 						
              dc.cargo_destinatario LIKE '%".$query1."%'  OR dc.asunto_destinatario LIKE '%$query1%' ) AND (dc.id_direcciones = '".$query3."')";		  
              
}elseif($query2>'0' AND $query3=='0'){
                
    $sWhere.="(dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR  
                dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
                dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
                dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
                dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
                dc.cargo_destinatario LIKE '%".$query."%'  OR dc.asunto_destinatario LIKE '%$query%') AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR  
                dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR 
                dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR 
                dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR 
                dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR 						
                dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%$query1%') AND (dc.id_remitente = '".$query2."')";		  
                          
}else{
                            
    $sWhere.="(dc.id_datos_c LIKE '%".$query."%' OR dc.folio LIKE '%".$query."%' OR  
                dc.f_recepcion LIKE '%".$query."%' OR dc.tipo_oficio LIKE '%".$query."%' OR 
                dc.id_remitente LIKE '%".$query."%' OR dc.cargo LIKE '%".$query."%' OR 
                dc.Nombre LIKE '%".$query."%' OR dc.num_oficio LIKE '%".$query."%' OR 
                dc.f_oficio LIKE '%".$query."%' OR dc.id_destinatarios LIKE '%".$query."%' OR 						
                dc.cargo_destinatario LIKE '%".$query."%'  OR dc.asunto_destinatario LIKE '%$query%') AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query."%' OR  
                dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR 
                dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR 
                dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR 
                dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR 						
                dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%$query1%') AND (dc.id_remitente = '".$query2."') AND (dc.id_direcciones = '".$query3."')";		  
}

$tables="datos_correspondencia as dc";
$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";				
$sWhere.="order by folio";

$query = $conexion -> query ("SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
                                                    INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
                                                    INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
                                                    where $sWhere ");
                                                  
//$query=$conexion->query("SELECT * FROM datos_correspondencia");

$plantilla = '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <header class="container">    
            <div>
                <img id="logo" src="images/Logo SECOEM 2015-2021.png" width="20%" alt="">
                <img id="marca" src="images/siscoHorizontal.png" width="20%" alt="">
                <div class="center">
                    <h2 class="name"><b>OFICIALIA DE PARTES</b><br>REPORTE DE CORRESPONDENCIA DIARIO</h2>                             
                    <div class="date">Fecha del Reporte: '.$fecha_hora.'</div>                
                </div>           
            </div>             
    </header>
    

    <table>
        <thead>
            <tr>                				
                <th>Folio<br>FechaRecep</th>                
                <th># Oficio<br>FechaOficio</th>                						
                <th>Remitente<br>Cargo</th>
                <th>Destinatario<br>Cargo</th>
                <th>Asunto</th>
                <th>Turnado_A<br>fechaCaptura<br>Anexos</th> 
                <th colspan="4">Firma</th>               						                
            </tr>
        </thead>
        <tbody>';

        while ($row = mysqli_fetch_array($query)) {																		
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
       
        $plantilla .='<tr class="<?php echo $text_class;?>">                        
                        <td>'.$corres_folio.'<br>'.$corres_f_recep.'</td>
                        <td>'.$corres_noOfi.'<br>'.$corres_fOfi.'</td>
                        <td>'.$corres_nomDep.'<br>'.$corres_cargoRemte.'</td>
                        <td>'.$corres_nomDestino.'<br>'.$corres_cargoDest.'</td>
                        <td>'.$corres_asuntoDoc.'</td>
                        <td>'.$corres_nomDireccion.'<br>'.$corres_f_turnado.'<br>'.$corres_anexoDest.'</td>
                        <td>'.'                         '.'</td>
                        <td>'.'                         '.'</td>
                        <td>'.'                         '.'</td>
                        <td>'.'                         '.'</td>
                     </tr>';
}

$plantilla .='</table>


</tbody>';


$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output();



?>