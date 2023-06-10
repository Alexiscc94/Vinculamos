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

	include_once("../include/header.php");

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

			<div class="tab-content">
				<div class="tab-pane active" id="subtab_1Repor1">
					<div class="col-md-12">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-12">
								<h4>Sede</h3>
								<canvas id="graficoBarraSedes" height="200"></canvas>
							</div>
							<div class="col-lg-12 col-md-12 col-xs-12">
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
									<div class="col-md-2 col-xs-2" style="padding: 0 !important; margin: 0 !important;">
										<a href="<?php echo$url?>">
											<img id="viga_logo" class="img-responsive" src="<?php echo$imagen?>" width="100%">
										</a>
									</div>
									<?php
								}
								?>

								<div class="col-md-2 col-xs-2" style="padding: 0 !important; margin: 0 !important;">
									<img id="viga_logo" class="img-responsive" src="../../img/ods-0.jpg" alt="User profile picture" width="100%">
								</div>

								<div class="col-lg-6 col-md-6 col-xs-6">
									<canvas id="graficoBarraODS" height="250"></canvas>
								</div>



							</div>
						</div>

						<div class="row">
							<div class="col-lg-10 col-md-10 col-xs-6">
								<h4>Programas</h3>
								<canvas id="graficoBarraProgramas" height="100"></canvas>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 col-md-10 col-xs-6">
								<h4>Unidades Organizacionales</h3>
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


			</div>
		</div>
	</div>
</div>

<?php
 	include_once("../include/footer.php")
	?>

	<script src="../../../template/bower_components/chart.js/Chart.js"></script>
	<script src="../../../template/bower_components/jquery-knob/js/jquery.knob.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

	<script>
		$(document).ready(function(){
			//$('#filter_initiative').get(0).reset(); //clear form data on page load
			loadInitiativesByFilters();
		});

		function loadInitiativesByFilters() {
			$('#table').DataTable({
				'language': {
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
				},
				'paging'      : true,
				'lengthChange': true,
				'searching'   : true,
				'ordering'    : false,
				'info'        : true,
				'autoWidth'   : true
			})

			/* GRAFICO BARRA SEDES */
			var barChartDataSedes = {
				labels: etiquetasSedes,
				datasets: [{
					label: 'Número de iniciativas',
					backgroundColor: '#4F71BE',
					data: cantidadesSedes
				}]
			};

			var graficoBarraSedes = document.getElementById("graficoBarraSedes");
			var myChart1 = new Chart(graficoBarraSedes, {
				type: 'horizontalBar',
				data: barChartDataSedes,
				options: {
					title: {
						display: true,
						text: "Número de iniciativas"
					},
					tooltips: {
						mode: 'index',
						intersect: true,
						footerFontStyle: 'normal'
					},
					legend: {
						display: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: false,
							ticks: {
								beginAtZero: true,
								precision: 0,
								userCallback: function(label, index, labels) {
									// when the floored value is the same as the value we have a whole number
									if (Math.floor(label) === label) {
										return label;
									}
								},
							},
							scaleLabel: {
								display: true,
								labelString: "Sedes",
								fontStyle: "bold"
								}
						}],
						yAxes: [{
							stacked: false,
							ticks: {
								min: 0
							},
							position: 'top',
							scaleLabel: {
								display: false,
								labelString: "Nº de iniciativas",
								fontStyle: "bold"
								}
						}]
					},
					scaleShowGridlines: true
				}
			});

			/* GRAFICO BARRA ODS */
			var barChartDataODS = {
				labels: etiquetasODS,
				datasets: [{
					label: 'Número de iniciativas',
					backgroundColor: '#F1943D',
					data: cantidadesODS
				}]
			};

			var graficoBarraODS = document.getElementById("graficoBarraODS");
			var myChart1 = new Chart(graficoBarraODS, {
				type: 'horizontalBar',
				data: barChartDataODS,
				options: {
					title: {
						display: true,
						text: "Número de iniciativas"
					},
					tooltips: {
						mode: 'index',
						intersect: true,
						footerFontStyle: 'normal'
					},
					legend: {
						display: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: false,
							ticks: {
								beginAtZero: true,
								precision: 0,
								userCallback: function(label, index, labels) {
									// when the floored value is the same as the value we have a whole number
									if (Math.floor(label) === label) {
										return label;
									}
								},
							},
							scaleLabel: {
								display: true,
								labelString: "Objetivos de desarrollo (principales)",
								fontStyle: "bold"
								}
						}],
						yAxes: [{
							stacked: false,
							ticks: {
								beginAtZero: true
							},
							position: 'top',
							scaleLabel: {
								display: false,
								labelString: "Nº de iniciativas",
								fontStyle: "bold"
								}
						}]
					},
					scaleShowGridlines: true
				}
			});

			/* GRAFICO BARRA PROGRAMAS */
			var coloresGraficos= [
				'#F1943D', '#BF703B', '#00a65a', '#B78C3C', '#BAB135', '#AD9B80', '#89G91D'
			];

			var graficoBarraProgramas = document.getElementById("graficoBarraProgramas");
			var myChart1 = new Chart(graficoBarraProgramas, {
					type: 'pie',
					data: {
						labels: etiquetasProgramas,
						datasets: [{
							label: '# de medidas',
							data: cantidadesProgramas,
							backgroundColor: coloresGraficos,
							borderColor: coloresGraficos,
							borderWidth: 1
						}]
					},
					options: {
						title: {
							display: true,
							text: "Programas"
						},
						legend: {
							display: true,
							position: 'top',
							maxWidth: 10
						}
					}
			});

			/* GRAFICO BARRA ESCUELAS */
			var barChartDataEscuelas = {
				labels: etiquetasEscuelas,
				datasets: [{
					label: 'Número de iniciativas',
					backgroundColor: '#4F71BE',
					data: cantidadesEscuelas
				}]
			};

			var graficoBarraEscuelas = document.getElementById("graficoBarraEscuelas");
			var myChart1 = new Chart(graficoBarraEscuelas, {
				type: 'horizontalBar',
				data: barChartDataEscuelas,
				options: {
					title: {
						display: true,
						text: "Número de iniciativas"
					},
					tooltips: {
						mode: 'index',
						intersect: true,
						footerFontStyle: 'normal'
					},
					legend: {
						display: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: false,
							ticks: {
								beginAtZero: true,
								precision: 0,
								userCallback: function(label, index, labels) {
									// when the floored value is the same as the value we have a whole number
									if (Math.floor(label) === label) {
										return label;
									}
								},
							},
							scaleLabel: {
								display: true,
								labelString: "Unidades organizacionales",
								fontStyle: "bold"
								}
						}],
						yAxes: [{
							stacked: false,
							ticks: {
								min: 0
							},
							position: 'top',
							scaleLabel: {
								display: false,
								labelString: "Nº de iniciativas",
								fontStyle: "bold"
								}
						}]
					},
					scaleShowGridlines: true
				}
			});

			/* GRAFICO BARRA ENTORNOS */
			var barChartDataEntornos = {
				labels: etiquetasEntornos,
				datasets: [{
					label: 'Número de iniciativas',
					backgroundColor: '#4F71BE',
					backgroundColor: coloresGraficos,
					data: cantidadesEntornos
				}]
			};

			var graficoBarraEntornos = document.getElementById("graficoBarraEntornos");
			var myChart1 = new Chart(graficoBarraEntornos, {
				type: 'horizontalBar',
				data: barChartDataEntornos,
				options: {
					title: {
						display: true,
						text: "Número de iniciativas"
					},
					tooltips: {
						mode: 'index',
						intersect: true,
						footerFontStyle: 'normal'
					},
					legend: {
						display: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: false,
							ticks: {
								beginAtZero: true,
								precision: 0,
								userCallback: function(label, index, labels) {
									// when the floored value is the same as the value we have a whole number
									if (Math.floor(label) === label) {
										return label;
									}
								},
							},
							scaleLabel: {
								display: true,
								labelString: "Grupos de interés",
								fontStyle: "bold"
								}
						}],
						yAxes: [{
							stacked: false,
							ticks: {
								min: 0
							},
							position: 'top',
							scaleLabel: {
								display: false,
								labelString: "Nº de iniciativas",
								fontStyle: "bold"
								}
						}]
					},
					scaleShowGridlines: true
				}
			});

			/* GRAFICO BARRA REGIONES */
			var barChartDataRegiones = {
				labels: etiquetasRegiones,
				datasets: [{
					label: 'Número de iniciativas',
					backgroundColor: '#4F71BE',
					data: cantidadesRegiones
				}]
			};

			var graficoBarraRegiones = document.getElementById("graficoBarraRegiones");
			var myChart1 = new Chart(graficoBarraRegiones, {
				type: 'horizontalBar',
				data: barChartDataRegiones,
				options: {
					title: {
						display: true,
						text: "Número de iniciativas"
					},
					tooltips: {
						mode: 'index',
						intersect: true,
						footerFontStyle: 'normal'
					},
					legend: {
						display: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: false,
							ticks: {
								beginAtZero: true,
								precision: 0,
								userCallback: function(label, index, labels) {
									// when the floored value is the same as the value we have a whole number
									if (Math.floor(label) === label) {
										return label;
									}
								},
							},
							scaleLabel: {
								display: true,
								labelString: "Regiones",
								fontStyle: "bold"
								}
						}],
						yAxes: [{
							stacked: false,
							ticks: {
								min: 0
							},
							position: 'top',
							scaleLabel: {
								display: false,
								labelString: "Nº de iniciativas",
								fontStyle: "bold"
								}
						}]
					},
					scaleShowGridlines: true
				}
			});

			$(".knob").knob();
		}
	</script>
