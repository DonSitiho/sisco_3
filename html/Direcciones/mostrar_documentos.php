<?php

//Procedimiento a realizar
if (isset($_GET['id'])) {
	$id_corres = $_GET['id'];
	include('../conexion.php');

	//Proceso para eliminar Archivo
	if (isset($_GET['idArchivo'])) {
		$id_docs = intval($_GET['idArchivo']);
		// echo 'ENTRO'	.$id_docs;

		$consulta_docs = mysqli_query($conexion, "UPDATE docs_finalizados SET is_active = 0 WHERE id_docs='$id_docs'");
		echo $consulta_docs;
	} else {
		echo "no llego eliminar";
	}

	//CONSULTAR LOS DOCUMENTOS DE LA CORRESPONDENCIA
	$consulta_archivos = mysqli_query($conexion, "SELECT * FROM documentos WHERE id_datos_c1='$id_corres'");
	$num_rows = mysqli_num_rows($consulta_archivos);
	//CONSULTAR LOS DOCUMENTOS FINALIZADOS
	$consulta_docs = mysqli_query($conexion, "SELECT * FROM docs_finalizados WHERE id_corresp1='$id_corres' AND is_active = 1");
	$num_rows_docs = mysqli_num_rows($consulta_docs);
	//fecha actual

	echo ('<div class="row">
	<div class="col-md-12">
		<div class="card" style="border-radius:25px !important;">


			<div class="card-body">
				<div class="card-header text-center notice notice-danger redondeo-center">
					<h3 style="color: rgba(8,16,104,1.00)">Archivos Adjuntos</h3>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="table-responsive">
							<h3 style="color: rgba(8,16,104,1.00)" class="text-center">Correspondencia</h3>
							<table class="table table-striped table-sm">
								<thead style="border-radius: 25px !important;">
									<tr>

										<th class="text-center">Nombre del Archivo</th>
										<th class="text-center">Ver Archivo</th>

									</tr>
								</thead>
								<tbody>');
	if ($num_rows != 0) {

		while ($obtener_Datos = mysqli_fetch_assoc($consulta_archivos)) {
			echo ('<tr>
										<td class="text-center">' . $obtener_Datos['nombre_documento'] . '</td>
										<td class="text-center">
											<ul class="list-unstyled">
												<li class="active"><a title="' . $obtener_Datos['nombre_documento'] . '" href="../' . $obtener_Datos['ruta'] . '" target="_blank"><img src="../../images/pdf.ico" width="20%;" alt="' . $obtener_Datos['nombre_documento'] . '" /></a>
												</li>
												<ul></ul>
										</td>
									</tr>');
			//imprimir en pantalla los documentos finalizados

		}

		echo ('
								</tbody>
							</table>
						</div>
					</div>');
	} else {
		echo "<center><h7>No hay archivos vinculados a esta correspondencia</h7></center>";
	}
	echo ('

					<div class="col-md-6">
						<div class="table-responsive">
							<h3 style="color: rgba(8,16,104,1.00)" class="text-center">Respuestas</h3>
							<table class="table table-striped table-sm">
								<thead style="border-radius: 25px !important;">
									<tr>

										<th class="text-center">Nombre del Archivo</th>
										<th class="text-center">Vista previa / Eliminar Archivo</th>

									</tr>
								</thead>
								<tbody>');
	if ($num_rows_docs != 0) {

		while ($obtener_Datos_docs = mysqli_fetch_assoc($consulta_docs)) {
			//var_dump($obtener_Datos_docs);
			echo ('	<tr>
										<td class="text-center">' . $obtener_Datos_docs['nombre_docs'] . '</td>
										<td class="text-center">

										<div class="row">
										   <div class="col-md-6">
										     
										          <a title="' . $obtener_Datos_docs['nombre_docs'] . '" href="' . $obtener_Datos_docs['ruta_docs'] . '" target="_blank"><img src="../../images/pdf.ico" width="50%;" alt="' . $obtener_Datos_docs['nombre_docs'] . '" /></a>
										      
										   </div>
										   <div class="col-md-6">
										     
											       <a title="Eliminar Archivo" onclick="deleteFile(' . $id_corres . ',' . $obtener_Datos_docs['id_docs'] . ')" href="#"><img src="../../images/delete.png" width="50%;" alt="' . $obtener_Datos_docs['nombre_docs'] . '" /></a>
										      
											</div>
										 </div>
											
										</td>
									</tr>');
		}

		echo ('
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>');
	} else {
		echo "<center><h7>No hay archivos de finalizacion</h7></center>";
	}
	echo (' </div>
	      </div>');
} else {
	echo ('Error en la funcion mostrararchivos no llego el id > listar.php');
}

//echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo "<script>

function deleteFile(id,idArchivo){
   //  alert(idArchivo);
   // var idArchivo = idArchivo;
	var url = '../../html/Direcciones/mostrar_documentos.php?id=:id&idArchivo=:idArchivo';
	url = url.replace(':id', id);
	url = url.replace(':idArchivo', idArchivo);
	
	Swal.fire({
		title: '¿Estás seguro?',
		text: 'Una vez eliminado, no podrás recuperar este archivo.',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar',
		cancelButtonText: 'Cancelar',
		confirmButtonColor: '#d33',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  $.ajax({
				url: url,
				type: 'get',
				success: function(data){
					$('#resultados1').html(data);
					Swal.fire({ title: '¡Su archivo ha sido eliminado!', icon: 'success' });
				},
				error: function(){
					Swal.fire({ title: 'No se pudo eliminar el archivo', text: 'Inténtelo de nuevo.', icon: 'error' });
				}
		});
		} else {
		  Swal.fire('¡Tu archivo está a salvo!');
		}
	  });
}
</script>";
