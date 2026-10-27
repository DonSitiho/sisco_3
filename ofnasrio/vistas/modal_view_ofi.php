<!-- Modal para viewar requerimientos de pasantes de un Programa de Servicio Social -->
<style>
hr {
 margin-bottom: 0px !important; margin-top: 0px !important; margin-left: 10px !important; margin-right: 10px !important; background:rgba(227,227,227,1.00) !important;
}
h6{
	font-family:Gotham, Helvetica Neue, Helvetica, Arial,' sans-serif' !important;
	}
	small{
		color: #4C4895;
	}
</style>
<?php


?>

<div id="viewCorrespondenciaModalCopia" class="modal fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form name="" id="FormRevisar">
                <div class="modal-header">
                    <h4 class="modal-title">Tarjeta Informativa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="row">
                  <input id="id_oficio" type="text" name="id_oficio" hidden  >
                       
                          <div class="col-sm-12">
                            <div class="form-group-material">
                              <label for="view_remitente" class="label-material text-primary">Remitente</label>
                              <input id="view_remitente" type="text" name="remitente" required class="form-control"  style="border-radius: 25px !important;" readonly >
                             
                            </div>
                            <div class="form-group">
                              <label for="view_oficio" class="label-material text-primary" >Nº Oficio  </label>
                              <input id="view_oficio" type="text" name="no_oficio" required class="form-control"  style="border-radius: 25px !important;" readonly>
                             
                            </div>
                            <div class="form-group-material">
                             <label for="view_fecha" class="label-material text-primary">fecha del oficio     </label>
                              <input id="view_fecha" type="date" name="fecha" required class="form-control" style="border-radius: 25px !important;" readonly>
                              
                            </div>
                            
                             <div class="form-group">
                                        <label for="asunto" class="label text-primary">Asunto</label>
                                        <textarea  class="form-control" id="view_asunto" name="asunto" rows="5" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;" readonly
												  ></textarea >
                                    </div>
                           
                             <div class="form-group-material">
                             <label for="destinatario" class="label-material text-primary">destinatario     </label>
                              <input id="view_destinatario" type="text" name="destinatario" required class="form-control" style="border-radius: 25px !important;" readonly>
                              
                            </div>
                             <div class="form-group-material">
                             <label for="tipo" class="label-material text-primary">Tipo Documento     </label>
                              <input id="view_tipo" type="text" name="tipo" required class="form-control" style="border-radius: 25px !important;" readonly>
                              
                            </div>
                          </div>
                        </div>
					 <div class="row">
                 <div class="col-md-12" id="resultados1" >Archivos1</div><!-- DOCUMENTOS -->	
               </div>
                             
                      
                </div>
              
                <div class="modal-footer">
		
                  
                       

                       
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
                            <input type="button" class="btn btn-info btn-round"  onclick="Revisado();" id="btnRevisar" name="btnRevisar" value="Marcar como revisado" id="btnRevisar">
                           
                            
                            
                          
                       
                    
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->


