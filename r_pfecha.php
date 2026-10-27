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

//if($query2 == 10001){
//    $query2 = ("5 AND dc.id_sub_oic = 56 ");
//}
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
    
    $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_direcciones= ".$query2."";		  
              
}
}else{

    if ($query2=='0'){
    
        $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_remitente =  ".$query3." ";	  
                  
    }else{
        
        $sWhere.= "dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query1."' AND dc.id_direcciones= ".$query2." AND dc.id_remitente =  ".$query3." ";		  
      

}

}












$sWhere.= " order by dc.folio";


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
                <th>Folio<br>FechaRecep</th>                
                <th># Oficio<br>FechaOficio</th>                						
                <th>Remitente<br>Cargo</th>
                <th>Destinatario<br>Cargo</th>
                <th>Asunto</th>
                <th>Turnado_A<br>fechaCaptura<br>Anexos</th>
                <th>Instrucciones</th> 
                <th colspan="10">Firma</th>               						                
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
            $corres_idSubOic=$row['id_sub_oic'];
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
            
            if( $corres_id_sub_oic > 0 ){
                                
								//echo "Entro";

								$consulta_sub = mysqli_query($conexion, "SELECT nombre FROM subdirecciones_oic WHERE id = '$corres_id_sub_oic'");
								$row_Sub_dir = mysqli_fetch_assoc($consulta_sub);
                                $nom_sub_dir = $row_Sub_dir['nombre'];
								$nombre_sub_dir ='<p class="form-text text-muted text-info" style="margin: 0px !important;">'. $row_Sub_dir['nombre'].'</p>';
								$boton_turnar = "Editar";
								$boton_turnar_class = "badge badge-warning";
								
								if ($corres_id_depto > 0) {//Turnado a departamento
									//echo "ENTRO";
								$consulta_depto = mysqli_query($conexion, "SELECT nombre_depto FROM departamentos WHERE id = '$corres_id_depto'");
								$row_depto = mysqli_fetch_assoc($consulta_depto);
                                $nom_depto = $row_depto['nombre_depto'];
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
             
       
        $plantilla .='<tr class="<?php echo $text_class;?>">                        
                        <td>'.$corres_folio.'<br>'.$corres_f_recep.'</td>
                        <td>'.$corres_noOfi.'<br>'.$corres_fOfi.'</td>
                        <td>'.strtoupper($corres_nomDep).'<br>'.$corres_nomRemte.'<br>'.$corres_cargoRemte.'</td>
                        <td>'.$corres_nomDestino.'<br>'.$corres_cargoDest.'</td>
                        <td>'.$corres_asuntoDoc.'</td>
                        <td>'.$corres_nomDireccion.'<br>'.$corres_f_turnado.'<br>'.$corres_anexoDest.'</td>
                        <td>'.$corres_instruccDir.'</td> 
                        <td>'.'                         '.'</td>
                        <td>'.'                         '.'</td>
                        <td>'.'                         '.'</td>
                        <td>'.'                         '.'</td>
                        <td>'.'                         '.'</td>
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