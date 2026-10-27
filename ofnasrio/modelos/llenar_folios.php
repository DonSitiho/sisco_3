<?php
include('../../ajax/conexion.php');
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');

$fecha_actual=strftime("%Y-%m-%d");
$datosfecha = explode('-', $fecha_actual);
$anio = substr($datosfecha[0],2,2);

$fecha_hora=date("Y-m-d H:i:s");
$hoy=date('Y-m-d');

$query = "SELECT * FROM num_oficios";
$result = mysqli_query($conexion, $query);
if (mysqli_num_rows($result) > 0) {
    while($fila = mysqli_fetch_assoc($result)){
        $no_ofi = $fila["no_oficio"];
        $anio_ofi = $fila["fecha_solicitado"];
        $datoanio = explode('-', $anio_ofi);
        $anio = substr($datoanio[0],2,2);
        
        if ($no_ofi<10){
            $folio='00'.$no_ofi;
            $folio=ltrim($folio);
        }
        elseif($no_ofi>=10 && $no_ofi<100){
            $folio='0'.$no_ofi;
            $folio=ltrim($folio);
        }
        elseif($no_ofi>=100 && $no_ofi<1000){
            $folio=$no_ofi;
            $folio=ltrim($folio);
        }        

        $sql = "UPDATE num_oficios SET 	folio_oficio = '$folio',
                anio = '$anio'
                WHERE no_oficio = $no_ofi";	

	    $query2 = mysqli_query($conexion,$sql);        
    }   
} else {
    die("Error: No hay datos en la tabla seleccionada");
}

?>