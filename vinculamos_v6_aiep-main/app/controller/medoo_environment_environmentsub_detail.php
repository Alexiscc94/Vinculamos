<?php
	/*
		SELECT `id`, `id_iniciativa`, `id_entorno`, `id_entorno_sub`, `tag`, autor, `fecha_creacion`
		FROM `viga_iniciativas_plan_entorno_entornosub_detalle` WHERE 1
	*/

	/* PLAN */
	function addEnvironmentSubDetailPlan($idInitiative = null, $idEnvironment = null,
		$idSubEnvironment = null, $tag = null, $autor = null) {
		include("db_config.php");

		$db->insert("viga_iniciativas_plan_entorno_entornosub_detalle",
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment,
				"id_entorno_sub" => $idSubEnvironment,
				"tag" => $tag,
				"autor" => $autor,
				//"autor" => $autor
			]
		);
		//echo "<br>query: " . $db->last();

		$id = $db->id();
		$datas = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["id_iniciativa"] == $idInitiative) $verificator++;
		if($datas[0]["id_entorno"] == $idEnvironment) $verificator++;
		//if($datas[0]["id_entorno_sub"] == $idSubEnvironment) $verificator++;
		if($datas[0]["tag"] == $tag) $verificator++;
		if($datas[0]["autor"] == $autor) $verificator++;
		if($verificator == 4) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "entorno_detalle", $id, "Nuevo registro con valores {id_iniciativa => $idInitiative, id_entorno => $idEnvironment, id_entornosub => $idSubEnvironment, tag => $tag}");
			return $datas;
		}return null;
	}

	function deleteTagPlan($id = null, $idInitiative = null, $idEnvironment = null, $idSubEnvironment = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan_entorno_entornosub_detalle",
			[
        "tag" => ""
			],
			[
				"id" => $id,
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment,
				"id_entorno_sub" => $idSubEnvironment,
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["tag"] == "") $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "entorno_detalle", $id, "Modificación en registro con valores {tag =>''}");
			return $datas;
		}return null;
	}

	function deleteSubEnvPlan($idInitiative = null, $idEnvironment = null, $idSubEnvironment = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_entorno_entornosub_detalle", [
			"id_iniciativa" => $idInitiative,
			"id_entorno" => $idEnvironment,
			"id_entorno_sub" => $idSubEnvironment,
			]);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle", "*",
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment,
				"id_entorno_sub" => $idSubEnvironment,
			]);
		if($datas == null) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "entorno_detalle", $id, "Eliminacion de registro con valores {id_iniciativa =>'$idInitiative, id_entorno => $idEnvironment, id_entorno_sub => $idSubEnvironment}");
			return $datas;
		}return null;
	}

	function deleteEnvPlan($idInitiative = null, $idEnvironment = null, $autor = null) {
		include("db_config.php");

		$db->delete("viga_iniciativas_plan_entorno_entornosub_detalle", [
			"id_iniciativa" => $idInitiative,
			"id_entorno" => $idEnvironment
			]);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle", "*",
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment
			]);
		if($datas == null) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "entorno_detalle", $id, "Eliminacion de registro con valores {id_iniciativa =>'$idInitiative, id_entorno => $idEnvironment}");
			return $datas;
		}return null;
	}

	function getEnvironmentSubDetailsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle",
			[
				"id",
				"id_iniciativa",
				"id_entorno",
				"id_entorno_sub",
				"tag",
				"autor"
			],
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getEnvironmentSubDetailsByInitiativePlanEnv($idInitiative = null, $idEnvironment = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle",
			[
				"id",
				"id_iniciativa",
				"id_entorno",
				"id_entorno_sub",
				"tag",
				"autor"
			],
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment,
				"ORDER" => [
					"tag" => "ASC"
				]
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getEnvironmentSubDetailsByInitiativePlanEnvSub($idInitiative = null,
		$idEnvironment = null, $idSubEnvironment = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle",
			[
				"id",
				"id_iniciativa",
				"id_entorno",
				"id_entorno_sub",
				"tag"
			],
			[
				"id_iniciativa" => $idInitiative,
				"id_entorno" => $idEnvironment,
				"id_entorno_sub" => $idSubEnvironment
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
