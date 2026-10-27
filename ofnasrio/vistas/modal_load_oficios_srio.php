<div id="loadOficiosModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="load_oficios" id="load_oficios" enctype="multipart/form-data">
				<div class="card">	
					<div class="card-header card-header-icon card-header-rose">
						<div class="card-icon">
							<i class="material-icons">cloud_upload</i>
						</div>
						<h3 class="text-danger text-center">Subir Oficio</h5>
					</div>
					<div class="card-body">						
						<div class="form-group">
							<input type="hidden" name="id_oficio" id="id_oficio">
						</div>
						<div class="fileinput fileinput-new text-center text-danger" data-provides="fileinput">
							<div class="fileinput-preview fileinput-exists thumbnail "></div>
							<div>
								<span class="btn btn-raised btn-round btn-default btn-file">
									<input type="file" name="oficio" id="oficio" accept="application/pdf"
										required />
								</span>
							</div>
						</div>
					</div>
					<div class="card-footer text-muted">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success btn_enviar" value="Subir Archivo">
					</div>					
				</div>
            </form>
        </div>
    </div>
</div>