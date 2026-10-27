<div id="eliminarArchivoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="cancelar_oficio" id="cancelar_oficio">
				<div class="modal-header">
					<h4 class="modal-title">Cancelar Oficio </h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>¿Seguro que quieres Cancelar éste oficio?</p>
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