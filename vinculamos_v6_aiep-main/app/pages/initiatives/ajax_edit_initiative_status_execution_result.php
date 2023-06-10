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

	if(false) {
		echo "<br>vg_usuario: " . $_REQUEST['vg_usuario'];
		echo "<br>vg_initiative: " . $_REQUEST['vg_initiative'];
	}

	if( isset($_REQUEST['vg_initiative']) && isset($_REQUEST['vg_usuario']) ) {

		include_once("../../controller/medoo_initiatives_plan.php");
		$result = editInitiativeStatusExecution(noeliaDecode($_REQUEST['vg_initiative']),
			"Finalizada", noeliaDecode($_REQUEST['vg_usuario']));

		include_once("../../controller/medoo_participation_plan.php");
		$participation_plan = getVisiblePlanParticipationByInitiative(noeliaDecode($_REQUEST['vg_initiative']));
		include_once("../../controller/medoo_participation_real.php");
		for ($i=0; $i < sizeof($participation_plan); $i++) {
			addRealParticipation($participation_plan[$i]["id_iniciativa"],
				$participation_plan[$i]["tipo"], $participation_plan[$i]["tipo2"],
				$participation_plan[$i]["publico_general"],
				"", 0, 0, 0, /* SEXO */
				"", 0, 0, 0, 0, /* EDAD */
				"", 0, 0, /* PROCEDENCIA */
				"", 0, 0, 0, /* VULNERABILIDAD */
				"", 0, 0, 0, /* NACIONALIDAD */
				"", 0, 0, /* ETNIA */
				noeliaDecode($_REQUEST['vg_usuario']));
		}

		if($result != null) {
			echo noeliaEncode("data" . $result[0]["id"]);
		} else {
			echo "-1";
		}
	} else {
		echo "Falta info!";
	}
?>
