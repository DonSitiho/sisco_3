<?php
if(isset($_POST['cantidadr'])){
	
	require_once ("../conexion/conexion.php");
	
	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");
	
	session_start();
	$id_usuario=$_SESSION['id_usuario'];
    
    $datosfecha = explode('-', $fecha_actual);
	$anio = substr($datosfecha[0],2,2);

	/*$identificado=141;
	$cantidad=1;*/
	//$id_usuario=$_POST['id_usuario_c'];
	
	$nombre = $_POST['reserva_sol'];
	$idareaint = $_POST['reserva_area_interna'];
	$cantidad=$_POST['cantidadr'];
	
    
   

	//echo $identificado, $id_usuario, $cantidad;

	
		
		for($i=1; $i<=$cantidad; $i++){		
            
            // $sql1 = "SELECT count(*) as numofi FROM num_oficios WHERE anio = '$anio'";
			// $result = $conexion->query($sql1);
			// $fila = $result->fetch_assoc();
			// $no_ofi = $fila['numofi']+1;

			$sql = "SELECT * FROM num_oficios WHERE anio = '$anio' order by CAST(folio_oficio AS UNSIGNED) DESC";
			// var_dump($sql);
			// exit();
			$result = $conexion->query($sql);
			$fila = $result->fetch_assoc();
			$no_ofi = $fila['folio_oficio']+1;
			
            
			if ($no_ofi<10){
				$folio='00'.$no_ofi;
				$folio=ltrim($folio);
			}
			elseif($no_ofi>=10 && $no_ofi<100){
				$folio='0'.$no_ofi;
				$folio=ltrim($folio);
			}
			elseif($no_ofi>=100 && $no_ofi<10000){
				$folio=$no_ofi;
				$folio=ltrim($folio);
			}        

							
				
            $sql = "INSERT INTO `num_oficios`(`no_oficio`, `folio_oficio`,  `anio`, `fecha_solicitado`, `fecha_oficio`, `nombre_oficio`, `cargo_oficio`, `id_dependencia`, `asunto_oficio`,
                                `solicitante_oficio`, `id_direccion`, `folio_relacionado`, `estatus_oficio`)
                    VALUES (NULL, '$folio',  '$anio', '$fecha_actual', '0000-00-00', '', '', 0, 'RESERVADO', '$nombre', $idareaint, '00/00000/00', '1')";


			$query = mysqli_query($conexion,$sql);
			
			$id_insert=mysqli_insert_id($conexion);
			$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_oficios_acciones (id_bitacora, id_usuario, fecha_captura, id_accion, id_oficiosrio) 
												VALUES (NULL, '$id_usuario', '$fecha_hora', '1', '$id_insert')");

		}	
			
			if ($query) {

				$messages[] = "Se ha realizado la reserva de $cantidad oficios con éxito.";
			} else {
		
				$errors[] = "Lo sentimos, el proceso de reserva de oficios falló. Por favor, regrese y vuelva a intentarlo.";
			}			
			

} else 
{
	$errors[] = "desconocido.";
}

if (isset($errors)){
		
		?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong> 
				<?php
					foreach ($errors as $error) {
							echo $error;
						}
					?>
		</div>
		<?php
}

if (isset($messages)){
	
	?>
	<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Bien hecho!</strong>
			<?php
				foreach ($messages as $message) {
						echo $message;
					}
				?>
	</div>
	<?php
}
?>			