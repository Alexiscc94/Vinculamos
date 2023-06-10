<?php

	/*
		SELECT `id`, `nombre`, `descripcion`, `visible`, `institucion`, `autor`, `fecha_creacion`
		FROM `viga_convenios` WHERE 1
	*/

	function addCovenant($nombre = null, $descripcion = null, $autor = null, $institucion = null) {
		include("db_config.php");

		$db->insert("viga_convenios",
			[
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"institucion" => $institucion,
				"autor" => $autor
			]
		);

		//echo "<br>query: " . $db->last();

		$id = $db->id();
		$datas = $db->select("viga_convenios", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["institucion"] == $institucion) $verificator++;
		if($datas[0]["autor"] == $autor) $verificator++;
		if($verificator == 4) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "convenio", $id, "Nuevo registro con valores {nombre => $nombre, descripción => $descripcion, institucion => $institucion}");
			return $datas;
		}return null;
	}

	function editCovenant($id = null, $nombre = null, $descripcion = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_convenios",
			[
				"nombre" => $nombre,
				"descripcion" => $descripcion
			],
			[
				"id" => $id
			]
		);
		//echo "<br>query: " . $db->last();

		$datas = $db->select("viga_convenios", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["nombre"] == $nombre) $verificator++;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($verificator == 2) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "convenio", $id, "Modificación en registro con valores {nombre => $nombre, descripción => $descripcion, director => $director}");
			return $datas;
		}return null;
	}

	function editCovenantOtherFields($id = null, $direccion = null, $nombre_contacto = null, $telefono = null,
		$correo_electronico = null, $fecha_suscripcion = null, $observaciones = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_convenios",
			[
				"direccion" => $direccion,
				"nombre_contacto" => $nombre_contacto,
				"telefono" => $telefono,
				"correo_electronico" => $correo_electronico,
				"fecha_suscripcion" => $fecha_suscripcion,
				"observaciones" => $observaciones
			],
			[
				"id" => $id
			]
		);
		//echo "<br>query: " . $db->last();

		$datas = $db->select("viga_convenios", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["direccion"] == $direccion) $verificator++;
		if($datas[0]["nombre_contacto"] == $nombre_contacto) $verificator++;
		if($datas[0]["telefono"] == $telefono) $verificator++;
		if($datas[0]["correo_electronico"] == $correo_electronico) $verificator++;
		if($datas[0]["fecha_suscripcion"] == $fecha_suscripcion) $verificator++;
		if($datas[0]["observaciones"] == $observaciones) $verificator++;
		if($verificator == 6) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "convenio", $id, "Modificación en registro con valores {direccion => $direccion,
				nombre_contacto => $nombre_contacto, telefono => $telefono, correo_electronico => $correo_electronico,
				fecha_suscripcion => $fecha_suscripcion, observaciones => $observaciones}");
			return $datas;
		}return null;
	}

	function deleteCovenant($id = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_convenios",
			[
				"visible" => "-1",
			],
			[
				"id" => $id
			]
		);
		//echo "<br>query: " . $db->last();

		$datas = $db->select("viga_convenios", "*", ["id" => $id]);

		$verificator = 0;
		if($datas[0]["visible"] == "-1") $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "convenio", $id, "Eliminación de registro con valores {id => $id, visible => -1}");
			return $datas;
		}return null;
	}

	function getCovenant($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_convenios",
			[
				"id",
				"nombre",
				"descripcion",

				"direccion",
				"nombre_contacto",
				"telefono",
				"correo_electronico",
				"fecha_suscripcion",
				"observaciones",

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

	function getVisibleCovenantsByInstitution($institucion = null) {
		include("db_config.php");

		$datas = $db->select("viga_convenios",
			[
				"id",
				"nombre",
				"descripcion",

				"direccion",
				"nombre_contacto",
				"telefono",
				"correo_electronico",
				"fecha_suscripcion",
				"observaciones",

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

	function getVisibleCovenantsByInstitutionId($institucion = null, $id = null) {
		include("db_config.php");

		$datas = $db->select("viga_convenios",
			[
				"id",
				"nombre",
				"descripcion",

				"direccion",
				"nombre_contacto",
				"telefono",
				"correo_electronico",
				"fecha_suscripcion",
				"observaciones",

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

	function getVisibleCovenants() {
		include("db_config.php");

		$datas = $db->select("viga_convenios",
			[
				"id",
				"nombre",
				"descripcion",
				"direccion",
				"nombre_contacto",
				"telefono",
				"correo_electronico",
				"fecha_suscripcion",
				"observaciones",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);

		return $datas;
	}

	function getCovenantsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->query(
			"SELECT DISTINCT `viga_convenios`.`id`,`viga_convenios`.`nombre`
			FROM `viga_convenios` INNER JOIN `viga_iniciativas_plan_convenio` ON `viga_convenios`.`id` = `viga_iniciativas_plan_convenio`.`id_convenio`
			WHERE `viga_iniciativas_plan_convenio`.`id_iniciativa` = '$idInitiative'"
		)->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function updateCovenantsByInitiativePlan($idInitiative = null, $units = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_convenio", [
				"id_iniciativa" => $idInitiative
			]);
		//echo "<br>query: " . $db->last();

		$unitsForLog = "";
		for($i=0; $i<sizeof($units); $i++) {
			$db->insert("viga_iniciativas_plan_convenio", [
				"id_iniciativa" => $idInitiative,
				"id_convenio" => $units[$i]
			]);

			$unitsForLog .= ($units[$i] . " ");
			//echo "<br>query: " . $db->last();
		}

		if(true) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativa_convenio", $idInitiative, "Modificación de ambito con valores {units => [$unitsForLog], autor => $autor}");
			return $datas;
		}
	}

?>
