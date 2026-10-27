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

	
	//iniciamos datos del pdf
	
     $conexion = new mysqli("201.116.244.212", "root", "Y6?GzUj1/9", "declaranetplus2");

	 $consulta_Usuarios=mysqli_query($conexion, "SELECT DISTINCT ID_USR_DECNET, RFC 
				FROM bitacora_firmado
                WHERE `SITUACION`='C' ORDER BY `ID_USR_DECNET` LIMIT 200");
	 
 
		$contador=0;
	
while($obtenerInf=mysqli_fetch_assoc($consulta_Usuarios)){
	
	$id_usuario=$obtenerInf['ID_USR_DECNET'];
	
	$consulta_Declaraciones=mysqli_query($conexion, "SELECT bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, 
bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION, encargo.FECHA, usr_decnet.NUM_CELULAR

FROM bitacora_firmado, encargo, cat_puesto, usr_decnet 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION 
AND encargo.ID_PUESTO = cat_puesto.ID_PUESTO 
AND bitacora_firmado.SITUACION='C'
AND bitacora_firmado.ID_USR_DECNET = usr_decnet.ID_USR_DECNET
AND bitacora_firmado.NO_DECLARACION = (SELECT MAX(bitacora_firmado.NO_DECLARACION) FROM bitacora_firmado WHERE bitacora_firmado.ID_USR_DECNET ='$id_usuario')");
	
	while($row_declaracion=mysqli_fetch_assoc($consulta_Declaraciones)){
		$TipoDeclaracion=$row_declaracion['TIPO_DECLARACION'];
		$dependencia = substr($row_declaracion['DEPENDENCIA'],0, 30);
	    $Area = substr($row_declaracion['AREA_ADSCRIPCION'],  0, 25);
	    $FechaInscripcion=date("d-m-Y", strtotime($row_declaracion['F_ENVIO']));
	    $FECHA_INICIO=date("d-m-y", strtotime($row_declaracion['FECHA']));
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
$pdf -> Cell(64,4,$row_declaracion['NOMBRE'],0,0,'L');
$pdf -> Cell(24,4,$row_declaracion['RFC'],0,0,'c');
$pdf -> Cell(20,4,$FechaInscripcion,0,0,'C');

$pdf -> Cell(40,4,$dependencia,0,0,'L');
$pdf -> Cell(43,4,$Area,0,0,'L');

$pdf -> Cell(32,4,$row_declaracion['puesto'],0,0,'L');
$pdf -> Cell(12,4,$TipoDeclara,0,0,'C');
$pdf -> Cell(12,4,$row_declaracion['ANIO'],0,0,'C');
$pdf -> Cell(19,4,$FECHA_INICIO,0,0,'C');
$pdf -> Cell(13,4,$row_declaracion['NUM_CELULAR'],0,1,'C');
	}

		$contador++;	
		
	
		/*echo ($obtenerInf['NOMBRE']);*/
	}
	
		// fin de pdf
		
	/*}*/	
		

		/* (SELECT DISTINCT NOMBRE FROM bitacora_firmado)  bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, 
bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION, encargo.FECHA, usr_decnet.NUM_CELULAR

FROM bitacora_firmado, encargo, cat_puesto, usr_decnet 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION 
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C'
AND bitacora_firmado.ID_USR_DECNET = usr_decnet.ID_USR_DECNET

ORDER BY bitacora_firmado.NOMBRE */


	
	// ENCABEZADO DE TABLAS


	
// FIN DE ENCABEZADO DE TABLAS
/*print_r($row);*/
	
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
$pagina->setCellValue('I3', 'FECHA PRESENTACION');
$pagina->setCellValue('C3', 'DEPENDENCIA');
$pagina->setCellValue('D3',' AREA SUSCRIP');
$pagina->setCellValue('E3',' PUESTO');
$pagina->setCellValue('F3',' TIPO DECLARACION');
$pagina->setCellValue('G3',' AÑO');
		$pagina->setCellValue('H3',' FECHA DEL PUESTO');
		$pagina->setCellValue('J3',' CELULAR');
		$pagina->setCellValue('K3',' EXTEMPORANEA');

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

	 $consulta_Usuarios=mysqli_query($conexion, "SELECT DISTINCT ID_USR_DECNET, RFC 
				FROM bitacora_firmado
                WHERE `SITUACION`='C' ORDER BY `RFC`") ;
	 
 
		$contador=0;
	$rfc_usr='';
while($obtenerInf=mysqli_fetch_assoc($consulta_Usuarios)){
	
	$id_usuario=$obtenerInf['ID_USR_DECNET'];
	
	$consulta_Declaraciones=mysqli_query($conexion, "SELECT bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.TIPO_DECLARACION, bitacora_firmado.ANIO, bitacora_firmado.F_ENVIO, encargo.FECHA, bitacora_firmado.EXTEMPORANEA, usr_decnet.NUM_CELULAR, usr_decnet.CURP

FROM bitacora_firmado, encargo, cat_puesto, usr_decnet 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION 
AND encargo.ID_PUESTO = cat_puesto.ID_PUESTO 
AND bitacora_firmado.ID_USR_DECNET = usr_decnet.ID_USR_DECNET
AND bitacora_firmado.ID_BITACORA_FIRMADO = (SELECT MAX(bitacora_firmado.ID_BITACORA_FIRMADO) FROM bitacora_firmado WHERE bitacora_firmado.ID_USR_DECNET ='$id_usuario')
");
	
	while($row_declaracion=mysqli_fetch_assoc($consulta_Declaraciones)){
		
		if($rfc_usr==$row_declaracion['RFC']){
			
		}else{
			
		
		$TipoDeclaracion=$row_declaracion['TIPO_DECLARACION'];
		$dependencia = substr($row_declaracion['DEPENDENCIA'],0, 30);
	    $Area = substr($row_declaracion['AREA_ADSCRIPCION'],  0, 25);
	    $FechaInscripcion=date("d-m-Y", strtotime($row_declaracion['F_ENVIO']));
	    $MesyAño=date("m-Y", strtotime($row_declaracion['F_ENVIO']));
	    $FECHA_INICIO=date("d-m-y", strtotime($row_declaracion['FECHA']));

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
			
				$pagina->setCellValue('A'.$fila, utf8_encode($row_declaracion['NOMBRE']));// lotes
	            $pagina->setCellValue('B'.$fila, utf8_encode($row_declaracion['RFC'])); //Nombre granja
	            $pagina->setCellValue('C'.$fila, utf8_encode($row_declaracion['DEPENDENCIA'])); // Pollos
	            $pagina->setCellValue('D'.$fila, utf8_encode($row_declaracion['AREA_ADSCRIPCION'])); // Pollos
	            $pagina->setCellValue('E'.$fila, utf8_encode($row_declaracion['puesto'])); // Kilogramos
	            $pagina->setCellValue('F'.$fila, $TipoDeclara); // Kilogramos
	            $pagina->setCellValue('G'.$fila, utf8_encode($row_declaracion['ANIO'])); // Kilogramos
	            $pagina->setCellValue('H'.$fila, $FechaInscripcion); // caseta
	            $pagina->setCellValue('I'.$fila, $FECHA_INICIO); // Kilogramos
	            $pagina->setCellValue('J'.$fila, $row_declaracion['NUM_CELULAR']); // Kilogramos
	            $pagina->setCellValue('K'.$fila, $row_declaracion['EXTEMPORANEA']); // caseta
	            $pagina->setCellValue('L'.$fila, $row_declaracion['CURP']); // caseta
	            $pagina->setCellValue('M'.$fila, $MesyAño); 
				$fila++;
			
			
		
		}
		$rfc_usr=$row_declaracion['RFC'];
		
	}

	
		
	
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