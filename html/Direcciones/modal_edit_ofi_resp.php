<?php
include('../../php/conexion.php');

?>
<style>
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
  text-align: center;
}

input {
  margin: 5px;
}
</style>
<div id="editOfiResp" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form name="edit_ofi_resp" id="edit_ofi_resp" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Generar Oficio o Tarjeta de Respuesta</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
        <fieldset>
          <legend>Datos del documento</legend>  
            <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1" class="text-primary">Tipo Documento</label>
                    <select class="form-control" id="etipo1" name="etipo1" style="border-radius: 25px !important;" required>
                      <option>Seleccione una opcion...</option>
                      <option value="Oficio"> Oficio</option>
                      <option value="Tarjeta">Tarjeta</option>
                      <option value="Memorandum">Memorandum</option>
                      <option value="Circular">Circular</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="eno_oficio1" class="label-material text-primary">Nº Oficio </label>
                      <input id="eno_oficio1" type="text" name="eno_oficio1" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="150">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="efecha1" class="label-material text-primary">fecha del oficio </label>
                      <input id="efecha1" type="date" name="efecha1" required class="form-control font-weight-bold" style="border-radius: 25px !important;">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group-material">
                    <label for="eremitente1" class="label-material text-primary">Remitente</label>
                    <input id="eremitente1" type="text" name="eremitente1" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="200">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="easunto1" class="text-primary">Asunto:</label>
                        <textarea class="form-control" style="border-radius: 25px !important;" id="easunto1" name="easunto1" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <center>
                    </center>
                    <label for="edoc_original1" class="label-material text-primary">Adjuntar Oficio/Tarjeta/Memorandum/Circular </label>
                    <input type="file" class="form-control font-weight-bold" name="edoc_original1" id="edoc_original1">
                  </div>
                </div>
              </div>
        </fieldset>
        <fieldset>
          <legend>Datos del destino</legend>  
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group-material">
                  <label for="edestinatario1" class="label-material text-primary">Nombre destinatario </label>
                  <input id="edestinatario1" type="text" name="edestinatario1" required class="form-control" style="border-radius: 25px !important;" maxlength="200">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-10">
                  <div class="form-group" id="Actualizar_destino1">
                      <select class="mi-selector form-control font-weight-bold" id="edestino_envio1"
                          name="edestino_envio1" style="width: 100%;" data-placeholder="Selecciona una opción"
                          required>
                          <option value=" ">Selecciona el área destino ...</option>
                          <?php
                            $direcciones = mysqli_query($conexion, "SELECT * FROM direcciones_secoem");;
                            if ($direcciones->num_rows != 0) {
                              
                              while ($row = mysqli_fetch_assoc($direcciones)) {
        
                                echo ('<option value="' . $row['id_direccion'] . '">' . $row['nombre_direccion'] . '</option>');
                              }
                            } else {
                              echo ('<option value=" ">No hay registros!</option>');
                            }
                          ?>
                      </select>
                  </div>

              </div>
            </div>         
            
            
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="selectormultiple" class="text-primary">Con copia para (opcional): </label><br>
                  <select name="subdireccionMultiselect[]" id="selectormultiple" multiple="multiple" required>
                    <?php
                      //$where = "WHERE id_direccion1='".$id_direccion."'";
                      $direccion = mysqli_query($conexion, "SELECT * FROM direcciones_secoem");
                      if ($direccion->num_rows != 0) {
                      
                        while ($row = mysqli_fetch_assoc($direccion)) {

                          echo ('<option value="' . $row['id_direccion'] . '">' . $row['nombre_direccion'] . '</option>');
                        }
                      } else {
                        echo ('<option value=" ">No se enviarán copias!</option>');
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" id="resultados2C" >Archivos1</div><!-- DOCUMENTOS -->	
            </div>
        </fieldset>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-success" value="Guardar datos">
        </div>
      </form>
    </div>
  </div>
</div>