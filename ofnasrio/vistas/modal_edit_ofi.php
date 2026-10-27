<!-- Modal para editar requerimientos de pasantes de un Programa de Servicio Social -->
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

<div id="EditOficio" class="modal fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form name="edit_ofi_conocimiento" id="edit_ofi_conocimiento">
                <div class="modal-header">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="row">
                       
                          <div class="col-sm-12">
                           <input type="text" id="edit_idC" name="edit_idC" hidden="hidden">
                            <div class="form-group-material">
                              <label for="edit_remitente" class="label-material text-primary">Remitente</label>
                              <input id="edit_remitente" type="text" name="remitente" required class="form-control"  style="border-radius: 25px !important;"  >
                             
                            </div>
                            <div class="form-group">
                              <label for="edit_oficio" class="label-material text-primary" >Nº Oficio  </label>
                              <input id="edit_oficio" type="text" name="no_oficio" required class="form-control"  style="border-radius: 25px !important;" >
                             
                            </div>
                            <div class="form-group-material">
                             <label for="edit_fecha" class="label-material text-primary">fecha del oficio     </label>
                              <input id="edit_fecha" type="date" name="fecha" required class="form-control" style="border-radius: 25px !important;" >
                              
                            </div>
                            
                             <div class="form-group">
                                        <label for="asunto" class="label text-primary">Asunto</label>
                                        <textarea  class="form-control" id="edit_asunto" name="asunto" rows="5" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;" 
												  ></textarea >
                                    </div>
                           
                             <div class="form-group-material">
                             <label for="destinatario" class="label-material text-primary">destinatario     </label>
                              <input id="edit_destinatario" type="text" name="destinatario" required class="form-control" style="border-radius: 25px !important;" >
                              
                            </div>
                             <div class="form-group-material">
                             <label for="tipo" class="label-material text-primary">Tipo Documento     </label>
                              <input id="edit_tipo" type="text" name="tipo" required class="form-control" style="border-radius: 25px !important;" >
                              
                            </div>
                          </div>
                        </div>
					 <div class="row">
                 <div class="col-md-12" id="resultados1C" >Archivos1</div><!-- DOCUMENTOS -->	
               </div>
                             
                      
                </div>
              
                <div class="modal-footer">
		
                  
                       

                       
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
                           
                            <input type="submit" class="btn btn-success"  value="Guardar Cambio">
                            
                          
                       
                    
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->


