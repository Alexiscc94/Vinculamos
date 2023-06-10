<!-- Modal -->
<div class="modal fade" id="askRevision" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Pedir revisión
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_ask_revision"></div>
				<form class="form-horizontal" method="post" id="ask_revision" name="ask_revision">
					<?php echo "<input type='hidden' value='".($_SESSION['nombre_usuario'])."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($datas[0]["id"])."' id='vg_id' name='vg_id' />"; ?>

					<div class="form-group">
						<label id="mensaje" class="col-sm-12 text-center"><h1><span class="glyphicon glyphicon-ok-sign text-orange"></span></h1> Se pedirá revisión de su iniciativa <br>¿Desea continuar?</label>
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
