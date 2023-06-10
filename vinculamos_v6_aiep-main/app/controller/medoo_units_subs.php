<?php

	/*
		SELECT `id`, `nombre`, `descripcion`, `director`, `id_unidad`,
			`visible`, `institucion`, `autor`, `fecha_creacion`
		FROM `viga_unidades_subs` WHERE 1
	*/

	function addUnitSub($nombre = null, $descripcion = null, $director = null, $id_unidad = null, $autor = null, $institucion = null) {
		include("db_config.php");

		$db->insert("viga_unidades_subs",
			[
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"director" => $director,
				"id_unidad" => $id_unidad,
				"institucion" => $institucion,
				"autor" => $autor
			]
		);

		//echo "<br>query: " . $db->last();

		$id = $db->id();
		$datas = $db->select("viga_unidades_subs", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["director"] == $director) $verificator++;
		if($datas[0]["id_unidad"] == $id_unidad) $verificator++;
		if($datas[0]["institucion"] == $institucion) $verificator++;
		if($datas[0]["autor"] == $autor) $verificator++;
		if($verificator == 6) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "unidades_sub", $id, "Nuevo registro con valores {nombre => $nombre, descripción => $descripcion, director => $director, institucion => $institucion}");
			return $datas;
		}return null;
	}

	function editUnitSub($id = null, $nombre = null, $descripcion = null, $director = null, $id_unidad = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_unidades_subs",
			[
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"director" => $director
			],
			[
				"id" => $id,
				"id_unidad" => $id_unidad
			]
		);
		//echo "<br>query: " . $db->last();

		$datas = $db->select("viga_unidades_subs", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["director"] == $director) $verificator++;
		if($verificator == 3) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "unidades_sub", $id, "Modificación en registro con valores {nombre => $nombre, descripción => $descripcion, director => $director}");
			return $datas;
		}return null;
	}

	function deleteUnitSub($id = null, $id_unidad = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_unidades_subs",
			[
				"visible" => "-1",
			],
			[
				"id" => $id,
				"id_unidad" => $id_unidad
			]
		);
		//echo "<br>query: " . $db->last();

		$datas = $db->select("viga_unidades_subs", "*", ["id" => $id]);

		$verificator = 0;
		if($datas[0]["visible"] == "-1") $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "unidades_sub", $id, "Eliminación de registro con valores {id => $id, visible => -1}");
			return $datas;
		}return null;
	}

	function getUnitSub($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_unidades_subs",
			[
				"id",
				"nombre",
				"descripcion",
				"director",
				"id_unidad",
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

	function getVisibleUnitsSubByUnit($id_unidad = null) {
		include("db_config.php");

		$datas = $db->select("viga_unidades_subs",
			[
				"id",
				"nombre",
				"descripcion",
				"director",
				"id_unidad",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"id_unidad" => $id_unidad
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	/* RELACIÓN SUB UNIDAD - INICIATIVA PLAN */
	function getUnitsSubByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_unidades_subs`.`id`,`viga_unidades_subs`.`nombre`
			FROM `viga_unidades_subs` INNER JOIN `viga_iniciativas_plan_unidad_sub` ON `viga_unidades_subs`.`id` = `viga_iniciativas_plan_unidad_sub`.`id_unidad_sub`
			WHERE `viga_iniciativas_plan_unidad_sub`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateUnitsSubByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_unidad_sub", [
				"id_iniciativa" => $idInitiative
			]
		);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_unidad_sub", [
				"id_iniciativa" => $idInitiative,
				"id_unidad_sub" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_plan_unidad_sub", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

?>
