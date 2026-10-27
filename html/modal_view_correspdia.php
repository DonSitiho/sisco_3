<!-- Modal para viewar requerimientos de pasantes de un Programa de Servicio Social -->
<div id="viewCorrespondenciaModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="view_correspondencia" id="view_correspondencia">
                <div class="modal-header">
                    <h4 class="modal-title">Mostrar correspondencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class="">Folio:</label>
                                <input type="text" class="form-control font-weight-bold" name="view_folio"
                                    id="view_folio" value="<?php echo($folio) ?>" disabled>
                                <input type="hidden" name="view_id" id="view_id">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha oficio:</label>
                                <input type="date" class="form-control font-weight-bold" id="view_f_oficio"
                                    name="view_f_oficio" aria-describedby="" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class=""># Oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="view_num_oficio"
                                    id="view_num_oficio" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha recepción:</label>
                                <input type="date" class="form-control font-weight-bold" id="view_f_recepcion"
                                    name="view_f_recepcion" aria-describedby="" value="<?php echo($fecha_actual); ?>"
                                    disabled>
                            </div>
                        </div>

                    </div>
                    <ul class="nav nav-tabs" id="myTab3" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home3" aria-selected="false">Remitente</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false">Turnado A</a></li>
                    </ul>
                    <div class="tab-content" id="myTab3Content">
                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                            <p></p>
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
                                        <input class="form-check-input" type="radio" name="view_t_oficio" id="view_t_oficio" value="0" disabled>
                                        <label class="form-check-label" for="view_t_oficio"> Titular</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="view_t_oficio" id="view_t_oficio" value="1" disabled>
                                        <label class="form-check-label" for="view_t_oficio"> Copia</label>
                                    </div>
                                </div>                                
                            </div>
                            <p><p>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group" id="Actualizar_remitente">
                                        <select class="form-control font-weight-bold" id="view_enviadopor"
                                            name="view_enviadopor" style="width: 100%;"
                                            data-placeholder="Selecciona una opción" disabled>
                                            <option value=" ">Selecciona un destinatario ...</option>
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
                                        <input type="text" class="form-control font-weight-bold" name="view_cargodest"
                                            id="view_cargodest" placeholder="Cargo Destinatario" disabled required>
                                        <label for="view_cargodest">Cargo destinatario:</label>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="nombredest"
                                            id="nombredest" placeholder="Nombre Destinatario" required>
                                        <label for="nombredest">Nombre Destinatario:</label>
                                    </div>
                                </div>-->
                            </div>
                            </fieldset>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Datos remitente</legend>  
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group" id="Actualizar_remitente">
                                        <select class="form-control font-weight-bold" id="view_id_remitente"
                                            name="view_id_remitente" style="width: 100%;"
                                            data-placeholder="Selecciona una opción" disabled>
                                            <option value=" ">Selecciona el remitente ...</option>
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
                                        <input type="text" class="form-control font-weight-bold" name="view_cargo"
                                            id="view_cargo" placeholder="Cargo Remitente" disabled required>
                                        <label for="view_cargo">Cargo</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="view_nombre"
                                            id="view_nombre" placeholder="Nombre Remitente" disabled required>
                                        <label for="view_nombre">Nombre</label>
                                    </div>
                                </div>
                            </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="view_asunto">Asunto:</label>
                                        <textarea class="form-control" id="view_asunto" name="view_asunto" rows="4"
                                            disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="view_anexo"
                                            id="view_anexo" placeholder="Anexos" disabled required>
                                        <label for="view_anexo">Anexos</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="view_indica"
                                            id="view_indica" placeholder="Indicaciones" disabled required>
                                        <label for="view_indica">Indicaciones</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                            <p></p>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Área interna SECOEM</legend>
                                <p></p>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group" id="Actualizar_remitente">
                                        <select class="form-control font-weight-bold" id="view_areainterna"
                                            name="view_areainterna" style="width: 100%;"
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
                                        <textarea class="form-control" id="view_instruc" name="view_instruc" rows="2" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="view_obs">Observaciones:</label>
                                        <textarea class="form-control" id="view_obs" name="view_obs" rows="2"
                                            disabled></textarea>
                                        <input type="hidden" class="form-control font-weight-bold" name="view_status"
                                            id="view_status" value="1">
                                        <input type="hidden" class="form-control font-weight-bold" name="view_f_captura"
                                            id="view_f_captura" value="<?php echo($fecha_actual); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </fieldset>
                    </div>
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
                            <button type="button" class="btn btn-success btn-round item" id="copiar" name="copiar" onClick="CopiarCorrespondencia()">Copiar</button>
                            <button type="button" class="btn btn-warning btn-round item" id="duplicar" name="duplicar" onClick="DuplicarCorrespondencia()">Duplicar</button>
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->
<script>
var valor = document.getElementById("view_id").value;
document.getElementById("id-corr").value = valor;
</script>


<div class="modal fade" id="mdl_copiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                        <i class="material-icons">single-copy</i>
                    </div>
                    <h3 class="text-info text-center">Copiar Correspondencia</h5>
                </div>
                <div class="modal-body">
                    <form name="copy_corresp" id="copy_corresp">
                        <input type="hidden" id="id_usuario_c" name="id_usuario_c" value="<?php echo($id_usuario); ?>">
                        <input type="hidden" required="required" readonly id="id-corr" name="id-corr">
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
                <button type="submit" class="btn btn-primary">Generar Copias</button>
            </div>
            </form>
        </div>
    </div>
</div>

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