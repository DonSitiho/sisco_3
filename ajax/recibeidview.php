<?php

$idco = $_REQUEST['id'];

session_start();
ob_start();

$_SESSION['id2']=$idco;



include_once ('conexion.php');
$tip_oficio=mysqli_query($conexion, "SELECT * FROM datos_correspondencia WHERE id_datos_c=$idco");
while($to=mysqli_fetch_assoc($tip_oficio)){
    $t_o=$to['tipo_oficio'];
}

echo $t_o;

?>