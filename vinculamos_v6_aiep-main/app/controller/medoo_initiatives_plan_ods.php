<?php
	/*
		SELECT `id`, `id_iniciativa`, `id_objetivo`, `id_meta`, `visible`, `fecha_creacion`
		FROM `viga_iniciativas_plan_ods` WHERE 1
	*/

	function getODSByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_objetivos`.`id`,`viga_objetivos`.`nombre`
			FROM `viga_objetivos` INNER JOIN `viga_iniciativas_plan_ods` ON `viga_objetivos`.`id` = `viga_iniciativas_plan_ods`.`id_objetivo`
			WHERE `viga_iniciativas_plan_ods`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getODSMeasuresByInitiativePlan($idInitiative = null, $idObjetive = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT `viga_metas`.`id`,`viga_metas`.`nombre`, `viga_metas`.`orden`
			FROM `viga_metas` INNER JOIN `viga_iniciativas_plan_ods` ON `viga_metas`.`orden` = `viga_iniciativas_plan_ods`.`id_meta`
			WHERE `viga_iniciativas_plan_ods`.`id_iniciativa` = '$idInitiative'
			AND `viga_iniciativas_plan_ods`.`id_objetivo` = '$idObjetive'
			AND `viga_metas`.`id_objetivo` = '$idObjetive'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateODSByInitiativePlan($idInitiative = null, $metas = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_ods", [
				"id_iniciativa" => $idInitiative
			]
		);
		//echo "<br>query: " . $db->last();

		$metasForLog = "";
		for($i=0; $i<sizeof($metas); $i++) {
			$db->insert("viga_iniciativas_plan_ods", [
				"id_iniciativa" => $idInitiative,
				"id_objetivo" => $metas[$i]["id_objetivo"],
				"id_meta" => $metas[$i]["id"]
			]);

			$metasForLog .= ($metas[$i][""] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_plan_ods", $idInitiative, "Modificación de ambito con valores {units => [$metasForLog], autor => $autor}");
			return $datas;
		}
	}

	function updateODSByInitiativePlanFromPython($idInitiative = null, $odsArray = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_ods", [
				"id_iniciativa" => $idInitiative
			]
		);
		//echo "<br>query: " . $db->last();

		$metasForLog = "";
		for($i=0; $i<sizeof($odsArray); $i++) {
			$ods = $odsArray[$i];
			$metas = $ods["metas"];

			for ($j=0; $j < sizeof($metas); $j++) {
				$db->insert("viga_iniciativas_plan_ods", [
					"id_iniciativa" => $idInitiative,
					"id_objetivo" => $ods["nombre"],
					"id_meta" => $metas[$j]
				]);
				//echo "<br>query: " . $db->last();
      }
			$metasForLog .= ($metas[$i][""] . " ");
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_plan_ods", $idInitiative, "Modificación de ambito con valores {units => [$metasForLog], autor => $autor}");
			return $datas;
		}
	}

	function getODSByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT `viga_objetivos`.`id`,`viga_objetivos`.`nombre`, COUNT(DISTINCT `viga_iniciativas_plan_ods`.`id_iniciativa`) as iniciativas
			FROM `viga_objetivos` INNER JOIN `viga_iniciativas_plan_ods` ON `viga_objetivos`.`id` = `viga_iniciativas_plan_ods`.`id_objetivo`
			WHERE `viga_iniciativas_plan_ods`.`id_iniciativa` IN ($initiativeGroup)
			GROUP BY `viga_objetivos`.`id`, `viga_objetivos`.`nombre`
			ORDER BY `viga_objetivos`.`id` ASC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}
?>
