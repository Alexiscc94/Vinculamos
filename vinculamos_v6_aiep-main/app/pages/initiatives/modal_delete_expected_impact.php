<!-- Modal -->
<div class="modal fade" id="deleteImpact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Eliminar impacto
				</h4>
			</div>
			<div class="modal-body">
				<div id="impactos_modal_eliminar"></div>
				<p class="text-center">
					<strong>Se eliminará el impacto seleccionado.<br>¿Desea continuar?</strong>
				</p>
				<form class="form-horizontal" method="post" id="delete_impact" name="delete_impact">
					<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='". noeliaEncode($datas[0]["id"]). "' id='vg_initiative' name='vg_initiative' />"; ?>
					<?php echo "<input type='hidden' value='' id='id_impacto' name='id_impacto' />"; ?>

					<p class="text-center" id="vg_impacto" name="vg_impacto"></p>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-orange">Si</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
