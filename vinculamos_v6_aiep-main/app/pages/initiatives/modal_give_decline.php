<!-- Modal -->
<div class="modal fade" id="giveDecline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Rechazar iniciativa
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_give_decline"></div>
				<form class="form-horizontal" method="post" id="give_decline" name="give_decline">
					<?php echo "<input type='hidden' value='".($_SESSION['nombre_usuario'])."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($datas[0]["id"])."' id='vg_id' name='vg_id' />"; ?>

					<div class="form-group">
						<label id="mensaje" class="col-sm-12 text-center"><h1><span class="glyphicon glyphicon-ok-sign text-orange"></span></h1> Se rechazará esta iniciativa <br>¿Desea continuar?</label>
					</div>

					<div class="form-group">
						<label for="vg_observaciones" class="col-sm-3 control-label">Observaciones </label>
						<div class="col-sm-9">
							<textarea class="form-control textarea" placeholder="Observaciones" id="vg_observaciones" name="vg_observaciones"
									style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-orange"><i class="fa fa-fw fa-chevron-right"></i> Continuar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
