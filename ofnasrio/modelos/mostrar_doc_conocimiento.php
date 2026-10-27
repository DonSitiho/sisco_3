<?php
    
    //Procedimiento a realizar
if(isset($_GET['id'])){
$id_corres=$_GET['id'];	
include('../conexion/conexion.php');
	
	//CONSULTAR LOS DOCUMENTOS DE LA CORRESPONDENCIA
	$consulta_archivos=mysqli_query($conexion,"SELECT * FROM docs_conocimiento WHERE id_ofi_conocimiento='$id_corres'");
	$num_rows = mysqli_num_rows($consulta_archivos);
	//CONSULTAR LOS DOCUMENTOS FINALIZADOS
	
	//fecha actual
	
	echo('<div class="row">
	<div class="col-md-12">
		<div class="card" style="border-radius:25px !important;">


			<div class="card-body">
				<div class="card-header text-center notice notice-danger redondeo-center">
					<h3 style="color: rgba(8,16,104,1.00)">Archivos Adjuntos</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							
							<table class="table table-striped table-sm">
								<thead style="border-radius: 25px !important;">
									<tr>

										<th class="text-center">Nombre del Archivo</th>
										<th class="text-center">Ver Archivo</th>

									</tr>
								</thead>
								<tbody>');
	if ($num_rows!=0){
		
	while($obtener_Datos=mysqli_fetch_assoc($consulta_archivos)){
		echo('<tr>
										<td class="text-center">'.$obtener_Datos['nombre'].'</td>
										<td class="text-center">
											<ul class="list-unstyled">
												<li class="active"><a title="'.$obtener_Datos['nombre'].'" href="'.$obtener_Datos['ruta'].'" target="_blank"><img src="../../images/pdf.ico" width="13%;" alt="'.$obtener_Datos['nombre'].'" /></a>
												</li>
												<ul></ul>
										</td>
									</tr>');
		//imprimir en pantalla los documentos finalizados

	}
		
		echo('
								</tbody>
							</table>
						</div>
					</div>');
}else{
echo "<center><h7>No hay archivos vinculados a esta correspondencia</h7></center>";
}
									
		
		  echo(' </div>
	      </div>');

	
}else{
	echo('Error en la funcion mostrararchivos no llego el id > listar.php');
}



?>