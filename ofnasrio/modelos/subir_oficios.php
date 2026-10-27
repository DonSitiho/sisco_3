<?php

if (empty($_POST['id_oficio'])){
  $errors[] = "El id del oficio está vacio";
} elseif (!empty($_POST['id_oficio'])){

include('../conexion/conexion.php');

$id_oficio=$_POST['id_oficio'];
$documento=$_FILES['oficio'];
/*echo($documento["type"]);*/

$sacardatos=mysqli_query($conexion, "SELECT * FROM num_oficios WHERE no_oficio = $id_oficio");
		
		while($campos=mysqli_fetch_assoc($sacardatos)){			
			$folio=$campos['folio_oficio'];		
			$anio=$campos['anio'];			
		}

if($documento["type"] == "application/pdf"){
	if($anio == '20'){
		
		$nombre_encriptado=($documento['name']);
		$ruta='../oficios_firmados/'.$id_oficio.'__'.$nombre_encriptado.'';
		move_uploaded_file($documento['tmp_name'], $ruta);

	}else{
		
		$nombre_encriptado=($documento['name']);
		$ruta='../oficios_firmados/'.$anio.'__'.$folio.'__'.$nombre_encriptado.'';
		move_uploaded_file($documento['tmp_name'], $ruta);
	}
	
	$insert_document=mysqli_query($conexion, "INSERT INTO oficios_firmados (id_oficio, nombre_oficio, ruta, no_oficio) VALUES (NULL, '$nombre_encriptado',  '$ruta', '$id_oficio')");
	

}else{
	echo('no es un pdf');
	/*$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_doc, nombre, tipo_declaracion, year, id_usr_declaraciones) VALUES (NULL, 'Nombre', 'Inicial', '2016', '9')");*/
}

}
?>
