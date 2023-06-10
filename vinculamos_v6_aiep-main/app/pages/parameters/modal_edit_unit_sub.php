<!-- Modal -->
<div class="modal fade" id="editUnitSub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Editar sub unidad
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_editar"></div>
				<form class="form-horizontal" method="post" id="edit_unit_sub" name="edit_unit_sub">
					<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($id)."' id='vg_id_unidad' name='vg_id_unidad' />"; ?>
					<?php echo "<input type='hidden' value='' id='vg_id' name='vg_id' />"; ?>
					<div class="form-group">
						<label for="vg_nombre" class="col-sm-3 control-label">Nombre <span class="text-red">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="vg_nombre" name="vg_nombre"
								placeholder="Nombre" maxlength="200" required>
						</div>
					</div>
					<div class="form-group">
						<label for="vg_descripcion" class="col-sm-3 control-label">Descripción</label>
						<div class="col-sm-8">
							<textarea class="form-control textarea" placeholder="Descripción" id="vg_descripcion" name="vg_descripcion"
									style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="vg_director" class="col-sm-3 control-label">Director</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="vg_director" name="vg_director"
								placeholder="Director" maxlength="200">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-orange">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
