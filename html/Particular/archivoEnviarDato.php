<?php
    
    //Procedimiento a realizar
if(isset($_GET['id'])){
$id_corres=$_GET['id'];	
include('../conexion.php');
	
	echo'  <div class="card" style="border-radius:25px !important;">
                    
                   
                    <div class="card-body">
                      <div class="table-responsive">  
                       <div class="card-header text-center notice notice-danger redondeo-center" ><h3 style="color: rgba(8,16,104,1.00)">Archivos Adjuntos</h3></div>
                        <table class="table table-striped table-sm">
                          <thead style="border-radius: 25px !important;">
                            <tr>
                             
                              <th class="text-center">Nombre del Archivo</th>
                              <th class="text-center">Ver Archivo</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                           ';
                              
                            
                           
	
	
	
	
	$consulta_archivos=mysqli_query($conexion,"SELECT * FROM documentos WHERE id_datos_c1='$id_corres'");
	
	$num_rows = mysqli_num_rows($consulta_archivos);
	

	
	if ($num_rows!=0){
		echo('<center>');
	while($obtener_Datos=mysqli_fetch_assoc($consulta_archivos)){
		echo' <tr>
		<td class="text-center">'.$obtener_Datos['nombre_documento'].'</td>
                              <td class="text-center"> <ul class="list-unstyled"> <li class="active"><a title="'.$obtener_Datos['nombre_documento'].'" href="../'.$obtener_Datos['ruta'].'" target="_blank"><img src="../../images/pdf.ico" width="13%;" alt="'.$obtener_Datos['nombre_documento'].'" /></a></li><ul></ul></td>
							  </tr>';
		
		
		
		
	}
		echo' 
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>';
}else{
echo "<center><h7>No hay archivos vinculados a esta correspondencia</h7></center>";
}	
	
}else{
	echo('Error en la funcion mostrararchivos no llego el id > listar.php');
}



?>