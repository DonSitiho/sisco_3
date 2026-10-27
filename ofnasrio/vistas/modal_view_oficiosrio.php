<!-- Modal para viewar requerimientos de pasantes de un Programa de Servicio Social -->
<div id="viewOficiosrioModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="view_oficiosrio" id="view_oficiosrio">
            <div class="modal-header">
                    <h4 class="modal-title">Mostrar Oficio Asignado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class=""># Oficio:</label>
                                <input type="hidden" class="form-control font-weight-bold" name="view_id" maxlength="4"
                                    id="view_id" readonly disabled>
                                <input type="text" class="form-control font-weight-bold" name="view_folio" maxlength="4"
                                    id="view_folio" readonly disabled>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group" align='center'>
                                <label for="view_fsolicitado">Fecha asignación:</label>
                                <input type="date" class="form-control font-weight-bold" id="view_fsolicitado"
                                    name="view_fsolicitado" aria-describedby="" disabled>
                            </div>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Oficio:</legend>                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_nomofi"
                                        id="view_nomofi" placeholder="Nombre Destinatario" maxlength="200" disabled>
                                    <label for="view_nomofi">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_cargofi"
                                        id="view_cargofi" placeholder="Nombre Destinatario" maxlength="200" disabled>
                                    <label for="view_cargofi">Cargo:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_dependencia">
                                    <select class="mi-selector form-control font-weight-bold" id="view_iddep"
                                        name="view_iddep" style="width: 100%" disabled>
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
                                    <textarea class="form-control" id="view_asuntodoc" name="view_asuntodoc" rows="2"
                                        maxlength="999" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Solicitante</legend>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_solicitante"
                                        id="view_solicitante" placeholder="Nombre del Solicitante" maxlength="200"
                                        disabled>
                                    <label for="view_solicitante">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group" id="elige_area">
                                    <select class="mi-selector form-control font-weight-bold" id="view_idarea"
                                        name="view_idarea" style="width: 100%;" data-placeholder="Selecciona una opción"
                                        disabled>
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
                    <div id="contenedorfooter">
                        <div class="table table-responsive">
                            <table  class="table table-footer" style="width:100%">
                                <thead></thead>
                                <tbody id="tasks"></tbody>
                            </table>
                        </div>                                                                   
                        <div id="contenedorbotones">
                            <input type="button" class="btn btn-default item" data-dismiss="modal" value="Cerrar">
                            <!-- <button type="button" class="btn btn-success btn-round item" id="copiar" name="copiar" onClick="CopiarCorrespondencia()">Copiar</button>
                            <button type="button" class="btn btn-warning btn-round item" id="duplicar" name="duplicar" onClick="DuplicarCorrespondencia()">Duplicar</button> -->
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->



<!-- ************** Modal para duplicar correspondencia ******* -->


<div class="modal fade" id="mdl_duplicar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                        <i class="material-icons">single-copy</i>
                    </div>
                    <h3 class="text-info text-center">Duplicar Correspondencia</h5>
                </div>
                <div class="modal-body">
                    <form name="duplica_corresp" id="duplica_corresp">
                        <input type="hidden" id="id_usuario_c" name="id_usuario_c" value="<?php echo($id_usuario); ?>">
                        <input type="hidden" required="required" readonly id="id-corr1" name="id-corr1" />
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--<label for="exampleInputPassword1">Cantidad</label>-->
                                    <input type="number" name="cantidad" class="form-control" id="exampleInputPassword1"
                                        placeholder="Cantidad" required min="1" max="99">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Generar Duplicados</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>

<script>
function CopiarCorrespondencia() {
    var valor = document.getElementById("view_id").value;
    document.getElementById("id-corr").value = valor;
    $('#mdl_copiar').modal({
        show: true,
        backdrop: 'static'
    });
}

function DuplicarCorrespondencia() {
    var valor1 = document.getElementById("view_id").value;
    document.getElementById("id-corr1").value = valor1;
    $('#mdl_duplicar').modal({
        show: true,
        backdrop: 'static'
    });
}
</script>