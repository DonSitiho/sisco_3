<?php
include('conexion.php');

$id = trim($_POST['id']);

//OBTENEMOS LOS VALORES DEL PRODUCTO
$valores =mysqli_query($conexion, "SELECT * FROM datos_correspondencia where id_datos_c = '$id' ");

$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['folio'],
	            1 => $valores2['f_recepcion'], 
	            2 => $valores2['tipo_oficio'], 
	            3 => $valores2['id_remitente'], 
	            4 => $valores2['cargo'], 
	            5 => $valores2['Nombre'], 
	            6 => $valores2['num_oficio'], 
	            7 => $valores2['f_oficio'], 
	            8 => $valores2['id_destinatarios'], 
	            9 => $valores2['cargo_destinatario'],
	           10 => $valores2['asunto_destinatario'], 
	           11 => $valores2['indicaciones_destinatario'], 
	           12 => $valores2['anexo_destinatario'], 
	           13 => $valores2['leyenda_destinatario'], 
	           14 => $valores2['id_direcciones'],
	           15 => $valores2['instrucciones_direcciones'],
	
				);
	

echo json_encode($datos);
?>