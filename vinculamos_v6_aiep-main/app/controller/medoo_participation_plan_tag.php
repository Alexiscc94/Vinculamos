<?php
	function getVisibleParticipationTagPlan() {
		include("db_config.php");

		$datas = $db->select("viga_participacion_plan_tag",
			[
				"id",
				"id_iniciativa",
				"id_participacion",
				"detalle"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* PLAN */
	function getVisibleParticipationTagPlanByParticipation($idParticipation = null) {
		include("db_config.php");

		$datas = $db->select("viga_participacion_plan_tag",
			[
				"id",
				"id_iniciativa",
				"id_participacion",
				"detalle"
			],
			[
				"id_participacion" => $idParticipation
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateParticipationTagPlanByInitiativeParticipation($idInitiative = null, $idParticipation = null, $details = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_participacion_plan_tag", [
				"id_iniciativa" => $idInitiative,
				"id_participacion" => $idParticipation
			]);
		//echo "<br>query: " . $db->last();

		$detailsForLog = "";
		for($i=0; $i<sizeof($details); $i++) {
			$db->insert("viga_participacion_plan_tag", [
				"id_iniciativa" => $idInitiative,
				"id_participacion" => $idParticipation,
				"detalle" => $details[$i]
			]);

			$detailsForLog .= ($details[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("logs.php");
			logAction($db, $autor, "iniciativas_plan_participacion_tag", $idInitiative, "Modificación de ambito con valores {detalle => [$detailsForLog], autor => $autor}");
			return $datas;
		}
	}

?>
