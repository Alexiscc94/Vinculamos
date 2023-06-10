<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}
	$nombre_usuario = $_SESSION["nombre_usuario"];
	include_once("../../utils/user_utils.php");
	if(!canReadInitiatives()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$id_initiative = base64_decode($_POST['id_initiative']);

	include_once("../../controller/medoo_participation_real.php");
	$datas = getVisibleRealParticipationByInitiative($id_initiative);

	//include_once("../../controller/medoo_participation_real_tag.php");
?>

  <div class="box-body table-responsive">
		<div id="result_human_resources_detail"></div>
		<table id="tableType_1" class="table table-bordered table-hover">
			<thead class="small">
				<tr>
					<th rowspan="2" class="text-center">¿Interno o Externo?</th>
					<th rowspan="2" class="text-center">Público participante</th>
					<th rowspan="2" class="text-center">Número de personas</th>
					<th colspan="3" class="text-center">Género</th>
					<th colspan="4" class="text-center">Segmento Etario</th>
					<th colspan="2" class="text-center">Procedencia</th>
					<th colspan="2" class="text-center">Vulnerabilidad</th>
					<th colspan="2" class="text-center">Nacionalidad</th>
					<th colspan="2" class="text-center">Adscripción a pueblos originarios</th>
					<th rowspan="2" class="text-center"></th>
				</tr>
				<tr>
					<th class="text-center">Hombre</th>
					<th class="text-center">Mujer</th>
					<th class="text-center">Otro</th>
					<th class="text-center">Niños</th>
					<th class="text-center">Jóvenes</th>
					<th class="text-center">Adultos</th>
					<th class="text-center">Adultos Mayores</th>
					<th class="text-center">Rural</th>
					<th class="text-center">Urbano</th>
					<th class="text-center">Discapacidad</th>
					<th class="text-center">Situación de Pobreza</th>

					<th class="text-center">Chileno</th>
					<th class="text-center">Migrante</th>

					<th class="text-center">Mapuche</th>
					<th class="text-center">Otro</th>
					<!--th>Pueblo originario</th-->
				</tr>
			</thead>
			<tbody class="small">
				<?php
					for($i=0 ; $i<sizeof($datas) ; $i++) { ?>
						<tr>
							<td class="text-center">
								<?php
								 	if($datas[$i]['tipo'] == "Interno") {
										echo "<small class='label bg-purple'>Interno</small>";
									}
									if($datas[$i]['tipo'] == "Externo") {
										echo "<small class='label bg-maroon'>Externo</small>";
									}
								?>
							</td>
							<td class="text-center">
								<?php
									echo $datas[$i]['tipo2'];
									echo "<br>";
									//$tags = getVisibleParticipationTagPlanByParticipation($datas[$i]['id']);
									foreach ($tags as $tag) {
										echo "<small class='label bg-blue'>" . $tag["detalle"] . "</small> ";
									}
								?>
							</td>
							<td class="text-center"><?php echo number_format($datas[$i]['publico_general'], '0', ',','.');?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_sexo'] == "on" ? number_format($datas[$i]['sexo_masculino'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_sexo'] == "on" ? number_format($datas[$i]['sexo_femenino'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_sexo'] == "on" ? number_format($datas[$i]['sexo_otro'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_edad'] == "on" ? number_format($datas[$i]['edad_ninos'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_edad'] == "on" ? number_format($datas[$i]['edad_jovenes'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_edad'] == "on" ? number_format($datas[$i]['edad_adultos'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_edad'] == "on" ? number_format($datas[$i]['edad_adultos_mayores'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_procedencia'] == "on" ? number_format($datas[$i]['procedencia_rural'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_procedencia'] == "on" ? number_format($datas[$i]['procedencia_urbano'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_vulnerabilidad'] == "on" ? number_format($datas[$i]['vulnerabilidad_discapacidad'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_vulnerabilidad'] == "on" ? number_format($datas[$i]['vulnerabilidad_pobreza'], '0', ',','.'):"-");?></td>

							<td class="text-center"><?php echo ($datas[$i]['aplica_nacionalidad'] == "on" ? number_format($datas[$i]['nacionalidad_chileno'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_nacionalidad'] == "on" ? number_format($datas[$i]['nacionalidad_migrante'], '0', ',','.'):"-");?></td>

							<td class="text-center"><?php echo ($datas[$i]['aplica_etnia'] == "on" ? number_format($datas[$i]['etnia_mapuche'], '0', ',','.'):"-");?></td>
							<td class="text-center"><?php echo ($datas[$i]['aplica_etnia'] == "on" ? number_format($datas[$i]['etnia_otro'], '0', ',','.'):"-");?></td>
							<td width="50px">
								<?php
									if(canUpdateInitiatives()) {
										$data = base64_encode("data" . $datas[$i]['id']); ?>
										<!--a href="edit_initiative.php?data=<?php echo$data;?>" class='btn btn-orange' title='Editar'>
											<i class="glyphicon glyphicon-edit"></i></a-->

										<a href="#" class='text-yellow' title='Editar'
											data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
											data-tipo='<?php echo ($datas[$i]['tipo']);?>'
											data-tipo2='<?php echo ($datas[$i]['tipo2']);?>'
											data-publico_general='<?php echo base64_encode($datas[$i]['publico_general']);?>'
											data-aplica_sexo='<?php echo base64_encode($datas[$i]['aplica_sexo']);?>'
											data-sexo_masculino='<?php echo base64_encode($datas[$i]['sexo_masculino']);?>'
											data-sexo_femenino='<?php echo base64_encode($datas[$i]['sexo_femenino']);?>'
											data-sexo_otro='<?php echo base64_encode($datas[$i]['sexo_otro']);?>'
											data-aplica_edad='<?php echo base64_encode($datas[$i]['aplica_edad']);?>'
											data-edad_ninos='<?php echo base64_encode($datas[$i]['edad_ninos']);?>'
											data-edad_jovenes='<?php echo base64_encode($datas[$i]['edad_jovenes']);?>'
											data-edad_adultos='<?php echo base64_encode($datas[$i]['edad_adultos']);?>'
											data-edad_adultos_mayores='<?php echo base64_encode($datas[$i]['edad_adultos_mayores']);?>'
											data-aplica_procedencia='<?php echo base64_encode($datas[$i]['aplica_procedencia']);?>'
											data-procedencia_rural='<?php echo base64_encode($datas[$i]['procedencia_rural']);?>'
											data-procedencia_urbano='<?php echo base64_encode($datas[$i]['procedencia_urbano']);?>'

											data-aplica_vulnerabilidad='<?php echo base64_encode($datas[$i]['aplica_vulnerabilidad']);?>'
											data-vulnerabilidad_discapacidad='<?php echo base64_encode($datas[$i]['vulnerabilidad_discapacidad']);?>'
											data-vulnerabilidad_pobreza='<?php echo base64_encode($datas[$i]['vulnerabilidad_pobreza']);?>'

											data-aplica_nacionalidad='<?php echo base64_encode($datas[$i]['aplica_nacionalidad']);?>'
											data-nacionalidad_chileno='<?php echo base64_encode($datas[$i]['nacionalidad_chileno']);?>'
											data-nacionalidad_migrante='<?php echo base64_encode($datas[$i]['nacionalidad_migrante']);?>'

											data-aplica_etnia='<?php echo base64_encode($datas[$i]['aplica_etnia']);?>'
											data-etnia_mapuche='<?php echo base64_encode($datas[$i]['etnia_mapuche']);?>'
											data-etnia_otro='<?php echo base64_encode($datas[$i]['etnia_otro']);?>'

											data-usuario='<?php echo noeliaEncode($_SESSION["nombre_usuario"]);?>'
											data-toggle="modal" data-target="#editParticipationReal">
											<i class="glyphicon glyphicon-edit small"></i>
										</a>
										&nbsp;&nbsp;
										<a href="#" class='text-blue' title='Eliminar'
											data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
											data-id_iniciativa='<?php echo noeliaEncode($datas[$i]['id_iniciativa']);?>'
											data-usuario='<?php echo noeliaEncode($_SESSION["nombre_usuario"]);?>'
											data-toggle="modal" data-target="#deleteParticipationReal">
											<i class="glyphicon glyphicon-trash small"></i></a>
								<?php
									} ?>
							</td>
						</tr>
				<?php
					} ?>

			</tbody>
		</table>

  </div>
  <!-- /.box-body -->
