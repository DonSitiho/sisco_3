<?php
include('../plantillas/header.php');
?>
        
          <h1 class="my-0 mr-md-auto font-weight-normal text-center "><span class="badge badge-info">Tipo de Declaración</span></h1>
  <br>
         
 <div class="container">
	 <center>	
          <form class="form-group" target="_blank" action="../php/GenerarReporte.php" method="post">
          <div class="container">
          	<div class="row">
          		<div class="col-md-6"><div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../img/banner1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../img/banner2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../img/banner3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div></div>
          		<div class="col-md-6">
        			      
        			 <div class="card" style="width: 100%;">
                          <div class="card-body">
                           <h3 class="card-title card-header">Generar Reporte</h3>
                            <h7 class="card-title text-info">Reporte en formato PFD</h7>
                       <div class="input-group mb-6">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Fecha Inicial</span>
                        </div>
                      <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required value="<?php echo($fecha_actual); ?>" name="FechaInicial">
                      </div>
                      <br>
                      
                      <div class="input-group mb-6">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Fecha Final</span>
                        </div>
                      <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required value="<?php echo($fecha_actual); ?>" name="FechaFinal">
                      </div>
                        <br>
                         <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">año</label>
  </div>
  <select class="custom-select" id="anio" name="anio">
    <option selected value="">Seleccionar</option>
    <?php
	  $conexion = new mysqli("201.116.244.212", "root", "Y6?GzUj1/9", "declaranetplus2");
	  $dependencias=mysqli_query($conexion, "SELECT DISTINCT ANIO from bitacora_firmado ORDER BY ANIO ");
	  
	  while($obtenerInf1=mysqli_fetch_assoc($dependencias)){
		 echo' <option value="'.$obtenerInf1['ANIO'].'">'.$obtenerInf1['ANIO'].'</option>';
	  }
	  
	  ?>
   <!-- <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>-->
  </select>
</div>
                     
                      <h5>Tipo de reporte</h5>
                       <div class="form-check form-check-inline custom-radio">
  <input class="custom-control-input" type="radio" name="check" id="inlineRadio1" value="0" required>
  <label class="custom-control-label" for="inlineRadio1" >Inicial</label>
</div>
 &nbsp;&nbsp;&nbsp;&nbsp;
<div class="form-check form-check-inline custom-radio">
  <input class="custom-control-input" type="radio" name="check" id="inlineRadio2" value="1">
  <label class="custom-control-label" for="inlineRadio2">Conclución</label>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;
 <div class="form-check form-check-inline custom-radio">
  <input class="custom-control-input" type="radio" name="check" id="inlineRadio3" value="2">
  <label class="custom-control-label" for="inlineRadio3">Modificación</label>
  
</div>                    
<br>
                  
                   
                    
                     <h5>Tipo de formato</h5>
                      <div class="custom-control custom-radio ">
  <input type="radio" id="customRadio1" name="tipo_formato" class="custom-control-input" value="0" required>
  <label class="custom-control-label" for="customRadio1">PDF</label>
</div>
<div class="custom-control custom-radio">
  <input type="radio" id="customRadio2" name="tipo_formato" class="custom-control-input" value="1">
  <label class="custom-control-label" for="customRadio2">Excel</label>
</div>
                       
                        <button class="form-control btn-info">Generar Reporte</button>
                      
                    </div>
                   </div>
        			   </form>    
        			      
        			   </center>   
        
          		</div>
          	</div>
          </div>
    
          
         
     
</div>
<?php
	 include('../plantillas/footer.php');
	 ?>