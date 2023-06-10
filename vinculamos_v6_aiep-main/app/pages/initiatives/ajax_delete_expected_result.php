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
		echo "<br>id_resultado: " . noeliaDecode($_REQUEST['id_resultado']);
		echo "<br>vg_autor: " . noeliaDecode($_REQUEST['vg_usuario']);
		//return;
	}

	if( isset($_REQUEST['vg_initiative']) && isset($_REQUEST['id_resultado']) &&
		isset($_REQUEST['vg_usuario']) ) {

		include_once("../../controller/medoo_initiatives_plan_result.php");
		$result = deleteResultFromInitiativePlan(noeliaDecode($_REQUEST['vg_initiative']),
			noeliaDecode($_REQUEST['id_resultado']), noeliaDecode($_REQUEST['vg_usuario']));

		if($result != null) {
			echo noeliaEncode("data" . $result[0]["id"]);
		} else {
			echo "-1";
		}
	} else {
		echo "Falta info!";
	}
?>
