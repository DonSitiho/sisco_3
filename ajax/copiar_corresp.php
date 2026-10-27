<?php
if(isset($_POST['id-corr']) && isset($_POST['cantidad'])){
	
	require_once ("conexion.php");
	
	date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha_actual=date("Y-m-d");
    $fecha_hora=date("Y-m-d H:i:s"); 
	
	/*$identificado=141;
	$cantidad=1;*/
	//$id_usuario=$_POST['id_usuario_c'];
	$identificado=$_POST['id-corr'];
	$cantidad=$_POST['cantidad'];

	//echo $identificado, $id_usuario, $cantidad;

	//******ACTUALIZACION 24-01-2022 */
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	} 
	$idUsuario = $_SESSION['id_usuario'];
	$nomUsuario = $_SESSION['nombre'];
    //******ACTUALIZACION 24-01-2022 */

	$copiar_datos=mysqli_query($conexion, "SELECT * FROM datos_correspondencia WHERE id_datos_c ='$identificado' ");
		
		while($campos_c=mysqli_fetch_assoc($copiar_datos)){
			
			$copiar_folio=$campos_c['folio'];		
			$copiar_frecep=$campos_c['f_recepcion'];
			$copiar_numofi=$campos_c['num_oficio'];
			$copiar_fofi=$campos_c['f_oficio'];
			$copiar_tofi=$campos_c['tipo_oficio'];

			if($copiar_tofi==0){
				$copiar_idrmte = $campos_c["id_remitente"];
				$copiar_cargormte = $campos_c["cargo"];
				$copiar_nombrermte = $campos_c["Nombre"];	
				$copiar_iddest = 0;
				$copiar_cargodest ='Lic. Francisco Ramírez Flores, Secretario de Contraloría';
				
			}elseif($copiar_tofi==1){
				$copiar_idrmte= $campos_c["id_remitente"];
				$copiar_cargormte= $campos_c["cargo"];
				$copiar_nombrermte = $campos_c["Nombre"];
				$copiar_iddest =$campos_c['id_destinatarios'];
				$copiar_cargodest = $campos_c['cargo_destinatario'];
			}
   
			$copiar_asunto= mysqli_real_escape_string($conexion,(strip_tags($campos_c['asunto_destinatario'],ENT_QUOTES)));
			$copiar_anexo=$campos_c['anexo_destinatario'];
			$copiar_indica=$campos_c['indicaciones_destinatario'];
			$copiar_area=$campos_c['id_direcciones'];
			$copiar_fturnado=$campos_c['f_turnado'];
			$copiar_freceparea=$campos_c['f_recepArea'];
			$copiar_instruc=$campos_c['instrucciones_direcciones'];
			$copiar_obs=$campos_c['leyenda_destinatario'];			
			$copiar_idestatus=$campos_c['id_estatus1'];
			$copiar_fcaptcorres=$campos_c['fecha_cap_c'];

			
		/*	echo(' :'.' '.$instrucciones_direcciones.' ');*/
		
		}
		
		
		for($i=1; $i<=$cantidad; $i++){		
				
			//$sacar_ultimofolio=mysqli_query($conexion, "SELECT * FROM datos_correspondencia ORDER BY id_datos_c DESC limit 1");
			//$imprimefolio=mysqli_fetch_assoc($sacar_ultimofolio);
			$sql1="SELECT max(`folio`) as nofi FROM datos_correspondencia";			
			$result = $conexion->query($sql1);
			$fila = $result->fetch_assoc();
			$ultimofolio = $fila['nofi'];
			$nuevofolio = explode ("/", $ultimofolio);
			$newfolio= $nuevofolio[1]; 
			$nofolio=(int)$newfolio;
			$nofolio=$nofolio+1;
			$consec=1;
			$anio = $nuevofolio[0];

			if ($nofolio<10){
				$folio=$anio.'/'.'0000'.$nofolio.'/0'.$consec;
				$folio=ltrim($folio);
			}
			elseif($nofolio>=10 && $nofolio<100){
				$folio=$anio.'/'.'000'.$nofolio.'/0'.$consec;
				$folio=ltrim($folio);
			}
			elseif($nofolio>=100 && $nofolio<1000){
				$folio=$anio.'/'.'00'.$nofolio.'/0'.$consec;
				$folio=ltrim($folio);
			}
			elseif($nofolio>=1000 && $nofolio<10000){
				$folio=$anio.'/'.'0'.$nofolio.'/0'.$consec;
				$folio=ltrim($folio);
			}
			elseif ($nofolio>9999){
				$folio=$anio.'/'.$nofolio.'/0'.$consec;
				$folio=ltrim($folio);    
			}						
			
			$busca_archivo = mysqli_query($conexion, "SELECT * FROM documentos WHERE id_datos_c1=$identificado");

			
		
				
				$sql = "	INSERT INTO `datos_correspondencia` (`id_datos_c`, `id_user`, `nom_capturista`, `folio`, `f_recepcion`, `tipo_oficio`, `id_remitente`, 
										`cargo`, `Nombre`, `num_oficio`, `f_oficio`, `id_destinatarios`, `cargo_destinatario`, `asunto_destinatario`,
										`indicaciones_destinatario`, `anexo_destinatario`, `leyenda_destinatario`, `id_direcciones`, `f_turnado`, 
										`instrucciones_direcciones`, `f_recepArea`, `id_estatus1`, `fecha_cap_c`, `fecha_finalizacion`) 
							VALUES (NULL, $idUsuario, '$nomUsuario', '$folio', '$copiar_frecep', '$copiar_tofi', '$copiar_idrmte', '$copiar_cargormte', '$copiar_nombrermte', '$copiar_numofi', '$copiar_fofi', 
										'$copiar_iddest', '$copiar_cargodest', '$copiar_asunto', '$copiar_indica', '$copiar_anexo', '$copiar_obs', '$copiar_area', '$copiar_fturnado',
										'$copiar_instruc', '0000-00-00 00:00:00', '1', '$fecha_hora', '0000-00-00 00:00:00')";
							
				/* $id_insert=mysqli_insert_id($conexion);
				$bitacora=mysqli_query($conexion, "INSERT INTO bitacora_captura (id_bitacora, id_usuario1, fecha_cap, id_accion1, id_correspondencia1) 
				VALUES (NULL, '$id_usuario', '$fecha_hora', '6', '$id_insert')");*/
				
				$query = mysqli_query($conexion, $sql);

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