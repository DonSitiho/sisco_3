<?php

if (empty($_POST['vincula_id'])){
  $errors[] = "El id de la correspondencia está vacio";
} elseif (!empty($_POST['vincula_id'])){

include('../conexion/conexion.php');

$id_correspondencia=$_POST['vincula_id'];
$nofi_correspondencia=$_POST['vincula_nofi'];
$folio_correspondencia=$_POST['vincula_folio'];
$num_oficiosrio=$_POST['vincula_id_ofi'];
 
$documento=$_FILES['respuesta'];
/*echo($documento["type"]);*/
if($documento["type"] == "application/pdf"){
	
	$nombre_encriptado='Respuesta_'.($documento['name']);
	$ruta='../../Documentos/'.$id_correspondencia.'__'.$nombre_encriptado.'';
	move_uploaded_file($documento['tmp_name'], $ruta);
	
	$sql=( "INSERT INTO documentos (id_documento, nombre_documento, ruta, id_datos_c1) 
	VALUES (NULL, '$nombre_encriptado',  '$ruta', '$id_correspondencia');");
	
	$query = mysqli_query($conexion,$sql);

	if ($query) {
		
		$sql1 = "UPDATE num_oficios SET 
						folio_relacionado = '$folio_correspondencia',
						oficio_relacionado = '$nofi_correspondencia',
						estatus_oficio = '3',
						id_datos_c = '$id_correspondencia'				
		
				 WHERE no_oficio = $num_oficiosrio";		
	echo($sql1);
		$query2 = mysqli_query($conexion,$sql1);	

    }

}else{
	echo('no es un pdf');
	/*$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_doc, nombre, tipo_declaracion, year, id_usr_declaraciones) VALUES (NULL, 'Nombre', 'Inicial', '2016', '9')");*/
}



}
?>
