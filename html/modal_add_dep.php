<?php
	include("ajax/conexion.php");
?>

<div id="addDepModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_dep" id="add_dep">
				<div class="modal-header">
					<h4 class="modal-title">Agregar dependencia</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="idendep"
								id="idendep" placeholder="Identificador" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="idendep">Identificador</label>
							<div class="small">IDENTIFICADORES: 001 - Dependencias Estatales || 002 - Municipio || 003 - Estados || 004 - Federales y Autónomos || 005 - SECOEM </div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="sigladep"
								id="sigladep" placeholder="Siglas de la dependencia" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="sigladep">Sigla</label>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-label-group">
							<input type="text" class="form-control font-weight-bold" name="nomdep"
								id="nomdep" placeholder="Nombre de la dependencia" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<label for="nomdep">Nombre</label>
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