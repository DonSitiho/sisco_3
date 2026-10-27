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

<div id="viewCorrespondenciaModalSeguimiento" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="edit_correspondencia" id="edit_correspondencia">
                <div class="modal-header">
                    <h4 class="modal-title">Resumen Correspondencia <span class="badge badge-success"> ORIGINAL </span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
					
                    <div class="row">
						
                        <div class="col-md-3">
                           <center>
                           <h6 id="view_folio"></h6><hr><small class="text-center">Folio</small>
                           </center>
                         <input type="text" name="view_id" id="view_id" hidden="" >
                          <input id="view_folio_input" type="text"  name="view_folio_input" hidden>
							   <input id="view_t_oficioinput" type="text" name="view_t_oficioinput" hidden>
                        </div>
                        <div class="col-md-3">
                           
                           <center>
                           <h6 id="view_f_recepcion"></h6><hr><small class="text-center">Fecha_Recepción</small>
                           </center>
                           
                           
                        </div>
                        <div class="col-md-3">
                          
                          <center>
                           <h6 id="view_num_oficio"></h6><hr><small class="text-center">	Oficio</small>
                           </center>
                           
                            
                        </div>
                        <div class="col-md-3">
                           <center>
                           <h6 id="view_f_oficio"></h6><hr><small class="text-center">Fecha del Oficio</small>
                           </center>
                           
                         
                        </div>
                        </div>
                  
                  
                               <div class="notice notice-success" style="border-radius: 25px !important; " >
                            <div class="card-header text-center notice notice-success redondeo"> <h3 style="color:rgba(48,0,66,1.00)">Datos del Remitente</h3></div>
                            <div class="card-body">
                            
                              
                        <!--    <div class="row">
                                
                                <div class="col-md-3">
                                    <label class="">Documento para :</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name=""
                                            id="" value="0" disabled>
                                        <label class="form-check-label" for="view_t_oficio"> Titular</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="view_t_oficio"
                                            id="view_t_oficio" value="1" >
                                        <label class="form-check-label" for="view_t_oficio"> Copia</label>
                                    </div>
                                </div>
                               
                            </div>-->
							
                            <div class="row">
                                <div class="col-md-12">
								 <center>
                           <h6 id="view_id_remitente"></h6><hr><small class="text-center">Nombre Remitente</small>
                           </center>	
								
							</div>
                              
                            </div>
							
                            <div class="row">
                                <div class="col-md-6">
							<center>
                           <h6 id="view_cargo" ></h6><hr><small class="text-center">Cargo Remitente </small>
                           </center>
                                   
                                </div>
                                <div class="col-md-6">
									
									<center>
                           <h6 id="view_nombre" ></h6><hr><small class="text-center">Nombre Remitente</small>
                           </center>
									
                                 
                                </div>
                            </div>
							 </div>
							</div>
                             <div class="card bg-light mb-3 notice notice-info" style="border-radius: 25px !important;">
                           <div class="card-header text-center notice notice-info redondeo" ><h3 style="color:rgba(22,0,58,1.00) !important;  ">Datos del Destinatario</h3></div>
                           <div class="card-body">
                            <div class="row">
							
								
                                <div class="col-md-12">
											<center>
                           <h6 id="view_enviadopor"></h6><hr><small class="text-center">Nombre Destinatario</small>
                           </center>
                                 
                                </div>
                              
                            </div>
							<br>
                            <div class="row">
                                <div class="col-md-12">
										<center>
                           <h6 id="view_cargodest"></h6><hr><small class="text-center">Cargo Destinatario </small>
                           </center>
                                  
                                </div>
                                <!--<div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="nombredest"
                                            id="nombredest" placeholder="Nombre Destinatario" required>
                                        <label for="nombredest">Nombre Destinatario:</label>
                                    </div>
                                </div>-->
                            </div>
							<br>
                            <div class="row">
                                <div class="col-md-12">
											<center>
                           <h6 id="view_asunto"></h6><hr><small class="text-center">Asunto </small>
                           </center>
                                   
                                </div>
                            </div>
                                <div class="row">
                                <div class="col-md-12">
											<center>
                           <h6 id="view_anexo"></h6><hr><small class="text-center">Anexos </small>
                           </center>
                                  
                                </div>

                              <!--  <div class="col-md-6">
											<center>
                           <h6 id="view_indica"></h6><hr><small class="text-center">Indicaciones </small>
                           </center>
                                   
                                </div>-->
                            </div>
							</div>
                             </div>
                         <div class="notice notice-warning" style="border-radius: 25px !important;">
                           <div class="card-header text-center notice notice-warning redondeo" ><h3 style="color: rgba(85,94,0,1.00)">Turnado A:</h3></div>
                           <div class="card-body">
                          
							<div class="row">
                                <div class="col-md-12">
                                
                                		<center>
                           <h6 id="view_areainterna"></h6><hr><small class="text-center">Dirección:</small>
                           </center>
									
                                   
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                
                                		<center>
                           <h6 id="view_instruc"></h6><hr><small class="text-center">Instrucciones:</small>
                           </center>
									
                                   
                                </div>
                            </div>
							<br>	
                            <div class="row">
                                <div class="col-md-12">
									
                                    <div class="form-group">
													<center>
                           <h6 id="view_obs"></h6><hr><small class="text-center">Observaciones</small>
                           </center>
                                       
                                    </div>
                                </div>
                            </div>
                            
                             </div>
                               </div>
                                <div class="row">
                 <div class="col-md-12" id="resultados1" >Archivos</div><!-- DOCUMENTOS -->	
                </div>
                               <div class="row">
                                <div class="col-md-12">
									
                                    <div class="form-group">
											<select class="form-control mb-6" id="estatus" name="estatus" required
                                class="input-material" >
                                <option value="">Selecciona un estatus ...</option>
                                
                                           <option value="1" class="text-warning">Pendiente</option>
                                           <option value="2" class="text-primary">Autorizado</option>
                                           <option value="3" class="text-info">Seguimiento</option>
                                           <option value="6" class="text-success">Finalizado</option>
                                       
                            </select>
                                       
                                       <!-- <input type="file" class="form-control font-weight-bold" name="doc_resp"
                                            id="doc_resp" >-->
                                            <!-- <h6 id="view_obs"></h6><hr><small class="text-center">Respuesta</small>-->
                                    </div>
                                </div>
                            </div>
                      
                </div>
               
                
                <div class="modal-footer">
		
                  
                       
<input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar" id="">
                        <input type="submit" class="btn btn-warning" value="Editar">
                            <!--<input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar" id="">
                               <input type="button" class="btn btn-info btn-round"  onclick="Seguimiento();" value="Adjuntar Archivo" id="btnSeguimiento">
                            <input type="submit" class="btn btn-success btn-round" value="Finalizar" id="btnfinalizar" >-->
                            <div class="conteiner-fluid" id="resultados12" style="text-align: right !important;"></div>
                          
                       
                    
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->


