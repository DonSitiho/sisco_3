<?php

	
	

include('fecha_actual.php');
include('conexion.php');

$id = $_POST['id-prod'];// id de la correspondencia
$proceso = $_POST['pro'];// estatus del envio del formulario

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX


switch($proceso){
  
  case 'Registro':
		

	break;
	
	case 'Edicion':

		  mysqli_query($conexion, "UPDATE datos_correspondencia SET id_estatus1=2 WHERE id_datos_c='$id' ");	
	
	break;
}

$consulta1=mysqli_query($conexion, "SELECT datos_correspondencia.id_datos_c, datos_correspondencia. fecha_cap_c, datos_correspondencia.id_estatus1 
                                    FROM datos_correspondencia 
                                    INNER JOIN estatus on estatus.id_estatus=datos_correspondencia.id_estatus1");

$pendiente=0;
$asignadosDelDia=0;
$diaAnterior=0;
$total_correspondencia=0;
$autorizado=0;

while($row1=mysqli_fetch_assoc($consulta1)){

    $total_correspondencia++;
    $fechaCap=date("Y-m-d",strtotime($row1['fecha_cap_c']));
    
    if($fechaCap == $fecha_actual){
      $asignadosDelDia++;
    }else{
      $diaAnterior++;
    }
          
    switch ($row1['id_estatus1']){
        
      case 1:
        $pendiente++;
        break;
      case 2:
        $autorizado++;
        break;

    }    
	
}

// imprimimos en nuestro div el contenido con el resutado

echo('  <div class="container-fluid">
          <div class="row">
             <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-calendar-o"></i>
                  </div>
                  <p class="card-category">C. dia Anterior</p>
                  <h3 class="card-title num">'.$diaAnterior.'</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-calendar-plus-o"></i>
                  </div>
                  <p class="card-category">C. del Día</p>
                 
                  <h3 class="card-title num">'.$asignadosDelDia.'
                    
                  </h3>
                </div>
                <div class="card-footer">
                 <div class="stats">
                    <i class="material-icons">date_range</i> Del dia
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-info-circle"></i>
                  </div>
                  <p class="card-category">C. Pendiente</p>
                  <h3 class="card-title num">'.$pendiente.'</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-check"></i>
                  </div>
                  <p class="card-category">C. Autoriada.</p>
                  <h3 class="card-title num">'.$autorizado.'</h3>
                
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Tracked from Github
                  </div>
                </div>
              </div>
            </div>          
          </div>              
        </div>       
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                 <div class="row">
                 <div class="col-md-8">
                 	<h4 class="card-title ">Correspondencia</h4>
                 	   <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
 


                  <p class="card-category"> Historial de correspondencia agregada</p>
                 </div>
                  <div class="col-md-4">
                 
                 	
                 </div>	
                 </div>
                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
                      <thead class=" text-primary">
                          <th>#</th>
                          <th>Folio</th>
                          <th>Remitenete</th>
                          <th>Asunto</th>
                          <th>Fecha R</th>                         
                          <th>Ver</th>
                      </thead>
                      <tbody>');                    
				
                      $consulta=mysqli_query($conexion, 'SELECT datos_correspondencia.*, dependencias.* 
                                                          FROM datos_correspondencia, dependencias
                                                          WHERE datos_correspondencia.id_remitente=dependencias.id_dependencia 
                                                          AND datos_correspondencia.id_estatus1=1');						  						
					  
                      while($row=mysqli_fetch_assoc($consulta)){
                        
                          $id_correspondencia=$row['id_datos_c'];							  
                          $archivos=mysqli_query($conexion,"SELECT * FROM documentos WHERE id_datos_c1 = '$id_correspondencia'");
                              
                          $c_arch=0;
                          $rutas_archivos=array();  
                          $nombres_archivo=array();

                            while($row_archivos=mysqli_fetch_assoc($archivos)){
                              $rutas_archivos[$c_arch]=$row_archivos['ruta'];
                              $nombres_archivo[$c_arch]=$row_archivos['nombre_documento'];
                              $c_arch++;                            
                            }
                          
                            echo('<tr>
                                    <td>'.($row['id_datos_c']).'</td>
                                    <td>'.$row['folio'].'</td>
                                    <td>'.$row['nombre'].'</td>
                                    <td>'.$row['f_recepcion'].'</td>
                                    <td>'.($row['asunto_destinatario']).'</td>									
                                    <td class="td-actions text-right" >
                                        <a   href="javascript:VerCorrespondencia('.$row['id_datos_c'].');" class="btn btn-default btn-link btn-sm"  title="Editar" >
                                        <button class="btn btn-default btn-round"><i class="fa fa-eye"></i></button>                              
                                    </td>						
                                  </tr>');						
                          
                      }
                       
                echo('</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>           
          </div>
        </div>
');

?>
 <script type="text/javascript">
	$(document).ready(function () {
$('#dtBasicExample').DataTable({
    "order": [ 0, 'desc' ]
});
$('.dataTables_length').addClass('bs-select');
});
</script>