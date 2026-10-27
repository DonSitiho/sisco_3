<?php

include('conexion.php');

$id_correspondencia=$_POST['id_correspondencia'];

$documento=$_FILES['documento'];
/*echo($documento["type"]);*/
if($documento["type"] == "application/pdf"){
	
	$nombre_encriptado=($documento['name']);
	$ruta='../Documentos/'.$id_correspondencia.'__'.$nombre_encriptado.'';
	move_uploaded_file($documento['tmp_name'], $ruta);
	
	$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_documento, nombre_documento, ruta, id_datos_c1) VALUES (NULL, '$nombre_encriptado',  '$ruta', '$id_correspondencia')");
	

}else{

	echo('no es un pdf');
	/*$insert_document=mysqli_query($conexion, "INSERT INTO documentos (id_doc, nombre, tipo_declaracion, year, id_usr_declaraciones) VALUES (NULL, 'Nombre', 'Inicial', '2016', '9')");*/
}
echo('
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
                      <button onClick="myFunction()" type="button" class="btn btn-round btn-secondary">Agregar Correspondencia</button>                 	
                    </div>	
                 </div>                  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dtBasicExample">
                      <thead class=" text-primary">
                          <th>#</th>
                          <th>Remitente</th>
                          <th>Cargo</th>
                          <th>Folio</th>
                          <th>Fecha Recep</th>
                          <th># Oficio</th>
                          <th>Fecha Ofi</th>
                          <th>Asunto</th> 
                          <th>Opciones</th> 
                          <th>Subir</th>
                          <th>Archivo</th>
                      </thead>
                      <tbody>');
 
                      $consulta=mysqli_query($conexion, 'SELECT datos_correspondencia.*, dependencias.* 
                                                         FROM datos_correspondencia, dependencias
                                                         WHERE datos_correspondencia.id_remitente=dependencias.id_dependencia');
                                                  
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
                              <td>'.($row['nombre']).'</td>
                              <td>'.($row['cargo']).'</td>
                              <td>'.$row['folio'].'</td>
                              <td>'.$row['f_recepcion'].'</td>
                              <td>'.$row['num_oficio'].'</td>
                              <td>'.$row['f_oficio'].'</td>
                              <td>'.($row['asunto_destinatario']).'</td>
                              <td class="td-actions text-right" >
                                  <a   href="javascript:editarProducto('.$row['id_datos_c'].');" class="btn btn-warning btn-link btn-sm"  title="Editar" >
                                      <button class="btn btn-warning btn-round"><i class="material-icons">edit</i></button></a>

                                  <a href="javascript:Elimina_producto('.$row['id_datos_c'].');"  title="Eliminar" class="btn btn-danger btn-link btn-sm">
                                      <button class="btn btn-danger btn-round"><i class="material-icons" >close</i></button></a>
                              </td>
                              <td class="td-actions text-right">
                                      <button class="btn btn-success btn-round" data-id="'.$row['id_datos_c'].'" data-toggle="modal" data-target="#exampleModal">      
                                      <i class="material-icons">cloud_upload</i></button>
                              </td>');
                                  if($c_arch>0){

                                    for($i=0; $i<$c_arch; $i++){
                                      $existencia_archivos.='<a href="'.$rutas_archivos[$i].'"  title="'.$nombres_archivo[$i].'" class="btn btn-danger btn-link btn-sm" target="_blank">
                                          <button class="btn btn-info btn-round"><i class="material-icons" >picture_as_pdf</i></button></a>';                                
                                  }

                                  }else{
                                  
                                    $existencia_archivos='---__---';
                                    
                                  }	  
                                  
                              echo(' <td class="td-actions text-right">'.$existencia_archivos.' </td>');
                          echo('</tr>');

                              $existencia_archivos='';
                                
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