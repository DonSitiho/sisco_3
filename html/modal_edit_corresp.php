<script>
    function habilitaredit(value){
        if(value=="0"){
            // habilitamos
            document.getElementById("edit_id_remitente").disabled=false;
            document.getElementById("edit_cargo").disabled=false;
            document.getElementById("edit_nombre").disabled=false;
            document.getElementById("edit_enviadopor").disabled=true;
            document.getElementById("edit_cargodest").disabled=true;
            
        }else if(value=="1"){
            // deshabilitamos
            document.getElementById("edit_id_remitente").disabled=false;
            document.getElementById("edit_cargo").disabled=false;
            document.getElementById("edit_nombre").disabled=false;
            document.getElementById("edit_enviadopor").disabled=false;
            document.getElementById("edit_cargodest").disabled=false;
        }
    }   

</script>



<!-- Modal para editar requerimientos de pasantes de un Programa de Servicio Social -->
<div id="editCorrespondenciaModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="edit_correspondencia" id="edit_correspondencia" >
                <div class="modal-header">
                    <h4 class="modal-title">Editar correspondencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <input type="hidden" id="prueba" name="prueba" >
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class="">Folio:</label>
                                <input type="text" class="form-control font-weight-bold" name="edit_folio" id="edit_folio"  maxlength="11" 
                                    value="<?php echo($folio) ?>" required>
                                <input type="hidden" name="edit_id" id="edit_id">                               
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha oficio:</label>
                                <input type="date" class="form-control font-weight-bold" id="edit_f_oficio" name="edit_f_oficio"
                                    aria-describedby="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label class=""># Oficio:</label>
                                <input type="text" class="form-control font-weight-bold" name="edit_num_oficio" maxlength="60" 
                                    id="edit_num_oficio" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" align='center'>
                                <label for="">Fecha recepción:</label>
                                <input type="date" class="form-control font-weight-bold" id="edit_f_recepcion"
                                    name="edit_f_recepcion" aria-describedby="" value="<?php echo($fecha_actual); ?>">
                            </div>
                        </div>

                    </div>                    
                   
                        <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos remitente</legend> 
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <label class="">Documento para :</label>
                                </div>
                                <div class="col-md-3">                                   
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="edit_t_oficio" id="edit_t0_oficio" onchange="habilitaredit(this.value);" value="0" >
                                        <label class="form-check-label" for="edit_t0_oficio"><strong> Titular</strong></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="edit_t_oficio" id="edit_t1_oficio" onchange="habilitaredit(this.value);" value="1" >
                                        <label class="form-check-label" for="edit_t1_oficio"><strong> Copia</strong></label>
                                    </div>
                                </div>
                            </div>
                            <p><p>                           
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group" id="Actualizar_remitente">
                                        <select class="mi-selector form-control font-weight-bold" id="edit_id_remitente"
                                            name="edit_id_remitente" style="width: 100%;" 
                                            data-placeholder="Selecciona una opción">
                                            <option value="">Selecciona el remitente ...</option>
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
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="edit_cargo" id="edit_cargo" maxlength="150"
                                            placeholder="Cargo Remitente">
                                        <label for="edit_cargo">Cargo</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="edit_nombre"
                                            id="edit_nombre" placeholder="Nombre Remitente" maxlength="200" required>
                                        <label for="edit_nombre">Nombre</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Documento para:</legend>
                        
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group" id="Actualizar_remitente">
                                    <select class="mi-selector form-control font-weight-bold" id="edit_enviadopor" name="edit_enviadopor" 
                                        style="width: 100%;" data-placeholder="Selecciona una opción">
                                        <option value=" ">Selecciona un destinatario ...</option>
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
                                    <input type="text" class="form-control font-weight-bold" name="edit_cargodest" maxlength="150" required 
                                        id="edit_cargodest" placeholder="Cargo Destinatario">
                                    <label for="edit_cargodest">Cargo destinatario:</label>
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
                                        <textarea class="form-control" id="edit_asunto" name="edit_asunto" rows="3" placeholder ="Asunto" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control font-weight-bold" name="edit_anexo" id="edit_anexo" maxlength="100" 
                                            placeholder="Anexos" required>
                                        <label for="edit_anexo">Anexos</label>
                                    </div>
                                </div>                            
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                           <legend class="scheduler-border">Documento Turnado a:</legend>
                                <p></p>
                            <div class="row">
                                <div class="col-md-10">                               
                                    <div class="form-group" id="Actualizar_remitente">
                                        <select class="mi-selector form-control font-weight-bold" id="edit_areainterna"  
                                            name="edit_areainterna" style="width: 100%;"
                                            data-placeholder="Selecciona una opción">
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
                                        <i class="material-icons" data-toggle="tooltip"
                                            title="Agregar área SECOEM">add</i></a>
                                </div>     
                            </div>
                            <!--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_f_recepArea">Fecha de recepción Area: </label>
                                        <input type="date" class="form-control font-weight-bold" name="edit_f_recepArea"
                                            id="edit_f_recepArea">
                                    </div>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_instruc">Instrucciones:</label>
                                        <textarea class="form-control" id="edit_instruc" name="edit_instruc" rows="2" maxlength="999" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_obs">Observaciones:</label>
                                        <textarea class="form-control" id="edit_obs" name="edit_obs" rows="2" maxlength="999"></textarea>
                                        <input type="hidden" class="form-control font-weight-bold" name="status"
                                            id="status" value="1">
                                        <input type="hidden" class="form-control font-weight-bold" name="f_captura"
                                            id="f_captura" value="<?php echo($fecha_actual); ?>">
                                    </div>
                                </div>
                            </div>                                                    
                        </fieldset>
                    </div>               
                <div id="resultado1">
             
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Actualizar correspondencia">
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $("#myTab2 li a").click(function() {
        $(this).parent().prevAll().addClass('redcol');
        $(this).parent().nextAll().removeClass('redcol2').addClass('redcol');
    });                                            

    $(document).ready(function(){
        // $('.mi-selector').select2({
        //     width: 'resolve' // need to override the changed default    
        // });

        $('#editCorrespondenciaModal').on('shown.bs.modal', function () {
        $('.mi-selector').select2({
            dropdownParent: $('#editCorrespondenciaModal')
        });
    });
});

</script>