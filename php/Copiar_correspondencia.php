<?php
if(isset($_POST['id-corr']) && isset($_POST['cantidad'])){
	include('conexion.php');
	include('fecha_actual.php');
	/*$identificado=141;
	$cantidad=1;*/
	$id_usuario=$_POST['id_usuario_c'];
	$identificado=$_POST['id-corr'];
	$cantidad=$_POST['cantidad'];

	$copiar_datos=mysqli_query($conexion, "SELECT * FROM datos_correspondencia WHERE id_datos_c ='$identificado' ");
		
		while($campos_c=mysqli_fetch_assoc($copiar_datos)){
			
			$folio=$campos_c['folio'];		
			$f_recepcion=$campos_c['f_recepcion'];
			$tipo_oficio=$campos_c['tipo_oficio'];
			$id_remitente=$campos_c['id_remitente'];
			$cargo=$campos_c['cargo'];
			$nombre=$campos_c['Nombre'];
			$num_oficio=$campos_c['num_oficio'];
			$f_oficio=$campos_c['f_oficio'];
			$id_destinatarios=$campos_c['id_destinatarios'];
			$cargo_destinatario=$campos_c['cargo_destinatario'];
			$asunto_destinatario=$campos_c['asunto_destinatario'];
			$indicaciones_destinatario=$campos_c['indicaciones_destinatario'];
			$anexo_destinatario=$campos_c['anexo_destinatario'];
			$leyenda_destinatario=$campos_c['leyenda_destinatario'];
			$id_direcciones=$campos_c['id_direcciones'];
			$instrucciones_direcciones=$campos_c['instrucciones_direcciones'];
			$id_estatus=$campos_c['id_estatus1'];
			
		/*	echo(' :'.' '.$instrucciones_direcciones.' ');*/
		}
		
		
		for($i=0; $i<=$cantidad; $i++){
		
			
				
				$insertar=mysqli_query($conexion,"INSERT INTO datos_correspondencia (id_datos_c, folio, f_recepcion, tipo_oficio, id_remitente, cargo, Nombre, num_oficio, f_oficio, 
															id_destinatarios, cargo_destinatario, asunto_destinatario, indicaciones_destinatario, anexo_destinatario, leyenda_destinatario, id_direcciones, instrucciones_direcciones, id_estatus1, fecha_cap_c) 
												  VALUES (NULL, '$folio', '$f_recepcion', '$tipo_oficio', '$id_remitente', '$cargo', '$nombre', '$num_oficio', '$f_oficio', '$id_destinatarios', 
																'$cargo_destinatario', '$asunto_destinatario', '$indicaciones_destinatario', '$anexo_destinatario', '$leyenda_destinatario', '$id_direcciones', '$instrucciones_direcciones', '$id_estatus', '$fecha_hora')");
			
				$id_insert=mysqli_insert_id($conexion);
				
				$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) 
												VALUES (NULL, '$id_usuario', '$fecha_hora', '6', '$id_insert')");
				
		}			

}else{
	
}

header('Location: ../vistas/captura_correspondencia.php?identificador1="hola"');

?>

<script type="text/javascript">
function showNotification(from, align){

  $.notify({
      icon: "add_alert",
      message: "Se Copio la correspondencia: <?php echo($identificado)?>, <?php echo($cantidad)?> veces."

  },{
      type: 'info',
      timer: 4000,
      placement: {
          from: from,
          align: align
      }
  });
}

showNotification('top','right');	 
	 
$(document).ready(function () {
	$('#dtBasicExample').DataTable({
		"order": [ 0, 'desc' ]
	});
	$('.dataTables_length').addClass('bs-select');
	});
</script>