<?php
	include("ajax/conexion.php");
?>

<div id="addUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_user" id="add_user">
				<div class="modal-header">
					<h4 class="modal-title">Agregar usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="nomuser"
								id="nomuser" placeholder="Nombre usuario" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="nomuser">Nombre</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="apuser"
								id="apuser" placeholder="Apellido Paterno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="apuser">Apellido paterno</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="amuser"
								id="amuser" placeholder="Apellido Materno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="amuser">Apellido materno</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="nickuser"
								id="nickuser" placeholder="Nick name" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="nickuser">Nick name</label>
						</div>
					</div>					
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="password" class="form-control font-weight-bold" name="pasuser"
								id="pasuser" placeholder="Contrasena" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="pasuser">Contraseña</label>
						</div>
					</div>
				</div>	
				<div class="row">				
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="number" class="form-control font-weight-bold" name="diruser"
								id="diruser" placeholder="Area donde pertenece" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="diruser">Dirección</label>
						</div>
					</div>							
					<div class="col-md-6">
						<div class="form-label-group">
							<input type="number" class="form-control font-weight-bold" name="nivuser"
								id="nivuser" placeholder="Nivel Acceso" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="nivuser">Nivel acceso</label>
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