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

<div id="turnarCorrespondenciaModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="turnar_correspondencia" id="turnar_correspondencia" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Resumen Correspondencia <span class="badge badge-info"> Turnar </span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
					
                    <div class="row">
						
                        <div class="col-md-3">
                           <center>
							   
							   
                           <h6 id="view_folioT"></h6><hr><small class="text-center">Folio</small>
                           </center>
                         <input type="text" name="view_idT" id="view_idT" hidden="" >
                        </div>
                        <div class="col-md-3">
                           
                           <center>
                           <h6 id="view_f_recepcionT"></h6><hr><small class="text-center">Fecha_Recepción</small>
                           </center>
                           
                           
                        </div>
                        <div class="col-md-3">
                          
                          <center>
                           <h6 id="view_num_oficioT" ></h6><hr><small class="text-center">	Oficio</small>
                           </center>
                           
                            
                        </div>
                        <div class="col-md-3">
                           <center>
                           <h6 id="view_f_oficioT"></h6><hr><small class="text-center">Fecha del Oficio</small>
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
                           <h6 id="view_id_remitenteT"></h6><hr><small class="text-center">Nombre Remitente</small>
                           </center>	
								
							</div>
                              
                            </div>
							
                            <div class="row">
                                <div class="col-md-6">
							<center>
                           <h6 id="view_cargoT" ></h6><hr><small class="text-center">Cargo Remitente </small>
                           </center>
                                   
                                </div>
                                <div class="col-md-6">
									
									<center>
                           <h6 id="view_nombreT" ></h6><hr><small class="text-center">Nombre Remitente</small>
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
                           <h6 id="view_enviadoporT"></h6><hr><small class="text-center">Nombre Destinatario</small>
                           </center>
                                 
                                </div>
                              
                            </div>
							<br>
                            <div class="row">
                                <div class="col-md-12">
										<center>
                           <h6 id="view_cargodestT"></h6><hr><small class="text-center">Cargo Destinatario </small>
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
                           <h6 id="view_asuntoT"></h6><hr><small class="text-center">Asunto </small>
                           </center>
                                   
                                </div>
                            </div>
                                <div class="row">
                                <div class="col-md-12">
											<center>
                           <h6 id="view_anexoT"></h6><hr><small class="text-center">Anexos </small>
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
                           <h6 id="view_areainternaT"></h6><hr><small class="text-center">Dirección:</small>
                           </center>
									
                                   
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                
                                		<center>
                           <h6 id="view_instrucT"></h6><hr><small class="text-center">Instrucciones:</small>
                           </center>
									
                                   
                                </div>
                            </div>
							<br>	
                            <div class="row">
                                <div class="col-md-12">
									
                                    <div class="form-group">
													<center>
                           <h6 id="view_obsT"></h6><hr><small class="text-center">Observaciones</small>
                           </center>
                                       
                                    </div>
                                </div>
                            </div>
                            
                             </div> 
                               </div>
                                <div class="row">
                 <div class="col-md-12" id="resultadosT" >Archivos</div><!-- DOCUMENTOS -->	
                </div>

               



                   <?php 
                   if($subdireccion == 0 ){ //ES UNA DIRECCION
                   ?>
                   <div class="row">
                                <div class="col-md-12">
                                <div class="form-group" >
                                <label class="label-material text-primary">Subdirección / OIC / Departamento</label>
                                <select class="mi-selector form-control " id="subdireccionMultiselect"
                                        name="subdireccionMultiselect[]" style="width: 100%" required multiple>
                                       
                                        <?php
                                            
                                            $where = "WHERE id_direccion1='".$id_direccion."'";
                                       
                                            $direccion=mysqli_query($conexion, "SELECT * FROM subdirecciones_oic $where");
                                            if($direccion->num_rows != 0){
                                                
                                                while($row=mysqli_fetch_assoc($direccion)){
                                            
                                                    echo('<option value="'.$row['id'].'">'.$row['nombre'].'</option>');
                                                   
                                              
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
                     }elseif( $depto == 0 ){//Mostramos sus departamentos
                    ?>
                        <div class="row">
                                <div class="col-md-12">
                                <div class="form-group" >
                                <label class="label-material text-primary">Departamento</label>
                                <select class="mi-selector form-control " id="deptoMultiselect"
                                        name="deptoMultiselect[]" style="width: 100%" required multiple>
                                       
                                        <?php
                                            
                                            $departamento=mysqli_query($conexion, "SELECT * FROM departamentos WHERE id_sub_oic='".$subdireccion."'");
                                                if($departamento->num_rows != 0){
                                                    echo('<option value="">Seleccionar:</option>');
                                                    while($row=mysqli_fetch_assoc($departamento)){
                                                
                                                        echo('<option value="'.$row['id'].'">'.$row['nombre_depto'].'</option>');
                                                       
                                                  
                                                  }
                                                }else{
                                                    echo('<option value="">No hay registros!</option>');
                                                }
                                            
                                           
                                           
                                        ?>
                                    </select>

                            </div>
                                    
                                </div>
                            </div>                    
                     <?php }else{ // Mostrar sus oficinas oficinas?>
                        <div class="row">
                                <div class="col-md-12">
                                <div class="form-group" >
                                <label class="label-material text-primary">Departamento</label>
                                <select class="mi-selector form-control " id="oficinaMultiselect"
                                        name="oficinaMultiselect[]" style="width: 100%" required multiple>
                                       
                                        <?php
                                            
                                            $oficinas=mysqli_query($conexion, "SELECT * FROM oficinas WHERE id_departamento='".$depto."'");
                                                if($oficinas->num_rows != 0){
                                                    echo('<option value="">Seleccionar:</option>');
                                                    while($row=mysqli_fetch_assoc($oficinas)){
                                                
                                                        echo('<option value="'.$row['id'].'">'.$row['nombre'].'</option>');
                                                       
                                                  
                                                  }
                                                }else{
                                                    echo('<option value="">No hay registros!</option>');
                                                }
                                            
                                           
                                           
                                        ?>
                                    </select>

                            </div>
                                    
                                </div>
                            </div>
                     <?php } ?>

                                        
                      
                </div>
               
                
                <div class="modal-footer">
		
                  
                       

                       
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar" id="">
                            
                            <input type="submit" class="btn btn-success btn-round" value="Turnar" id="btnTurnar" >
                            <div class="conteiner-fluid" id="resultados12" style="text-align: right !important;"></div>
                          
                       
                    
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ************** Modal para copiar correspondencia ******* -->


