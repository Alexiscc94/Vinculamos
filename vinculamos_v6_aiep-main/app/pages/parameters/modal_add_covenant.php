<!-- Modal -->
<div class="modal fade" id="addCovenant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Nuevo convenio
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_agregar"></div>
				<form class="form-horizontal" method="post" id="add_covenant" name="add_covenant">
					<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">Nombre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="vg_nombre" name="vg_nombre"
								placeholder="Nombre" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ht_apellido" class="col-sm-4 control-label">Descripción</label>
						<div class="col-sm-8">
							<textarea class="form-control textarea" placeholder="Descripción" id="vg_descripcion" name="vg_descripcion"
									style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
						</div>
					</div>

					<!-- Nuevos campos -->
					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">Dirección</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="vg_direccion" name="vg_direccion"
								placeholder="Dirección" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">Nombre de contacto</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="vg_nombre_contacto" name="vg_nombre_contacto"
								placeholder="Nombre de contacto" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">Teléfono/Celular</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="vg_telefono" name="vg_telefono"
								placeholder="Teléfono/Celular" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">Correo electrónico</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="vg_correo_electronico" name="vg_correo_electronico"
								placeholder="Correo electrónico" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ht_nombre" class="col-sm-4 control-label">Fecha de suscripción</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" id="vg_fecha_suscripcion" name="vg_fecha_suscripcion"
								placeholder="Fecha de suscripción" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ht_apellido" class="col-sm-4 control-label">Observaciones</label>
						<div class="col-sm-8">
							<textarea class="form-control textarea" placeholder="Observaciones" id="vg_observaciones" name="vg_observaciones"
									style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
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
