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
	
	$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_documento, nombre_documento, ruta, id_datos_c1) VALUES (NULL, '$nombre_encriptado',  '$ruta', '$id_correspondencia')");
	

}else{
	echo('no es un pdf');
	/*$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_doc, nombre, tipo_declaracion, year, id_usr_declaraciones) VALUES (NULL, 'Nombre', 'Inicial', '2016', '9')");*/
}

}
?>
