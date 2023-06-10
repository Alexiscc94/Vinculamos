<?php
	/*
		SELECT `id`, `id_iniciativa`, `cantidad`, `resultado`, `autor`, `visible`, `fecha_creacion`
		FROM `viga_iniciativas_plan_resultado` WHERE 1
	*/

	function addResultToInitiativePlan($id_iniciativa = null, $tipo = null,
		$cantidad = null, $resultado = null, $institucion = null, $autor = null) {
    include("db_config.php");

    $db->insert("viga_iniciativas_plan_resultado",
      [
        "id_iniciativa" => $id_iniciativa,
        "tipo" => $tipo,
				"cantidad" => $cantidad,
        "resultado" => $resultado,
        "autor" => $autor
      ]
    );
  	//echo "<br>query: " . $db->last();

    $id = $db->id();
    $datas = $db->select("viga_iniciativas_plan_resultado", "*",["id" => $id]);
    $verificator = 0;
    if($datas[0]["id_iniciativa"] == $id_iniciativa) $verificator++;
    if($datas[0]["tipo"] == $tipo) $verificator++;
		if($datas[0]["cantidad"] == $cantidad) $verificator++;
    if($datas[0]["resultado"] == $resultado) $verificator++;
    if($datas[0]["autor"] == $autor) $verificator++;
    if($verificator == 5) {
      include_once("medoo_logs.php");
      logAction($db, $autor, "iniciativas_plan", $id, "Nuevo registro con valores {id_iniciativa => $id_iniciativa, cantidad => $cantidad, resultado => $resultado}");
      return $datas;
    }return null;
  }

	function editResultFromInitiativePlan($id_iniciativa = null, $id = null,
		$tipo = null, $cantidad = null, $resultado = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan_resultado",
			[
				"tipo" => $tipo,
				"cantidad" => $cantidad,
				"resultado" => $resultado
			],
			[
				"id_iniciativa" => $id_iniciativa,
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_resultado", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["tipo"] == $tipo) $verificator++;
		if($datas[0]["cantidad"] == $cantidad) $verificator++;
		if($datas[0]["resultado"] == $resultado) $verificator++;
		if($verificator == 3) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Eliminación de registro con valores {tipo => $tipo, cantidad => $cantidad, resultado => $resultado}");
			return $datas;
		}return null;
	}

	function editRealResultFromInitiativePlan($id_iniciativa = null, $id = null,
		$cantidad = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan_resultado",
			[
				"cantidad_real" => $cantidad
			],
			[
				"id_iniciativa" => $id_iniciativa,
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_resultado", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["cantidad_real"] == $cantidad) $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Eliminación de registro con valores {cantidad_real => $cantidad}");
			return $datas;
		}return null;
	}

	function deleteResultFromInitiativePlan($id_iniciativa = null, $id = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan_resultado",
			[
				"visible" => -1
			],
			[
				"id_iniciativa" => $id_iniciativa,
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_resultado", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["visible"] == -1) $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Eliminación de registro con valores {visible => -1}");
			return $datas;
		}return null;
	}

	function getVisibleResultsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_resultado",
			[
				"id",
				"id_iniciativa",
				"tipo",
				"cantidad",
				"resultado",
				"cantidad_real",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"id_iniciativa" => $idInitiative
			]
		);

		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

	function getVisibleResultsByInitiativePlanType($idInitiative = null, $type = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_resultado",
			[
				"id",
				"id_iniciativa",
				"tipo",
				"cantidad",
				"resultado",
				"cantidad_real",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"id_iniciativa" => $idInitiative,
				"tipo" => $type
			]
		);

		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}
?>
