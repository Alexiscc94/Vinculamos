<!-- Modal -->
<div class="modal fade" id="editResult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Editar resultado esperado
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_editar_resultado"></div>
				<form class="form-horizontal" method="post" id="edit_result" name="edit_result">
					<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($id)."' id='vg_id_iniciativa' name='vg_id_iniciativa' />"; ?>
					<?php echo "<input type='hidden' value='' id='vg_id' name='vg_id' />"; ?>
					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">¿Interno o Externo? <span class="text-red">*</span></label>
						<div class="col-sm-6">
							<select class="form-control selectpicker" id="vg_resultado_tipo" name="vg_resultado_tipo"
								title="¿Interno o Externo?" >
								<option>Interno</option>
								<option>Externo</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">Cuantif. <span class="text-red">*</span></label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="vg_resultado_cantidad" name="vg_resultado_cantidad"
								placeholder="Cantidad" >
						</div>
					</div>

					<div class="form-group">
						<label for="ht_apellido" class="col-sm-4 control-label">Resultado <span class="text-red">*</span></label>
						<div class="col-sm-6">
							<textarea class="form-control textarea" placeholder="Resultado" id="vg_resultado_texto" name="vg_resultado_texto"
									style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;" required></textarea>
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
