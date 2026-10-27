<?php
include('../../ajax/conexion.php');

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual=strftime("%Y-%m-%d");
$fecha_hora=date("Y-m-d H:i:s");
?>



<!-- Modal para editar requerimientos de pasantes de un Programa de Servicio Social -->
<div id="editOficiosrioModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="edit_oficiosrio" id="edit_oficiosrio">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Oficios Asignados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class=""># Oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="edit_folio" id="edit_folio" readonly>
                                <input type="hidden" class="form-control font-weight-bold" name="edit_id" maxlength="4"
                                    id="edit_id" readonly>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group" align='center'>
                                <label for="edit_foficio">Fecha asignación:</label>
                                <input type="date" class="form-control font-weight-bold" id="edit_fsolicitado"
                                    name="edit_fsolicitado" aria-describedby="" required>
                            </div>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Oficio:</legend>                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="edit_nomofi"
                                        id="edit_nomofi" placeholder="Nombre Destinatario" maxlength="200" required>
                                    <label for="edit_nomofi">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="edit_cargofi"
                                        id="edit_cargofi" placeholder="Nombre Destinatario" maxlength="200" required>
                                    <label for="edit_cargofi">Cargo:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_dependencia">
                                    <select class="mi-selector form-control font-weight-bold" id="edit_iddep"
                                        name="edit_iddep" style="width: 100%" required>
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
                                    <label for="asunto_ofi">Asunto: </label>
                                    <textarea class="form-control" id="edit_asunto" name="edit_asunto" rows="2"
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
                                    <input type="text" class="form-control font-weight-bold" name="edit_solicitante"
                                        id="edit_solicitante" placeholder="Nombre del Solicitante" maxlength="200"
                                        required>
                                    <label for="edit_solicitante">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group" id="elige_area">
                                    <select class="mi-selector form-control font-weight-bold" id="edit_idarea"
                                        name="edit_idarea" style="width: 100%;" data-placeholder="Selecciona una opción"
                                        required>
                                        <option value=" ">Selecciona el área que solicita ...</option>
                                          <?php
												$remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS where identificador = '005' OR identificador='006-1' OR identificador='006-2'");
												while($dep=mysqli_fetch_assoc($remitenet)){
												$emisor=$dep['identificador'].'-'.($dep['nombre']);
												echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
												}
											?>
                                    </select>
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

