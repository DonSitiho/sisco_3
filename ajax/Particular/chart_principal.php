<?php
include('../../php/conexion.php');
$consulta_direcciones=mysqli_query($conexion,"SELECT id_direcciones FROM datos_correspondencia");
$tecnica=0;
$particular=0;
$unidad_mejora=0;
$enlace=0;
$SubdireccionfuncionPublica=0;
$SubdireccionNormatividad=0;
$unidadApoyo=0;
$direccionDesarrollo=0;
$direccionTransparencia=0;
$direccionAuditoria=0;
$direccionNormatividad=0;
$direccionInformatica=0;
$delegacion=0;
$unidadEvaluacion=0;
$unidadVinculacion=0;
	while($rows_direcc=mysqli_fetch_assoc($consulta_direcciones)){
		$id_direcciones=$rows_direcc['id_direcciones'];
		switch ($id_direcciones){
			    case 1:
				$tecnica++;
				break;
				  case 2:
				$particular++;
				break;
				case 3:
				$unidad_mejora++;
				break;
				case 4:
				$enlace++;
				break;
				case 5:
				$SubdireccionfuncionPublica++;
				break;
				case 6:
				$SubdireccionNormatividad++;
				break;
				case 7:
				$unidadApoyo++;
				break;
				case 8:
				$direccionDesarrollo++;
				break;
				case 9:
				$direccionTransparencia++;
				break;
				case 10:
				$direccionAuditoria++;
				break;
                case 11:
                $direccionNormatividad++;
                break;
                case 12:
                $direccionInformatica++;
                break;
                case 13:
                $delegacion++;
                break;
                case 14:
                $unidadEvaluacion++;
                break;
                case 15:
                $unidadVinculacion++;
                break;
		}
	}
?>
<script>
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
            labels: ["SECRETARÍA TÉCNICA","SECRETARÍA PARTICULAR", "UNIDAD DE MEJORA DE LA GESTIÓN", "ENLACE JURÍDICO", "SUBSECRETARÍA DE LA FUNCIÓN PÚBLICA", "SUBSECRETARÍA DE AUDITORÍA Y NORMATIVIDAD DE LA GESTIÓN PÚBLICA","UNIDAD DE APOYO A ÓRGANOS INTERNOS DE CONTROL","DIRECCIÓN DE DESARROLLO ORGANIZACIONAL","DIRECCIÓN DE TRANSPARENCIA Y ACCESO A LA INFORMACIÓN PÚBLICA","DIRECCIÓN DE AUDITORÍA GUBERNAMENTAL","DIRECCIÓN DE NORMATIVIDAD Y EVALUACIÓN DE LA GESTIÓN PÚBLICA","DIRECCIÓN DE INFORMÁTICA", "DELEGACIÓN ADMINISTRATIVA", "UNIDAD DE EVALUACIÓN DEL DESEMPEÑO", "UNIDAD DE VINCULACIÓN CON EL SISTEMA ESTATAL ANTICORRUPCIÓN"],
            datasets: [
                {
                    label: "Correspondencia ",
                    backgroundColor: [
                        'rgb(201, 178, 248 )',
                        'rgb(201, 178, 248 )',
                        'rgb(192, 165, 247 )',
                        'rgb(186, 156, 247 )',
                        'rgb(181, 148, 248 )',
                        'rgb(175, 139, 247 )',
                        'rgb(167, 128, 246 )',
                        'rgb(161, 119, 247 )',
                        'rgb(153, 107, 246 )',
                        'rgb(145, 95, 247  )',
                        'rgb(175, 139, 247 )',
                        'rgb(167, 128, 246 )',
                        'rgb(161, 119, 247 )',
                        'rgb(153, 107, 246 )',
                        'rgb(145, 95, 247  )'
                    ],
                    borderColor: [
                         'rgb(201, 178, 248   )',
                       'rgb(201, 178, 248 )',
                        'rgb(192, 165, 247  )',
                        'rgb(186, 156, 247    )',
                        'rgb(181, 148, 248     )',
                        'rgb(175, 139, 247  )',
                        'rgb(167, 128, 246 )',
                        'rgb(161, 119, 247     )',
                        'rgb(153, 107, 246  )',
                        'rgb(145, 95, 247   )',
                        'rgb(175, 139, 247  )',
                        'rgb(167, 128, 246 )',
                        'rgb(161, 119, 247     )',
                        'rgb(153, 107, 246  )',
                        'rgb(145, 95, 247   )'
                    ],
                    borderWidth: 1,
                   <?php
					echo(' data: ['.$tecnica.', '.$particular.', '.$unidad_mejora.', '.$enlace.', '.$SubdireccionfuncionPublica.', '.$SubdireccionNormatividad.', '.$unidadApoyo.', '.$direccionDesarrollo.', '.$direccionTransparencia.', '.$direccionAuditoria.', '.$direccionNormatividad.', '.$direccionInformatica.', '.$delegacion.', '.$unidadEvaluacion.', '.$unidadVinculacion.']');
					?>
                }
            ]
        }
    });

});

</script>