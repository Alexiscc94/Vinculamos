<?php
  /*
  SELECT `id`, `nombre`, `fecha_inicio`, `fecha_fin`, `responsable`, `responsable_cargo`,
  `formato_implementacion`, `objetivo`, `descripcion`,
  `id_mecanismo`, `id_frecuencia`, `estado`, `estado_ejecucion`, `estado_completitud`,
  `visible`, `institucion`, `autor`, `fecha_creacion`
  FROM `viga_iniciativas_plan` WHERE 1
  */

  function addInitiativePlan($nombre = null, $fecha_inicio = null, $fecha_fin = null, $institucion = null, $autor = null) {
    include("db_config.php");

    $db->insert("viga_iniciativas_plan",
      [
        "nombre" => $nombre,
        "fecha_inicio" => $fecha_inicio,
        "fecha_fin" => $fecha_fin,
        "institucion" => $institucion,
        "autor" => $autor
      ]
    );
    //echo "<br>query: " . $db->last();

    $id = $db->id();
    $datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
    $verificator = 0;
    if($datas[0]["nombre"] == $nombre) $verificator++;
    if($datas[0]["fecha_inicio"] == $fecha_inicio) $verificator++;
    if($datas[0]["fecha_fin"] == $fecha_fin) $verificator++;
    if($datas[0]["institucion"] == $institucion) $verificator++;
    if($datas[0]["autor"] == $autor) $verificator++;
    if($verificator == 5) {
      include_once("medoo_logs.php");
      logAction($db, $autor, "iniciativas_plan", $id, "Nuevo registro con valores {nombre => $nombre, fecha_inicio => $fecha_inicio, fecha_fin => $fecha_fin}");
      return $datas;
    }return null;
  }

  function editInitiativePlanStep1($id = null, $nombre = null, $fecha_inicio = null, $fecha_fin = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan",
			[
        "nombre" => $nombre,
				"fecha_inicio" => $fecha_inicio,
				"fecha_fin" => $fecha_fin,
			],
			[
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
		$verificator = 0;
    if($datas[0]["nombre"] == $nombre) $verificator++;
    if($datas[0]["fecha_inicio"] == $fecha_inicio) $verificator++;
		if($datas[0]["fecha_fin"] == $fecha_fin) $verificator++;
		if($verificator == 3) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Modificación en registro con valores {nombre => $nombre, fecha_inicio => $fecha_inicio, fecha_fin => $fecha_fin}");
			return $datas;
		}return null;
	}

  function editInitiativePlanStep2($id = null, $descripcion = null, $objetivo = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan",
			[
        "descripcion" => $descripcion,
				"objetivo" => $objetivo
			],
			[
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["descripcion"] == $descripcion) $verificator++;
		if($datas[0]["objetivo"] == $objetivo) $verificator++;
		if($verificator == 2) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Modificación en registro con valores {descripcion => $descripcion, objetivo => $objetivo}");
			return $datas;
		}return null;
	}

  function editInitiativePlanMechanismFrecuency($id = null, $id_mecanismo = null,
    $id_actividad = null, $id_frecuencia = null, $autor = null) {
    include("db_config.php");

    $db->update("viga_iniciativas_plan",
      [
        "id_mecanismo" => $id_mecanismo,
        "id_actividad" => $id_actividad,
        "id_frecuencia" => $id_frecuencia
      ],
      [
        "id" => $id
      ]
    );
    //echo "query: " . $db->last();

    $datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
    $verificator = 0;
    if($datas[0]["id_mecanismo"] == $id_mecanismo) $verificator++;
    if($datas[0]["id_frecuencia"] == $id_frecuencia) $verificator++;
    if($verificator == 2) {
      include_once("medoo_logs.php");
      logAction($db, $autor, "iniciativas_plan", $id, "Modificación en registro con valores {id_mecanismo => $id_mecanismo, id_frecuencia => $id_frecuencia}");
      return $datas;
    }return null;
  }

  function editInitiativePlanAttributesStep1($id = null, $responsable = null,
    $responsable_cargo = null, $formato_implementacion = null, $autor = null) {
    include("db_config.php");

    $db->update("viga_iniciativas_plan",
      [
        "responsable" => $responsable,
        "responsable_cargo" => $responsable_cargo,
        "formato_implementacion" => $formato_implementacion
      ],
      [
        "id" => $id
      ]
    );
    //echo "query: " . $db->last();

    $datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
    $verificator = 0;
    if($datas[0]["responsable"] == $responsable) $verificator++;
    if($datas[0]["responsable_cargo"] == $responsable_cargo) $verificator++;
    if($datas[0]["formato_implementacion"] == $formato_implementacion) $verificator++;
    if($verificator == 3) {
      include_once("medoo_logs.php");
      logAction($db, $autor, "iniciativas_plan", $id, "Modificación en registro con valores {responsable => $responsable, responsable_cargo => $responsable_cargo, formato_implementacion => $formato_implementacion}");
      return $datas;
    }return null;
  }

  function editInitiativePlanStatus($id = null, $estado = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan",
			[
				"estado" => $estado
			],
			[
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["estado"] == $estado) $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Modificación en registro con valores {estado => $estado}");
			return $datas;
		}return null;
	}

  function editInitiativeStatusExecution($id = null, $estado = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan",
			[
				"estado_ejecucion" => $estado
			],
			[
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["estado_ejecucion"] == $estado) $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Modificación en registro con valores {estado_ejecucion => $estado}");
			return $datas;
		}return null;
	}

  function deleteInitiative($id = null, $autor = null) {
		include("db_config.php");

		$db->update("viga_iniciativas_plan",
			[
				"visible" => -1
			],
			[
				"id" => $id
			]
		);
		//echo "query: " . $db->last();

		$datas = $db->select("viga_iniciativas_plan", "*",["id" => $id]);
		$verificator = 0;
		if($datas[0]["visible"] == -1) $verificator++;
		if($verificator == 1) {
			include_once("medoo_logs.php");
			logAction($db, $autor, "iniciativas_plan", $id, "Eliminación de registro con valores {visible => -1}");
			return $datas;
		}return null;
	}

  function getInitiativePlan($id = null) {
		include("db_config.php");

		$datas = $db->select("viga_iniciativas_plan",
			[
        "viga_iniciativas_plan.id",
				"viga_iniciativas_plan.nombre",
        "viga_iniciativas_plan.fecha_inicio",
        "viga_iniciativas_plan.fecha_fin",

        "viga_iniciativas_plan.responsable",
        "viga_iniciativas_plan.responsable_cargo",
        "viga_iniciativas_plan.formato_implementacion",

        "viga_iniciativas_plan.objetivo",
        "viga_iniciativas_plan.descripcion",

        "viga_iniciativas_plan.id_mecanismo",
        "viga_iniciativas_plan.id_actividad",
        "viga_iniciativas_plan.id_frecuencia",
        "viga_iniciativas_plan.estado",
        "viga_iniciativas_plan.estado_ejecucion",
        "viga_iniciativas_plan.estado_completitud",
        "viga_iniciativas_plan.institucion"
			],
			[
				"visible" => "1",
				"id" => $id
			]
		);
		//echo "<br>query: " . $db->last();
		return $datas;
	}

  function getVisibleInitiativesPlanByInstitution($institution = null, $executionStatus = null, $fillmentStatus = null,
    $dateFrom = null, $dateTo = null, $unit = null, $campus = null, $program = null, $department = null) {
		include("db_config.php");

    $joins = [
      "[>]viga_atributo_mecanismo" => ["viga_iniciativas_plan.id_mecanismo" => "id"],
      "[>]viga_atributo_mecanismo_actividad" => ["viga_iniciativas_plan.id_actividad" => "id"],
      "[>]viga_atributo_frecuencia" => ["viga_iniciativas_plan.id_frecuencia" => "id"],
		];

    $conditions = [
      "viga_iniciativas_plan.visible" => "1",
      "viga_iniciativas_plan.institucion" => $institution,
      "ORDER" => [
        "viga_iniciativas_plan.fecha_creacion" => "DESC",
        "viga_iniciativas_plan.id" => "DESC"
      ]
		];

    /* Filtro por estado de ejecución */
		if($executionStatus != "") {
			$extra = [
				"viga_iniciativas_plan.estado_ejecucion" => $executionStatus,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por estado de completitud */
		if($fillmentStatus != "") {
			$extra = [
				"viga_iniciativas_plan.estado_completitud" => $fillmentStatus,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por fecha desde */
		if($dateFrom != "") {
			$extra = [
				"viga_iniciativas_plan.fecha_inicio[>=]" => $dateFrom,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por fecha hasta */
		if($dateTo != "") {
			$extra = [
				"viga_iniciativas_plan.fecha_fin[<=]" => $dateTo,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por unidad */
		if($unit != "") {
			$extra = [
				"viga_iniciativas_plan_unidad.id_unidad" => $unit,
			];
			$conditions = array_merge($conditions, $extra);

      $extraJoin = [
				"[><]viga_iniciativas_plan_unidad" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				//"[><]viga_escuelas" => ["viga_iniciativas_escuela.id_escuela" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por sede */
		if($campus != "") {
			$extra = [
				"viga_iniciativas_plan_sede.id_sede" => $campus,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_sede" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				//"[><]viga_sedes" => ["viga_iniciativas_sede.id_sede" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

    /* Filtro por programa */
		if($program != "") {
			$extra = [
				"viga_iniciativas_plan.id_programa" => $program,
        //"[><]viga_programas" => ["viga_iniciativas_plan.id_programa" => "id"],
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por facultad */
		if($department != "") {
			$extra = [
				"viga_iniciativas_plan_facultad.id_facultad" => $department,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_facultad" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				//"[><]viga_carreras" => ["viga_iniciativas_carrera.id_carrera" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		$datas = $db->select("viga_iniciativas_plan",
        $joins,
			[
        "viga_iniciativas_plan.id",
				"viga_iniciativas_plan.nombre",
        "viga_iniciativas_plan.fecha_inicio",
        "viga_iniciativas_plan.fecha_fin",

        "viga_iniciativas_plan.responsable",
        "viga_iniciativas_plan.responsable_cargo",
        "viga_iniciativas_plan.formato_implementacion",

        "viga_iniciativas_plan.objetivo",
        "viga_iniciativas_plan.descripcion",

        "viga_iniciativas_plan.id_mecanismo",
        "viga_iniciativas_plan.id_actividad",
        "viga_iniciativas_plan.id_frecuencia",
        "viga_iniciativas_plan.estado",
        "viga_iniciativas_plan.estado_ejecucion",
        "viga_iniciativas_plan.estado_completitud",
        "viga_iniciativas_plan.institucion",

        "viga_atributo_mecanismo.nombre(mecanismo_nombre)",
        "viga_atributo_mecanismo_actividad.nombre(actividad_nombre)",
        "viga_atributo_frecuencia.nombre(frecuencia_nombre)"
			],
			   $conditions
		);
		//echo "query: " . $db->last();
		return $datas;
	}

  function findInitiativesByFilters($institution = null, $unit = null, $campus = null,
		$environment = null, $mechanism = null, $program = null, $covenant = null,
		$country = null, $region = null, $commune = null, $department = null,
    $implementationFormat = null, $frecuency = null, $executionStatus = null, $fillmentStatus = null) {
		include("db_config.php");

		$joins = [
      //"[><]viga_iniciativas_plan_programa" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
      //"[><]viga_programas" => ["viga_iniciativas_plan_programa.id_programa" => "id"],
      "[><]viga_usuarios" => ["viga_iniciativas_plan.autor" => "nombre_usuario"],
			//"[><]viga_iniciativa_unidad" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
			//"[><]viga_unidades" => ["viga_iniciativa_unidad.id_unidad" => "id"],

			//"[><]viga_iniciativa_entorno" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
			//"[><]viga_entornos" => ["viga_iniciativa_entorno.id_entorno" => "id"]
		];

		$conditions = [
				"viga_iniciativas_plan.visible" => "1",
				"viga_iniciativas_plan.institucion" => $institution,
				"ORDER" => [
					"viga_iniciativas_plan.id" => "DESC",
				]
			];
		/* Filtro por unidad */
		if($unit != "") {
			$extra = [
				"viga_iniciativas_plan_unidad.id_unidad" => $unit,
			];
			$conditions = array_merge($conditions, $extra);

      $extraJoin = [
				"[><]viga_iniciativas_plan_unidad" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				//"[><]viga_unidades" => ["viga_iniciativas_plan_unidad.id_unidad" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por sede */
		if($campus != "") {
			$extra = [
				"viga_iniciativas_plan_sede.id_sede" => $campus,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_sede" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				//"[><]viga_sedes" => ["viga_iniciativas_sede.id_sede" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por entorno significativo */
		if($environment != "") {
			$extra = [
				"viga_entornos_significativos.id" => $environment,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_entorno_entornosub_detalle" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				"[><]viga_entornos_significativos" => ["viga_iniciativas_plan_entorno_entornosub_detalle.id_entorno" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por mecanismo */
		if($mechanism != "") {
			$extra = [
				"viga_atributo_mecanismo.id" => $mechanism,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_atributo_mecanismo" => ["viga_iniciativas_plan.id_mecanismo" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por programa */
		if($program != "") {
			$extra = [
				"viga_programas.id" => $program,
			];
			$conditions = array_merge($conditions, $extra);

      $extraJoin = [
        "[><]viga_iniciativas_plan_programa" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
        "[><]viga_programas" => ["viga_iniciativas_plan_programa.id_programa" => "id"],
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por convenio */
		if($covenant != "") {
			$extra = [
				"viga_convenios.id" => $covenant,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_convenio" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				"[><]viga_convenios" => ["viga_iniciativas_plan_convenio.id_convenio" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por pais */
		if($country != "") {
			$extra = [
				"viga_geo_pais.id" => $country,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_geopais" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				"[><]viga_geo_pais" => ["viga_iniciativas_plan_geopais.id_pais" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por región */
		if($region != "") {
			$extra = [
				"viga_geo_region.id" => $region,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_georegion" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				"[><]viga_geo_region" => ["viga_iniciativas_plan_georegion.id_region" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

		/* Filtro por comuna */
		if($commune != "") {
			$extra = [
				"viga_geo_comuna.id" => $commune,
			];
			$conditions = array_merge($conditions, $extra);

			$extraJoin = [
				"[><]viga_iniciativas_plan_geocomuna" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				"[><]viga_geo_comuna" => ["viga_iniciativas_plan_geocomuna.id_comuna" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

    /* Filtro por facultad */
		if($department != "") {
			$extra = [
				"viga_facultades.id" => $department,
			];
			$conditions = array_merge($conditions, $extra);

      $extraJoin = [
				"[><]viga_iniciativas_plan_facultad" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
				"[><]viga_facultades" => ["viga_iniciativas_plan_facultad.id_facultad" => "id"]
			];
			$joins = array_merge($joins, $extraJoin);
		}

    /* Filtro por formato de implementacion */
		if($implementationFormat != "") {
			$extra = [
				"viga_iniciativas_plan.formato_implementacion" => $implementationFormat,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por formato de implementacion */
		if($frecuency != "") {
			$extra = [
				"viga_iniciativas_plan.id_frecuencia" => $frecuency,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por estado de ejecución */
		if($executionStatus != "") {
			$extra = [
				"viga_iniciativas_plan.estado_ejecucion" => $executionStatus,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por estado de completitud */
		if($fillmentStatus != "") {
			$extra = [
				"viga_iniciativas_plan.estado_completitud" => $fillmentStatus,
			];
			$conditions = array_merge($conditions, $extra);
		}

		$datas = $db->select("viga_iniciativas_plan",
				$joins,
			[
				"viga_iniciativas_plan.id",
				"viga_iniciativas_plan.nombre",
				//"viga_iniciativas_plan.descripcion",
				"viga_iniciativas_plan.responsable",
        "viga_iniciativas_plan.id_mecanismo",
        "viga_iniciativas_plan.id_actividad",
        "viga_iniciativas_plan.id_frecuencia",
				"viga_iniciativas_plan.fecha_creacion",

        "viga_iniciativas_plan.estado",
        "viga_iniciativas_plan.estado_ejecucion",
        "viga_iniciativas_plan.estado_completitud",
			],
				$conditions
		);
		//echo "query: " . $db->last() . "<br><br>";

		//return array_unique($datas);
		return ($datas);
	}

  function getVisibleInitiativesPlanByInstitutionFull($institution = null, $id_initiative = null,
    $executionStatus = null, $fillmentStatus = null) {
		include("db_config.php");

    $conditions = [
      "viga_iniciativas_plan.visible" => "1",
      "viga_iniciativas_plan.institucion" => $institution,
      "ORDER" => [
        "viga_iniciativas_plan.fecha_creacion" => "DESC",
      ]
		];
    if($id_initiative != "") {
			$extra = [
				"viga_iniciativas_plan.id" => $id_initiative,
			];
			$conditions = array_merge($conditions, $extra);
		}
    /* Filtro por estado de ejecución */
		if($executionStatus != "") {
			$extra = [
				"viga_iniciativas_plan.estado_ejecucion" => $executionStatus,
			];
			$conditions = array_merge($conditions, $extra);
		}

    /* Filtro por estado de completitud */
		if($fillmentStatus != "") {
			$extra = [
				"viga_iniciativas_plan.estado_completitud" => $fillmentStatus,
			];
			$conditions = array_merge($conditions, $extra);
		}

		$datas = $db->select("viga_iniciativas_plan",
      [
        "[><]viga_iniciativas_plan_programa" => ["viga_iniciativas_plan.id" => "id_iniciativa"],
        "[><]viga_programas" => ["viga_iniciativas_plan_programa.id_programa" => "id"],
        "[>]viga_atributo_mecanismo" => ["viga_iniciativas_plan.id_mecanismo" => "id"],
        "[>]viga_atributo_mecanismo_actividad" => ["viga_iniciativas_plan.id_actividad" => "id"],
        "[>]viga_atributo_frecuencia" => ["viga_iniciativas_plan.id_frecuencia" => "id"],
      ],
			[
        "viga_iniciativas_plan.id",
				"viga_iniciativas_plan.nombre",
        "viga_iniciativas_plan.fecha_inicio",
        "viga_iniciativas_plan.fecha_fin",

        "viga_iniciativas_plan.responsable",
        "viga_iniciativas_plan.responsable_cargo",
        "viga_iniciativas_plan.formato_implementacion",

        "viga_iniciativas_plan.objetivo",
        "viga_iniciativas_plan.descripcion",

        //"viga_iniciativas_plan.id_mecanismo",
        //"viga_iniciativas_plan.id_frecuencia",
        "viga_iniciativas_plan.estado",
        "viga_iniciativas_plan.estado_ejecucion",
        "viga_iniciativas_plan.estado_completitud",
        "viga_iniciativas_plan.institucion",

        "viga_atributo_mecanismo.nombre(mecanismo_nombre)",
        "viga_atributo_mecanismo_actividad.nombre(actividad_nombre)",
        "viga_atributo_frecuencia.nombre(frecuencia_nombre)"
			],
			   $conditions
		);

    for ($i=0; $i < sizeof($datas); $i++) {
      $id_iniciativa = $datas[$i]["id"];

      /* UNIDADES */
      $datas_units = $db->query(
        "SELECT DISTINCT `viga_unidades`.`id`,`viga_unidades`.`nombre`
  			FROM `viga_unidades` INNER JOIN `viga_iniciativas_plan_unidad` ON `viga_unidades`.`id` = `viga_iniciativas_plan_unidad`.`id_unidad`
  			WHERE `viga_iniciativas_plan_unidad`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_units); $j++) {
        unset($datas_units[$j][0]);
        unset($datas_units[$j][1]);
      }
      $datas[$i]["unidades"] = $datas_units;

      /* UNIDADES SUB */
      $datas_units_sub = $db->query(
        "SELECT DISTINCT `viga_unidades_subs`.`id`,`viga_unidades_subs`.`nombre`
  			FROM `viga_unidades_subs` INNER JOIN `viga_iniciativas_plan_unidad_sub` ON `viga_unidades_subs`.`id` = `viga_iniciativas_plan_unidad_sub`.`id_unidad_sub`
  			WHERE `viga_iniciativas_plan_unidad_sub`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_units_sub); $j++) {
        unset($datas_units_sub[$j][0]);
        unset($datas_units_sub[$j][1]);
      }
      $datas[$i]["unidades_sub"] = $datas_units_sub;

      /* SEDES */
      $datas_campus = $db->query(
        "SELECT DISTINCT `viga_sedes`.`id`,`viga_sedes`.`nombre`
  			FROM `viga_sedes` INNER JOIN `viga_iniciativas_plan_sede` ON `viga_sedes`.`id` = `viga_iniciativas_plan_sede`.`id_sede`
  			WHERE `viga_iniciativas_plan_sede`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_campus); $j++) {
        unset($datas_campus[$j][0]);
        unset($datas_campus[$j][1]);
      }
      $datas[$i]["sedes"] = $datas_campus;

      /* FACULTADES */
      $datas_departments = $db->query(
        "SELECT DISTINCT `viga_facultades`.`id`,`viga_facultades`.`nombre`
  			FROM `viga_facultades` INNER JOIN `viga_iniciativas_plan_facultad` ON `viga_facultades`.`id` = `viga_iniciativas_plan_facultad`.`id_facultad`
  			WHERE `viga_iniciativas_plan_facultad`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_departments); $j++) {
        unset($datas_departments[$j][0]);
        unset($datas_departments[$j][1]);
      }
      $datas[$i]["facultades"] = $datas_departments;

      /* CARRERAS */
      $datas_carrers = $db->query(
        "SELECT DISTINCT `viga_carreras`.`id`,`viga_carreras`.`nombre`
  			FROM `viga_carreras` INNER JOIN `viga_iniciativas_plan_carrera` ON `viga_carreras`.`id` = `viga_iniciativas_plan_carrera`.`id_carrera`
  			WHERE `viga_iniciativas_plan_carrera`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_carrers); $j++) {
        unset($datas_carrers[$j][0]);
        unset($datas_carrers[$j][1]);
      }
      $datas[$i]["carreras"] = $datas_carrers;

      /* PROGRAMAS */
      $datas_programs = $db->query(
        "SELECT DISTINCT `viga_programas`.`id`,`viga_programas`.`nombre`
  			FROM `viga_programas` INNER JOIN `viga_iniciativas_plan_programa` ON `viga_programas`.`id` = `viga_iniciativas_plan_programa`.`id_programa`
  			WHERE `viga_iniciativas_plan_programa`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_programs); $j++) {
        unset($datas_programs[$j][0]);
        unset($datas_programs[$j][1]);
      }
      $datas[$i]["programas"] = $datas_programs;

      /* PROGRAMAS SECUNDARIOS */
      $datas_programs_second = $db->query(
        "SELECT DISTINCT `viga_programas`.`id`,`viga_programas`.`nombre`
  	    FROM `viga_programas` INNER JOIN `viga_iniciativas_plan_programasecundario` ON `viga_programas`.`id` = `viga_iniciativas_plan_programasecundario`.`id_programa`
  	    WHERE `viga_iniciativas_plan_programasecundario`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_programs_second); $j++) {
        unset($datas_programs_second[$j][0]);
        unset($datas_programs_second[$j][1]);
      }
      $datas[$i]["programas_secundarios"] = $datas_programs_second;

      /* CONVENIOS */
      $datas_covenants = $db->query(
        "SELECT DISTINCT `viga_convenios`.`id`,`viga_convenios`.`nombre`
  			FROM `viga_convenios` INNER JOIN `viga_iniciativas_plan_convenio` ON `viga_convenios`.`id` = `viga_iniciativas_plan_convenio`.`id_convenio`
  			WHERE `viga_iniciativas_plan_convenio`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_covenants); $j++) {
        unset($datas_covenants[$j][0]);
        unset($datas_covenants[$j][1]);
      }
      $datas[$i]["convenios"] = $datas_covenants;

      /* ENTORNOS */
      $datas_envs = $db->query(
        "SELECT DISTINCT `viga_entornos_significativos`.`id`,`viga_entornos_significativos`.`nombre`
  			FROM `viga_entornos_significativos` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno`
  			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_envs); $j++) {
        unset($datas_envs[$j][0]);
        unset($datas_envs[$j][1]);

        $id_entorno = $datas_envs[$j]["id"];
        $datas_envs_subs = $db->query(
          "SELECT DISTINCT `viga_entornos_significativos_sub`.`id`,`viga_entornos_significativos_sub`.`nombre`
    			FROM `viga_entornos_significativos_sub` INNER JOIN `viga_iniciativas_plan_entorno_entornosub_detalle` ON `viga_entornos_significativos_sub`.`id` = `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno_sub`
    			WHERE `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_iniciativa` = '$id_iniciativa'
    			AND `viga_iniciativas_plan_entorno_entornosub_detalle`.`id_entorno` = '$id_entorno'"
    		)->fetchAll();
        for ($k=0; $k < sizeof($datas_envs_subs); $k++) {
          unset($datas_envs_subs[$k][0]);
          unset($datas_envs_subs[$k][1]);

          $id_entorno_sub = $datas_envs_subs[$k]["id"];
          $datas_envs_subs_tags = $db->select("viga_iniciativas_plan_entorno_entornosub_detalle",
      			[
      				"tag"
      			],
      			[
      				"id_iniciativa" => $id_iniciativa,
      				"id_entorno" => $id_entorno,
      				"id_entorno_sub" => $id_entorno_sub
      			]
      		);

          for ($y=0; $y < sizeof($datas_envs_subs_tags); $y++) {
            unset($datas_envs_subs_tags[$y][0]);
            unset($datas_envs_subs_tags[$y][1]);
          }
          $datas_envs_subs[$k]["participantes"] = $datas_envs_subs_tags;
        }
        $datas_envs[$j]["sub_entornos"] = $datas_envs_subs;
      }
      $datas[$i]["entornos"] = $datas_envs;

      /* IMPACTOS INTERNOS */
      $datas_impact_internal = $db->query(
        "SELECT DISTINCT `viga_param_impacto_interno`.`id`,`viga_param_impacto_interno`.`nombre`
  			FROM `viga_param_impacto_interno` INNER JOIN `viga_iniciativas_plan_impactointerno` ON `viga_param_impacto_interno`.`id` = `viga_iniciativas_plan_impactointerno`.`id_impacto`
  			WHERE `viga_iniciativas_plan_impactointerno`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_impact_internal); $j++) {
        unset($datas_impact_internal[$j][0]);
        unset($datas_impact_internal[$j][1]);
      }
      $datas[$i]["impactos_internos"] = $datas_impact_internal;

      /* IMPACTOS EXTERNOS */
      $datas_impact_external = $db->query(
        "SELECT DISTINCT `viga_param_impacto_externo`.`id`,`viga_param_impacto_externo`.`nombre`
  			FROM `viga_param_impacto_externo` INNER JOIN `viga_iniciativas_plan_impactoexterno` ON `viga_param_impacto_externo`.`id` = `viga_iniciativas_plan_impactoexterno`.`id_impacto`
  			WHERE `viga_iniciativas_plan_impactoexterno`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_impact_external); $j++) {
        unset($datas_impact_external[$j][0]);
        unset($datas_impact_external[$j][1]);
      }
      $datas[$i]["impactos_externos"] = $datas_impact_external;

      /* RESULTADOS ESPERADOS */
      $datas_expected_results = $db->select("viga_iniciativas_plan_resultado",
  			[
  				"id", "tipo", "cantidad", "resultado"
  			], [
  				"visible" => "1", "id_iniciativa" => $id_iniciativa
  			]
  		);
      for ($j=0; $j < sizeof($datas_expected_results); $j++) {
        unset($datas_expected_results[$j][0]);
        unset($datas_expected_results[$j][1]);
      }
      $datas[$i]["resultados_esperados"] = $datas_expected_results;

      /* IMPACTOS ESPERADOS */
      $datas_expected_impacts = $db->select("viga_iniciativas_plan_impacto",
  			[
  				"id", "tipo", "cantidad", "impacto"
  			], [
  				"visible" => "1", "id_iniciativa" => $id_iniciativa
  			]
  		);
      for ($j=0; $j < sizeof($datas_expected_impacts); $j++) {
        unset($datas_expected_impacts[$j][0]);
        unset($datas_expected_impacts[$j][1]);
      }
      $datas[$i]["impactos_esperados"] = $datas_expected_impacts;

      /* GEO PAIS */
      $datas_countries = $db->query(
  			"SELECT DISTINCT `viga_geo_pais`.`id`,`viga_geo_pais`.`nombre`
  			FROM `viga_geo_pais` INNER JOIN `viga_iniciativas_plan_geopais` ON `viga_geo_pais`.`id` = `viga_iniciativas_plan_geopais`.`id_pais`
  			WHERE `viga_iniciativas_plan_geopais`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_countries); $j++) {
        unset($datas_countries[$j][0]);
        unset($datas_countries[$j][1]);
      }
      $datas[$i]["paises"] = $datas_countries;

      /* GEO PROVINCIA */
      $datas_regions = $db->query(
  			"SELECT DISTINCT `viga_geo_region`.`id`,`viga_geo_region`.`nombre`
  			FROM `viga_geo_region` INNER JOIN `viga_iniciativas_plan_georegion` ON `viga_geo_region`.`id` = `viga_iniciativas_plan_georegion`.`id_region`
  			WHERE `viga_iniciativas_plan_georegion`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_regions); $j++) {
        unset($datas_regions[$j][0]);
        unset($datas_regions[$j][1]);
      }
      $datas[$i]["regiones"] = $datas_regions;

      /* GEO COMUNA */
      $datas_communes = $db->query(
  			"SELECT DISTINCT `viga_geo_comuna`.`id`, `viga_geo_comuna`.`id_region`,`viga_geo_comuna`.`nombre`
  			FROM `viga_geo_comuna` INNER JOIN `viga_iniciativas_plan_geocomuna` ON `viga_geo_comuna`.`id` = `viga_iniciativas_plan_geocomuna`.`id_comuna`
  			WHERE `viga_iniciativas_plan_geocomuna`.`id_iniciativa` = '$id_iniciativa'"
  		)->fetchAll();
      for ($j=0; $j < sizeof($datas_communes); $j++) {
        unset($datas_communes[$j][0]);
        unset($datas_communes[$j][1]);
        unset($datas_communes[$j][2]);
      }
      $datas[$i]["comunas"] = $datas_communes;

      /* PARTICIPANTES */
      $datas_participation = $db->select("viga_participacion_plan",
  			[
  				"id", "tipo", "tipo2", "id_iniciativa", "publico_general",
  				"aplica_sexo", "sexo_masculino", "sexo_femenino", "sexo_otro",
  				"aplica_edad", "edad_ninos", "edad_jovenes", "edad_adultos", "edad_adultos_mayores",
  				"aplica_procedencia", "procedencia_rural", "procedencia_urbano",
  				"aplica_vulnerabilidad", "vulnerabilidad_pueblo", "vulnerabilidad_discapacidad", "vulnerabilidad_pobreza",
  				"aplica_nacionalidad", "nacionalidad_chileno", "nacionalidad_migrante", "nacionalidad_pueblo",
  				"aplica_etnia", "etnia_mapuche", "etnia_otro"
  			],
  			[
  				"visible" => "1",
  				"id_iniciativa" => $id_iniciativa
  			]
      );
      for ($j=0; $j < sizeof($datas_participation); $j++) {
        unset($datas_participation[$j][0]);
        unset($datas_participation[$j][1]);
      }
      $datas[$i]["participantes"] = $datas_participation;

      /* RECURSOS INFRAESTRUCTURA */
      $datas_resources_bulding = $db->select("viga_iniciativas_plan_recursoinfraestructura",
  			[
  				"id", "fuente", "tipo", "cantidad", "valorizacion"
  			],
  			[  "id_iniciativa" => $id_iniciativa, "visible" => "1"
  			]
  		);
      for ($j=0; $j < sizeof($datas_resources_bulding); $j++) {
        unset($datas_resources_bulding[$j][0]);
        unset($datas_resources_bulding[$j][1]);
      }
      $datas[$i]["recursos_infraestructuras"] = $datas_resources_bulding;

      /* RECURSOS HUMANOS */
      $datas_resources_human = $db->select("viga_iniciativas_plan_recursohumano",
  			[
  				"id", "fuente", "tipo", "cantidad", "valorizacion"
  			],
  			[  "id_iniciativa" => $id_iniciativa, "visible" => "1"
  			]
  		);
      for ($j=0; $j < sizeof($datas_resources_human); $j++) {
        unset($datas_resources_human[$j][0]);
        unset($datas_resources_human[$j][1]);
      }
      $datas[$i]["recursos_humanos"] = $datas_resources_human;

      /* RECURSOS DINERO */
      $datas_resources_cash = $db->select("viga_iniciativas_plan_recursodinero",
  			[
  				"id", "fuente", "tipo", "valorizacion"
  			],
  			[  "id_iniciativa" => $id_iniciativa, "visible" => "1"
  			]
  		);
      for ($j=0; $j < sizeof($datas_resources_cash); $j++) {
        unset($datas_resources_cash[$j][0]);
        unset($datas_resources_cash[$j][1]);
      }
      $datas[$i]["recursos_dinero"] = $datas_resources_cash;
    }
		//echo "query: " . $db->last();
		return $datas;
	}

  function countInitiativesPlanByInstitution($institution = null) {
		include("db_config.php");

		$datas = $db->count("viga_iniciativas_plan",
			[
				"viga_iniciativas_plan.visible" => "1",
				"viga_iniciativas_plan.institucion" => $institution
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		return $datas;
	}

?>
