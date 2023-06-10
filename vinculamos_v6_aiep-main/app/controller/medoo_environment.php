<?php
	function getVisibleEnvironments() {
		include("db_config.php");

		$datas = $db->select("viga_entornos_significativos",
			[
				"id",
				"nombre",
				"descripcion",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* PLAN POC */
	function getEnvironmentsByInitiativePlanPOC($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos`.`id`,`viga_entornos_significativos`.`nombre`,`viga_entornos_significativos`.`descripcion`
			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno`
			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getInternalEnvironmentsByInitiativePlanPOC($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos`.`id`,`viga_entornos_significativos`.`nombre`
			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno`
			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` = '$idInitiative'
			AND `viga_entornos_significativos`.`id` = 7"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getExternalEnvironmentsByInitiativePlanPOC($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos`.`id`,`viga_entornos_significativos`.`nombre`
			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno`
			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` = '$idInitiative'
			AND `viga_entornos_significativos`.`id` in (1, 2, 3, 4, 5, 6)"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	/* PLAN */
	function getEnvironmentsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos`.`id`,`viga_entornos_significativos`.`nombre`
			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_plan_entorno` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_plan_entorno`.`id_entorno`
			WHERE `viga_iniciativas_plan_entorno`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateEnvironmentsByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_entorno", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_entorno", [
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan_entorno", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	/* REAL */
	function getEnvironmentsByInitiativeReal($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos`.`id`,`viga_entornos_significativos`.`nombre`
			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_real_entorno` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_real_entorno`.`id_entorno`
			WHERE `viga_iniciativas_real_entorno`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateEnvironmentsByInitiativeReal($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_real_entorno", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_real_entorno", [
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("logs.php");
			logAction($db, $autor, "iniciativas_real_entorno", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	function getEnvironmentsByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos`.`id`,`viga_entornos_significativos`.`nombre`
			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno`
			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` IN ($initiativeGroup)
			ORDER BY `viga_entornos_significativos`.`id` ASC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function countSummaryVisibleEnvironmentsByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT `viga_entornos_significativos`.`id`, `viga_entornos_significativos`.`nombre`, COUNT(`viga_iniciativas_plan_entorno_entornosub_detalle`.`id`) as iniciativas
			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno`
			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` IN ($initiativeGroup)
			GROUP BY `viga_entornos_significativos`.`id`, `viga_entornos_significativos`.`nombre`
			ORDER BY iniciativas DESC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}
?>
