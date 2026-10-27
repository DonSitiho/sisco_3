<?php

require('../fpdf/fpdf.php');



class PDF extends FPDF {
	
/*	protected $col = 0; // Columna actual
    protected $y0;      // Ordenada de comienzo de la columna*/
	function Header(){
		global $Dependencia1;
		global $DiaSemana;
		global $Dia;
		global $Mes;
		global $Anio;
		global $DiaSemana1;
		global $Dia1;
		global $Mes1;
		global $Anio1;
		$this->Cell(30);
		$this-> Image('../img/contraloria.png', 5, 5,60);
		$this-> SetFont('Arial','B',15);
		$this-> Cell(40);
		$this-> Cell(120,5,utf8_decode('SECRETARIA DE CONTRALORÍA'),0,1,'L'); 
		$this ->Cell(65,5,'',0,0,'L');
        $this-> SetFont('Arial','B',12);
        $this ->Cell(100,5,utf8_decode('REPORTE DE DECLARACIÓN '),0,1,'C');
		$this ->Cell(60,5,' ',0,0,'L');
		
        $this-> SetFont('Arial','B',12);
        $this ->Cell(100,5,utf8_decode($Dependencia1),0,1,'C');
		$this -> SetFont('Arial','B',9);
		$this ->Cell(60,5,' ',0,0,'L');
        $this ->Write(5,utf8_decode('REPORTE DEL DÍA '.$DiaSemana.'  '.$Dia.' DEL MES DE '.$Mes.' DEL '.$Anio));
		$this ->Cell(100,5,'',0,1,'C');
		$this ->Cell(75,5,' ',0,0,'L');
		$this ->Write(5,utf8_decode('AL '.$DiaSemana1.' '.$Dia1.' DEL MES DE '.$Mes1.' DEL '.$Anio1));
		$this-> Cell(195,5,'',0,1,'L');
		$this-> SetFillColor(157, 156, 147 );
		$this-> Cell(195,0.5,'',0,1,'L',1);
        $this-> Ln(2);
		
	}
	function Footer(){
		//Agregar fecha y hora de la consulta
		date_default_timezone_set("America/Mexico_City");
		$time = time('');
		$this->PageNo();
		$this-> SetY(-15);
		$this-> SetFont('Arial','I',8);
		$this->Cell(20,10,'Fecha: '.date("d-m-Y (H:i:s)", $time),0,0,'L');
		$this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'C');
		
		/*$this-> Cell(0,10, 'Pagina '$this->PageNo().'/{nb}',0,0,'C');*/
	}

}




?>