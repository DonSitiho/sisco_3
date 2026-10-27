<?php
include_once('../../php/conexion.php');
if(isset($_GET['id'])){
	$id=$_GET['id'];
	//echo $id;
$consulta_direccion=mysqli_query($conexion,"SELECT nombre_direccion FROM direcciones_secoem WHERE id_direccion='$id'");
$row=mysqli_fetch_assoc($consulta_direccion);
$nombre_direccion=$row['nombre_direccion'];
//echo $nombre_direccion;
	//CONSULTA CORRESPONDENCIA
	$consulta_corres=mysqli_query($conexion,"SELECT tipo_oficio, folio, id_estatus1 FROM datos_correspondencia WHERE id_direcciones='$id'");
	$total=0;
	$titular=0;
	$c_secretaria=0;
	$c_respuesta=0;
	$c_enterado=0;
	$finalizados=0;
	$seguimiento=0;
	$originalTitular=0;
	$conocimientoOriginal=0;
	$copiaTitular=0;
	$copiaConocimiento=0;
	$originalTitular_Seguimiento=0;
	$conocimientoOriginal_Seguimiento=0;
	$copiaTitular_Seguimiento=0;
	$copiaConocimiento_Seguimiento=0;
	$originalTitular_finalizado=0;
	$conocimientoOriginal_finalizado=0;
	$copiaTitular_finalizado=0;
	$copiaConocimiento_finalizado=0;
    $totalDireccion = 0;
	while($campos_corr=mysqli_fetch_assoc($consulta_corres)){
		$tipo_oficio=$campos_corr['tipo_oficio'];
		$folio_bruto=$campos_corr['folio'];
		$estatus=$campos_corr['id_estatus1'];
		$c_o_o = substr($folio_bruto, -1);
		//las que tienen que responder
		if($estatus==2){
		if($c_o_o=='1'){
			$c_respuesta++;
		}else{//copias (enterado)
			$c_enterado++;
		}
			}
		//tipo de oficio
		if($estatus==2){
			$titular++;
		}elseif($estatus==1){
			$c_secretaria++;
		}elseif($estatus==6){
			$finalizados++;
		}elseif($estatus==3){
			$seguimiento++;
		}
		//Bandeja
		if($estatus==2 && $c_o_o=='1' && $tipo_oficio=='0'){
			$originalTitular++;
		}
		if($estatus==2 && $c_o_o=='1' && $tipo_oficio=='1'){
			$conocimientoOriginal++;
		}
		if($estatus==2 && $c_o_o !='1' && $tipo_oficio=='0'){
			$copiaTitular++;
		}
		if($estatus==2 && $c_o_o !='1' && $tipo_oficio=='1'){
			$copiaConocimiento++;
		}
		//Seguimiento
		if($estatus==3 && $c_o_o=='1' && $tipo_oficio=='0'){
			$originalTitular_Seguimiento++;
		}
		if($estatus==3 && $c_o_o=='1' && $tipo_oficio=='1'){
			$conocimientoOriginal_Seguimiento++;
		}
		if($estatus==3 && $c_o_o !='1' && $tipo_oficio=='0'){
			$copiaTitular_Seguimiento++;
			
		}
		if($estatus==3 && $c_o_o !='1' && $tipo_oficio=='1'){
			$copiaConocimiento_Seguimiento++;
		}
		//finalizados
		if($estatus==6 && $c_o_o=='1' && $tipo_oficio=='0'){
			$originalTitular_finalizado++;
		}
		if($estatus==6 && $c_o_o=='1' && $tipo_oficio=='1'){
			$conocimientoOriginal_finalizado++;
		}
		if($estatus==6 && $c_o_o !='1' && $tipo_oficio=='0'){
			$copiaTitular_finalizado++;
			
		}
		if($estatus==6 && $c_o_o !='1' && $tipo_oficio=='1'){
			$copiaConocimiento_finalizado++;
		}
		$total++;
	}
    $totalDireccion = $total-$c_secretaria;
?>
<script>
	/*global $, document*/
$(document).ready(function () {

    'use strict';


    // ------------------------------------------------------- //
    // Charts Gradients
   
   // ------------------------------------------------------- //
    // Pie Chart
    // ------------------------------------------------------ //
    var PIECHARTEXMPLE    = $('#pieChartExample');
    var pieChartExample = new Chart(PIECHARTEXMPLE, {
        type: 'pie',
        data: {
            labels: [
                "Total",
                "Turnados",
                "Pendientes",
                "Respuesta",
				"Conocimiento",
				"Finalizados"
            ],
            datasets: [
                {
					<?php echo(" data: [".$total.", ".$titular.", ".$c_secretaria.", ".$c_respuesta.",".$c_enterado.",".$finalizados."]") ?>
                   ,
                    borderWidth: 0,
                    backgroundColor: [
                        '#8C2CE7',
                        "#45DE5E",
                        "#F8B51C",
                        "#62EE35",
						"#E2E72C",
						"#888280"
                    ],
                    hoverBackgroundColor: [
                        '#8C2CE7',
                        "#45DE5E",
                        "#F8B51C",
                        "#62EE35",
						"#E2E72C",
						"#888280"
                    ]
                }]
            },
			options: {
				responsive: true,
				legend: {
					position: 'bottom'
				},
				plugins: {
					datalabels: {
						display: false
					}
				}
			}
    });

    var pieChartExample = {
        responsive: true
    };


    // ------------------------------------------------------- //
    // Pie Chart
    // ------------------------------------------------------ //
    var PIECHARTEXMPLE    = $('#pieChartExample2');
    var pieChartExample = new Chart(PIECHARTEXMPLE, {
        type: 'pie',
        data: {
            labels: [
                "Bandeja (Sin Atención)",
                "Seguimiento",
				"Finalizados"
            ],
            datasets: [
                {
					<?php echo(" data: [".$titular.", ".$seguimiento.", ".$finalizados."]") ?>
                   ,
                    borderWidth: 0,
                    backgroundColor: [
                        '#f70777',
                        "#E2E72C",
                        "#8C2CE7",
                        "#62EE35",
						"#E2E72C",
						"#888280"
                    ],
                    hoverBackgroundColor: [
                        '#f70777',
                        "#45DE5E",
                        "#F8B51C",
                        "#62EE35",
						"#E2E72C",
						"#888280"
                    ]
                }]
            },
			options: {
				responsive: true,
				legend: {
					position: 'bottom'
				},
				plugins: {
					datalabels: {
						color: '#fff',
						anchor: 'end',
						align: 'start',
						offset: -5,
						borderWidth: 2,
						borderColor: '#fff',
						borderRadius: 25,
						backgroundColor: (context) => {
							return context.dataset.backgroundColor;
						},
						font: {
							weight: 'bold',
							size: '12'	
						}
					}
				}
			}
    });

    var pieChartExample2 = {
        responsive: true
    };
	

    // ------------------------------------------------------- //
    // Bar Chart
   
    // ------------------------------------------------------- //
    
    // ------------------------------------------------------ //
   



});

</script>
<?php

echo('  <div class="row">
                <!-- Statistics -->
               
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-envelope"></i></div>
                    <div class="number">
					<h4>Autorizados</h4>
					<p class="font-weight-bold" style="margin:-2.5% 0;">'.$titular.' <small> bandeja</small></p>
					<p class="font-weight-bold" style="margin:-2.5% 0;">'.$seguimiento.' <small> Seguimiento</small></p>
					<p class="font-weight-bold" >'.$finalizados.' <small> Finalizados</small></p>
					<u><strong class="num">'.$total.'</strong><small> Total</small></u>
					
					</div>
                  </div>
                  
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="number"><strong class="num">'.$c_secretaria.'</strong><br><small>Pendientes por Autorizar</small></div>
                  </div>
                </div>
                <!-- Line Chart            -->
                 <div class="col-md-5">
                  <div class="pie-chart-example card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard8" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">'.$nombre_direccion.'</h3>
                    </div>
                    <div class="card-body">
                      <canvas id="pieChartExample"></canvas>
                    </div>
                  </div>
                </div>
                 <div class="statistics col-lg-4 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="number">
					<h4>Bandeja</h4>
					<p class="font-weight-bold " style="margin:-2.5% 0;">'.$originalTitular.' <small class="text-success"> Original-Titular</small></p>
					<p class="font-weight-bold " style="margin:-2.5% 0;">'.$conocimientoOriginal.' <small class="text-info"> Conocimiento-original</small></p>
					<p class="font-weight-bold"  style="margin:-2.5% 0;">'.$copiaTitular.' <small> Copia Titular</small></p>
					<p class="font-weight-bold" >'.$copiaConocimiento.' <small> Copia Conocimiento</small></p>
					
					</div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-warning"><i class="fa fa-envelope-square"></i></div>
                     <div class="number">
					<h4>Seguimiento</h4>
					<p class="font-weight-bold " style="margin:-2.5% 0;">'.$originalTitular_Seguimiento.' <small class="text-success"> Original-Titular</small></p>
					<p class="font-weight-bold " style="margin:-2.5% 0;">'.$conocimientoOriginal_Seguimiento.' <small class="text-info"> Conocimiento-original</small></p>
					<p class="font-weight-bold"  style="margin:-2.5% 0;">'.$copiaTitular_Seguimiento.' <small> Copia Titular</small></p>
					<p class="font-weight-bold" >'.$copiaConocimiento_Seguimiento.' <small> Copia Conocimiento</small></p>
					
					</div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="number">
					<h4>Finalizados</h4>
					<p class="font-weight-bold " style="margin:-2.5% 0;">'.$originalTitular_finalizado.' <small class="text-success"> Original-Titular</small></p>
					<p class="font-weight-bold " style="margin:-2.5% 0;">'.$conocimientoOriginal_finalizado.' <small class="text-info"> Conocimiento-original</small></p>
					<p class="font-weight-bold"  style="margin:-2.5% 0;">'.$copiaTitular_finalizado.' <small> Copia Titular</small></p>
					<p class="font-weight-bold" >'.$copiaConocimiento_finalizado.' <small> Copia Conocimiento</small></p>
					
					</div>
                  </div>
                </div>
                
                <div class="col-md-8">
                  <div class="pie-chart-example card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard8" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">'.$nombre_direccion.' (Correspondencia Total recibida: '.$totalDireccion.')</h3>
                    </div>
                    <div class="card-body">
                      <canvas id="pieChartExample2" style="width:100%;max-width:700px;margin-top:10%"></canvas>
                    </div>
                  </div>
                </div>
                
              </div>');
	}
?>
  <script src="../../js/jquery.counterup.min.js"></script><!-- animacion contador --><!-- este va en el index -->
  	             <script src="../../js/jquery.waypoints.js"></script><!-- animacion contador --><!-- este va en el index -->	                        <script>
				 $('.num').counterUp({delay:20, time:1000});	   
  
 </script>