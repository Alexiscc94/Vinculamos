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
		echo "<br>vg_id_iniciativa: " . noeliaDecode($_REQUEST['vg_id_iniciativa']);
		echo "<br>vg_id: " . noeliaDecode($_REQUEST['vg_id']);
		echo "<br>vg_impacto_tipo: " . $_REQUEST['vg_impacto_tipo'];
		echo "<br>vg_impacto_cantidad: " . $_REQUEST['vg_impacto_cantidad'];
		echo "<br>vg_impacto_texto: " . $_REQUEST['vg_impacto_texto'];
		echo "<br>vg_usuario: " . noeliaDecode($_REQUEST['vg_usuario']);
		//return;
	}

	if( isset($_REQUEST['vg_id_iniciativa']) && isset($_REQUEST['vg_id']) &&
		isset($_REQUEST['vg_usuario']) ) {

		include_once("../../controller/medoo_initiatives_plan_impact.php");
		$result = editImpactFromInitiativePlan(noeliaDecode($_REQUEST['vg_id_iniciativa']),
			noeliaDecode($_REQUEST['vg_id']), $_REQUEST['vg_impacto_tipo'],
			$_REQUEST['vg_impacto_cantidad'], $_REQUEST['vg_impacto_texto'],
			noeliaDecode($_REQUEST['vg_usuario']));

		if($result != null) {
			echo "1";//noeliaEncode("data" . $result[0]["id"]);
		} else {
			echo "-1";
		}
	} else {
		echo "Falta info!";
	}
?>
