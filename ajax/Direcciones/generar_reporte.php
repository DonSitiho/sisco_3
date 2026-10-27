<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<?php

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual = date("Y-m-d");
$fecha_hora = date("Y-m-d H:i:s");

require_once '../../vendor/autoload.php';

session_start();
$id_direccion = $_SESSION['id_direccion'];
$id_usuario = $_SESSION['id_usuario'];
$nivel_acceso = $_SESSION['nivel_acceso'];
$nom_direccion = $_SESSION['nombre_direccion'];
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

require_once("../../php/conexion.php");

$css = file_get_contents('../../css/stylo_reporte.css');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

$mpdf->setFooter('Página ' . '{PAGENO}' . ' de ' . '{nbpg}');




$query = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['var'], ENT_QUOTES)));
$query2 = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['var2'], ENT_QUOTES)));
$query4 = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['var4'], ENT_QUOTES)));
$query6 = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['var6'], ENT_QUOTES)));
$direccion = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['direccion'], ENT_QUOTES)));

$query3 = 0;
$var = $query;
$var2 = $query2;
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
// $sWhere.=" order by dc.folio";
$q = (string)$query;
$q1 = (string)$query2;



$sWhere .= "order by dc.folio";

$query = mysqli_query($conexion, "SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones 
																	WHERE  $sWhere ");



//$query=$conexion->query("SELECT * FROM datos_correspondencia");

$plantilla = '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <header class="container">    
            <div>
                
                <div class="center">
                    <h2 class="name">' . $nom_direccion . '</b><br>REPORTE DE CORRESPONDENCIA POR RANGO DE FECHAS</h2>                             
                    <div class="date">Reporte del: ' . $q . ' al ' . $q1 . '</div>                
                </div>           
            </div>             
    </header>
    

    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>                				
                <th>Folio<hr>FechaRecep</th>                
                <th># Oficio<hr>FechaOficio</th>                						
                <th>Remitente<hr>Cargo</th>
                <th>Destinatario<hr>Cargo</th>
                <th>Asunto</th>
                <th>fechaCaptura<hr>Anexos</th> 
                <th colspan="6">Firma</th>               						                
            </tr>
        </thead>
        <tbody>';
$c = 0;
while ($row = mysqli_fetch_array($query)) {
    $c++;
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
    switch ($corres_status) {
        case 2:
            $badge = 'En Bandeja';
            break;
        case 3:
            $badge = 'En Seguimiento';
            break;
        case 6:
            $badge = 'Finalizado';
            break;
    }

    $plantilla .= '<tr class="<?php echo $text_class;?>">                        
                        <td>' . $corres_folio . '<br>' . $corres_f_recep . '<br>' . $corres_nomDireccion . '</td>
                        <td>' . $corres_noOfi . '<br>' . $corres_fOfi . '<br>' . $badge . '</td>
                        <td>' . $corres_nomDep . '<br>' . $corres_cargoRemte . '</td>
                        <td>' . $corres_nomDestino . '<br>' . $corres_cargoDest . '</td>
                        <td>' . $corres_asuntoDoc . '</td>
                        <td>' . $corres_f_turnado . '<br>' . $corres_anexoDest . '</td>
                        <td  colspan="6">' . '                         ' . '</td>
                       
                     </tr>';
}

$plantilla .= '</table>


</tbody>';


$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output();



?>