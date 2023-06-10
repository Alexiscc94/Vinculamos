<?php

	//header('Content-type: application/json');
	if( isset($_REQUEST['id_initiative']) && isset($_REQUEST['type']) ) {

		$vg_initiative = base64_decode($_REQUEST['id_initiative']);
		$vg_type = base64_decode($_REQUEST['type']);

		include("../../controller/medoo_environment_environmentsub_detail.php");
		if($vg_type == "Interno") {
			$array = getEnvironmentSubDetailsByInitiativePlanEnv($vg_initiative, 7);
		}

		if($vg_type == "Externo") {
			$arrayTypes = [1, 2, 3, 4, 5, 6];
			$array = getEnvironmentSubDetailsByInitiativePlanEnv($vg_initiative, $arrayTypes);
		}

		$finalArray = array();
		for($i=0; $i<sizeof($array); $i++) {
			if($array[$i]["tag"] != "") {
				$finalArray[] = $array[$i];
			}
		}

		echo json_encode($finalArray, JSON_PRETTY_PRINT);
		return;
	} else {
		echo "Falta info";
	}


?>
