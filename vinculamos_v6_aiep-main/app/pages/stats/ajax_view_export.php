<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}
	include_once("../../utils/user_utils.php");
	if(!canReadInitiatives()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$institucion = getInstitution();
	$executionStatus = $_POST["executionStatus"];
	$fillmentStatus = $_POST["fillmentStatus"];

	include_once("../../controller/medoo_initiatives_plan.php");
	$datas = getVisibleInitiativesPlanByInstitutionFull($institucion, null, $executionStatus, $fillmentStatus);

	include_once("../../controller/medoo_invi_v2.php");
	include_once("../../controller/medoo_initiatives_plan_ods.php");
?>

<div class="box-body table-responsive">
	<table id="table" class="table table-bordered table-hover">
		<thead>
    	<tr>
      	<th>ID</th>
				<th>Nombre</th>
				<th>Año de ejecución</th>
				<th>Unidad institucional</th>
				<th>Sub Unidad</th>
				<th>Sede</th>
				<th>Ámbito de contribución</th> 
				<th>Carreras</th>
				<th>Ámbito de acción</th>
				<!-- <th>Ámbito de acción secundario</th> -->
				<th>Convenios</th>
				<th>Formato implementación</th>
				<!--<th>Responsable</th>
				<th>Responsable cargo</th> -->
				<th>Mecanismo</th>
				<th>Frecuencia</th>
				<th>Grupos de interés</th>
        <th>Sub Grupo de interes</th>
				<th>Participantes</th>
				<!-- <th>Objetivo</th> -->
				<th>Resumen de la iniciativa</th>
				<th>Impacto interno</th>
				<th>Impacto externo</th>
				<!-- <th>Impactos esperados</th> -->
				<!-- <th>Resultados esperados</th> -->
				<th>Paises</th>
				<th>Regiones</th>
				<th>Comunas</th>
				<th>Participantes</th>
			<!-- <th>Recursos Infraestructura</th>
				<th>Recursos Humanos</th>
				<th>Recursos Dinero</th> -->
				<th>Estado</th>

				<th>INVI Total v2</th>
				<th>Mecanismo etiqueta</th>
				<th>Mecanismo valor</th>
				<th>Cobertura etiqueta</th>
				<th>Cobertura valor</th>
				<th>Frecuencia etiqueta</th>
				<th>Frecuencia valor</th>
				<th>Resultados etiqueta</th>
				<th>Resultados valor</th>
				<th>Evaluación interna etiqueta</th>
				<th>Evaluación interna valor</th>
				<th>Evaluación externa etiqueta</th>
				<th>Evaluación externa valor</th>
				<th>Evaluación valor</th>
				<th>ODS</th>
			</tr>
		</thead>
   	<tbody>
 			<?php
 				for($i=0 ; $i<sizeof($datas) ; $i++) { ?>
 					<tr>
      			<td><?php echo $datas[$i]['id'];?></td>
						<td><?php echo $datas[$i]['nombre'];?></td>
						<td><?php echo date('Y', strtotime($datas[$i]['fecha_inicio']));?></td>
						<td>
							<?php
							 	$datas_units = $datas[$i]["unidades"];
								$unitsText = "";
								for($j=0 ; $j<sizeof($datas_units) ; $j++) {
									$unitsText .= $datas_units[$j]["nombre"];
									if($j<(sizeof($datas_units)-1))
										$unitsText .= ", ";
								}
								echo $unitsText == "" ? "No aplica para esta actividad":$unitsText;
							?>
						</td>
						<td>
							<?php
							 	$datas_units_sub = $datas[$i]["unidades_sub"];
								$unitsSubText = "";
								for($j=0 ; $j<sizeof($datas_units_sub) ; $j++) {
									$unitsSubText .= $datas_units_sub[$j]["nombre"];
									if($j<(sizeof($datas_units_sub)-1))
										$unitsSubText .= ", ";
								}
								echo $unitsSubText == "" ? "No aplica para esta actividad":$unitsSubText;
							?>
						</td>
						<td>
							<?php
							 	$datas_campus = $datas[$i]["sedes"];
								$campusText = "";
								for($j=0 ; $j<sizeof($datas_campus) ; $j++) {
									$campusText .= $datas_campus[$j]["nombre"];
									if($j<(sizeof($datas_campus)-1))
										$campusText .= ", ";
								}
								echo $campusText == "" ? "Nivel Central":$campusText;
							?>
						</td>
						<td>
							<?php
							 	$datas_departments = $datas[$i]["facultades"];
								$departmentText = "";
								for($j=0 ; $j<sizeof($datas_departments) ; $j++) {
									$departmentText .= $datas_departments[$j]["nombre"];
									if($j<(sizeof($datas_departments)-1))
										$departmentText .= ", ";
								}
								echo $departmentText == "" ? "No Aplica":$departmentText;
							?>
						</td>
						<td>
							<?php
							 	$datas_carrers = $datas[$i]["carreras"];
								$carrersText = "";
								for($j=0 ; $j<sizeof($datas_carrers) ; $j++) {
									$carrersText .= $datas_carrers[$j]["nombre"];
									if($j<(sizeof($datas_carrers)-1))
										$carrersText .= ", ";
								}
								echo $carrersText == "" ? "No Aplica":$carrersText;
							?>
						</td>
						<td>
							<?php
							 	$datas_programs = $datas[$i]["programas"];
								$programText = "";
								for($j=0 ; $j<sizeof($datas_programs) ; $j++) {
									$programText .= $datas_programs[$j]["nombre"];
									if($j<(sizeof($datas_programs)-1))
										$programText .= ", ";
								}
								echo $programText == "" ? "No":$programText;
							?>
						</td>
					<!--	<td>
							?php
							 	$datas_programs_second = $datas[$i]["programas_secundarios"];
								$programSecondaryText = "";
								for($j=0 ; $j<sizeof($datas_programs_second) ; $j++) {
									$programSecondaryText .= $datas_programs_second[$j]["nombre"];
									if($j<(sizeof($datas_programs_second)-1))
										$programSecondaryText .= ", ";
								}
								echo $programSecondaryText == "" ? "No":$programSecondaryText;
							?>
						</td>-->
						<td>
							<?php
							 	$datas_covenants = $datas[$i]["convenios"];
								$covenantText = "";
								for($j=0 ; $j<sizeof($datas_covenants) ; $j++) {
									$covenantText .= $datas_covenants[$j]["nombre"];
									if($j<(sizeof($datas_covenants)-1))
										$covenantText .= ", ";
								}
								echo $covenantText == "" ? "No":$covenantText;
							?>
						</td>
						<td><?php echo $datas[$i]['formato_implementacion'];?></td>
						<!-- <td> ?php echo $datas[$i]['responsable'];?></td> -->
						<!-- <td> ?php echo $datas[$i]['responsable_cargo'];?></td> -->
						<td><?php echo $datas[$i]['mecanismo_nombre'];?></td>
						<td><?php echo $datas[$i]['frecuencia_nombre'];?></td>
						<td>
							<?php
							 	$datas_envs = $datas[$i]["entornos"];
								$envsText = "";
								for($j=0 ; $j<sizeof($datas_envs) ; $j++) {
									$envsText .= $datas_envs[$j]["nombre"];
									if($j<(sizeof($datas_envs)-1))
										$envsText .= ", ";
								}
								echo $envsText == "" ? "No":$envsText;
							?>
						</td>
						<td>
							<?php
							 	$datas_envs = $datas[$i]["entornos"];
								$subenvsText = "";
								for($j=0 ; $j<sizeof($datas_envs) ; $j++) {
									$datas_envs_sub = $datas_envs[$j]["sub_entornos"];
									for($k=0 ; $k<sizeof($datas_envs_sub) ; $k++) {
										$subenvsText .= $datas_envs_sub[$k]["nombre"];
										$subenvsText .= "<br> ";
									}
								}
								echo $subenvsText == "" ? "No":$subenvsText;
							?>
						</td>
						<td>
							<?php
							 	$datas_envs = $datas[$i]["entornos"];
								$tagsubenvsText = "";
								for($j=0 ; $j<sizeof($datas_envs) ; $j++) {
									$datas_envs_sub = $datas_envs[$j]["sub_entornos"];
									for($k=0 ; $k<sizeof($datas_envs_sub) ; $k++) {
										$datas_envs_sub_tag = $datas_envs_sub[$k]["participantes"];
										for($y=0 ; $y<sizeof($datas_envs_sub_tag) ; $y++) {
											if($datas_envs_sub_tag[$y]["tag"] != "") {
												$tagsubenvsText .= $datas_envs_sub_tag[$y]["tag"];
												$tagsubenvsText .= "<br> ";
											}
										}
									}
								}
								echo $tagsubenvsText == "" ? "No":$tagsubenvsText;
							?>
						</td>
						<!--<td> ?php echo $datas[$i]['objetivo'];?></td> -->
						<td><?php echo $datas[$i]['descripcion'];?></td>
						<td>
							<?php
							 	$datas_impact_internal = $datas[$i]["impactos_internos"];
								$internalText = "";
								for($j=0 ; $j<sizeof($datas_impact_internal) ; $j++) {
									$internalText .= $datas_impact_internal[$j]["nombre"];
									if($j<(sizeof($datas_impact_internal)-1))
										$internalText .= ", ";
								}
								echo $internalText == "" ? "No":$internalText;
							?>
						</td>
						<td>
							<?php
							 	$datas_impact_external = $datas[$i]["impactos_externos"];
								$externalText = "";
								for($j=0 ; $j<sizeof($datas_impact_external) ; $j++) {
									$externalText .= $datas_impact_external[$j]["nombre"];
									if($j<(sizeof($datas_impact_external)-1))
										$externalText .= ", ";
								}
								echo $externalText == "" ? "No":$externalText;
							?>
						</td>
						<!--<td>
							?php
							 	$datas_expected_results = $datas[$i]["resultados_esperados"];
								$resultsText = "";
								for($j=0 ; $j<sizeof($datas_expected_results) ; $j++) {
									$resultsText .= ("(".$datas_expected_results[$j]["tipo"] . ") - " . $datas_expected_results[$j]["cantidad"] . " - " . $datas_expected_results[$j]["resultado"]);
									$resultsText .= "<br><br>";
								}
								echo $resultsText == "" ? "No":$resultsText;
							?>
						</td> -->
						<!--<td>
							?php
							 	$datas_expected_impacts = $datas[$i]["impactos_esperados"];
								$impactText = "";
								for($j=0 ; $j<sizeof($datas_expected_impacts) ; $j++) {
									$impactText .= ("(".$datas_expected_impacts[$j]["tipo"] . ") - " . $datas_expected_impacts[$j]["cantidad"] . " - " . $datas_expected_impacts[$j]["impacto"]);
									$impactText .= "<br><br>";
								}
								echo $impactText == "" ? "No":$impactText;
							?>
						</td> -->
						<td>
							<?php
							 	$datas_countries = $datas[$i]["paises"];
								$countriesText = "";
								for($j=0 ; $j<sizeof($datas_countries) ; $j++) {
									$countriesText .= $datas_countries[$j]["nombre"];
									if($j<(sizeof($datas_countries)-1))
										$countriesText .= ", ";
								}
								echo $countriesText == "" ? "No Aplica":$countriesText;
							?>
						</td>
						<td>
							<?php
							 	$datas_regions = $datas[$i]["regiones"];
								$regionsText = "";
								for($j=0 ; $j<sizeof($datas_regions) ; $j++) {
									$regionsText .= $datas_regions[$j]["nombre"];
									if($j<(sizeof($datas_regions)-1))
										$regionsText .= ", ";
								}
								echo $regionsText == "" ? "":$regionsText;
							?>
						</td>
						<td>
							<?php
							 	$datas_communes = $datas[$i]["comunas"];
								$communesText = "";
								for($j=0 ; $j<sizeof($datas_communes) ; $j++) {
									$communesText .= $datas_communes[$j]["nombre"];
									if($j<(sizeof($datas_communes)-1))
										$communesText .= ", ";
								}
								echo $communesText == "" ? "":$communesText;
							?>
						</td>
						<td>
							<?php
							 	$datas_participation = $datas[$i]["participantes"];
								$impactText = "";
								for($j=0 ; $j<sizeof($datas_participation) ; $j++) {
									$impactText .= ("(".$datas_participation[$j]["tipo"] . ") - " . $datas_participation[$j]["tipo2"] . " - " . $datas_participation[$j]["publico_general"]);
									$impactText .= "<br><br>";
								}
								echo $impactText == "" ? "No":$impactText;
							?>
						</td>
					<!-- <td>
							?php
							 	$datas_resources_bulding = $datas[$i]["recursos_infraestructuras"];
								$resourcesText = "";
								for($j=0 ; $j<sizeof($datas_resources_bulding) ; $j++) {
									$resourcesText .= ("(".$datas_resources_bulding[$j]["fuente"] . " / " . $datas_resources_bulding[$j]["tipo"] . ") - " . $datas_resources_bulding[$j]["cantidad"] . " - " . $datas_resources_bulding[$j]["valorizacion"]);
									$resourcesText .= "<br><br>";
								}
								echo $resourcesText == "" ? "No":$resourcesText;
							?>
						</td>
						<td>
							?php
							 	$datas_resources_human = $datas[$i]["recursos_humanos"];
								$resourcesText = "";
								for($j=0 ; $j<sizeof($datas_resources_human) ; $j++) {
									$resourcesText .= ("(".$datas_resources_human[$j]["fuente"] . " / " . $datas_resources_human[$j]["tipo"] . ") - " . $datas_resources_human[$j]["cantidad"] . " - " . $datas_resources_human[$j]["valorizacion"]);
									$resourcesText .= "<br><br>";
								}
								echo $resourcesText == "" ? "No":$resourcesText;
							?>
						</td>
						<td>
							?php
							 	$datas_resources_cash = $datas[$i]["recursos_dinero"];
								$resourcesText = "";
								for($j=0 ; $j<sizeof($datas_resources_cash) ; $j++) {
									$resourcesText .= ("(".$datas_resources_cash[$j]["fuente"] . " / " . $datas_resources_cash[$j]["tipo"] . ") - " . $datas_resources_cash[$j]["valorizacion"]);
									$resourcesText .= "<br><br>";
								}
								echo $resourcesText == "" ? "No":$resourcesText;
							?>
						</td> -->
						<td><?php echo $datas[$i]['estado'];?></td>

						<?php
							$inviResult = calculateInviByInitiativePlan($datas[$i]['id']);
						?>
						<td><?php echo $inviResult["invi"]["total"];?></td>
						<td><?php echo $inviResult["mecanismo"]["etiqueta"];?></td>
						<td><?php echo $inviResult["mecanismo"]["valor"];?></td>
						<td><?php echo $inviResult["cobertura"]["etiqueta"];?></td>
						<td><?php echo $inviResult["cobertura"]["valor"];?></td>
						<td><?php echo $inviResult["frecuencia"]["etiqueta"];?></td>
						<td><?php echo $inviResult["frecuencia"]["valor"];?></td>
						<td><?php echo $inviResult["resultados"]["etiqueta"];?></td>
						<td><?php echo $inviResult["resultados"]["valor"];?></td>
						<td><?php echo $inviResult["evaluacionInterna"]["etiqueta"];?></td>
						<td><?php echo $inviResult["evaluacionInterna"]["valor"];?></td>
						<td><?php echo $inviResult["evaluacionExterna"]["etiqueta"];?></td>
						<td><?php echo $inviResult["evaluacionExterna"]["valor"];?></td>
						<td><?php echo $inviResult["evaluacion"]["valor"];?></td>

						<?php
						 	$myObjetives = getODSByInitiativePlan($datas[$i]['id']);
						?>
						<td>
							<?php
							 	$objetivesText = "";
								for($j=0 ; $j<sizeof($myObjetives) ; $j++) {
									$objetivesText .= ($myObjetives[$j]["id"] . ". " . $myObjetives[$j]["nombre"]);
									if($j<(sizeof($myObjetives)-1))
										$objetivesText .= "<br><br>";
								}
								echo $objetivesText == "" ? "":$objetivesText;
							?>
						</td>
          </tr>
 			<?php
 				} ?>

  	</tbody>
	</table>
</div>
<!-- /.box-body -->
