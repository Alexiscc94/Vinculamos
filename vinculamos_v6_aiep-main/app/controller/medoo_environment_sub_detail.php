<?php
	/*
		SELECT `id`, `id_iniciativa`, id_entorno, `id_entornosub`, `detalle`, `fecha_creacion`
		FROM `viga_iniciativas_plan_entornosubdetalle` WHERE 1
	*/

	/* PLAN */
	function addEnvironmentSubDetail($idInitiative = null, $idEnvironment = null,
		$idSubEnvironment = null, $detalle = null, $autor = null) {
		include("db_config.php");

		$db->insert("viga_iniciativas_plan_entornosubdetalle",
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment,
				"id_entornosub" => $idSubEnvironment,
				"detalle" => $detalle,
				//"autor" => $autor
			]
		);
		//echo "<br>query: " . $db->last();

		$id = $db->id();
		$datas = $db->select("viga_iniciativas_plan_entornosubdetalle", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["id_iniciativa"] == $idInitiative) $verificator++;
		if($datas[0]["id_entorno"] == $idEnvironment) $verificator++;
		if($datas[0]["id_entornosub"] == $idSubEnvironment) $verificator++;
		if($datas[0]["detalle"] == $detalle) $verificator++;
		if($verificator == 4) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "sedes", $id, "Nuevo registro con valores {id_iniciativa => $idInitiative, id_entorno => $idEnvironment, id_entornosub => $idSubEnvironment, detalle => $detalle}");
			return $datas;
		}return null;
	}

	function getEnvironmentSubDetailsByInitiativePlan($idInitiative = null, $idEnvironment = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_entornosubdetalle",
			[
				"id",
				"id_iniciativa",
				"id_entorno",
				"id_entornosub",
				"detalle"
			],
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
