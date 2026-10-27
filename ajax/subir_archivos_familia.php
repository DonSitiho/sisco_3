<?php

if (empty($_POST['id_correspondencia'])){
  $errors[] = "El id de la correspondencia está vacio";
} elseif (!empty($_POST['id_correspondencia'])){

include('conexion.php');

$id_correspondencia=$_POST['id_correspondencia'];

$documento=$_FILES['documento'];
/*echo($documento["type"]);*/
if($documento["type"] == "application/pdf"){
	
	$nombre_encriptado=($documento['name']);
	$ruta='../Documentos/'.$id_correspondencia.'__'.$nombre_encriptado.'';
	move_uploaded_file($documento['tmp_name'], $ruta);
	
	
	
	$sacar_folio=mysqli_query($conexion, "SELECT folio FROM datos_correspondencia WHERE id_datos_c='$id_correspondencia'");
	$rows=mysqli_fetch_assoc($sacar_folio);
	$foliofam=$rows['folio'];
	$newFolio = substr($foliofam, 0, 9);
	
	
	$copias=mysqli_query($conexion,"SELECT id_datos_c FROM `datos_correspondencia` WHERE `folio` LIKE '%$newFolio%'");
	while($rows=mysqli_fetch_assoc($copias)){
		$idcopia=$rows['id_datos_c'];
		$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_documento, nombre_documento, ruta, id_datos_c1) VALUES (NULL, '$nombre_encriptado',  '$ruta', '$idcopia')");
	}
	
	
  
}else{
	echo('no es un pdf');
	/*$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_doc, nombre, tipo_declaracion, year, id_usr_declaraciones) VALUES (NULL, 'Nombre', 'Inicial', '2016', '9')");*/
}

}
?>