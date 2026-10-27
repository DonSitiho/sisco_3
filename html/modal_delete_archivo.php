<div id="eliminarArchivoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="delete_archivo" id="delete_archivo">
				<div class="modal-header">
					<h4 class="modal-title">Eliminar Archivo </h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>¿Seguro que quieres eliminar este Archivo?</p>
					<p class="text-warning">
						<small>Esta acción no se puede deshacer.</small>
					</p>
					<input type="hidden" name="eliminar_id" id="eliminar_id">
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-danger" value="Eliminar">
				</div>
			</form>
		</div>
	</div>
</div>