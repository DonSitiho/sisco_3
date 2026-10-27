<?php
include('../../php/conexion.php');

$consultaSigla = mysqli_query($conexion, "SELECT siglas FROM direcciones_secoem WHERE id_direccion =  $id_direccion");
$registro = mysqli_fetch_assoc($consultaSigla);
$siglasDireccion = $registro['siglas'];
$Year = date("Y");
//cantidad de documentos
$consultaOficios = mysqli_query($conexion, "SELECT tipo_documento FROM oficios_conocimiento WHERE id_direcciones =  $id_direccion AND YEAR(fecha_captura) = $Year AND is_active = 1");
$tiposDoc = array(
  "Memorandum" => 1,
  "Circular" => 1,
  "Oficio" => 1,
  "Tarjeta" => 1,
);
while($row = mysqli_fetch_array($consultaOficios)){

      switch ($row['tipo_documento']) {
        case 'Circular':
            $tiposDoc['Circular'] ++;
            break;
        case 'Tarjeta':
            $tiposDoc['Tarjeta'] ++;
            break;
        case 'Oficio':
            $tiposDoc['Oficio'] ++;
            break;
        case 'Memorandum':
            $tiposDoc['Memorandum'] ++; 
            break;
       }

}
$length = 4;

 


echo "
<script>
function cambiarTipoDoc()
{
        
      var seleccion=document.getElementById('select1');

      var tipoSelect = seleccion.options[seleccion.selectedIndex].value

      if ( tipoSelect == 'Memorandum'){
      document.getElementById('no_oficio').value='MEMORANDUM ".$siglasDireccion."/".$tiposDoc['Memorandum']."/".$Year ."';
      document.getElementById('no_referencia').value='MEMORANDUM ".$siglasDireccion."/".$tiposDoc['Memorandum']."/".$Year ."';

      }else if (tipoSelect == 'Circular'){
        document.getElementById('no_oficio').value='CIRCULAR ".$siglasDireccion."/".str_pad($tiposDoc['Circular'],$length,"0", STR_PAD_LEFT)."/".$Year ."';
        document.getElementById('no_referencia').value='CIRCULAR ".$siglasDireccion."/".str_pad($tiposDoc['Circular'],$length,"0", STR_PAD_LEFT)."/".$Year ."';

      }else if(tipoSelect == 'Tarjeta'){
        document.getElementById('no_oficio').value = 'T.I. ".$siglasDireccion."/".str_pad($tiposDoc['Tarjeta'],$length,"0", STR_PAD_LEFT)."/".$Year ."';
        document.getElementById('no_referencia').value = 'T.I. ".$siglasDireccion."/".str_pad($tiposDoc['Tarjeta'],$length,"0", STR_PAD_LEFT)."/".$Year ."';
      }else{
        document.getElementById('no_oficio').value = '".$siglasDireccion."/".str_pad($tiposDoc['Oficio'],$length,"0", STR_PAD_LEFT)."/".$Year ." ';
        document.getElementById('no_referencia').value = '".$siglasDireccion."/".str_pad($tiposDoc['Oficio'],$length,"0", STR_PAD_LEFT)."/".$Year ." ';
      }

}
</script>";


?>


<script>
  $(document).ready(function() {
    $("#no_oficio").keyup(function() {
      var value = $(this).val();
      $("#no_referencia").val(value);
    });
    document.querySelector('#t_dest_int').checked = true;
    document.getElementById("destino_externo_envio").style.display = "none";
    document.getElementById("add_dep").style.display = "none";
  });
</script>
<script>
   function habilitarSelect(value) {
    if (value == "0") {
      // habilitamos
      document.getElementById("multipledir").style.display = "block";
      document.getElementById("destino_externo_envio").style.display = "none";
      document.getElementById("add_dep").style.display = "none";

    } else if (value == "1") {
      // deshabilitamos
      document.getElementById("multipledir").style.display = "none";
      document.getElementById("destino_externo_envio").style.display = "block";
      document.getElementById("add_dep").style.display = "block";
    }
  }

  
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<div id="addOfi" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form name="add_corresp" id="add_corresp" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Oficio o Tarjeta de conocimiento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="card" style="border-radius: 25px !important; ">
            <div class="card-body">

              <div class="card-header text-center notice notice-danger redondeo-center">
                <h3 style="color: rgba(8,16,104,1.00)">DATOS DEL REMITENTE</h3>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1" class="text-primary">Tipo Documento</label>
                    <select class="form-control" id="select1" name="tipo" style="border-radius: 25px !important;" onChange="cambiarTipoDoc()" required>
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
                    <label for="no_oficio" class="label-material text-primary">Nº Documento </label>
                    <input id="no_oficio" type="text" name="no_oficio" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="150">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="fecha" class="label-material text-primary">fecha Documento </label>
                    <input id="fecha" type="date" name="fecha" required class="form-control font-weight-bold" style="border-radius: 25px !important;">
                  </div>
                </div>
                <div class="col-sm-2">
                 
                   
                    <input id="no_referencia" type="hidden" name="no_referencia" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="150" >
                  
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group-material">
                    <label for="remitente" class="label-material text-primary">Remitente</label>
                    <input id="remitente1" type="text" name="remitente" required class="form-control font-weight-bold" style="border-radius: 25px !important;" maxlength="200">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="asunto" class="text-primary">Asunto:</label>
                    <textarea class="form-control" style="border-radius: 25px !important;" id="asunto" name="asunto" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="1500" style="border-radius: 25px !important;"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <center>
                    </center>
                    <label for="destinatario" class="label-material text-primary">Adjuntar Archivo </label>
                    <input type="file" class="form-control font-weight-bold" name="doc_resp" id="doc_resp" style="border-radius: 25px !important; ">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card" style="border-radius: 25px !important; ">
            <div class="card-body">
              <div class="card-header text-center notice notice-danger redondeo-center">
                <h3 style="color: rgba(8,16,104,1.00)">DATOS DEL DESTINATARIO</h3>
              </div>
              <div class="row">
                <div class="col-md-3 label-material text-primary">
                </div>
                <div class="col-md-9">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="t_destinatario" onchange="habilitarSelect(this.value);" id="t_dest_int" value="0">
                    <label class="form-check-label" for="t_dest_int"><strong> SECOEM</strong></label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="t_destinatario" onchange="habilitarSelect(this.value);" id="t_dest_ext" value="1">
                    <label class="form-check-label" for="t_dest_ext"><strong> Otras Dependencias</strong></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <p></p>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group-material">
                    <label for="destinatario" class="label-material text-primary">Nombre destinatario </label>
                    <input id="destinatario" type="text" name="destinatario" required class="form-control" style="border-radius: 25px !important;" maxlength="200">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group" id="multipledir">
                    <label for="selectormultipledir" class="text-primary">Seleccione una o más áreas Destino del documento (ORIGINAL): <p id="emailHelp2" class="form-text text-danger text-muted"></p></label>
                    <br>
                    
                    <select class="form-control select2 select2-hidden-accessible js-example-basic-multiple" multiple="multiple" name="direccionMultiselect[]" data-placeholder="Seleccione una o más áreas Destino del documento (ORIGINAL)" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <?php
                      //$where = "WHERE id_direccion1='".$id_direccion."'";
                      $direccion = mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion <> 0 AND id_direccion <> 9999");
                      if ($direccion->num_rows != 0) {

                        while ($row = mysqli_fetch_assoc($direccion)) {

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
                <div class="col-md-10">
                  <div class="form-group" id="Actualizar_destino2">
                    <select class="mi-selector form-control font-weight-bold" id="destino_externo_envio" style="border-radius: 25px !important; " name="destino_externo_envio" style="width: 100%;" data-placeholder="Selecciona una opción" required>
                      <option value="0">Selecciona el área destino ...</option>
                      <?php
                      $remitente_ext = mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
                      while ($dep = mysqli_fetch_assoc($remitente_ext)) {
                        $emisor = $dep['nombre'];
                        echo ('<option value="' . $dep['id_dependencia'] . '">' . $emisor . '</option>');
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="selectormultiple" class="text-primary">Con copia para (opcional): <p id="emailHelp" class="form-text text-danger text-muted">EL SISTEMA ADJUNTA AUTOMATICAMENTE UNA COPIA PARA LA TITULAR</p></label>
                    <br>
                    <select class="js-example-basic-multiple2" name="subdireccionMultiselect[]" multiple="multiple" data-placeholder="Seleccione una o más áreas Destino del documento (ORIGINAL)" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <?php
                      //$where = "WHERE id_direccion1='".$id_direccion."'";
                      $direccion = mysqli_query($conexion, "SELECT * FROM direcciones_secoem where id_direccion <> 0 AND id_direccion <> 9999");
                      if ($direccion->num_rows != 0) {

                        while ($row = mysqli_fetch_assoc($direccion)) {

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
<script>

   $(".js-example-basic-multiple").select2({
    closeOnSelect: false
});

$(".js-example-basic-multiple2").select2({
    closeOnSelect: false
});

</script>