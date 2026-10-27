<?php

include('conexion.php');

$proceso = $_POST['tipo_registro'];// estatus del envio del formulario
$siglas=$_POST['siglas'];
$nombre=utf8_decode($_POST['nombre']);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

$identificador=mysqli_query($conexion, "SELECT * FROM dependencias ORDER BY id_dependencia DESC limit 1");

	while($row_id=mysqli_fetch_assoc($identificador)){
		$id=($row_id['id_dependencia'])+1;
		$id='00'.$id;
	}

switch($proceso){
	
	case 'Registro':
		
		$registro1 =mysqli_query($conexion, "INSERT INTO dependencias (id_dependencia, identificador, sigla, nombre) 
											 VALUES (NULL, '$id', '$siglas', '$nombre')");	

	break;
	
	case 'Edicion':
	
		$registro2 = mysqli_query($conexion, "UPDATE datos_correspondencia 
											  SET f_recepcion = '$Fecha_recepcion', tipo_oficio = '$copia', id_remitente= '$remitente', cargo = '$cargo', Nombre = '$nombre', 
												  num_oficio= '$n_oficio', f_oficio = '$f_oficio', id_destinatarios = '$destinatario', cargo_destinatario= '$cargo_dest', 
												  asunto_destinatario = '$asunto', indicaciones_destinatario = '$destacar', anexo_destinatario = '$anexoa', leyenda_destinatario = '$leyenda', 
												  id_direcciones = '$direccion', instrucciones_direcciones = '$instrucciones'     
											  WHERE id_datos_c = '$id'");
	
	break;
}
echo('
	
   	<link rel="stylesheet" type="text/css" href="../Select/css/select2.min.css"/>

 	<select class="form-control font-weight-bold"  id="remitente" name="remitente" style="width: 100%;" >
		<option   value="" disabled>Remitente ...</option>');     		
			$remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
			while($dep=mysqli_fetch_assoc($remitenet)){
				$emisor=$dep['identificador'].'-'.utf8_encode($dep['nombre']);
				echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
			}		
	echo('</select>		
	 <script src="../Select/js/select2.js"></script>
 	 ');     
		
// imprimimos en nuestro div el contenido con el resutado

?>
<script type="text/javascript">
	  
	  $(document).ready(function(){
		  $('#remitente').select2();
	  });
	  
</script>