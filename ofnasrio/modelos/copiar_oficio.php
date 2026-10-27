<?php
if(isset($_POST['id_copy']) && isset($_POST['cantidad'])){
	
	require_once ("../conexion/conexion.php");
	
	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=strftime("%Y-%m-%d");
    $fecha_hora=date("Y-m-d H:i:s");
	
	session_start();
	$id_usuario=$_SESSION['id_usuario'];
	
	/*$identificado=141;
	$cantidad=1;*/
	//$id_usuario=$_POST['id_usuario_c'];
	$identificado=intval($_POST['id_copy']);
	$cantidad=$_POST['cantidad'];
	
	$datosfecha = explode('-', $fecha_actual);
	$anio = substr($datosfecha[0],2,2);
    
    //echo 'id: '.$identificado.' cant: '.$cantidad;

	//echo $identificado, $id_usuario, $cantidad;

	$copiar_datos=mysqli_query($conexion, "SELECT * FROM num_oficios WHERE no_oficio = $identificado");
		
		while($campos_c=mysqli_fetch_assoc($copiar_datos)){
			
			$copiar_fasig=$campos_c['fecha_solicitado'];		
			$copiar_fofi=$campos_c['fecha_oficio'];
			$copiar_nom=$campos_c['nombre_oficio'];
			$copiar_cargo=$campos_c['cargo_oficio'];
			$copiar_iddep=$campos_c['id_dependencia'];			
			$copiar_asunto=$campos_c['asunto_oficio'];
			$copiar_solicitante=$campos_c['solicitante_oficio'];
			$copiar_idarea=$campos_c['id_direccion'];
			$copiar_foliorel=$campos_c['folio_relacionado'];
			$copiar_estatus=$campos_c['estatus_oficio'];
			
		
		}
		
		
		for($i=1; $i<=$cantidad; $i++){		

			//$sql = "SELECT count(*) as numofi FROM num_oficios WHERE anio = '$anio'";
			//$result = $conexion->query($sql);
			//$fila = $result->fetch_assoc();
			//$no_ofi = $fila['numofi']+1;
            
            $sql = "SELECT * FROM num_oficios WHERE anio = '$anio' order by CAST(folio_oficio AS UNSIGNED) DESC";
			$result = $conexion->query($sql);
			$fila = $result->fetch_assoc();
			$no_ofi = intval($fila['folio_oficio'])+1;
			
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
														
				
			$sql = "INSERT INTO `num_oficios`(`no_oficio`, `folio_oficio`, `anio`, `fecha_solicitado`, `fecha_oficio`, `nombre_oficio`, `cargo_oficio`, `id_dependencia`, `asunto_oficio`,
			`solicitante_oficio`, `id_direccion`, `folio_relacionado`, `estatus_oficio`)
					VALUES (NULL, '$folio', '$anio', '$copiar_fasig', '0000-00-00', '$copiar_nom', '$copiar_cargo', '$copiar_iddep', '$copiar_asunto', '$copiar_solicitante', '$copiar_idarea', '0000-00-00', '1')";
// echo($sql);

			$query = mysqli_query($conexion,$sql);
			
			$id_insert=mysqli_insert_id($conexion);
			$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_oficios_acciones (id_bitacora, id_usuario, fecha_captura, id_accion, id_oficiosrio) 
												VALUES (NULL, '$id_usuario', '$fecha_hora', '1', '$id_insert')");

		}	
			
			if ($query) {

				$messages[] = "Se ha realizado $cantidad Copia(s) del registro seleccionado con éxito.";
			} else {
		
				$errors[] = "Lo sentimos, el proceso de copia del registro falló. Por favor, regrese y vuelva a intentarlo.";
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