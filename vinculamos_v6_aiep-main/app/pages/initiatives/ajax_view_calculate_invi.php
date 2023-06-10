<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}
	include_once("../../utils/user_utils.php");
	if(!canReadInitiatives()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$id_initiative = noeliaDecode($_POST['id_initiative']);

	include_once("../../controller/medoo_invi_v2.php");
	$inviResult = calculateInviByInitiativePlan($id_initiative);

	if(false) {
		echo "<br>INVI RESULT:";
		echo "<br> Mecanismo: " .  $inviResult["mecanismo"]["etiqueta"] . " - " . $inviResult["mecanismo"]["valor"];
		echo "<br> Cobertura - Interna: " .  $inviResult["coberturaInterna"]["etiqueta"] . " - " . $inviResult["coberturaInterna"]["valor"];
		echo "<br> Cobertura - Externa: " .  $inviResult["coberturaExterna"]["etiqueta"] . " - " . $inviResult["coberturaExterna"]["valor"];
		echo "<br> Cobertura: " .  $inviResult["cobertura"]["etiqueta"] . " - " . $inviResult["cobertura"]["valor"];
		echo "<br> Frecuencia: " .  $inviResult["frecuencia"]["etiqueta"] . " - " . $inviResult["frecuencia"]["valor"];
		echo "<br> Resultados - Interna: " .  $inviResult["resultadosInterna"]["etiqueta"] . " - " . $inviResult["resultadosInterna"]["valor"];
		echo "<br> Resultados - Externa: " .  $inviResult["resultadosExterna"]["etiqueta"] . " - " . $inviResult["resultadosExterna"]["valor"];
		echo "<br> Resultados: " .  $inviResult["resultados"]["etiqueta"] . " - " . $inviResult["resultados"]["valor"];
		echo "<br> Evaluacion Interna: " .  $inviResult["evaluacionInterna"]["etiqueta"] . " - " . $inviResult["evaluacionInterna"]["valor"];
		echo "<br> Evaluacion Externa: " .  $inviResult["evaluacionExterna"]["etiqueta"] . " - " . $inviResult["evaluacionExterna"]["valor"];
		echo "<br> Evaluacion: " .  $inviResult["evaluacion"]["etiqueta"] . " - " . $inviResult["evaluacion"]["valor"];
	}

	/*
	include_once("../../controller/medoo_survey.php");
	$encuestas = getVisibleSurveyByInitiative($id_initiative);
	include_once("../../controller/medoo_survey_question.php");
	include_once("../../controller/medoo_survey_answer.php");

	$sumaPuntajesEncuestas = 0;
	for ($i=0; $i < sizeof($encuestas); $i++) {
		//echo "<br> encuesta $i";
		$preguntas = getVisibleQuestionsBySurvey($encuestas[$i]["id"]);
		$sumaPuntajesPreguntas = 0;
		for ($j=0; $j < sizeof($preguntas); $j++) {
			$tipoRespuestas = $preguntas[$j]["tipo_respuesta"];
			$respuestas = getVisibleAnswersBySurveyQuestion($encuestas[$i]["id"], $preguntas[$j]["id"]);

			if($tipoRespuestas == "Si o No") {
				$respuestasSi = countByAnswer("Si", $respuestas);
				$respuestasNo = countByAnswer("No", $respuestas);
				$totalSiNo = $respuestasSi + $respuestasNo;
				$preguntas[$j]["puntaje"] = round($respuestasSi / $totalSiNo) * 100;
			}

			if($tipoRespuestas == "Escala 1 a 7") {
				$respuestas0 = countByAnswer("-", $respuestas);
				$respuestas1 = countByAnswer("1", $respuestas);
				$respuestas2 = countByAnswer("2", $respuestas);
				$respuestas3 = countByAnswer("3", $respuestas);
				$respuestas4 = countByAnswer("4", $respuestas);
				$respuestas5 = countByAnswer("5", $respuestas);
				$respuestas6 = countByAnswer("6", $respuestas);
				$respuestas7 = countByAnswer("7", $respuestas);
				$total1a7 = $respuestas0 + $respuestas1 + $respuestas2 + $respuestas3 + $respuestas4
					+ $respuestas5 + $respuestas6 + $respuestas7;
				$miPorcentaje = (1*$respuestas1 + 2*$respuestas2 + 3*$respuestas3 + 4*$respuestas4
					+ 5*$respuestas5 + 6*$respuestas6 + 7*$respuestas7) / ($total1a7 - $respuestas0);
				$miPorcentaje = round($miPorcentaje/7 * 100);
				$preguntas[$j]["puntaje"] = $miPorcentaje;
			}

			if($tipoRespuestas == "Caritas 1 a 5") {
				$respuestas0 = countByAnswer("-", $respuestas);
				$respuestas1 = countByAnswer("1", $respuestas);
				$respuestas2 = countByAnswer("2", $respuestas);
				$respuestas3 = countByAnswer("3", $respuestas);
				$respuestas4 = countByAnswer("4", $respuestas);
				$respuestas5 = countByAnswer("5", $respuestas);
				$total1a5 = $respuestas0 + $respuestas1 + $respuestas2 + $respuestas3 + $respuestas4 + $respuestas5;
				$miPorcentaje = (1*$respuestas1 + 2*$respuestas2 + 3*$respuestas3 + 4*$respuestas4
					+ 5*$respuestas5) / ($total1a5 - $respuestas0);
				$miPorcentaje = round($miPorcentaje/5 * 100);
				$preguntas[$j]["puntaje"] = $miPorcentaje;
				//echo "<br> preguntas $j: " . $preguntas[$j]["puntaje"];
			}
			$sumaPuntajesPreguntas += $preguntas[$j]["puntaje"];
		}
		$encuestas[$i]["puntaje"] = round($sumaPuntajesPreguntas / sizeof($preguntas));
		//echo "<br> encuestas $i: " . $encuestas[$i]["puntaje"];
		$sumaPuntajesEncuestas += $encuestas[$i]["puntaje"];
	}
	$resultadoEncuestas = round($sumaPuntajesEncuestas / sizeof($encuestas));
	//echo "<br> resultado encuestas: " . $resultadoEncuestas;


	function countByAnswer($answer = null, $datas = null) {
		$respuestas = 0;
		for($i=0 ; $i<sizeof($datas) ; $i++) {
			if($datas[$i]["respuesta"] == $answer) {
				$respuestas++;
			}
		}
		return $respuestas;
	}
	*/


	?>
		<div class="box-body table-responsive">
			<!--h3>Resultados</h3-->
			<table id="tableResult" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="" width="40%">Mecanismo</th>
						<td class="text-center small" width="40%"><?php echo $inviResult["mecanismo"]["etiqueta"]?></td>
						<th class="text-center" width="20%"><?php echo $inviResult["mecanismo"]["valor"]?></th>
					</tr>
				</thead>
			</table>
		</div>


		<div class="box-body table-responsive">
			<table id="tableResult" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="" width="80%" colspan="2">Cobertura</th>
						<th class="text-center" width="20%"><?php echo $inviResult["cobertura"]["valor"]?></th>
					</tr>
				</thead>
				<tbody class="small">
					<tr>
						<td class="" width="40%">Cobertura Interna</td>
						<td class="text-center" width="40%"><?php echo $inviResult["coberturaInterna"]["etiqueta"]?></td>
						<td class="text-center" width="20%"><?php echo $inviResult["coberturaInterna"]["valor"]?></td>
					</tr>
					<tr>
						<td class="" width="40%">Cobertura Externa</td>
						<td class="text-center" width="40%"><?php echo $inviResult["coberturaExterna"]["etiqueta"]?></td>
						<td class="text-center" width="20%"><?php echo $inviResult["coberturaExterna"]["valor"]?></td>
					</tr>
				</tbody>
		</table>
	</div>

	<div class="box-body table-responsive">
		<table id="tableResult" class="table table-bordered table-hover">
			<tbody>
				<tr>
					<th class="" width="40%">Frecuencia</td>
					<td class="text-center small" width="40%"><?php echo $inviResult["frecuencia"]["etiqueta"]?></td>
					<th class="text-center" width="20%"><?php echo $inviResult["frecuencia"]["valor"]?></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="box-body table-responsive">
		<table id="tableResult" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="" width="80%" colspan="2">Resultados</th>
					<th class="text-center" width="20%"><?php echo $inviResult["resultados"]["valor"]?></th>
				</tr>
			</thead>
			<tbody class="small">
				<tr>
					<td class="" width="40%">Resultados Internos</td>
					<td class="text-center" width="40%"><?php echo $inviResult["resultadosInterna"]["etiqueta"]?></td>
					<td class="text-center" width="20%"><?php echo $inviResult["resultadosInterna"]["valor"]?></td>
				</tr>
				<tr>
					<td class="" width="40%">Resultados Externos</td>
					<td class="text-center" width="40%"><?php echo $inviResult["resultadosExterna"]["etiqueta"]?></td>
					<td class="text-center" width="20%"><?php echo $inviResult["resultadosExterna"]["valor"]?></td>
				</tr>
		</tbody>

	</table>
</div>

	<div class="box-body table-responsive">
		<table id="tableResult" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="" width="40%"colspan="2" >Evaluación Global</td>
					<th class="text-center" width="20%"><?php echo $inviResult["evaluacion"]["valor"]?></td>
				</tr>
			</thead>
			<tbody class="small">
				<tr>
					<td class="" width="40%">Evaluación Interna</td>
					<td class="text-center" width="40%"><?php echo $inviResult["evaluacionInterna"]["etiqueta"]?></td>
					<td class="text-center" width="20%"><?php echo $inviResult["evaluacionInterna"]["valor"]?></td>
				</tr>
				<tr>
					<td class="" width="40%">Evaluación Externa</td>
					<td class="text-center" width="40%"><?php echo $inviResult["evaluacionExterna"]["etiqueta"]?></td>
					<td class="text-center" width="20%"><?php echo $inviResult["evaluacionExterna"]["valor"]?></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="box-body table-responsive">
		<table id="tableResult" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="" width="80%">Índice de vinculación INVI</th>
					<th class="text-center" width="20%"><?php echo $inviResult["invi"]["total"];?></th>
				<tr>
			</thead>
		</table>
	</div>

	<!--div class="box-body table-responsive">
		<table id="tableResult" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="" width="80%">Satisfacción (Resultado encuestas)</th>
					<th class="text-center" width="20%"><?php echo $resultadoEncuestas;?></th>
				<tr>
			</thead>
		</table>
	</div-->
