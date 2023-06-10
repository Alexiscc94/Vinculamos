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
	$institution = getInstitution();

	$id = str_replace("data", "", noeliaDecode($_GET["data"]));

	include_once("../../controller/medoo_initiatives_plan.php");
	$datas = getInitiativePlan($id);
	$dataEncoded = noeliaEncode("data" . $datas[0]['id']);

	if($datas[0]["estado_ejecucion"] != "Finalizada") {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}


?>

<!DOCTYPE html>
<html>
<?php include_once("../include/header.php")?>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
	<?php
		$activeMenu = "initiatives";
		include_once("../include/menu_side.php");
		include_once("modal_edit_real_result.php");

		include_once("modal_edit_participation_real.php");
		include_once("modal_delete_participation_real.php");
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
        		<li class="active">Editar Iniciativa - Resultados y cobertura</li>
      		</ol>
    	</section>

    	<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
	    						<h3 class="box-title"><?php echo ($datas[0]["nombre"] == "" ? "Editar iniciativa" : $datas[0]["nombre"]);?> - Resultados y cobertura</h3>
							</div>
							<!-- /.box-header -->

							<div class="box-body">
								<div class="row">
									<div class="col-xs-12 col-md-12">
										<h4>Resultados reales</h4>
										<div id='loader'></div>

										<div id="resultados_reales"></div>
									</div>
								</div>

								<br>

								<div class="row">
									<div class="col-xs-12 col-md-12">
										<h4>Participantes reales</h4>
										<div id='loader2'></div>

										<form class="form-horizontal" method="post" id="add_persons" name="add_persons">
											<?php echo "<input type='hidden' value='".$nombre_usuario."' id='vg_autor' name='vg_autor' />"; ?>
											<?php echo "<input type='hidden' value='".noeliaEncode($id)."' id='vg_id' name='vg_id' />"; ?>
											<?php echo "<input type='hidden' value='' id='vg_participacion_detalle' name='vg_participacion_detalle' />"; ?>

											<div class="col-md-12">
												<div class="row">
													<div class="col-xs-6 col-md-2">
														<label for="vg_programa">¿Interno o Externo? <span class="text-red">*</span></label>
														<select class="form-control selectpicker" id="vg_tipo" name="vg_tipo" required
															title="¿Interno o Externo?" onchange="selectParticitationType();">
															<option>Interno</option>
															<option>Externo</option>
														</select>
													</div>

													<div class="col-xs-6 col-md-2">
														<label for="vg_programa">Público esperado <span class="text-red">*</span></label>
														<select class="form-control selectpicker" id="vg_tipo_asistente" name="vg_tipo_asistente" required
															title="Público esperado">
														</select>
													</div>
													<div class="col-xs-6 col-md-2">
														<label for="fa_nombre">Número de personas <span class="text-red">*</span></label>
														<input type="number" class="form-control" id="vg_publico_general" name="vg_publico_general"
															placeholder="Número de personas" maxlength="100" required>
													</div>

												</div>
												<div class="row">
													<div class="col-xs-6 col-md-2">
														<input type="checkbox" id="checkbox_sexo" name="checkbox_sexo"><label for="vg_programa">&nbsp;¿Género?</label>
														<input type="number" class="form-control" id="vg_sexo_masculino" name="vg_sexo_masculino"
															placeholder="Hombre" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_sexo_femenino" name="vg_sexo_femenino"
															placeholder="Mujer" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_sexo_otro" name="vg_sexo_otro"
															placeholder="Otro" maxlength="100" readonly>
													</div>
													<div class="col-xs-6 col-md-2">
														<input type="checkbox" id="checkbox_edad" name="checkbox_edad"><label for="vg_programa">&nbsp;¿Segmento etario?</label>
														<input type="number" class="form-control" id="vg_edad_ninos" name="vg_edad_ninos"
															placeholder="Niños" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_edad_jovenes" name="vg_edad_jovenes"
															placeholder="Jóvenes" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_edad_adultos" name="vg_edad_adultos"
															placeholder="Adultos" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_edad_adultos_mayores" name="vg_edad_adultos_mayores"
															placeholder="Adultos Mayores" maxlength="100" readonly>
													</div>
													<div class="col-xs-6 col-md-2">
														<input type="checkbox" id="checkbox_procedencia" name="checkbox_procedencia"><label for="vg_programa">&nbsp;¿Procedencia?</label>
														<input type="number" class="form-control" id="vg_procedencia_rural" name="vg_procedencia_rural"
															placeholder="Rural" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_procedencia_urbano" name="vg_procedencia_urbano"
															placeholder="Urbano" maxlength="100" readonly>
													</div>
													<div class="col-xs-6 col-md-2">
														<input type="checkbox" id="checkbox_vulnerabilidad" name="checkbox_vulnerabilidad"><label for="vg_programa">&nbsp;¿Vulnerabilidad?</label>
														<input type="number" class="form-control" id="vg_vulnerabilidad_pueblo" name="vg_vulnerabilidad_pueblo"
															placeholder="Pueblo originario" maxlength="100" readonly style="display: none">
														<input type="number" class="form-control" id="vg_vulnerabilidad_discapacidad" name="vg_vulnerabilidad_discapacidad"
															placeholder="Discapacidad" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_vulnerabilidad_pobreza" name="vg_vulnerabilidad_pobreza"
														placeholder="Pobreza" maxlength="100" readonly>
													</div>
													<div class="col-xs-6 col-md-2">
														<input type="checkbox" id="checkbox_nacionalidad" name="checkbox_nacionalidad"><label for="vg_programa">&nbsp;¿Nacionalidad?</label>
														<input type="number" class="form-control" id="vg_nacionalidad_chileno" name="vg_nacionalidad_chileno"
															placeholder="Chileno" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_nacionalidad_migrante" name="vg_nacionalidad_migrante"
															placeholder="Migrante" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_nacionalidad_pueblo" name="vg_nacionalidad_pueblo"
														placeholder="Pueblo originario" maxlength="100" readonly style="display: none">
													</div>

													<div class="col-xs-6 col-md-2">
														<input type="checkbox" id="checkbox_etnia" name="checkbox_etnia"><label for="vg_programa">&nbsp;¿Adscripción a pueblos originarios?</label>
														<input type="number" class="form-control" id="vg_etnia_mapuche" name="vg_etnia_mapuche"
															placeholder="Mapuche" maxlength="100" readonly>
														<input type="number" class="form-control" id="vg_etnia_otro" name="vg_etnia_otro"
															placeholder="Otro" maxlength="100" readonly>
													</div>
												</div>
												<div class="row">
													<div class="ol-md-12 pull-right">
														<button type="submit" class="btn btn-orange"><span class="fa fa-plus"></span> Agregar</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>

								<br>

								<div id='participantes_reales'></div>

								<div class="modal-footer">
									<a href="view_initiatives_plan.php" class="btn btn-default" data-dismiss="modal">Ir al listado</a>
								</div>

								<hr style="height: 2px; border: 0;" class="btn-orange"/>
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
		loadResults();
		loadRealParticipation();
	});

	/* RESULTADOS */
	function loadResults() {
		var parametros = {
			"id_initiative" : btoa('<?php echo$id;?>')
    };

		$.ajax({
			type: "POST",
      url:'./ajax_view_real_result.php',
      data: parametros,
      beforeSend: function () {
        $("#resultados_reales").html('<img src="../../img/ajax-loader.gif"> Cargando...');
      },
      success:  function (response) {
        $("#resultados_reales").html(response);
      },
			error: function() {
				//$('#loader').html('');
				$("#resultados_reales").html(response);
			}
    });
	}

	$('#editResultReal').on('show.bs.modal', function (event) {
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

		$("#resultados_modal_editar_resultado_real").html("");
	})

	$("#edit_result_real").submit(function( event ) {
		$('#edit_result_real').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_edit_real_result.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_editar_resultado_real").html("Cargando...");
			},
			success: function(datos) {
				$('#edit_result_real').attr("disabled", false);
				$("#resultados_modal_editar_resultado_real").html("");

				$('#editResultReal').modal('hide');
				loadResults();
			},
			error: function() {
				$("#resultados_modal_editar_resultado_real").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	/* PARTICIPANTES */
	function selectParticitationType() {
		var parametros = {
			"id_initiative" : btoa('<?php echo$id;?>'),
			"type" : btoa($("#vg_tipo").val())
		};

		$.ajax({
			type: "POST",
      url:'../json/json_environment_tags.php',
			data: parametros,
      beforeSend: function () {
        $("#loader").html("Realizando búsqueda, espere por favor.");
      },
      success:  function (response) {
        $("#loader").html("");

				var myJSON = JSON.parse(response);
				var options = "";
        for (var i = 0; i < myJSON.length; i++) {
					var tags = myJSON[i];
					options += '<option value="' + tags.tag + '" title="' + tags.tag + '">' + tags.tag + '</option>';
				}
				options += "<option value='Público General' title='Público General'>Público General</option>";

      	$("#vg_tipo_asistente")
			   .html(options)
				 .selectpicker('refresh');
      },
			error: function() {
				$("#loader").html(response);
			}
		});
	}

	function selectParticitationTypeModal() {
		var parametros = {
			"id_initiative" : btoa('<?php echo$id;?>'),
			"type" : btoa($("#vg_modal_tipo").val())
		};

		$.ajax({
			type: "POST",
      url:'../json/json_environment_tags.php',
			data: parametros,
      beforeSend: function () {
        $("#loader").html("Realizando búsqueda, espere por favor.");
      },
      success:  function (response) {
        $("#loader").html("");

				var myJSON = JSON.parse(response);
				var options = "";
        for (var i = 0; i < myJSON.length; i++) {
					var tags = myJSON[i];
					options += '<option value="' + tags.tag + '" title="' + tags.tag + '">' + tags.tag + '</option>';
				}
				options += "<option value='Público General' title='Público General'>Público General</option>";

      	$("#vg_modal_tipo_asistente")
			   .html(options)
				 .selectpicker('refresh');
      },
			error: function() {
				$("#loader").html(response);
			}
		});
	}

	$("#add_persons").submit(function( event ) {
		$('#add_persons').attr("disabled", true);

		/*
		var tags = document.getElementById("tags");
		var elements = document.getElementById("tags").getElementsByClassName("bg-blue");
		var text_detail = "";
		for(var i=0; i<elements.length; i++) {
			var span = elements[i].innerHTML;
			if(i == 0) {
				text_detail += (span);
			} else {
				text_detail += ("," + span);
			}
		}
		$('#vg_participacion_detalle').val(text_detail);
		*/

		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_add_participation_real.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#loader2").html("Cargando...");
			},
			success: function(datos) {
				$("#loader2").html(datos);

				if(datos.includes("Participantes agregados correctamente")) {
					$("#vg_tipo").selectpicker("val", "");
					$("#vg_tipo_asistente").selectpicker("val", "");
					$("#vg_publico_general").val("");
					$("#tags_input").val("");
					$("#tags").html("");

					$("#checkbox_sexo").prop('checked', false);
					$("#vg_sexo_masculino").val("");
					$("#vg_sexo_femenino").val("");
					$("#vg_sexo_otro").val("");
					$("#checkbox_edad").prop('checked', false);
					$("#vg_edad_ninos").val("");
					$("#vg_edad_jovenes").val("");
					$("#vg_edad_adultos").val("");
					$("#vg_edad_adultos_mayores").val("");
					$("#checkbox_procedencia").prop('checked', false);
					$("#vg_procedencia_rural").val("");
					$("#vg_procedencia_urbano").val("");
					$("#checkbox_vulnerabilidad").prop('checked', false);
					$("#vg_vulnerabilidad_discapacidad").val("");
					$("#vg_vulnerabilidad_pobreza").val("");
					$("#checkbox_nacionalidad").prop('checked', false);
					$("#vg_nacionalidad_chileno").val("");
					$("#vg_nacionalidad_migrante").val("");
					$("#checkbox_etnia").prop('checked', false);
					$("#vg_etnia_mapuche").val("");
					$("#vg_etnia_otro").val("");

					loadRealParticipation();
				}

			},
			error: function() {
				$("#loader2").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	function loadRealParticipation() {
		var parametros = {
			"id_initiative" : btoa('<?php echo$id;?>')

    };
		var url = "./ajax_view_participation_real.php";
		$.ajax({
			type: "POST",
      url: url,
      data:  parametros,
      beforeSend: function () {
        $("#participantes_reales").html("Obteniendo información, espere por favor.");
      },
      success:  function (response) {
        $("#participantes_reales").html(response);
      },
			error: function() {
				$("#participantes_reales").html(response);
			}
    });
	}

	$("#delete_participation_real").submit(function( event ) {
		$('#delete_participation_real').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_delete_participation_real.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#loader2").html("Cargando...");
			},
			success: function(datos) {
				$("#loader2").html("");

				if(datos.includes("correctamente")) {
					$('#deleteParticipationReal').modal('hide');

					var tipo = '<?php echo$tipo;?>';
					loadRealParticipation();
				}
			},
			error: function() {
				$("#loader2").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#deleteParticipationReal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data('id');
		var id_iniciativa = button.data('id_iniciativa');
		var usuario = button.data('usuario');

		var modal = $(this);
		modal.find('.modal-body #vg_id').val(id);
		modal.find('.modal-body #vg_initiative').val(id_iniciativa);
		modal.find('.modal-body #vg_usuario').val(usuario);
		$("#resultados_modal_eliminar").html("");
	})

	$('#editParticipationReal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data('id');

		var tipo = button.data('tipo');
		var tipo2 = button.data('tipo2');
		var publico_general = button.data('publico_general');
		var aplica_sexo = button.data('aplica_sexo');
		var sexo_masculino = button.data('sexo_masculino');
		var sexo_femenino = button.data('sexo_femenino');
		var sexo_otro = button.data('sexo_otro');
		var aplica_edad = button.data('aplica_edad');
		var edad_ninos = button.data('edad_ninos');
		var edad_jovenes = button.data('edad_jovenes');
		var edad_adultos = button.data('edad_adultos');
		var edad_adultos_mayores = button.data('edad_adultos_mayores');
		var aplica_procedencia = button.data('aplica_procedencia');
		var procedencia_rural = button.data('procedencia_rural');
		var procedencia_urbano = button.data('procedencia_urbano');

		var aplica_vulnerabilidad = button.data('aplica_vulnerabilidad');
		var vulnerabilidad_discapacidad = button.data('vulnerabilidad_discapacidad');
		var vulnerabilidad_pobreza = button.data('vulnerabilidad_pobreza');

		var aplica_nacionalidad = button.data('aplica_nacionalidad');
		var nacionalidad_chileno = button.data('nacionalidad_chileno');
		var nacionalidad_migrante = button.data('nacionalidad_migrante');

		var aplica_etnia = button.data('aplica_etnia');
		var etnia_mapuche = button.data('etnia_mapuche');
		var etnia_otro = button.data('etnia_otro');

		var usuario = button.data('usuario');

		var modal = $(this);
		modal.find('.modal-body #vg_modal_id').val(id);

		modal.find('.modal-body #vg_modal_tipo').selectpicker("val", tipo);

		var parametros = {
			"id_initiative" : btoa('<?php echo$id;?>'),
			"type" : btoa(tipo)
		};
		$.ajax({
			type: "POST",
      url:'../json/json_environment_tags.php',
			data: parametros,
      beforeSend: function () {
        $("#loader").html("Realizando búsqueda, espere por favor.");
      },
      success:  function (response) {
        $("#loader").html("");

				var myJSON = JSON.parse(response);
				var options = "";
        for (var i = 0; i < myJSON.length; i++) {
					var tags = myJSON[i];
					options += '<option value="' + tags.tag + '" title="' + tags.tag + '">' + tags.tag + '</option>';
				}
				options += "<option value='Público General' title='Público General'>Público General</option>";

      	$("#vg_modal_tipo_asistente")
			   .html(options)
				 .selectpicker('refresh');

				modal.find('.modal-body #vg_modal_tipo_asistente').selectpicker("val", tipo2);
      },
			error: function() {
				$("#loader").html(response);
			}
		});

		modal.find('.modal-body #vg_modal_publico_general').val(atob(publico_general));

		if(aplica_sexo == btoa("on")) {
			modal.find('.modal-body #checkbox_modal_sexo').prop("checked", true );
			modal.find('.modal-body #vg_modal_sexo_masculino').val(atob(sexo_masculino)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_sexo_femenino').val(atob(sexo_femenino)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_sexo_otro').val(atob(sexo_otro)).prop('readonly', false);
		} else {
			modal.find('.modal-body #checkbox_modal_sexo').prop("checked", false );
			modal.find('.modal-body #vg_modal_sexo_masculino').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_sexo_femenino').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_sexo_otro').val("").prop('readonly', true);
		}

		if(aplica_edad == btoa("on")) {
			modal.find('.modal-body #checkbox_modal_edad').prop("checked", true );
			modal.find('.modal-body #vg_modal_edad_ninos').val(atob(edad_ninos)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_edad_jovenes').val(atob(edad_jovenes)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_edad_adultos').val(atob(edad_adultos)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_edad_adultos_mayores').val(atob(edad_adultos_mayores)).prop('readonly', false);
		} else {
			modal.find('.modal-body #checkbox_modal_edad').prop("checked", false );
			modal.find('.modal-body #vg_modal_edad_ninos').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_edad_jovenes').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_edad_adultos').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_edad_adultos_mayores').val("").prop('readonly', true);
		}

		if(aplica_procedencia == btoa("on")) {
			modal.find('.modal-body #checkbox_modal_procedencia').prop("checked", true );
			modal.find('.modal-body #vg_modal_procedencia_rural').val(atob(procedencia_rural)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_procedencia_urbano').val(atob(procedencia_urbano)).prop('readonly', false);
		} else {
			modal.find('.modal-body #checkbox_modal_procedencia').prop("checked", false );
			modal.find('.modal-body #vg_modal_procedencia_rural').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_procedencia_urbano').val("").prop('readonly', true);
		}

		if(aplica_vulnerabilidad == btoa("on")) {
			modal.find('.modal-body #checkbox_modal_vulnerabilidad').prop("checked", true );
			modal.find('.modal-body #vg_modal_vulnerabilidad_discapacidad').val(atob(vulnerabilidad_discapacidad)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_vulnerabilidad_pobreza').val(atob(vulnerabilidad_pobreza)).prop('readonly', false);
		} else {
			modal.find('.modal-body #checkbox_modal_vulnerabilidad').prop("checked", false );
			modal.find('.modal-body #vg_modal_vulnerabilidad_discapacidad').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_vulnerabilidad_pobreza').val("").prop('readonly', true);
		}

		if(aplica_nacionalidad == btoa("on")) {
			modal.find('.modal-body #checkbox_modal_nacionalidad').prop("checked", true );
			modal.find('.modal-body #vg_modal_nacionalidad_chileno').val(atob(nacionalidad_chileno)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_nacionalidad_migrante').val(atob(nacionalidad_migrante)).prop('readonly', false);
		} else {
			modal.find('.modal-body #checkbox_modal_nacionalidad').prop("checked", false );
			modal.find('.modal-body #vg_modal_nacionalidad_chileno').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_nacionalidad_migrante').val("").prop('readonly', true);
		}

		if(aplica_etnia == btoa("on")) {
			modal.find('.modal-body #checkbox_modal_etnia').prop("checked", true );
			modal.find('.modal-body #vg_modal_etnia_mapuche').val(atob(etnia_mapuche)).prop('readonly', false);
			modal.find('.modal-body #vg_modal_etnia_otro').val(atob(etnia_otro)).prop('readonly', false);
		} else {
			modal.find('.modal-body #checkbox_modal_etnia').prop("checked", false );
			modal.find('.modal-body #vg_modal_etnia_mapuche').val("").prop('readonly', true);
			modal.find('.modal-body #vg_modal_etnia_otro').val("").prop('readonly', true);
		}

		$("#resultados_modal_editar_real").html("");

	})

	$("#edit_participation_real").submit(function( event ) {
		$('#edit_participation_real').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_edit_participation_real.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_editar_real").html("Cargando...");
			},
			success: function(datos) {
				$("#resultados_modal_editar_real").html(datos);

				if(datos.includes("Participante actualizado correctamente")) {
					loadRealParticipation();
				}
			},
			error: function() {
				$("#resultados_modal_editar_real").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#checkbox_sexo').on('change', function() {
		$("#vg_sexo_masculino").prop('readonly', !this.checked);
		$("#vg_sexo_femenino").prop('readonly', !this.checked);
		$("#vg_sexo_otro").prop('readonly', !this.checked);
	});

	$('#checkbox_edad').on('change', function() {
		$("#vg_edad_ninos").prop('readonly', !this.checked);
		$("#vg_edad_jovenes").prop('readonly', !this.checked);
		$("#vg_edad_adultos").prop('readonly', !this.checked);
		$("#vg_edad_adultos_mayores").prop('readonly', !this.checked);
	});

	$('#checkbox_procedencia').on('change', function() {
		$("#vg_procedencia_rural").prop('readonly', !this.checked);
		$("#vg_procedencia_urbano").prop('readonly', !this.checked);
	});

	$('#checkbox_vulnerabilidad').on('change', function() {
		$("#vg_vulnerabilidad_discapacidad").prop('readonly', !this.checked);
		$("#vg_vulnerabilidad_pobreza").prop('readonly', !this.checked);
	});

	$('#checkbox_nacionalidad').on('change', function() {
		$("#vg_nacionalidad_chileno").prop('readonly', !this.checked);
		$("#vg_nacionalidad_migrante").prop('readonly', !this.checked);
		$("#vg_nacionalidad_pueblo").prop('readonly', !this.checked);
	});

	$('#checkbox_etnia').on('change', function() {
		$("#vg_etnia_mapuche").prop('readonly', !this.checked);
		$("#vg_etnia_otro").prop('readonly', !this.checked);
	});

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
		remove.onclick = function() {this.parentNode.remove();};
		//
		tag.appendChild(remove);
		tag.appendChild(text);
		//
		return tag;
	}
</script>

</body>
</html>
