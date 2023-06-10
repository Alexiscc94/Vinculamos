<?php
	function getVisibleEnvironmentDetails() {
		include("db_config.php");

		$datas = $db->select("viga_entornos_significativos_detalle",
			[
				"id",
				"nombre",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* PLAN */
	function getEnvironmentDetailsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_entornodetalle",
			[
				"id",
				"detalle"
			],
			[
				"id_iniciativa" => $idInitiative
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateEnvironmentDetailsByInitiativePlan($idInitiative = null, $details = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_entornodetalle", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$detailsForLog = "";
		for($i=0; $i<sizeof($details); $i++) {
			if($details[$i] != "") {
				$db->insert("viga_iniciativas_plan_entornodetalle", [
					"id_iniciativa" => $idInitiative,
					"detalle" => $details[$i]
				]);

				$detailsForLog .= ($details[$i] . " ");
				//echo "<br>query: " . $db->last();
			}
		}

		if(true) {
			include_once("logs.php");
			logAction($db, $autor, "iniciativas_plan_entornodetalle", $idInitiative, "Modificación de ambito con valores {detalle => [$detailsForLog], autor => $autor}");
			return $datas;
		}
	}


?>
