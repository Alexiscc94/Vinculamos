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
		echo "<br>id_initiative: " . $_REQUEST['id_initiative'];
		echo "<br>cantidad: " . $_REQUEST['cantidad'];
		echo "<br>texto: " . $_REQUEST['texto'];
		echo "<br>vg_autor: " . base64_decode($_REQUEST['autor']);
		//return;
	}

	if( isset($_REQUEST['id_initiative']) && isset($_REQUEST['cantidad']) &&
		isset($_REQUEST['texto']) && isset($_REQUEST['autor']) ) {

		include_once("../../controller/medoo_initiatives_plan_result.php");
		$result = addResultToInitiativePlan(base64_decode($_REQUEST['id_initiative']), $_REQUEST['tipo'],
			$_REQUEST['cantidad'], $_REQUEST['texto'], $institucion, base64_decode($_REQUEST['autor']));

		if($result != null) {
			echo noeliaEncode("data" . $result[0]["id"]);
		} else {
			echo "-1";
		}
	} else {
		echo "Falta info!";
	}
?>
