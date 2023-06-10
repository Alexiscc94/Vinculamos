<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
	}

	include_once("../../utils/user_utils.php");
	if(!canCreateInitiatives()) {
		header('Location: ../../index.php');
	}

	$nombre_usuario = $_SESSION["nombre_usuario"];
	$institucion = getInstitution();


	include_once("../../controller/medoo_units.php");
	$units = getVisibleUnitsByInstitution($institucion);

	include_once("../../controller/medoo_campus.php");
	$campuses = getVisibleCampusByInstitution($institucion);

	include_once("../../controller/medoo_departments.php");
	$departments = getVisibleDepartmentsByInstitution($institucion);

	include_once("../../controller/medoo_programs.php");
	$programs = getVisibleProgramsByInstitution($institucion);

	include_once("../../controller/medoo_invi_attributes.php");
	$mechanismsActivities = getVisibleMechanismActivity();
	$frecuencies = getVisibleFrecuency();

	include_once("../../controller/medoo_params.php");
	$implementationFormats = getVisibleImplementationFormats();

	include_once("../../controller/medoo_covenants.php");
	$covenants = getVisibleCovenantsByInstitution($institucion);

?>

<!DOCTYPE html>
<html>
	<?php include_once("../include/header.php")?>

	<body class="hold-transition skin-green sidebar-mini" style="overflow: hidden;">
		<div class="wrapper">
			<?php
				$activeMenu = "initiatives";
				include_once("../include/menu_side.php");
			?>

		  	<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
		    	<!-- Content Header (Page header) -->
		    	<section class="content-header">
		      		<h1>
		        		Registro de iniciativas
		        		<!-- <small>crear iniciativa</small> -->
		      		</h1>
		      		<ol class="breadcrumb">
		        		<li><a href="../home/index.php"><i class="fa fa-home"></i> Inicio</a></li>
		        		<li><a href="../initiatives/view_initiatives_plan.php">Iniciativas</a></li>
		        		<li class="active">Agregar Iniciativa</li>
		      		</ol>
		    	</section>

		    	<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
		    						<h3 class="box-title">Nueva iniciativa</h3>
								</div>
								<!-- /.box-header -->

								<div class="box-body">
									<div id="loader"></div><!-- Carga los datos ajax -->

		    						<form class="form-horizontal" method="post" id="add_initiative" name="add_initiative">
										<?php echo "<input type='hidden' value='".$nombre_usuario."' id='vg_autor' name='vg_autor' />"; ?>
										<?php echo "<input type='hidden' value='' id='vg_mecanismo' name='vg_mecanismo' />"; ?>

										<div class="row">
											<div class="col-xs-12 col-md-12">
		                		<label for="vg_nombre">Nombre de iniciativa <span class="text-red">*</span></label>
												<input type="text" class="form-control" id="vg_nombre" name="vg_nombre"
													placeholder="Nombre" maxlength="500" required >
		                	</div>
											<div class="col-xs-6 col-md-3">
		                		<label for="vg_fecha">Año de ejecución <span class="text-red">*</span></label>
								<select class = "form-control" id="vg_fecha" name="vg_fecha" required> 
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
								</select>
		                	</div>
											<div class="col-xs-6 col-md-3">
		                		<label for="vg_escuela">Escuela <span class="text-red">*</span></label>
		                  	<select class="selectpicker form-control" id="vg_unidad[]" name="vg_unidad[]" onchange="selectUnit();"
													title="Escuela" multiple required data-live-search="true" data-container="body" data-actions-box="true">
													<?php
														//echo "<option value=''></option>";
														foreach($units as $unit) {
															echo "<option value=" . $unit['id'] .">" . $unit['nombre']. "</option>";
														}
													?>
												</select>
		                	</div>

											<!--div class="col-xs-6 col-md-3">
		                		<label for="vg_escuela">Sub Unidad</label>
		                  	<select class="selectpicker form-control" id="vg_unidad_sub" name="vg_unidad_sub[]"
													title="Sub Unidad" multiple data-live-search="true">
												</select>
		                	</div-->

											<div class="col-xs-6 col-md-3">
		                		<label for="vg_sede">Sede <span class="text-red">*</span></label>
		                  	<select class="selectpicker form-control" id="vg_sede[]" name="vg_sede[]"
													title="Sede" multiple required data-live-search="true" data-actions-box="true">
													<?php
														foreach($campuses as $campus) {
															echo "<option value=" . $campus['id'] .">" . $campus['nombre']. "</option>";
														}
													?>
												</select>
		                	</div>
											<div class="col-xs-6 col-md-3">
		                		<label for="vg_sede">Ámbito de contribución <span class="text-red">*</span></label>
		                  	<select class="selectpicker form-control" id="vg_facultad[]" name="vg_facultad[]"
													title="Ámbito de contribución" multiple required data-live-search="true" onchange="selectDepartment();">
													<?php
														foreach($departments as $department) {
															echo "<option value='" . $department['id'] . "' ".$department['selected'].">" . $department['nombre']. "</option>";
														}
													?>
												</select>
		                	</div> 
											<div class="col-xs-12 col-md-6">
		                		<label for="vg_sede">Carrera</label>
		                  	<select class="selectpicker form-control" id="vg_carrera" name="vg_carrera[]"
													title="Carrera" multiple data-live-search="true">
												</select>
		                	</div>
											<div class="col-xs-12 col-md-4">
		                		<label for="vg_programa">Programa <span class="text-red">*</span></label>
		                		<select class="selectpicker form-control" id="vg_programa" name="vg_programa"
													title="Programa" required data-live-search="true" onchange="selectProgram();">
												<?php
													foreach($programs as $program) {
														echo "<option value=" . $program['id'] .">" . $program['nombre']. "</option>";
													}
												?>
												</select>
		                  </div>
									<!--		<div class="col-xs-6 col-md-4">
		                		<label for="vg_programa_secundario">¿Se relaciona con otro programa?</label>
		                		<select class="selectpicker form-control" id="vg_programa_secundario" name="vg_programa_secundario[]"
													title="¿Se relaciona con otro programa?" multiple data-live-search="true">
												</select>
		                  </div> -->
											<div class="col-xs-6 col-md-4">
		                		<label for="vg_convenios">Convenios</label>
		                  	<select class="selectpicker form-control" id="vg_convenios" name="vg_convenios[]"
													title="Convenios" multiple data-live-search="true">
													<?php
														foreach($covenants as $covenant) {
															echo "<option value=" . $covenant['id'] .">" . $covenant['nombre']. "</option>";
														}
													?>
												</select>
		                	</div>
											<div class="col-xs-6 col-md-4">
		                		<label for="vg_formato_implementacion">Formato de implementación <span class="text-red">*</span> </label>
		                  	<select class="selectpicker form-control" id="vg_formato_implementacion" name="vg_formato_implementacion"
													title="Formato de implementación" required data-live-search="true">
													<?php
														foreach($implementationFormats as $implementationFormat) {
															echo "<option value='" . $implementationFormat['nombre'] . "'>" . $implementationFormat['nombre']. "</option>";
														}
													?>
												</select>
		                	</div>
										<!--	<div class="col-xs-6 col-md-4">
		                		<label for="vg_encargado">Nombre encargado responsable</label>
												<input type="text" class="form-control" id="vg_encargado" name="vg_encargado"
													placeholder="Nombre encargado responsable" maxlength="100">
		                  </div> -->
										<!--	<div class="col-xs-6 col-md-4">
		                		<label for="vg_encargado_cargo">Cargo encargado responsable</label>
												<input type="text" class="form-control" id="vg_encargado_cargo" name="vg_encargado_cargo"
													placeholder="Cargo encargado responsable" maxlength="100"> -->
		                  	<!--select class="selectpicker form-control" id="vg_encargado_cargo" name="vg_encargado_cargo"
													title="Cargo encargado responsable" data-live-search="true"> 
													?php
														foreach($managerPositions as $managerPosition) {
															echo "<option value='" . $managerPosition['nombre'] . "'>" . $managerPosition['nombre']. "</option>";
														}
													?>
												</select-->
		                	<!--</div> -->

											<!--div class="col-xs-6 col-md-4">
		                		<label for="vg_mecanismo">Mecanismo <span class="text-red">*</span></label>
		                  	<select class="selectpicker form-control" id="vg_mecanismo" name="vg_mecanismo"
													title="Mecanismo" data-live-search="true" required>
													<?php
														foreach($mechanisms as $mechanism) {
															echo "<option value='" . $mechanism['id'] . "'>" . $mechanism['nombre']. "</option>";
														}
													?>
												</select>
		                	</div-->
											<div class="col-xs-6 col-md-4">
		                		<label for="vg_actividad">Tipo de actividad <span class="text-red">*</span></label>
		                  	<select class="selectpicker form-control" id="vg_actividad" name="vg_actividad"
													title="Tipo de actividad" data-size="5" data-live-search="true" required onchange="selectActivity();">
													<?php
														foreach($mechanismsActivities as $mechanismActivity) {
															echo "<option value='" . $mechanismActivity['id'] . "' data-subtext='(" . $mechanismActivity['mecanismo_nombre'] . ")'>" . $mechanismActivity['nombre']. "</option>";
														}
													?>
												</select>
		                	</div>
											<div class="col-xs-6 col-md-4">
		                		<label for="vg_frecuencia">Frecuencia <span class="text-red">*</span></label>
		                  	<select class="selectpicker form-control" id="vg_frecuencia" name="vg_frecuencia"
													title="Frecuencia" required data-live-search="true">
													<?php
														foreach($frecuencies as $frecuency) {
															echo "<option value=" . $frecuency['id'] .">" . $frecuency['nombre']. "</option>";
														}
													?>
												</select>
		                  </div>

										</div>
										<br>
										<div class="modal-footer">
											<a href="view_initiatives_plan.php" class="btn btn-default" data-dismiss="modal">Ir al listado</a>
											<button type="submit" class="btn btn-orange"><span class="fa fa-save"></span> Siguiente</button>
										</div>

									</form>

									<hr style="height: 2px; border: 0;" class="btn-orange"/>

									<div id="loader"></div>

		    				</div>
		    				<!-- /.box-body -->
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

		<script>
			$(document).ready(function(){
				selectProgram();
			});

			function selectUnit() {
				var parametros = $("#add_initiative").serialize();

				$.ajax({
					type: "POST",
		      url:'../json/json_unit_subs.php',
					data: parametros,
		      beforeSend: function () {
		        $("#loader").html("Realizando búsqueda, espere por favor.");
		      },
		      success:  function (response) {
		        $("#loader").html("");

						var myJSON = JSON.parse(response);
						var options = "";
						//options += '<option value="" title="No">No</option>';
		        for (var i = 0; i < myJSON.length; i++) {
							var subunit = myJSON[i];
							if(subunit.nombre.length > 40) {
								var textoVisible = subunit.nombre.substring(0, 37) + "...";
								options += '<option value="' + subunit.id + '" title="' + subunit.nombre + '">' + textoVisible + '</option>';
							} else {
								options += '<option value="' + subunit.id + '" title="' + subunit.nombre + '">' + subunit.nombre + '</option>';
							}
						}

		      	$("#vg_unidad_sub")
					   .html(options)
					   .selectpicker('refresh');
		      },
					error: function() {
						$("#loader").html(response);
					}
				});
			}

			function selectDepartment() {
				var parametros = $("#add_initiative").serialize();

				$.ajax({
					type: "POST",
					url:'../json/json_carrers.php',
					data: parametros,
					beforeSend: function () {
						$("#loader").html("Realizando búsqueda, espere por favor.");
					},
					success:  function (response) {
						$("#loader").html("");

						var myJSON = JSON.parse(response);
						var options = "";
						//options += '<option value="" title="No">No</option>';
						for (var i = 0; i < myJSON.length; i++) {
							var carrer = myJSON[i];
							if(carrer.nombre.length > 70) {
								var textoVisible = carrer.nombre.substring(0, 67) + "...";
								options += '<option value="' + carrer.id + '" title="' + carrer.nombre + '">' + textoVisible + '</option>';
							} else {
								options += '<option value="' + carrer.id + '" title="' + carrer.nombre + '">' + carrer.nombre + '</option>';
							}
						}

						$("#vg_carrera")
						 .html(options)
						 .selectpicker('refresh');
					},
					error: function() {
						$("#loader").html(response);
					}
				});
			}

			function selectProgram() {
				var parametros = $("#add_initiative").serialize();

				$.ajax({
					type: "POST",
		      url:'../json/json_programs_secondary.php',
					data: parametros,
		      beforeSend: function () {
		        $("#loader").html("Realizando búsqueda, espere por favor.");
		      },
		      success:  function (response) {
		        $("#loader").html("");

						var myJSON = JSON.parse(response);
						var options = "";
						options += '<option value="" title="No">No</option>';
		        for (var i = 0; i < myJSON.length; i++) {
							var region = myJSON[i];
							options += '<option value="' + region.id + '" title="' + region.nombre + '">' + region.nombre + '</option>';
						}

		      	$("#vg_programa_secundario")
					   .html(options)
					   .selectpicker('refresh');
		      },
					error: function() {
						$("#loader").html(response);
					}
				});
			}

			function selectActivity() {
				var parametros = $("#add_initiative").serialize();

				$.ajax({
					type: "POST",
		      url:'../json/json_activity.php',
					data: parametros,
		      beforeSend: function () {
		        $("#loader").html("Realizando búsqueda, espere por favor.");
		      },
		      success:  function (response) {
		        $("#loader").html("");

						var myJSON = JSON.parse(response);
		      	$("#vg_mecanismo").val(myJSON.id_mecanismo);
		      },
					error: function() {
						$("#loader").html(response);
					}
				});
			}

			$("#add_initiative").submit(function( event ) {
				$('#add_initiative').attr("disabled", true);
				var parametros = $(this).serialize();
				$.ajax({
					type: "POST",
					url: "./ajax_add_initiative.php",
					data: parametros,
					beforeSend: function(objeto) {
						$("#loader").html("Cargando...");
					},
					success: function(datos) {
						$("#loader").html("");

						if (datos != "-1") {
		     			window.location.href = "./edit_initiative_plan_step2.php?data=" + datos;
						}
					},
					error: function() {
						//$("#loader").html("Error en el registro");
					}
				});

				event.preventDefault();
			})

		</script>
	</body>
</html>
