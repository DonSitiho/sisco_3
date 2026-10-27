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

$query  = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
$query1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
$query2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
$query3 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['q4'], ENT_QUOTES)));
// echo $query3 ;
// exit();
$q  = (string)$query;
$q1 = (string)$query1;

$sWhere = "";

$tables="datos_correspondencia as dc";
$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";				

if($query3 == 0) {

if ($query2=='0'){
    
    $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' ";	  
              
}else{
    
    $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_direcciones= '".$query2."'";		  
              
}
}else{

    if ($query2=='0'){
    
        $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_remitente =  ".$query3." ";	  
                  
    }else{
        
        $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_direcciones= '".$query2."' AND dc.id_remitente =  ".$query3." ";		  
      

}

}












$sWhere.= "order by dc.folio";

$query = $conexion -> query ("SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
                                                    INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
                                                    INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
                                                    where $sWhere ");

                                                  
//$query=$conexion->query("SELECT * FROM datos_correspondencia");

$plantilla = '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <header class="container">    
            <div>
                <img id="logo" src="images/secoem.png" width="20%" alt="">
                <img id="marca" src="images/siscoHorizontal.png" width="20%" alt="">
                <div class="center">
                    <h2 class="name"><b>OFICIALIA DE PARTES</b><br>REPORTE DE CORRESPONDENCIA POR RANGO DE FECHAS Y AREA</h2>                             
                    <div class="date">Reporte del: '.$q.' al '.$q1.'</div>                
                </div>           
            </div>             
    </header>
    

    <table table-sm>
        <thead>
            <tr>                				
                <th style="width:4%">No.</th>                
                <th style="width:4%">Folio<br>FechaRecep</th>                
                <th style="width:4%"># Oficio<br>FechaOficio</th>                						
                <th style="width:10%">Remitente<br>Cargo</th>
                <th style="width:10%">Destinatario<br>Cargo</th>
                <th style="width:20%">Asunto</th>
                <th style="width:20%">Asunto Condensado</th>
                <th style="width:10%">Notas</th>               						                
                <th style="width:8%">Turnado_A<br>fechaCaptura<br>Anexos</th>
                <th style="width:10%">Instrucciones</th> 
            </tr>
        </thead>
        <tbody>';
        $num_corres=1;
        while ($row = mysqli_fetch_array($query)) {									$corres_numcorres=$num_corres;									
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
            $corres_asuntoDocp=$row['asunto_particular'];
            $corres_indica=$row['indicaciones_destinatario'];
            $corres_anexoDest=$row['anexo_destinatario'];
            $corres_idDireccion=$row['id_direcciones'];
            $corres_nomDireccion=$row['nombre_direccion'];
            $corres_f_turnado=$row['f_turnado'];
            $corres_instruccDir=$row['instrucciones_direcciones'];
            $corres_f_recepArea=$row['f_recepArea'];
            $corres_obs=$row['leyenda_destinatario'];							
            $corres_obsp=$row['obs_part'];							
            $corres_status=$row['id_estatus1'];							
            $corres_fechCap=$row['fecha_cap_c'];
            $num_corres++;	 						
       
        $plantilla .='<tr class="<?php echo $text_class;?>">                        
                        <td style="width:4%">'.$corres_numcorres.'</td>
                        <td style="width:4%">'.$corres_folio.'<br>'.$corres_f_recep.'</td>
                        <td style="width:4%">'.$corres_noOfi.'<br>'.$corres_fOfi.'</td>
                        <td style="width:10%">'.strtoupper($corres_nomDep).'<br>'.$corres_nomRemte.'<br>'.$corres_cargoRemte.'</td>
                        <td style="width:10%">'.$corres_nomDestino.'<br>'.$corres_cargoDest.'</td>
                        <td style="width:20%">'.$corres_asuntoDoc.'</td>
                        <td style="width:20%">'.$corres_asuntoDocp.'</td>
                        <td style="width:10%">'.$corres_obsp.'</td>
                        <td style="width:8%">'.$corres_nomDireccion.'<br>'.$corres_f_turnado.'<br>'.$corres_anexoDest.'</td>
                        <td style="width:10%">'.$corres_instruccDir.'</td> 
                        
                     </tr>';
}

$plantilla .='</table>


</tbody>';


$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output();



?>