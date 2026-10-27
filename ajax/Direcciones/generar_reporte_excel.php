<?php

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual = date("Y-m-d");
$fecha_hora = date("Y-m-d H:i:s");

require_once '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


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

$q = (string)$query;
$q1 = (string)$query2;

$sWhere .= "order by dc.folio";

$query = mysqli_query($conexion, "SELECT $campos FROM  (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones 
																	WHERE  $sWhere ");

// GENERACIÓN DEL EXCEL
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Reporte Correspondencia');

$sheet->getStyle('A1:H5')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setRGB('FFFFFF');

// Logos (ajusta las rutas a donde tengas guardadas tus imágenes)
$logoIzq = new Drawing();
$logoIzq->setName('Logo Contraloria');
$logoIzq->setPath('../../images/secoem27.png'); // <-- ajusta ruta
$logoIzq->setHeight(60);
$logoIzq->setCoordinates('B2');
$logoIzq->setOffsetX(5);
$logoIzq->setOffsetY(5);
$logoIzq->setWorksheet($sheet);

$logoDer = new Drawing();
$logoDer->setName('Logo SISCO');
$logoDer->setPath('../../images/SISCOlogo.png'); // <-- ajusta ruta
$logoDer->setHeight(60);
$logoDer->setCoordinates('G2'); // ajusta según cuántas columnas tengas
$logoDer->setOffsetX(5);
$logoDer->setOffsetY(5);
$logoDer->setWorksheet($sheet);

// Da espacio suficiente en las primeras filas para que los logos no encimen el texto
$sheet->getRowDimension(1)->setRowHeight(20);
$sheet->getRowDimension(2)->setRowHeight(20);
$sheet->getRowDimension(3)->setRowHeight(20);
$sheet->getRowDimension(4)->setRowHeight(20);

// --- Título centrado (columnas A a K según tu número de columnas) ---
$sheet->mergeCells('C1:F1');
$sheet->setCellValue('C1', 'REPORTE DE CORRESPONDENCIA');
$sheet->getStyle('C1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('C2:F2');
$sheet->setCellValue('C2', strtoupper($nom_direccion));
$sheet->getStyle('C2')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('C3:F3');
$sheet->setCellValue('C3', 'POR RANGO DE FECHAS Y ESTATUS');
$sheet->getStyle('C3')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('C4:F4');
$sheet->setCellValue('C4', 'Reporte del: ' . $q . ' al ' . $q1);
$sheet->getStyle('C4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('C4')->getFont()->setItalic(true);

// Fila de encabezados de la tabla (fila 6)
$filaEncabezado = 6;

$encabezados = [
    'A' => "No.\nEstatus\n",
    'B' => "Folio\nFechaRecep\n",
    'C' => "# Oficio\nFechaOficio\n",
    'D' => "Remitente\nCargo\n",
    'E' => "Destinatario\nCargo\n",
    'F' => "Asunto",
    'G' => "Notas",
    'H' => "Turnado_A\nFechaCaptura\nAnexos",
];

foreach ($encabezados as $col => $texto) {
    $sheet->setCellValue($col . $filaEncabezado, $texto);
}

$rangoEncabezado = 'A' . $filaEncabezado . ':H' . $filaEncabezado;

$sheet->getStyle($rangoEncabezado)->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setRGB('E3E3E3');

$sheet->getStyle($rangoEncabezado)->getFont()->setBold(true);
$sheet->getStyle($rangoEncabezado)->getAlignment()
    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
    ->setVertical(Alignment::VERTICAL_CENTER)
    ->setWrapText(true);
$sheet->getStyle($rangoEncabezado)->getBorders()
    ->getBottom()->setBorderStyle(Border::BORDER_MEDIUM);
$sheet->getStyle($rangoEncabezado)->getBorders()
    ->getTop()->setBorderStyle(Border::BORDER_MEDIUM);

$sheet->getRowDimension($filaEncabezado)->setRowHeight(35);

// Datos
$fila = $filaEncabezado + 1;
$contador = 0;

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $contador++;

    $corres_folio        = $row['folio'];
    $corres_f_recep      = $row['f_recepcion'];
    $corres_nomDep       = $row['nombre'];
    $corres_cargoRemte   = $row['cargo'];
    $corres_noOfi        = $row['num_oficio'];
    $corres_fOfi         = $row['f_oficio'];
    $corres_nomDestino   = $row['dnom'];
    $corres_cargoDest    = $row['cargo_destinatario'];
    $corres_asuntoDoc    = $row['asunto_destinatario'];
    $corres_anexoDest    = $row['anexo_destinatario'];
    $corres_nomDireccion = $row['nombre_direccion'];
    $corres_f_turnado    = $row['f_turnado'];
    $corres_status       = $row['id_estatus1'];
    $corres_obs          = $row['leyenda_destinatario']; // Notas

    switch ($corres_status) {
        case 0: $badge = ''; break;
        case 2: $badge = 'Pendiente'; break;
        case 3: $badge = 'En Seguimiento'; break;
        case 6: $badge = 'Finalizada'; break;
        default: $badge = '';
    }

    $sheet->setCellValue('A' . $fila, $contador . "\n" . $badge);
    $sheet->setCellValue('B' . $fila, $corres_folio . "\n" . $corres_f_recep);
    $sheet->setCellValue('C' . $fila, $corres_noOfi . "\n" . $corres_fOfi);
    $sheet->setCellValue('D' . $fila, $corres_nomDep . "\n" . $corres_cargoRemte);
    $sheet->setCellValue('E' . $fila, $corres_nomDestino . "\n" . $corres_cargoDest);
    $sheet->setCellValue('F' . $fila, $corres_asuntoDoc);
    $sheet->setCellValue('G' . $fila, $corres_obs);
    $sheet->setCellValue('H' . $fila, $corres_nomDireccion . "\n" . $corres_f_turnado . "\n" . $corres_anexoDest);

    // Color de texto según estatus (opcional, como el rojo/verde que se ve en la imagen)
    $colorEstatus = '000000';
    if ($badge === 'Pendiente') {
        $colorEstatus = 'C00000'; // rojo
    } elseif ($badge === 'Finalizada') {
        $colorEstatus = '006100'; // verde
    }
    $sheet->getStyle('A' . $fila)->getFont()->getColor()->setRGB($colorEstatus);

    $sheet->getStyle('A' . $fila . ':H' . $fila)->getAlignment()
        ->setWrapText(true)
        ->setVertical(Alignment::VERTICAL_TOP);

    $sheet->getStyle('A' . $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B' . $fila . ':C' . $fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $fila++;
}

$ultimaFila = $fila - 1;

// --- Bordes en toda la tabla ---
$sheet->getStyle('A' . $filaEncabezado . ':H' . $ultimaFila)
    ->getBorders()->getAllBorders()
    ->setBorderStyle(Border::BORDER_THIN);

// --- Ancho de columnas ---
$anchos = [
    'A' => 10,
    'B' => 16,
    'C' => 16,
    'D' => 25,
    'E' => 25,
    'F' => 55,
    'G' => 20,
    'H' => 22,
];
foreach ($anchos as $col => $ancho) {
    $sheet->getColumnDimension($col)->setWidth($ancho);
}

// --- Congelar encabezado al hacer scroll ---
$sheet->freezePane('A' . ($filaEncabezado + 1));

// --- Orientación horizontal para impresión (como tu PDF en A4-L) ---
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);

// ================= DESCARGA =================

$nombreArchivo = 'reporte_correspondencia_' . date('Ymd') . '.xlsx';

if (ob_get_level()) {
    ob_end_clean();
}
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
header('Cache-Control: max-age=0');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;