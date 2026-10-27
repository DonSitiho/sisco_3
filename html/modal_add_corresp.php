<?php
include('ajax/conexion.php');

$consulta1=mysqli_query($conexion, "SELECT * FROM datos_correspondencia ORDER BY id_datos_c DESC LIMIT 1");
$num_rows=mysqli_num_rows($consulta1);
if ($num_rows!=0){    
    
    $fecha_actual=date("Y-m-d");
    $datosfecha = explode('-', $fecha_actual);
    $anio = substr($datosfecha[0],2,2);

    while($row1=mysqli_fetch_assoc($consulta1)){
        $anioant = substr($row1['folio'],0,2);
        $folioant = substr($row1['folio'],3,5);

        if($anio>$anioant){
            
            $folionvo = 1;
        
        }else{

            $folionvo = 1 + intval(substr($row1['folio'],3,5));
        

        }
        
        $consec=1;

        if ($folionvo<10){
            $folio=$anio.'/'.'0000'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif($folionvo>=10 && $folionvo<100){
            $folio=$anio.'/'.'000'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif($folionvo>=100 && $folionvo<1000){
            $folio=$anio.'/'.'00'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif($folionvo>=1000 && $folionvo<10000){
            $folio=$anio.'/'.'0'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif ($folionvo>9999){
            $folio=$anio.'/'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);    
        }

    }
}else{
    $fecha_actual=strftime("%Y-%m-%d");
    $datosfecha = explode('-', $fecha_actual);
    $anio = substr($datosfecha[0],2,2);

    $folionvo=550;
    $consec=1;
    
        if ($folionvo<10){
            $folio=$anio.'/'.'0000'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif($folionvo>=10 && $folionvo<100){
            $folio=$anio.'/'.'000'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif($folionvo>=100 && $folionvo<1000){
            $folio=$anio.'/'.'00'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif($folionvo>=1000 && $folionvo<10000){
            $folio=$anio.'/'.'0'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);
        }
        elseif ($folionvo>9999){
            $folio=$anio.'/'.$folionvo.'/0'.$consec;
            $folio=ltrim($folio);    
        }
    
    //$folio='22/'.'0000'.$folio.'/0'.$consec;
    //$folio=ltrim($folio);
}

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual=date("Y-m-d");
$fecha_hora=date("Y-m-d H:i:s");

?>

<script>
function habilitar(value) {
    if (value == "0") {
        // habilitamos
        document.getElementById("id_remitente").disabled = false;
        document.getElementById("cargo").disabled = false;
        document.getElementById("nombre").disabled = false;
        document.getElementById("enviadopor").disabled = true;
        document.getElementById("cargodest").disabled = true;

    } else if (value == "1") {
        // deshabilitamos
        document.getElementById("id_remitente").disabled = false;
        document.getElementById("cargo").disabled = false;
        document.getElementById("nombre").disabled = false;
        document.getElementById("enviadopor").disabled = false;
        document.getElementById("cargodest").disabled = false;
    }
}
</script>
<script type='text/javascript'>
$(document).ready(function() {

    $('#btnprev').hide();
    $('#btnnext').show();



});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#folio').on('blur', function() {

        $('#result-folio').html('<img src="images/loader.gif" />').fadeOut(2000);

        var usarfolio = $(this).val();
        var dataString = 'usarfolio=' + usarfolio;

        $.ajax({
            type: "POST",
            url: "ajax/checar_folio.php",
            data: dataString,
            success: function(data) {
                $('#result-folio').fadeIn(8000).html(data);
            }
        });
    });
});
</script>


<div id="addCorrespondenciaModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="add_corresp" id="add_corresp">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar correspondencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class="">Folio:</label>
                                <input type="text" class="form-control font-weight-bold" name="folio" id="folio"
                                    maxlength="11" value="<?php echo($folio) ?>" required>

                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha oficio:</label>
                                <input type="date" max="9999-12-31" class="form-control font-weight-bold" id="f_oficio" name="f_oficio"
                                    aria-describedby="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class=""># Oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="num_oficio"
                                    maxlength="60" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    id="num_oficio" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha recepción:</label>
                                <input type="date" max="9999-12-31" class="form-control font-weight-bold" id="f_recepcion"
                                    name="f_recepcion" aria-describedby="" value="<?php echo($fecha_actual); ?>">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12" id="result-folio"></div>
                    </div>
                    
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos remitente</legend>
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_oficio"
                                        onchange="habilitar(this.value);" id="t_oficio_tit" value="0">
                                    <label class="form-check-label" for="t_oficio_tit"><strong> Titular</strong></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="t_oficio"
                                        onchange="habilitar(this.value);" id="t_oficio_copia" value="1">
                                    <label class="form-check-label" for="t_oficio_copia"><strong> Copia</strong></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_remitente">
                                    <select class="mi-selector form-control font-weight-bold" id="id_remitente"
                                        name="id_remitente" style="width: 100%" required>
                                        <option value=" ">Selecciona un Remitente ...</option>
                                            <?php
                                                $remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
                                                while($dep=mysqli_fetch_assoc($remitenet)){
                                                $emisor=$dep['sigla'].'-'.($dep['nombre']);
                                                echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="#addDepModal" class="add" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip" title="Agregar Dependencia">add</i></a>
                            </div>                       
                        </div>                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="cargo" id="cargo"
                                        placeholder="Cargo Remitente" maxlength="150" required>
                                    <label for="cargo">Cargo</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="nombre" id="nombre"
                                        placeholder="Nombre Remitente" maxlength="200" required>
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Documento para:</legend>
                        
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_remitente2">
                                    <select class="mi-selector form-control font-weight-bold" id="enviadopor"
                                        name="enviadopor" style="width: 100%;" data-placeholder="Selecciona una opción"
                                        required>
                                        <option value=" ">Selecciona un Destinatario ...</option>
                                        <?php
                                            $remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
                                            while($dep=mysqli_fetch_assoc($remitenet)){
                                            $emisor=$dep['sigla'].'-'.($dep['nombre']);
                                            echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                            }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <a href="#addDepModal" class="add" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip"
                                        title="Agregar Dependencia">add</i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="cargodest"
                                        id="cargodest" placeholder="Cargo Destinatario" maxlength="150" required>
                                    <label for="cargodest">Cargo destinatario:</label>
                                </div>
                            </div>
                            <!--<div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="nombredest"
                                            id="nombredest" placeholder="Nombre Destinatario" required>
                                        <label for="nombredest">Nombre Destinatario:</label>
                                    </div>
                                </div>-->
                        </div>
                    </fieldset>                                 

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Asunto:</legend>
                        <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="asunto" name="asunto" rows="3" maxlength="1500"
                                            placeholder="Asunto" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="anexo" id="anexo"
                                            placeholder="Anexos" maxlength="100" required>
                                        <label for="anexo">Anexos</label>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control font-weight-bold" name="indica"
                                                id="indica" placeholder="Indicaciones" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            <label for="indica">Indicaciones</label>
                                        </div>
                                    </div>-->
                            </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Documento Turnado a:</legend>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_remitente">
                                    <select class="mi-selector form-control font-weight-bold" id="areainterna"
                                        name="areainterna" style="width: 100%;" data-placeholder="Selecciona una opción"
                                        required>
                                        <option value=" ">Selecciona el área a que se turna el oficio ...</option>
                                            <?php
                                                $direccion=mysqli_query($conexion, "SELECT * FROM direcciones_secoem");
                                                while($row_direc=mysqli_fetch_assoc($direccion)){
                                                    echo('<option value="'.$row_direc['id_direccion'].'">'.($row_direc['nombre_direccion']).'</option>');
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="#addAreaModal" class="add" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip" title="Agregar área SECOEM">add</i></a>
                            </div>
                        </div>
                    <!--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="f_recepArea">Fecha de recepción: </label>
                                        <input type="date" class="form-control font-weight-bold" name="f_receparea"
                                            id="f_receparea">
                                    </div>
                                </div>
                            </div>-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="instruc">Instrucciones:</label>
                                    <textarea class="form-control" id="instruc" name="instruc" rows="2" maxlength="999"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="obs">Observaciones:</label>
                                    <textarea class="form-control" id="obs" name="obs" rows="2" maxlength="999"></textarea>
                                    <!--<input type="hidden" class="form-control font-weight-bold" name="status"
                                                id="status" value="1">
                                            <input type="hidden" class="form-control font-weight-bold" name="f_captura"
                                                id="f_captura" value="<?php echo($fecha_actual); ?>">-->
                                </div>
                            </div>
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
<script>
$(document).ready(function() {
   

    $('#addCorrespondenciaModal').on('shown.bs.modal', function () {
    $('.mi-selector').select2({
        dropdownParent: $('#addCorrespondenciaModal')
    });
});

});
</script>
<script>
$("#myTab li a").click(function() {
    $(this).parent().prevAll().addClass('redcol');
    $(this).parent().nextAll().removeClass('redcol2').addClass('redcol');
});

function Abrir_moddal_dep() {

    $('#formulario-dependencias')[0].reset();
    $('#tipo_registro').val('Registro');
    $('#btn_edi').hide();
    $('#btn_reg').show();
    /*$('#modal_dependencias').load('#step1'),*/
    $('#modal_dependencias').modal({
        show: true,
        backdrop: 'static'
    });
}


$('.btnNext').click(function() {
    $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
    $('#btnnext').hide();
    $('#btnprev').show();

});

$('.btnPrevious').click(function() {
    $('.nav-tabs > .nav-item > .active').parent().prev('li').find('a').trigger('click');
    $('#btnprev').hide();
    $('#btnnext').show();
});
</script>