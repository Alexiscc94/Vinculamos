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
		$evaluacionesInternas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible", "fecha_creacion"
			],
			[
				"id_iniciativa" => $idInitiative,"tipo_evaluacion[~]" => "Interno", "visible" => "1"
			]
		);
		echo "<br>>>query: " . $db->last() . "<br><br>";

		echo "<br><br>";
		for ($i=0; $i < sizeof($evaluacionesInternas); $i++) {
			echo "<br><br>" . $evaluacionesInternas[$i]["tipo_evaluacion"];

			$evaluationConfig = $db->select("viga_evaluacion_tipo_evaluador_config",
				["id", "tipo_evaluador", "clave", "orden_visible"],
				["tipo_evaluador" => $evaluacionesInternas[$i]["tipo_evaluacion"],"ORDER" => ["orden_visible" => "ASC"]]
			);

			$arrayPuntajes = array();
			for ($j=0; $j < sizeof($evaluationConfig); $j++) {
				echo "<br> ->" . $evaluationConfig[$j]["clave"];
				switch ($evaluationConfig[$j]["clave"]) {
					case 'CONOCIMIENTO_ORI':
						$conocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
							"valor",
							[
								"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionesInternas[$i]["id"], "clave[~]" => "CONOCIMIENTO_%"
							]
						);
						echo "<br> encuestas conocimiento ori: " . $conocimientoORI;
						$arrayPuntajes[] = $conocimientoORI;
						break;


					case 'CUMPLIMIENTO_ORI':
						$cumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
							"valor",
							[
								"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionesInternas[$i]["id"], "clave[~]" => "CUMPLIMIENTO_%"
							]
						);
						echo "<br> encuestas cumplimiento ori: " . $cumplimientoORI;
						$arrayPuntajes[] = $cumplimientoORI;
						break;


					case 'CALIDAD_EJECUCION':
						$calidadSum = $db->sum("viga_evaluacion_detalle_respuesta",
							"valor",
							[
								"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionesInternas[$i]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
							]
						);
						$calidadCount = $db->select("viga_evaluacion_detalle_respuesta",
							"valor",
							[
								"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionesInternas[$i]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
							]
						);
						echo "<br>>>query: " . $db->last() . "<br><br>";
						$calidad = sizeof($calidadCount) == 0 ? 0 : ($calidadSum / (sizeof($calidadCount) * 3)) * 100;
						if(sizeof($calidadCount) == 0) {
							$calidad = 0;
						}
						echo "<br> encuestas calidad: " . $calidad;
						echo "<br> encuestas calidad sum: " . $calidadSum;
						echo "<br> encuestas calidad count: " . sizeof($calidadCount);
						$arrayPuntajes[] = $calidad;
						break;

					case 'APORTE_COMPETENCIAS':
						// code...
						break;
				}
			}
		}
		echo "<br><br>";

















		/* SECCIÓN EVALUACIÓN INTERNA */
		$evaluacionEstudiante = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => "Evaluador interno - Estudiante"
			]
		);
		//echo "<br> encuestas estudiantes: " . sizeof($evaluacionEstudiante);

		$evaluacionProfesor = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => "Evaluador interno - Docente"
			]
		);
		//echo "<br> encuestas profesores: " . sizeof($evaluacionProfesor);

		$evaluacionJefatura = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => "Evaluador interno - Jefatura"
			]
		);
		//echo "<br> encuestas jefaturas: " . sizeof($evaluacionJefatura);

		$evaluacionDirectivo = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => "Evaluador interno - Directivo"
			]
		);
		//echo "<br> encuestas directivos: " . sizeof($evaluacionDirectivo);

		/* ESTUDIANTE */
		$estudianteConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionEstudiante[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas estudiante conocimiento ori: " . $estudianteConocimientoORI;

		$estudianteCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionEstudiante[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
		//echo "<br> encuestas estudiante cumplimiento ori: " . $estudianteCumplimientoORI;

		$estudianteCalidadSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionEstudiante[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$estudianteCalidadCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionEstudiante[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$estudianteCalidad = sizeof($estudianteCalidadCount) == 0 ? 0:($estudianteCalidadSum / (sizeof($estudianteCalidadCount) * 3)) * 100;
		if(sizeof($estudianteCalidadCount) == 0) {
			$estudianteCalidad = 0;
		}
		//echo "<br> encuestas estudiante calidad: " . $estudianteCalidadSum;
		//echo "<br> encuestas estudiante calidad count: " . sizeof($estudianteCalidadCount);

		$estudianteCompetenciasSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionEstudiante[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$estudianteCompetenciasCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionEstudiante[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$estudianteCompetencias = sizeof($estudianteCompetenciasCount) == 0 ? 0:($estudianteCompetenciasSum / (sizeof($estudianteCompetenciasCount) * 3)) * 100;
		if(sizeof($estudianteCompetenciasCount) == 0) {
			$estudianteCompetencias = 0;
		}
		//echo "<br> encuestas estudiante competencias: " . $estudianteCompetenciasSum;
		//echo "<br> encuestas estudiante competencias count: " . sizeof($estudianteCompetenciasCount);

		$evaEstudiante = (0.15*$estudianteConocimientoORI) + (0.3*$estudianteCumplimientoORI) + (0.15*$estudianteCalidad) + (0.4*$estudianteCompetencias);
		//echo "<br> eva estudiante: " . $evaEstudiante;

		/* PROFESOR */
		$profesorConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionProfesor[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas profesor conocimiento ori: " . $profesorConocimientoORI;

		$profesorCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionProfesor[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
		//echo "<br> encuestas profesor cumplimiento ori: " . $profesorCumplimientoORI;

		$profesorCalidadSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionProfesor[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$profesorCalidadCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionProfesor[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$profesorCalidad = sizeof($profesorCalidadCount) == 0 ? 0:($profesorCalidadSum / (sizeof($profesorCalidadCount) * 3)) * 100;
		if(sizeof($profesorCalidadCount) == 0) {
			$profesorCalidad = 0;
		}
		//echo "<br> encuestas profesor calidad: " . $profesorCalidadSum;
		//echo "<br> encuestas profesor calidad count: " . sizeof($profesorCalidadCount);

		$profesorCompetenciasSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionProfesor[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$profesorCompetenciasCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionProfesor[0]["id"], "clave[~]" => "COMPETENCIA_%", "valor[!]" => ""
			]
		);
		$profesorCompetencias = sizeof($profesorCompetenciasCount) == 0 ? 0:($profesorCompetenciasSum / (sizeof($profesorCompetenciasCount) * 3)) * 100;
		if(sizeof($profesorCompetenciasCount) == 0) {
			$profesorCompetencias = 0;
		}
		//echo "<br> encuestas profesor competencias: " . $profesorCompetenciasSum;
		//echo "<br> encuestas profesor competencias count: " . sizeof($profesorCompetenciasCount);

		$evaProfesor = (0.15*$profesorConocimientoORI) + (0.3*$profesorCumplimientoORI) + (0.15*$profesorCalidad) + (0.4*$profesorCompetencias);
		//echo "<br> eva profesor: " . $evaProfesor;

		if(sizeof($evaluacionEstudiante) > 0 && sizeof($evaluacionProfesor) > 0) { /* TIENE AMBAS */
			$ponderacionEstudiante = 0.7;
			$ponderacionProfesor = 0.3;
		} else {
			if(sizeof($evaluacionEstudiante) > 0 && sizeof($evaluacionProfesor) == 0) {
				$ponderacionEstudiante = 1;
				$ponderacionProfesor = 0;
			}

			if(sizeof($evaluacionEstudiante) == 0 && sizeof($evaluacionProfesor) > 0) {
				$ponderacionEstudiante = 0;
				$ponderacionProfesor = 1;
			}

			if(sizeof($evaluacionEstudiante) == 0 && sizeof($evaluacionProfesor) == 0) {
				$ponderacionEstudiante = 0;
				$ponderacionProfesor = 0;
			}
		}
		$puntajeInterno = round(($evaEstudiante * $ponderacionEstudiante) + ($evaProfesor * $ponderacionProfesor));
		//echo "<br> evaEstudiante: " . $evaEstudiante;
		//echo "<br> ponderacionEstudiante: " . $ponderacionEstudiante;
		//echo "<br> evaProfesor: " . $evaProfesor;
		//echo "<br> ponderacionProfesor: " . $ponderacionProfesor;
		//echo "<br> eva interno: " . $puntajeInterno;

		$result["evaluacionInterna"]["valor"] = 0;
		$result["evaluacionInterna"]["etiqueta"] = "No encontrado";
		if($puntajeInterno <= 20 || (sizeof($evaluacionEstudiante) + sizeof($evaluacionProfesor)) == 0) {
			$result["evaluacionInterna"]["valor"] = 20;
			$result["evaluacionInterna"]["etiqueta"] = "Muy Baja (0% - 20%)";
		}
		if($puntajeInterno > 20 && $puntajeInterno <= 40 ) {
			$result["evaluacionInterna"]["valor"] = 40;
			$result["evaluacionInterna"]["etiqueta"] = "Baja (21% - 40%)";
		}
		if($puntajeInterno > 40 && $puntajeInterno <= 60 ) {
			$result["evaluacionInterna"]["valor"] = 60;
			$result["evaluacionInterna"]["etiqueta"] = "Medio (41% - 60%)";
		}
		if($puntajeInterno > 60 && $puntajeInterno <= 80 ) {
			$result["evaluacionInterna"]["valor"] = 80;
			$result["evaluacionInterna"]["etiqueta"] = "Alto (61% - 80%)";
		}
		if($puntajeInterno > 80) {
			$result["evaluacionInterna"]["valor"] = 100;
			$result["evaluacionInterna"]["etiqueta"] = "Muy Alto (81% - 100%)";
		}


		/* SECCIÓN EVALUACIÓN EXTERNA */
		$evaluacionSocio = $datas = $db->select("viga_evaluacion_iniciativa",
			[
				"id", "id_iniciativa", "tipo_evaluacion", "visible"
			],
			[
				"visible" => "1", "id_iniciativa" => $idInitiative, "tipo_evaluacion" => "Evaluador externo"
			]
		);
		//echo "<br> encuestas socio: " . sizeof($evaluacionSocio);

		/* SOCIO COMUNITARIO */
		$socioConocimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionSocio[0]["id"], "clave[~]" => "CONOCIMIENTO_%"
			]
		);
		//echo "<br> encuestas socio conocimiento ori: " . $socioConocimientoORI;

		$socioCumplimientoORI = $db->avg("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionSocio[0]["id"], "clave[~]" => "CUMPLIMIENTO_%"
			]
		);
		//echo "<br> encuestas socio cumplimiento ori: " . $socioCumplimientoORI;

		$socioCalidadSum = $db->sum("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionSocio[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$socioCalidadCount = $db->select("viga_evaluacion_detalle_respuesta",
			"valor",
			[
				"id_iniciativa" => $idInitiative, "id_evaluacion" => $evaluacionSocio[0]["id"], "clave[~]" => "COMPROMISO_%", "valor[!]" => ""
			]
		);
		$socioCalidad = sizeof($socioCalidadCount)==0 ? 0:($socioCalidadSum / (sizeof($socioCalidadCount) * 3)) * 100;
		if(sizeof($socioCalidadCount) == 0) {
			$socioCalidad = 0;
		}
		//echo "<br> encuestas socio calidad: " . $socioCalidadSum;
		//echo "<br> encuestas socio calidad count: " . sizeof($socioCalidadCount);

		$puntajeExterno = (0.2*$socioConocimientoORI) + (0.5*$socioCumplimientoORI) + (0.3*$socioCalidad);
		//echo "<br> eva socio: " . $puntajeExterno;

		if($puntajeExterno <= 20 || sizeof($evaluacionSocio) == 0) {
			$result["evaluacionExterna"]["valor"] = 20;
			$result["evaluacionExterna"]["etiqueta"] = "Muy Baja (0% - 20%)";
		}
		if($puntajeExterno > 20 && $puntajeExterno <= 40 ) {
			$result["evaluacionExterna"]["valor"] = 40;
			$result["evaluacionExterna"]["etiqueta"] = "Baja (21% - 40%)";
		}
		if($puntajeExterno > 40 && $puntajeExterno <= 60 ) {
			$result["evaluacionExterna"]["valor"] = 60;
			$result["evaluacionExterna"]["etiqueta"] = "Medio (41% - 60%)";
		}
		if($puntajeExterno > 60 && $puntajeExterno <= 80 ) {
			$result["evaluacionExterna"]["valor"] = 80;
			$result["evaluacionExterna"]["etiqueta"] = "Alto (61% - 80%)";
		}
		if($puntajeExterno > 80) {
			$result["evaluacionExterna"]["valor"] = 100;
			$result["evaluacionExterna"]["etiqueta"] = "Muy Alto (81% - 100%)";
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
