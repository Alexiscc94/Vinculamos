<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}
	include_once("../../utils/user_utils.php");
	$institution = getInstitution();

	$unit = $_POST["unit"];
	$campus = $_POST["campus"];
	$program = $_POST["program"];
	$mechanism = $_POST["mechanism"];
	$department = $_POST["department"];
	$frecuency = $_POST["frecuency"];
	$implementationFormat = $_POST["implementationFormat"];
	$environment = $_POST["environment"];
	$country = $_POST["country"];
	$region = $_POST["vg_region"];
	$commune = $_POST["vg_comuna"];
	$objetivo = $_POST["objetivo"];
	$covenant = $_POST["covenant"];

	$executionStatus = $_POST["executionStatus"];
	$fillmentStatus = $_POST["fillmentStatus"];

	if(false) {
		echo "<br> unit: " . $_POST["unit"];
		echo "<br> campus: " . $_POST["campus"];
		echo "<br> program: " . $_POST["program"];
		echo "<br> mechanism: " . $_POST["mechanism"];
		echo "<br> department: " . $_POST["department"];
		echo "<br> frecuency: " . $_POST["frecuency"];
		echo "<br> implementationFormat: " . $_POST["implementationFormat"];
		echo "<br> environment: " . $_POST["environment"];
		echo "<br> country: " . $_POST["country"];
		echo "<br> region: " . $_POST["region"];
		echo "<br> commune: " . $_POST["commune"];
		echo "<br> objetivo: " . $_POST["objetivo"];
		echo "<br> covenant: " . $_POST["covenant"];
		//return;
	}


	include_once("../../controller/medoo_initiatives_plan.php");
	$datasRaw = findInitiativesByFilters($institution, $unit, $campus,
		$environment, $mechanism, $program, $covenant, $country, $region, $commune,
		$department, $implementationFormat, $frecuency, $executionStatus, $fillmentStatus);

	//include_once("../../controller/medoo_initiatives_ods.php");
	$datas = array();
	for ($i=0; $i < sizeof($datasRaw); $i++) {
		//$myObjetives = getVisibleObjetivesByInitiative($datasRaw[$i]["id"]);
		if(!in_array($datasRaw[$i], $datas)) {
			$datas[] = $datasRaw[$i];
		}
	}


	//include_once("../../controller/medoo_colleges.php");
	//include_once("../../controller/medoo_programs.php");
	include_once("../../controller/medoo_invi_v2.php");

	$sumatoriaInvi = 0;
	$promedioInvi = 0;

	$textIds = "";
	for ($i=0; $i < sizeof($datas); $i++) {
		/* INICIO IDS */
		$textIds .= $datas[$i]['id'];
		if($i < sizeof($datas)-1) {
			$textIds .= ", ";
		}
		/* FIN IDS */

		$inviScore = calculateInviByInitiativePlan($datas[$i]['id']);
		$datas[$i]['invi'] = $inviScore;
		$sumatoriaInvi += $inviScore["invi"]["total"];
	}
	$promedioInvi = round($sumatoriaInvi / sizeof($datas));

	include_once("../../controller/medoo_initiatives_plan_ods.php");
	$myODS = getODSByInitiativeGroup($textIds);

	include_once("../../controller/medoo_objetives.php");
	$objetives = getVisibleObjetivesSimple();
	for ($i=0; $i < sizeof($objetives); $i++) {
		$found = false;
		for ($j=0; $j < sizeof($myODS); $j++) {
			if($objetives[$i]["id"] == $myODS[$j]["id"]) {
				$found = true;
			}
		}

		if($found == true) {
			$objetives[$i]["encontrado"] = true;
		} else {
			$objetives[$i]["encontrado"] = false;
		}
	}

	//echo "<br>textIds: " . $textIds;

	include_once("../../controller/medoo_campus.php");
	$campusSummary = countSummaryVisibleCampusByInitiativeGroup($textIds);
	/* GRAFICO SEDES */
	$etiquetasSedes = "";
	$cantidadesSedes = "";
	for ($i=0; $i < sizeof($campusSummary); $i++) {
		$etiquetasSedes .= ("'" . $campusSummary[$i]["nombre"] . "'");
		$cantidadesSedes .= ("'" . $campusSummary[$i]["iniciativas"] . "'");
		if($i < sizeof($campusSummary)-1) {
			$etiquetasSedes .= ", ";
			$cantidadesSedes .= ", ";
		}
	}
	echo "
		<script>
			var etiquetasSedes = [" . $etiquetasSedes . "];
			var cantidadesSedes = [" . $cantidadesSedes . "];
		</script>
	";

	$etiquetasODS = "";
	$cantidadesODS = "";
	for ($i=0; $i < sizeof($myODS); $i++) {
		$etiquetasODS .= ("'ODS " . $myODS[$i]["id"] . "'");
		$cantidadesODS .= ("'" . $myODS[$i]["iniciativas"] . "'");
		if($i < sizeof($myODS)-1) {
			$etiquetasODS .= ", ";
			$cantidadesODS .= ", ";
		}
	}

	echo "
		<script>
			var etiquetasODS = [" . $etiquetasODS . "];
			var cantidadesODS = [" . $cantidadesODS . "];
		</script>
	";

	include_once("../../controller/medoo_programs.php");
	$programsSummary = countSummaryVisibleProgramsByInitiativeGroup($textIds);
	/* GRAFICO PROGRAMAS */
	$etiquetasProgramas = "";
	$cantidadesProgramas = "";
	for ($i=0; $i < sizeof($programsSummary); $i++) {
		$etiquetasProgramas .= ("'" . $programsSummary[$i]["nombre"] . "'");
		$cantidadesProgramas .= ("'" . $programsSummary[$i]["iniciativas"] . "'");
		if($i < sizeof($programsSummary)-1) {
			$etiquetasProgramas .= ", ";
			$cantidadesProgramas .= ", ";
		}
	}
	echo "
		<script>
			var etiquetasProgramas = [" . $etiquetasProgramas . "];
			var cantidadesProgramas = [" . $cantidadesProgramas . "];
		</script>
	";

	include_once("../../controller/medoo_units.php");
	$collegesSummary = countSummaryVisibleUnitsByInitiativeGroup($textIds);
	/* GRAFICO PROGRAMAS */
	$etiquetasEscuelas = "";
	$cantidadesEscuelas = "";
	for ($i=0; $i < sizeof($collegesSummary); $i++) {
		$etiquetasEscuelas .= ("'" . $collegesSummary[$i]["nombre"] . "'");
		$cantidadesEscuelas .= ("'" . $collegesSummary[$i]["iniciativas"] . "'");
		if($i < sizeof($collegesSummary)-1) {
			$etiquetasEscuelas .= ", ";
			$cantidadesEscuelas .= ", ";
		}
	}
	echo "
		<script>
			var etiquetasEscuelas = [" . $etiquetasEscuelas . "];
			var cantidadesEscuelas = [" . $cantidadesEscuelas . "];
		</script>
	";

	include_once("../../controller/medoo_environment.php");
	$envitonmentsSummary = countSummaryVisibleEnvironmentsByInitiativeGroup($textIds);
	/* GRAFICO GRUPOS DE INTERÉS */
	$etiquetasEntornos = "";
	$cantidadesEntornos = "";
	for ($i=0; $i < sizeof($envitonmentsSummary); $i++) {
		$etiquetasEntornos .= ("'" . $envitonmentsSummary[$i]["nombre"] . "'");
		$cantidadesEntornos .= ("'" . $envitonmentsSummary[$i]["iniciativas"] . "'");
		if($i < sizeof($envitonmentsSummary)-1) {
			$etiquetasEntornos .= ", ";
			$cantidadesEntornos .= ", ";
		}
	}
	echo "
		<script>
			var etiquetasEntornos = [" . $etiquetasEntornos . "];
			var cantidadesEntornos = [" . $cantidadesEntornos . "];
		</script>
	";

	include_once("../../controller/medoo_geographic.php");
	$regionsSummary = countSummaryVisibleRegionsByInitiativeGroup($textIds);
	/* GRAFICO REGIONES */
	$etiquetasRegiones = "";
	$cantidadesRegiones = "";
	for ($i=0; $i < sizeof($regionsSummary); $i++) {
		$etiquetasRegiones .= ("'" . str_replace("'", "", $regionsSummary[$i]["nombre"]) . "'");
		$cantidadesRegiones .= ("'" . $regionsSummary[$i]["iniciativas"] . "'");
		if($i < sizeof($regionsSummary)-1) {
			$etiquetasRegiones .= ", ";
			$cantidadesRegiones .= ", ";
		}
	}
	echo "
		<script>
			var etiquetasRegiones = [" . $etiquetasRegiones . "];
			var cantidadesRegiones = [" . $cantidadesRegiones . "];
		</script>
	";

	$communesSummary = countSummaryVisibleCommunesByInitiativeGroup($textIds);

?>

<div class="box-body" id="toExcel" name="toExcel">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-4">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-briefcase"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Iniciativas</span>
					<span class="info-box-number lead"><?php echo sizeof($datas); ?></span>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 col-xs-4">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-dashboard"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">INVI</span>
					<span class="info-box-number"><?php echo $promedioInvi; ?></span>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 col-xs-4">
			<div class="info-box">
				<span class="info-box-icon bg-white"><img src="../../img/ods-circulo_sf.png" alt="User Image" width="50"></span>

				<div class="info-box-content">
					<span class="info-box-text">ODS</span>
					<span class="info-box-number"><?php echo sizeof($myODS); ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#subtab_1Repor1" data-toggle="tab">Resumen</a></li>
					<li><a href="#subtab_2Repor1" data-toggle="tab">Detalle (resumen)</a></li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane active" id="subtab_1Repor1">
					<div class="col-md-12">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<h4>Sede</h3>
								<canvas id="graficoBarraSedes" height="400"></canvas>
							</div>
							<div class="col-lg-6 col-md-6">
								<h4>ODS</h3>

								<?php
								for ($i=0; $i < sizeof($objetives); $i++) {
									if($objetives[$i]["encontrado"] == true) {
										$imagen = "../../img/ods-" . $objetives[$i]["id"] . ".png";
									} else {
										$imagen = "../../img/ods-" . $objetives[$i]["id"] . "-dis.png";
									}

									//$url = "view_objetive.php?data=" . $objetives = noeliaEncode("data" . $objetives[$i]["id"]);
									?>
									<div class="col-md-2 col-xs-4" style="padding: 0 !important; margin: 0 !important;">
										<a href="<?php echo$url?>">
											<img id="viga_logo" class="img-responsive" src="<?php echo$imagen?>" alt="User profile picture" width="100%">
										</a>
									</div>
									<?php
								}
								?>

								<div class="col-md-2 col-xs-4" style="padding: 0 !important; margin: 0 !important;">
									<img id="viga_logo" class="img-responsive" src="../../img/ods-0.jpg" alt="User profile picture" width="100%">
								</div>

								<canvas id="graficoBarraODS" height="250"></canvas>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12">
								<h4>Programas</h3>
								<canvas id="graficoBarraProgramas" height="90"></canvas>
							</div>
							<div class="col-lg-12 col-md-12">
								<h4>Escuelas</h3>
								<canvas id="graficoBarraEscuelas" height="90"></canvas>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12">
								<h4>Grupos de interés</h3>
								<canvas id="graficoBarraEntornos" height="90"></canvas>
							</div>
							<div class="col-lg-12 col-md-12">
								<h4>Regiones</h3>
								<canvas id="graficoBarraRegiones" height="110"></canvas>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-12">
								<?php
									$topSizeRegion = 0;
									if(sizeof($regionsSummary) > 5) {
										$topSizeRegion = 5;
									} else {
										$topSizeRegion = sizeof($regionsSummary);
									}
								?>
								<h4>Regiones (top <?php echo $topSizeRegion;?>)</h3>
								<table id="tableComunas" class="table table-bordered table-hover text-center">
					      	<thead>
					        	<tr>
											<th>Región</th>
											<th>Cantidad de iniciativas</th>
											<th>Porcentaje</th>
										</tr>
									</thead>
					       	<tbody>
					       		<?php
											for($i=0 ; $i<$topSizeRegion ; $i++) { ?>
					       				<tr>
													<td><?php echo $regionsSummary[$i]['nombre'];?></td>
								      		<td><?php echo $regionsSummary[$i]['iniciativas'];?></td>
													<td>
														<?php
														 	$porcentajeRegion = round(($regionsSummary[$i]['iniciativas'] / sizeof($datas)) * 100, 0);
														?>
														<input type='text' class='knob' data-skin="tron" data-readonly='true' value='<?php echo$porcentajeRegion?>' data-fgColor='#F1943D' data-width='65' data-height='65'>
													</td>
												<tr>
										<?php
											} ?>
									</tbody>
								</table>
							</div>

							<div class="col-lg-6 col-md-12">
								<h4>Comunas (top <?php echo sizeof($communesSummary);?>)</h3>
								<table id="tableComunas" class="table table-bordered table-hover text-center">
					      	<thead>
					        	<tr>
											<th>Comuna</th>
											<th>Cantidad de iniciativas</th>
											<th>Porcentaje</th>
										</tr>
									</thead>
					       	<tbody>
					       		<?php
					       			for($i=0 ; $i<sizeof($communesSummary) ; $i++) { ?>
					       				<tr>
													<td><?php echo $communesSummary[$i]['nombre'];?></td>
								      		<td><?php echo $communesSummary[$i]['iniciativas'];?></td>
													<td>
														<?php
														 	$porcentajeComuna = round(($communesSummary[$i]['iniciativas'] / sizeof($datas)) * 100, 0);
														?>
														<input type='text' class='knob' data-skin="tron" data-readonly='true' value='<?php echo$porcentajeComuna?>' data-fgColor='#F1943D' data-width='65' data-height='65'>
													</td>
												<tr>
										<?php
											} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>


				</div>

				<div class="tab-pane" id="subtab_2Repor1">
					<div class="col-md-12">
						<div class="row">
							<div class="box-body table-responsive">
					    	<table id="table" class="table table-bordered table-hover">
					        	<thead>
					                <tr>
					                	<th>ID</th>
														<th>Nombre</th>
														<th>Responsable</th>
														<?php
														 	if(canSuperviseStats()) { ?>
																<th>INVI</th>
														<?php
															} ?>
														<th style="width:110px">Acciones</th>
													</tr>
					            </thead>
					       		<tbody>
					       			<?php
					       				for($i=0 ; $i<sizeof($datas) ; $i++) { ?>
					       					<tr>
														<td><?php echo $datas[$i]['id'];?></td>
								      			<td><?php echo $datas[$i]['nombre'];?></td>
														<td>
															<?php echo $datas[$i]['responsable'];?>
														</td>
														<?php
														 	if(canSuperviseStats()) { ?>
															<td>
																<?php
																 	$inviScore = $datas[$i]['invi'];
																	echo $inviScore["invi"]["total"];
																?>
															</td>
														<?php } ?>
														<td>
															<?php
																$data = noeliaEncode("data" . $datas[$i]['id']);
								      					if(canUpdateInitiatives()) {
								      						$data = noeliaEncode("data" . $datas[$i]['id']); ?>
																	<div class="btn-group">
																		<button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown" title='Opciones'>
																			<i class="glyphicon glyphicon-triangle-bottom"></i>
																		</button>
																		<ul class="dropdown-menu">
																			<li>
																				<a href="../initiatives/add_attendance_list.php?data=<?php echo$data;?>" title='Lista asistencia'>
																					Agregar lista asistencia
																				</a>
																			</li>
																			<li>
																				<a href="../initiatives/add_evaluation.php?data=<?php echo$data;?>" title='Evaluaciones'>
																					<i class="fa fa-file-text-o"></i> Evaluación
																				</a>
																			</li>
																			<!--li>
																				<a href="../initiatives/add_surveys.php?data=<?php echo$data;?>" title='Encuestas'>
																					Encuestas
																				</a>
																			</li-->
																			<!-- <?php
																			 	if(canSuperviseInitiatives()) { ?>
																					<li>
																						<a data-toggle="modal" data-target="#editStatusExecution"
																							data-id_iniciativa='?php echo noeliaEncode($datas[$i]['id']);?>'
																							data-estado_ejecucion ='<php echo $datas[$i]['estado_ejecucion']?>'
																							title='Estado Ejecución'>
																							Actualizar ejecución
																						</a>
																					</li>

																					<li>
																						<a data-toggle="modal" data-target="#editStatusFillment"
																							data-id_iniciativa='?php echo noeliaEncode($datas[$i]['id']);?>'
																							data-estado_completitud ='?php echo $datas[$i]['estado_completitud']?>'
																							title='Estado Completitud'>
																							Actualizar completitud
																						</a>
																					</li> -->
																			<?php 
																				} ?>
																		</ul>
																	</div>
															<?php
																} ?>

								      				<?php
								      					if(canReadInitiatives()) {
								      						$data = noeliaEncode("data" . $datas[$i]['id']); ?>
																	<a href="../initiatives/review_initiative.php?data=<?php echo$data;?>" class='btn btn-orange' title='Ver iniciativa'>
																		<i class="glyphicon glyphicon-eye-open"></i>
																	</a>

																	<a class="btn btn-orange" valign="right" data-toggle="modal" title='Calcular INVI'
																		data-iniciativa='<?php echo noeliaEncode($datas[$i]['id']);?>'
																		data-usuario='<?php echo ($_SESSION["nombre_usuario"]);?>'
																		data-target="#calculateScoreVCM">
																			<i class="fa fa-tachometer"></i>
																	</a>
															<?php
																} ?>

															<?php
								      					if(canUpdateInitiatives()) { ?>

																	<a href="../initiatives/edit_initiative_step1.php?data=<?php echo$data;?>" class='btn btn-orange' title='Editar iniciativa'>
																		<i class="glyphicon glyphicon-edit"></i>
																	</a>
																	<!--a href="add_attendance_list.php?data=<?php echo$data;?>" class='btn btn-orange' title='Lista asistencia'>
																		<i class="glyphicon glyphicon-list"></i>
																	</a>
																	<a href="add_survey.php?data=<?php echo$data;?>" class='btn btn-orange' title='Agregar encuesta'>
																		<i class="glyphicon glyphicon-list-alt"></i>
																	</a-->
																	<a href="../initiatives/edit_initiative_evidences.php?data=<?php echo$data;?>" class='btn btn-orange' title='Cargar evidencia'>
																		<i class="glyphicon glyphicon-paperclip"></i>
																	</a>
															<?php
																} ?>

															<?php
								      					switch ($datas[$i]['estado']) {
								      						case 'Aprobado':
								      							echo "<i class='text-green fa fa-check'></i>";
								      							break;
																	case 'Rechazado':
								      							echo "<i class='text-red fa fa-close'></i>";
								      							break;
																}
															?>

															<?php
																$idEjecucion = ("ejecucion" . $datas[$i]['id']);
																echo "<small class='label label-primary' id='$idEjecucion'>" . $datas[$i]['estado_ejecucion'] . "</small> &nbsp;";

																$idCompletitud = ("completitud" . $datas[$i]['id']);
																echo "<small class='label label-info' id='$idCompletitud'>" . $datas[$i]['estado_completitud'] . "</small> &nbsp;";

															?>
								      			</td>

					            		</tr>
					       			<?php
					       				} ?>

					            </tbody>
					        </table>
					    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
