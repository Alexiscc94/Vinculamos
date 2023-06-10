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
		echo "<br>id_initiative: " . noeliaDecode($_REQUEST['vg_initiative']);
		echo "<br>id_impacto: " . noeliaDecode($_REQUEST['id_impacto']);
		echo "<br>vg_autor: " . noeliaDecode($_REQUEST['vg_usuario']);
		//return;
	}

	if( isset($_REQUEST['vg_initiative']) && isset($_REQUEST['id_impacto']) &&
		isset($_REQUEST['vg_usuario']) ) {

		include_once("../../controller/medoo_initiatives_plan_impact.php");
		$result = deleteImpactFromInitiativePlan(noeliaDecode($_REQUEST['vg_initiative']),
			noeliaDecode($_REQUEST['id_impacto']), noeliaDecode($_REQUEST['vg_usuario']));

		if($result != null) {
			echo noeliaEncode("data" . $result[0]["id"]);
		} else {
			echo "-1";
		}
	} else {
		echo "Falta info!";
	}
?>
