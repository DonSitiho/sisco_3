<?php

include('../conexion/conexion.php');

$fecha_actual=strftime("%Y-%m-%d");
$datosfecha = explode('-', $fecha_actual);
$anio = substr($datosfecha[0],2,2);

//$sql = "SELECT count(*) as numofi FROM num_oficios WHERE anio = '$anio'";
//$result = $conexion->query($sql);
//$fila = $result->fetch_assoc();
//$no_ofi = $fila['numofi']+1;

$sql = "SELECT * FROM num_oficios WHERE anio = '$anio' order by CAST(folio_oficio AS UNSIGNED) DESC";
$result = $conexion->query($sql);
$fila = $result->fetch_assoc();
$no_ofi = $fila['folio_oficio']+1;

if ($no_ofi<10){
    $folio='00'.$no_ofi;
    $folio=ltrim($folio);
}
elseif($no_ofi>=10 && $no_ofi<100){
    $folio='0'.$no_ofi;
    $folio=ltrim($folio);
}
elseif($no_ofi>=100 && $no_ofi<10000){
    $folio=$no_ofi;
    $folio=ltrim($folio);
}        


echo $folio;






?>