
<div class="modal fade" id="reservarOficiosrioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                        <i class="material-icons">single-copy</i>
                    </div>
                    <h3 class="text-info text-center">Reservar No. de Oficio(s)</h5>
                </div>
                <div class="modal-body">
                    <form name="reserva_oficio" id="reserva_oficio">
                        <!--<input type="hidden" id="id_usuario_c" name="id_usuario_c" value="<?php echo($id_usuario); ?>">
                        <input type="hidden" required="required" readonly id="id_reserva" name="id_reserva">-->
                        <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Datos del Solicitante</legend>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-label-group">
                                    <input type="text" class="form-control font-weight-bold" name="reserva_sol"
                                        id="reserva_sol" placeholder="Nombre del Solicitante" maxlength="200" required>
                                    <label for="reserva_sol">Nombre:</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group" id="elige_area">
                                    <select class="mi-selector form-control font-weight-bold" id="reserva_area_interna"
                                        name="reserva_area_interna" style="width: 100%;"
                                        data-placeholder="Selecciona una opción" required>
                                        <option value=" ">Selecciona el área que solicita ...</option>
                                         <?php
												$remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS where identificador = '005' OR identificador='006-1' OR identificador='006-2'");
												while($dep=mysqli_fetch_assoc($remitenet)){
												$emisor=$dep['identificador'].'-'.($dep['nombre']);
												echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
												}
											?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--<label for="exampleInputPassword1">Cantidad</label>-->
                                    <input type="number" name="cantidadr" class="form-control" id="cantidadr"
                                        placeholder="Cantidad de Oficios" required min="1" max="99">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Reservar Oficio</button>
            </div>
            </form>
        </div>
    </div>
</div>