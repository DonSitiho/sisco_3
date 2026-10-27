<?php
include('../php/conexion.php');

$datoDep = $_POST['datoDep'];

// Preparar la sentencia

$datoDep=utf8_decode($datoDep);



//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo ' <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
<table class="table table-sm table-hover">
  <thead style="background-color:lightskyblue;">
    <tr>
     <th scope="col" class="text-gray-800">RFC</th>
      <th scope="col" class="text-gray-800 text-center">AÑO</th>
       <th scope="col" class="text-gray-800 text-center">SITUACION</th>
         <th scope="col" class="text-gray-800 text-center">Tipo declaracion</th>
         <th scope="col" class="text-gray-800 text-center">Opcion</th>
     
     
    </tr>
  </thead>
  <tbody>';



	$consulta=mysqli_query($conexion,"select RFC_SO, ID_TIPO_DECLARACION, ANIO_DECLARACION, SITUACION, NO_DECLARACION from declaraciones_existentes WHERE RFC_SO LIKE '%$datoDep%' AND ANIO_DECLARACION=2020 AND SITUACION='P' AND ID_TIPO_DECLARACION=2 limit 10");

         while($row=mysqli_fetch_assoc($consulta)){
			 $num=$row['NO_DECLARACION'];
			 $COMPARADOR=$row['RFC_SO'];
			 $padron=$row['ANIO_DECLARACION'];
			 $situacion=$row['SITUACION'];
			 $tipo=$row['ID_TIPO_DECLARACION'];
			 
			  $SQL1=mysqli_query($conexion,"SELECT 
RFC_SO, ANIO_DECLARACION, SITUACION 

FROM declaraciones_existentes 

WHERE ANIO_DECLARACION=2020 AND SITUACION='P' AND RFC_SO='$COMPARADOR'
");
			 $declaraciones=0;
			 while($inf=mysqli_fetch_assoc($SQL1)){
				 $declaraciones++;
				
			 }
	  

	
			 
				  echo '<tr>
                        <td class="text-gray-800">'.$COMPARADOR.'</td>
                        <td class="text-gray-800 text-center">'.$padron.' </td>
                         <td class="">'.$situacion.'</td>
						 <td>'.$tipo.'</td>
						 	 <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="alumno" onclick="eliminarDatos('.$num.');"">
  editar
</button></td>
                    </tr>'; 
			}
	

echo '</tbody>
</table>
</div>
<div class="col-md-1"></div>
</div>';

?>