<?php

	/*
		SELECT `id`, `nombre`, `descripcion`, `director`, `visible`, `institucion`, `autor`, `fecha_creacion`
		FROM `viga_param_impacto_interno` WHERE 1
	*/

	function getVisibleInternalImpactTypes() {
		include("db_config.php");

		$datas = $db->select("viga_param_impacto_interno",
			[
				"id",
				"nombre",
				"visible",
				"autor",
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
	function getInternalImpactByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_param_impacto_interno`.`id`,`viga_param_impacto_interno`.`nombre`
			FROM `viga_param_impacto_interno` INNER JOIN `viga_iniciativas_plan_impactointerno` ON `viga_param_impacto_interno`.`id` = `viga_iniciativas_plan_impactointerno`.`id_impacto`
			WHERE `viga_iniciativas_plan_impactointerno`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateInternalImpactByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_impactointerno", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_impactointerno", [
				"id_iniciativa" => $idInitiative,
				"id_impacto" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan_impactointerno", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	function countVisibleInternalImpact() {
		include("db_config.php");

		$datas = $db->count("viga_param_impacto_interno",
			"id",
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

?>
