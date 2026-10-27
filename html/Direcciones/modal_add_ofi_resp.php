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
  margin-right: 25px !important;
  padding-left: 20px !important;
  padding-right: 20px !important;
}
</style>

<div id="addOfiResp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form name="add_corresp_resp" id="add_corresp_resp" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Responder a Oficio o Tarjeta de conocimiento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
        <div class="card" style="border-radius: 25px !important; ">
         <div class="card-body">
          
          <div class="card-header text-center notice notice-danger redondeo-center" ><h3 style="color: rgba(8,16,104,1.00)">Datos del documento</h3></div>
            <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1Resp" class="text-primary">&nbsp;Tipo Documento</label>
                    <select class="form-control" id="exampleFormControlSelect1Resp" name="tipoResp" style="border-radius: 25px !important;" required>
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
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="no_oficio_resp" class="label-material text-primary"> &nbsp;Nº Documento </label>
                      <input id="no_oficio_resp" type="text" name="no_oficio_resp" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="150">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="fecha_resp" class="label-material text-primary"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha del Documento </label>
                      <input id="fecha_resp" type="date" name="fecha_resp" required class="form-control font-weight-bold" style="border-radius: 25px !important;">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="no_referencia_resp" class="label-material text-primary">&nbsp; Nº Referencia </label>
                      <input id="no_referencia_resp" type="text" name="no_referencia_resp" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="150" readonly>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group-material">
                    <label for="remitente_resp" class="label-material text-primary">&nbsp;Remitente</label>
                    <input id="remitente_resp" type="text" name="remitente_resp" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="200">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="asunto_resp" class="text-primary">&nbsp;Asunto:</label>
                        <textarea class="form-control" style="border-radius: 25px !important;" id="asunto_resp" name="asunto_resp" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <center>
                    </center>
                    <label for="doc_resp_resp" class="label-material text-primary">&nbsp;Adjuntar Archivo (Opcional) </label>
                    <input type="file" class="form-control font-weight-bold" name="doc_resp_resp" id="doc_resp_resp">
                  </div>
                </div>
              </div>
        </div>
        </div>

        <div class="card" style="border-radius: 25px !important; ">
         <div class="card-body">
       
          <div class="card-header text-center notice notice-danger redondeo-center" ><h3 style="color: rgba(8,16,104,1.00)">Datos del destino</h3></div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group-material">
                  <label for="destinatario_resp" class="label-material text-primary">&nbsp;Nombre destinatario </label>
                  <input id="destinatario_resp" type="text" name="destinatario_resp" required class="form-control" style="border-radius: 25px !important;" maxlength="200" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group-material">
                  <label for="areadestinatario_resp" class="label-material text-primary">&nbsp;Área destino:  </label>
                  <input id="areadestinatario_resp" type="text" name="areadestinatario_resp" required class="form-control" style="border-radius: 25px !important;" maxlength="200" readonly>
                </div>
              </div>
            </div>                  
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group-material">
                  <label for="areascopia_resp" class="label-material text-primary">&nbsp;Con copia para:  </label>
                  <input id="areascopia_resp" type="text" name="areascopia_resp" required class="form-control" style="border-radius: 25px !important;" maxlength="200" readonly>
                  <input id="id_destino_resp" type="hidden" name="id_destino_resp" required class="form-control" style="border-radius: 25px !important;" maxlength="200" readonly>
                  <input id="ids_copias_resp" type="hidden" name="ids_copias_resp" required class="form-control" style="border-radius: 25px !important;" maxlength="200" readonly>
                  <input id="id_doc_ini" type="hidden" name="id_doc_ini" required class="form-control" style="border-radius: 25px !important;" maxlength="200" readonly>
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