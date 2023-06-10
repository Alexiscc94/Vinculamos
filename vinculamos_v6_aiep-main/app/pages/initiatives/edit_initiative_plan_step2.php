<?php
if (!isset($_SESSION)) {
	@session_start();
}

if ($_SESSION["activo"] == 0) {
	header('Location: ../../index.php');
}

include_once("../../utils/user_utils.php");
if (!canUpdateInitiatives()) {
	header('Location: ../../index.php');
}

$nombre_usuario = $_SESSION["nombre_usuario"];
$institution = getInstitution();

$id = str_replace("data", "", noeliaDecode($_GET["data"]));

include_once("../../controller/medoo_initiatives_plan.php");
$datas = getInitiativePlan($id);
$dataEncoded = noeliaEncode("data" . $datas[0]['id']);

if ($datas[0]["estado"] == "En Revisión") {
	if (!canSuperviseInitiatives()) {
		header('Location: ../../index.php');
	}
}

include_once("../../controller/medoo_environment.php");
$environments = getVisibleEnvironments();

include_once("../../controller/medoo_environment_detail.php");
$environment_details = getVisibleEnvironmentDetails();
//$myEnvDetails = getEnvironmentDetailsByInitiativePlan($datas[0]["id"]);

include_once("../../controller/medoo_impact_internal.php");
$internalImpactTypes = getVisibleInternalImpactTypes();
$myInternalImpacts = getInternalImpactByInitiativePlan($datas[0]["id"]);
for ($i = 0; $i < sizeof($internalImpactTypes); $i++) {
	$found = false;
	for ($j = 0; $j < sizeof($myInternalImpacts); $j++) {
		if ($internalImpactTypes[$i]["id"] == $myInternalImpacts[$j]["id"])
			$found = true;
	}
	if ($found == true)
		$internalImpactTypes[$i]["selected"] = "selected";
	else
		$internalImpactTypes[$i]["selected"] = "";
}

include_once("../../controller/medoo_impact_external.php");
$externalImpactTypes = getVisibleExternalImpactTypes();
$myExternalImpacts = getExternalImpactByInitiativePlan($datas[0]["id"]);
for ($i = 0; $i < sizeof($externalImpactTypes); $i++) {
	$found = false;
	for ($j = 0; $j < sizeof($myExternalImpacts); $j++) {
		if ($externalImpactTypes[$i]["id"] == $myExternalImpacts[$j]["id"])
			$found = true;
	}
	if ($found == true)
		$externalImpactTypes[$i]["selected"] = "selected";
	else
		$externalImpactTypes[$i]["selected"] = "";
}

?>

<!DOCTYPE html>
<html>
<?php include_once("../include/header.php") ?>
<style type="text/css">
	.container {
		/*margin-top: 50px;*/
	}

	#remove:hover {
		cursor: pointer;
	}

	#tags {
		margin-top: 10px;
	}
</style>

<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">
		<?php
		$activeMenu = "initiatives";
		include_once("../include/menu_side.php");

		include_once("modal_edit_expected_result.php");
		include_once("modal_delete_expected_result.php");

		include_once("modal_edit_expected_impact.php");
		include_once("modal_delete_expected_impact.php");
		?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Iniciativas
					<small>editar iniciativa</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="../home/index.php"><i class="fa fa-home"></i> Inicio</a></li>
					<li><a href="../initiatives/view_initiatives_plan.php">Iniciativas</a></li>
					<li class="active">Editar Iniciativa - Paso 2</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title"><?php echo ($datas[0]["nombre"] == "" ? "Editar iniciativa" : $datas[0]["nombre"]); ?></h3>
							</div>
							<!-- /.box-header -->

							<div class="box-body">
								<div id="loader"></div><!-- Carga los datos ajax -->

								<div class="row">
									<div class="col-md-3">
										<div>
											<label for="fa_nombre">Grupos de interés <span class="text-red">*</span></label>
											<select class="selectpicker form-control" id="vg_entorno" name="vg_entorno"
												title="Grupo de interés" data-live-search="true" required onchange="selectEnvironment();">
												<?php
												foreach ($environments as $environment) {
													$labelName = "";
													if ($environment['descripcion'] == "Interno") {
														$labelName = "<span class=\"label bg-purple\">Interno</span>";
													} else {
														if ($environment['descripcion'] == "Externo") {
															$labelName = "<span class=\"label bg-maroon\">Externo</span>";
														}
													}
													echo "<option value='" . $environment['id'] . "' " . $environment['selected'] . " data-subtext='$labelName' >" . $environment['nombre'] . "</option>";
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-xs-6 col-md-3">
										<label for="vg_entorno_sub">Sub grupo de interés <span class="text-red">*</span></label>
										<select class="selectpicker form-control" id="vg_entorno_sub" name="vg_entorno_sub"
											title="Sub grupo de interés" required data-live-search="true" >
										</select>
									</div>
									<datalist id="details">
										<?php
										foreach ($environment_details as $environment_detail) {
											echo "<option value='" . $environment_detail['nombre'] . "'>";
										}
										?>
									</datalist>
									<div class="col-sm-2">
										<label for="vg_nombre">Participantes <span class="text-red">*</span></label>
										<input onkeyup="parse();" type="text" id="tags_input" required name="tags_input" placeholder="Separadas por coma" maxlength="100" class="form-control" list="details">
									</div>
									<div class="col-sm-2" id="tags" name="tags">
									</div>
									<div class="col-xs-6 col-md-1">
										<label for="vg_entorno_sub">&nbsp;</label>
										<a class='btn btn-orange btn-sm pull-left' title='Agregar entorno' onclick="addEnvironment()">
											<i class="glyphicon glyphicon-plus"></i> Agregar
										</a>
									</div>

									<div class="col-xs-12 col-md-12">
										<h4>Entornos esperados</h4>
										<div id="entornos_load"></div>
										<div id="entornos_esperados"></div>
										<br>
									</div>
								</div>

								<form class="form-horizontal" method="post" id="edit_initiative_step2" name="edit_initiative_step2">
									<?php echo "<input type='hidden' value='" . $nombre_usuario . "' id='vg_usuario' name='vg_usuario' />"; ?>
									<?php echo "<input type='hidden' value='" . base64_encode($id) . "' id='vg_id' name='vg_id' />"; ?>
									<?php echo "<input type='hidden' value='' id='vg_entorno_detalle' name='vg_entorno_detalle' />"; ?>

									<!-- <div id="loader2"></div> --><!-- Carga los datos ajax -->
									<!-- <div class="row"> -->
										<!--<div class="col-md-12">
											<label for="vg_objetivo">Objetivo (desafío identificado) </label>
											<textarea class="form-control textarea" placeholder="Objetivo de la actividad (desafío identificado)" id="vg_objetivo" name="vg_objetivo" minlength=0
												title="Objetivo de la actividad (desafío identificado)"
												style="width: 100%; height: 90px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">//?php echo$datas[0]["objetivo"];?></textarea>
										</div> -->
									<div id="loader2"></div>
									<div class="row">
										<div class="col-md-12">
											<label for="vg_descripcion">Resumen de la iniciativa <span class="text-red">*</span></label>
											<textarea class="form-control textarea" placeholder="Aqui escriba el resumen de la iniciativa" required id="vg_descripcion" name="vg_descripcion"
												title="Aqui escriba el resumen de la iniciativa" minlength=0
												style="width: 100%; height: 90px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"><?php echo$datas[0]["descripcion"];?></textarea>
										</div>

										<div class="col-md-12">
											<label for="vg_tipo_impacto_interno">Impacto interno asociado a la política <span class="text-red">*</span></label>
											<select class="selectpicker form-control" id="vg_tipo_impacto_interno[]" required name="vg_tipo_impacto_interno[]" title="Tipo de impacto interno" multiple data-live-search="true">
												<?php
												$labelName = "<span class=\"label bg-purple\">Interno</span>";
												foreach ($internalImpactTypes as $internalImpactType) {
													echo "<option value='" . $internalImpactType['id'] . "' " . $internalImpactType['selected'] . " data-subtext='$labelName'>" . $internalImpactType['nombre'] . "</option>";
												}
												?>
											</select>
										</div>
										<!--div class="col-md-12">
											<textarea class="form-control textarea" placeholder="¿Cómo logrará el impacto interno?" id="vg_impacto_interno" name="vg_impacto_interno" minlength=0
												style="width: 100%; height: 60px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"><?php echo $datas[0]["impacto_logrado_interno"]; ?></textarea>
										</div-->

										<div class="col-md-12">
											<label for="vg_tipo_impacto_externo">Impacto externo asociado a la política <span class="text-red">*</span></label>
											<select class="selectpicker form-control" id="vg_tipo_impacto_externo[]" required name="vg_tipo_impacto_externo[]" title="Tipo de impacto externo" multiple data-live-search="true">
												<?php
												$labelName = "<span class=\"label bg-maroon\">Externo</span>";
												foreach ($externalImpactTypes as $externalImpactType) {
													echo "<option value='" . $externalImpactType['id'] . "' " . $externalImpactType['selected'] . " data-subtext='$labelName'>" . $externalImpactType['nombre'] . "</option>";
												}
												?>
											</select>
										</div>
									</div>
									<br>
									<div class="row">
										<!--<div class="col-xs-12 col-md-6">
											<h4>Resultados esperados</h4>
											<div class="row" id="divAddResult">
												<div class="col-xs-3 col-md-3">
													<label for="vg_programa" class="small">¿Interno o Externo? <span class="text-red">*</span></label>
													<select class="form-control selectpicker" id="vg_resultado_tipo" name="vg_resultado_tipo"
														title="¿Int. o Ext.?" >
														<option>Interno</option>
														<option>Externo</option>
													</select>
												</div>
												<div class="col-xs-2 col-md-2">
			                		<label for="vg_resultado_cantidad" class="small">Cuantif. <span class="text-red">*</span></label>
			                  	<input type="text" class="form-control" id="vg_resultado_cantidad" name="vg_resultado_cantidad"
														placeholder="Cant." >
			                	</div>
												<div class="col-xs-7 col-md-5">
			                		<label for="vg_resultado_texto" class="small">Resultado <span class="text-red">*</span></label>
			                  	<input type="text" class="form-control" id="vg_resultado_texto" name="vg_resultado_texto"
														placeholder="Resultado esperado">
			                	</div>
												<div class="col-xs-1 col-md-1 pull-left">
			                		<label for="vg_fecha_inicio">&nbsp;</label>
													<a class='btn btn-orange btn-sm' title='Agregar resultado esperado' onclick="addResult()">
														<i class="glyphicon glyphicon-plus"></i>
													</a>
			                	</div>
											</div>
											<div id="resultados_load"></div>
											<div id="resultados_esperados"></div>
										</div> -->

										<!-- <div class="col-xs-12 col-md-6">
											<h4>Impactos esperados</h4>
											<div class="row" id="divAddImpact">
												<div class="col-xs-3 col-md-3">
													<label for="vg_programa" class="small">¿Interno o Externo? <span class="text-red">*</span></label>
													<select class="form-control selectpicker" id="vg_impacto_tipo" name="vg_impacto_tipo" title="¿Int. o Ext.?">
														<option>Interno</option>
														<option>Externo</option>
													</select>
												</div>
												<div class="col-xs-2 col-md-2">
													<label for="vg_impacto_cantidad" class="small">Cuantif.</label>
													<input type="text" class="form-control" id="vg_impacto_cantidad" name="vg_impacto_cantidad" placeholder="Cant.">
												</div>
												<div class="col-xs-7 col-md-5">
													<label for="vg_impacto_texto" class="small">Impacto <span class="text-red">*</span></label>
													<input type="text" class="form-control" id="vg_impacto_texto" name="vg_impacto_texto" placeholder="Impacto esperado">
												</div>
												<div class="col-xs-1 col-md-1">
													<label for="vg_fecha_inicio">&nbsp;</label>
													<a class='btn btn-orange btn-sm' title='Agregar impacto esperado' onclick="addImpact()">
														<i class="glyphicon glyphicon-plus"></i>
													</a>
												</div>
											</div>
											<div id="impactos_load"></div>
											<div id="impactos_esperados"></div>
										</div>

									</div> -->

									<br>
									<div class="modal-footer">
										<a href="view_initiatives_plan.php" class="btn btn-default" data-dismiss="modal">Ir al listado</a>
										<a href="edit_initiative_plan_step1.php?data=<?php echo $dataEncoded; ?>" class="btn btn-orange" data-dismiss="modal"> <i class="fa fa-fw fa-chevron-left"></i> Volver al paso anterior</a>
										<button type="submit" class="btn btn-orange"><i class="fa fa-fw fa-save"></i><i class="fa fa-fw fa-chevron-right"></i> Siguiente</button>
									</div>

								</form>

								<hr style="height: 2px; border: 0;" class="btn-orange" />


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

		<?php include_once("../include/footer.php") ?>
	</div>
	<!-- ./wrapper -->

	<script>
		$(document).ready(function() {
			loadEnvironments();
			loadResults();
			loadImpacts();
		});

		function addEnvironment() {
			var tags = document.getElementById("tags");
			var elements = document.getElementById("tags").getElementsByClassName("bg-blue");
			var text_detail = "";
			for (var i = 0; i < elements.length; i++) {
				var span = elements[i].innerHTML;
				if (i == 0) {
					text_detail += (span);
				} else {
					text_detail += ("," + span);
				}
			}

			if ($("#vg_entorno").val() != "" && $("#vg_entorno_sub").val() != "") {
				var parametros = {
					"id_initiative": btoa('<?php echo $id; ?>'),
					"environment": btoa($("#vg_entorno").val()),
					"environmentsub": btoa($("#vg_entorno_sub").val()),
					"tags": text_detail,
					"author": '<?php echo $nombre_usuario; ?>'
				};

				$.ajax({
					type: "POST",
					url: './ajax_add_environment_plan.php',
					data: parametros,
					beforeSend: function() {
						$('#entornos_load').html('<img src="../../img/ajax-loader.gif"> Cargando...');
					},
					success: function(response) {
						$('#entornos_load').html(response);
						$("#vg_entorno").selectpicker("val", "");
						$("#vg_entorno_sub").selectpicker("val", "");
						$("#tags_input").val("")
						$("#tags").html("");

						loadEnvironments();
					},
					error: function() {
						$("#entornos_load").html("error.");
					}
				});
			} else {
				$('#entornos_load').html('<div class="alert alert-warning alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button> Debe seleccionar entorno y sub entorno. </div>');
			}
		}

		function removeTag(id, id_iniciativa, id_entorno, id_entorno_sub, tag) {
			var parametros = {
				"id": id,
				"id_initiative": id_iniciativa,
				"environment": id_entorno,
				"environmentsub": id_entorno_sub,
				"tag": tag,
				"author": '<?php echo $nombre_usuario; ?>'
			};

			$.ajax({
				type: "POST",
				url: './ajax_delete_environment_plan_tag.php',
				data: parametros,
				beforeSend: function() {
					$('#entornos_load').html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(response) {
					$('#entornos_load').html(response);

					loadEnvironments();
				},
				error: function() {
					$("#entornos_load").html("error.");
				}
			});
		}

		function removeSubEnv(id_iniciativa, id_entorno, id_entorno_sub) {
			var parametros = {
				"id_initiative": id_iniciativa,
				"environment": id_entorno,
				"environmentsub": id_entorno_sub,
				"author": '<?php echo $nombre_usuario; ?>'
			};

			$.ajax({
				type: "POST",
				url: './ajax_delete_environment_plan_envsub.php',
				data: parametros,
				beforeSend: function() {
					$('#entornos_load').html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(response) {
					$('#entornos_load').html(response);

					loadEnvironments();
				},
				error: function() {
					$("#entornos_load").html("error.");
				}
			});
		}

		function removeEnv(id_iniciativa, id_entorno) {
			var parametros = {
				"id_initiative": id_iniciativa,
				"environment": id_entorno,
				"author": '<?php echo $nombre_usuario; ?>'
			};

			$.ajax({
				type: "POST",
				url: './ajax_delete_environment_plan_env.php',
				data: parametros,
				beforeSend: function() {
					$('#entornos_load').html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(response) {
					$('#entornos_load').html(response);

					loadEnvironments();
				},
				error: function() {
					$("#entornos_load").html("error.");
				}
			});
		}

		function loadEnvironments() {
			var parametros = {
				"id_initiative": '<?php echo noeliaEncode($id); ?>'
			};

			$.ajax({
				type: "POST",
				url: './ajax_view_environment_plan.php',
				data: parametros,
				beforeSend: function() {
					$("#entornos_esperados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(response) {
					$("#entornos_esperados").html(response);
				},
				error: function() {
					//$('#loader').html('');
					$("#entornos_esperados").html(response);
				}
			});
		}

		function selectEnvironment() {
			var parametros = $("#vg_entorno").serialize();

			$.ajax({
				type: "POST",
				url: '../json/json_environment_subs.php',
				data: parametros,
				beforeSend: function() {
					$("#loader").html("Realizando búsqueda, espere por favor.");
				},
				success: function(response) {
					$("#loader").html("");

					var myJSON = JSON.parse(response);
					var options = "";
					for (var i = 0; i < myJSON.length; i++) {
						var region = myJSON[i];
						options += '<option value="' + region.id + '" title="' + region.nombre + '">' + region.nombre + '</option>';
					}

					$("#vg_entorno_sub")
						.html(options)
						.selectpicker('refresh');
				},
				error: function() {
					$("#loader").html(response);
				}
			});

		}

		$("#edit_initiative_step2").submit(function(event) {
			$('#edit_initiative_step2').attr("disabled", true);

			var tags = document.getElementById("tags");
			var elements = document.getElementById("tags").getElementsByClassName("bg-blue");
			var text_detail = "";
			for (var i = 0; i < elements.length; i++) {
				var span = elements[i].innerHTML;
				if (i == 0) {
					text_detail += (span);
				} else {
					text_detail += ("," + span);
				}
			}
			$('#vg_entorno_detalle').val(text_detail);

			var parametros = $(this).serialize();

			$.ajax({
				type: "POST",
				url: "./ajax_edit_initiative_plan_step2.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#loader2").html("Cargando...");
				},
				success: function(datos) {
					if (datos.includes("Iniciativa guardada correctamente")) {
						$("#loader2").html(datos);

						sleep(1000).then(() => {
							var data = "<?php echo $dataEncoded ?>";
							window.location.href = "./edit_initiative_plan_step3.php?data=" + data;
						});
					} else {
						$("#loader2").html(datos);
					}

				},
				error: function() {
					$("#loader2").html("Error en el registro");
				}
			});

			event.preventDefault();
		})

		const sleep = (milliseconds) => {
			return new Promise(resolve => setTimeout(resolve, milliseconds))
		}

		function parse() {
			var tag_input = document.getElementById("tags_input");
			var tags = document.getElementById("tags");
			//
			var input_val = tag_input.value.trim();
			var no_comma_val = input_val.replace(/,/g, "");
			//
			if (input_val.slice(-1) === "," && no_comma_val.length > 0) {
				var new_tag = compile_tag(no_comma_val);
				tags.appendChild(new_tag);
				tag_input.value = "";
			}
		}

		function compile_tag(tag_content) {
			var tag = document.createElement("div");
			//
			var text = document.createElement("span");
			text.setAttribute("class", "label bg-blue");
			text.innerHTML = tag_content;
			//
			var remove = document.createElement("i");
			remove.setAttribute("class", "fa fa-remove");
			remove.setAttribute("id", "remove");
			remove.onclick = function() {
				this.parentNode.remove();
			};
			//
			tag.appendChild(remove);
			tag.appendChild(text);
			//
			return tag;
		}

		function removeItem(div_id) {
			const element = document.getElementById(div_id);
			element.remove();
		}

		/* RESULTADOS */
	//	function addResult() {
	//		var parametros = {
	//			"id_initiative": btoa(' ?php echo $id; ?>'),
	//			"tipo": $("#divAddResult #vg_resultado_tipo").val(),
	//			"cantidad": $("#divAddResult #vg_resultado_cantidad").val(),
	//			"texto": $("#divAddResult #vg_resultado_texto").val(),
	//			"autor": btoa(' ?php echo noeliaDecode($nombre_usuario); ?>')
	//		};

	//		if ($("#divAddResult #vg_resultado_tipo").val() != "" && $("#divAddResult #vg_resultado_cantidad").val() != "" && $("#divAddResult #vg_resultado_texto").val() != "") {
	//			$.ajax({
	//				type: "POST",
	//				url: './ajax_add_expected_result.php',
	//				data: parametros,
	//				beforeSend: function() {
	//					$('#resultados_load').html('<img src="../../img/ajax-loader.gif"> Cargando...');
	//				},
	//				success: function(response) {
	//					$('#resultados_load').html('');
	//					$("#vg_resultado_tipo").selectpicker("val", "");
	//					$("#vg_resultado_cantidad").val("");
	//					$("#vg_resultado_texto").val("")
	//					loadResults();
	//				},
	//				error: function() {
	//					$("#resultados_load").html("error.");
	//				}
	//			});
	//		}
	//	}

		$("#delete_result").submit(function(event) {
			$('#delete_result').attr("disabled", true);
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "./ajax_delete_expected_result.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_modal_eliminar").html("Cargando...");
				},
				success: function(datos) {
					$('#delete_result').attr("disabled", false);
					$("#resultados_modal_eliminar").html("");

					$('#deleteResult').modal('hide');
					loadResults();
				},
				error: function() {
					$("#resultados_modal_eliminar").html("Error en el registro");
				}
			});

			event.preventDefault();
		})

		$('#deleteResult').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var id_resultado = button.data('id_resultado');
			var resultado = button.data('resultado');

			var modal = $(this);
			modal.find('.modal-body #id_resultado').val(id_resultado);
			modal.find('.modal-body #vg_resultado').html(resultado);

			$("#resultados_modal_eliminar").html("");
		})

		$('#editResult').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var id = button.data('id');
			var tipo = button.data('tipo');
			var cantidad = button.data('cantidad');
			var resultado = button.data('resultado');

			var modal = $(this);
			modal.find('.modal-body #vg_id').val(id);
			modal.find('.modal-body #vg_resultado_tipo').selectpicker("val", tipo);
			modal.find('.modal-body #vg_resultado_cantidad').val(cantidad);
			modal.find('.modal-body #vg_resultado_texto').val(resultado);

			$("#resultados_modal_editar_resultado").html("");
		})

		$("#edit_result").submit(function(event) {
			$('#edit_result').attr("disabled", true);
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "./ajax_edit_expected_result.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_modal_editar_resultado").html("Cargando...");
				},
				success: function(datos) {
					$('#edit_result').attr("disabled", false);
					$("#resultados_modal_editar_resultado").html("");

					$('#editResult').modal('hide');
					loadResults();
				},
				error: function() {
					$("#resultados_modal_editar_resultado").html("Error en el registro");
				}
			});

			event.preventDefault();
		})

		function loadResults() {
			var parametros = {
				"id_initiative": btoa('<?php echo $id; ?>')
			};

			$.ajax({
				type: "POST",
				url: './ajax_view_expected_result.php',
				data: parametros,
				beforeSend: function() {
					$("#resultados_esperados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(response) {
					$("#resultados_esperados").html(response);
				},
				error: function() {
					//$('#loader').html('');
					$("#resultados_esperados").html(response);
				}
			});
		}

		/* IMPACTOS */
		function addImpact() {
			var parametros = {
				"id_initiative": btoa('<?php echo $id; ?>'),
				"tipo": $("#divAddImpact #vg_impacto_tipo").val(),
				"cantidad": $("#divAddImpact #vg_impacto_cantidad").val(),
				"texto": $("#divAddImpact #vg_impacto_texto").val(),
				"autor": btoa('<?php echo noeliaDecode($nombre_usuario); ?>')
			};

			if ($("#divAddImpact #vg_impacto_tipo").val() != "" && $("#divAddImpact #vg_impacto_texto").val() != "") {
				$.ajax({
					type: "POST",
					url: './ajax_add_expected_impact.php',
					data: parametros,
					beforeSend: function() {
						$('#impactos_load').html('<img src="../../img/ajax-loader.gif"> Cargando...');
					},
					success: function(response) {
						$('#impactos_load').html('');
						$("#vg_impacto_tipo").selectpicker("val", "");
						$("#vg_impacto_cantidad").val("");
						$("#vg_impacto_texto").val("")
						loadImpacts();
					},
					error: function() {
						$("#impactos_load").html("error.");
					}
				});
			}
		}

		$("#delete_impact").submit(function(event) {
			$('#delete_impact').attr("disabled", true);
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "./ajax_delete_expected_impact.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#impactos_modal_eliminar").html("Cargando...");
				},
				success: function(datos) {
					$('#delete_impact').attr("disabled", false);
					$("#impactos_modal_eliminar").html("");

					$('#deleteImpact').modal('hide');
					loadImpacts();
				},
				error: function() {
					$("#impactos_modal_eliminar").html("Error en el registro");
				}
			});

			event.preventDefault();
		})

		$('#deleteImpact').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var id_impacto = button.data('id_impacto');
			var impacto = button.data('impacto');

			var modal = $(this);
			modal.find('.modal-body #id_impacto').val(id_impacto);
			modal.find('.modal-body #vg_impacto').html(impacto);

			$("#impactos_modal_eliminar").html("");
		})

		$('#editImpact').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var id = button.data('id');
			var tipo = button.data('tipo');
			var cantidad = button.data('cantidad');
			var impacto = button.data('impacto');

			var modal = $(this);
			modal.find('.modal-body #vg_id').val(id);
			modal.find('.modal-body #vg_impacto_tipo').selectpicker("val", tipo);
			modal.find('.modal-body #vg_impacto_cantidad').val(cantidad);
			modal.find('.modal-body #vg_impacto_texto').val(impacto);

			$("#resultados_modal_editar_impacto").html("");
		})

		$("#edit_impact").submit(function(event) {
			$('#edit_impact').attr("disabled", true);
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "./ajax_edit_expected_impact.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_modal_editar_impacto").html("Cargando...");
				},
				success: function(datos) {
					$('#edit_impact').attr("disabled", false);
					$("#resultados_modal_editar_impacto").html("");

					$('#editImpact').modal('hide');
					loadImpacts();
				},
				error: function() {
					$("#resultados_modal_editar_impacto").html("Error en el registro");
				}
			});

			event.preventDefault();
		})

		function loadImpacts() {
			var parametros = {
				"id_initiative": btoa('<?php echo $id; ?>')
			};

			$.ajax({
				type: "POST",
				url: './ajax_view_expected_impact.php',
				data: parametros,
				beforeSend: function() {
					$("#impactos_esperados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(response) {
					$("#impactos_esperados").html(response);
				},
				error: function() {
					//$('#loader').html('');
					$("#impactos_esperados").html(response);
				}
			});
		}
	</script>

</body>

</html>