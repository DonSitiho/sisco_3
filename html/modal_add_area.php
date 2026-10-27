<?php
	include("ajax/conexion.php");
?>

<div id="addAreaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_area" id="add_area">
				<div class="modal-header">
					<h4 class="modal-title">Agregar Area</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
					<div class="form-group">
						<label>Nombre:</label>
						<input type="text" name="nomarea" id="nomarea" class="form-control" required>
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