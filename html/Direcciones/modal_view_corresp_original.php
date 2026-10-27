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

<div id="viewCorrespondenciaModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="finalizar_correspondencia" id="finalizar_correspondencia" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Resumen Correspondencia <span class="badge badge-success"> ORIGINAL </span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
					
                    <div class="row">
						
                        <div class="col-md-3">
                           <center>
							   <input id="view_folio_input" type="text" hidden name="view_folio_input" hidden>
							   <input id="view_t_oficioinput" type="text" name="view_t_oficioinput" hidden>
                           <h6 id="view_folio"></h6><hr><small class="text-center">Folio</small>
                           </center>
                         <input type="text" name="view_id" id="view_id" hidden="" >
                        </div>
                        <div class="col-md-3">
                           
                           <center>
                           <h6 id="view_f_recepcion"></h6><hr><small class="text-center">Fecha_Recepción</small>
                           </center>
                           
                           
                        </div>
                        <div class="col-md-3">
                          
                          <center>
                           <h6 id="view_num_oficio" ></h6><hr><small class="text-center">	Oficio</small>
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
                           <h6 id="view_areainterna"></h6> <p id="view_subdireccion"></p>
                           <p id="view_depto"></p>
                          
                           <hr>
                           <small class="text-center">Dirección:</small>
                          
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
													<center>
                          
                           </center>
                                       
                                        <input type="file" class="form-control font-weight-bold" name="doc_resp"
                                            id="doc_resp"  >
                                             <h6 id="view_obs"></h6><hr><small class="text-center">Respuesta</small>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if( $id_direccion == 7){
                                ?>
                                <div class="row">
                                <div class="col-md-12">
                                <div class="form-group" >
                                <label class="label-material text-primary">Turnar Organos Internos</label>
                                <select class="mi-selector form-control " id="turn_direccion"
                                        name="turn_direccion" style="width: 100%" required>
                                       
                                        <?php 
                                            
                                         $where = "AND id_direccion <> '$id_direccion'";
                                       
                                            $direccion=mysqli_query($conexion, "SELECT * FROM direcciones_secoem WHERE nombre_direccion LIKE '%OIC%' ");
                                            if($direccion->num_rows != 0){
                                                echo('<option value=" ">Seleccionar</option>');
                                                while($row=mysqli_fetch_assoc($direccion)){
                                            
                                                    echo('<option value="'.$row['id_direccion'].'">'.$row['nombre_direccion'].'</option>');
                                                   
                                              
                                              }
                                            }else{
                                                echo('<option value=" ">No hay registros!</option>');
                                            }
                                            
                                           
                                           
                                        ?>
                                    </select>

                            </div>
                                    
                                </div>
                            </div>
                                <?php
                            }
                            ?>
                      
                </div>
                
               
                
                <div class="modal-footer">
		
                  
                       

                       
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar" id="">
                            <?php
                            if ($id_direccion == 7 ){
                                ?>
                                <input type="button" class="btn btn-warning btn-round"  onclick="TurnarDireccion();" value="Turnar" id="btnTurnarDireccion">
                                  <?php
                            }
                            // $consulta_correspondencia = mysqli_query($conexion, "SELECT direccion_que_turna 
                            //                                                      FROM datos_correspondencia
                            //                                                      WHERE id_datos_c = '$idCorresp'");
                            ?>
                            <input type="button" class="btn btn-info btn-round"  onclick="DarSeguimiento();" value="Dar Seguimiento" id="btnDarSeguimiento">
                            <input type="submit" class="btn btn-success btn-round" value="Finalizar" id="btnfinalizar" >
                            <div class="conteiner-fluid" id="resultados12" style="text-align: right !important;"></div>
                          
                       
                    
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->


