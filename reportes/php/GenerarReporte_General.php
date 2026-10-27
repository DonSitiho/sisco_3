<?php
include('../plantillas/plantilla_reporte_Gen.php');



if(isset($_POST['FechaInicial']) and isset($_POST['FechaFinal'])){
	
	
$fechaInicial=$_POST['FechaInicial'];
	
$FechaFinal=$_POST['FechaFinal'];
	
	$fechaInicial1=date("Y-m-d",strtotime($_POST['FechaInicial']."- 1 day")); 
	
	$FechaFinal1=date("Y-m-d",strtotime($_POST['FechaFinal']."+ 1 day")); 
	
$tipo_formato=$_POST['tipo_formato'];
	
	
	if($tipo_formato=='0'){


// Sacamos  Nuestra fecha
$DiaN = date("d", strtotime($fechaInicial));
$DiaS = date("l", strtotime($fechaInicial));
$Mes = date("n", strtotime($fechaInicial));
$Anio = date("Y", strtotime($fechaInicial));
$Nuevodia="";
$NuevoMes="";



switch ($DiaS) {
    case 'Monday':
        $Nuevodia='LUNES';
			break;
    case 'Tuesday':
         $Nuevodia='MARTES';
			break;
    case 'Wednesday':
        $Nuevodia='MIERCOLES';
			break;
	case 'Thursday':
         $Nuevodia='JUEVES';
			break;
	case 'Friday':
         $Nuevodia='VIERNES';
			break;
	case 'Saturday':
         $Nuevodia='SABADO';
			break;
	case 'Sunday':
        $Nuevodia='DOMINGO';
			break;}
switch ($Mes) {
    case 1:
        $NuevoMes='ENERO';
			break;
    case 2:
         $NuevoMes='FEBRERO';
			break;
    case 3:
        $NuevoMes='MARZO';
			break;
	case 4:
         $NuevoMes='ABRIL';
			break;
	case 5:
         $NuevoMes='MAYO';
			break;
	case 6:
         $NuevoMes='JUNIO';
			break;
	case 7:
        $NuevoMes='JULIO';
			break;
	case 8:
        $NuevoMes='AGOSTO';
			break;
	case 9:
        $NuevoMes='SEPTIEMBRE';
			break;
	case 10:
        $NuevoMes='OCTUBRE';
			break;
	case 11:
        $NuevoMes='NOVIEMBRE';
			break;
			case 11:
        $NuevoMes='DICIEMBRE';
			break;
	 }
	
$DiaN1 = date("d", strtotime($FechaFinal));
$DiaS1 = date("l", strtotime($FechaFinal));
$Mes1 = date("n", strtotime($FechaFinal));
$Anio1 = date("Y", strtotime($FechaFinal));
$Nuevodia1="";
$NuevoMes1="";



switch ($DiaS1) {
    case 'Monday':
        $Nuevodia1='LUNES';
			break;
    case 'Tuesday':
         $Nuevodia1='MARTES';
			break;
    case 'Wednesday':
        $Nuevodia1='MIERCOLES';
			break;
	case 'Thursday':
         $Nuevodia1='JUEVES';
			break;
	case 'Friday':
         $Nuevodia1='VIERNES';
			break;
	case 'Saturday':
         $Nuevodia1='SABADO';
			break;
	case 'Sunday':
        $Nuevodia1='DOMINGO';
			break;}
switch ($Mes1) {
    case 1:
        $NuevoMes1='ENERO';
			break;
    case 2:
         $NuevoMes1='FEBRERO';
			break;
    case 3:
        $NuevoMes1='MARZO';
			break;
	case 4:
         $NuevoMes1='ABRIL';
			break;
	case 5:
         $NuevoMes1='MAYO';
			break;
	case 6:
         $NuevoMes1='JUNIO';
			break;
	case 7:
        $NuevoMes1='JULIO';
			break;
	case 8:
        $NuevoMes1='AGOSTO';
			break;
	case 9:
        $NuevoMes1='SEPTIEMBRE';
			break;
	case 10:
        $NuevoMes='OCTUBRE';
			break;
	case 11:
        $NuevoMes1='NOVIEMBRE';
			break;
			case 11:
        $NuevoMes1='DICIEMBRE';
			break;
	 }



// Iniciamos nuestro PDF
$pdf= new PDF('L','mm','A4'); // Funcion
$pdf-> PageNo();


$DiaSemana=$Nuevodia;
$Dia=$DiaN;
$Mes=$NuevoMes;
$Anio=$Anio;
$DiaSemana1=$Nuevodia1;
$Dia1=$DiaN1;
$Mes1=$NuevoMes1;
$Anio1=$Anio1;
$pdf -> AddPage(); 
	
	//iniciamos datos del pdf
	
$conexion = new mysqli("201.116.244.212", "root", "Y6?GzUj1/9", "declaranetplus2");

$consulta=mysqli_query($conexion,"SELECT bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION, encargo.FECHA, usr_decnet.NUM_CELULAR FROM bitacora_firmado, encargo, cat_puesto, usr_decnet WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '2018-01-01' AND bitacora_firmado.F_ENVIO <= '2019-01-01' and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C' AND bitacora_firmado.ID_USR_DECNET = usr_decnet.ID_USR_DECNET" );

$row=mysqli_fetch_assoc($consulta);
	
	// ENCABEZADO DE TABLAS

	

	
$pdf-> SetFillColor(212, 211, 199 );// COLOR DE CELDA
$pdf -> SetFont('Arial','B',9);//Encabezado de tabla
$pdf -> Cell(64,4,'NOMBRE',0,0,'C',1);
$pdf -> Cell(24,4,'RFC',0,0,'C',1);
$pdf -> Cell(20,4,'FECHA',0,0,'C',1);
$pdf -> Cell(40,4,'DEPENDENCIA',0,0,'C',1);
$pdf -> Cell(43,4,'AREA SUSCRIP',0,0,'C',1);
$pdf -> Cell(32,4,'PUESTO',0,0,'C',1);
$pdf -> Cell(12,4,'T. DECLAR',0,0,'C',1);
$pdf -> Cell(12,4,utf8_decode('AÑO'),0,0,'C',1);
$pdf -> Cell(19,4,'F.INICIO',0,0,'C',1);
$pdf -> Cell(13,4,'CEL',0,0,'C',1);
		

$pdf->Ln(0.5);// espacio entre columnas	
$pdf -> SetFont('Arial','B',9.5);
$pdf -> Cell(20,4,'',0,1,'L');// subt. fecha
$pdf -> SetFont('Arial','',8);	
$pdf->Ln(0.5);

	
// FIN DE ENCABEZADO DE TABLAS
/*print_r($row);*/
$contador=0;
while($obtenerInf=mysqli_fetch_assoc($consulta)){
	$TipoDeclaracion=$obtenerInf['TIPO_DECLARACION'];
	
	//meter case dependiendo el check box que elija el usuario
	$dependencia = substr($obtenerInf['DEPENDENCIA'],0, 30);
	
	
	
	$Area = substr($obtenerInf['AREA_ADSCRIPCION'],  0, 25);
	
	$FechaInscripcion=date("d-m-Y", strtotime($obtenerInf['F_ENVIO']));
	
	$FECHA_INICIO=date("d-m-y", strtotime($obtenerInf['FECHA']));
	switch($TipoDeclaracion){
		case '0':
			$TipoDeclara='I';
			break;
		case '1':
			$TipoDeclara='C';
			break;
		case '2':
			$TipoDeclara='M';
			break;
				
	}

 $pdf -> SetFont('Arial','',6.5);
$pdf -> Cell(64,4,$obtenerInf['NOMBRE'],0,0,'L');
$pdf -> Cell(24,4,$obtenerInf['RFC'],0,0,'c');
$pdf -> Cell(20,4,$FechaInscripcion,0,0,'C');

$pdf -> Cell(40,4,$dependencia,0,0,'L');
$pdf -> Cell(43,4,$Area,0,0,'L');

$pdf -> Cell(32,4,$obtenerInf['puesto'],0,0,'L');
$pdf -> Cell(12,4,$TipoDeclara,0,0,'C');
$pdf -> Cell(12,4,$obtenerInf['ANIO'],0,0,'C');
$pdf -> Cell(19,4,$FECHA_INICIO,0,0,'C');
$pdf -> Cell(13,4,$obtenerInf['NUM_CELULAR'],0,1,'C');
/*$pdf -> Cell(10,4,$obtenerInf['TIPO_DECLARACION'],0,1,'C');*/
		$contador++;	
		
		/*echo ($obtenerInf['NOMBRE']);*/
	}
		$pdf -> Cell(279,0.5,'',1,1,'C',1);// LINEA DIVISORA
$pdf -> Cell(248,4,'',0,0,'L');
		$pdf -> Cell(250,4,'Total de Registros: '.$contador,0,1,'L');

$pdf -> output(); // Visualizar pdf
		
		}else{
		
		include('../Excel/Classes/PHPExcel.php');
/*

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


$index=0;


$excel->createSheet();
$excel->setActiveSheetIndex($index);

$pagina= $excel->getActiveSheet()->setTitle('Dependencia');

$pagina=$excel->getActiveSheet();
	$index++;
/*	$FechaEncabezadoInicio=date("d-M-Y",strtotime($FechaHoy));
	$FechaEncabezadoFinal=date("d-M-Y",strtotime($FechaMasSiete));*/
// relleno de la tabla *************************************************************************************************************
$pagina->setCellValue('A1', 'SECRETARIA DE CONTRALORIA');
$pagina->setCellValue('A2', 'REPORTE DE DECLARACION GENERAL');
// combinamos celdas
$pagina->mergeCells('A1:E1'); // COMBINAR CELDAS
$pagina->mergeCells('A2:L2');

// agroecuaria tarasca
$pagina->getStyle('A1:E1')->getFont()->setBold(true);// cambiar estilo "Negrita" dentro del rango establecido
$pagina->getStyle('A1:E1')->getFont()->setSize(13);// cambiar el tañaño de letra
// texto de concentrado stilo
$pagina->getStyle('A2:E2')->getFont()->setBold(true);// cambiar estilo "Negrita" dentro del rango establecido
$pagina->getStyle('A2:E2')->getFont()->setSize(13);// cambiar el tañaño de letra




//******  ENCABEZADO DE LA TABLA ENVIO******************
$pagina->setCellValue('A3', 'NOMBRE');
$pagina->setCellValue('B3', 'RFC');
$pagina->setCellValue('C3', 'FECHA ');
$pagina->setCellValue('D3', 'DEPENDENCIA');
$pagina->setCellValue('E3',' AREA SUSCRIP');
$pagina->setCellValue('F3',' PUESTO');
$pagina->setCellValue('G3',' TIPO DECLARACION');
$pagina->setCellValue('H3',' AÑO');
		$pagina->setCellValue('I3',' FECHA ENVIO');
		$pagina->setCellValue('J3',' CELULAR');
//******  ENCABEZADO DE LA TABLA RECEPCION******************

//******  ENCABEZADO DE LA TABLA GASTO ALIMENTO + VARIOS / KILOGRAMO DE VENTAS ***************************************


$pagina->getStyle('A3:J3')->getFont()->setBold(true);// cambiar estilo "Negrita" dentro del rango establecido
$pagina->getStyle('A4:J4')->getFont()->setSize(12);// cambiar el tañaño de letra

// CENTRAR EL TEXTO DE TODAS LAS CELDAS *****************+
  $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        )
    );

    $excel->getDefaultStyle()->applyFromArray($style);
// ****************************************************+
$fila = 5;

$conexion = new mysqli("201.116.244.212", "root", "Y6?GzUj1/9", "declaranetplus2");

$consulta=mysqli_query($conexion,"SELECT bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, 
bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION, encargo.FECHA, usr_decnet.NUM_CELULAR

FROM bitacora_firmado, encargo, cat_puesto, usr_decnet 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '$fechaInicial' AND bitacora_firmado.F_ENVIO <= '$FechaFinal1'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C'
AND bitacora_firmado.ID_USR_DECNET = usr_decnet.ID_USR_DECNET
");

$row=mysqli_fetch_assoc($consulta);
$contador1=0;

while($obtenerInf=mysqli_fetch_assoc($consulta)){
	
	$TipoDeclaracion_Excel=$obtenerInf['TIPO_DECLARACION'];
	
	switch($TipoDeclaracion_Excel){
		case '0':
			$TipoDeclara='I';
			break;
		case '1':
			$TipoDeclara='C';
			break;
		case '2':
			$TipoDeclara='M';
			break;
				
	}
	
	
	
	
				
				$pagina->setCellValue('A'.$fila, utf8_encode($obtenerInf['NOMBRE']));// lotes
	            $pagina->setCellValue('B'.$fila, utf8_encode($obtenerInf['RFC'])); //Nombre granja
	            $pagina->setCellValue('C'.$fila, $obtenerInf['FECHA']); // caseta
	            $pagina->setCellValue('D'.$fila, utf8_encode($obtenerInf['DEPENDENCIA'])); // Pollos
	            $pagina->setCellValue('E'.$fila, utf8_encode($obtenerInf['AREA_ADSCRIPCION'])); // Pollos
	            $pagina->setCellValue('F'.$fila, utf8_encode($obtenerInf['puesto'])); // Kilogramos
	 $pagina->setCellValue('G'.$fila, $TipoDeclara); // Kilogramos
	 $pagina->setCellValue('H'.$fila, utf8_encode($obtenerInf['ANIO'])); // Kilogramos
	 $pagina->setCellValue('I'.$fila, utf8_encode($obtenerInf['F_ENVIO'])); // Kilogramos
	$pagina->setCellValue('J'.$fila, $obtenerInf['NUM_CELULAR']); // Kilogramos
				
				$fila++;
			
			$contador1++;
		
			
	
	
	
	

		
		/*echo ($obtenerInf['NOMBRE']);*/
	}


foreach( range('A3', 'J3') as $column){// recorrer las filas y columna para establecer el tamaño de la celda
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
header('Content-Disposition: attachment;filename="Declaraciones.xlsx"'); // extension
header('Cache-Control: max-age=0');// controlar el cache

$objWriter = new PHPExcel_Writer_Excel2007($excel);
$objWriter->save('php://output');
		
	}
		
}else{
	header('../vistas/Reportes.php');
}

?>