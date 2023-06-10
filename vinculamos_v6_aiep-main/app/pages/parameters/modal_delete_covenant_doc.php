<!-- Modal -->
<div class="modal fade" id="deleteCovenantDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Eliminar convenio
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" id="delete_covenant_doc" name="delete_covenant_doc">
					<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($id_covenant)."' id='vg_id_convenio' name='vg_id_convenio' />"; ?>
					<?php echo "<input type='hidden' value='' id='vg_id' name='vg_id' />"; ?>

					<div class="form-group">
						<label id="mensaje" class="col-sm-12 text-center"><h1><span class="glyphicon glyphicon-exclamation-sign"></span></h1> Se eliminará el documento "<span id="vg_nombre">Documento</span>" asociado al convenio "<span id="vg_nombre_convenio">Convenio</span>"</label>
					</div>
					<div class="form-group">
						<label id="mensaje" class="col-sm-12 text-center">¿Continuar?</label>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-orange" id="delete_user">Aceptar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
