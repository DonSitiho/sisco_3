<?php
include_once('../../plantillas/Direcciones/header.php');

$consultaCorrespondencia = mysqli_query($conexion, "SELECT f_turnado, tipo_oficio, id_estatus1 FROM `datos_correspondencia` WHERE `id_direcciones` = $id_direccion AND `id_estatus1` != 1");

$countMeses    = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //Posiciones por cada mes del año
$countOriginal = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
$countCopia    = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
$estatus_corres = [0, 0, 0]; //Bandeja, Seguimiento y Finalizado
$total_corres = 0;
$corresp_dia = 0;
$fechaActual = date("Y-m-d");

while ($row = mysqli_fetch_array($consultaCorrespondencia)) {
    $fechaOriginal = $row['f_turnado'];
    $mesActual = intval(date("m"));
    $mes = date("m", strtotime($fechaOriginal));
    $total_corres++;

    //Sacar correspondencia del dia
    if ($fechaActual == $fechaOriginal) {
        $corresp_dia++;
    }

    //Ver clacificar correspondencia

    if ($row['id_estatus1'] == 2) { //Bandeja
        $estatus_corres[0]++;
    } elseif ($row['id_estatus1'] == 3) { //SEGUIMIENTO
        $estatus_corres[1]++;
    } elseif ($row['id_estatus1'] == 6) { //FINALIZADO
        $estatus_corres[2]++;
    }


    //Comparar Fechas
    $mes = intval($mes) - 1;
    switch (intval($mes)) { //MEJORAR APÑICAR ALGUN CICLO PARA RECREAR TODOS LOS CASOS
        case 0:
            if ($row['tipo_oficio'] == 0) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }

            $countMeses[$mes] = $countMeses[$mes] + 1;

            break;
        case 1:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }

            $countMeses[$mes] = $countMeses[$mes] + 1;

            break;
        case 2:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            // echo  $mes;
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 3:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 4:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 5:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 6:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 7:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 8:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 9:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 10:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
        case 11:
            if ($row['tipo_oficio'] == 1) { //ORIGINAL
                $countOriginal[$mes]++;
            } else { //COPIA
                $countCopia[$mes]++;
            }
            $countMeses[$mes] = $countMeses[$mes] + 1;
            break;
    }
}
?>
<style>

</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>


<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>

<!-- ************************************** contenido ***************************** -->

<!-- banner informativo -->





<section class="dashboard-counts no-padding-bottom" style="margin-top: -35px !important;">
    <div class="row">

        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats" style="border-radius: 25px !important;">

                <div class="card-body">



                    <canvas id="myChart1"
                        style="display: block; height: 100% !important; width: 100%px !important;"></canvas>



                </div>

            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-stats" style="border-radius: 25px !important;">

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total de Correspondencia</h5>
                            <span class="h1 font-weight-bold mb-0"><?= $total_corres ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info  rounded-circle shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor"
                                    class="bi bi-envelope " viewBox="0 0 16 16">
                                    <path
                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Desde el mes pasado</span>
                    </p>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card card-stats" style="border-radius: 25px !important;">

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Correspondencia del dia</h5>
                            <span class="h2 font-weight-bold mb-0"><?= $corresp_dia ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info  rounded-circle shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor"
                                    class="bi bi-envelope-exclamation" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1.5a.5.5 0 0 1-1 0V11a.5.5 0 0 1 1 0Zm0 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Desde el mes pasado</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats" style="border-radius: 25px !important;">

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Usuarios Asignados al área</h5>
                            <span class="h2 font-weight-bold mb-0">49,65%</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info  rounded-circle shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor"
                                    class="bi bi-people" viewBox="0 0 16 16">
                                    <path
                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="mt-0 mb-0 text-sm text-center">

                        <center>
                            <h1> <a href="usuarios.php?collapse=0&li=3" class="btn btn-success btn-sm  btn-block"
                                    style="border-radius: 25px !important;">Agregar Usuarios</a></h1>
                        </center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- fin de banner informativo -->

<!-- banner grafica -->

<section class="dashboard-counts no-padding-bottom" style="margin-top: -100px !important;">
    <div class="row">
        <div class="row col-12 bg-white has-shadow" style="border-radius: 25px !important;">
            <!-- Item -->

            <canvas id="myChart" style="display: block; height: 120px !important; width: 487px;"></canvas>

        </div>
    </div>
</section>
<!-- fin de banner Grafica -->

<?php require_once("../../html/modal_cambiar_password.php"); ?>

<!-- Page Footer-->
<?php include_once('../../plantillas/Direcciones/foother.php') ?>



<?php


echo "<script>
 const ctx = document.getElementById('myChart').getContext('2d');
 const myChart = new Chart(ctx, {
     type: 'line',
     data: {
         labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
         datasets: [
             {
                 label: 'Originales',
                 borderColor: 'green',
                 data:[" . implode(",", $countOriginal) . "],
                },
                {
                 label: 'Copias',
                 borderColor: 'yellow',
                 data:[" . implode(",", $countCopia) . "],
               },
               {
                label: 'TOTAL',
                borderColor: 'blue',
                data:[" . implode(",", $countMeses) . "],
              },
             ]
     },
     options: {
         title:{
             display: true,
             text: 'Correspondencia Mensual',
             fontSize: 30,
             padding: 10, 
             fontColor: '#12619c'
         },
         tooltips:{
             backgroundColor:'#0584f6',
             titleFontSize: 20,
             xPadding: 20,
             yPadding: 20,
             bodyFontSize: 15,
             bodySpacing: 10,
             mode: 'x',
 
 
         },
         elements: {
             line:{
                 borderWidth: 3,
                 fill: false,
             },
             point:{
                 radius:6,
                 borderWidth:4,
                 backgroundColor: 'white',
                 hoverRadius: 8,
                 hoverBorderWidth: 4,
             }
 
         },
         scales: {
             y: {
                 beginAtZero: true
             }
         }
     }
 });
 </script>";

echo "<script>
 const ctx = document.getElementById('myChart1').getContext('2d');
 const myChart1 = new Chart(ctx, {
     type: 'doughnut',
     data: {
         labels: ['Enero'],
         datasets: [
             {
                 label: 'Originales',
                 borderColor: 'red',
                 data:[2],
                },
               
     },
     options: {
         title:{
             display: true,
             text: 'Correspondencia Recibida',
             fontSize: 30,
             padding: 30, 
             fontColor: '#12619c'
         },
         tooltips:{
             backgroundColor:'#0584f6',
             titleFontSize: 20,
             xPadding: 20,
             yPadding: 20,
             bodyFontSize: 15,
             bodySpacing: 10,
             mode: 'x',
 
 
         },
         elements: {
             line:{
                 borderWidth: 3,
                 fill: false,
             },
             point:{
                 radius:6,
                 borderWidth:4,
                 backgroundColor: 'white',
                 hoverRadius: 8,
                 hoverBorderWidth: 4,
             }
 
         },
         scales: {
             y: {
                 beginAtZero: true
             }
         }
     }
 });
 </script>
 <script>
const ctx1 = document.getElementById('myChart1').getContext('2d');
const myChart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['Bandeja', 'Seguimiento', 'Finalizados'],
        datasets: [{
            label: '# of Votes',
            data:[" . implode(",", $estatus_corres) . "],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)'
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>";

?>



<!-- animacion contador -->
<!-- este va en el index -->