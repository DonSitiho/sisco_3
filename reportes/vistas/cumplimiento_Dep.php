<?php
include('../plantillas/header.php');
?>
<style>
	:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: 0.75rem;
}

.login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url(../../img/a170e411-e23d-4098-aa2f-14f565cf543b.jpg);
  background-size: cover;
  background-position: center;
}

.login-heading {
  font-weight: 300;
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
  border-radius: 2rem;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
  height: auto;
  border-radius: 2rem;
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  cursor: text;
  /* Match the input under the label */
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}
</style>  
  <h1 class="my-0 mr-md-auto font-weight-normal text-center "><span class="badge badge-warning">Cumplimiento Dependencias</span></h1>
  <br>

 <!-- <a class="btn btn-outline-priary" href="#">Sign up</a>-->
 <div class="row">
 	<div class="col-md-4"></div>
 	<div class="col-md-4">
 		<div class="form-label-group">
      <input type="text"  name="Buscador" class="form-control" placeholder="" required id="bs-dependencia" autofocus>
       <label for="bs-dependencia">Busca por:</label>
   </div>
 	</div>
 	<div class="col-md-4"></div>
 </div>
 
    <div class="registros" id="agrega-registros">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <table class="table table-sm table-hover">
  <thead style="background-color:lightskyblue;">
    <tr>
      <th scope="col" class="text-gray-800">Dependencia</th>
      <th scope="col" class="text-gray-800 text-center">Declaraciones</th>
       <th scope="col" class="text-gray-800 text-center">Porcentaje</th>
     
     
    </tr>
  </thead>
  <tbody>
   
     <?php
            include('../php/conexion.php');
	  
	$consulta=mysqli_query($conexion,"select * from cat_dependencia where ID_DEPENDENCIA >='90041' AND ID_DEPENDENCIA <='90147' limit 10");

	  $contador=0;
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
                        <td class="text-gray-800 text-center">'.$declaraciones.' <sup>/'.$padron.'</sub></td>
                         <td class="'.$color.'">'.$porcentaje.'%</td>
						  
                    </tr>'; 
			 $contador++;
			}
        ?>
  </tbody>
</table>
</div>
<div class="col-md-1"></div>
</div>
</div>      
         

     
<?php
	 include('../plantillas/footer.php');
	 ?>