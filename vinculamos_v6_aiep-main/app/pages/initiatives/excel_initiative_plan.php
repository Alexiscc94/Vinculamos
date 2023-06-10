<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
	}

	$nombre_usuario = $_SESSION["nombre_usuario"];

	include_once("../../utils/user_utils.php");
	$institution = getInstitution();

	$id = str_replace("data", "", noeliaDecode($_GET["data"]));

	include_once("../../controller/medoo_initiatives_plan.php");
	$datas = getInitiativePlan($id);

	$dia= $id . " " . date('d-m-Y');
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: attachment; filename=iniciativa_$id.xls");
	header('Pragma: public');
	header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
	header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
	header('Pragma: no-cache');
	header('Expires: 0');
	header('Content-Transfer-Encoding: none');
	//header('Content-type: application/vnd.ms-excel;charset=utf-8');// This should work for IE & Opera
	header('Content-type: application/x-msexcel; charset=utf-8'); // This should work for the rest
	header("Content-Disposition: attachment; filename=iniciativa_$id.xls");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
?>

<!DOCTYPE html>
<html>
<?php //include_once("../include/header.php")?>

<body onload="window.print();">
<div>
  <!-- Content Wrapper. Contains page content -->
	<div>

		<!-- Main content -->
		<section class="invoice">
  		<!-- title row -->
  		<div class="row">
    		<div class="col-xs-12">
    			<h2 class="page-header">
      			<?php echo $datas[0]["nombre"]?>
      		</h2>
    		</div>
    		<!-- /.col -->
  		</div>

  		<!-- Table row -->
			<div class="row">
  			<div class="col-xs-12 table-responsive">
  				<table class="table table-condensed">
						<tr class="filaColor">
      				<td><b>Nombre de la iniciativa:</b></td>
      				<td><?php echo $datas[0]["nombre"]?></td>
      			</tr>

  					<tr>
      				<td style="width:250px"><b>Año de ejecución:</b></td>
      				<td>
								<?php
									$thisDate = new DateTime($datas[0]["fecha_inicio"]);
									echo $thisDate->format('Y');
								?>
							</td>
      			</tr>

						<?php
							include_once("../../controller/medoo_units.php");
							$myUnits = getUnitsByInitiativePlan($datas[0]['id']);
						?>
						<tr>
      				<td><b>Escuela</b></td>
							<?php
								$unitsText = "";
								for($j=0 ; $j<sizeof($myUnits) ; $j++) {
									$unitsText .= $myUnits[$j]["nombre"];
									if($j<(sizeof($myUnits)-1))
										$unitsText .= ", ";
								}
							?>
							<td><?php echo $unitsText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_units_subs.php");
							$mySubUnits = getUnitsSubByInitiativePlan($datas[0]['id']);
						?>
						<tr class="filaColor">
      				<td><b>Sub Unidad</b></td>
							<?php
								$subUnitsText = "";
								for($j=0 ; $j<sizeof($mySubUnits) ; $j++) {
									$subUnitsText .= $mySubUnits[$j]["nombre"];
									if($j<(sizeof($mySubUnits)-1))
										$subUnitsText .= ", ";
								}
							?>
							<td><?php echo $subUnitsText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_campus.php");
							$myCampus = getCampusByInitiativePlan($datas[0]['id']);
						?>
						<tr>
      				<td><b>Sede</b></td>
							<?php
								$campusText = "";
								for($j=0 ; $j<sizeof($myCampus) ; $j++) {
									$campusText .= $myCampus[$j]["nombre"];
									if($j<(sizeof($myCampus)-1))
										$campusText .= ", ";
								}
							?>
							<td><?php echo $campusText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_departments.php");
							$myDepartments = getDepartmentsByInitiativePlan($datas[0]['id']);
						?>
						<tr class="filaColor">
      				<td><b>Área</b></td>
							<?php
								$depsText = "";
								for($j=0 ; $j<sizeof($myDepartments) ; $j++) {
									$depsText .= $myDepartments[$j]["nombre"];
									if($j<(sizeof($myDepartments)-1))
										$depsText .= ", ";
								}
							?>
							<td><?php echo $depsText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_carrers.php");
							$myCarrers = getCarrersByInitiativePlan($datas[0]['id']);
						?>
						<tr>
      				<td><b>Carrera</b></td>
							<?php
								$carrerText = "";
								for($j=0 ; $j<sizeof($myCarrers) ; $j++) {
									$carrerText .= $myCarrers[$j]["nombre"];
									if($j<(sizeof($myCarrers)-1))
										$carrerText .= ", ";
								}
							?>
							<td><?php echo $carrerText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_programs.php");
							$myPrograms = getProgramsByInitiativePlan($datas[0]['id']);
						?>
						<tr class="filaColor">
      				<td><b>Programa</b></td>
							<?php
								$programText = "";
								for($j=0 ; $j<sizeof($myPrograms) ; $j++) {
									$programText .= $myPrograms[$j]["nombre"];
									if($j<(sizeof($myPrograms)-1))
										$programText .= ", ";
								}
							?>
							<td><?php echo $programText;?></td>
      			</tr>

						<?php
							$myProgramsSecondary = getProgramsSecundaryByInitiativePlan($datas[0]["id"]);
						?>
						<tr>
      				<td><b>Programa relacionado</b></td>
							<?php
								$programSecondaryText = "";
								for($j=0 ; $j<sizeof($myProgramsSecondary) ; $j++) {
									$programSecondaryText .= $myProgramsSecondary[$j]["nombre"];
									if($j<(sizeof($myProgramsSecondary)-1))
										$programSecondaryText .= ", ";
								}
							?>
							<td><?php echo $programSecondaryText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_covenants.php");
							$myCovenants = getCovenantsByInitiativePlan($datas[0]['id']);
						?>
						<tr class="filaColor">
      				<td><b>Convenios</b></td>
							<?php
								$covenantText = "";
								for($j=0 ; $j<sizeof($myCovenants) ; $j++) {
									$covenantText .= $myCovenants[$j]["nombre"];
									if($j<(sizeof($myCovenants)-1))
										$covenantText .= ", ";
								}
							?>
							<td><?php echo $covenantText;?></td>
      			</tr>

						<tr>
      				<td><b>Formato de implementación</b></td>
							<td><?php echo $datas[0]["formato_implementacion"]?></td>
      			</tr>

						<tr class="filaColor">
      				<td><b>Nombre encargado responsable</b></td>
							<td><?php echo $datas[0]["responsable"]?></td>
      			</tr>

						<tr>
      				<td><b>Cargo encargado responsable</b></td>
							<td><?php echo $datas[0]["responsable_cargo"]?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_invi_attributes.php");
							$activityMechanism = getVisibleMechanismActivityById($datas[0]["id_actividad"]);
						?>
						<tr class="filaColor">
      				<td><b>Actividad asociada</b></td>
							<td><?php echo $activityMechanism[0]["nombre"]?></td>
      			</tr>

						<?php
							$frecuencia = getFrecuency($datas[0]["id_frecuencia"]);
						?>
						<tr>
      				<td><b>Frecuencia</b></td>
							<td><?php echo $frecuencia[0]["nombre"]?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_geographic.php");
							$geoPaises = getCountriesByInitiativePlan($datas[0]["id"]);
							$geoRegiones = getRegionsByInitiativePlan($datas[0]["id"]);
							$geoComunas = getCommunesByInitiativePlan($datas[0]["id"]);
						?>
						<tr class="filaColor">
      				<td><b>País</b></td>
							<?php
								$paisText = "";
								for($j=0 ; $j<sizeof($geoPaises) ; $j++) {
									$paisText .= $geoPaises[$j]["nombre"];
									if($j<(sizeof($geoPaises)-1))
										$paisText .= ", ";
								}
							?>
							<td><?php echo $paisText;?></td>
      			</tr>
						<tr>
      				<td><b>Región</b></td>
							<?php
								$regionText = "";
								for($j=0 ; $j<sizeof($geoRegiones) ; $j++) {
									$regionText .= $geoRegiones[$j]["nombre"];
									if($j<(sizeof($geoRegiones)-1))
										$regionText .= ", ";
								}
							?>
							<td><?php echo $regionText;?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Comuna</b></td>
							<?php
								$comunaText = "";
								for($j=0 ; $j<sizeof($geoComunas) ; $j++) {
									$comunaText .= $geoComunas[$j]["nombre"];
									if($j<(sizeof($geoComunas)-1))
										$comunaText .= ", ";
								}
							?>
							<td><?php echo $comunaText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_environment.php");
							include_once("../../controller/medoo_environment_sub.php");
							include_once("../../controller/medoo_environment_environmentsub_detail.php");
							$myEnvironments = getEnvironmentsByInitiativePlanPOC($datas[0]["id"]);
							for($i=0; $i<sizeof($myEnvironments); $i++) {
								$mySubEnvironments = getEnvironmentsSubDetailByInitiativePlan($datas[0]["id"], $myEnvironments[$i]["id"]);
								for($j=0; $j<sizeof($mySubEnvironments); $j++) {
									$myTags = getEnvironmentSubDetailsByInitiativePlanEnvSub($datas[0]["id"],
										$myEnvironments[$i]["id"], $mySubEnvironments[$j]["id"]);

									$mySubEnvironments[$j]["tags"] = $myTags;
								}
								$myEnvironments[$i]["subs"] = $mySubEnvironments;
							}
						?>
						<tr>
      				<td><b>Entorno relevante</b></td>
							<?php
								$environmentText = "";
								for($i=0; $i<sizeof($myEnvironments); $i++) {
									$environmentText .= ($myEnvironments[$i]["nombre"] . " (" . $myEnvironments[$i]['descripcion'] . ")");
									if($i<(sizeof($myEnvironments)-1))
										$environmentText .= "<br>";
								}
							?>
							<td><?php echo $environmentText;?></td>
      			</tr>

						<tr class="filaColor">
      				<td><b>Sub Entorno relevante</b></td>
							<?php
							$subEnvironmentText = "";
							for($i=0 ; $i<sizeof($myEnvironments) ; $i++) {
								$mySubEnvironments = $myEnvironments[$i]["subs"];
								for($j=0 ; $j<sizeof($mySubEnvironments) ; $j++) {
									$subEnvironmentText .= ($mySubEnvironments[$j]["nombre"]);
									if($j<(sizeof($mySubEnvironments)-1))
										$subEnvironmentText .= ", ";
								}
								$subEnvironmentText .= "<br>";
							}
							?>
							<td><?php echo $subEnvironmentText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_environment_detail.php");
							$myDetails = getEnvironmentDetailsByInitiativePlan($datas[0]["id"]);
						?>
						<tr>
      				<td><b>Participantes</b></td>
							<?php
								$detailsText = "";
								for($i=0 ; $i<sizeof($myEnvironments) ; $i++) {
									$mySubEnvironments = $myEnvironments[$i]["subs"];
									for($j=0 ; $j<sizeof($mySubEnvironments) ; $j++) {
										$myTags = $mySubEnvironments[$j]["tags"];
										for($x=0 ; $x<sizeof($myTags) ; $x++) {
											$detailsText .= ($myTags[$x]["tag"]);
											if($x<(sizeof($myTags)-1))
												$detailsText .= ", ";
										}
									}

									if($i<(sizeof($myEnvironments)-1))
										$detailsText .= "<br>";
								}
							?>
							<td><?php echo $detailsText;?></td>
						</tr>

						<tr class="filaColor">
      				<td><b>Objetivo</b></td>
      				<td><?php echo $datas[0]["objetivo"]?></td>
      			</tr>

						<tr>
      				<td><b>Descripción</b></td>
      				<td><?php echo $datas[0]["descripcion"]?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_impact_internal.php");
							$myInternalImpacts = getInternalImpactByInitiativePlan($datas[0]["id"]);
						?>
						<tr class="filaColor">
							<td><b>Tipos de impacto interno</b></td>
							<?php
								$internalText = "";
								for($j=0 ; $j<sizeof($myInternalImpacts) ; $j++) {
									$internalText .= $myInternalImpacts[$j]["nombre"];
									if($j<(sizeof($myInternalImpacts)-1))
										$internalText .= ", ";
								}
							?>
							<td><?php echo $internalText;?></td>
						</tr>

						<?php
							include_once("../../controller/medoo_impact_external.php");
							$myExternalImpacts = getExternalImpactByInitiativePlan($datas[0]["id"]);
						?>
						<tr>
							<td><b>Tipos de impacto externo</b></td>
							<?php
								$externalText = "";
								for($j=0 ; $j<sizeof($myExternalImpacts) ; $j++) {
									$externalText .= $myExternalImpacts[$j]["nombre"];
									if($j<(sizeof($myExternalImpacts)-1))
										$externalText .= ", ";
								}
							?>
							<td><?php echo $externalText;?></td>
						</tr>

						<?php
							include_once("../../controller/medoo_initiatives_plan_result.php");
							$myExpectedResult = getVisibleResultsByInitiativePlan($datas[0]["id"]);
						?>
						<tr class="filaColor">
							<td><b>Resultados esperados</b></td>
							<?php
								$resultText = "";
								for($j=0 ; $j<sizeof($myExpectedResult) ; $j++) {
									$resultText .= ($myExpectedResult[$j]["cantidad"] . " - " . $myExpectedResult[$j]["resultado"]);
									if($j<(sizeof($myExpectedResult)-1))
										$resultText .= "<br>";
								}
							?>
							<td><?php echo $resultText;?></td>
						</tr>

						<?php
							include_once("../../controller/medoo_initiatives_plan_impact.php");
							$myExpectedImpacts = getVisibleImpactsByInitiativePlan($datas[0]["id"]);
						?>
						<tr>
							<td><b>Impactos esperados</b></td>
							<?php
								$impactText = "";
								for($j=0 ; $j<sizeof($myExpectedImpacts) ; $j++) {
									$impactText .= ($myExpectedImpacts[$j]["cantidad"] . " - " . $myExpectedImpacts[$j]["impacto"]);
									if($j<(sizeof($myExpectedImpacts)-1))
										$impactText .= "<br>";
								}
							?>
							<td><?php echo $impactText;?></td>
						</tr>

						<?php
							include_once("../../controller/medoo_participation_plan.php");
							$participation = getVisiblePlanParticipationByInitiative($datas[0]["id"]);

							$participationText = "";
							$totalParticipation = 0;
							$totalSexoHombres = 0;
							$totalSexoMujeres = 0;
							$totalSexoOtro = 0;

							$totalEdadNinos = 0;
							$totalEdadJovenes = 0;
							$totalEdadAdultos = 0;
							$totalEdadAdultosMayores = 0;

							$totalProcedenciaRural = 0;
							$totalProcedenciaUrbana = 0;

							$totalVulnerabilidadDiscapacidad = 0;
							$totalVulnerabilidadPobreza = 0;

							$totalNacionalidadChileno = 0;
							$totalNacionalidadExtranjero = 0;
							$totalEtniaMapuche = 0;
							$totalEtniaOtro = 0;

							for($i=0; $i<sizeof($participation); $i++) {
								if(strpos($participationText, $participation[$i]["tipo"]) == false) {
									$participationText .= $participation[$i]["tipo2"];
									if($i<(sizeof($participation)-1))
										$participationText .= ", ";
								}

								$totalParticipation += intval($participation[$i]["publico_general"]);

								if($participation[$i]["aplica_sexo"] == "on") {
									$totalSexoHombres += intval($participation[$i]["sexo_masculino"]);
									$totalSexoMujeres += intval($participation[$i]["sexo_femenino"]);
									$totalSexoOtro += intval($participation[$i]["sexo_otro"]);
								}

								if($participation[$i]["aplica_edad"] == "on") {
									$totalEdadNinos += intval($participation[$i]["edad_ninos"]);
									$totalEdadJovenes += intval($participation[$i]["edad_jovenes"]);
									$totalEdadAdultos += intval($participation[$i]["edad_adultos"]);
									$totalEdadAdultosMayores += intval($participation[$i]["edad_adultos_mayores"]);
								}

								if($participation[$i]["aplica_procedencia"] == "on") {
									$totalProcedenciaRural += intval($participation[$i]["procedencia_rural"]);
									$totalProcedenciaUrbana += intval($participation[$i]["procedencia_urbano"]);
								}

								if($participation[$i]["aplica_vulnerabilidad"] == "on") {
									$totalVulnerabilidadPueblo += intval($participation[$i]["vulnerabilidad_pueblo"]);
									$totalVulnerabilidadDiscapacidad += intval($participation[$i]["vulnerabilidad_discapacidad"]);
									$totalVulnerabilidadPobreza += intval($participation[$i]["vulnerabilidad_pobreza"]);
								}

								if($participation[$i]["aplica_nacionalidad"] == "on") {
									$totalNacionalidadChileno += intval($participation[$i]["nacionalidad_chileno"]);
									$totalNacionalidadExtranjero += intval($participation[$i]["nacionalidad_migrante"]);
								}

								if($participation[$i]["aplica_etnia"] == "on") {
									$totalEtniaMapuche += intval($participation[$i]["etnia_mapuche"]);
									$totalEtniaOtro += intval($participation[$i]["etnia_otro"]);
								}
							}
						?>
						<tr class="filaColor">
      				<td><b>Tipo de asistente</b></td>
							<td><?php echo $participationText;?></td>
      			</tr>
						<tr>
      				<td><b>Cantidad de participantes esperados</b></td>
      				<td><?php echo $totalParticipation?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de hombres</b></td>
      				<td><?php echo $totalSexoHombres?></td>
      			</tr>
						<tr>
      				<td><b>Cantidad de mujeres</b></td>
      				<td><?php echo $totalSexoMujeres?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de otra condición sexual</b></td>
      				<td><?php echo $totalSexoOtro?></td>
      			</tr>
						<tr>
      				<td><b>Cantidad de niños</b></td>
      				<td><?php echo $totalEdadNinos?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de jóvenes</b></td>
      				<td><?php echo $totalEdadJovenes?></td>
      			</tr>
						<tr>
      				<td><b>Cantidad de adultos</b></td>
      				<td><?php echo $totalEdadAdultos?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de adultos mayores</b></td>
      				<td><?php echo $totalEdadAdultosMayores?></td>
      			</tr>
						<tr>
      				<td><b>Cantidad de procedencia rural</b></td>
      				<td><?php echo $totalProcedenciaRural?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de procedencia urbana</b></td>
      				<td><?php echo $totalProcedenciaUrbana?></td>
      			</tr>
						<tr>
      				<td><b>Cantidad de personas con discapacidad</b></td>
      				<td><?php echo $totalVulnerabilidadDiscapacidad?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de personas en situación de pobreza</b></td>
      				<td><?php echo $totalVulnerabilidadPobreza?></td>
      			</tr>
						<tr>
      				<td><b>Cantidad de personas chilenas</b></td>
      				<td><?php echo $totalNacionalidadChileno?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de personas extranjeras</b></td>
      				<td><?php echo $totalNacionalidadExtranjero?></td>
      			</tr>

						<tr>
      				<td><b>Cantidad de personas con adscripción al pueblo mapuche</b></td>
      				<td><?php echo $totalEtniaMapuche?></td>
      			</tr>
						<tr class="filaColor">
      				<td><b>Cantidad de personas con adscripción a otro pueblo</b></td>
      				<td><?php echo $totalEtniaOtro?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_initiatives_plan_resources_financial.php");
							$cash = sumCashResourcesByInitiativePlan($datas[0]["id"]);
						?>
						<tr>
      				<td><b>Total recursos dinero</b></td>
      				<td><?php echo "$" . number_format($cash, '0', ',','.'); ?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_initiatives_plan_resources_building.php");
							$building = sumBuildingResourcesByInitiativePlan($datas[0]["id"]);
						?>
						<tr class="filaColor">
      				<td><b>Total recursos infraestructura y equipamiento</b></td>
      				<td><?php echo "$" . number_format($building, '0', ',','.'); ?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_initiatives_plan_resources_human.php");
							$human = sumHumanResourcesByInitiativePlan($datas[0]["id"]);
						?>
						<tr>
      				<td><b>Total recursos humanos</b></td>
      				<td><?php echo "$" . number_format($human, '0', ',','.'); ?></td>
      			</tr>

						<tr class="filaColor">
      				<td><b>Total recursos</b></td>
      				<td><?php echo "$" . number_format($cash+$building+$human, '0', ',','.'); ?></td>
      			</tr>

						<tr>
      				<td><b>Objetivos de Desarrollo Sostenible</b></td>
							<?php
								$objetivesText = "";
								for($j=0 ; $j<sizeof($myObjetives) ; $j++) {
									$objetivesText .= ($myObjetives[$j]["id"] . ". " . $myObjetives[$j]["nombre"]);
									if($j<(sizeof($myObjetives)-1))
										$objetivesText .= "<br> ";
								}
							?>
							<td><?php echo $objetivesText;?></td>
      			</tr>

						<?php
							include_once("../../controller/medoo_invi.php");
							$inviResult = calculateInviByInitiativePlan($datas[0]['id']);
						?>
						<tr class="filaColor">
      				<td><b>Índice de vinculación INVI</b></td>
							<td><?php echo $inviResult["invi"]["total"];?></td>
      			</tr>

						<tr>
      				<td><b>INVI - Mecanismo</b></td>
							<td><?php echo $inviResult["mecanismo"]["valor"];?></td>
      			</tr>

						<tr class="filaColor">
      				<td><b>INVI - Cobertura</b></td>
							<td><?php echo $inviResult["cobertura"]["valor"];?></td>
      			</tr>

						<tr>
      				<td><b>INVI - Frecuencia</b></td>
							<td><?php echo $inviResult["frecuencia"]["valor"];?></td>
      			</tr>

						<tr class="filaColor">
      				<td><b>INVI - Resultados</b></td>
							<td><?php echo $inviResult["resultados"]["valor"];?></td>
      			</tr>

						<tr>
      				<td><b>INVI - Evaluación</b></td>
							<td><?php echo $inviResult["evaluacion"]["valor"];?></td>
      			</tr>

   				</table>
   			</div>
   		</div>
		</section>
  </div>
  <!-- /.content-wrapper -->

  <?php //include_once("../include/footer.php")?>
</div>
<!-- ./wrapper -->

</body>
</html>
