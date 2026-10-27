<?php
include('conexion.php');
$sql=' ';



if($_POST['datoSuc']!=' ' && $_POST['desde']!=''  && $_POST['hasta']!='' ){
	
	echo('opcion1');
	
	$suc=$_POST['datoSuc'];
	$desde = $_POST['desde'];
  $hasta = $_POST['hasta'];
	
	$consulta= mysqli_query($conexion, "SELECT datos_correspondencia.*, dependencias.*, direcciones_secoem.*
                                      FROM datos_correspondencia, dependencias, direcciones_secoem										 
                                      WHERE (datos_correspondencia.f_recepcion BETWEEN '$desde' AND '$hasta')
										                  AND  datos_correspondencia.id_remitente = '$suc' 
										                  AND datos_correspondencia.id_remitente = dependencias.id_dependencia
										                  AND direcciones_secoem.id_direccion=datos_correspondencia.id_direcciones");
	
echo ' <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                 <div class="row">
                    <div class="col-md-8">
                 	   <h4 class="card-title ">Correspondencia</h4>
                 	   <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                      <p class="card-category"> Historial de correspondencia agregada</p>
                    </div>
                  <div class="col-md-4">
                 <!--	<button onClick="myFunction()" type="button" class="btn btn-round btn-secondary">Agregar Correspondencia</button>-->                 	
                 </div>	
                 </div>                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
                      <thead class=" text-primary">                        
                          <th>Folio Recepcion</th>
                          <th>Dependencia</th>
                          <th>Numero de oficio / Fecha de Emisión</th>
                          <th>Destinatario</th>
                          <th>Asunto</th>
                          <th>Turnado/Instrucciones/Anexos</th>
                      </thead>
                      <tbody>';

							  while($row=mysqli_fetch_assoc($consulta)){
							 
							    echo('<tr>
                      <td>'.($row['folio']).'<br>
                          '.$row['f_recepcion'].'</td>
                    
                      <td>'.$row['nombre'].'</td>
                        
                      <td>'.$row['num_oficio'].'<br>
                          '.$row['f_oficio'].'</td>
                        
                      <td>'.$row['nombre'].'</td>
                        
                      <td>'.$row['asunto_destinatario'].'</td>
                        
                      <td>'.$row['nombre_direccion'].'<br>
                          '.$row['instrucciones_direcciones'].'<br>
                          '.$row['anexo_destinatario'].'</td>
									   
                  </tr>');
							 
						    }
						                      
                echo'</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>           
          </div>
        </div>';
	
	
}elseif($_POST['datoSuc']!=' ' && $_POST['desde']!=''){
  
  echo('opcion2.1');
	$suc=$_POST['datoSuc'];
	$desde = $_POST['desde'];	
	$consulta= mysqli_query($conexion, "SELECT datos_correspondencia.*, dependencias.*, direcciones_secoem.*	
                                      FROM datos_correspondencia, dependencias, direcciones_secoem										 
                                      WHERE (datos_correspondencia.f_recepcion = '$desde')
                                      AND  datos_correspondencia.id_remitente = '$suc' 
                                      AND datos_correspondencia.id_remitente = dependencias.id_dependencia
                                      AND direcciones_secoem.id_direccion=datos_correspondencia.id_direcciones");
	
echo ' <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                 <div class="row">
                    <div class="col-md-8">
                 	   <h4 class="card-title ">Correspondencia</h4>
                 	   <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                      <p class="card-category"> Historial de correspondencia agregada</p>
                    </div>
                  <div class="col-md-4">
                 <!--	<button onClick="myFunction()" type="button" class="btn btn-round btn-secondary">Agregar Correspondencia</button>-->
                 	
                 </div>	
                 </div>
                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
                      <thead class=" text-primary">                        
                          <th>Folio Recepcion</th>
                          <th>Dependencia</th>
                          <th>Numero de oficio / Fecha de Emisión</th>
                          <th>Destinatario</th>
                          <th>Asunto</th>
                          <th>Turnado/Instrucciones/Anexos</th>
                      </thead>
                      <tbody>';
						  
							  while($row=mysqli_fetch_assoc($consulta)){
							 
                  echo('<tr>
                      <td>'.($row['folio']).'<br>
                          '.$row['f_recepcion'].'</td>
                      
                      <td>'.$row['nombre'].'</td>
                          
                      <td>'.$row['num_oficio'].'<br>
                          '.$row['f_oficio'].'</td>
                          
                      <td>'.$row['nombre'].'</td>
                          
                      <td>'.$row['asunto_destinatario'].'</td>
                          
                      <td>'.$row['nombre_direccion'].'<br>
                          '.$row['instrucciones_direcciones'].'<br>
                          '.$row['anexo_destinatario'].'</td>
                      
                  </tr>');
							 
						    }
						 
                       
                echo'</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>           
          </div>
        </div>';
	
}elseif($_POST['desde']!='' && $_POST['hasta']!=''){
  
  echo('opcion2');	
	  $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
	
		$consulta= mysqli_query($conexion, "SELECT datos_correspondencia.*, dependencias.*, direcciones_secoem.*	
                                         FROM datos_correspondencia, dependencias, direcciones_secoem										 
                                         WHERE (datos_correspondencia.f_recepcion BETWEEN '$desde' AND '$hasta')										
                                         AND datos_correspondencia.id_remitente = dependencias.id_dependencia
                                         AND direcciones_secoem.id_direccion=datos_correspondencia.id_direcciones");
		
echo ' <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                 <div class="row">
                    <div class="col-md-8">
                 	   <h4 class="card-title ">Correspondencia</h4>
                 	   <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                      <p class="card-category"> Historial de correspondencia agregada</p>
                    </div>
                  <div class="col-md-4">
                 <!--	<button onClick="myFunction()" type="button" class="btn btn-round btn-secondary">Agregar Correspondencia</button>-->                 	
                 </div>	
                 </div>                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
                      <thead class=" text-primary">                        
                          <th>Folio Recepcion</th>
                          <th>Dependencia</th>
                          <th>Numero de oficio / Fecha de Emisión</th>
                          <th>Destinatario</th>
                          <th>Asunto</th>
                          <th>Turnado/Instrucciones/Anexos</th>
                      </thead>
                      <tbody>';
                       						  
							  while($row=mysqli_fetch_assoc($consulta)){
							 
                    echo('<tr>
                      <td>'.($row['folio']).'<br>
                          '.$row['f_recepcion'].'</td>
                      
                      <td>'.$row['nombre'].'</td>
                          
                      <td>'.$row['num_oficio'].'<br>
                          '.$row['f_oficio'].'</td>
                          
                      <td>'.$row['nombre'].'</td>
                          
                      <td>'.$row['asunto_destinatario'].'</td>
                          
                      <td>'.$row['nombre_direccion'].'<br>
                          '.$row['instrucciones_direcciones'].'<br>
                          '.$row['anexo_destinatario'].'</td>                          
                          
                    </tr>');
							 
						    }

                echo'</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>           
          </div>
        </div>';
	
}elseif($_POST['datoSuc']!=' '){
	echo('opcion3');
    
    $suc=$_POST['datoSuc'];
    
    $consulta= mysqli_query($conexion, "SELECT datos_correspondencia.*, dependencias.*
                                        FROM datos_correspondencia, dependencias
                                        WHERE datos_correspondencia.id_remitente = '$suc' 
                                        AND datos_correspondencia.id_remitente = dependencias.id_dependencia");
    
    $consulta= mysqli_query($conexion, "SELECT datos_correspondencia.*, dependencias.*, direcciones_secoem.*    
                                        FROM datos_correspondencia, dependencias, direcciones_secoem                      
                                        WHERE  datos_correspondencia.id_remitente = '$suc' 
                                        AND datos_correspondencia.id_remitente = dependencias.id_dependencia
                                        AND direcciones_secoem.id_direccion=datos_correspondencia.id_direcciones");
	
echo ' <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                 <div class="row">
                    <div class="col-md-8">
                 	   <h4 class="card-title ">Correspondencia</h4>
                 	   <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                      <p class="card-category"> Historial de correspondencia agregada</p>
                    </div>
                  <div class="col-md-4">
                 <!--	<button onClick="myFunction()" type="button" class="btn btn-round btn-secondary">Agregar Correspondencia</button>-->
                 	
                 </div>	
                 </div>
                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
                      <thead class=" text-primary">                        
                          <th>Folio Recepcion</th>
                          <th>Dependencia</th>
                          <th>Numero de oficio / Fecha de Emisión</th>
                          <th>Destinatario</th>
                          <th>Asunto</th>
                          <th>Turnado/Instrucciones/Anexos</th>
                      </thead>
                      <tbody>';
						  
                      while($row=mysqli_fetch_assoc($consulta)){
                    
                      echo('<tr>

                        <td>'.($row['folio']).'<br>
                            '.$row['f_recepcion'].'</td>
                        
                        <td>'.$row['nombre'].'</td>
                            
                        <td>'.$row['num_oficio'].'<br>
                            '.$row['f_oficio'].'</td>
                            
                        <td>'.$row['nombre'].'</td>
                            
                        <td>'.$row['asunto_destinatario'].'</td>
                            
                        <td>'.$row['nombre_direccion'].'<br>
                            '.$row['instrucciones_direcciones'].'<br>
                            '.$row['anexo_destinatario'].'</td>
                            
                            
                      </tr>');
                    
                    }
						 
                       
                echo'</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>           
          </div>
        </div>';
	
	
}elseif($_POST['desde']!=''){

	echo('opcion4');
	
    $desde = $_POST['desde'];
      
    $consulta= mysqli_query($conexion, "SELECT datos_correspondencia.*, dependencias.*, direcciones_secoem.*    
                                        FROM datos_correspondencia, dependencias, direcciones_secoem                      
                                        WHERE (datos_correspondencia.f_recepcion = '$desde')                      
                                        AND datos_correspondencia.id_remitente = dependencias.id_dependencia
                                        AND direcciones_secoem.id_direccion=datos_correspondencia.id_direcciones");    
	
echo ' <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                 <div class="row">
                    <div class="col-md-8">
                 	   <h4 class="card-title ">Correspondencia</h4>
                 	   <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                      <p class="card-category"> Historial de correspondencia agregada</p>
                    </div>
                  <div class="col-md-4">
                 <!--	<button onClick="myFunction()" type="button" class="btn btn-round btn-secondary">Agregar Correspondencia</button>-->
                 	
                 </div>	
                 </div>
                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
                      <thead class=" text-primary">                        
                          <th>Folio Recepcion</th>
                          <th>Dependencia</th>
                          <th>Numero de oficio / Fecha de Emisión</th>
                          <th>Destinatario</th>
                          <th>Asunto</th>
                          <th>Turnado/Instrucciones/Anexos</th>
                      </thead>
                      <tbody>';
						  
                      while($row=mysqli_fetch_assoc($consulta)){
                    
                        echo('<tr>
                            <td>'.($row['folio']).'<br>
                                '.$row['f_recepcion'].'</td>
                        
                            <td>'.$row['nombre'].'</td>
                            
                            <td>'.$row['num_oficio'].'<br>
                                '.$row['f_oficio'].'</td>
                            
                            <td>'.$row['nombre'].'</td>
                            
                            <td>'.$row['asunto_destinatario'].'</td>
                            
                            <td>'.$row['nombre_direccion'].'<br>
                                '.$row['instrucciones_direcciones'].'<br>
                                '.$row['anexo_destinatario'].'</td>
                                                      
                        </tr>');
                      
                      }						 
                       
                echo'</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>           
          </div>
        </div>';
}		  


// Realizar la lógica de la consulta

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

?>
<script src="../Export_table/jquery-1.12.4.min.js"></script>
<script src="../Export_table/FileSaver.min.js"></script>
<script src="../Export_table/Blob.min.js"></script>
<script src="../Export_table/xls.core.min.js"></script>
<script src="../Export_table/dist/js/tableexport.js"></script>
<script>
$("table").tableExport({
	formats: ["xlsx","txt", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Reporte_correspondencia",    //Nombre del archivo 
});
</script>