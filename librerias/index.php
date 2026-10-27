<?php

include 'plantilla.php';
include 'conexion.php';



$pdf = new FPDF('L','mm','letter');
$pdf -> AddPage();
$pdf -> AddPage();
$pdf -> SetFont('Arial','B',15);

$pdf -> MultiCell(100, 10, 'Hola Mundo', 1, 'L', '0');

$pdf -> Output();










?>