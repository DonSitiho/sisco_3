/*global $, document, Chart, LINECHART, data, options, window*/
$(document).ready(function () {

    'use strict';


   


    // ------------------------------------------------------- //
    // Bar Chart
    // ------------------------------------------------------ //
    var BARCHARTHOME = $('#barChartHome');
    var barChartHome = new Chart(BARCHARTHOME, {
        type: 'bar',
        options:
        {
            scales:
            {
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
            labels: ["SECRETARÍA TÉCNICA", "SECRETARÍA PARTICULAR", "CONTRALORÍA INTERNA", "DIRECCIÓN DE EVALUACIÓN, AUDITARÍA E INVESTIGACIÓN AL SECTOR CENTRAL", "DIRECCIÓN DE EVALUACIÓN, AUDITORIA E INVESTIGACIÓN A OBRA PUBLICA", "DIRECCIÓN DE EVALUACIÓN, AUDITORIA E INVESTIGACIÓN AL SECTOR PARAESTATAL", "DIRECCIÓN DE PARTICIPACIÓN CIUDADANA", "DIRECCIÓN DE NORMATIVIDAD Y RESPONSABILIDADES", "DELEGACIÓN ADMINISTRATIVA", "UNIDAD DE MEJORA POLÍTICA DE AUDITORIA Y GESTIÓN PUBLICA"],
            datasets: [
                {
                    label: "Correspondencia ",
                    backgroundColor: [
                        'rgb(201, 178, 248   )',
                        'rgb(197, 173, 248  )',
                        'rgb(192, 165, 247  )',
                        'rgb(186, 156, 247    )',
                        'rgb(181, 148, 248     )',
                        'rgb(175, 139, 247  )',
                        'rgb(167, 128, 246 )',
                        'rgb(161, 119, 247 )',
                        'rgb(153, 107, 246)',
                        'rgb(145, 95, 247)',
                        'rgb(136, 81, 247 )'
                    ],
                    borderColor: [
                         'rgb(201, 178, 248   )',
                        'rgb(197, 173, 248  )',
                        'rgb(192, 165, 247  )',
                        'rgb(186, 156, 247    )',
                        'rgb(181, 148, 248     )',
                        'rgb(175, 139, 247  )',
                        'rgb(167, 128, 246 )',
                        'rgb(161, 119, 247     )',
                        'rgb(153, 107, 246  )',
                        'rgb(145, 95, 247   )',
                        'rgb(136, 81, 247    )'
                    ],
                    borderWidth: 1,
                    data: [35, 49, 55, 68, 81, 95, 85, 40, 30, 27, 22]
                }
            ]
        }
    });

});
