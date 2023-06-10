<?php

	//header('Content-type: application/json');
	if( isset($_REQUEST['vg_unidad']) ) {

		$unidades = $_REQUEST['vg_unidad'];

		include("../../controller/medoo_units_subs.php");

		$finalArray = [];
		for($i=0; $i<sizeof($unidades); $i++) {
			$result = getVisibleUnitsSubByUnit($unidades[$i]);
			$finalArray = array_merge($finalArray, $result);
		}

		echo json_encode($finalArray, JSON_PRETTY_PRINT);
		return;
	} else {
		echo "Falta info";
	}


?>
