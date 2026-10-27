<!-- Modal para viewar requerimientos de pasantes de un Programa de Servicio Social -->
<style>
hr {
 margin-bottom: 0px !important; margin-top: 0px !important; margin-left: 10px !important; margin-right: 10px !important; background:rgba(227,227,227,1.00) !important;
}
h6{
	font-family:Gotham, Helvetica Neue, Helvetica, Arial,' sans-serif' !important;
	color: #525050;
	}
	small{
		color: #4C4895;
	}
</style>
<?php


?>

<div id="viewCorrespondenciaModal" class="modal fade" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content" style="border-radius: 25px !important; ">
            <form name="view_correspondencia" id="view_correspondencia">
                <div class="modal-header">
                    <h4 class="modal-title" >Resumen Correspondencia <span class="badge badge-warning">Pendiente</span></h4>
         
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
					
                  <!-- encabezado de datos -->
                    <div class="row">
						
                        <div class="col-md-3">
                           <center>
                           <h6 id="view_folio"><?php echo($folio ?? '') ?></h6><hr><small class="text-center">Folio</small>
                           </center>
                         <input type="text" name="view_id" id="view_id" hidden="" >
                          <input type="text" name="folio" id="folio"   hidden="">
                        </div>
                        <div class="col-md-3">
                           
                           <center>
                           <h6 id="view_f_recepcion"></h6><hr><small class="text-center">Fecha de Recepción</small>
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
				
                  <!-- encabezado de datos -->
          
                    
                           <div class="notice notice-success" style="border-radius: 25px !important; " >
                            <div class="card-header text-center notice notice-success redondeo" > <h3 style="color:rgba(0,45,13,1.00)">Datos del Remitente</h3></div>
                            <div class="card-body">
                         <!--   <div class="row">
                                
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
                           <h6 id="view_id_remitente"></h6><hr><small class="text-center">Dependencia</small>
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
                              <div class="row">
                               
                                 <div class="col-md-12">
									
                                    <div class="form-group">
                                        <label for="view_asunto" class="label">Asunto:<small class="text-primary"> * Este campo se pede modificar *</small></label>
                                        <textarea  class="form-control" id="view_asunto" name="view_asunto" rows="5" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;"
												  ></textarea >
                                    </div>
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
                           <h6 id="view_enviadopor"></h6><hr><small class="text-center">Dependencia</small>
                           </center>
                                 
                                </div>
                              
                            </div>
							<br>
                            <div class="row">
                                <div class="col-md-12">
										<center>
                           <h6 id="view_cargodest"></h6><hr><small class="text-center">Nombre/Cargo</small>
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
                           <h6 id="view_areainterna"></h6><hr><small class="text-center">Direcciones </small>
                           </center>
                                	    
                                 	<div class="col-md-12" id="div_copias"></div>
                                  
                               
                             <!--    <div class="form-group row">
                        
                          <div class="col-sm-12">
                            <label for="view_areainternas" class="label">Direcciones:<small class="text-warning" > * Este campo se pede modificar *</small></label>
                            <select name="view_areainternas" id="view_areainternas" class="form-control mb-3 text-center" style="border-radius: 25px !important;">
                             
                                            <?php
											/*	$direccion=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion!=0 AND id_direccion!=2");
                                                while($row_direc=mysqli_fetch_assoc($direccion)){
                                                  echo('<option value="'.$row_direc['id_direccion'].'">'.($row_direc['nombre_direccion']).'</option>');*/
                                              /*  }*/
											?>
                            </select>
                          
                          </div>
                         
                        </div>-->
                      
						
                                
                                </div>
                               
                            </div>
                          
                             <!-- <div class="row">
                              <div class="col-md-12">
                        	<div class="card">
<h5 class="card-header">Direcciones <small class="text-warning" > * Este campo se pede modificar *</small></label></h5>
<div class="card-body" style="border-radius: 25px !important;">
<select id="keep-order" multiple='multiple' name="keep-order[]" style="border-radius: 25px !important;">
 <?php
												/*$direccion=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE id_direccion!=0 AND id_direccion!=2");
                                                while($row_direc=mysqli_fetch_assoc($direccion)){
                                                  echo('<option value="'.$row_direc['id_direccion'].'">'.($row_direc['nombre_direccion']).'</option>');
                                                }*/
											?>
</select>
</div>
</div>
                        </div>
                        </div>-->
						
                           <!-- <div class="row">
										
                                <div class="col-md-6">
											<center>
                           <h6 id="view_f_turnado"></h6><hr><small class="text-center">Turnado el día </small>
                           </center>
                                   
                                </div>
                                <div class="col-md-6">
												<center>
                           <h6 id="view_f_recepArea"></h6><hr><small class="text-center">Fecha de recepción Area:</small>
                           </center>
                                   
                                </div>
                            </div>-->
						
                            <div class="row">
                                <div class="col-md-12">
									
                                    <div class="form-group">
                                        <label for="view_instruc" class="label">Instrucciones:<small class="text-primary" > * Este campo se pede modificar *</small></label>
                                        <textarea  class="form-control" id="view_instruc" name="view_instruc" rows="2" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="999" style="border-radius: 25px !important;"
												  ></textarea >
                                    </div>
                                </div>
                            </div>
							<br>	
                            <div class="row">
                                <div class="col-md-12">
									 <div class="form-group">
                                        <label for="view_asunto" class="label">Observaciones:<small class="text-primary"> * Este campo se pede modificar *</small></label>
                                        <textarea  class="form-control" id="view_obs" name="view_obs" rows="1" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1000" style="border-radius: 25px !important;"
												  ></textarea >
                                    </div>
                                    <div class="form-group">
												<!--	<center>
                           <h6 id="view_obs"></h6><hr><small class="text-center">Observaciones</small>
                           </center>-->
                                       
                                        <input type="hidden" class="form-control font-weight-bold" name="view_f_captura"
                                            id="view_f_captura" value="<?php echo($fecha_actual ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                         
                       
                      <div class="row">
                
                 <div class="col-md-12" id="resultados1" >Archivos</div><!-- DOCUMENTOS -->	
                   
                </div>
                  
                </div>
              
                
                
                <div class="modal-footer">
		
              
                       

                       
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
                            <input type="button" class="btn btn-info btn-round"  onclick="Guardar_cambios();" value="Guardar Cambios">
                            <input type="submit" class="btn btn-success btn-round" value="Autorizar">
                            
                          
                       
                    
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->


