<?php

	/*
		SELECT `id`, `nombre`, `visible`
		FROM `viga_evaluacion_tipo_evaluador` WHERE 1
	*/

	function getEvaluationTypes($institucion = null) {
		include("db_config.php");

		$datas = $db->select("viga_evaluacion_tipo_evaluador",
			[
				"id",
				"nombre",
				"visible"
			],
			[
				"visible" => "1"
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getEvaluationTypesByInitiatives($initiative = null) {
		include("db_config.php");

		$datas = $db->select("viga_evaluacion_tipo_evaluador",
			[
				"[><]viga_evaluacion_iniciativa" => ["nombre" => "tipo_evaluacion"],
			],
			[
				"viga_evaluacion_tipo_evaluador.id",
				"viga_evaluacion_tipo_evaluador.nombre",
				"viga_evaluacion_tipo_evaluador.visible"
			],
			[
				"viga_evaluacion_tipo_evaluador.visible" => "1",
				"viga_evaluacion_iniciativa.id_iniciativa" => $initiative
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
