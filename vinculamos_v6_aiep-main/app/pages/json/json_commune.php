<?php

	//header('Content-type: application/json');
	if( isset($_REQUEST['vg_region']) ) {

		$regiones = $_REQUEST['vg_region'];

		include("../../controller/medoo_geographic.php");

		$finalArray = getVisibleCommuneByRegion($regiones);

		echo json_encode($finalArray, JSON_PRETTY_PRINT);
		return;
	}

?>
