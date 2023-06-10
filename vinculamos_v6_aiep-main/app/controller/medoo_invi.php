<?php

	function calculateInviByInitiativePlan($idInitiative = null) {
		include("db_config.php");

		$iniciativa = $db->select("viga_iniciativas_plan",
			[
				"id", "nombre", "descripcion", "objetivo", "fecha_inicio", "fecha_fin",
				"id_mecanismo", "id_frecuencia", "visible", "institucion", "autor", "fecha_creacion"
			],
			[
				"visible" => "1",
				"id" => $idInitiative
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";

		/* SECCIÓN MECANISMO */
		$mecanismo = $db->select("viga_atributo_mecanismo",
			[
				"id",
				"nombre",
				"descripcion",
				"puntaje",
				"visible",
				"fecha_creacion"
			],
			[
				"id" => $iniciativa[0]["id_mecanismo"]
			]
		);
		//echo "<br>>>query: " . $db->last() . "<br><br>";
		if($mecanismo != null) {
			$result["mecanismo"]["etiqueta"] = $mecanismo[0]["nombre"];
			$result["mecanismo"]["valor"] = round($mecanismo[0]["puntaje"]);
		} else {
			$result["mecanismo"]["etiqueta"] = "-";
			$result["mecanismo"]["valor"] = 0;
		}

		/* SECCIÓN COBERTURA */
		$participationPlanInterna = $db->sum("viga_participacion_plan", "publico_general",["tipo"=> "Interno", "visible" => "1", "id_iniciativa" => $idInitiative]);
		//echo "<br>participationPlanInterna: " . $participationPlanInterna;
		$participationRealInterna = $db->sum("viga_participacion_real", "publico_general",["tipo"=> "Interno", "visible" => "1", "id_iniciativa" => $idInitiative]);
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

		$participationPlanExterna = $db->sum("viga_participacion_plan", "publico_general",["tipo"=> "Externo", "visible" => "1", "id_iniciativa" => $idInitiative]);
		//echo "<br>participationPlanExterna: " . $participationPlanExterna;
		$participationRealExterna = $db->sum("viga_participacion_real", "publico_general",["tipo"=> "Externo", "visible" => "1", "id_iniciativa" => $idInitiative]);
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
		$frecuencia = $db->select("viga_atributo_frecuencia",
			[
				"id", "nombre", "descripcion", "puntaje", "visible", "fecha_creacion"
			],
			[
				"id" => $iniciativa[0]["id_frecuencia"]
			]
		);
		$result["frecuencia"]["etiqueta"] = $frecuencia[0]["nombre"];
		$result["frecuencia"]["valor"] = round($frecuencia[0]["puntaje"]);

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
		$estudianteTipo = "Evaluador interno - Estudiante";
		$estudianteEvaluacion = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $estudianteTipo
			]
		);
		//echo "<br> encuestas estudiantes: " . sizeof($estudianteEvaluacion);
		$estudiantePeso = (sizeof($estudianteEvaluacion) > 0 ? 0.34 : 0);

		$estudianteConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $estudianteEvaluacion[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas estudiante conocimiento ori: " . $estudianteConocimientoORI;

		$estudianteCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $estudianteEvaluacion[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
		//echo "<br> encuestas estudiante cumplimiento ori: " . $estudianteCumplimientoORI;

		$estudianteCalidadSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $estudianteEvaluacion[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$estudianteCalidadCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $estudianteEvaluacion[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$estudianteCalidad = sizeof($estudianteCalidadCount) == 0 ? 0:($estudianteCalidadSum / (sizeof($estudianteCalidadCount) * 3)) * 100;
		if(sizeof($estudianteCalidadCount) == 0) {
			$estudianteCalidad = 0;
		}
		//echo "<br> encuestas estudiante calidad: " . $estudianteCalidad;
		//echo "<br> encuestas estudiante calidad sum: " . $estudianteCalidadSum;
		//echo "<br> encuestas estudiante calidad count: " . sizeof($estudianteCalidadCount);

		$estudianteCompetenciasSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $estudianteEvaluacion[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$estudianteCompetenciasCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $estudianteEvaluacion[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$estudianteCompetencias = sizeof($estudianteCompetenciasCount) == 0 ? 0:($estudianteCompetenciasSum / (sizeof($estudianteCompetenciasCount) * 3)) * 100;
		if(sizeof($estudianteCompetenciasCount) == 0) {
			$estudianteCompetencias = 0;
		}
		//echo "<br> encuestas estudiante competencias: " . $estudianteCompetencias;
		//echo "<br> encuestas estudiante competencias sum: " . $estudianteCompetenciasSum;
		//echo "<br> encuestas estudiante competencias count: " . sizeof($estudianteCompetenciasCount);

		$evaEstudiante = (0.15*$estudianteConocimientoORI) + (0.3*$estudianteCumplimientoORI) + (0.15*$estudianteCalidad) + (0.4*$estudianteCompetencias);
		//echo "<br> eva estudiante: " . $evaEstudiante;
		//echo "<br><br>";

		/* SECCIÓN EVALUACIÓN INTERNA - PROFESORES */
		$docenteTipo = "Evaluador interno - Docente";
		$docenteEvaluacion = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $docenteTipo
			]
		);
		//echo "<br> encuestas docentes: " . sizeof($docenteEvaluacion);
		$docentePeso = (sizeof($docenteEvaluacion) > 0 ? 0.33 : 0);

		$docenteConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $docenteEvaluacion[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas profesor conocimiento ori: " . $profesorConocimientoORI;

		$docenteCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $docenteEvaluacion[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
		//echo "<br> encuestas profesor cumplimiento ori: " . $docenteCumplimientoORI;

		$docenteCalidadSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $docenteEvaluacion[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$docenteCalidadCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $docenteEvaluacion[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$docenteCalidad = sizeof($docenteCalidadCount) == 0 ? 0:($docenteCalidadSum / (sizeof($docenteCalidadCount) * 3)) * 100;
		if(sizeof($profesorCalidadCount) == 0) {
			$docenteCalidad = 0;
		}
		//echo "<br> encuestas docente calidad: " . $docenteCalidad;
		//echo "<br> encuestas docente calidad sum: " . $profesorCalidadSum;
		//echo "<br> encuestas docente calidad count: " . sizeof($profesorCalidadCount);

		$docenteCompetenciasSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $docenteEvaluacion[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$docenteCompetenciasCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $docenteEvaluacion[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$docenteCompetencias = sizeof($docenteCompetenciasCount) == 0 ? 0 : ($docenteCompetenciasSum / (sizeof($docenteCompetenciasCount) * 3)) * 100;
		if(sizeof($docenteCompetenciasCount) == 0) {
			$docenteCompetencias = 0;
		}
		//echo "<br> encuestas docente competencias: " . $docenteCompetencias;
		//echo "<br> encuestas docente competencias sum: " . $profesorCompetenciasSum;
		//echo "<br> encuestas docente competencias count: " . sizeof($profesorCompetenciasCount);

		$evaDocente = (0.15*$docenteConocimientoORI) + (0.3*$docenteCumplimientoORI) + (0.15*$docenteCalidad) + (0.4*$docenteCompetencias);
		//echo "<br> eva docente: " . $evaDocente;
		//echo "<br><br>";

		/* SECCIÓN EVALUACIÓN INTERNA - JEFATURA */
		$jefaturaTipo = "Evaluador interno - Jefatura";
		$jefaturaEvaluacion = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $jefaturaTipo
			]
		);
		//echo "<br> encuestas jefatura: " . sizeof($jefaturaEvaluacion);
		$jefaturaPeso = (sizeof($jefaturaEvaluacion) > 0 ? 0.33 : 0);

		$jefaturaConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $jefaturaEvaluacion[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas jefatura conocimiento ori: " . $jefaturaConocimientoORI;

		$jefaturaCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $jefaturaEvaluacion[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
		//echo "<br> encuestas jefatura cumplimiento ori: " . $jefaturaCumplimientoORI;

		$evaJefatura = (0.3*$jefaturaConocimientoORI) + (0.7*$jefaturaCumplimientoORI);
		//echo "<br> eva jefatura: " . $evaJefatura;
		//echo "<br><br>";

		/* SECCIÓN EVALUACIÓN INTERNA - DIRECTIVO */
		$directivoTipo = "Evaluador interno - Directivo";
		$directivoEvaluacion = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $directivoTipo
			]
		);
		//echo "<br> encuestas directivo: " . sizeof($directivoEvaluacion);
		$directivoPeso = (sizeof($directivoEvaluacion) > 0 ? 0.33 : 0);

		$directivoConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $directivoEvaluacion[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas directivo conocimiento ori: " . $directivoConocimientoORI;

		$directivoCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $directivoEvaluacion[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
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
		$externoTipo = "Evaluador externo";
		$externoEvaluacion = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => $externoTipo
			]
		);
		//echo "<br> encuestas externos: " . sizeof($externoEvaluacion);
		$externoPeso = (sizeof($externoEvaluacion) > 0 ? 0.33 : 0);

		$externoConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $externoEvaluacion[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas externo conocimiento ori: " . $externoConocimientoORI;

		$externoCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $externoEvaluacion[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
		//echo "<br> encuestas externo cumplimiento ori: " . $externoCumplimientoORI;

		$externoCalidadSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $externoEvaluacion[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$externoCalidadCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $externoEvaluacion[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$externoCalidad = sizeof($externoCalidadCount) == 0 ? 0:($externoCalidadSum / (sizeof($externoCalidadCount) * 3)) * 100;
		if(sizeof($externoCalidadCount) == 0) {
			$externoCalidad = 0;
		}
		//echo "<br> encuestas externo calidad: " . $externoCalidad;
		//echo "<br> encuestas externo calidad sum: " . $externoCalidadSum;
		//echo "<br> encuestas externo calidad count: " . sizeof($externoCalidadCount);

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
