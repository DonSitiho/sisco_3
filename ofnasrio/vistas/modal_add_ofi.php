<?php


?>
<div id="addOfi" class="modal fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form name="add_corresp" id="add_corresp" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Oficio o Tarjeta de conocimiento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                       <div class="row">
                       
                          <div class="col-sm-12">
                          <div class="form-group">
                           
    <label for="exampleFormControlSelect1" class="text-primary">Direccion</label>
    <select class="form-control" id="exampleFormControlSelect1" name="id_direccion" style="border-radius: 25px !important;" required>
     <option>Seleccione una opcion...</option>
     <?php 
     include '../conexion/conexion.php';
     $consulta=mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion !='0' ");
     while($row=mysqli_fetch_assoc($consulta)){
       echo' <option value="'.$row['id_direccion'].'"> '.$row['nombre_direccion'].'</option>';
     }
     ?>v
      
      
     
    </select>
  </div>
                            <div class="form-group-material">
                             <label for="remitente" class="label-material text-primary">Remitente</label>
                              <input id="remitente1" type="text" name="remitente" required class="form-control" style="border-radius: 25px !important;">
                              
                            </div>
                            <div class="form-group-material">
                              <label for="no_oficio" class="label-material text-primary">Nº Oficio     </label>
                              <input id="no_oficio" type="text" name="no_oficio" required class="form-control" style="border-radius: 25px !important;">
                             
                            </div>
                            <div class="form-group-material">
                             <label for="fecha" class="label-material text-primary">fecha del oficio </label>
                              <input id="fecha" type="date" name="fecha" required class="form-control" style="border-radius: 25px !important;">
                              
                            </div>
                            
                             <div class="form-group">
                                        <label for="asunto" class="text-primary">Asunto:</label>
                                        <textarea  class="form-control" style="border-radius: 25px !important;" id="asunto" name="asunto" rows="5" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;"
												  ></textarea >
                                    </div>
                           
                             <div class="form-group-material">
                             <label for="destinatario" class="label-material text-primary">destinatario     </label>
                              <input id="destinatario" type="text" name="destinatario" required class="form-control" style="border-radius: 25px !important;">
                              
                            </div>
                           <div class="form-group">
    <label for="exampleFormControlSelect1" class="text-primary">Tipo Documento</label>
    <select class="form-control" id="exampleFormControlSelect1" name="tipo" style="border-radius: 25px !important;" required>
     <option>Seleccione una opcion...</option>
      <option value="Oficio"> Oficio</option>
      <option value="Tarjeta">Tarjeta</option>
      
     
    </select>
  </div>
                            
									
                                    <div class="form-group">
													<center>
                          
                           </center>
                                       <label for="destinatario" class="label-material text-primary">Adjuntar Documento     </label>
                                        <input type="file" class="form-control font-weight-bold" name="doc_resp"
                                            id="doc_resp"  >
                                             
                                    </div>
                              
                          </div>
                        </div>
                         <div class="row">
                                
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

