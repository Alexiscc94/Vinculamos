<?php

	//header('Content-type: application/json');

	if( isset($_REQUEST['vg_actividad']) ) {

		$id_activity = $_REQUEST['vg_actividad'];

		include("../../controller/medoo_invi_attributes.php");
		$result = getVisibleMechanismActivityById($id_activity);

		echo json_encode($result[0], JSON_PRETTY_PRINT);
		return;
	} else {
		echo "sdsdsddsdsd";
	}

?>
