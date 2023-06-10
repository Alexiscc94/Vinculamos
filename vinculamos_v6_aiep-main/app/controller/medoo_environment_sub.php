<?php

	/*
		SELECT `id`, `nombre`, `visible`, `fecha_creacion`
		FROM `viga_entornos_significativos_sub` WHERE 1
	*/

	function addEnvironmentSubByInitiativePlan($idInitiative = null, $idSubEnvironment = null, $autor = null) {
		include("db_config.php");

		$db->insert("viga_iniciativas_plan_entornosub", [
			"id_iniciativa" => $idInitiative,
			"id_entornosub" => $idSubEnvironment
		]);
		//echo "<br>query: " . $db->last();

		$id = $db->id();
		$datas = $db->select("viga_iniciativas_plan_entornosub", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["id_iniciativa"] == $idInitiative) $verificator++;
		if($datas[0]["id_entornosub"] == $idSubEnvironment) $verificator++;
		if($verificator == 4) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan_entornosub", $id, "Nuevo registro con valores {id_iniciativa => $idInitiative, id_entornosub => $idSubEnvironment}");
			return $datas;
		}return null;
	}

	function getVisibleEnvironmentsSub($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_entornos_significativos_sub",
			[
				"id",
				"id_entorno",
				"nombre",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"id" => $id,
				"ORDER" => [
					"nombre" => "ASC",
				]
			]
		);

		return $datas;
	}

	function getVisibleEnvironmentsSubByEnvironment($id_environment = null) {
		include("db_config.php");

		$datas = $db->select("viga_entornos_significativos_sub",
			[
				"id",
				"id_entorno",
				"nombre",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"id_entorno" => $id_environment,
				"ORDER" => [
					"nombre" => "ASC",
				]
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	/* PLAN POC */
	function getEnvironmentsSubDetailByInitiativePlan($idInitiative = null, $idEnvironment = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos_sub`.`id`,`viga_entornos_significativos_sub`.`nombre`
			FROM `viga_entornos_significativos_sub` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos_sub`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno_sub`
			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` = '$idInitiative'
			AND `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno` = '$idEnvironment'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	/* PLAN */
	function getEnvironmentsSubsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos_sub`.`id`,`viga_entornos_significativos_sub`.`nombre`
			FROM `viga_entornos_significativos_sub` INNER JOIN `viga_iniciativas_plan_entornosub` ON `viga_entornos_significativos_sub`.`id` = `viga_iniciativas_plan_entornosub`.`id_entornosub`
			WHERE `viga_iniciativas_plan_entornosub`.`id_iniciativa` = '$idInitiative' "
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getEnvironmentsSubsByInitiativePlanEnvironment($idInitiative = null, $idEnvironment = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos_sub`.`id`,`viga_entornos_significativos_sub`.`nombre`
			FROM `viga_entornos_significativos_sub` INNER JOIN `viga_iniciativas_plan_entornosub` ON `viga_entornos_significativos_sub`.`id` = `viga_iniciativas_plan_entornosub`.`id_entornosub`
			WHERE `viga_iniciativas_plan_entornosub`.`id_iniciativa` = '$idInitiative'
			AND `viga_entornos_significativos_sub`.`id_entorno` = '$idEnvironment'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateEnvironmentsSubsByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_entornosub", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_entornosub", [
				"id_iniciativa" => $idInitiative,
				"id_entornosub" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan_entornosub", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	function getEnvironmentsSubsByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_entornos_significativos_sub`.`id`,`viga_entornos_significativos_sub`.`nombre`
			FROM `viga_entornos_significativos_sub` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos_sub`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno_sub`
			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` IN ($initiativeGroup)
			ORDER BY `viga_entornos_significativos_sub`.`id` ASC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
