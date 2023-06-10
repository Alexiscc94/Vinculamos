<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	session_start();
	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}

	include_once("../../utils/user_utils.php");
	if(!canUpdateInitiatives()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$institucion = getInstitution();

	// vg_modal_autor, vg_modal_id
	// vg_modal_tipo_asistente, vg_modal_publico_general,
	// checkbox_modal_sexo, vg_modal_sexo_masculino, vg_modal_sexo_femenino, vg_modal_sexo_otro
	// checkbox_modal_edad, vg_modal_edad_ninos, vg_modal_edad_jovenes, vg_modal_edad_adultos, vg_modal_edad_adultos_mayores
	// checkbox_modal_procedencia, vg_modal_procedencia_rural, vg_modal_procedencia_urbano
	// checkbox_modal_vulnerabilidad, vg_modal_vulnerabilidad_pueblo, vg_modal_vulnerabilidad_discapacidad, vg_modal_vulnerabilidad_pobreza
	if(false) {
		echo "<br> vg_modal_usuario: " . noeliaDecode($_REQUEST['vg_modal_usuario']);
		echo "<br> vg_modal_id: " . noeliaDecode($_REQUEST['vg_modal_id']);
		echo "<br> vg_modal_initiative: " . noeliaDecode($_REQUEST['vg_modal_initiative']);
		echo "<br> vg_modal_tipo_asistente: " . $_REQUEST['vg_modal_tipo_asistente'];
		echo "<br> vg_modal_publico_general: " . $_REQUEST['vg_modal_publico_general'];
		echo "<br> checkbox_modal_sexo: " . $_REQUEST['checkbox_modal_sexo'];
		echo "<br> vg_modal_sexo_masculino: " . $_REQUEST['vg_modal_sexo_masculino'];
		echo "<br> vg_modal_sexo_femenino: " . $_REQUEST['vg_modal_sexo_femenino'];
		echo "<br> vg_modal_sexo_otro: " . $_REQUEST['vg_modal_sexo_otro'];
		echo "<br> checkbox_modal_edad: " . $_REQUEST['checkbox_modal_edad'];
		echo "<br> vg_modal_edad_ninos: " . $_REQUEST['vg_modal_edad_ninos'];
		echo "<br> vg_modal_edad_jovenes: " . $_REQUEST['vg_modal_edad_jovenes'];
		echo "<br> vg_modal_edad_adultos: " . $_REQUEST['vg_modal_edad_adultos'];
		echo "<br> vg_modal_edad_adultos_mayores: " . $_REQUEST['vg_modal_edad_adultos_mayores'];
		echo "<br> checkbox_modal_procedencia: " . $_REQUEST['checkbox_modal_procedencia'];
		echo "<br> vg_modal_procedencia_rural: " . $_REQUEST['vg_modal_procedencia_rural'];
		echo "<br> vg_modal_procedencia_urbano: " . $_REQUEST['vg_modal_procedencia_urbano'];

		echo "<br> checkbox_modal_vulnerabilidad: " . $_REQUEST['checkbox_modal_vulnerabilidad'];
		echo "<br> vg_modal_vulnerabilidad_discapacidad: " . $_REQUEST['vg_modal_vulnerabilidad_discapacidad'];
		echo "<br> vg_modal_vulnerabilidad_pobreza: " . $_REQUEST['vg_modal_vulnerabilidad_pobreza'];

		echo "<br> checkbox_modal_nacionalidad: " . $_REQUEST['checkbox_modal_nacionalidad'];
		echo "<br> vg_modal_nacionalidad_chileno: " . $_REQUEST['vg_modal_nacionalidad_chileno'];
		echo "<br> vg_modal_nacionalidad_migrante: " . $_REQUEST['vg_modal_nacionalidad_migrante'];

		echo "<br> checkbox_modal_etnia: " . $_REQUEST['checkbox_modal_etnia'];
		echo "<br> vg_modal_etnia_mapuche: " . $_REQUEST['vg_modal_etnia_mapuche'];
		echo "<br> vg_modal_etnia_otro: " . $_REQUEST['vg_modal_etnia_otro'];
		//return;
	}

	if( isset($_REQUEST['vg_modal_id']) && isset($_REQUEST['vg_modal_tipo_asistente']) && isset($_REQUEST['vg_modal_publico_general'])
		//isset($_REQUEST['vg_modal_sexo_masculino']) && isset($_REQUEST['vg_modal_sexo_femenino']) && isset($_REQUEST['vg_modal_sexo_otro']) &&
	  //isset($_REQUEST['vg_modal_edad_ninos']) && isset($_REQUEST['vg_modal_edad_jovenes']) && isset($_REQUEST['vg_modal_edad_adultos']) && isset($_REQUEST['vg_modal_edad_adultos_mayores']) &&
	 	//isset($_REQUEST['vg_modal_procedencia_rural']) && isset($_REQUEST['vg_modal_procedencia_urbano']) &&
		//isset($_REQUEST['vg_modal_vulnerabilidad_pueblo']) && isset($_REQUEST['vg_modal_vulnerabilidad_discapacidad']) && isset($_REQUEST['vg_modal_vulnerabilidad_pobreza']) && isset($_REQUEST['vg_modal_autor'])
	) {

		$publico_general = intval($_REQUEST['vg_modal_publico_general']);
		if($_REQUEST['checkbox_modal_sexo'] == "on") {
			$total_sexo = intval($_REQUEST['vg_modal_sexo_masculino']) + intval($_REQUEST['vg_modal_sexo_femenino']) + intval($_REQUEST['vg_modal_sexo_otro']);
			if($publico_general != $total_sexo) { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					El detalle ingresado en sexo no coincide con cantidad total de participantes. Por favor revisar.
				</div>
			<?php
				return;
			}
		}

		if($_REQUEST['checkbox_modal_edad'] == "on") {
			$total_edad = intval($_REQUEST['vg_modal_edad_ninos']) + intval($_REQUEST['vg_modal_edad_jovenes']) + intval($_REQUEST['vg_modal_edad_adultos']) + intval($_REQUEST['vg_modal_edad_adultos_mayores']);
			if($publico_general != $total_edad) { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					El detalle ingresado en grupo etario no coincide con cantidad total de participantes. Por favor revisar.
				</div>
			<?php
				return;
			}
		}

		if($_REQUEST['checkbox_modal_procedencia'] == "on") {
			$total_procedencia = intval($_REQUEST['vg_modal_procedencia_rural']) + intval($_REQUEST['vg_modal_procedencia_urbano']);
			if($publico_general != $total_procedencia) { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					El detalle ingresado en procedencia no coincide con cantidad total de participantes. Por favor revisar.
				</div>
			<?php
				return;
			}
		}

		if($_REQUEST['checkbox_modal_vulnerabilidad'] == "on") {
			$validador = true;
			if(intval($_REQUEST['vg_modal_vulnerabilidad_discapacidad']) > $publico_general) {
				$validador = false;
			}
			if(intval($_REQUEST['vg_modal_vulnerabilidad_pobreza']) > $publico_general) {
				$validador = false;
			}

			if($validador == false) { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Cada detalle ingresado en factor de caracterización no puede superar la cantidad total de participantes. Por favor revisar.
				</div>
			<?php
				return;
			}
		}

		if($_REQUEST['checkbox_modal_nacionalidad'] == "on") {
			$total_nacionalidad = intval($_REQUEST['vg_modal_nacionalidad_chileno']) + intval($_REQUEST['vg_modal_nacionalidad_migrante']);
			if($publico_general != $total_nacionalidad) { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Cada detalle ingresado en factor de nacionalidad no coincide con la cantidad total de participantes. Por favor revisar.
				</div>
			<?php
				return;
			}
		}

		if($_REQUEST['checkbox_modal_etnia'] == "on") {
			$total_etnia = intval($_REQUEST['vg_modal_etnia_mapuche']) + intval($_REQUEST['vg_modal_etnia_otro']);
			if($publico_general != $total_etnia) { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Cada detalle ingresado en factor de adscripción a pueblos originarios no coincide con la cantidad total de participantes. Por favor revisar.
				</div>
			<?php
				return;
			}
		}

		include_once("../../controller/medoo_participation_plan.php");
		$result = editPlanParticipation(noeliaDecode($_REQUEST['vg_modal_id']), noeliaDecode($_REQUEST['vg_modal_initiative']), $_REQUEST['vg_modal_tipo'], $_REQUEST['vg_modal_tipo_asistente'],
			($_REQUEST['vg_modal_publico_general']=="" ? "0":$_REQUEST['vg_modal_publico_general']),
			$_REQUEST['checkbox_modal_sexo'],
			($_REQUEST['vg_modal_sexo_masculino']=="" ? "0":$_REQUEST['vg_modal_sexo_masculino']),
			($_REQUEST['vg_modal_sexo_femenino']=="" ? "0":$_REQUEST['vg_modal_sexo_femenino']),
			($_REQUEST['vg_modal_sexo_otro']=="" ? "0":$_REQUEST['vg_modal_sexo_otro']),
			$_REQUEST['checkbox_modal_edad'],
			($_REQUEST['vg_modal_edad_ninos']=="" ? "0":$_REQUEST['vg_modal_edad_ninos']),
			($_REQUEST['vg_modal_edad_jovenes']=="" ? "0":$_REQUEST['vg_modal_edad_jovenes']),
			($_REQUEST['vg_modal_edad_adultos']=="" ? "0":$_REQUEST['vg_modal_edad_adultos']),
			($_REQUEST['vg_modal_edad_adultos_mayores']=="" ? "0":$_REQUEST['vg_modal_edad_adultos_mayores']),
			$_REQUEST['checkbox_modal_procedencia'],
			($_REQUEST['vg_modal_procedencia_rural']=="" ? "0":$_REQUEST['vg_modal_procedencia_rural']),
			($_REQUEST['vg_modal_procedencia_urbano']=="" ? "0":$_REQUEST['vg_modal_procedencia_urbano']),
			$_REQUEST['checkbox_modal_vulnerabilidad'],
			($_REQUEST['vg_modal_vulnerabilidad_pueblo']=="" ? "0":$_REQUEST['vg_modal_vulnerabilidad_pueblo']),
			($_REQUEST['vg_modal_vulnerabilidad_discapacidad']=="" ? "0":$_REQUEST['vg_modal_vulnerabilidad_discapacidad']),
			($_REQUEST['vg_modal_vulnerabilidad_pobreza']=="" ? "0":$_REQUEST['vg_modal_vulnerabilidad_pobreza']),
			$_REQUEST['checkbox_modal_nacionalidad'],
			($_REQUEST['vg_modal_nacionalidad_chileno']=="" ? "0":$_REQUEST['vg_modal_nacionalidad_chileno']),
			($_REQUEST['vg_modal_nacionalidad_migrante']=="" ? "0":$_REQUEST['vg_modal_nacionalidad_migrante']),
			($_REQUEST['vg_modal_nacionalidad_pueblo']=="" ? "0":$_REQUEST['vg_modal_nacionalidad_pueblo']),
			$_REQUEST['checkbox_modal_etnia'],
			($_REQUEST['vg_modal_etnia_mapuche']=="" ? "0":$_REQUEST['vg_modal_etnia_mapuche']),
			($_REQUEST['vg_modal_etnia_otro']=="" ? "0":$_REQUEST['vg_modal_etnia_otro']),
			noeliaDecode($_REQUEST['vg_modal_usuario']));

		if($result != null) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Participante actualizado correctamente.
			</div>
	<?php
		} else { ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				No pudimos actualizar la información.
			</div>
	<?php
		}
	} else {
		echo "Falta info!";
	}
?>
