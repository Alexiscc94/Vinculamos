<?php

	/*
		SELECT `id`, `nombre`, `descripcion`, `director`, `visible`, `institucion`, `autor`, `fecha_creacion`
		FROM `viga_unidades` WHERE 1
	*/

	function addUnit($nombre = null, $descripcion = null, $director = null,
		$autor = null, $institucion = null) {
		include("db_config.php");

		$db->insert("viga_unidades",
			[
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"director" => $director,
				"institucion" => $institucion,
				"autor" => $autor
			]
		);

		//echo "<br>query: " . $db->last();

		$id = $db->id();
		$datas = $db->select("viga_unidades", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["director"] == $director) $verificator++;
		if($datas[0]["institucion"] == $institucion) $verificator++;
		if($datas[0]["autor"] == $autor) $verificator++;
		if($verificator == 5) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "unidades", $id, "Nuevo registro con valores {nombre => $nombre, descripción => $descripcion, director => $director, institucion => $institucion}");
			return $datas;
		}return null;
	}

	function editUnit($id = null, $nombre = null, $descripcion = null, $director = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_unidades",
			[
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"director" => $director
			],
			[
				"id" => $id
			]
		);
		//echo "<br>query: " . $db->last();

		$datas = $db->select("viga_unidades", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["director"] == $director) $verificator++;
		if($verificator == 3) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "unidades", $id, "Modificación en registro con valores {nombre => $nombre, descripción => $descripcion, director => $director}");
			return $datas;
		}return null;
	}

	function deleteUnit($id = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_unidades",
			[
				"visible" => "-1",
			],
			[
				"id" => $id
			]
		);

		$datas = $db->select("viga_unidades", "*", ["id" => $id]);

		$verificator = 0;
		if($datas[0]["visible"] == "-1") $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "unidades", $id, "Eliminación de registro con valores {id => $id, visible => -1}");
			return $datas;
		}return null;
	}

	function getUnit($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_unidades",
			[
				"id",
				"nombre",
				"descripcion",
				"director",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"id" => $id
			]
		);

		return $datas;
	}

	function getVisibleUnitsByInstitution($institucion = null) {
		include("db_config.php");

		$datas = $db->select("viga_unidades",
			[
				"id",
				"nombre",
				"descripcion",
				"director",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"institucion" => $institucion
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getVisibleUnitsByInstitutionId($institucion = null, $id = null) {
		include("db_config.php");

		$datas = $db->select("viga_unidades",
			[
				"id",
				"nombre",
				"descripcion",
				"director",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"institucion" => $institucion,
				"id" => $id
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getVisibleUnits() {
		include("db_config.php");

		$datas = $db->select("viga_unidades",
			[
				"id",
				"nombre",
				"descripcion",
				"director",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);

		return $datas;
	}

	/* RELACIÓN UNIDAD - INICIATIVA PLAN */
	function getUnitsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_unidades`.`id`,`viga_unidades`.`nombre`
			FROM `viga_unidades` INNER JOIN `viga_iniciativas_plan_unidad` ON `viga_unidades`.`id` = `viga_iniciativas_plan_unidad`.`id_unidad`
			WHERE `viga_iniciativas_plan_unidad`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateUnitsByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_unidad", [
				"id_iniciativa" => $idInitiative
			]
		);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_unidad", [
				"id_iniciativa" => $idInitiative,
				"id_unidad" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_plan_unidad", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	/* RELACIÓN UNIDAD - INICIATIVA REAL */
	function getUnitsByInitiativeReal($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_unidades`.`id`,`viga_unidades`.`nombre`
			FROM `viga_unidades` INNER JOIN `viga_iniciativas_real_unidad` ON `viga_unidades`.`id` = `viga_iniciativas_real_unidad`.`id_unidad`
			WHERE `viga_iniciativas_real_unidad`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateUnitsByInitiativeReal($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_real_unidad", [
				"id_iniciativa" => $idInitiative
			]
		);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_real_unidad", [
				"id_iniciativa" => $idInitiative,
				"id_unidad" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_real_unidad", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	function countVisibleUnitsByInstitution($institution = null) {
		include("db_config.php");

		$datas = $db->count("viga_unidades", "id",
			[
        "visible" => "1",
        "institucion" => $institution,
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function countSummaryVisibleUnitsByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT `viga_unidades`.`id`, `viga_unidades`.`nombre`, COUNT(`viga_iniciativas_plan_unidad`.`id`) as iniciativas
			FROM `viga_unidades` INNER JOIN `viga_iniciativas_plan_unidad` ON `viga_unidades`.`id` = `viga_iniciativas_plan_unidad`.`id_unidad`
			WHERE `viga_iniciativas_plan_unidad`.`id_iniciativa` IN ($initiativeGroup)
			GROUP BY `viga_unidades`.`id`, `viga_unidades`.`nombre`
			ORDER BY iniciativas DESC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
