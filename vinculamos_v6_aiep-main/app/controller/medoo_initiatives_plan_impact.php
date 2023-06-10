<?php
	/*
		SELECT `id`, `id_iniciativa`, `cantidad`, `impacto`, `autor`, `visible`, `fecha_creacion`
		FROM `viga_iniciativas_plan_impacto` WHERE 1
	*/

	function addImpactToInitiativePlan($id_iniciativa = null, $tipo = null,
		$cantidad = null, $impacto = null, $institucion = null, $autor = null) {
    include("db_config.php");

    $db->insert("viga_iniciativas_plan_impacto",
      [
        "id_iniciativa" => $id_iniciativa,
        "tipo" => $tipo,
				"cantidad" => $cantidad,
        "impacto" => $impacto,
        "autor" => $autor
      ]
    );
  	//echo "<br>query: " . $db->last();

    $id = $db->id();
    $datas = $db->select("viga_iniciativas_plan_impacto", "*",["id" => $id]);
    $verificator = 0;
    if($datas[0]["id_iniciativa"] == $id_iniciativa) $verificator++;
    if($datas[0]["tipo"] == $tipo) $verificator++;
		if($datas[0]["cantidad"] == $cantidad) $verificator++;
    if($datas[0]["impacto"] == $impacto) $verificator++;
    if($datas[0]["autor"] == $autor) $verificator++;
    if($verificator == 5) {
      include_once("medoo_logs.php");
      logAction($db, $autor, "iniciativas_plan_impact", $id, "Nuevo registro con valores {id_iniciativa => $id_iniciativa, cantidad => $cantidad, impacto => $impacto}");
      return $datas;
    }return null;
  }

	function editImpactFromInitiativePlan($id_iniciativa = null, $id = null,
		$tipo = null, $cantidad = null, $impacto = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan_impacto",
			[
				"tipo" => $tipo,
				"cantidad" => $cantidad,
				"impacto" => $impacto
			],
			[
				"id_iniciativa" => $id_iniciativa,
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_impacto", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["tipo"] == $tipo) $verificator++;
		if($datas[0]["cantidad"] == $cantidad) $verificator++;
		if($datas[0]["impacto"] == $impacto) $verificator++;
		if($verificator == 3) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Eliminación de registro con valores {tipo => $tipo, cantidad => $cantidad, impacto => $impacto}");
			return $datas;
		}return null;
	}

	function deleteImpactFromInitiativePlan($id_iniciativa = null, $id = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan_impacto",
			[
				"visible" => -1
			],
			[
				"id_iniciativa" => $id_iniciativa,
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan_impacto", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["visible"] == -1) $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan_impact", $id, "Eliminación de registro con valores {visible => -1}");
			return $datas;
		}return null;
	}

	function getVisibleImpactsByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan_impacto",
			[
				"id",
				"id_iniciativa",
				"tipo",
				"cantidad",
				"impacto",
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
?>
