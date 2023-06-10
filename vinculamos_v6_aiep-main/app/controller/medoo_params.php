<?php
	/* CARGO DEL ENCARGADO */
	function getVisibleManagerPositions() {
		include("db_config.php");

		$datas = $db->select("viga_param_cargo_encargado",
			[
				"id",
				"nombre",
				"visible",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* FORMATO IMPLEMENTACION */
	function getVisibleImplementationFormats() {
		include("db_config.php");

		$datas = $db->select("viga_param_formato_implementacion",
			[
				"id",
				"nombre",
				"visible",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* TIPO ESTADO EJECUCIÓN */
	function getVisibleExecutionStatus() {
		include("db_config.php");

		$datas = $db->select("viga_param_estado_ejecucion",
			[
				"id",
				"nombre",
				"visible",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* TIPO ESTADO COMPLETITUD  */
	function getVisibleFillmentStatus() {
		include("db_config.php");

		$datas = $db->select("viga_param_estado_completitud",
			[
				"id",
				"nombre",
				"visible",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* PARTICIPANTES  */
	function getVisibleParticipantTypes() {
		include("db_config.php");

		$datas = $db->select("viga_param_participantes",
			[
				"id",
				"nombre",
				"tipo",
				"visible",
				"autor",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

?>
