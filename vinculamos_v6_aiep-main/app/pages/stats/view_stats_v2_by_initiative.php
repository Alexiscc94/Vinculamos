<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
	}

	include_once("../../utils/user_utils.php");
	if(!canReadStats()) {
		header('Location: ../../index.php');
	}

	$institucion = getInstitution();
	$refreshVal = rand();

	unset($_POST["program"]);

	include_once("../../controller/medoo_initiatives_plan.php");
	$initiatives = getVisibleInitiativesPlanByInstitution($institucion);

	include_once("../../controller/medoo_units.php");
	$units = getVisibleUnitsByInstitution($institucion);

	include_once("../../controller/medoo_campus.php");
	$campus = getVisibleCampusByInstitution($institucion);

	include_once("../../controller/medoo_programs.php");
	$programs = getVisibleProgramsByInstitution($institucion);

	include_once("../../controller/medoo_departments.php");
	$departments = getVisibleDepartmentsByInstitution($institucion);

	include_once("../../controller/medoo_invi_attributes.php");
	$mechanisms = getVisibleMechanism();
	$frecuencies = getVisibleFrecuency();

	include_once("../../controller/medoo_params.php");
	//$linkManagerTypes = getVisibleLinksManagerType();
	$implementationFormats = getVisibleImplementationFormats();
	//$executionStatus = getVisibleExecutionStatus();
	//$fillmentStatus = getVisibleFillmentStatus();

	include_once("../../controller/medoo_environment.php");
	$environments = getVisibleEnvironments();

	include_once("../../controller/medoo_geographic.php");
	$countries = getVisibleCountries();
	$regions = getVisibleRegions();
	$communes = getVisibleCommunes();

	include_once("../../controller/medoo_profiles.php");
	$profiles = getConsideratedProfilesByInstitution($institucion);

	//include_once("../../controller/medoo_covenants.php");
	//$covenants = getVisibleCovenantsByInstitution($institucion);

	//include_once("../../controller/medoo_objetives.php");
	//$objetives = getVisibleObjetives();
?>

<!DOCTYPE html>
<html>
<?php include_once("../../config/settings.php")?>
<?php include_once("../include/header.php")?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

	<?php
		$activeMenu = "stats";
		include_once("../include/menu_side.php");

		include_once("../initiatives/modal_calculate_invi.php");
		include_once("../initiatives/modal_edit_status_execution.php");
		include_once("../initiatives/modal_edit_status_fillment.php");
	?>

  	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
    	<section class="content-header">
      		<h1>
        		 Análisis según iniciativas
        		<small></small>
      		</h1>
					<ol class="breadcrumb">
        		<li><i class="fa fa-dashboard"></i> Inicio</li>
        		<li>Análisis de datos</li>
        		<li class="active">Iniciativas</li>
      		</ol>
    	</section>

    	<!-- Main content -->
    	<section class="content">
      	<div class="row">
					<div class="col-lg-3 col-md-12 col-xs-12">
						<div class="box box-default">
							<div class="box-header with-border">
							  <h3 class="box-title">Filtros</h3>
							  <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
							  <div class="row">
									<form id="filter_initiative" name="filter_initiative" method="post"
										action="ajax_view_stats_v2_by_initiative_print.php" target="_blank">
										<div class="col-lg-12 col-xs-6">
											<label for="responsible">Escuela</label>
												<select class="selectpicker form-control" id="unit[]" name="unit[]"
													title="Escuela" data-live-search="true" multiple>
													<?php
														echo "<option value='0'>No aplica para esta actividad</option>";
														foreach($units as $unit) {
															echo "<option value='" . $unit['id'] . "' >" . $unit['nombre']. "</option>";
														}
													?>
												</select>
										</div>
										<div class="col-lg-12 col-xs-6">
											<label for="unit">Sede</label>
												<select class="selectpicker form-control" id="campus[]" name="campus[]"
													title="Sede" data-live-search="true" multiple>
													<?php
														foreach($campus as $campu) {
															echo "<option value='" . $campu['id'] . "' >" . $campu['nombre']. "</option>";
														}
													?>
												</select>
										</div>
										<div class="col-lg-12 col-xs-6">
											<label for="program">Programa</label>
												<select class="selectpicker form-control" id="program[]" name="program[]"
													title="Programa" data-live-search="true" multiple>
													<?php
														foreach($programs as $program) {
															echo "<option value='" . $program['id'] . "' >" . $program['nombre']. "</option>";
														}
													?>
												</select>
										</div>
										<div class="col-lg-12 col-xs-6">
											<label for="counit">Ámbito de contribución</label>
												<select class="selectpicker form-control" id="department[]" name="department[]"
													title="Ámbito de contribución" data-live-search="true" multiple>
													<?php
														foreach($departments as $department) {
															echo "<option value='" . $department['nombre'] . "'>" . $department['nombre']. "</option>";
														}
													?>
												</select>
										</div>
										<div class="col-lg-12 col-xs-6">
											<label for="mechanism">Mecanismo</label>
												<select class="selectpicker form-control" id="mechanism[]" name="mechanism[]"
													title="Mecanismo" data-live-search="true" multiple>
													<?php
														foreach($mechanisms as $mechanism) {
															echo "<option value='" . $mechanism['id'] . "'>" . $mechanism['nombre']. "</option>";
														}
													?>
												</select>
										</div>
										<div class="col-lg-12 col-xs-6">
											<label for="frecuency">Frecuencia</label>
												<select class="selectpicker form-control" id="frecuency[]" name="frecuency[]"
													title="Frecuencia" data-live-search="true" multiple>
													<?php
														foreach($frecuencies as $frecuency) {
															echo "<option value='" . $frecuency['id'] . "' >" . $frecuency['nombre']. "</option>";
														}
													?>
												</select>
										</div>

										<div class="col-lg-12 col-xs-6">
											<label for="counit">Formato de impl.</label>
												<select class="selectpicker form-control" id="implementationFormat[]" name="implementationFormat[]"
													title="Formato de implementación" data-live-search="true" multiple>
													<?php
														foreach($implementationFormats as $implementationFormat) {
															echo "<option value='" . $implementationFormat['nombre'] . "'>" . $implementationFormat['nombre']. "</option>";
														}
													?>
												</select>
										</div>

										<div class="col-lg-12 col-xs-6">
											<label for="environment">Grupos de interés</label>
												<select class="selectpicker form-control" id="environment[]" name="environment[]"
													title="Grupos de interés" data-live-search="true" multiple>
													<?php
														foreach($environments as $environment) {
															echo "<option value='" . $environment['id'] . "'>" . $environment['nombre']. "</option>";
														}
													?>
												</select>
										</div>

										<div class="col-lg-12 col-xs-6">
											<label for="country">País</label>
												<select class="selectpicker form-control" id="country[]" name="country[]"
													title="País" data-live-search="true" multiple data-size="6">
													<?php
														foreach($countries as $country) {
															echo "<option value='" . $country['id'] . "'>" . $country['nombre']. "</option>";
														}
													?>
												</select>
										</div>

										<div class="col-lg-12 col-xs-6">
											<label for="country">Región</label>
												<select class="selectpicker form-control" id="vg_region" name="vg_region[]"
													title="Región" data-live-search="true" multiple data-size="6"
													onchange="selectRegion();">
													<?php
														foreach($regions as $region) {
															echo "<option value='" . $region['id'] . "'>" . $region['nombre']. "</option>";
														}
													?>
												</select>
										</div>

										<div class="col-lg-12 col-xs-6">
											<label for="commune">Comuna</label>
												<select class="selectpicker form-control" id="vg_comuna" name="vg_comuna[]"
													title="Comuna" data-live-search="true" multiple data-size="6">
													<?php
														foreach($communes as $commune) {
															echo "<option value='" . $commune['id'] . "'>" . $commune['nombre']. "</option>";
														}
													?>
												</select>
										</div>

										<!--div class="col-xs-2">
											<label for="counit">Estado de Ejecución</label>
												<select class="selectpicker form-control" id="executionStatus[]" name="executionStatus[]"
													title="Estado de Ejecución" data-live-search="true" multiple>
													?php
														foreach($executionStatus as $executionState) {
															echo "<option value='" . $executionState['nombre'] . "'>" . $executionState['nombre']. "</option>";
														}
													?>
												</select>
										</div-->

										<!--div class="col-xs-2">
											<label for="counit">Estado de Completitud</label>
												<select class="selectpicker form-control" id="fillmentStatus[]" name="fillmentStatus[]"
													title="Estado de Completitud" data-live-search="true" multiple>
													?php
														foreach($fillmentStatus as $fillmentState) {
															echo "<option value='" . $fillmentState['nombre'] . "'>" . $fillmentState['nombre']. "</option>";
														}
													?>
												</select>
										</div-->

										<div class="col-xs-2">
											<br>
											<a class="btn btn-orange" onclick="loadInitiativesByFilters();">Consultar</a>
											<!--button type="submit">Imprimir</button-->
										</div>

									</form>

								<!-- /.col -->
								</div>
							  <!-- /.row -->

								<div class="row">

								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>

					<div class="col-lg-9 col-md-12 col-xs-12">
						<div class="box box-default">
							<div class="box-body">
							  <div class="row">
									<div class="col-lg-12">
										<div id="mostrar_resultados"></div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

    	</section>
    	<!-- /.content -->
  	</div>
  	<!-- /.content-wrapper -->

  <?php include_once("../include/footer.php")?>
</div>
<!-- ./wrapper -->

<script src="../../../template/bower_components/chart.js/Chart.js"></script>
<script src="../../../template/bower_components/jquery-knob/js/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

<script>
	$(document).ready(function(){
		$('#filter_initiative').get(0).reset(); //clear form data on page load
		loadInitiativesByFilters();
	});

	function loadInitiativesByFilters() {
		var parametros = $("#filter_initiative").serialize();

		$.ajax({
			type: "POST",
				url:'./ajax_view_stats_v2_by_initiative.php',
				cache: false,
				data:  parametros,
				beforeSend: function () {
						$('#mostrar_resultados').html('<img src="../../img/ajax-loader.gif"> Obteniendo información, espere por favor. Cargando...');
						//$("#resultado").html("");
				},
				success:  function (response) {
						$('#mostrar_resultados').html('');
						$("#mostrar_resultados").html(response);

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
            				position: 'top'
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
											labelString: "Escuelas",
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

				},
				error: function() {
					$('#mostrar_resultados').html('');
					$("#mostrar_resultados").html(response);
				}
			});
	}

	$("#edit_execution_status").submit(function( event ) {
		$('#edit_execution_status').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../initiatives/ajax_edit_initiative_status_execution.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_estado_ejecucion").html("Cargando...");
			},
			success: function(datos) {
				$('#edit_execution_status').attr("disabled", false);
				$("#resultados_modal_estado_ejecucion").html("");

				var myJSON = JSON.parse(datos);
				var idEjecucion = ("#ejecucion" + myJSON.id);
				$(idEjecucion).html(myJSON.estado_ejecucion);
				$('#editStatusExecution').modal('hide');
			},
			error: function() {
				$("#resultados_modal_estado_ejecucion").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#editStatusExecution').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id_iniciativa = button.data('id_iniciativa');
		var estado_ejecucion = button.data('estado_ejecucion');

		var modal = $(this);
		modal.find('.modal-body #vg_initiative').val(id_iniciativa);
		modal.find('.modal-body #vg_estado_ejecucion').selectpicker('val', estado_ejecucion);

		$("#resultados_modal_estado_ejecucion").html("");
	})

	$("#edit_fillment_status").submit(function( event ) {
		$('#edit_fillment_status').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../initiatives/ajax_edit_initiative_status_fillment.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_estado_completitud").html("Cargando...");
			},
			success: function(datos) {
				$('#edit_fillment_status').attr("disabled", false);
				$("#resultados_modal_estado_completitud").html("");

				var myJSON = JSON.parse(datos);
				var idCompletitud = ("#completitud" + myJSON.id);
				$(idCompletitud).html(myJSON.estado_completitud);
				$('#editStatusFillment').modal('hide');
			},
			error: function() {
				$("#resultados_modal_estado_completitud").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#editStatusFillment').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id_iniciativa = button.data('id_iniciativa');
		var estado_completitud = button.data('estado_completitud');

		var modal = $(this);
		modal.find('.modal-body #vg_initiative').val(id_iniciativa);
		modal.find('.modal-body #vg_estado_completitud').selectpicker('val', estado_completitud);

		$("#resultados_modal_estado_completitud").html("");
	})

	function printContent() {
		//var div = document.querySelector("#toExcel");
  	//imprimirElemento(div);
		loadInitiativesByFiltersPrint();
	}

	function imprimir(){ //funcion para imprimir el contenido del div = panel
            var objeto=document.getElementById('toExcel');
            var ventana=window.open('','_blank');
            ventana.document.write(objeto.innerHTML);
            ventana.document.close();
            ventana.print();
            ventana.close();

            link = ventana.createElement('link');
            link.setAttribute("href", "estilo_cal.css");
            link.setAttribute("rel", "stylesheet");
            link.setAttribute("type", "text/css");
            ventana.appendChild(link);
        }

	function imprimirElemento(elemento){
  	var ventana = window.open('', 'PRINT', 'height=400,width=600');
  	ventana.document.write('<html><head><title>' + document.title + '</title>');
  	ventana.document.write('</head><body >');
  	ventana.document.write(elemento.innerHTML);
  	ventana.document.write('</body></html>');
  	ventana.document.close();
  	ventana.focus();
  	ventana.print();
  	ventana.close();
  	return true;
	}

	function loadInitiativesByFiltersPrint() {
		var parametros = $("#filter_initiative").serialize();

		$.ajax({
			type: "POST",
				url:'./ajax_view_stats_v2_by_initiative_print.php',
				cache: false,
				data:  parametros,
				beforeSend: function () {
						$('#mostrar_resultados').html('<img src="../../img/ajax-loader.gif"> Obteniendo información, espere por favor. Cargando...');
						//$("#resultado").html("");
				},
				success:  function (response) {
						$('#mostrar_resultados').html('');
						$("#mostrar_resultados").html(response);

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
            				position: 'top'
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
											labelString: "Escuelas",
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

				},
				error: function() {
					$('#mostrar_resultados').html('');
					$("#mostrar_resultados").html(response);
				}
			});
	}
</script>
</body>
</html>
