<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
	}

	include_once("../../utils/user_utils.php");
	if(!canUpdateInitiatives()) {
		header('Location: ../../index.php');
	}

	$nombre_usuario = $_SESSION["nombre_usuario"];
	$institucion = getInstitution();

	$id = str_replace("data", "", noeliaDecode($_GET["data"]));

	include_once("../../controller/medoo_initiatives_plan.php");
	$datas = getInitiativePlan($id);
	if($datas[0]["estado"] == "En Revisión") {
		if(!canSuperviseInitiatives()) {
			header('Location: ../../index.php');
		}
	}

	include_once("../../controller/medoo_units.php");
	$units = getVisibleUnitsByInstitution($institucion);
	$myUnits = getUnitsByInitiativePlan($datas[0]["id"]);
	$unitFound = false;
	for($i=0; $i<sizeof($units); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myUnits); $j++) {
			if($units[$i]["id"] == $myUnits[$j]["id"]) {
				$found = true;
				$unitFound = true;
			}
		}
		if($found == true)
			$units[$i]["selected"] = "selected";
		else
			$units[$i]["selected"] = "";
	}

	include_once("../../controller/medoo_units_subs.php");
	$units_sub = array();
	for($i=0; $i<sizeof($myUnits); $i++) {
		$result = getVisibleUnitsSubByUnit($myUnits[$i]["id"]);
		$units_sub = array_merge($units_sub, $result);
	}
	$myUnitsSubs = getUnitsSubByInitiativePlan($datas[0]["id"]);
	for($i=0; $i<sizeof($units_sub); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myUnitsSubs); $j++) {
			if($units_sub[$i]["id"] == $myUnitsSubs[$j]["id"])
				$found = true;
		}
		if($found == true)
			$units_sub[$i]["selected"] = "selected";
		else
			$units_sub[$i]["selected"] = "";
	}

	include_once("../../controller/medoo_campus.php");
	$campuses = getVisibleCampusByInstitution($institucion);
	$myCampus = getCampusByInitiativePlan($datas[0]["id"]);
	$campusFound = false;
	for($i=0; $i<sizeof($campuses); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myCampus); $j++) {
			if($campuses[$i]["id"] == $myCampus[$j]["id"]) {
				$found = true;
				$campusFound = true;
			}
		}
		if($found == true)
			$campuses[$i]["selected"] = "selected";
		else
			$campuses[$i]["selected"] = "";
	}

	include_once("../../controller/medoo_departments.php");
	$departments = getVisibleDepartmentsByInstitution($institucion);
	$myDepartments = getDepartmentsByInitiativePlan($datas[0]["id"]);
	$departmentFound = false;
	for($i=0; $i<sizeof($departments); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myDepartments); $j++) {
			if($departments[$i]["id"] == $myDepartments[$j]["id"]) {
				$found = true;
				$departmentFound = true;
			}
		}
		if($found == true)
			$departments[$i]["selected"] = "selected";
		else
			$departments[$i]["selected"] = "";
	}

	include_once("../../controller/medoo_carrers.php");
	$carrers = array();
	for($i=0; $i<sizeof($myDepartments); $i++) {
		$result = getVisibleCarrersByDepartment($myDepartments[$i]["id"]);
		$carrers = array_merge($carrers, $result);
	}
	$myCarrers = getCarrersByInitiativePlan($datas[0]["id"]);
	for($i=0; $i<sizeof($carrers); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myCarrers); $j++) {
			if($carrers[$i]["id"] == $myCarrers[$j]["id"])
				$found = true;
		}
		if($found == true)
			$carrers[$i]["selected"] = "selected";
		else
			$carrers[$i]["selected"] = "";
	}

	include_once("../../controller/medoo_programs.php");
	$programs = getVisibleProgramsByInstitution($institucion);
	$myPrograms = getProgramsByInitiativePlan($datas[0]["id"]);
	$programFound = false;
	for($i=0; $i<sizeof($programs); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myPrograms); $j++) {
			if($programs[$i]["id"] == $myPrograms[$j]["id"]) {
				$found = true;
				$programFound = true;
			}
		}
		if($found == true)
			$programs[$i]["selected"] = "selected";
		else
			$programs[$i]["selected"] = "";
	}

	$programs_secondary = getVisibleProgramsByInstitution($institucion);
	$myProgramsSecondary = getProgramsSecundaryByInitiativePlan($datas[0]["id"]);
	$programsecondaryFound = false;
	for($i=0; $i<sizeof($programs_secondary); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myProgramsSecondary); $j++) {
			if($programs_secondary[$i]["id"] == $myProgramsSecondary[$j]["id"]) {
				$found = true;
				$programsecondaryFound = true;
			}
		}
		if($found == true)
			$programs_secondary[$i]["selected"] = "selected";
		else
			$programs_secondary[$i]["selected"] = "";
	}

	include_once("../../controller/medoo_invi_attributes.php");
	$mechanismsActivities = getVisibleMechanismActivity();
	for ($i=0; $i < sizeof($mechanismsActivities); $i++) {
		if($datas[0]["id_actividad"] == $mechanismsActivities[$i]['id']) {
			$mechanismsActivities[$i]["selected"] = "selected";
		} else {
			$mechanismsActivities[$i]["selected"] = "";
		}
	}

	$frecuencies = getVisibleFrecuency();
	for ($i=0; $i < sizeof($frecuencies); $i++) {
		if($datas[0]["id_frecuencia"] == $frecuencies[$i]['id']) {
			$frecuencies[$i]["selected"] = "selected";
		} else {
			$frecuencies[$i]["selected"] = "";
		}
	}

	include_once("../../controller/medoo_params.php");
	$implementationFormats = getVisibleImplementationFormats();
	for ($i=0; $i < sizeof($implementationFormats); $i++) {
		if($datas[0]["formato_implementacion"] == $implementationFormats[$i]['nombre']) {
			$implementationFormats[$i]["selected"] = "selected";
		} else {
			$implementationFormats[$i]["selected"] = "";
		}
	}

	include_once("../../controller/medoo_covenants.php");
	$covenants = getVisibleCovenantsByInstitution($institucion);
	$myCovenants = getCovenantsByInitiativePlan($datas[0]["id"]);
	$covenantFound = false;
	for($i=0; $i<sizeof($covenants); $i++) {
		$found = false;
		for($j=0; $j<sizeof($myCovenants); $j++) {
			if($covenants[$i]["id"] == $myCovenants[$j]["id"]) {
				$found = true;
				$covenantFound = true;
			}

		}
		if($found == true)
			$covenants[$i]["selected"] = "selected";
		else
			$covenants[$i]["selected"] = "";
	}

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
	?>

  	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
			<section class="content-header">
    		<h1>
      		Registro de la iniciativa
      		<small>editar iniciativa</small>
    		</h1>
    		<ol class="breadcrumb">
					<li><a href="../home/index.php"><i class="fa fa-home"></i> Inicio</a></li>
					<li><a href="../initiatives/view_initiatives_plan.php">Iniciativas</a></li>
      		<li class="active">Editar Iniciativa - Paso 1</li>
    		</ol>
    	</section>

    	<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
    						<h3 class="box-title"><?php echo ($datas[0]["nombre"] == "" ? "Editar iniciativa" : $datas[0]["nombre"]);?></h3>
						</div>
						<!-- /.box-header -->

						<div class="box-body">
							<div id="loader"></div><!-- Carga los datos ajax -->

    						<form class="form-horizontal" method="post" id="edit_initiative_step1" name="edit_initiative_step1">
								<?php echo "<input type='hidden' value='".$nombre_usuario."' id='vg_autor' name='vg_autor' />"; ?>
								<?php echo "<input type='hidden' value='".noeliaEncode($id)."' id='vg_id' name='vg_id' />"; ?>
								<?php echo "<input type='hidden' value='".$datas[0]["id_mecanismo"]."' id='vg_mecanismo' name='vg_mecanismo' />"; ?>

								<div class="row">
									<div class="col-xs-12 col-md-12">
                		<label for="vg_nombre">Nombre de la iniciativa <span class="text-red">*</span></label>
										<input type="text" class="form-control" id="vg_nombre" name="vg_nombre"
											placeholder="Nombre" maxlength="500" required value='<?php echo$datas[0]["nombre"];?>'>
                	</div>
					<div class="col-xs-6 col-md-2">
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

									<div class="col-xs-6 col-md-4">
                		<label for="vg_escuela">Escuela <span class="text-red">*</span></label>
                  	<select class="selectpicker form-control" id="vg_unidad[]" name="vg_unidad[]" onchange="selectUnit();"
											title="Escuela" multiple required data-live-search="true" data-container="body" data-actions-box="true">
											<?php
												foreach($units as $unit) {
													echo "<option value='" . $unit['id'] . "' ".$unit['selected'].">" . $unit['nombre']. "</option>";
												}
											?>
										</select>
                	</div>

									<!--div class="col-xs-6 col-md-4">
										<label for="vg_escuela">Sub Unidad</label>
										<select class="selectpicker form-control" id="vg_unidad_sub" name="vg_unidad_sub[]"
											title="Sub Unidad" multiple data-live-search="true">
											?php
												foreach($units_sub as $unit_sub) {
													echo "<option value='" . $unit_sub['id'] . "' ".$unit_sub['selected'].">" . $unit_sub['nombre']. "</option>";
												}
											?>
										</select>
									</div-->

									<div class="col-xs-6 col-md-3">
                		<label for="vg_sede">Sede <span class="text-red">*</span></label>
                  	<select class="selectpicker form-control" id="vg_sede[]" name="vg_sede[]"
											title="Sede" multiple  required data-live-search="true" data-actions-box="true">
											<?php
												foreach($campuses as $campus) {
													echo "<option value='" . $campus['id'] . "' ".$campus['selected'].">" . $campus['nombre']. "</option>";
												}
											?>
										</select>
                	</div>
									<div class="col-xs-6 col-md-3">
                		<label for="vg_sede">Ámbito de contribución <span class="text-red">*</span></label>
                  	<select class="selectpicker form-control" id="vg_facultad[]" name="vg_facultad[]"
											title="Ámbito de contribución" required multiple data-live-search="true" onchange="selectDepartment();">
											<?php
												foreach($departments as $department) {
													echo "<option value='" . $department['id'] . "' ".$department['selected'].">" . $department['nombre']. "</option>";
												}
											?>
										</select>
                	</div>
									<div class="col-xs-6 col-md-6">
                		<label for="vg_sede">Carrera </label>
                  	<select class="selectpicker form-control" id="vg_carrera" name="vg_carrera[]"
											title="Carrera" multiple data-live-search="true" data-actions-box="true">
											<?php
												foreach($carrers as $carrer) {
													echo "<option value='" . $carrer['id'] . "' ".$carrer['selected'].">" . $carrer['nombre']. "</option>";
												}
											?>
										</select>
                	</div>
									<div class="col-xs-6 col-md-4">
                		<label for="vg_programa">Programa <span class="text-red">*</span></label>
                		<select class="selectpicker form-control" id="vg_programa" name="vg_programa"
											title="Programa" required data-live-search="true" onchange="selectProgram();">
											<?php
												foreach($programs as $program) {
													echo "<option value='" . $program['id'] . "' ".$program['selected'].">" . $program['nombre']. "</option>";
												}
											?>
										</select>
                  </div>
						<!--			<div class="col-xs-6 col-md-4">
                		<label for="vg_programa_secundario">¿Se relaciona con otro programa?</label>
                		<select class="selectpicker form-control" id="vg_programa_secundario" name="vg_programa_secundario[]"
											title="¿Se relaciona con otro programa?" multiple data-live-search="true">
											?php
												if($programsecondaryFound == true) {
													echo "<option value=''>No</option>";
												} else {
													echo "<option value='' selected>No</option>";
												}
												foreach($programs_secondary as $program_secondary) {
													echo "<option value='" . $program_secondary['id'] . "' ".$program_secondary['selected'].">" . $program_secondary['nombre']. "</option>";
												}
											?>
										</select>
                  </div> -->
									<div class="col-xs-6 col-md-4">
										<label for="vg_convenios">Convenios</label>
										<select class="selectpicker form-control" id="vg_convenios" name="vg_convenios[]"
											title="Convenios" multiple data-live-search="true">
											<?php
												foreach($covenants as $covenant) {
													echo "<option value='" . $covenant['id'] . "' ".$covenant['selected'].">" . $covenant['nombre']. "</option>";
												}
											?>
										</select>
									</div>

									<div class="col-xs-6 col-md-4">
                		<label for="vg_formato_implementacion">Formato de implementación <span class="text-red">*</span></label>
                  	<select class="selectpicker form-control" id="vg_formato_implementacion" name="vg_formato_implementacion"
											title="Formato de implementación" data-live-search="true">
											<?php
												foreach($implementationFormats as $implementationFormat) {
													if($datas[0]["formato_implementacion"] == $implementationFormat['nombre']) {
														echo "<option value='" . $implementationFormat['nombre'] . "' selected>" . $implementationFormat['nombre']. "</option>";
													} else {
														echo "<option value='" . $implementationFormat['nombre'] . "'>" . $implementationFormat['nombre']. "</option>";
													}
												}
											?>
										</select>
                	</div>
						<!--			<div class="col-xs-6 col-md-4">
                		<label for="vg_encargado">Nombre encargado responsable</label>
										<input type="text" class="form-control" id="vg_encargado" name="vg_encargado"
											placeholder="Nombre encargado responsable" maxlength="100" value='?php echo$datas[0]["responsable"];?>'>
                  </div>
									<div class="col-xs-6 col-md-4">
                		<label for="vg_encargado_cargo">Cargo encargado responsable</label>
										<input type="text" class="form-control" id="vg_encargado_cargo" name="vg_encargado_cargo"
											placeholder="Cargo encargado responsable" maxlength="100" value='?php echo$datas[0]["responsable_cargo"];?>'>
                  </div> -->

									<!--div class="col-xs-6 col-md-4">
                		<label for="vg_mecanismo">Mecanismo <span class="text-red">*</span></label>
                  	<select class="selectpicker form-control" id="vg_mecanismo" name="vg_mecanismo"
											title="Mecanismo" data-live-search="true" required>
											?php
											foreach($mechanisms as $mechanism) {
												echo "<option value='" . $mechanism['id'] . "' ".$mechanism['selected'].">" . $mechanism['nombre']. "</option>";
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
													echo "<option value='" . $mechanismActivity['id'] . "' ".$mechanismActivity['selected']." data-subtext='(" . $mechanismActivity['mecanismo_nombre'] . ")'>" . $mechanismActivity['nombre']. "</option>";
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
													echo "<option value='" . $frecuency['id'] . "' ".$frecuency['selected'].">" . $frecuency['nombre']. "</option>";
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<script>
	$(document).ready(function(){
		//selectProgram();
		//selectCountry();
	});

	function selectUnit() {
		var parametros = $("#edit_initiative_step1").serialize();

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
		var parametros = $("#edit_initiative_step1").serialize();

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
		var parametros = $("#edit_initiative_step1").serialize();

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
		var parametros = $("#edit_initiative_step1").serialize();

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

	$("#edit_initiative_step1").submit(function( event ) {
		$('#edit_initiative_step1').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_edit_initiative_plan_step1.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#loader").html("Cargando...");
			},
			success: function(datos) {
				$("#loader").html("");
				$('#loader').html('<div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button> Iniciativa guardada correctamente. </div>');

				if (datos != "-1") {
					sleep(1000).then(() => {
						window.location.href = "./edit_initiative_plan_step2.php?data=" + datos;
					});
				}
			},
			error: function() {
				$("#loader").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	const sleep = (milliseconds) => {
	  return new Promise(resolve => setTimeout(resolve, milliseconds))
	}

</script>
</body>
</html>
