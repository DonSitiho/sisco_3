<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<?php

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=date("Y-m-d");
    $fecha_hora=date("Y-m-d H:i:s");

require_once __DIR__ . '/vendor/autoload.php';

require_once ("conexion/conexion.php");
//require_once ("ajax/conexion.php");
//require_once ("conexion/conexion.php");

$css = file_get_contents('css/stylerep.css');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'letter-L']);

$mpdf->setFooter('Página '.'{PAGENO}'.' de '.'{nbpg}');


//include ("ajax/conexion.php");
include_once ('conexion/conexion.php');

session_start();
	$id_direccion=$_SESSION['id_direccion'];
	$id_usuario=$_SESSION['id_usuario'];
	$nivel_acceso=$_SESSION['nivel_acceso'];
    $nom_direccion=$_SESSION['nombre_direccion'];
	$subdireccion = $_SESSION['subdireccion'];
	$depto = $_SESSION['depto'];
	if($id_direccion==2 && $nivel_acceso==1){
		$decision=' ';
	}else{ 
		if($subdireccion == 0 or $subdireccion == NULL ){
			$decision=' dc.id_direcciones='.$id_direccion.' AND';
		}elseif($depto == 0 or $subdireccion == NULL ){
			$decision=' dc.id_direcciones = '.$id_direccion.' AND FIND_IN_SET('.$subdireccion.', id_sub_oic) AND';
		}else{
			$decision=' dc.id_direcciones = '.$id_direccion.' AND FIND_IN_SET('.$depto.', id_departamento) AND';
		}
		
	}


$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
$query2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query2'], ENT_QUOTES)));
$query4 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query4'], ENT_QUOTES)));
//$query5 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query5'], ENT_QUOTES)));
$query6 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query6'], ENT_QUOTES)));
$direccion = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['direccion'], ENT_QUOTES)));
// echo $query3 ;
// exit();
switch ($query6) {
    case 0:
        $status = "";
        break;
    case 2:
        $status = "Pendiente";
        break;
    case 3:
        $status = "En seguimiento";
        break;
    case 6:
        $status = "Finalizada";
        break;
}

$query3 = 0;
$var=$query;
$var2=$query2;
$direccion2=$direccion;

if(empty($query2)){
    $query2=$query;
}

$sWhere = "";

$tables="datos_correspondencia as dc";
$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";				

if($direccion == 0) {

    $tables="datos_correspondencia as dc";
    $campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
    if ($query3==0){
        if($query6 == 0){
             
            if($query4 == 0){

                $sWhere=$decision." dc.id_estatus1!=1 AND dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' ";		

            }else{

                $sWhere=$decision." dc.id_estatus1!=1 AND dc.id_remitente ='".$query4."' AND dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' ";		

            }

        }else{
            
            if($query4 == 0){
                $sWhere=$decision." dc.id_estatus1 = '".$query6."' AND dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' ";		  
            }else{
                $sWhere=$decision." dc.id_estatus1 = '".$query6."' AND dc.id_remitente ='".$query4."' AND dc.f_recepcion >='".$query."' AND dc.f_recepcion <= '".$query2."' ";		  
            }	  
        }
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
                    <h2 class="name"><b>REPORTE DE CORRESPONDENCIA</b><br>'.$nom_direccion.'<br>POR RANGO DE FECHAS Y ESTATUS  '.strtoupper($status).' </h2>                             
                    <div class="date">Reporte del: '.$var.' al '.$var2.'</div>                
                </div>           
            </div>             
    </header>
    

    <table table-sm>
        <thead>
            <tr>                				
                <th style="width:5%">No.<br>Estatus</th>                
                <th style="width:10%">Folio<br>FechaRecep</th>                
                <th style="width:10%"># Oficio<br>FechaOficio</th>                						
                <th style="width:10%">Remitente<br>Cargo</th>
                <th style="width:15%">Destinatario<br>Cargo</th>
                <th style="width:30%">Asunto</th>
                <th style="width:10%">Notas</th>               						                
                <th style="width:10%">Turnado_A<br>fechaCaptura<br>Anexos</th>
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
            switch ($corres_status) {
                case 0:
                    $status_corres = "";
                    break;
                case 2:
                    $status_corres = "Pendiente";
                    break;
                case 3:
                    $status_corres = "Seguimiento";
                    break;
                case 6:
                    $status_corres = "Finalizada";
                    break;
            }

            $corres_fechCap=$row['fecha_cap_c'];
            $num_corres++;	 						
       
        $plantilla .='<tr class="<?php echo $text_class;?>">                        
                        <td style="width:5%">'.$corres_numcorres.'<br>'.$status_corres.'</td>
                        <td style="width:10%">'.$corres_folio.'<br>'.$corres_f_recep.'</td>
                        <td style="width:10%">'.$corres_noOfi.'<br>'.$corres_fOfi.'</td>
                        <td style="width:15%">'.strtoupper($corres_nomDep).'<br>'.$corres_nomRemte.'<br>'.$corres_cargoRemte.'</td>
                        <td style="width:10%">'.$corres_nomDestino.'<br>'.$corres_cargoDest.'</td>
                        <td style="width:30%">'.$corres_asuntoDoc.'</td>
                        <td style="width:10%">'.$corres_obsp.'</td>
                        <td style="width:10%">'.$corres_nomDireccion.'<br>'.$corres_f_turnado.'<br>'.$corres_anexoDest.'</td>
                        
                     </tr>';
}

$plantilla .='</table>


</tbody>';


$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output();



?>