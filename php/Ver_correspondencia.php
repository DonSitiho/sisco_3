<?php
include('conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$valores =mysqli_query($conexion, "SELECT datos_correspondencia.*, dependencias.nombre as nom_dep, direcciones_secoem.nombre_direccion 
								   FROM datos_correspondencia, dependencias, direcciones_secoem
								   WHERE  dependencias.id_dependencia=datos_correspondencia.id_remitente
								   AND datos_correspondencia.id_direcciones=direcciones_secoem.id_direccion
								   AND datos_correspondencia.id_datos_c = '$id' ");
$doc="";
$documentos=mysqli_query($conexion, "SELECT * FROM documentos WHERE id_datos_c1='$id' ");

$valores1=mysqli_fetch_array($documentos);


if(isset($valores1)){
	
	$sacar_doc=$valores1['ruta'];
	$doc.='<a href="'.$sacar_doc.'" target="_blank">documento</a>';
}else{
	$doc="";
}

$valores2 = mysqli_fetch_array($valores);
$des=$valores2['id_destinatarios'];

$destinatario=mysqli_query($conexion, "SELECT nombre FROM dependencias WHERE id_dependencia='$des'");

$valores3 = mysqli_fetch_array($destinatario);
$datos = array(
				0 => $valores2['folio'],
	            1 => $valores2['f_recepcion'], 
	            2 => $valores2['tipo_oficio'], 
	            3 => $valores2['nom_dep'], 
	            4 => $valores2['cargo'], 
	            5 => $valores2['Nombre'], 
	            6 => $valores2['num_oficio'], 
	            7 => $valores2['f_oficio'], 
	            8 => $valores3['nombre'], 
	            9 => $valores2['cargo_destinatario'],
	           10 => $valores2['asunto_destinatario'], 
	           11 => $valores2['indicaciones_destinatario'], 
	           12 => $valores2['anexo_destinatario'], 
	           13 => $valores2['leyenda_destinatario'], 
	           14 => $valores2['nombre_direccion'],
	           15 => $valores2['instrucciones_direcciones'],
	           $doc
				);
	

echo json_encode($datos);
?>