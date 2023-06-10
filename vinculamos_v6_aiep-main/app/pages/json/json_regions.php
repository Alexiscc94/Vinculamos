<?php

	//header('Content-type: application/json');
	if( isset($_REQUEST['vg_pais']) ) {

		$paises = $_REQUEST['vg_pais'];

		include("../../controller/medoo_geographic.php");

		$finalArray = getVisibleRegionsByCountry($paises);

		echo json_encode($finalArray, JSON_PRETTY_PRINT);
		return;
	}

?>
