<div id="editDepModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_dep" id="edit_dep">
				<div class="modal-header">
					<h4 class="modal-title">Editar dependencia</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="edit_idendep"
								id="edit_idendep" placeholder="Identificador" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_idendep">Identificador</label>
							<input type="hidden" name="edit_id" id="edit_id">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="edit_sigladep"
								id="edit_sigladep" placeholder="Siglas de la dependencia" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_sigladep">Sigla</label>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="edit_nomdep"
								id="edit_nomdep" placeholder="Nombre de la dependencia" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_nomdep">Nombre</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-info" value="Guardar datos">
				</div>
			</form>
		</div>
	</div>
</div>