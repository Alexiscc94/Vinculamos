<?php

	//header('Content-type: application/json');
	if( isset($_REQUEST['vg_facultad']) ) {

		$facultades = $_REQUEST['vg_facultad'];

		include("../../controller/medoo_carrers.php");

		$finalArray = [];
		for($i=0; $i<sizeof($facultades); $i++) {
			$result = getVisibleCarrersByDepartment($facultades[$i]);
			$finalArray = array_merge($finalArray, $result);
		}

		echo json_encode($finalArray, JSON_PRETTY_PRINT);
		return;
	} else {
		echo "Falta info";
	}


?>
