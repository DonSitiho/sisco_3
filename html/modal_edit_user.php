<div id="editUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_user" id="edit_user">
				<div class="modal-header">
					<h4 class="modal-title">Editar usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="edit_nomuser"
								id="edit_nomuser" placeholder="Nombre usuario" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_nomuser">Nombre</label>
							<input type="hidden" name="edit_id" id="edit_id">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="edit_apuser"
								id="edit_apuser" placeholder="Apellido Paterno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_apuser">Apellido paterno</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="edit_amuser"
								id="edit_amuser" placeholder="Apellido Materno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_amuser">Apellido materno</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="edit_nickuser"
								id="edit_nickuser" placeholder="Nick name" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_nickuser">Nick name</label>
						</div>
					</div>					
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="password" class="form-control font-weight-bold" name="edit_pasuser"
								id="edit_pasuser" placeholder="Contrasena" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_pasuser">Contraseña</label>
						</div>
					</div>
				</div>	
				<div class="row">				
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="number" class="form-control font-weight-bold" name="edit_diruser"
								id="edit_diruser" placeholder="Area donde pertenece" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_diruser">Dirección</label>
						</div>
					</div>							
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="number" class="form-control font-weight-bold" name="edit_nivuser"
								id="edit_nivuser" placeholder="Nivel Acceso" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="edit_nivuser">Nivel acceso</label>
						</div>
					</div>												
				</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Guardar Usuario">
				</div>
			</form>
		</div>
	</div>
</div>