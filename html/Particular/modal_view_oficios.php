<!-- Modal para viewar requerimientos de pasantes de un Programa de Servicio Social -->
<div id="viewOficiosrevModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="view_oficiosrev" id="view_oficiosrev">
            <div class="modal-header">
                    <h4 class="modal-title">Mostrar Oficios Firmados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group" align='center'>
                                <label class=""># Oficio:</label>
                                <input type="hidden" class="form-control font-weight-bold" name="view_vrid" maxlength="4"
                                    id="view_vrid" readonly disabled style="background:#F4F4F4 !important;">
                                <input type="text" class="form-control font-weight-bold" name="view_vrfolio" maxlength="4"
                                    id="view_vrfolio" readonly disabled style="background:#F4F4F4 !important;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" align='center'>
                                <label class="">Número Oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="view_vrnofi" 
                                    id="view_vrnofi" maxlength="60" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" align='center'>
                                <label for="view_fsolicitado">Fecha asignación:</label>
                                <input type="date" class="form-control font-weight-bold" id="view_vrfsolicitado"
                                    name="view_vrfsolicitado" aria-describedby="" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" align='center'>
                                <label for="revisa_foficio">Fecha Oficio:</label>
                                <input type="date" class="form-control font-weight-bold" id="view_vrfoficio"
                                    name="view_vrfoficio" aria-describedby="" disabled>
                            </div>
                        </div>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Oficio:</legend>                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_vrnomofi"
                                        id="view_vrnomofi" placeholder="Nombre Destinatario" maxlength="200" disabled>
                                    <label for="view_nomofi">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="view_vrcargofi"
                                        id="view_vrcargofi" placeholder="Nombre Destinatario" maxlength="200" disabled>
                                    <label for="view_vrcargofi">Cargo:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="Actualizar_dependencia">
                                    <select class="mi-selector form-control font-weight-bold" id="view_vriddep"
                                        name="view_vriddep" style="width: 100%" disabled>
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
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="asunto_ofi">Asunto: </label>
                                    <textarea class="form-control" id="view_vrasuntoc" name="view_vrasuntoc" rows="2"
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
                                    <input type="text" class="form-control font-weight-bold" name="view_vrsolicitante"
                                        id="view_vrsolicitante" placeholder="Nombre del Solicitante" maxlength="200"
                                        disabled>
                                    <label for="view_vrsolicitante">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group" id="elige_area">
                                    <select class="mi-selector form-control font-weight-bold" id="view_vridarea"
                                        name="view_vridarea" style="width: 100%;" data-placeholder="Selecciona una opción"
                                        disabled>
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
                                    <input type="text" class="form-control font-weight-bold" name="view_vrnomrecibe" 
                                        id="view_vrnomrecibe" maxlength="60" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group" align='center'>
                                    <label for="view_vrfingreso">Fecha de Entrega:</label>
                                    <input type="date" class="form-control font-weight-bold" id="view_vrfingreso"
                                        name="view_vrfingreso" aria-describedby="" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group" align='center'>
                                    <label for="view_vrfentrega">Fecha de Entrega:</label>
                                    <input type="date" class="form-control font-weight-bold" id="view_vrfentrega"
                                        name="view_vrfentrega" aria-describedby="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="mostrar" >Archivos</div><!-- DOCUMENTOS -->	
                        </div>
                    </fieldset>
                    

                    </div>  
                <div class="modal-footer">
                    <div id="contenedorfooter">
                        <div class="table table-responsive">
                            <table  class="table table-footer" style="width:100%">
                                <thead></thead>
                                <tbody id="tasks3"></tbody>
                            </table>
                        </div>                                                                   
                        <div id="contenedorbotones">
                            <input type="button" class="btn btn-default item" data-dismiss="modal" value="Cerrar">
                           
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->



<!-- ************** Modal para duplicar correspondencia ******* -->



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