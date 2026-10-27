<?php
//echo('llego');
if(isset($_POST['view_idC']) ){
	session_start();
	$subdireccion = $_SESSION['subdireccion'];
$id_corresp=$_POST['view_idC'];
	require_once('../../php/conexion.php');
		date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, 'es_MX.UTF-8');
	   $fecha_hora=date("Y-m-d H:i:s");
	   
	   //Consulta para sacar los arreglod
	   $consulta_copia = mysqli_query($conexion," SELECT id_sub_oic, view_sub_oic FROM datos_correspondencia 
												  WHERE id_datos_c = '$id_corresp'"); 
	   $arregloConsulta = mysqli_fetch_assoc( $consulta_copia );
	  // echo "Subdirección: ".$subdireccion. "<br>";

	   $arraySubdireccion =  explode(",",$arregloConsulta['id_sub_oic']);
      
	   $arrayView =  explode(",",$arregloConsulta['view_sub_oic']);
	   //var_dump($arrayView); 
	//exit();
	   //sacar posición de nuestra subdireccion
	   $clave = array_search($subdireccion,  $arraySubdireccion); // $clave = 2;
	   //echo "Clave es : ".$clave."<br>";
	   if( $arrayView[$clave] == "1" or $arrayView[$clave] =="" or $arrayView[$clave] == null){
		$arrayView[$clave] = 0;

		$arregloBd = implode(",", $arrayView);
		 // Solo modificamos las el arreglo de vistas
		 $modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` SET view_sub_oic = '$arregloBd'
		  WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");
          $ArrayComparar = array();
		  foreach($arrayView as $indice => $value){
			$ArrayComparar[$indice] = 0;
		  }
		  if ( $arrayView == $ArrayComparar ){

			$modificar_estatus=mysqli_query($conexion,"UPDATE `datos_correspondencia` 
			SET `id_estatus1` = '6', `fecha_finalizacion`='$fecha_hora' WHERE `datos_correspondencia`.`id_datos_c` = '$id_corresp';");
			   //mensaje
			   echo('<script>
                              swal({
                                     title: "¡Bien hecho!",
                                     text: "La correspondencia se finalizo con con exito!",
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
				   title: "¡Informacion!",
				   text: "La correspondencia se Finalizara una vez sea vista por todas las Subdirecciones!",
				   icon: "info",
				   buttons: {
					   confirm: {
					   text: "Aceptar",
					   value: true,
					   visible: true,
					   className: "btn btn-info",
					   closeModal: true
							   }
						  }
					   });
                 </script>');
		  }
		 
		 //Modificamos nuestro registro en la base de datos
		





		
	   }else{
           //No se puede finalizar hasta que todas las Subdirecciones lo vean
		 echo('<script>
		   swal({
                 title: "¡Información que cura xD!",
                 text: "La correspondencia no se finalizara hasta que sea vista por las demas subdirecciones!",
                 icon: "info",
                 buttons: {
                     confirm: {
	                    text: "Aceptar",
	                    value: true,
	                    visible: true,
	                    className: "btn btn-info",
	                    closeModal: true
                     }
                   }
                 });
				 </script>');
				 echo"*******No se pude finalizar********";

	   }

	  //mysqli_close( $modificar_estatus );
		
   	

	
}else{
	echo('no llego');
}

?>