<?php
/*include('conexion.php');*/
include('../Excel/Classes/PHPExcel.php');
/*
$FechaHoy=$_POST['FechaInicial'];
$FechaMasSiete=$_POST['FechaFinal'];

$AbastosT=$_POST['s_abastosT'];
$AbastosC=$_POST['s_abastosC'];

$PatzT=$_POST['s_PtzT'];
$PatzC=$_POST['s_PtzC'];

$UruapanT=$_POST['s_UruapanT'];
$UruapanC=$_POST['s_UruapanC'];

$UriangatoT=$_POST['s_UriangatoT'];
$UriangatoC=$_POST['s_UriangatoC'];

$CalzadaT=$_POST['s_CalzadaT'];
$CalzadaC=$_POST['s_CalzadaC'];

$QuemadaT=$_POST['s_quemadaT'];
$QuemadaC=$_POST['s_quemadaC'];

$NuevaItaliaT=$_POST['s_NuevaItaliaT'];
$NuevaItaliaC=$_POST['s_NuevaItaliaC'];

$ZitacuaroT=$_POST['s_ZitacuaroT'];
$ZitacuaroC=$_POST['s_ZitacuaroC'];

$GastosTotales=array(2 => $AbastosT, 3 => $PatzT, 4 => $UruapanT,5 => $UruapanT,6 => $UriangatoT,7 => $CalzadaT,8 => $QuemadaT,9 => $NuevaItaliaT,10 => $ZitacuaroT);

$CostoAlimento=array(2 => $AbastosC, 3 => $PatzC, 4 => $UruapanC,5 => $UruapanC,6 => $UriangatoC,7 => $CalzadaC,8 => $QuemadaC,9 => $NuevaItaliaC,10 => $ZitacuaroC);
*/

$excel= new PHPExcel();//objeto de la libreria


$excel->getProperties()// propiedades para el documento
        ->setCreator("Manuel Santana")
        ->setLastModifiedBy("")
        ->setTitle("Reporte de ventas")
        ->setSubject("Documento de prueba")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("Manuel Santana 4433629310")
        ->setCategory("Reporte");

/*$Sucursales=oci_parse($conexion, "Select CODSUCURSAL, NOMBRE from SUCURSAL");
$EjecutarSent = oci_execute($Sucursales);
$CodSuc=array();
$NomSuc=array();
$C=1;
while($rowSuc=oci_fetch_assoc($Sucursales)){
	$CodSuc[$C]=$rowSuc['CODSUCURSAL'];
	$NomSuc[$C]=$rowSuc['NOMBRE'];
	$C++;
}*/
$index=0;


$excel->createSheet();
$excel->setActiveSheetIndex($index);

$pagina= $excel->getActiveSheet()->setTitle('hola');

$pagina=$excel->getActiveSheet();
	$index++;
/*	$FechaEncabezadoInicio=date("d-M-Y",strtotime($FechaHoy));
	$FechaEncabezadoFinal=date("d-M-Y",strtotime($FechaMasSiete));*/
// relleno de la tabla *************************************************************************************************************
$pagina->setCellValue('A1', 'SECRETARIA DE CONTRALORIA');
$pagina->setCellValue('A2', 'REPORTE DE DECLARACION DE CONCLUSIÓN');
// combinamos celdas
$pagina->mergeCells('A1:E1'); // COMBINAR CELDAS
$pagina->mergeCells('A2:L2');

// agroecuaria tarasca
$pagina->getStyle('A1:E1')->getFont()->setBold(true);// cambiar estilo "Negrita" dentro del rango establecido
$pagina->getStyle('A1:E1')->getFont()->setSize(13);// cambiar el tañaño de letra
// texto de concentrado stilo
$pagina->getStyle('A2:E2')->getFont()->setBold(true);// cambiar estilo "Negrita" dentro del rango establecido
$pagina->getStyle('A2:E2')->getFont()->setSize(13);// cambiar el tañaño de letra


// ***** ENCABEZADOS DE LAS TABLAS ***********+
/*$pagina->setCellValue('B3', 'ENVIO');
$pagina->mergeCells('B3:E3');
$pagina->setCellValue('F3', 'RECEPCION');
$pagina->mergeCells('F3:I3');
$pagina->setCellValue('J3', 'VENTA');
$pagina->mergeCells('J3:P3');
$pagina->setCellValue('Q3', 'MORTALIDAD');
$pagina->mergeCells('Q3:S3');
$pagina->setCellValue('T3', 'RENDIMIENTO');
$pagina->mergeCells('T3:U3');
$pagina->setCellValue('V3', 'GASTO ALIMENTO');
$pagina->mergeCells('V3:W3');
$pagina->setCellValue('X3', 'GASTOS VARIOS');
$pagina->mergeCells('X3:Y3');

$pagina->setCellValue('Z3', 'GASTO ALIMENTO + VARIOS/KILOGRAMO');*/


//******  ENCABEZADO DE LA TABLA ENVIO******************
$pagina->setCellValue('A3', 'NOMBRE');
$pagina->setCellValue('B3', 'RFC');
$pagina->setCellValue('C3', 'FECHA ENVIO');
$pagina->setCellValue('D3', 'DEPENDENCIA');
$pagina->setCellValue('E3',' AREA SUSCRIPCION');
//******  ENCABEZADO DE LA TABLA RECEPCION******************

//******  ENCABEZADO DE LA TABLA GASTO ALIMENTO + VARIOS / KILOGRAMO DE VENTAS ***************************************


$pagina->getStyle('A3:Z3')->getFont()->setBold(true);// cambiar estilo "Negrita" dentro del rango establecido
$pagina->getStyle('A4:Z4')->getFont()->setSize(12);// cambiar el tañaño de letra

// CENTRAR EL TEXTO DE TODAS LAS CELDAS *****************+
  $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $excel->getDefaultStyle()->applyFromArray($style);
// ****************************************************+
$fila = 5;

$conexion = new mysqli("201.116.244.212", "root", "Y6?GzUj1/9", "declaranetplus2");

$consulta=mysqli_query($conexion,"SELECT bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, 
bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION 

FROM bitacora_firmado, encargo, cat_puesto 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '2019-04-07' AND bitacora_firmado.F_ENVIO <= '2019-05-02'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO");

$row=mysqli_fetch_assoc($consulta);


while($obtenerInf=mysqli_fetch_assoc($consulta)){
	
	
	
	$pagina->setCellValue('A'.$fila, utf8_encode($obtenerInf['NOMBRE']));// lotes
	$pagina->setCellValue('B'.$fila, utf8_encode($obtenerInf['RFC'])); //Nombre granja
	$pagina->setCellValue('C'.$fila, $obtenerInf['F_ENVIO']); // caseta
	$pagina->setCellValue('D'.$fila, utf8_encode($obtenerInf['DEPENDENCIA'])); // Pollos
	$pagina->setCellValue('E'.$fila, utf8_encode($obtenerInf['AREA_ADSCRIPCION'])); // Kilogramos
$fila++;
		
		/*echo ($obtenerInf['NOMBRE']);*/
	}


foreach( range('A3', 'E3') as $column){// recorrer las filas y columna para establecer el tamaño de la celda
	$pagina->getColumnDimension($column)->setAutoSize(true);
}
$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
$excel->getActiveSheet()->getStyle('B3:Z3')->applyFromArray($borders); // AGREGAR MARCO	

/*$excel->setActiveSheetIndex(0);*/
// final************* GENERAR ARCHIVO DE EXCEL********************************
header("ContentType:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");// formato xlsx
header('Content-Disposition: attachment;filename="ReporteVentas.xlsx"'); // extension
header('Cache-Control: max-age=0');// controlar el cache

$objWriter = new PHPExcel_Writer_Excel2007($excel);
$objWriter->save('php://output');


?>