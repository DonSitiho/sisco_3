<?php
	/* Connect To Database*/
require_once ("../conexion.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	
	$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$query1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query1'], ENT_QUOTES)));
	$tables="oficios_conocimiento as oc";
	$campos="oc.*";
       session_start();
	$id_direccion=$_SESSION['id_direccion'];
	$id_usuario=$_SESSION['id_usuario'];
	$nivel_acceso=$_SESSION['nivel_acceso'];
	$subdireccion = $_SESSION['subdireccion'];
	$depto = $_SESSION['depto'];
	//VERIFICAR DE QUE DIRECCION ES 
	if($id_direccion==2 && $nivel_acceso==1){
			
		$decision=' is_active = 1 AND ';
	}else{ 
		if($subdireccion == 0 or $subdireccion == NULL ){
			$decision='is_active = 1 AND id_direcciones='.$id_direccion.' AND';
		}elseif($depto == 0 or $subdireccion == NULL ){
			$decision='is_active = 1 AND id_direcciones = '.$id_direccion.' AND FIND_IN_SET('.$subdireccion.', id_subdireccion) AND';
		}else{
			$decision='is_active = 1 AND id_direcciones = '.$id_direccion.' AND FIND_IN_SET('.$depto.', id_departamento) AND';
		}
		
	} 


	if ($query==0 ){
        $sWhere= $decision." (oc.remitente LIKE '%".$query1."%' OR oc.no_oficio LIKE '%".$query1."%' OR   
        oc.fecha LIKE '%".$query1."%' OR oc.asunto LIKE '%".$query1."%' OR 
        oc.destinatario LIKE '%".$query1."%') ";
    }else{				
        $sWhere= $decision." ( oc.remitente LIKE '%".$query1."%' OR oc.no_oficio LIKE '%".$query1."%' OR   
        oc.fecha LIKE '%".$query1."%' OR oc.asunto LIKE '%".$query1."%' OR 
        oc.destinatario LIKE '%".$query1."%' ) AND (oc.id_direcciones LIKE '%".$query."%')";
    }
		$sWhere.="ORDER BY oc.id DESC ";
		
	include 'pagination.php';//include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM $tables  where $sWhere");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion,"SELECT * FROM $tables  where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	
	if ($numrows>0){
	?>
		<div class="card">
                    <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm table-hover table-bordered">
				<thead>
				<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
					<tr class="text-center">
						<!--<th class='text-center'>Tipo</th>-->						
							<th>nº_oficio</th>
						<th>remitente</th>
						<th>fecha</th>
						<th>destinatario</th>
						<th>Tipo_documento</th>
						<th>Direccion</th>
						<th>Opciones</th>
						<!--<th class='text-center' colspan="3">Asunto</th>-->
				<!--		<th class='text-center' colspan="6">Opciones</th>-->
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){
							$id=$row['id'];
							$remitente = $row['remitente'];
							$no_oficio = $row['no_oficio'];
							$fecha     = $row['fecha'];
							$asunto    = $row['asunto'];
							$destinatario = $row['destinatario'];
							$id_direcciones = $row['id_direcciones'];
							$id_dependencia = $row['id_dependencia'];
							$id_original = $row['doc_original'];
							$tipo = $row['tipo_documento'];
							$ofi_status = $row['ofi_status'];
                            $fecha_captura = $row['fecha_captura'];
                            $nomRevisor = $row['nom_revisor'];
							$fechaRevisor = $row['fecha_revisado'];
							$revisado = $row['revisado'];
							$tipo_destino = $row['t_destino'];
							$concopia1=$row['copias_direcciones'];
							$copias_view = $row['copias_view'];
							$original_view = $row['original_view'];

							$copias_array = explode(",",$concopia1);
							$copias_view_array = explode(",",$copias_view);
							$array_num = count($copias_array);
							$direcciones_copias = "";

							for ($i = 0; $i < $array_num; ++$i){
								$consulta_direcciones_copia=mysqli_query($conexion, "SELECT nombre_direccion FROM direcciones_secoem WHERE id_direccion='$copias_array[$i]'");
								$rowDireccionCopia=mysqli_fetch_assoc($consulta_direcciones_copia);
								$textoView = ( $copias_view_array[$i] == '0') ? " <span class='badge badge-secondary'> No se ha vizualizado </span>" : " <span class='badge badge-info'> ".$copias_view_array[$i]." </span>";
								$NombreDireccionCopia = $rowDireccionCopia['nombre_direccion'].$textoView;
								$direcciones_copias .= $NombreDireccionCopia."<br>";
							}

							//Verificar direcciones (COPIA ORIGINAL)
							// CONVERTIMOS A ARRAY

							
							$original_view_array = explode(",",$id_original);
							$original_view = explode(",",$original_view);
							$direcciones_original  = "";
							
							$c = 0;
							foreach($original_view_array as $fila){
								
								$consulta_direcciones_original=mysqli_query($conexion, "SELECT nombre_direccion FROM direcciones_secoem WHERE id_direccion='$fila'");
								$rowDireccionOriginal=mysqli_fetch_assoc($consulta_direcciones_original);
								$textoView = ( $original_view[$c] == '0'  ) ? " <span class='badge badge-secondary'> No se ha vizualizado </span>" : " <span class='badge badge-info'> ".$original_view[$c]." </span>";
								$NombreDireccionOriginal = $rowDireccionOriginal['nombre_direccion'].$textoView;
								$direcciones_original .= $NombreDireccionOriginal."<br>";
								$c++;
							}
                           

							$consulta_direcciones=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion = '$id_direcciones'");
							$rowDireccion=mysqli_fetch_assoc($consulta_direcciones);
							$NombreDireccion=$rowDireccion['nombre_direccion'];

							$consulta_dependencia=mysqli_query($conexion, "SELECT * FROM dependencias WHERE id_dependencia='$id_dependencia'");
							$rowDependencia=mysqli_fetch_assoc($consulta_dependencia);
							$Nombre_dependencia=$rowDependencia['nombre'];

							if($id_original != null){
								$consulta_original=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion='$id_original'");
								$rowOriginal=mysqli_fetch_assoc($consulta_original);
								$Nombre_original=$rowOriginal['nombre_direccion'];
								$finales++;
							}else{
								$Nombre_original = "";
							}

							if($revisado == 1){
								$imagen_revisado = "TITULAR: <span class='badge badge-success'>Revisado por: ".$nomRevisor."  el ".date("d/m/Y H:i:s", strtotime($fechaRevisor))."</span>";
							}else{
								
								$imagen_revisado = "TITULAR: <span class='badge badge-secondary'>No se ha visualizado</span>";
							}                            
							
							?>
						<tr class="text-center" style="font-size: 92% !important;">
						<td class="text-danger"><?=$no_oficio?>
							
							<!-- <?=$imagen_revisado ?> -->
							</td>
							<td class="text-center"><?=$remitente?></td>
							<td ><?=$fecha?></td>
							<td ><?=$destinatario?></td>
							<td ><?=$tipo?></td>
							<td ><?=$NombreDireccion?></td>
							<td>
							<?php
							if($revisado == 0){
							?>
							
							  <a href="#" class="badge badge-danger" style="border-radius: 25px !important;"
                                onclick="EliminarRegistro('<?php echo $id;?>');">Eliminar Registro </a>

								
							  <a href="#" class="badge badge-warning"  data-target="#EditOficio" data-toggle="modal" 
								data-vremitente="<?php echo $remitente;?>" 
								data-voficio="<?php echo $no_oficio;?>" 
								data-vfecha="<?php echo $fecha;?>" 
								data-vasunto="<?php echo $asunto;?>" 
								data-vdestinatario="<?php echo $destinatario;?>" 
								data-vtipo="<?php echo $tipo;?>" 
								data-vid="<?php echo $id;?>" onclick="mostrararchivos1('<?php echo $id;?>');">Editar Información</a>	
							<?php } ?>
								<a href="#" class="badge badge-primary"  data-target="#viewCorrespondenciaModalCopia" data-toggle="modal" 
								data-vremitente="<?php echo $remitente;?>" 
								data-voficio="<?php echo $no_oficio;?>" 
								data-vfecha="<?php echo $fecha;?>" 
								data-vasunto="<?php echo $asunto;?>" 								
								data-vtipodest="<?php echo $tipo_destino;?>" 								
								data-vdestinatario="<?php echo $destinatario;?>" 
								data-vnombredestino="<?php echo $Nombre_direccion ?? '';?>" 
								data-adireccionescopia="<?php echo $direcciones_copias;?>" 
								data-adireccionesoriginal="<?php echo $direcciones_original;?>"  
								data-titularview="<?php echo $imagen_revisado;?>" 
								data-vnombredep="<?php echo $Nombre_dependencia;?>" 
								data-vnombreoriginal="<?php echo $Nombre_original;?>" 
								data-vtipo="<?php echo $tipo;?>" 
								data-vid="<?php echo $id;?>" onclick="mostrararchivos('<?php echo $id;?>');">Ver información</a>						
							</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan='12'>  
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros originales";										
								?>
							</td>
						</tr>
						<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			     </table>
                      </div>
                    </div>
                  </div>	
	<?php	
	}	
}
?> 
<script>
	function mostrararchivos(id) {
		$.ajax(
				{
					url: '../../html/Direcciones/mostrar_doc_conocimiento.php?id='+id,
					success: function( data ) {
						$('#resultados1').html(data);
					}
				}
			)
}
</script>
<script>
	function mostrararchivos1(id) {
	
		$.ajax(
				{
					url: '../../html/Direcciones/mostrar_doc_conocimiento.php?id='+id,
					success: function( data ) {
						$('#resultados1C').html(data);
						
					}
				}
			)
		
}

function EliminarRegistro(id) {
    //  alert(idArchivo);
    // var idArchivo = idArchivo;
    var url = '../../ajax/Direcciones/eliminarRegistro.php?id=:id';
    url = url.replace(':id', id);
    //url = url.replace(':idArchivo', idArchivo);



    swal({
            title: '¿Estas Seguro?',
            text: 'Una vez eliminado, no podrá recuperar este archivo !',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal('Una vez eliminado, no podrá recuperar este archivo!', {
                        icon: 'success',

                    }),
                    $.ajax({
                        url: url,
                        type: 'get',
                    });
                setInterval(varName, 2000); //Retrasar 10 segundos la funcion
            } else {
                swal('Tu registro está a salvo!');
            }
        });
}
</script>
<!--<script>
function enviarid()
{
valor="<?php echo $corres_id ?? '';?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
}
</script>-->