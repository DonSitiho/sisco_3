
<div class="modal fade" id="copiarOficiosrioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                        <i class="material-icons">single-copy</i>
                    </div>
                    <h3 class="text-info text-center">Copiar Correspondencia</h5>
                </div>
                <div class="modal-body">
                    <form name="copy_oficio" id="copy_oficio">
                        <input type="hidden" id="id_usuario_c" name="id_usuario_c" value="<?php echo($id_usuario); ?>">
                        <input type="hidden" required="required" readonly id="id_copy" name="id_copy">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!--<label for="exampleInputPassword1">Cantidad</label>-->
                                    <input type="number" name="cantidad" class="form-control" id="exampleInputPassword1"
                                        placeholder="Cantidad" required min="1" max="99">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Generar Copias</button>
            </div>
            </form>
        </div>
    </div>
</div>