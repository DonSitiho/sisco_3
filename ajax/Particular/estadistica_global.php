<?php
include_once('../../php/conexion.php');
$consulta_direcciones = mysqli_query($conexion, "SELECT id_direcciones, folio, id_estatus1 FROM datos_correspondencia");
$ST = 0;
$SP = 0;
$UMG = 0;
$EJ = 0;
$SFP = 0;
$SANGP = 0;
$UAOIC = 0;
$DDO = 0;
$DTAIP = 0;
$DAG = 0;
$DNEGP = 0;
$DI = 0;
$DA = 0;
$UED = 0;
$UVSEA = 0;
$SCSPC = 0;
$OIC_A = 0;
$OIC_B = 0;
$OIC_C = 0;
$OIC_D = 0;
$OIC_E = 0;
$OIC_F = 0;
$OIC_G = 0;
$OIC_H = 0;
$OIC_I = 0;
$OIC_J = 0;
$OIC_K = 0;
$OIC_L = 0;


//SACAR COPIAS
$pendientes =  array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$autorizados = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$seguimiento = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$finalizados = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

while ($rows_direcc = mysqli_fetch_assoc($consulta_direcciones)) {
    $id_direcciones = $rows_direcc['id_direcciones'];
    $fiolioBruto = $rows_direcc['folio'];
    $newFolio = substr($fiolioBruto, -9, 2); // devuelve "d"

    $c_o_o = substr($fiolioBruto, -1);
    $estatus = $rows_direcc['id_estatus1'];
    switch ($id_direcciones) {
        case 1:
            $ST++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[0]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[0]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[0]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[0]++;
            }
            break;
        case 2:
            $SP++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[1]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[1]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[1]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[1]++;
            }
            break;
        case 3:
            $UMG++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[2]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[2]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[2]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[2]++;
            }
            break;
        case 4:
            $EJ++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[3]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[3]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[3]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[3]++;
            }
            break;
        case 5:
            $SFP++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[4]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[4]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[4]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[4]++;
            }
            break;
        case 6:
            $SANGP++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[5]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[5]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[5]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[5]++;
            }
            break;
        case 7:
            $UAOIC++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[6]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[6]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[6]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[6]++;
            }
            break;
        case 8:
            $DDO++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[7]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[7]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[7]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[7]++;
            }
            break;
        case 9:
            $DTAIP++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[8]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[8]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[8]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[8]++;
            }
            break;
        case 10:
            $DAG++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[9]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[9]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[9]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[9]++;
            }
            break;
        case 11:
            $DNEGP++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[10]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[10]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[10]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[10]++;
            }
            break;
        case 12:
            $DI++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[11]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[11]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[11]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[11]++;
            }
            break;
        case 13:
            $DA++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[12]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[12]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[12]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[12]++;
            }
            break;
        case 14:
            $UED++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[13]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[13]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[13]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[13]++;
            }
            break;
        case 15:
            $UVSEA++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[14]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[14]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[14]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[14]++;
            }
            break;
        case 17:
            $SCSPC++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[15]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[15]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[15]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[15]++;
            }
            break;
        case 18:
            $OIC_L++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[16]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[16]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[16]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[16]++;
            }
            break;
        case 19:
            $OIC_K++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[17]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[17]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[17]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[17]++;
            }
            break;
        case 20:
            $OIC_H++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[18]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[18]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[18]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[18]++;
            }
            break;
        case 21:
            $OIC_I++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[19]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[19]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[19]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[19]++;
            }
            //ECHO ($pendientes[19].', '.$autorizados[19].', '.$seguimiento[19].', '.$finalizados[19]);
            break;
        case 22:
            $OIC_J++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[20]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[20]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[20]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[20]++;
            }
            break;
        case 24:
            $OIC_G++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[21]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[21]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[21]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[21]++;
            }
            break;
        case 25:
            $OIC_A++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[22]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[22]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[22]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[22]++;
            }
            break;
        case 28:
            $OIC_B++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[23]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[23]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[23]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[23]++;
            }
            break;
        case 29:
            $OIC_C++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[24]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[24]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[24]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[24]++;
            }
            break;
        case 32:
            $OIC_D++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[25]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[25]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[25]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[25]++;
            }
            break;
        case 33:
            $OIC_E++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[26]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[26]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[26]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[26]++;
            }
            break;
        case 34:
            $OIC_F++;
            if ($estatus == 1) { //PENDIENTES
                $pendientes[27]++;
            } elseif ($estatus == 2) { //AUTORIZADOS
                $autorizados[27]++;
            } elseif ($estatus == 3) { //Seguimiento
                $seguimiento[27]++;
            } elseif ($estatus == 6) { //FINALIZADOS
                $finalizados[27]++;
            }
            break;
    }
}

?>
<script>
    /*global $, document*/
    $(document).ready(function() {

        'use strict';


        // ------------------------------------------------------- //
        // Charts Gradients
        // ------------------------------------------------------ //
        var ctx1 = $("canvas").get(0).getContext("2d");
        var gradient1 = ctx1.createLinearGradient(150, 0, 150, 300);
        gradient1.addColorStop(0, 'rgba(133, 180, 242, 0.91)');
        gradient1.addColorStop(1, 'rgba(255, 119, 119, 0.94)');

        var gradient2 = ctx1.createLinearGradient(146.000, 0.000, 154.000, 300.000);
        gradient2.addColorStop(0, 'rgba(104, 179, 112, 0.85)');
        gradient2.addColorStop(1, 'rgba(76, 162, 205, 0.85)');


        // ------------------------------------------------------- //
        // Line Chart
        // ------------------------------------------------------ //
        var LINECHARTEXMPLE = $('#lineChartExample');
        var lineChartExample = new Chart(LINECHARTEXMPLE, {
            type: 'line',
            options: {
                legend: {
                    labels: {
                        fontColor: "#777",
                        fontSize: 12
                    }
                },
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: '#eee'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: '#eee'
                        }
                    }]
                },
            },
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                        label: "Data Set One",
                        fill: true,
                        lineTension: 0.3,
                        backgroundColor: gradient1,
                        borderColor: gradient1,
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        borderWidth: 1,
                        pointBorderColor: gradient1,
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: gradient1,
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: [30, 50, 40, 61, 42, 35, 40],
                        spanGaps: false
                    },
                    {
                        label: "Data Set Two",
                        fill: true,
                        lineTension: 0.3,
                        backgroundColor: gradient2,
                        borderColor: gradient2,
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        borderWidth: 1,
                        pointBorderColor: gradient2,
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: gradient2,
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: [50, 40, 50, 40, 45, 40, 30],
                        spanGaps: false
                    }
                ]
            }
        });


        // ------------------------------------------------------- //
        // Doughnut Chart
        // ------------------------------------------------------ //
        var DOUGHNUTCHARTEXMPLE = $('#doughnutChartExample');
        var pieChartExample = new Chart(DOUGHNUTCHARTEXMPLE, {
            type: 'doughnut',
            options: {
                cutoutPercentage: 70,
            },
            data: {
                labels: [
                    "A",
                    "B",
                    "C",
                    "D"
                ],
                datasets: [{
                    data: [250, 50, 100, 40],
                    borderWidth: 0,
                    backgroundColor: [
                        '#3eb579',
                        '#49cd8b',
                        "#54e69d",
                        "#71e9ad"
                    ],
                    hoverBackgroundColor: [
                        '#3eb579',
                        '#49cd8b',
                        "#54e69d",
                        "#71e9ad"
                    ]
                }]
            }
        });

        var pieChartExample = {
            responsive: true
        };


        // ------------------------------------------------------- //
        // Line Chart 1
        // ------------------------------------------------------ //
        var LINECHART1 = $('#lineChartExample1');
        var myLineChart = new Chart(LINECHART1, {
            type: 'line',
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            max: 40,
                            min: 0,
                            stepSize: 0.5
                        },
                        display: false,
                        gridLines: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: false
                }
            },
            data: {
                labels: ["A", "B", "C", "D", "E", "F", "G"],
                datasets: [{
                    label: "Total Overdue",
                    fill: true,
                    lineTension: 0,
                    backgroundColor: "transparent",
                    borderColor: '#6ccef0',
                    pointBorderColor: '#59c2e6',
                    pointHoverBackgroundColor: '#59c2e6',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 3,
                    pointBackgroundColor: "#59c2e6",
                    pointBorderWidth: 0,
                    pointHoverRadius: 4,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 0,
                    pointRadius: 4,
                    pointHitRadius: 0,
                    data: [20, 28, 30, 22, 24, 10, 7],
                    spanGaps: false
                }]
            }
        });


        // ------------------------------------------------------- //
        // Line Chart 2
        // ------------------------------------------------------ //
        var LINECHART1 = $('#lineChartExample2');
        var myLineChart = new Chart(LINECHART1, {
            type: 'line',
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false,
                            color: '#eee'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            max: 40,
                            min: 0,
                            stepSize: 0.5
                        },
                        display: false,
                        gridLines: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: false
                }
            },
            data: {
                labels: ["A", "B", "C", "D", "E", "F", "G"],
                datasets: [{
                    label: "Total Overdue",
                    fill: true,
                    lineTension: 0,
                    backgroundColor: "transparent",
                    borderColor: '#ff7676',
                    pointBorderColor: '#ff7676',
                    pointHoverBackgroundColor: '#ff7676',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 3,
                    pointBackgroundColor: "#ff7676",
                    pointBorderWidth: 0,
                    pointHoverRadius: 4,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 0,
                    pointRadius: 4,
                    pointHitRadius: 0,
                    data: [20, 8, 30, 22, 24, 17, 20],
                    spanGaps: false
                }]
            }
        });


        // ------------------------------------------------------- //
        // Pie Chart
        // ------------------------------------------------------ //
        var PIECHARTEXMPLE = $('#pieChartExample');
        var pieChartExample = new Chart(PIECHARTEXMPLE, {
            type: 'pie',
            data: {
                labels: [
                    "A",
                    "B",
                    "C",
                    "D"
                ],
                datasets: [{
                    data: [300, 50, 100, 80],
                    borderWidth: 0,
                    backgroundColor: [
                        '#44b2d7',
                        "#59c2e6",
                        "#71d1f2",
                        "#96e5ff"
                    ],
                    hoverBackgroundColor: [
                        '#44b2d7',
                        "#59c2e6",
                        "#71d1f2",
                        "#96e5ff"
                    ]
                }]
            }
        });

        var pieChartExample = {
            responsive: true
        };


        // ------------------------------------------------------- //
        // Bar Chart
        // ------------------------------------------------------ //
        var BARCHARTEXMPLE = $('#barChartExample2');
        var barChartExample = new Chart(BARCHARTEXMPLE, {
            type: 'bar',
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: '#eee'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: '#eee'
                        }
                    }]
                },
                plugins: {
					datalabels: {
						display: false
					}
				}
            },
            data: {
                labels: ["ST", "SP", "UMG", "EJ", "SFP", "SANGP", "UAOIC", "DDO", "DTAIP", " DAG", "DNEGP", "DI", "DA", "UED", "UVSEA", "SCSPC"],
                datasets: [{
                        label: "Total",
                        backgroundColor: [
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE'
                        ],
                        hoverBackgroundColor: [
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7"
                        ],
                        borderColor: [
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868'
                        ],
                        borderWidth: 1,
                        <?php
                        echo (' data: [' . $ST . ', ' . $SP . ', ' . $UMG . ', ' . $EJ . ', ' . $SFP . ', ' . $SANGP . ', ' . $UAOIC . ', ' . $DDO . ', ' . $DTAIP . ', ' . $DAG . ', ' . $DNEGP . ', ' . $DI . ', ' . $DA . ', ' . $UED . ', ' . $UVSEA . ', ' . $SCSPC . ']');
                        ?>,
                    },
                    {
                        label: "Pendientes",
                        backgroundColor: [
                            "#F3F5BF",

                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF"
                        ],
                        hoverBackgroundColor: [
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669"
                        ],
                        borderColor: [
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $pendientes[0] . ', ' . $pendientes[1] . ', ' . $pendientes[2] . ', ' . $pendientes[3] . ', ' . $pendientes[4] . ', ' . $pendientes[5] . ', ' . $pendientes[6] . ', ' . $pendientes[7] . ', ' . $pendientes[8] . ', ' . $pendientes[9] . ', ' . $pendientes[10] . ', ' . $pendientes[11] . ', ' . $pendientes[12] . ', ' . $pendientes[13] . ', ' . $pendientes[14] . ', ' . $pendientes[15] . ']');
                        ?>,
                    },
                    {
                        label: "Autorizados",
                        backgroundColor: [
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED"
                        ],
                        hoverBackgroundColor: [
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493"
                        ],
                        borderColor: [
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $autorizados[0] . ', ' . $autorizados[1] . ', ' . $autorizados[2] . ', ' . $autorizados[3] . ', ' . $autorizados[4] . ', ' . $autorizados[5] . ', ' . $autorizados[6] . ', ' . $autorizados[7] . ', ' . $autorizados[8] . ', ' . $autorizados[9] . ', ' . $autorizados[10] . ', ' . $autorizados[11] . ', ' . $autorizados[12] . ', ' . $autorizados[13] . ', ' . $autorizados[14] . ', ' . $autorizados[15] . ']');
                        ?>,
                    },
                    {
                        label: "Seguimiento",
                        backgroundColor: [
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75"
                        ],
                        hoverBackgroundColor: [
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762"
                        ],
                        borderColor: [
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $seguimiento[0] . ', ' . $seguimiento[1] . ', ' . $seguimiento[2] . ', ' . $seguimiento[3] . ', ' . $seguimiento[4] . ', ' . $seguimiento[5] . ', ' . $seguimiento[6] . ', ' . $seguimiento[7] . ', ' . $seguimiento[8] . ', ' . $seguimiento[9] . ', ' . $seguimiento[10] . ', ' . $seguimiento[11] . ', ' . $seguimiento[12] . ', ' . $seguimiento[13] . ', ' . $seguimiento[14] . ', ' . $seguimiento[15] . ']');
                        ?>,
                    },
                    {
                        label: "Finalizados",
                        backgroundColor: [
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB"
                        ],
                        hoverBackgroundColor: [
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",

                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389"
                        ],
                        borderColor: [
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $finalizados[0] . ', ' . $finalizados[1] . ', ' . $finalizados[2] . ', ' . $finalizados[3] . ', ' . $finalizados[4] . ', ' . $finalizados[5] . ', ' . $finalizados[6] . ', ' . $finalizados[7] . ', ' . $finalizados[8] . ', ' . $finalizados[9] . ', ' . $finalizados[10] . ', ' . $finalizados[11] . ', ' . $finalizados[12] . ', ' . $finalizados[13] . ', ' . $finalizados[14] . ', ' . $finalizados[15] . ']');
                        ?>,
                    }

                ]
            }
        });


        // ------------------------------------------------------- //
        // Bar Chart
        // ------------------------------------------------------ //
        var BARCHARTEXMPLE = $('#barChartExample3');
        var barChartExample = new Chart(BARCHARTEXMPLE, {
            type: 'bar',
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: '#eee'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: '#eee'
                        }
                    }]
                },
                plugins: {
					datalabels: {
						display: false
					}
				}
            },
            data: {
                labels: ["OIC-A", "OIC-B", "OIC-C", "OIC-D", "OIC-E", "OIC-F", "OIC-G", "OIC-H", "OIC-I", " OIC-J", "OIC-K", "OIC-L"],
                datasets: [{
                        label: "Total",
                        backgroundColor: [
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE',
                            '#EEEEEE'
                        ],
                        hoverBackgroundColor: [
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7",
                            "#A7A7A7"
                        ],
                        borderColor: [
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868',
                            '#686868'
                        ],
                        borderWidth: 1,
                        <?php
                        echo (' data: [' . $OIC_A . ', ' . $OIC_B . ', ' . $OIC_C . ', ' . $OIC_D . ', ' . $OIC_E . ', ' . $OIC_F . ', ' . $OIC_G . ', ' . $OIC_H . ', ' . $OIC_I . ', ' . $OIC_J . ', ' . $OIC_K . ', ' . $OIC_L . ']');
                        ?>,
                    },
                    {
                        label: "Pendientes",
                        backgroundColor: [
                            "#F3F5BF",

                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF",
                            "#F3F5BF"
                        ],
                        hoverBackgroundColor: [
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669",
                            "#ECE669"
                        ],
                        borderColor: [
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142",
                            "#EBF142"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $pendientes[16] . ', ' . $pendientes[17] . ', ' . $pendientes[18] . ', ' . $pendientes[19] . ', ' . $pendientes[20] . ', ' . $pendientes[21] . ', ' . $pendientes[22] . ', ' . $pendientes[23] . ', ' . $pendientes[24] . ', ' . $pendientes[25] . ', ' . $pendientes[26] . ', ' . $pendientes[27] . ']');
                        ?>,
                    },
                    {
                        label: "Autorizados",
                        backgroundColor: [
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED",
                            "#C4D5ED"
                        ],
                        hoverBackgroundColor: [
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493",
                            "#397493"
                        ],
                        borderColor: [
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA",
                            "#4E8EEA"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $autorizados[16] . ', ' . $autorizados[17] . ', ' . $autorizados[18] . ', ' . $autorizados[19] . ', ' . $autorizados[20] . ', ' . $autorizados[21] . ', ' . $autorizados[22] . ', ' . $autorizados[23] . ', ' . $autorizados[24] . ', ' . $autorizados[25] . ', ' . $autorizados[26] . ', ' . $autorizados[27] . ']');
                        ?>,
                    },
                    {
                        label: "Seguimiento",
                        backgroundColor: [
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75",
                            "#CCEC75"
                        ],
                        hoverBackgroundColor: [
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762"
                        ],
                        borderColor: [
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762",
                            "#CFF762"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $seguimiento[16] . ', ' . $seguimiento[17] . ', ' . $seguimiento[18] . ', ' . $seguimiento[19] . ', ' . $seguimiento[20] . ', ' . $seguimiento[21] . ', ' . $seguimiento[22] . ', ' . $seguimiento[23] . ', ' . $seguimiento[24] . ', ' . $seguimiento[25] . ', ' . $seguimiento[26] . ', ' . $seguimiento[27] . ']');
                        ?>,
                    },
                    {
                        label: "Finalizados",
                        backgroundColor: [
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB",
                            "#D6D2EB"
                        ],
                        hoverBackgroundColor: [
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",

                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389",
                            "#433389"
                        ],
                        borderColor: [
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B",
                            "#4E418B"
                        ],
                        borderWidth: 1,
                        <?php echo (' data: [' . $finalizados[16] . ', ' . $finalizados[17] . ', ' . $finalizados[18] . ', ' . $finalizados[19] . ', ' . $finalizados[20] . ', ' . $finalizados[21] . ', ' . $finalizados[22] . ', ' . $finalizados[23] . ', ' . $finalizados[24] . ', ' . $finalizados[25] . ', ' . $finalizados[26] . ', ' . $finalizados[27] . ']');
                        ?>,
                    }

                ]
            }
        });



        // ------------------------------------------------------- //
        // Bar Chart 1
        // ------------------------------------------------------ //
        var BARCHART1 = $('#barChart1');
        var barChartHome = new Chart(BARCHART1, {
            type: 'bar',
            options: {
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }],
                },
                legend: {
                    display: false
                }
            },
            data: {
                labels: ["A", "B", "C", "D", "E", "F", "G", "H"],
                datasets: [{
                        label: "Data Set 1",
                        backgroundColor: [
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7'
                        ],
                        borderColor: [
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7',
                            '#44b2d7'
                        ],
                        borderWidth: 0,
                        data: [35, 55, 65, 85, 30, 22, 18, 35]
                    },
                    {
                        label: "Data Set 1",
                        backgroundColor: [
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6'
                        ],
                        borderColor: [
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6',
                            '#59c2e6'
                        ],
                        borderWidth: 0,
                        data: [49, 68, 85, 40, 27, 35, 20, 25]
                    }
                ]
            }
        });


        // ------------------------------------------------------- //
        // Bar Chart 2
        // ------------------------------------------------------ //
        var BARCHART2 = $('#barChart2');
        var barChartHome = new Chart(BARCHART2, {
            type: 'bar',
            options: {
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }],
                },
                legend: {
                    display: false
                }
            },
            data: {
                labels: ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O"],
                datasets: [{
                    label: "Data Set 1",
                    backgroundColor: [
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d'
                    ],
                    borderColor: [
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d',
                        '#54e69d'
                    ],
                    borderWidth: 1,
                    data: [40, 33, 22, 28, 40, 25, 30, 40, 28, 27, 22, 15, 20, 24, 30]
                }]
            }
        });


        // ------------------------------------------------------- //
        // Polar Chart
        // ------------------------------------------------------ //
        var POLARCHARTEXMPLE = $('#polarChartExample');
        var polarChartExample = new Chart(POLARCHARTEXMPLE, {
            type: 'polarArea',
            options: {
                elements: {
                    arc: {
                        borderWidth: 0,
                        borderColor: '#aaa'
                    }
                }
            },
            data: {
                datasets: [{
                    data: [
                        11,
                        16,
                        12,
                        11,
                        7
                    ],
                    backgroundColor: [
                        "#e05f5f",
                        "#e96a6a",
                        "#ff7676",
                        "#ff8b8b",
                        "#fc9d9d"
                    ],
                    label: 'My dataset' // for legend
                }],
                labels: [
                    "A",
                    "B",
                    "C",
                    "D",
                    "E"
                ]
            }
        });

        var polarChartExample = {
            responsive: true
        };


        // ------------------------------------------------------- //
        // Radar Chart
        // ------------------------------------------------------ //
        var RADARCHARTEXMPLE = $('#radarChartExample');
        var radarChartExample = new Chart(RADARCHARTEXMPLE, {
            type: 'radar',
            data: {
                labels: ["A", "B", "C", "D", "E", "C"],
                datasets: [{
                        label: "First dataset",
                        backgroundColor: "rgba(84, 230, 157, 0.4)",
                        borderWidth: 2,
                        borderColor: "rgba(75, 204, 140, 1)",
                        pointBackgroundColor: "rgba(75, 204, 140, 1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(75, 204, 140, 1)",
                        data: [65, 59, 90, 81, 56, 55]
                    },
                    {
                        label: "Second dataset",
                        backgroundColor: "rgba(255, 119, 119, 0.4)",
                        borderWidth: 2,
                        borderColor: "rgba(255, 119, 119, 1)",
                        pointBackgroundColor: "rgba(255, 119, 119, 1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(255, 119, 119, 1)",
                        data: [50, 60, 80, 45, 96, 70]
                    }
                ]
            }
        });
        var radarChartExample = {
            responsive: true
        };



    });
</script>