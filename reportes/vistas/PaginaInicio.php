<?php
include('../plantillas/header.php');
include('../php/fecha_actual.php');
?>
<!-- header -->
  

<div class="pricing-header px-1 py-1 pt-md-1 pb-md-1 mx-auto text-center">
  <h1 class="display-4">Secretaria de Contraloría</h1>
  <h4>Estadistica del 2020-05-01 al <?php echo($fecha_actual) ?></h4>
 <!-- <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>-->
</div>
<?php
include('../php/conexion.php');
	  include('../php/fecha_actual.php');

/*$consulta=mysqli_query($conexion,"SELECT bitacora_firmado.NOMBRE, bitacora_firmado.RFC, bitacora_firmado.F_ENVIO, bitacora_firmado.ANIO, 
bitacora_firmado.DEPENDENCIA, encargo.AREA_ADSCRIPCION, bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION

FROM bitacora_firmado, encargo, cat_puesto 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '2020-05-1' AND bitacora_firmado.F_ENVIO <= '$fecha_actual'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C'");*/
	  
	  $consulta=mysqli_query($conexion,"SELECT  bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION

FROM bitacora_firmado, encargo, cat_puesto 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '2020-05-1' AND bitacora_firmado.F_ENVIO <= '2020-06-03'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C' ");
	  
	 

$row=mysqli_fetch_assoc($consulta);
$inicial=0;
$conclusion=0;
$modificacion=0;
$total=0;
while($obtenerInf=mysqli_fetch_assoc($consulta)){
	
	$tipodeclarcion=$obtenerInf['TIPO_DECLARACION'];
	switch($tipodeclarcion){
		case '0':
			$inicial++;
			$total++;
			break;
		case '1':
			$conclusion++;
			$total++;
			break;
		case '2':
			$modificacion++;
			$total++;
			break;
	}
	
	
}
$porcentaje=($modificacion/2365)*100;
	  $porcentaje=number_format($porcentaje,2);

?>
<div class="container">
  <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Declaraciones de Modificación</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo(number_format($modificacion)); ?> / <sup> 2,365</sub></div>
                        </div>
                       
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Declaraciones Iniciales</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo(number_format($inicial)); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
           

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Declaraciones de Conclusión</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo(number_format($conclusion)); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de declaraciones Presentadas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo(number_format($total)); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
 <div class="col-xl-12 col-md-12 mb-12">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Porcentaje de declaraciones de modificación presentadas</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo($porcentaje.'%'); ?></div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo($porcentaje.'%'); ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-fw fa-chart-area fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
           <center> <img src="../img/contraloria.png" width="40%"></center>
</div>
      </div>
    </div>
    
    </div>
  <!-- /#wrapper -->
<?php
include('../plantillas/footer.php');
?>