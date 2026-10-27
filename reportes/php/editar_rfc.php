<?php

if(isset($_POST['anio'])){
	include_once('../php/conexion.php');
	$numero=$_POST['bookId'];
	$anio=$_POST['anio'];
	
	$sql=("UPDATE declaraciones_existentes SET ANIO_DECLARACION='$anio' WHERE NO_DECLARACION='$numero'");
	
	mysqli_query($conexion,$sql);
	
	if(mysqli_errno($conexion)){
		echo(mysqli_errno($conexion));
	}
		echo "<script type='text/javascript'>alert('El año se modifico con exito');</script>";
        echo "<script type='text/javascript'>window.location.href=' ../vistas/declaraciones.php';</script>";
	
	
}
?>