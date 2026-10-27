<?php
include('../../ajax/conexion.php');

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual=strftime("%Y-%m-%d");
$fecha_hora=date("Y-m-d H:i:s");
?>



<!-- Modal para revisar oficios -->
<div id="revisaOficiosrioModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="revisa_oficiosrio" id="revisa_oficiosrio">
                <div class="modal-header">
                    <h4 class="modal-title">Revisión de Oficios1</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group" align='center'>
                                <label class="">id Oficio:</label>
                                <input type="hidden" class="form-control font-weight-bold" name="revisa_id" maxlength="4"
                                    id="revisa_id" readonly>
                                <input type="text" class="form-control font-weight-bold" name="revisa_rfolio" maxlength="4"
                                    id="revisa_rfolio" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" align='center'>
                                <label class="">Número Oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="revisa_nofi" 
                                    id="revisa_nofi" maxlength="60" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" align='center'>
                                <label for="revisa_foficio">Fecha asignación:</label>
                                <input type="date" class="form-control font-weight-bold" id="revisa_fsolicitado"
                                    name="revisa_fsolicitado" aria-describedby="" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" align='center'>
                                <label for="revisa_foficio">Fecha Oficio:</label>
                                <input type="date" class="form-control font-weight-bold" id="revisa_foficio"
                                    name="revisa_foficio" aria-describedby="" min="" max="" onclick="actualizarRango()" required>
                            </div>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Oficio:</legend>                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="revisa_nomofi"
                                        id="revisa_nomofi" placeholder="Nombre Destinatario" maxlength="200" required>
                                    <label for="revisa_nomofi">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="revisa_cargofi"
                                        id="revisa_cargofi" placeholder="Nombre Destinatario" maxlength="200" required>
                                    <label for="revisa_cargofi">Cargo:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_dependencia">
                                    <select class="mi-selector form-control font-weight-bold" id="revisa_iddep"
                                        name="revisa_iddep" style="width: 100%" required>
                                        <option value=" ">Selecciona una Dependencia ...</option>
                                        <?php
												$remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
												while($dep=mysqli_fetch_assoc($remitenet)){
												$emisor=$dep['identificador'].'-'.($dep['nombre']);
												echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
												}
											?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="#addDepModal" class="add" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip"
                                        title="Agregar Dependencia">add</i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="revisa_asunto">Asunto: </label>
                                    <textarea class="form-control" id="revisa_asunto" name="revisa_asunto" rows="2"
                                        maxlength="999" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Solicitante</legend>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="revisa_solicitante"
                                        id="revisa_solicitante" placeholder="Nombre del Solicitante" maxlength="200"
                                        required>
                                    <label for="revisa_solicitante">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group" id="revisa_area">
                                    <select class="mi-selector form-control font-weight-bold" id="revisa_idarea"
                                        name="revisa_idarea" style="width: 100%;" data-placeholder="Selecciona una opción"
                                        required>
                                        <option value=" ">Selecciona el área que solicita ...</option>
                                        <?php
                                            $remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS where identificador = '005' OR identificador='006-1' OR identificador='006-2'");
                                            while($dep=mysqli_fetch_assoc($remitenet)){
                                            $emisor=$dep['sigla'].'-'.($dep['nombre']);
                                            echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                    <br>
                        <legend class="scheduler-border">Datos de Recepción del Oficio</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" align='center'>
                                    <label class="">Nombre de quien recibe:</label>
                                    <input type="text" class="form-control font-weight-bold" name="revisa_nomrecibe" 
                                        id="revisa_nomrecibe" maxlength="60" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group" align='center'>
                                    <label for="revisa_fingreso">Fecha ingreso firma:</label>
                                    <input type="date" class="form-control font-weight-bold" id="revisa_fingreso"
                                        name="revisa_fingreso" aria-describedby="" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group" align='center'>
                                    <label for="revisa_fentrega">Fecha de Entrega:</label>
                                    <input type="date" class="form-control font-weight-bold" id="revisa_fentrega"
                                        name="revisa_fentrega" aria-describedby="" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    </div>                          

                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Actualizar oficios">
                    </div>
            </form>
        </div>
    </div>
</div>

<script>


$(document).ready(function() {
    $('.mi-selector').select2({
        width: 'resolve' // need to override the changed default    
    });

});
    
    
function actualizarRango() {
  // Obtener el valor de la fecha de asignación del Oficio
  var fechaAsignación = document.getElementById("revisa_fsolicitado").value;

  // Obtener el año de la fecha de asignación
  var anoEstablecido = new Date(fechaAsignación).getFullYear();

  // Obtener el campo de entrada de fecha del oficio firmado
  var fechaLimitada = document.getElementById("revisa_foficio");

  // Establecer el rango mínimo como el primer día del año y el máximo como el último día del año
  fechaLimitada.min = anoEstablecido + "-01-01";
  fechaLimitada.max = anoEstablecido + "-12-31";
}
</script>