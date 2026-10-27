<?php
include('../../ajax/conexion.php');

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual=strftime("%Y-%m-%d");
$fecha_hora=date("Y-m-d H:i:s");
?>



<!-- Modal para revisar oficios -->
<div id="vinculaOficiosrioModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="vincula_oficiosrio" id="vincula_oficiosrio" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Vincular Oficios</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <fieldset class="scheduler-border">
                <legend class="scheduler-border">Buscar el Oficio:</legend>               
                    <div class="row">                        
                            <div class="col-md-3">
                            </div>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control" placeholder="datos de búsqueda" id="qq" name="qq" onkeyup="buscaofi(1);">                                
                            </div>
                            <div class="col-md-3">
                            </div>                                                
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group" align='center'>
                                <label class="">id-correspo:</label>
                                <input type="hidden" class="form-control font-weight-bold" name="vincula_id_ofi" maxlength="4"
                                    id="vincula_id_ofi">
                                <input type="text" class="form-control font-weight-bold" name="vincula_id" maxlength="4"
                                    id="vincula_id" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group" align='center'>
                                <label class="">#oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="vincula_nofi" maxlength="4"
                                    id="vincula_nofi" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group" align='center'>
                                <label for="vincula_foficio">Folio:</label>
                                <input type="text" class="form-control font-weight-bold" id="vincula_folio"
                                    name="vincula_folio" aria-describedby="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        <div class="" align='center'>
                        <label for="vincula_foficio">Adjunta el archivo de Respuesta:</label>
                        <div class="fileinput fileinput-new text-center text-danger" data-provides="fileinput">
							<div class="fileinput-preview fileinput-exists thumbnail "></div>
							<div>
								<span class="btn btn-raised btn-round btn-default btn-file">
									<input type="file" name="respuesta" id="respuesta" accept="application/pdf" required >
								</span>
							</div>
						</div> 
                        </div>                          
                        </div>
                        
                        <div class="col-4">
                        <div class="form-group" align='center'>
                            <label class="">Oprime al Final:</label>
                            <input type="submit" class="btn btn-success" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vincular Oficio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                            
                        </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                <legend class="scheduler-border">Datos de la consulta: (seleccionar el oficio)</legend>      
                    
                <div class='clearfix'></div>
                <hr>
                <div id="loader2"></div><!-- Carga de datos ajax aqui -->
                <div id="resultados2"></div><!-- Carga de datos ajax aqui -->               
                <div class='outer_div2'></div>
                </fieldset>   
                </div>                          
                <div class="modal-footer">
                    <div id="contenedorfooter">
                        <div class="table table-responsive">
                            <table class="table table-footer" style="width:100%">
                                <thead></thead>
                                <tbody id="tasks3"></tbody>
                            </table>
                        </div>
                        <div id="contenedorbotones">                           
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            
                        </div>
                    </div>
                </div>
                    
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<?php include("../../html/modal_add_corresp.php");?>
<!-- Edit Modal HTML -->
<?php include("../../html/modal_edit_corresp.php");?>
<!-- Delete Modal HTML -->
<?php include("../../html/modal_delete_corresp.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_views_corresp.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../vistas/modal_load_respuesta.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../../html/modal_delete_archivo.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../../html/modal_add_dep.php");?>
<!-- Mostrar Modal HTML -->
<?php include("../../html/modal_add_area.php");?>




<script>
include '../../ajax/pagination.php'; 

</script>