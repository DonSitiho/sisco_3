<?php
include('../../php/conexion.php');
$direccion=mysqli_query($conexion, "SELECT * FROM subdirecciones_oic WHERE id_direccion1='4'");
print_r ($direccion->num_rows);
?>