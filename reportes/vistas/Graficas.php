<?php
include('../plantillas/header.php');
?>
   
  <h1 class="my-0 mr-md-auto font-weight-normal text-center "><span class="badge badge-danger">Graficas
  </span></h1>
  <br>

 <!-- <a class="btn btn-outline-priary" href="#">Sign up</a>-->
   
          
         
 <div class="container">
	 <center>	
         
          <div class="container">
          	<div class="row">
         
         		
          		<div class="col-md-6">
          		  <div class="card border-left-success shadow h-100 py-2">
          		<div id="container" style="width:100%;"></div>
<?php
include('../php/conexion.php');

$consulta=mysqli_query($conexion,"SELECT  bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION

FROM bitacora_firmado, encargo, cat_puesto 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '2020-05-1' AND bitacora_firmado.F_ENVIO <= '2020-06-03'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C'");

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

$valoresY=array(0=>$inicial, 1=>$conclusion, 2=>$modificacion);
$valoresX=array();

$datosY=json_encode($valoresY);

?>
		<script type="text/javascript">
	function crearCadenaLineal(json){
		var parsed= JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
			
		}
		return arr;
	}
	</script>

		<script type="text/javascript">
		datosY=crearCadenaLineal('<?php echo $datosY ?>')	
	
	
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Grafica por tipo de declaraciones'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
		
        type: 'pie',
        name: 'Declaraciones realizadas',
        data: [
            ['INICIALES: '.concat(datosY[0]), datosY[0]],
            ['CONCLUSIÒN: '.concat(datosY[1]), datosY[1]],
           
            ['MODIFICACIÒN: '.concat(datosY[2]), datosY[2]]
            
        ]
    }]
});
		</script>
					</div>
          		</div>
          		<div class="col-md-6">
        			<div class="card border-left-info shadow h-100 py-2">
          		<div id="container2" style="width:100%;"></div>
<?php


$consulta=mysqli_query($conexion,"SELECT  bitacora_firmado.TIPO_DECLARACION, cat_puesto.DESCRIPCION as puesto, bitacora_firmado.SITUACION

FROM bitacora_firmado, encargo, cat_puesto 

WHERE bitacora_firmado.NO_DECLARACION = encargo.NO_DECLARACION AND bitacora_firmado.F_ENVIO >= '2020-05-1' AND bitacora_firmado.F_ENVIO <= '2020-06-03'
and encargo.ID_PUESTO = cat_puesto.ID_PUESTO AND bitacora_firmado.SITUACION='C'");

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
	echo($modificacion);							 
$grafica=(2365)-$modificacion;
$porcentaje=($modificacion/2365)*100;
	  $porcentaje=number_format($porcentaje,2);

$valoresX=array(0=>$modificacion, 1=>$grafica);


$datosX=json_encode($valoresX);

?>
	
		<script type="text/javascript">
	function crearCadenaLineal(json){
		var parsed= JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
			
		}
		return arr;
	}
	</script>





		<script type="text/javascript">
			$datosX=crearCadenaLineal('<?php echo $datosX ?>')	
Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Declaraciones<br>Mayo<br>2020',
        align: 'center',
        verticalAlign: 'middle',
        y: 80
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%'],
            size: '110%'
        }
    },
    series: [{
        type: 'pie',
        name: 'Porcentaje',
        innerSize: '50%',
        data: [
			['Declaraciones Modificación Presentadas: '.concat($datosX[0]), $datosX[0]],
            ['Declaraciones Esperadas: 2365', $datosX[1]]
          
            
            
        ]
    }]
});

		</script>
					</div>      
        			  
        
          		</div>
          	</div>
          </div>
    
          <br>
         
     
</div>
<?php
	 include('../plantillas/footer.php');
	 ?>