<?php
include('../plantillas/plantilla_reporte.php');



if(isset($_POST['FechaInicial']) and isset($_POST['FechaFinal'])){
	
	
$fechaInicial=$_POST['FechaInicial'];
	
$anio=$_POST['anio'];
$FechaFinal=$_POST['FechaFinal'];
	
	$check=$_POST['check'];
$tipo_formato=$_POST['tipo_formato'];
	
$fechaInicial1=date("Y-m-d",strtotime($_POST['FechaInicial']."- 1 day")); 
	
$FechaFinal1=date("Y-m-d",strtotime($_POST['FechaFinal']."+ 1 day")); 	
		
	
	
	switch($check){
			
		case '0':
			$declaracion="INICIAL";
			
			break;
			
		case '1':
			$declaracion="DE CONCLUSIÓN";
			break;
			
		case '2':
			$declaracion="DE MODIFICACIÓN";
			break;
		
	}
	
	
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
$pdf= new PDF(); // Funcion
$pdf-> PageNo();

$declaracion1=$declaracion;
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

$consulta=mysqli_query($conexion,"SELECT bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, 
bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION

FROM bitacora_firmado, encargo, cat_puesto 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '$fechaInicial' AND bitacora_firmado.F_ENVIO <= '$FechaFinal1'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C'
AND bitacora_firmado.ANIO='$anio'");

$row=mysqli_fetch_assoc($consulta);
	
	// ENCABEZADO DE TABLAS
switch($check){
	
	case '0':
	
$pdf-> SetFillColor(212, 211, 199 );// COLOR DE CELDA
$pdf -> SetFont('Arial','B',9);//Encabezado de tabla
$pdf -> Cell(64,4,'NOMBRE',0,0,'C',1);
$pdf -> Cell(24,4,'RFC',0,0,'C',1);
$pdf -> Cell(29,4,'FECHA ENVIO',0,0,'C',1);
/*$pdf -> Cell(15,4,utf8_decode('AÑO'),0,0,'C',1);*/
$pdf -> Cell(38,4,'DEPENDENCIA',0,0,'C',1);
$pdf -> Cell(39,4,'AREA SUSCRIP',0,0,'C',1);

$pdf->Ln(0.5);// espacio entre columnas	
$pdf -> SetFont('Arial','B',9.5);
$pdf -> Cell(20,4,'',0,1,'L');// subt. fecha
$pdf -> SetFont('Arial','',8);	
$pdf->Ln(0.5);
		
		break;
		
	case '1':
		
$pdf-> SetFillColor(212, 211, 199 );// COLOR DE CELDA
$pdf -> SetFont('Arial','B',9);//Encabezado de tabla
$pdf -> Cell(64,4,'NOMBRE',0,0,'C',1);
$pdf -> Cell(24,4,'RFC',0,0,'C',1);
$pdf -> Cell(29,4,'FECHA ENVIO',0,0,'C',1);
/*$pdf -> Cell(15,4,utf8_decode('AÑO'),0,0,'C',1);*/
$pdf -> Cell(38,4,'DEPENDENCIA',0,0,'C',1);
$pdf -> Cell(39,4,'AREA SUSCRIP',0,0,'C',1);

$pdf->Ln(0.5);// espacio entre columnas	
$pdf -> SetFont('Arial','B',9.5);
$pdf -> Cell(20,4,'',0,1,'L');// subt. fecha
$pdf -> SetFont('Arial','',8);	
$pdf->Ln(0.5);
		
		break;
		
	case '2':
$pdf-> SetFillColor(212, 211, 199 );// COLOR DE CELDA
$pdf -> SetFont('Arial','B',9);//Encabezado de tabla
$pdf -> Cell(63,4,'NOMBRE',0,0,'C',1);
$pdf -> Cell(22,4,'RFC',0,0,'C',1);
$pdf -> Cell(27,4,'FECHA ENVIO',0,0,'C',1);
/*$pdf -> Cell(15,4,utf8_decode('AÑO'),0,0,'C',1);*/
$pdf -> Cell(37,4,'DEPENDENCIA',0,0,'C',1);
$pdf -> Cell(38,4,'AREA SUSCRIP',0,0,'C',1);
$pdf -> Cell(7,4,utf8_decode('AÑO'),0,1,'C',1);
$pdf->Ln(0.5);// espacio entre columnas	
$pdf -> SetFont('Arial','B',9.5);
$pdf -> Cell(20,4,'',0,1,'L');// subt. fecha
$pdf -> SetFont('Arial','',8);	
$pdf->Ln(0.5);
		
		break;
		
}
// FIN DE ENCABEZADO DE TABLAS
/*print_r($row);*/
$contador=0;
while($obtenerInf=mysqli_fetch_assoc($consulta)){
	$TipoDeclaracion=$obtenerInf['TIPO_DECLARACION'];
	
	//meter case dependiendo el check box que elija el usuario
	$dependencia = substr($obtenerInf['DEPENDENCIA'], -25);
	
	$Area = substr($obtenerInf['AREA_ADSCRIPCION'],  0, 20);
	
	$FechaInscripcion=date("d-m-Y", strtotime($obtenerInf['F_ENVIO']));
	
	switch($check){
		case '0':
			if($TipoDeclaracion=='0'){
					
 $pdf -> SetFont('Arial','',7.5);
$pdf -> Cell(64,4,$obtenerInf['NOMBRE'],0,0,'L');
$pdf -> Cell(24,4,$obtenerInf['RFC'],0,0,'c');
$pdf -> Cell(29,4,$FechaInscripcion,0,0,'C');
/*$pdf -> Cell(15,4,$obtenerInf['ANIO'],0,0,'C');*/
$pdf -> Cell(38,4,$dependencia,0,0,'L');
$pdf -> Cell(39,4,$Area,0,1,'L');
				$contador++;
/*$pdf -> Cell(10,4,$obtenerInf['TIPO_DECLARACION'],0,1,'C');*/
			}
			
			break;
			
		case '1':
				if($TipoDeclaracion=='1'){
					
				
 $pdf -> SetFont('Arial','',7.5);
$pdf -> Cell(64,4,$obtenerInf['NOMBRE'],0,0,'L');
$pdf -> Cell(24,4,$obtenerInf['RFC'],0,0,'c');
$pdf -> Cell(29,4,$FechaInscripcion,0,0,'C');
/*$pdf -> Cell(15,4,$obtenerInf['ANIO'],0,0,'C');*/
$pdf -> Cell(38,4,$dependencia,0,0,'L');
$pdf -> Cell(39,4,$Area,0,1,'L');
					$contador++;
			}
			
			break;
			
		case '2':
				if($TipoDeclaracion=='2'){
					
 $pdf -> SetFont('Arial','',7.5);
$pdf -> Cell(63,4,$obtenerInf['NOMBRE'],0,0,'L');
$pdf -> Cell(22,4,$obtenerInf['RFC'],0,0,'c');
$pdf -> Cell(27,4,$FechaInscripcion,0,0,'C');
/*$pdf -> Cell(15,4,$obtenerInf['ANIO'],0,0,'C');*/
$pdf -> Cell(37,4,$dependencia,0,0,'L');
$pdf -> Cell(38,4,$Area,0,0,'L');
$pdf -> Cell(7,4,$obtenerInf['ANIO'],0,1,'C');
					$contador++;
			}
			break;
	}
	
	
	

		
		/*echo ($obtenerInf['NOMBRE']);*/
	}
			$pdf -> Cell(192,0.5,'',1,1,'C',1);// LINEA DIVISORA
$pdf -> Cell(162,4,'',0,0,'L');
		$pdf -> Cell(162,4,'Total de Registros: '.$contador,0,1,'L');


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

$pagina= $excel->getActiveSheet()->setTitle('Funcionarios');

$pagina=$excel->getActiveSheet();
	$index++;
/*	$FechaEncabezadoInicio=date("d-M-Y",strtotime($FechaHoy));
	$FechaEncabezadoFinal=date("d-M-Y",strtotime($FechaMasSiete));*/
// relleno de la tabla *************************************************************************************************************
$pagina->setCellValue('A1', 'SECRETARIA DE CONTRALORÍA');
$pagina->setCellValue('A2', 'REPORTE DE DECLARACION DE '.$declaracion);
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
$pagina->setCellValue('A3', 'APELLIDO PATERNO');
$pagina->setCellValue('B3', 'APELLIDO MATERNO');
$pagina->setCellValue('C3', 'NOMBRE');
$pagina->setCellValue('D3', 'CURP');
$pagina->setCellValue('E3', 'RFC');
$pagina->setCellValue('F3', 'FECHA DE PUESTO');
$pagina->setCellValue('G3', 'DEPENDENCIA');
$pagina->setCellValue('H3',' AREA SUSCRIPCION');
$pagina->setCellValue('I3',' PUESTO');
$pagina->setCellValue('J3',' TIPO DECLARACION');
$pagina->setCellValue('K3',' AÑO');
$pagina->setCellValue('L3',' FECHA DE ENVIO');
$pagina->setCellValue('M3',' CELULAR');
$pagina->setCellValue('N3',' EXTEMPORANEA');
		
		
//******  ENCABEZADO DE LA TABLA RECEPCION******************

//******  ENCABEZADO DE LA TABLA GASTO ALIMENTO + VARIOS / KILOGRAMO DE VENTAS ***************************************


$pagina->getStyle('A3:N3')->getFont()->setBold(true);// cambiar estilo "Negrita" dentro del rango establecido
$pagina->getStyle('A4:N4')->getFont()->setSize(12);// cambiar el tañaño de letra

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

$consulta=mysqli_query($conexion,"SELECT  bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, 
bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION, usr_decnet.NUM_CELULAR, usr_decnet.CURP, bitacora_firmado.EXTEMPORANEA, encargo.FECHA,
usr_decnet.SEGUNDO_APELLIDO, usr_decnet.PRIMER_APELLIDO, usr_decnet.NOMBRE

FROM bitacora_firmado, encargo, cat_puesto, usr_decnet

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '$fechaInicial' AND bitacora_firmado.F_ENVIO <= '$FechaFinal1'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C'
AND bitacora_firmado.ANIO='$anio'
AND bitacora_firmado.ID_USR_DECNET = usr_decnet.ID_USR_DECNET");

$row=mysqli_fetch_assoc($consulta);


while($obtenerInf=mysqli_fetch_assoc($consulta)){
	
	$TipoDeclaracion_Excel=$obtenerInf['TIPO_DECLARACION'];
	
	$TipoDeclaracion=$obtenerInf['TIPO_DECLARACION'];
	
	 $FechaInscripcion=date("d-m-Y", strtotime($obtenerInf['F_ENVIO']));
	    $MesyAño=date("m-Y", strtotime($obtenerInf['F_ENVIO']));
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
	
	
	switch($check){
		case '0':
			if($TipoDeclaracion_Excel=='0'){
				$pagina->setCellValue('A'.$fila, utf8_encode($obtenerInf['PRIMER_APELLIDO']));// lotes
				$pagina->setCellValue('B'.$fila, utf8_encode($obtenerInf['SEGUNDO_APELLIDO']));// 
				$pagina->setCellValue('C'.$fila, utf8_encode($obtenerInf['NOMBRE']));// lotes
	            $pagina->setCellValue('D'.$fila, $obtenerInf['CURP']); //Nombre granja
				$pagina->setCellValue('E'.$fila, utf8_encode($obtenerInf['RFC'])); //Nombre granja
	            $pagina->setCellValue('F'.$fila, $FECHA_INICIO); // caseta
	            $pagina->setCellValue('G'.$fila, utf8_encode($obtenerInf['DEPENDENCIA'])); // Pollos
	            $pagina->setCellValue('H'.$fila, utf8_encode($obtenerInf['AREA_ADSCRIPCION'])); // Kilogramos
				$pagina->setCellValue('I'.$fila, utf8_encode($obtenerInf['puesto'])); // Kilogramos
	            $pagina->setCellValue('J'.$fila, $TipoDeclara); // Kilogramos
	            $pagina->setCellValue('K'.$fila, utf8_encode($obtenerInf['ANIO'])); // Kilogramos
	            $pagina->setCellValue('L'.$fila, $FechaInscripcion); // caseta
	           
	            $pagina->setCellValue('M'.$fila, $obtenerInf['NUM_CELULAR']); // Kilogramos
	            $pagina->setCellValue('N'.$fila, $obtenerInf['EXTEMPORANEA']); // caseta
	           
				$fila++;
			}
			
			break;
			
		case '1':
			
			if($TipoDeclaracion_Excel=='1'){
				$pagina->setCellValue('A'.$fila, utf8_encode($obtenerInf['PRIMER_APELLIDO']));// lotes
				$pagina->setCellValue('B'.$fila, utf8_encode($obtenerInf['SEGUNDO_APELLIDO']));// 
				$pagina->setCellValue('C'.$fila, utf8_encode($obtenerInf['NOMBRE']));// lotes
	            $pagina->setCellValue('D'.$fila, $obtenerInf['CURP']); //Nombre granja
				$pagina->setCellValue('E'.$fila, utf8_encode($obtenerInf['RFC'])); //Nombre granja
	            $pagina->setCellValue('F'.$fila, $FECHA_INICIO); // caseta
	            $pagina->setCellValue('G'.$fila, utf8_encode($obtenerInf['DEPENDENCIA'])); // Pollos
	            $pagina->setCellValue('H'.$fila, utf8_encode($obtenerInf['AREA_ADSCRIPCION'])); // Kilogramos
				$pagina->setCellValue('I'.$fila, utf8_encode($obtenerInf['puesto'])); // Kilogramos
	            $pagina->setCellValue('J'.$fila, $TipoDeclara); // Kilogramos
	            $pagina->setCellValue('K'.$fila, utf8_encode($obtenerInf['ANIO'])); // Kilogramos
	            $pagina->setCellValue('L'.$fila, $FechaInscripcion); // caseta
	           
	            $pagina->setCellValue('M'.$fila, $obtenerInf['NUM_CELULAR']); // Kilogramos
	            $pagina->setCellValue('N'.$fila, $obtenerInf['EXTEMPORANEA']); // caseta
	           
				$fila++;
			}
			
			break;
			
		case '2':
			
			if($TipoDeclaracion_Excel=='2'){
				$pagina->setCellValue('A'.$fila, utf8_encode($obtenerInf['PRIMER_APELLIDO']));// lotes
				$pagina->setCellValue('B'.$fila, utf8_encode($obtenerInf['SEGUNDO_APELLIDO']));// 
				$pagina->setCellValue('C'.$fila, utf8_encode($obtenerInf['NOMBRE']));// lotes
	            $pagina->setCellValue('D'.$fila, $obtenerInf['CURP']); //Nombre granja
				$pagina->setCellValue('E'.$fila, utf8_encode($obtenerInf['RFC'])); //Nombre granja
	            $pagina->setCellValue('F'.$fila, $FECHA_INICIO); // caseta
	            $pagina->setCellValue('G'.$fila, utf8_encode($obtenerInf['DEPENDENCIA'])); // Pollos
	            $pagina->setCellValue('H'.$fila, utf8_encode($obtenerInf['AREA_ADSCRIPCION'])); // Kilogramos
				$pagina->setCellValue('I'.$fila, utf8_encode($obtenerInf['puesto'])); // Kilogramos
	            $pagina->setCellValue('J'.$fila, $TipoDeclara); // Kilogramos
	            $pagina->setCellValue('K'.$fila, utf8_encode($obtenerInf['ANIO'])); // Kilogramos
	            $pagina->setCellValue('L'.$fila, $FechaInscripcion); // caseta
	           
	            $pagina->setCellValue('M'.$fila, $obtenerInf['NUM_CELULAR']); // Kilogramos
	            $pagina->setCellValue('N'.$fila, $obtenerInf['EXTEMPORANEA']); // caseta
	           
				$fila++;
				
			}
			
			break;
			
	}
	
	
	
	

		
		/*echo ($obtenerInf['NOMBRE']);*/
	}


foreach( range('A3', 'N3') as $column){// recorrer las filas y columna para establecer el tamaño de la celda
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
$excel->getActiveSheet()->getStyle('A3:N3')->applyFromArray($borders); // AGREGAR MARCO	

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