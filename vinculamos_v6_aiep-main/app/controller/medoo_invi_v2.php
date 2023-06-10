<?php

	function calculateInviByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$estudianteTipo = "Evaluador interno - Estudiante";
		$estudianteEvaluacion = $db->select("viga_evaluacion_iniciativa",
			["id", "id_iniciativa"],
			["visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $estudianteTipo]
		);
		//echo "<br> encuestas estudiantes: " . sizeof($estudianteEvaluacion);
		$estudiantePeso = (sizeof($estudianteEvaluacion) > 0 ? 0.34 : 0);
		//echo "<br> estudiantePeso: " . $estudiantePeso;
		$idEvaluacionEstudiante = $estudianteEvaluacion[0]["id"];

		$docenteTipo = "Evaluador interno - Docente";
		$docenteEvaluacion = $db->select("viga_evaluacion_iniciativa",
			["id", "id_iniciativa"],
			["visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $docenteTipo]
		);
		//echo "<br> encuestas docentes: " . sizeof($docenteEvaluacion);
		$docentePeso = (sizeof($docenteEvaluacion) > 0 ? 0.33 : 0);
		//echo "<br> docentePeso: " . $docentePeso;
		$idEvaluacionProfesor = $docenteEvaluacion[0]["id"];

		$jefaturaTipo = "Evaluador interno - Jefatura";
		$jefaturaEvaluacion = $datas = $db->select("viga_evaluacion_iniciativa",
			["id", "id_iniciativa"],
			["visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $jefaturaTipo]
		);
		//echo "<br> encuestas jefatura: " . sizeof($jefaturaEvaluacion);
		$jefaturaPeso = (sizeof($jefaturaEvaluacion) > 0 ? 0.33 : 0);
		//echo "<br> jefaturaPeso: " . $jefaturaPeso;
		$idEvaluacionJefatura = $jefaturaEvaluacion[0]["id"];

		$directivoTipo = "Evaluador interno - Directivo";
		$directivoEvaluacion = $db->select("viga_evaluacion_iniciativa",
			["id", "id_iniciativa", "tipo_evaluacion", "visible"],
			["visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $directivoTipo]
		);
		//echo "<br> encuestas directivo: " . sizeof($directivoEvaluacion);
		$directivoPeso = (sizeof($directivoEvaluacion) > 0 ? 0.33 : 0);
		//echo "<br> directivoPeso: " . $directivoPeso;
		$idEvaluacionDirectivo = $directivoEvaluacion[0]["id"];

		$externoTipo = "Evaluador externo";
		$externoEvaluacion = $db->select("viga_evaluacion_iniciativa",
			["id", "id_iniciativa"],
			["visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $externoTipo]
		);
		//echo "<br> encuestas externos: " . sizeof($externoEvaluacion);
		$externoPeso = (sizeof($externoEvaluacion) > 0 ? 0.33 : 0);
		//echo "<br> externoPeso: " . $externoPeso;
		$idEvaluacionExterno = $externoEvaluacion[0]["id"];

		$iniciativa = $db->query(
			"SELECT viga_iniciativas_plan.id, viga_iniciativas_plan.nombre, viga_iniciativas_plan.id_mecanismo, viga_iniciativas_plan.id_actividad,
			viga_atributo_mecanismo.nombre as mecanismo_nombre, viga_atributo_mecanismo.puntaje as mecanismo_puntaje,
			viga_atributo_frecuencia.nombre as frecuencia_nombre, viga_atributo_frecuencia.puntaje as frecuencia_puntaje,
			(
				SELECT SUM(publico_general)
				FROM viga_participacion_plan
				WHERE tipo = 'Interno'
				AND visible = 1
				AND id_iniciativa = '$idInitiative'
			) as participationPlanInterna,
			(
				SELECT SUM(publico_general)
				FROM viga_participacion_real
				WHERE tipo = 'Interno'
				AND visible = 1
				AND id_iniciativa = '$idInitiative'
			) as participationRealInterna,
			(
				SELECT SUM(publico_general)
				FROM viga_participacion_plan
				WHERE tipo = 'Externo'
				AND visible = 1
				AND id_iniciativa = '$idInitiative'
			) as participationPlanExterna,
			(
				SELECT SUM(publico_general)
				FROM viga_participacion_real
				WHERE tipo = 'Externo'
				AND visible = 1
				AND id_iniciativa = '$idInitiative'
			) as participationRealExterna,
			/* EVALUACION ESTUDIANTE */
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionEstudiante'
				AND (clave LIKE 'CONOCIMIENTO_%')
			) AS eva_estudiante_avg_conocimiento_ori,
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionEstudiante'
				AND (clave LIKE 'CUMPLIMIENTO_%')
			) AS eva_estudiante_avg_cumplimiento_ori,
			(
				SELECT SUM(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionEstudiante'
				AND (clave LIKE 'COMPROMISO_%')
				AND valor != ''
			) AS eva_estudiante_sum_calidad,
			(
				SELECT COUNT(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionEstudiante'
				AND (clave LIKE 'COMPROMISO_%')
				AND valor != ''
			) AS eva_estudiante_count_calidad,
			(
				SELECT SUM(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionEstudiante'
				AND (clave LIKE 'COMPETENCIA_%')
				AND valor != ''
			) AS eva_estudiante_sum_competencia,
			(
				SELECT COUNT(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionEstudiante'
				AND (clave LIKE 'COMPETENCIA_%')
				AND `valor` != ''
			) AS eva_estudiante_count_competencia,
			/* EVALUACION PROFESOR */
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionProfesor'
				AND (clave LIKE 'CONOCIMIENTO_%')
			) AS eva_profesor_avg_conocimiento_ori,
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionProfesor'
				AND (clave LIKE 'CUMPLIMIENTO_%')
			) AS eva_profesor_avg_cumplimiento_ori,
			(
				SELECT SUM(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionProfesor'
				AND (clave LIKE 'COMPROMISO_%')
				AND valor != ''
			) AS eva_profesor_sum_calidad,
			(
				SELECT COUNT(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionProfesor'
				AND (clave LIKE 'COMPROMISO_%')
				AND valor != ''
			) AS eva_profesor_count_calidad,
			(
				SELECT SUM(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionProfesor'
				AND (clave LIKE 'COMPETENCIA_%')
				AND valor != ''
			) AS eva_profesor_sum_competencia,
			(
				SELECT COUNT(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionProfesor'
				AND (clave LIKE 'COMPETENCIA_%')
				AND `valor` != ''
			) AS eva_profesor_count_competencia,
			/* EVALUACION JEFATURA */
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionJefatura'
				AND (clave LIKE 'CONOCIMIENTO_%')
			) AS eva_jefatura_avg_conocimiento_ori,
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionJefatura'
				AND (clave LIKE 'CUMPLIMIENTO_%')
			) AS eva_jefatura_avg_cumplimiento_ori,
			/* EVALUACION DIRECTIVO */
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionDirectivo'
				AND (clave LIKE 'CONOCIMIENTO_%')
			) AS eva_directivo_avg_conocimiento_ori,
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionDirectivo'
				AND (clave LIKE 'CUMPLIMIENTO_%')
			) AS eva_directivo_avg_cumplimiento_ori,
			/* EVALUACION SOCIO EXTERNO */
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionExterno'
				AND (clave LIKE 'CONOCIMIENTO_%')
			) AS eva_socio_avg_conocimiento_ori,
			(
				SELECT AVG(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionExterno'
				AND (clave LIKE 'CUMPLIMIENTO_%')
			) AS eva_socio_avg_cumplimiento_ori,
			(
				SELECT SUM(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionExterno'
				AND (clave LIKE 'COMPROMISO_%')
				AND valor != ''
			) AS eva_socio_sum_calidad,
			(
				SELECT COUNT(valor)
				FROM viga_evaluacion_detalle_respuesta
				WHERE id_iniciativa = '$idInitiative'
				AND id_evaluacion = '$idEvaluacionExterno'
				AND (clave LIKE 'COMPROMISO_%')
				AND valor != ''
			) AS eva_socio_count_calidad

			FROM viga_iniciativas_plan INNER JOIN viga_atributo_mecanismo ON viga_iniciativas_plan.id_mecanismo = viga_atributo_mecanismo.id
			INNER JOIN viga_atributo_frecuencia ON viga_iniciativas_plan.id_frecuencia = viga_atributo_frecuencia.id
			WHERE viga_iniciativas_plan.visible = 1
			AND viga_iniciativas_plan.id = '$idInitiative'")->fetchAll();
		//echo "<br>>>query: " . $db->last() . "<br><br>";

		/*
		$iniciativa = $db->select("viga_iniciativas_plan",
			[
				"id", "nombre", "descripcion", "objetivo", "fecha_inicio", "fecha_fin",
				"id_mecanismo", "id_frecuencia", "visible", "institucion", "autor", "fecha_creacion"
			],
			[
				"visible" => "1",
				"id" => $idInitiative
			]
		);*/
		//echo "<br>>>query: " . $db->last() . "<br><br>";

		/* SECCIÓN MECANISMO */
		if($iniciativa != null) {
			$result["mecanismo"]["etiqueta"] = $iniciativa[0]["mecanismo_nombre"];
			$result["mecanismo"]["valor"] = round($iniciativa[0]["mecanismo_puntaje"]);
		} else {
			$result["mecanismo"]["etiqueta"] = "-";
			$result["mecanismo"]["valor"] = 0;
		}

		/* SECCIÓN COBERTURA */
		$participationPlanInterna = $iniciativa[0]["participationPlanInterna"];
		//echo "<br>participationPlanInterna: " . $participationPlanInterna;
		$participationRealInterna = $iniciativa[0]["participationRealInterna"];
		//echo "<br>participationRealInterna: " . $participationRealInterna;
		if($participationPlanInterna == 0) {
			$cumplimientoInterno = 0;
		} else {
			$cumplimientoInterno = ($participationRealInterna / $participationPlanInterna) * 100;
		}
		//echo "<br> % interno: " . ($participationRealInterna / $participationPlanInterna);

		$result["coberturaInterna"]["valor"] = 0;
		$result["coberturaInterna"]["etiqueta"] = "No encontrado";
		if($cumplimientoInterno >= 100) {
			$result["coberturaInterna"]["valor"] = 100;
			$result["coberturaInterna"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($cumplimientoInterno == 0) {
				$result["coberturaInterna"]["valor"] = 0;
				$result["coberturaInterna"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["coberturaInterna"]["valor"] = round($cumplimientoInterno);
				$result["coberturaInterna"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		$participationPlanExterna = $iniciativa[0]["participationPlanExterna"];
		//echo "<br>participationPlanExterna: " . $participationPlanExterna;
		$participationRealExterna = $iniciativa[0]["participationRealExterna"];
		//echo "<br>participationRealExterna: " . $participationRealExterna;
		if($participationPlanExterna == 0) {
			$cumplimientoExterno = 0;
		} else {
			$cumplimientoExterno = ($participationRealExterna / $participationPlanExterna) * 100;
		}
		//echo "<br> % externo: " . ($participationRealExterna / $participationPlanExterna);

		$result["coberturaExterna"]["valor"] = 0;
		$result["coberturaExterna"]["etiqueta"] = "No encontrado";
		if($cumplimientoExterno >= 100) {
			$result["coberturaExterna"]["valor"] = 100;
			$result["coberturaExterna"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($cumplimientoExterno == 0) {
				$result["coberturaExterna"]["valor"] = 0;
				$result["coberturaExterna"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["coberturaExterna"]["valor"] = round($cumplimientoExterno);
				$result["coberturaExterna"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		$cobertura = ($result["coberturaInterna"]["valor"] * 0.5) + ($result["coberturaExterna"]["valor"] * 0.5);
		//echo "<br> cobertura: " . $cobertura;
		$result["cobertura"]["valor"] = 0;
		$result["cobertura"]["etiqueta"] = "No encontrado";
		if($cobertura >= 100) {
			$result["cobertura"]["valor"] = 100;
			$result["cobertura"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($cobertura == 0) {
				$result["cobertura"]["valor"] = 0;
				$result["cobertura"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["cobertura"]["valor"] = round($cobertura);
				$result["cobertura"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		/* SECCIÓN FRECUENCIA */
		$result["frecuencia"]["etiqueta"] = $iniciativa[0]["frecuencia_nombre"];
		$result["frecuencia"]["valor"] = round($iniciativa[0]["frecuencia_puntaje"]);

		/* SECCIÓN RESULTADOS */
		$resultadosInternos = $db->query(
			"	SELECT cantidad,resultado,cantidad_real, round((cantidad_real/cantidad)*100) as cumplimiento FROM viga_iniciativas_plan_resultado
				WHERE tipo = 'Interno' AND visible = '1' AND id_iniciativa = '$idInitiative'"
		)->fetchAll();
		$sumaCumplimientoInterno = 0;
		for ($i=0; $i < sizeof($resultadosInternos); $i++) {
			if($resultadosInternos[$i]["cumplimiento"] >= 100) {
				$sumaCumplimientoInterno += 100;
				//echo "<br>interno $i: " . 100 . "   " . $resultadosInternos[$i]["cantidad_real"] . " / " . $resultadosInternos[$i]["cantidad"];
			} else {
				$sumaCumplimientoInterno += $resultadosInternos[$i]["cumplimiento"];
				//echo "<br>interno $i: " . $resultadosInternos[$i]["cumplimiento"] . "   " . $resultadosInternos[$i]["cantidad_real"] . " / " . $resultadosInternos[$i]["cantidad"];
			}
		}
		$cumplimientoResultadoInterno = ($sumaCumplimientoInterno / sizeof($resultadosInternos));
		//echo "<br> % interno: " . ($sumaCumplimientoInterno / sizeof($resultadosInternos));

		$result["resultadosInterna"]["valor"] = 0;
		$result["resultadosInterna"]["etiqueta"] = "No encontrado";
		if($cumplimientoResultadoInterno >= 100) {
			$result["resultadosInterna"]["valor"] = 100;
			$result["resultadosInterna"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($cumplimientoResultadoInterno == 0) {
				$result["resultadosInterna"]["valor"] = 0;
				$result["resultadosInterna"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["resultadosInterna"]["valor"] = round($cumplimientoResultadoInterno);
				$result["resultadosInterna"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		$resultadosExternos = $db->query(
			"	SELECT cantidad,resultado,cantidad_real, round((cantidad_real/cantidad)*100) as cumplimiento FROM viga_iniciativas_plan_resultado
				WHERE tipo = 'Externo' AND visible = '1' AND id_iniciativa = '$idInitiative'"
		)->fetchAll();
		$sumaCumplimientoExterno = 0;
		for ($i=0; $i < sizeof($resultadosExternos); $i++) {
			if($resultadosExternos[$i]["cumplimiento"] >= 100) {
				$sumaCumplimientoExterno += 100;
				//echo "<br>externo $i: " . 100 . "   " . $resultadosExternos[$i]["cantidad_real"] . " / " . $resultadosExternos[$i]["cantidad"];
			} else {
				$sumaCumplimientoExterno += $resultadosExternos[$i]["cumplimiento"];
				//echo "<br>externo $i: " . $resultadosExternos[$i]["cumplimiento"] . "   " . $resultadosExternos[$i]["cantidad_real"] . " / " . $resultadosExternos[$i]["cantidad"];
			}
		}
		$cumplimientoResultadoExterno = ($sumaCumplimientoExterno / sizeof($resultadosExternos));
		//echo "<br> % externo: " . ($sumaCumplimientoExterno / sizeof($resultadosExternos));

		$result["resultadosExterna"]["valor"] = 0;
		$result["resultadosExterna"]["etiqueta"] = "No encontrado";
		if($cumplimientoResultadoExterno >= 100) {
			$result["resultadosExterna"]["valor"] = 100;
			$result["resultadosExterna"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($cumplimientoResultadoExterno == 0) {
				$result["resultadosExterna"]["valor"] = 0;
				$result["resultadosExterna"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["resultadosExterna"]["valor"] = round($cumplimientoResultadoExterno);
				$result["resultadosExterna"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		$resultados = ($result["resultadosInterna"]["valor"] * 0.5) + ($result["resultadosExterna"]["valor"] * 0.5);
		//echo "<br> resultados: " . $resultados;
		$result["resultados"]["valor"] = 0;
		$result["resultados"]["etiqueta"] = "No encontrado";
		if($resultados >= 100) {
			$result["resultados"]["valor"] = 100;
			$result["resultados"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($cobertura == 0) {
				$result["resultados"]["valor"] = 0;
				$result["resultados"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["resultados"]["valor"] = round($resultados);
				$result["resultados"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		/* SECCIÓN EVALUACIÓN */

		/* SECCIÓN EVALUACIÓN INTERNA - ESTUDIANTES */
		$estudianteConocimientoORI = $iniciativa[0]["eva_estudiante_avg_conocimiento_ori"];
		//echo "<br> encuestas estudiante conocimiento ori: " . $estudianteConocimientoORI;

		$estudianteCumplimientoORI = $iniciativa[0]["eva_estudiante_avg_cumplimiento_ori"];
		//echo "<br> encuestas estudiante cumplimiento ori: " . $estudianteCumplimientoORI;

		$estudianteCalidadSum = $iniciativa[0]["eva_estudiante_sum_calidad"];
		$estudianteCalidadCount = $iniciativa[0]["eva_estudiante_count_calidad"];
		$estudianteCalidad = $estudianteCalidadCount == 0 ? 0:($estudianteCalidadSum / ($estudianteCalidadCount * 3)) * 100;
		if($estudianteCalidadCount == 0) {
			$estudianteCalidad = 0;
		}
		//echo "<br> encuestas estudiante calidad: " . $estudianteCalidad;
		//echo "<br> encuestas estudiante calidad sum: " . $estudianteCalidadSum;
		//echo "<br> encuestas estudiante calidad count: " . $estudianteCalidadCount;

		$estudianteCompetenciasSum = $iniciativa[0]["eva_estudiante_sum_competencia"];
		$estudianteCompetenciasCount = $iniciativa[0]["eva_estudiante_count_competencia"];
		$estudianteCompetencias = $estudianteCompetenciasCount == 0 ? 0:($estudianteCompetenciasSum / ($estudianteCompetenciasCount * 3)) * 100;
		if($estudianteCompetenciasCount == 0) {
			$estudianteCompetencias = 0;
		}
		//echo "<br> encuestas estudiante competencias: " . $estudianteCompetencias;
		//echo "<br> encuestas estudiante competencias sum: " . $estudianteCompetenciasSum;
		//echo "<br> encuestas estudiante competencias count: " . $estudianteCompetenciasCount;

		$evaEstudiante = (0.15*$estudianteConocimientoORI) + (0.3*$estudianteCumplimientoORI) + (0.15*$estudianteCalidad) + (0.4*$estudianteCompetencias);
		//echo "<br> eva estudiante: " . $evaEstudiante;
		//echo "<br><br>";

		/* SECCIÓN EVALUACIÓN INTERNA - PROFESORES */
		$docenteConocimientoORI = $iniciativa[0]["eva_profesor_avg_conocimiento_ori"];
		//echo "<br> encuestas profesor conocimiento ori: " . $profesorConocimientoORI;

		$docenteCumplimientoORI = $iniciativa[0]["eva_profesor_avg_cumplimiento_ori"];
		//echo "<br> encuestas profesor cumplimiento ori: " . $docenteCumplimientoORI;

		$docenteCalidadSum = $iniciativa[0]["eva_profesor_sum_calidad"];
		$docenteCalidadCount = $iniciativa[0]["eva_profesor_count_calidad"];
		$docenteCalidad = $docenteCalidadCount == 0 ? 0:($docenteCalidadSum / ($docenteCalidadCount * 3)) * 100;
		if($profesorCalidadCount == 0) {
			$docenteCalidad = 0;
		}
		//echo "<br> encuestas docente calidad: " . $docenteCalidad;
		//echo "<br> encuestas docente calidad sum: " . $profesorCalidadSum;
		//echo "<br> encuestas docente calidad count: " . $profesorCalidadCount;

		$docenteCompetenciasSum = $iniciativa[0]["eva_profesor_sum_competencia"];
		$docenteCompetenciasCount = $iniciativa[0]["eva_profesor_count_competencia"];
		$docenteCompetencias = $docenteCompetenciasCount == 0 ? 0 : ($docenteCompetenciasSum / ($docenteCompetenciasCount * 3)) * 100;
		if($docenteCompetenciasCount == 0) {
			$docenteCompetencias = 0;
		}
		//echo "<br> encuestas docente competencias: " . $docenteCompetencias;
		//echo "<br> encuestas docente competencias sum: " . $profesorCompetenciasSum;
		//echo "<br> encuestas docente competencias count: " . $profesorCompetenciasCount;

		$evaDocente = (0.15*$docenteConocimientoORI) + (0.3*$docenteCumplimientoORI) + (0.15*$docenteCalidad) + (0.4*$docenteCompetencias);
		//echo "<br> eva docente: " . $evaDocente;
		//echo "<br><br>";

		/* SECCIÓN EVALUACIÓN INTERNA - JEFATURA */
		$jefaturaConocimientoORI = $iniciativa[0]["eva_jefatura_avg_conocimiento_ori"];
		//echo "<br> encuestas jefatura conocimiento ori: " . $jefaturaConocimientoORI;

		$jefaturaCumplimientoORI = $iniciativa[0]["eva_jefatura_avg_cumplimiento_ori"];
		//echo "<br> encuestas jefatura cumplimiento ori: " . $jefaturaCumplimientoORI;

		$evaJefatura = (0.3*$jefaturaConocimientoORI) + (0.7*$jefaturaCumplimientoORI);
		//echo "<br> eva jefatura: " . $evaJefatura;
		//echo "<br><br>";

		/* SECCIÓN EVALUACIÓN INTERNA - DIRECTIVO */
		$directivoConocimientoORI = $iniciativa[0]["eva_directivo_avg_conocimiento_ori"];
		//echo "<br> encuestas directivo conocimiento ori: " . $directivoConocimientoORI;

		$directivoCumplimientoORI = $iniciativa[0]["eva_directivo_avg_cumplimiento_ori"];
		//echo "<br> encuestas directivo cumplimiento ori: " . $directivoCumplimientoORI;

		$evaDirectivo = (0.3*$directivoConocimientoORI) + (0.7*$directivoCumplimientoORI);
		//echo "<br> eva directivo: " . $evaDirectivo;
		//echo "<br><br>";

		/* Determinación de pesos */
		$pesoTotal = ($estudiantePeso + $docentePeso + $jefaturaPeso + $directivoPeso);

		//echo "<br> estudiantes: " . ($estudiantePeso / $pesoTotal) * $evaEstudiante;
		//echo "<br> docentes: " . ($docentePeso / $pesoTotal) * $evaDocente;
		//echo "<br> jefatura: " . ($jefaturaPeso / $pesoTotal) * $evaJefatura;
		//echo "<br> directivo: " . ($directivoPeso / $pesoTotal) * $evaDirectivo;

		if($pesoTotal == 0) {
			$evaluacionInterna = 0;
		} else {
			$evaluacionInterna =
				($estudiantePeso / $pesoTotal) * $evaEstudiante +
				($docentePeso / $pesoTotal) * $evaDocente +
				($jefaturaPeso / $pesoTotal) * $evaJefatura +
				($directivoPeso / $pesoTotal) * $evaDirectivo;
		}
		//echo "<br> eva interna: " . $evaluacionInterna;

		$result["evaluacionInterna"]["valor"] = 0;
		$result["evaluacionInterna"]["etiqueta"] = "No encontrado";
		if($evaluacionInterna >= 100) {
			$result["evaluacionInterna"]["valor"] = 100;
			$result["evaluacionInterna"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($evaluacionInterna == 0) {
				$result["evaluacionInterna"]["valor"] = 0;
				$result["evaluacionInterna"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["evaluacionInterna"]["valor"] = round($evaluacionInterna);
				$result["evaluacionInterna"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		/* SECCIÓN EVALUACIÓN EXTERNA */
		$externoConocimientoORI = $iniciativa[0]["eva_socio_avg_conocimiento_ori"];
		//echo "<br> encuestas externo conocimiento ori: " . $externoConocimientoORI;

		$externoCumplimientoORI = $iniciativa[0]["eva_socio_avg_cumplimiento_ori"];
		//echo "<br> encuestas externo cumplimiento ori: " . $externoCumplimientoORI;

		$externoCalidadSum = $iniciativa[0]["eva_socio_sum_calidad"];
		$externoCalidadCount = $iniciativa[0]["eva_socio_count_calidad"];
		$externoCalidad = $externoCalidadCount == 0 ? 0:($externoCalidadSum / ($externoCalidadCount * 3)) * 100;
		if($externoCalidadCount == 0) {
			$externoCalidad = 0;
		}
		//echo "<br> encuestas externo calidad: " . $externoCalidad;
		//echo "<br> encuestas externo calidad sum: " . $externoCalidadSum;
		//echo "<br> encuestas externo calidad count: " . $externoCalidadCount;

		$evaluacionExterna = (0.2*$externoConocimientoORI) + (0.4*$externoCumplimientoORI) + (0.3*$externoCalidad);
		//echo "<br> eva externo: " . $evaluacionExterna;
		//echo "<br><br>";

		$result["evaluacionExterna"]["valor"] = 0;
		$result["evaluacionExterna"]["etiqueta"] = "No encontrado";
		if($evaluacionExterna >= 100) {
			$result["evaluacionExterna"]["valor"] = 100;
			$result["evaluacionExterna"]["etiqueta"] = "Cumplimiento total";
		} else {
			if($evaluacionExterna == 0) {
				$result["evaluacionExterna"]["valor"] = 0;
				$result["evaluacionExterna"]["etiqueta"] = "Incumplimiento total";
			} else {
				$result["evaluacionExterna"]["valor"] = round($evaluacionExterna);
				$result["evaluacionExterna"]["etiqueta"] = "Cumplimiento parcial";
			}
		}

		$result["evaluacion"]["valor"] = round($result["evaluacionInterna"]["valor"]*0.5 + $result["evaluacionExterna"]["valor"]*0.5);
		$result["evaluacion"]["etiqueta"] = "";

		/* RESULTADO INVI */
		$invi = (0.2 * $result["mecanismo"]["valor"]) + (0.1 * $result["cobertura"]["valor"]) +
			(0.1 * $result["frecuencia"]["valor"]) + (0.25 * $result["resultados"]["valor"]) +
			(0.35 * $result["evaluacion"]["valor"]);

		$result["invi"]["total"] = round($invi);
		//echo "<br>query: " . $db->last();
		return $result;
	}

?>
