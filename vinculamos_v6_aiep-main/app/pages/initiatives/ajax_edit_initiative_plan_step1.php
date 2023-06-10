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
	$institucion = getInstitution();

	if(false) {
		echo "<br>vg_nombre: " . $_REQUEST['vg_nombre'];
		echo "<br>vg_fecha_inicio: " . $_REQUEST['vg_fecha_inicio'];
		echo "<br>vg_fecha_fin: " . $_REQUEST['vg_fecha_fin'];
		echo "<br>vg_autor: " . noeliaDecode($_REQUEST['vg_autor']);

		echo "<br>vg_unidad: " . $_REQUEST['vg_unidad'];
		for ($i=0; $i < sizeof($_REQUEST['vg_escuela']); $i++) {
			echo "<br>->vg_unidad [$i]: " . $_REQUEST['vg_unidad'][$i];
		}

		echo "<br>vg_unidad_sub: " . $_REQUEST['vg_unidad_sub'];
		for ($i=0; $i < sizeof($_REQUEST['vg_unidad_sub']); $i++) {
			echo "<br>->vg_unidad_sub [$i]: " . $_REQUEST['vg_unidad_sub'][$i];
		}

		echo "<br>vg_sede: " . $_REQUEST['vg_sede'];
		for ($i=0; $i < sizeof($_REQUEST['vg_sede']); $i++) {
			echo "<br>->vg_sede [$i]: " . $_REQUEST['vg_sede'][$i];
		}

		echo "<br>vg_facultad: " . $_REQUEST['vg_facultad'];
		for ($i=0; $i < sizeof($_REQUEST['vg_facultad']); $i++) {
			echo "<br>->vg_facultad [$i]: " . $_REQUEST['vg_facultad'][$i];
		}

		echo "<br>vg_carrera: " . $_REQUEST['vg_carrera'];
		for ($i=0; $i < sizeof($_REQUEST['vg_carrera']); $i++) {
			echo "<br>->vg_carrera [$i]: " . $_REQUEST['vg_carrera'][$i];
		}

		echo "<br>vg_programa: " . $_REQUEST['vg_programa'];

		echo "<br>vg_programa_secundario: " . $_REQUEST['vg_programa_secundario'];
		for ($i=0; $i < sizeof($_REQUEST['vg_programa_secundario']); $i++) {
			echo "<br>->vg_programa_secundario [$i]: " . $_REQUEST['vg_programa_secundario'][$i];
		}

		echo "<br>vg_mecanismo: " . $_REQUEST['vg_mecanismo'];

		echo "<br>vg_encargado: " . $_REQUEST['vg_encargado'];
		echo "<br>vg_encargado_cargo: " . $_REQUEST['vg_encargado_cargo'];

		echo "<br>vg_formato_implementacion: " . $_REQUEST['vg_formato_implementacion'];
		echo "<br>vg_frecuencia: " . $_REQUEST['vg_frecuencia'];

		echo "<br>vg_pais: " . $_REQUEST['vg_pais'];
		for ($i=0; $i < sizeof($_REQUEST['vg_pais']); $i++) {
			echo "<br>->vg_pais [$i]: " . $_REQUEST['vg_pais'][$i];
		}

		echo "<br>vg_region: " . $_REQUEST['vg_region'];
		for ($i=0; $i < sizeof($_REQUEST['vg_region']); $i++) {
			echo "<br>->vg_region [$i]: " . $_REQUEST['vg_region'][$i];
		}

		echo "<br>vg_comuna: " . $_REQUEST['vg_comuna'];
		for ($i=0; $i < sizeof($_REQUEST['vg_comuna']); $i++) {
			echo "<br>->vg_comuna [$i]: " . $_REQUEST['vg_comuna'][$i];
		}
		//return;
	}

	if( isset($_REQUEST['vg_nombre']) && isset($_REQUEST['vg_fecha']) &&
		isset($_REQUEST['vg_autor']) ) {

		include_once("../../controller/medoo_initiatives_plan.php");

		$fecha_inicio = $_REQUEST['vg_fecha'] . '-01-01';
		$fecha_fin = $_REQUEST['vg_fecha'] . '-12-31';
		$result = editInitiativePlanStep1(noeliaDecode($_REQUEST['vg_id']), $_REQUEST['vg_nombre'],
			$fecha_inicio, $fecha_fin, noeliaDecode($_REQUEST['vg_autor']));

		editInitiativePlanMechanismFrecuency($result[0]["id"], $_REQUEST['vg_mecanismo'],
			$_REQUEST['vg_actividad'], $_REQUEST['vg_frecuencia'], noeliaDecode($_REQUEST['vg_autor']));

		editInitiativePlanAttributesStep1($result[0]["id"], $_REQUEST['vg_encargado'],
	    $_REQUEST['vg_encargado_cargo'], $_REQUEST['vg_formato_implementacion'], noeliaDecode($_REQUEST['vg_autor']));

		include_once("../../controller/medoo_units.php");
		updateUnitsByInitiativePlan($result[0]["id"], $_REQUEST['vg_unidad'], noeliaDecode($_REQUEST['vg_autor']));

		include_once("../../controller/medoo_units_subs.php");
		updateUnitsSubByInitiativePlan($result[0]["id"], $_REQUEST['vg_unidad_sub'], noeliaDecode($_REQUEST['vg_autor']));

		include_once("../../controller/medoo_campus.php");
		updateCampusByInitiativePlan($result[0]["id"], $_REQUEST['vg_sede'], noeliaDecode($_REQUEST['vg_autor']));

		include_once("../../controller/medoo_departments.php");
		updateDepartmentsByInitiativePlan($result[0]["id"], $_REQUEST['vg_facultad'], noeliaDecode($_REQUEST['vg_autor']));

		include_once("../../controller/medoo_carrers.php");
		updateCarrerByInitiativePlan($result[0]["id"], $_REQUEST['vg_carrera'], noeliaDecode($_REQUEST['vg_autor']));

		include_once("../../controller/medoo_programs.php");
		updateProgramsByInitiativePlan($result[0]["id"], $_REQUEST['vg_programa'], noeliaDecode($_REQUEST['vg_autor']));
		updateProgramsSecundaryByInitiativePlan($result[0]["id"], $_REQUEST['vg_programa_secundario'], noeliaDecode($_REQUEST['vg_autor']));

		include_once("../../controller/medoo_covenants.php");
		updateCovenantsByInitiativePlan($result[0]["id"], $_REQUEST['vg_convenios'], noeliaDecode($_REQUEST['vg_autor']));

		/*
		//include_once("../../controller/medoo_geographic.php");
		//updateCountriesByInitiative($result[0]["id"], $_REQUEST['vg_pais'], noeliaDecode($_REQUEST['vg_autor']));
		//updateRegionsByInitiative($result[0]["id"], $_REQUEST['vg_region'], noeliaDecode($_REQUEST['vg_autor']));
		//updateCommunesByInitiative($result[0]["id"], $_REQUEST['vg_comuna'], noeliaDecode($_REQUEST['vg_autor']));
		*/
		if($result != null) {
			echo noeliaEncode("data" . $result[0]["id"]);
		} else {
			echo "-1";
		}
	} else {
		echo "Falta info!";
	}
?>
