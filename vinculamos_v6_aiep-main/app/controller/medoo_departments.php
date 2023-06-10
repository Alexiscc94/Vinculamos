<?php

	/*
		SELECT `id`, `nombre`, `descripcion`, `director`, `visible`, `institucion`, `autor`, `fecha_creacion`
		FROM `viga_facultades` WHERE 1
	*/

	function addDepartment($nombre = null, $descripcion = null, $director = null,
		$autor = null, $institucion = null) {
		include("db_config.php");

		$db->insert("viga_facultades",
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
		$datas = $db->select("viga_facultades", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["director"] == $director) $verificator++;
		if($datas[0]["institucion"] == $institucion) $verificator++;
		if($datas[0]["autor"] == $autor) $verificator++;
		if($verificator == 5) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "departamentos", $id, "Nuevo registro con valores {nombre => $nombre, descripción => $descripcion, director => $director, institucion => $institucion}");
			return $datas;
		}return null;
	}

	function editDepartment($id = null, $nombre = null, $descripcion = null, $director = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_facultades",
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

		$datas = $db->select("viga_facultades", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["director"] == $director) $verificator++;
		if($verificator == 3) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "departamentos", $id, "Modificación en registro con valores {nombre => $nombre, descripción => $descripcion, director => $director}");
			return $datas;
		}return null;
	}

	function deleteDepartment($id = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_facultades",
			[
				"visible" => "-1",
			],
			[
				"id" => $id
			]
		);

		$datas = $db->select("viga_facultades", "*", ["id" => $id]);

		$verificator = 0;
		if($datas[0]["visible"] == "-1") $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "departamentos", $id, "Eliminación de registro con valores {id => $id, visible => -1}");
			return $datas;
		}return null;
	}

	function getDepartment($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_facultades",
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

	function getVisibleDepartmentsByInstitution($institucion = null) {
		include("db_config.php");

		$datas = $db->select("viga_facultades",
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

	function getVisibleDepartmentsByInstitutionId($institucion = null, $id = null) {
		include("db_config.php");

		$datas = $db->select("viga_facultades",
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

	function getVisibleDepartments() {
		include("db_config.php");

		$datas = $db->select("viga_facultades",
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

	/* RELACIÓN FACULTAD - INICIATIVA PLAN */
	function getDepartmentsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_facultades`.`id`,`viga_facultades`.`nombre`
			FROM `viga_facultades` INNER JOIN `viga_iniciativas_plan_facultad` ON `viga_facultades`.`id` = `viga_iniciativas_plan_facultad`.`id_facultad`
			WHERE `viga_iniciativas_plan_facultad`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateDepartmentsByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_facultad", [
				"id_iniciativa" => $idInitiative
			]
		);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_facultad", [
				"id_iniciativa" => $idInitiative,
				"id_facultad" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_plan_facultad", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

	/* RELACIÓN UNIDAD - INICIATIVA REAL */
	function getDepartmentsByInitiativeReal($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_facultades`.`id`,`viga_facultades`.`nombre`
			FROM `viga_facultades` INNER JOIN `viga_iniciativas_real_unidad` ON `viga_facultades`.`id` = `viga_iniciativas_real_unidad`.`id_facultad`
			WHERE `viga_iniciativas_real_unidad`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateDepartmentsByInitiativeReal($idInitiative = null, $units = null, $autor = null) {
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
				"id_facultad" => $units[$i]
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

	function countVisibleDepartmentsByInstitution($institution = null) {
		include("db_config.php");

		$datas = $db->count("viga_facultades", "id",
			[
        "visible" => "1",
        "institucion" => $institution,
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function countSummaryVisibleDepartmentsByInitiativeGroup($initiativeGroup = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT `viga_facultades`.`id`, `viga_facultades`.`nombre`, COUNT(`viga_iniciativas_plan_facultad`.`id`) as iniciativas
			FROM `viga_facultades` INNER JOIN `viga_iniciativas_plan_facultad` ON `viga_facultades`.`id` = `viga_iniciativas_plan_facultad`.`id_facultad`
			WHERE `viga_iniciativas_plan_facultad`.`id_iniciativa` IN ($initiativeGroup)
			GROUP BY `viga_facultades`.`id`, `viga_facultades`.`nombre`
			ORDER BY iniciativas DESC"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
