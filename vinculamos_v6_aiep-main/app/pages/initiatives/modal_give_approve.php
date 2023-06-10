<!-- Modal -->
<div class="modal fade" id="giveApprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Aprobar iniciativa
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_give_approve"></div>
				<form class="form-horizontal" method="post" id="give_approve" name="give_approve">
					<?php echo "<input type='hidden' value='".($_SESSION['nombre_usuario'])."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($datas[0]["id"])."' id='vg_id' name='vg_id' />"; ?>

					<div class="form-group">
						<label id="mensaje" class="col-sm-12 text-center"><h1><span class="glyphicon glyphicon-ok-sign text-orange"></span></h1> Se aprobará esta iniciativa <br>¿Desea continuar?</label>
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
