<?php

	function getVisibleCountries() {
		include("db_config.php");

		$datas = $db->select("viga_geo_pais",
			[
				"id",
				"nombre"
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getCountriesByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_geo_pais`.`id`,`viga_geo_pais`.`nombre`
			FROM `viga_geo_pais` INNER JOIN `viga_iniciativas_plan_geopais` ON `viga_geo_pais`.`id` = `viga_iniciativas_plan_geopais`.`id_pais`
			WHERE `viga_iniciativas_plan_geopais`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateCountriesByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_geopais", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_geopais", [
				"id_iniciativa" => $idInitiative,
				"id_pais" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_plan_geo_pais", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	function getVisibleRegions() {
		include("db_config.php");

		$datas = $db->select("viga_geo_region",
			[
				"id",
				"nombre"
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getVisibleRegionsByCountry($country = null) {
		include("db_config.php");

		$datas = $db->select("viga_geo_region",
			[
				"id",
				"nombre"
			],
			[
				"id_pais" => $country
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getRegionsByResponsible($idResponsible = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_geo_region`.`id`,`viga_geo_region`.`nombre`
			FROM `viga_geo_region` INNER JOIN `viga_iniciativas_plan_georegion` ON `viga_geo_region`.`id` = `viga_iniciativas_plan_georegion`.`id_region`
				INNER JOIN `viga_iniciativas` ON `viga_iniciativas`.`id` = `viga_iniciativas_plan_georegion`.`id_iniciativa`
			WHERE `viga_iniciativas`.`id_responsable` = '$idResponsible'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getRegionsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_geo_region`.`id`,`viga_geo_region`.`nombre`
			FROM `viga_geo_region` INNER JOIN `viga_iniciativas_plan_georegion` ON `viga_geo_region`.`id` = `viga_iniciativas_plan_georegion`.`id_region`
			WHERE `viga_iniciativas_plan_georegion`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateRegionsByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_georegion", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_georegion", [
				"id_iniciativa" => $idInitiative,
				"id_region" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_plan_geo_region", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	function getVisibleCommunes() {
		include("db_config.php");

		$datas = $db->select("viga_geo_comuna",
			[
				"id",
				"nombre"
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getVisibleCommuneByRegion($region = null) {
		include("db_config.php");

		$datas = $db->select("viga_geo_comuna",
			[
				"id",
				"nombre"
			],
			[
				"id_region" => $region,
				"ORDER" => [
					"nombre" => "ASC"
				]
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getCommunesByResponsible($idResponsible = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_geo_comuna`.`id`,`viga_geo_comuna`.`nombre`
			FROM `viga_geo_comuna` INNER JOIN `viga_iniciativas_plan_geocomuna` ON `viga_geo_comuna`.`id` = `viga_iniciativas_plan_geocomuna`.`id_comuna`
					INNER JOIN `viga_iniciativas` ON `viga_iniciativas`.`id` = `viga_iniciativas_plan_geocomuna`.`id_iniciativa`
			WHERE `viga_iniciativas`.`id_responsable` = '$idResponsible'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getCommunesByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_geo_comuna`.`id`,`viga_geo_comuna`.`nombre`
			FROM `viga_geo_comuna` INNER JOIN `viga_iniciativas_plan_geocomuna` ON `viga_geo_comuna`.`id` = `viga_iniciativas_plan_geocomuna`.`id_comuna`
			WHERE `viga_iniciativas_plan_geocomuna`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateCommunesByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_geocomuna", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_geocomuna", [
				"id_iniciativa" => $idInitiative,
				"id_comuna" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan_geo_comuna", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	function getRegionsByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_geo_region`.`id`,`viga_geo_region`.`nombre`
			FROM `viga_geo_region` INNER JOIN `viga_iniciativas_plan_georegion` ON `viga_geo_region`.`id` = `viga_iniciativas_plan_georegion`.`id_region`
			WHERE `viga_iniciativas_plan_georegion`.`id_iniciativa` IN ($initiativeGroup)
			ORDER BY `viga_geo_region`.`id` ASC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function countSummaryVisibleRegionsByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT `viga_geo_region`.`id`, `viga_geo_region`.`nombre`, COUNT(`viga_iniciativas_plan_georegion`.`id`) as iniciativas
			FROM `viga_geo_region` INNER JOIN `viga_iniciativas_plan_georegion` ON `viga_geo_region`.`id` = `viga_iniciativas_plan_georegion`.`id_region`
			WHERE `viga_iniciativas_plan_georegion`.`id_iniciativa` IN ($initiativeGroup)
			GROUP BY `viga_geo_region`.`id`, `viga_geo_region`.`nombre`
			ORDER BY iniciativas DESC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getCommunesByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_geo_comuna`.`id`,`viga_geo_comuna`.`nombre`
			FROM `viga_geo_comuna` INNER JOIN `viga_iniciativas_plan_geocomuna` ON `viga_geo_comuna`.`id` = `viga_iniciativas_plan_geocomuna`.`id_comuna`
			WHERE `viga_iniciativas_plan_geocomuna`.`id_iniciativa` IN ($initiativeGroup)
			ORDER BY `viga_geo_comuna`.`id` ASC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function countSummaryVisibleCommunesByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT `viga_geo_comuna`.`id`, `viga_geo_comuna`.`nombre`, COUNT(`viga_iniciativas_plan_geocomuna`.`id`) as iniciativas
			FROM `viga_geo_comuna` INNER JOIN `viga_iniciativas_plan_geocomuna` ON `viga_geo_comuna`.`id` = `viga_iniciativas_plan_geocomuna`.`id_comuna`
			WHERE `viga_iniciativas_plan_geocomuna`.`id_iniciativa` IN ($initiativeGroup)
			GROUP BY `viga_geo_comuna`.`id`, `viga_geo_comuna`.`nombre`
			ORDER BY iniciativas DESC
			LIMIT 5"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
