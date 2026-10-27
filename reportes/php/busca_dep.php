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
      <th scope="col" class="text-gray-800">Dependencia</th>
      <th scope="col" class="text-gray-800">Declaraciones</th>
       <th scope="col" class="text-gray-800 text-center">Porcentaje</th>
     
     
    </tr>
  </thead>
  <tbody>';

	$consulta=mysqli_query($conexion,"select * from cat_dependencia where DESCRIPCION LIKE '%$datoDep%' and ID_DEPENDENCIA >='90041' AND ID_DEPENDENCIA <='90147' limit 10");

         while($row=mysqli_fetch_assoc($consulta)){
			 $COMPARADOR=$row['DESCRIPCION'];
			 $padron=$row['num_obligados'];
			 
			   $SQL1=mysqli_query($conexion,"SELECT 
bitacora_firmado.DEPENDENCIA, bitacora_firmado.TIPO_DECLARACION

FROM bitacora_firmado, encargo 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '2020-05-01' AND bitacora_firmado.F_ENVIO <= '2020-06-03'
and bitacora_firmado.SITUACION='C' and bitacora_firmado.DEPENDENCIA = '$COMPARADOR' and bitacora_firmado.TIPO_DECLARACION ='2'
");
			 $declaraciones=0;
			 while($inf=mysqli_fetch_assoc($SQL1)){
				 $declaraciones++;
				
			 }
	  

$Dependencia = substr($row['DESCRIPCION'],  0, 90);  
			 if($padron==0){
				$padron=1; 
			 }
		$porcentaje=($declaraciones/$padron)*100;
			 $porcentaje=number_format($porcentaje,2);
			  if($declaraciones >= $padron){
				 $color='text-success';
			 }else{
				 $color='text-warning';
			 }	
			 
				 echo '<tr>
                        <td class="text-gray-800">'.utf8_encode($Dependencia).'</td>
                        <td class="text-gray-800">'.$declaraciones.' <sup>/'.$padron.'</sub></td>
                         <td class="'.$color.'">'.$porcentaje.'%</td>
						  
                    </tr>'; 
			}
	

echo '</tbody>
</table>
</div>
<div class="col-md-1"></div>
</div>';

?>