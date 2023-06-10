<?php
	/* ATRIBUTOS - FRECUENCIA */
	function getFrecuency($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_atributo_frecuencia",
			[
				"id",
				"nombre",
				"descripcion",
				"puntaje",
				"visible",
				"fecha_creacion"
			],
			[
				"id" => $id
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	function getVisibleFrecuency() {
		include("db_config.php");

		$datas = $db->select("viga_atributo_frecuencia",
			[
				"id",
				"nombre",
				"descripcion",
				"puntaje",
				"visible",
				"fecha_creacion"
			],
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/* ATRIBUTOS - MECANISMO */
	function getMechanism($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_atributo_mecanismo",
			[
				"id",
				"nombre",
				"descripcion",
				"puntaje",
				"visible",
				"fecha_creacion"
			],
			[
				"id" => $id
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	function getVisibleMechanism() {
		include("db_config.php");

		$datas = $db->select("viga_atributo_mecanismo",
			[
				"id",
				"nombre",
				"descripcion",
				"puntaje",
				"visible",
				"fecha_creacion"
			],
			[
				"visible" => "1",
				"ORDER" => [
	        "puntaje" => "ASC",
	      ]
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	function getVisibleMechanismByProgram($program) {
		include("db_config.php");

		$datas = $db->select("viga_atributo_mecanismo",
			[
				"[><]viga_programas_tipo_accion" => ["viga_atributo_mecanismo.id" => "id_mecanismo"]
			],
			[
				"viga_atributo_mecanismo.id",
				"viga_atributo_mecanismo.nombre",
				"viga_atributo_mecanismo.descripcion",
				"viga_atributo_mecanismo.puntaje",
				"viga_atributo_mecanismo.visible",
				"viga_atributo_mecanismo.fecha_creacion"
			],
			[
				"viga_programas_tipo_accion.visible" => "1",
				"viga_programas_tipo_accion.id_programa" => $program
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	/*
		SELECT `id`, `id_mecanismo`, `nombre`, `visible`, `fecha_creacion`
		FROM `viga_atributo_mecanismo_actividad` WHERE 1
	*/
	/* ATRIBUTOS - MECANISMO - ACTIVIDAD */
	function getVisibleMechanismActivityById($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_atributo_mecanismo_actividad",
			[
				"[><]viga_atributo_mecanismo" => ["id_mecanismo" => "id"],
			],
			[
				"viga_atributo_mecanismo_actividad.id",
				"viga_atributo_mecanismo_actividad.id_mecanismo",
				"viga_atributo_mecanismo_actividad.nombre",
				"viga_atributo_mecanismo_actividad.visible",
				"viga_atributo_mecanismo_actividad.fecha_creacion",
				"viga_atributo_mecanismo.nombre(mecanismo_nombre)"
			],
			[
				"viga_atributo_mecanismo_actividad.visible" => "1",
				"viga_atributo_mecanismo_actividad.id" => $id,
				"ORDER" => [
	        "viga_atributo_mecanismo_actividad.id_mecanismo" => "ASC",
	      ]
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	function getVisibleMechanismActivity() {
		include("db_config.php");

		$datas = $db->select("viga_atributo_mecanismo_actividad",
			[
				"[><]viga_atributo_mecanismo" => ["id_mecanismo" => "id"],
			],
			[
				"viga_atributo_mecanismo_actividad.id",
				"viga_atributo_mecanismo_actividad.id_mecanismo",
				"viga_atributo_mecanismo_actividad.nombre",
				"viga_atributo_mecanismo_actividad.visible",
				"viga_atributo_mecanismo_actividad.fecha_creacion",
				"viga_atributo_mecanismo.nombre(mecanismo_nombre)"
			],
			[
				"viga_atributo_mecanismo_actividad.visible" => "1",
				"ORDER" => [
	        "viga_atributo_mecanismo_actividad.id_mecanismo" => "ASC",
	      ]
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}

	function countVisibleMechanism() {
		include("db_config.php");

		$datas = $db->count("viga_atributo_mecanismo",
			"id",
			[
				"visible" => "1"
			]
		);
		//echo "query: " . $db->last();
		return $datas;
	}
?>
