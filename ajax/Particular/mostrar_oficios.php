<?php
    
    //Procedimiento a realizar
if(isset($_GET['id'])){
$idofi=$_GET['id'];	
include('../../php/conexion.php');
	
	//CONSULTAR LOS OFICIOS QUE SE ENCUENTRAN ALMACENADOS
	$consulta_archivos=mysqli_query($conexion,"SELECT * FROM oficios_firmados WHERE no_oficio ='$idofi'");
	$num_rows = mysqli_num_rows($consulta_archivos);
    
    //SI EXISTEN DOCUMENTOS
	
	if ($num_rows!=0){
		echo('<center>');
	while($obtener_oficio=mysqli_fetch_assoc($consulta_archivos)){
		$ruta=substr($obtener_oficio['ruta'],2);
		
		echo('	<a title="'.$obtener_oficio['nombre_oficio'].'" href="../../ofnasrio'.$ruta.'" target="_blank"><img src="../../images/pdf.ico" width="15%;" alt="'.$obtener_oficio['nombre_oficio'].'" /></a>');
		//imprimir en pantalla los documentos finalizados

	}
		
		echo('</center>');
}else{
echo "<center><h7>No hay archivos vinculados a éste oficio</h7></center>";
}	
}
		 
?>