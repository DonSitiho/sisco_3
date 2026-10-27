<?php 
if(isset($_POST['subdireccionMultiselect']) ){
if(isset($_POST['view_idT']) ){//subdirecciones
    include_once('../../php/conexion.php');
	$id_correspondencia = mysqli_real_escape_string($conexion,(strip_tags($_POST['view_idT'],ENT_QUOTES)));
	$direcciones = $_POST['subdireccionMultiselect'];
	$view_array=array();
	$c=0;
	foreach($direcciones as $value){
		$view_array[$c] = '1';
		$c++;
	}
	$direcciones = implode(",", $direcciones);
	$view_array = implode(",", $view_array);

	$update = "UPDATE datos_correspondencia SET id_sub_oic = '$direcciones', view_sub_oic='$view_array' WHERE id_datos_c = '$id_correspondencia'";

	if($query = mysqli_query($conexion, $update)){
		echo('<script>
				swal({
	                     title: "Exito!",
	                     text: "Turnado con exito!",
	                     icon: "success",
	                      buttons: {
		                             confirm: {
			                                      text: "Aceptar",
			                                      value: true,
			                                      visible: true,
			                                      className: "btn btn-success",
			                                      closeModal: true
		                                       }
	                                 }
					 });
					 
			 </script>');

	}else{
			echo('<script>
				swal({
	                     title: "¡Error!",
	                     text: "Fallo el turnado!",
	                     icon: "Error",
	                      buttons: {
		                             confirm: {
			                                      text: "Aceptar",
			                                      value: true,
			                                      visible: true,
			                                      className: "btn btn-danger",
			                                      closeModal: true
		                                       }
	                                 }
					 });
					 
			 </script>');
	}



	
}else{
	echo('<script>
				swal({
	                     title: "¡Error!",
	                     text: "No llego el identificador de la correspondencia!",
	                     icon: "Error",
	                      buttons: {
		                             confirm: {
			                                      text: "Aceptar",
			                                      value: true,
			                                      visible: true,
			                                      className: "btn btn-danger",
			                                      closeModal: true
		                                       }
	                                 }
					 });
					 
			 </script>');
}
//Aqui termina las subdirecciones
}elseif(isset($_POST['deptoMultiselect'])){ //DEPARTAMENTOS
	if(isset($_POST['view_idT']) ){
		include_once('../../php/conexion.php');
		$id_correspondencia = mysqli_real_escape_string($conexion,(strip_tags($_POST['view_idT'],ENT_QUOTES)));
		$direcciones = $_POST['deptoMultiselect'];
		$view_array=array();
		$c=0;
		foreach($direcciones as $value){
			$view_array[$c] = '1';
			$c++;
		}
		$direcciones = implode(",", $direcciones);
		$view_array = implode(",", $view_array);
	
		$update = "UPDATE datos_correspondencia SET id_departamento = '$direcciones', view_dep ='$view_array' WHERE id_datos_c = '$id_correspondencia'";
	
		if($query = mysqli_query($conexion, $update)){
			echo('<script>
					swal({
							 title: "Exito!",
							 text: "Turnado con exito!",
							 icon: "success",
							  buttons: {
										 confirm: {
													  text: "Aceptar",
													  value: true,
													  visible: true,
													  className: "btn btn-success",
													  closeModal: true
												   }
										 }
						 });
						 
				 </script>');
	
		}else{
				echo('<script>
					swal({
							 title: "¡Error!",
							 text: "Fallo el turnado!",
							 icon: "Error",
							  buttons: {
										 confirm: {
													  text: "Aceptar",
													  value: true,
													  visible: true,
													  className: "btn btn-danger",
													  closeModal: true
												   }
										 }
						 });
						 
				 </script>');
		}
	
	
	
		
	}else{
		echo('<script>
					swal({
							 title: "¡Error!",
							 text: "No llego el identificador de la correspondencia!",
							 icon: "Error",
							  buttons: {
										 confirm: {
													  text: "Aceptar",
													  value: true,
													  visible: true,
													  className: "btn btn-danger",
													  closeModal: true
												   }
										 }
						 });
						 
				 </script>');
	}

}elseif(isset($_POST['oficinaMultiselect'])){ //Oficinas
	if(isset($_POST['view_idT']) ){
		include_once('../../php/conexion.php');
		$id_correspondencia = mysqli_real_escape_string($conexion,(strip_tags($_POST['view_idT'],ENT_QUOTES)));
		$direcciones = $_POST['oficinaMultiselect'];
		$view_array=array();
		$c=0;
		foreach($direcciones as $value){
			$view_array[$c] = '1';
			$c++;
		}
		$direcciones = implode(",", $direcciones);
		$view_array = implode(",", $view_array);
	   // echo $direcciones;
		$update = "UPDATE datos_correspondencia SET id_oficina = '$direcciones', view_oficina ='$view_array' WHERE id_datos_c = '$id_correspondencia'";
	
		if($query = mysqli_query($conexion, $update)){
			echo('<script>
					swal({
							 title: "Exito!",
							 text: "Turnado con exito!",
							 icon: "success",
							  buttons: {
										 confirm: {
													  text: "Aceptar",
													  value: true,
													  visible: true,
													  className: "btn btn-success",
													  closeModal: true
												   }
										 }
						 });
						 
				 </script>');
	
		}else{
				echo('<script>
					swal({
							 title: "¡Error!",
							 text: "Fallo el turnado!",
							 icon: "Error",
							  buttons: {
										 confirm: {
													  text: "Aceptar",
													  value: true,
													  visible: true,
													  className: "btn btn-danger",
													  closeModal: true
												   }
										 }
						 });
						 
				 </script>');
		}
	
	
	
		
	}else{
		echo('<script>
					swal({
							 title: "¡Error!",
							 text: "No llego el identificador de la correspondencia!",
							 icon: "Error",
							  buttons: {
										 confirm: {
													  text: "Aceptar",
													  value: true,
													  visible: true,
													  className: "btn btn-danger",
													  closeModal: true
												   }
										 }
						 });
						 
				 </script>');
	}
}
?>