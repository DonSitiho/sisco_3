<!-- Modal para viewar requerimientos de pasantes de un Programa de Servicio Social -->
<div id="viewCorrespondenciaModals" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="view_correspondencias" id="view_correspondencias">
                <div class="modal-header">
                    <h4 class="modal-title">Mostrar Correspondencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class="">Folio:</label>
                                <input type="text" class="form-control font-weight-bold" name="view_folios"
                                    id="view_folios" value="<?php echo($folio) ?>" disabled>
                                <input type="hidden" name="view_ids" id="view_ids">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha oficio:</label>
                                <input type="date" class="form-control font-weight-bold" id="view_f_oficios"
                                    name="view_f_oficios" aria-describedby="" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class=""># Oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="view_num_oficios"
                                    id="view_num_oficios" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha_Recepción:</label>
                                <input type="date" class="form-control font-weight-bold" id="view_f_recepcions"
                                    name="view_f_recepcions" aria-describedby="" value="<?php echo($fecha_actual); ?>"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Documento para:</legend>
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-3">
                                <label class="">Documento para :</label>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="view_t_oficio" id="view_t_oficio"
                                        value="0" disabled>
                                    <label class="form-check-label" for="view_t_oficio"> Titular</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="view_t_oficio" id="view_t_oficio"
                                        value="1" disabled>
                                    <label class="form-check-label" for="view_t_oficio"> Copia</label>
                                </div>
                            </div>
                        </div>
                        <p>
                            <p>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group" id="Actualizar_remitente">
                                            <select class="form-control font-weight-bold" id="view_enviadopors"
                                                name="view_enviadopors" style="width: 100%;"
                                                data-placeholder="Selecciona una opción" disabled>
                                                <option value=" ">Selecciona un Destinatario ...</option>
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
                                        <a href="#modal_dependencias" class="add" data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip"
                                                title="Agregar Dependencia">add</i></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control font-weight-bold"
                                                name="view_cargodests" id="view_cargodests"
                                                placeholder="Cargo Destinatario" disabled required>
                                            <label for="view_cargodest">Cargo Destinatario:</label>
                                        </div>
                                    </div>
                                </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos Remitente</legend>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_remitente">
                                    <select class="form-control font-weight-bold" id="view_id_remitentes"
                                        name="view_id_remitentes" style="width: 100%;"
                                        data-placeholder="Selecciona una opción" disabled>
                                        <option value=" ">Selecciona el Remitente ...</option>
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
                                <a href="#modal_dependencias" class="add" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip"
                                        title="Agregar Dependencia">add</i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_cargos"
                                        id="view_cargos" placeholder="Cargo Remitente" disabled required>
                                    <label for="view_cargo">Cargo</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_nombres"
                                        id="view_nombres" placeholder="Nombre Remitente" disabled required>
                                    <label for="view_nombre">Nombre</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Asunto:</legend><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="view_asuntos" name="view_asuntos" rows="4"
                                        placeholder="Asunto" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_anexos"
                                        id="view_anexos" placeholder="Anexos" disabled required>
                                    <label for="view_anexo">Anexos</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_indicas"
                                        id="view_indicas" placeholder="Indicaciones" disabled required>
                                    <label for="view_indica">Indicaciones</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Área interna SECOEM</legend>
                        <p></p>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_remitente">
                                    <select class="form-control font-weight-bold" id="view_areainternas"
                                        name="view_areainternas" style="width: 100%;"
                                        data-placeholder="Selecciona una opción" disabled>
                                        <option value=" ">Selecciona el área a que se turna el oficio ...</option>
                                        <?php
                                            $direccion=mysqli_query($conexion, "SELECT * FROM direcciones_secoem");
                                            while($row_direc=mysqli_fetch_assoc($direccion)){
                                                echo('<option value="'.$row_direc['id_direccion'].'">'.($row_direc['nombre_direccion']).'</option>');
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="#modal_dependencias" class="add" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip"
                                        title="Agregar Dependencia">add</i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="view_instruc">Instrucciones:</label>
                                    <textarea class="form-control" id="view_instrucs" name="view_instrucs" rows="2"
                                        disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="view_obs">Observaciones:</label>
                                    <textarea class="form-control" id="view_obss" name="view_obss" rows="2"
                                        disabled></textarea>
                                    <input type="hidden" class="form-control font-weight-bold" name="view_statuss"
                                        id="view_statuss" value="1">
                                    <input type="hidden" class="form-control font-weight-bold" name="view_f_capturas"
                                        id="view_f_capturas" value="<?php echo($fecha_actual); ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <div id="contenedorfooter">
                        <div class="table table-responsive">
                            <table class="table table-footer" style="width:100%">
                                <thead></thead>
                                <tbody id="tasks2"></tbody>
                            </table>
                        </div>
                        <div id="contenedorbotones">
                            <input type="button" class="btn btn-default item" data-dismiss="modal" value="Cerrar">
                            <button type="button" class="btn btn-success btn-round item" id="copiar" name="copiar" onclick ="seleccionarOficio()">Seleccionar</button>                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="js/multiselect/jquery.multi-select.js"></script>
<script>

function seleccionarOficio() {
    var id_correspo = document.getElementById("view_ids").value;
    var folio_correspo = document.getElementById("view_folios").value;
    var ofi_correspo = document.getElementById("view_num_oficios").value;
    
    document.getElementById("vincula_id").value = id_correspo;
    document.getElementById("vincula_nofi").value = ofi_correspo;
    document.getElementById("vincula_folio").value = folio_correspo;

    $('#viewCorrespondenciaModals').modal('hide');
}

</script>