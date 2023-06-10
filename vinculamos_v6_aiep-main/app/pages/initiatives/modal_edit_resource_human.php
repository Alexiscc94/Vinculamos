<!-- Modal -->
<div class="modal fade" id="editHuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Editar recursos humanos
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_editar_humano"></div>
				<form class="form-horizontal" method="post" id="edit_human" name="edit_human">
					<?php echo "<input type='hidden' value='".($nombre_usuario)."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($id)."' id='vg_initiative' name='vg_initiative' />"; ?>
					<?php echo "<input type='hidden' value='' id='vg_id' name='vg_id' />"; ?>
					<?php echo "<input type='hidden' value='' id='vg_source' name='vg_source' />"; ?>
					<div class="form-group">
						<label for="ht_codigo" class="col-sm-4 control-label">Tipo de RRHH</label>
						<div class="col-sm-8">
							<select class="selectpicker form-control" id="vg_type_human" name="vg_type_human" required
								title="Tipo de RRHH" data-live-search="true">
								<?php
									foreach($humanTypes as $type) {
										echo "<option value='" . $type['nombre'] ."'>" . $type['nombre']. "</option>";
									}
								?>
              </select>
						</div>
					</div>

					<div class="form-group">
						<label for="ht_descripcion" class="col-sm-4 control-label">Cantidad de horas</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" id="vg_amount_human" name="vg_amount_human"
							required min="1" value="1" />
						</div>
					</div>

					<div class="form-group">
						<label for="ht_descripcion" class="col-sm-4 control-label">Valorización</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="vg_total_human" name="vg_total_human"/>
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
