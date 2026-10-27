<?php
$conexion = new mysqli("TU_HOST", "TU_USUARIO", "TU_CONTRASEÑA", "NOMBRE_BASE_DATOS");
/*$conexion=mysqli_connect("localhost","root","","ReportesContraloria");*/

if(!$conexion){
	die("la conexion fallo en: ". mysqli_connect_errno());
}else{
	/*echo("Conexion satisfactoria");*/
}

?>