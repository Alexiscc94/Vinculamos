<!-- Modal -->
<div class="modal fade" id="editParticipationReal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class='glyphicon glyphicon-edit'></i> Editar participante real
				</h4>
			</div>
			<div class="modal-body">
				<div id="resultados_modal_editar_real"></div>
				<form class="form-horizontal" method="post" id="edit_participation_real" name="edit_participation_real">
					<?php echo "<input type='hidden' value='".($nombre_usuario)."' id='vg_modal_usuario' name='vg_modal_usuario' />"; ?>
					<?php echo "<input type='hidden' value='".noeliaEncode($id)."' id='vg_modal_initiative' name='vg_modal_initiative' />"; ?>
					<?php echo "<input type='hidden' value='' id='vg_modal_id' name='vg_modal_id' />"; ?>
					<div class="col-md-12">
						<div class="row">
							<div class="col-xs-6 col-md-4">
								<label for="vg_programa">¿Interno o Externo? <span class="text-red">*</span></label>
								<select class="form-control selectpicker" id="vg_modal_tipo" name="vg_modal_tipo" required
									title="¿Interno o Externo?" onchange="selectParticitationTypeModal();">
									<option>Interno</option>
									<option>Externo</option>
								</select>
							</div>
							<div class="col-xs-6 col-md-4">
								<label for="vg_modal_programa">Público esperado</label>
								<select class="form-control" id="vg_modal_tipo_asistente" name="vg_modal_tipo_asistente" required
									title="Asistente esperado" >
									<option></option>
								<?php
									foreach($participationTypes as $participationType) {
										echo "<option value='" . $participationType['nombre'] ."'>" . $participationType['nombre']. "</option>";
									}
								?>
								</select>
							</div>
							<div class="col-xs-6 col-md-4">
								<label for="fa_nombre">Número de personas</label>
								<input type="number" class="form-control" id="vg_modal_publico_general" name="vg_modal_publico_general"
									placeholder="Número de personas" maxlength="100" required>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-md-4">
								<input type="checkbox" id="checkbox_modal_sexo" name="checkbox_modal_sexo"><label for="vg_modal_programa">&nbsp;¿Género?</label>
								<input type="number" class="form-control" id="vg_modal_sexo_masculino" name="vg_modal_sexo_masculino"
									placeholder="Hombre" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_sexo_femenino" name="vg_modal_sexo_femenino"
									placeholder="Mujer" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_sexo_otro" name="vg_modal_sexo_otro"
									placeholder="Otro" maxlength="100" readonly>
							</div>
							<div class="col-xs-6 col-md-4">
								<input type="checkbox" id="checkbox_modal_edad" name="checkbox_modal_edad"><label for="vg_modal_programa">&nbsp;¿Segmento etario?</label>
								<input type="number" class="form-control" id="vg_modal_edad_ninos" name="vg_modal_edad_ninos"
									placeholder="Niños" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_edad_jovenes" name="vg_modal_edad_jovenes"
									placeholder="Jóvenes" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_edad_adultos" name="vg_modal_edad_adultos"
									placeholder="Adultos" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_edad_adultos_mayores" name="vg_modal_edad_adultos_mayores"
									placeholder="Adultos Mayores" maxlength="100" readonly>
							</div>
							<div class="col-xs-6 col-md-4">
								<input type="checkbox" id="checkbox_modal_procedencia" name="checkbox_modal_procedencia"><label for="vg_modal_programa">&nbsp;¿Procedencia?</label>
								<input type="number" class="form-control" id="vg_modal_procedencia_rural" name="vg_modal_procedencia_rural"
									placeholder="Rural" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_procedencia_urbano" name="vg_modal_procedencia_urbano"
									placeholder="Urbano" maxlength="100" readonly>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-6 col-md-4">
								<input type="checkbox" id="checkbox_modal_vulnerabilidad" name="checkbox_modal_vulnerabilidad"><label for="vg_programa">&nbsp;¿Vulnerabilidad?</label>
								<input type="number" class="form-control" id="vg_modal_vulnerabilidad_discapacidad" name="vg_modal_vulnerabilidad_discapacidad"
									placeholder="Discapacidad" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_vulnerabilidad_pobreza" name="vg_modal_vulnerabilidad_pobreza"
								placeholder="Pobreza" maxlength="100" readonly>
							</div>

							<div class="col-xs-6 col-md-4">
								<input type="checkbox" id="checkbox_modal_nacionalidad" name="checkbox_modal_nacionalidad"><label for="vg_programa">&nbsp;¿Nacionalidad?</label>
								<input type="number" class="form-control" id="vg_modal_nacionalidad_chileno" name="vg_modal_nacionalidad_chileno"
									placeholder="Chileno" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_nacionalidad_migrante" name="vg_modal_nacionalidad_migrante"
									placeholder="Migrante" maxlength="100" readonly>
							</div>

							<div class="col-xs-6 col-md-4">
								<input type="checkbox" id="checkbox_modal_etnia" name="checkbox_modal_etnia"><label for="vg_programa">&nbsp;¿Adscripción a pueblos originarios?</label>
								<input type="number" class="form-control" id="vg_modal_etnia_mapuche" name="vg_modal_etnia_mapuche"
									placeholder="Mapuche" maxlength="100" readonly>
								<input type="number" class="form-control" id="vg_modal_etnia_otro" name="vg_modal_etnia_otro"
									placeholder="Otro" maxlength="100" readonly>
							</div>

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

<script>
	$('#edit_participation_real #checkbox_modal_sexo').on('change', function() {
		$("#edit_participation_real #vg_modal_sexo_masculino").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_sexo_femenino").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_sexo_otro").prop('readonly', !this.checked);
	});

	$('#edit_participation_real #checkbox_modal_edad').on('change', function() {
		$("#edit_participation_real #vg_modal_edad_ninos").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_edad_jovenes").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_edad_adultos").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_edad_adultos_mayores").prop('readonly', !this.checked);
	});

	$('#edit_participation_real #checkbox_modal_procedencia').on('change', function() {
		$("#edit_participation_real #vg_modal_procedencia_rural").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_procedencia_urbano").prop('readonly', !this.checked);
	});

	$('#edit_participation_real #checkbox_modal_vulnerabilidad').on('change', function() {
		$("#edit_participation_real #vg_modal_vulnerabilidad_discapacidad").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_vulnerabilidad_pobreza").prop('readonly', !this.checked);
	});

	$('#edit_participation_real #checkbox_modal_nacionalidad').on('change', function() {
		$("#edit_participation_real #vg_modal_nacionalidad_chileno").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_nacionalidad_migrante").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_nacionalidad_pueblo").prop('readonly', !this.checked);
	});

	$('#edit_participation_real #checkbox_modal_etnia').on('change', function() {
		$("#edit_participation_real #vg_modal_etnia_mapuche").prop('readonly', !this.checked);
		$("#edit_participation_real #vg_modal_etnia_otro").prop('readonly', !this.checked);
	});
</script>
