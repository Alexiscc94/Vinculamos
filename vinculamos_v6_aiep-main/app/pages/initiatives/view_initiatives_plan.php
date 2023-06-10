<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
	}

	$nombre_usuario = $_SESSION["nombre_usuario"];

	include_once("../../utils/user_utils.php");
	if(!canReadInitiatives()) {
		header('Location: ../../index.php');
		return;
	}
	$institucion = getInstitution();

	include_once("../../controller/medoo_params.php");
	$executionStatus = getVisibleExecutionStatus();
	$fillmentStatus = getVisibleFillmentStatus();

	include_once("../../controller/medoo_units.php");
	$units = getVisibleUnitsByInstitution($institucion);

	include_once("../../controller/medoo_campus.php");
	$campuses = getVisibleCampusByInstitution($institucion);

	include_once("../../controller/medoo_departments.php");
	$departments = getVisibleDepartmentsByInstitution($institucion);

	include_once("../../controller/medoo_programs.php");
	$programs = getVisibleProgramsByInstitution($institucion);

?>

<!DOCTYPE html>
<html>
<?php include_once("../include/header.php")?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
	<?php
		$activeMenu = "initiatives";
		include_once("../include/menu_side.php");

		include_once("modal_calculate_invi.php");
		include_once("modal_edit_status_execution_results.php");
		include_once("modal_delete_initiative.php");
	?>

  	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
    	<section class="content-header">
      		<h1>
        		Iniciativas
        		<small>todos las iniciativas</small>
      		</h1>
      		<ol class="breadcrumb">
						<li><a href="../home/index.php"><i class="fa fa-home"></i> Inicio</a></li>
        		<li><a href="../initiatives/view_initiatives_plan.php">Iniciativas</a></li>
        		<li class="active">Ver Iniciativas</li>
      		</ol>
    	</section>

    	<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
    						<h3 class="box-title">Registro de iniciativas</h3>

    						<?php
    							if(canCreateInitiatives() && false) {?>
    								<div class="btn-group pull-right">
										<button id="exportButton" name="exportButton" class="btn btn-orange pull-right"
											data-toggle="modal"
											data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
											data-target="#addProcedure">
											<span class="fa fa-plus-circle"></span> Agregar Iniciativa
										</button>
									</div>
							<?php
								} ?>
						</div>
						<!-- /.box-header -->

						<div class="row">
							<div class="col-lg-12 col-xs-6">
								<form id="filter_initiative" name="filter_initiative" method="post">
									<!--div class="col-xs-3">
										<label for="counit">Estado de Ejecución</label>
											<select class="selectpicker form-control" id="executionStatus[]" name="executionStatus[]"
												title="Estado de Ejecución" data-live-search="true" multiple>
												?php
													foreach($executionStatus as $executionState) {
														echo "<option value='" . $executionState['nombre'] . "'>" . $executionState['nombre']. "</option>";
													}
												?>
											</select>
									</div>

									<div class="col-xs-3">
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

									<div class="col-xs-3">
                		<label for="vg_fecha">Año de ejecución</label>
						<select class = "form-control" id="vg_fecha" name="vg_fecha"> 
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
								</select>
                	</div>

									<div class="col-xs-3">
										<label for="vg_escuela">Escuela</label>
										<select class="selectpicker form-control" id="vg_unidad[]" name="vg_unidad[]"
											title="Escuela" multiple data-live-search="true">
											<?php
												foreach($units as $unit) {
													echo "<option value=" . $unit['id'] .">" . $unit['nombre']. "</option>";
												}
											?>
										</select>
									</div>

									<div class="col-xs-2">
										<label for="vg_sede">Sede </label>
										<select class="selectpicker form-control" id="vg_sede[]" name="vg_sede[]"
											title="Sede" multiple data-live-search="true">
											<?php
												foreach($campuses as $campus) {
													echo "<option value=" . $campus['id'] .">" . $campus['nombre']. "</option>";
												}
											?>
										</select>
									</div>

									 <div class="col-xs-3">
										<label for="vg_sede">Ámbito de contribución</label>
										<select class="selectpicker form-control" id="vg_facultad[]" name="vg_facultad[]"
											title="Ámbito de contribución" multiple data-live-search="true">
											<?php
												foreach($departments as $department) {
													echo "<option value=" . $department['id'] .">" . $department['nombre']. "</option>";
												}
											?>
										</select>
									</div> 

									<div class="col-xs-3">
										<label for="vg_programa">Programa</label>
										<select class="selectpicker form-control" id="vg_programa[]" name="vg_programa[]"
											title="Programa" multiple data-live-search="true" onchange="selectProgram();">
										<?php
											foreach($programs as $program) {
												echo "<option value=" . $program['id'] .">" . $program['nombre']. "</option>";
											}
										?>
										</select>
									</div>

									<div class="col-xs-1">
										<br>
										<a class="btn btn-orange" onclick="load();">Filtrar</a>
									</div>

								</form>
							</div>
						</div>

						<div class="col-md-12">
							<div id="mensaje_resultados"></div><!-- Carga los datos ajax -->
						</div>

						<span id="loader"></span>
						<div id="resultados"></div><!-- Carga los datos ajax -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
    	<!-- /.content -->
	</div>
  	<!-- /.content-wrapper -->

  	<?php include_once("../include/footer.php")?>
</div>
<!-- ./wrapper -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<script>
	$(document).ready(function(){
		load();
	});

	function load() {
		var parametros = $("#filter_initiative").serialize();

		$.ajax({
			type: "POST",
      url:'./ajax_view_initiatives_plan.php',
      data: parametros,
      beforeSend: function () {
        $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
        $("#resultados").html("Obteniendo información, espere por favor.");
      },
      success:  function (response) {
        $('#loader').html('');
        $("#resultados").html(response);

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
      },
			error: function() {
				$('#loader').html('');
				$("#resultados").html(response);
			}
    });
	}

	$('#calculateScoreVCM').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var iniciativa = button.data('iniciativa');
		var usuario = button.data('usuario');

		var modal = $(this);
		//modal.find('.modal-body #vg_usuario').val(usuario);
		//modal.find('.modal-body #vg_initiative').val(iniciativa);
		modal.find('.modal-body #resultados_modal_calculo_puntaje_vcm').html("Prueba");

		var parametros = {
				"id_initiative" : iniciativa
		};

		$.ajax({
			type: "POST",
			url: "./ajax_view_calculate_invi.php",
			data: parametros,
			beforeSend: function(objeto) {
				modal.find('.modal-body #resultados_modal_calculo_puntaje_vcm').html("Cargando...");
			},
			success: function(datos) {
				modal.find('.modal-body #resultados_modal_calculo_puntaje_vcm').html(datos);
			},
			error: function() {
				modal.find('.modal-body #resultados_modal_calculo_puntaje_vcm').html("Error en el registro");
			}
		});

	})

	$("#edit_execution_status_result").submit(function( event ) {
		$('#edit_execution_status_result').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_edit_initiative_status_execution_result.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_estado_ejecucion_result").html("Cargando...");
			},
			success: function(datos) {
				$('#edit_execution_status_result').attr("disabled", false);
				if (datos != "-1") {
					//$("#resultados_modal_estado_ejecucion_result").html(datos);
					window.location.href = "./edit_initiative_plan_step5.php?data=" + datos;
				}
			},
			error: function() {
				$("#resultados_modal_estado_ejecucion_result").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#editStatusExecutionResult').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id_iniciativa = button.data('id_iniciativa');
		var estado_ejecucion = button.data('estado_ejecucion');

		var modal = $(this);
		modal.find('.modal-body #vg_initiative').val(id_iniciativa);

		$("#resultados_modal_estado_ejecucion_result").html("");
	})

	$("#delete_initiative").submit(function( event ) {
		$('#delete_initiative').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_delete_initiative.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#mensaje_resultados").html("Cargando...");
			},
			success: function(datos) {
				$('#delete_initiative').attr("disabled", false);
				$('#deleteInitiative').modal('hide');
				$("#mensaje_resultados").html(datos);
				load();
			},
			error: function() {
				$("#mensaje_resultados").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#deleteInitiative').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id_iniciativa = button.data('id_iniciativa');
		var nombre = button.data('nombre');
		var usuario = button.data('usuario');

		var modal = $(this);
		modal.find('.modal-body #vg_initiative').val(id_iniciativa);
		modal.find('.modal-body #vg_nombre').html(nombre);
		modal.find('.modal-body #vg_usuario').val(usuario);

		$("#resultados_modal_eliminar").html("");
	})

</script>
</body>
</html>
