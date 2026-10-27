<?php
include('../../ajax/conexion.php');



date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha_actual=strftime("%Y-%m-%d");
$fecha_hora=date("Y-m-d H:i:s");
?>


<div id="addOficiosrioModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="add_oficiosrio" id="add_oficiosrio">
                <div class="modal-header">
                    <div>
                        <h4 class="modal-title">Asignar nuevo Oficio</h4>
                    </div>
                    <div class="modal-title"> 
                    <div>
                    <label for=""># oficio que se asigna:</label>
                    </div>
                    <div>
                     <input type="text" class="claveid form-control font-weight-bold text-center" id="new_ofi" name="new_ofi" readonly required>
                    </div>
                    
                    <style>
                    .claveid {
                        width: 120px;
                        font-size: 30px;
                    }
                    </style>
                    
                    </div>
                    <div><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Oficio:</legend>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group" align='center'>
                                    <label for="f_asignado">Fecha asignación:</label>
                                    <input type="date" class="form-control font-weight-bold" id="f_asignado"
                                        name="f_asignado" aria-describedby="" value="<?php echo($fecha_actual); ?>"
                                        required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="nomDest" id="nomDest"
                                        placeholder="Nombre del Solicitante" maxlength="200" required>
                                    <label for="nomDest">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="cargoDest"
                                        id="cargoDest" placeholder="Nombre del Solicitante" maxlength="200" required>
                                    <label for="cargoDest">Cargo:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-md-10">
                               <div class="form-group-material" id="Actualizar_dependencia">
                             
                                   <select class="mi-selector form-control mb-3" id="idDestino"
                                        name="idDestino" style="width: 100% !important;" required>
                                        <option value=" ">Selecciona una Dependencia ...</option>
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
                                <div class="form-group">
                                    <label for="asunto_ofi">Asunto: </label>
                                    <textarea class="form-control" id="asunto_ofi" name="asunto_ofi" rows="2"
                                        maxlength="999" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Solicitante</legend>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="solicitante"
                                        id="solicitante" placeholder="Nombre del Solicitante" maxlength="200" required>
                                    <label for="solicitante">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group" id="elige_area" style="width: 100% !important;">
                                    <select class="mi-selector font-weight-bold" id="area_interna"
                                        name="area_interna" style="width: 100% !important;"
                                        data-placeholder="Selecciona una opción" required>
                                        <option value=" ">Selecciona el área que solicita ...</option>
                                        <?php
                                            $remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS where identificador = '005' OR identificador='006-1' OR identificador='006-2'");
                                            while($dep=mysqli_fetch_assoc($remitenet)){
                                            $emisor=$dep['sigla'].'-'.($dep['nombre']);
                                            echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                            }
                                            ?>
                                    </select>
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
