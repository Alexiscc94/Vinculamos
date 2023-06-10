<!-- Modal -->
<div class="modal fade" id="editStatusExecutionResult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Ingresar resultado de ejecución
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_estado_ejecucion_result"></div>
				<form class="form-horizontal" method="post" id="edit_execution_status_result" name="edit_execution_status_result">
					<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
					<?php echo "<input type='hidden' value='' id='vg_initiative' name='vg_initiative' />"; ?>

					<div class="form-group">
						<label id="mensaje" class="col-sm-12 text-center"><h1><span class="glyphicon glyphicon-flag"></span></h1> Se ingresará el resultado de ejecución la iniciativa</label>
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
