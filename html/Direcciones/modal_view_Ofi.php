<!-- Modal para viewar requerimientos de pasantes de un Programa de Servicio Social -->
<style>
hr {
    margin-bottom: 0px !important;
    margin-top: 0px !important;
    margin-left: 10px !important;
    margin-right: 10px !important;
    background: rgba(227, 227, 227, 1.00) !important;
}

h6 {
    font-family: Gotham, Helvetica Neue, Helvetica, Arial, ' sans-serif' !important;
}

small {
    color: #4C4895;
}
</style>
<?php


?>

<div id="viewCorrespondenciaModalCopia" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="add_corresp" id="add_corresp" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Tarjeta de conocimiento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="card" style="border-radius: 25px !important; ">
                        <div class="card-body">

                            <div class="card-header text-center notice notice-danger redondeo-center">
                                <h3 style="color: rgba(8,16,104,1.00)">DATOS DEL REMITENTE</h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="text-primary">Tipo
                                            Documento</label>
                                        <input class="form-control font-weight-bold" id="view_tipo" name="view_tipo"
                                            style="border-radius: 25px !important;" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="no_oficio" class="label-material text-primary">Nº Documento </label>
                                        <input id="view_oficio" type="text" name="view_oficio"
                                            class="form-control font-weight-bold"
                                            style="border-radius: 25px !important;" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fecha" class="label-material text-primary">fecha Documento </label>
                                        <input id="view_fecha" type="date" name="view_fecha" required
                                            class="form-control font-weight-bold"
                                            style="border-radius: 25px !important;" readonly>
                                    </div>
                                </div>
                               
                                   
                                        
                                       
                                        <input id="view_no_referencia" type="hidden" name="view_no_referencia" required
                                            class="form-control font-weight-bold"
                                            style="border-radius: 25px !important;" readonly>
                                   
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <label for="remitente" class="label-material text-primary">Remitente</label>
                                        <input id="view_remitente" type="text" name="view_remitente" required
                                            class="form-control font-weight-bold"
                                            style="border-radius: 25px !important;" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="asunto" class="text-primary">Asunto:</label>
                                        <textarea class="form-control font-weight-bold" style="border-radius: 25px !important;"
                                            id="view_asunto" name="view_asunto" rows="3"
                                            style="border-radius: 25px !important;" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="resultados1" name="resultados1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="border-radius: 25px !important; ">
                        <div class="card-body">
                            <div class="card-header text-center notice notice-danger redondeo-center">
                                <h3 style="color: rgba(8,16,104,1.00)">DATOS DEL DESTINATARIO</h3>
                            </div>
                            
                            <div class="row">
                                <p></p>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <label for="destinatario" class="label-material text-primary">Nombre
                                            destinatario </label>
                                        <input id="view_destinatario" type="text" name="view_destinatario" required
                                            class="form-control" style="border-radius: 25px !important;" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                        <label for="selectormultiple" class="text-primary">Destinatarios </label>
                                        <br>
                                        <div id="resultadosOriginal"></div>
                                        
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="selectormultiple" class="text-primary">CC: TITULAR </label>
                                        <br>
                                        <div id="view_titular"></div>
                                        
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="selectormultiple" class="text-primary">CC: </label>
                                        <br>
                                        <div id="resultadosM"></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Guardar datos">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->