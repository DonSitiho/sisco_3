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

<div id="viewOfiRecibidos" class="modal fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form name="" id="">
                <div class="modal-header">
                    <h4 class="modal-title">Tarjeta - Informativa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="row">
                       
                          <div class="col-sm-12">
                            <div class="form-group-material">
                              <label for="view_remitente1" class="label-material text-primary">Remitente</label>
                              <input id="view_remitente1" type="text" name="view_remitente1" required class="form-control"  style="border-radius: 25px !important;" readonly maxlength="200">
                             
                            </div>
                            <div class="form-group">
                              <label for="view_oficio1" class="label-material text-primary" >Nº Oficio  </label>
                              <input id="view_oficio1" type="text" name="view_oficio1" required class="form-control"  style="border-radius: 25px !important;" readonly maxlength="150">
                             
                            </div>
                            <div class="form-group-material">
                             <label for="view_fecha1" class="label-material text-primary">fecha del oficio     </label>
                              <input id="view_fecha1" type="date" name="view_fecha1" required class="form-control" style="border-radius: 25px !important;" readonly>
                              
                            </div>
                            
                             <div class="form-group">
                                        <label for="view_asunto1" class="label text-primary">Asunto</label>
                                        <textarea  class="form-control" id="view_asunto1" name="view_asunto1" rows="5" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;" readonly
												  ></textarea >
                                    </div>
                           
                             <div class="form-group-material">
                             <label for="view_destinatario1" class="label-material text-primary">destinatario     </label>
                              <input id="view_destinatario1" type="text" name="view_destinatario1" required class="form-control" style="border-radius: 25px !important;" readonly maxlength="200">
                              
                            </div>
                             <div class="form-group-material">
                             <label for="view_tipo1" class="label-material text-primary">Tipo Documento     </label>
                              <input id="view_tipo1" type="text" name="view_tipo1" required class="form-control" style="border-radius: 25px !important;" readonly>
                              
                            </div>
                          </div>
                        </div>
					 <div class="row">
                 <div class="col-md-12" id="resultados2" >Archivos1</div><!-- DOCUMENTOS -->	
               </div>
              <div>
              

              </div>

                             
                      
                </div>
              
                <div class="modal-footer">
		
                  
                       

                       
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
                           
                            
                            
                          
                       
                    
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->


