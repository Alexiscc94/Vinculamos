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

	$institucion = getInstitution();
	$executionStatus = $_POST["executionStatus"];
	$fillmentStatus = $_POST["fillmentStatus"];

	$dateFrom = $_REQUEST['vg_fecha'] . '-01-01';
	$dateTo = $_REQUEST['vg_fecha'] . '-12-31';
	$unit = $_REQUEST['vg_unidad'];
	$campus = $_REQUEST['vg_sede'];
	$department = $_REQUEST['vg_facultad'];
	$program = $_REQUEST['vg_programa'];

	include_once("../../controller/medoo_initiatives_plan.php");
	$datasRaw = getVisibleInitiativesPlanByInstitution($institucion, $executionStatus, $fillmentStatus,
		$dateFrom, $dateTo, $unit, $campus, $program, $department);

	$datas = array();
	for ($i=0; $i < sizeof($datasRaw); $i++) {
		if(!in_array($datasRaw[$i], $datas)) {
			$datas[] = $datasRaw[$i];
		}
	}

	include_once("../../controller/medoo_programs.php");
	include_once("../../controller/medoo_invi_attributes.php");

	// ALGOTIRMO ODS
	include_once("../../controller/medoo_measures.php");
	include_once("../../controller/medoo_initiatives_plan_ods.php");

	function eliminar_acentos($cadena){

		//Reemplazamos la A y a
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );

		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );

		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );

		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$cadena
		);

		return $cadena;
	}
?>

<div class="box-body table-responsive">
	<table id="table" class="table table-bordered table-hover">
		<thead>
    	<tr>
      	<th>ID</th>
				<th>Nombre</th>
				<th>Responsable</th>
				<th>Iniciativa asociada</th>
				<th style="width:210px">Acciones</th>
      </tr>
		</thead>
   	<tbody>
 			<?php
 				for($i=0 ; $i<sizeof($datas) ; $i++) {

					//$misMetas = getVisibleMeasuresByInitiative($datas[$i]['id']);
					//updateODSByInitiativePlan($datas[$i]['id'], $misMetas, "superadmin");

					/*
					$salida = array();
			    $entrada = eliminar_acentos($datas[$i]["nombre"] . " " . $datas[$i]["objetivo"] . " " . $datas[$i]["descripcion"]);
					//echo "<br> entrada: " . $entrada;
			    exec("python /home/vinculam/public_html/algoritmoODS/AlgoritmoODSv4.py '$entrada'", $salida);
					for($s=0; $s<sizeof($salida); $s++) {
						//echo "<br> salida $s: " . $salida[$s];
					}
					$arrayMetas = array();
			    $arrayObjetivos = array();
			    for($j = 0; $j < count($salida); $j++){
			      if(substr($salida[$j], 0, 5) === "Meta ") {
			        $arrayMetas[] = substr($salida[$j], 5);
			      }
			      if(substr($salida[$j], 0, 4) === "ODS ") {
			        $idODS = substr(strtok($salida[$j], ":"), 4);
			        $ods["nombre"] = $idODS;
			        for ($x=0; $x < sizeof($arrayMetas); $x++) {
			          $metaX = $arrayMetas[$x];
			          $metaX = str_replace($idODS.".", "", $metaX);
			          $idMeta = strtok($metaX, ":");
			          $arrayMetas[$x] = $idMeta;
			        }
			        $ods["metas"] = $arrayMetas;
			        $arrayObjetivos[] = $ods;
			        $arrayMetas = array();
			      }
			    }
					updateODSByInitiativePlanFromPython($datas[$i]['id'], $arrayObjetivos, "superadmin");
					*/

					?>
 					<tr>
      			<td><?php echo $datas[$i]['id'];?></td>
      			<td><?php echo $datas[$i]['nombre'];?></td>
						<td><?php echo $datas[$i]['responsable'];?></td>
      			<td><?php echo $datas[$i]['actividad_nombre'];?></td>

      			<td width="270">
							<?php
								$data = noeliaEncode("data" . $datas[$i]['id']);
      					if(canUpdateInitiatives()) { ?>
									<div class="btn-group">
										<button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown" title='Opciones'>
											Opciones <i class="glyphicon glyphicon-triangle-bottom"></i>
										</button>
										<ul class="dropdown-menu">
											<li>
												<a href="add_evaluation.php?data=<?php echo$data;?>" title='Evaluaciones'>
													<i class="fa fa-file-text-o"></i> Evaluación
												</a>
											</li>

											<?php
											 	if(canSuperviseInitiatives()) { ?>
													<!--li>
														<a data-toggle="modal" data-target="#editStatusExecution"
															data-id_iniciativa='?php echo noeliaEncode($datas[$i]['id']);?>'
															data-estado_ejecucion ='?php echo $datas[$i]['estado_ejecucion']?>'
															title='Estado Ejecución'>
															<i class="fa fa-flag"></i> Actualizar ejecución
														</a>
													</li-->

													<!--li>
														<a data-toggle="modal" data-target="#editStatusFillment"
															data-id_iniciativa='?php echo noeliaEncode($datas[$i]['id']);?>'
															data-estado_completitud ='?php echo $datas[$i]['estado_completitud']?>'
															title='Estado Completitud'>
															<i class="fa fa-edit"></i> Actualizar completitud
														</a>
													</li-->
											<?php
												} ?>

											<?php
											 	if(canDeleteInitiatives()) { ?>
													<li>
														<a data-toggle="modal" data-target="#deleteInitiative"
															data-id_iniciativa='<?php echo noeliaEncode($datas[$i]['id']);?>'
															data-nombre='<?php echo $datas[$i]['nombre'];?>'
															data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
															title='Eliminar iniciativa'>
															<i class="fa fa-trash"></i>Eliminar iniciativa
														</a>
													</li>

											<?php
												} ?>
										</ul>
									</div>

									<?php
									 	if($datas[$i]['estado'] == "En Revisión") {
											if(canSuperviseInitiatives()) { ?>
												<a href="edit_initiative_plan_step1.php?data=<?php echo$data;?>" class='btn btn-orange btn-sm' title='Editar iniciativa'>
													<i class="glyphicon glyphicon-edit"></i>
												</a>
											<?php
											}
										} else { ?>
											<a href="edit_initiative_plan_step1.php?data=<?php echo$data;?>" class='btn btn-orange btn-sm' title='Editar iniciativa'>
												<i class="glyphicon glyphicon-edit"></i>
											</a>
									<?php
										} ?>

							<?php
								} ?>
							<?php
								$data = noeliaEncode("data" . $datas[$i]['id']);
      					if(canReadInitiatives()) { ?>
									<div class="btn-group">
										<a href="review_initiative_plan.php?data=<?php echo$data;?>" class='btn btn-orange btn-sm' title='Ver iniciativa'>
											<i class="glyphicon glyphicon-eye-open"></i>
										</a>

										<a class="btn btn-orange btn-sm" valign="right" data-toggle="modal" title='Calcular INVI'
											data-iniciativa='<?php echo noeliaEncode($datas[$i]['id']);?>'
											data-usuario='<?php echo ($_SESSION["nombre_usuario"]);?>'
											data-target="#calculateScoreVCM">
												<i class="fa fa-tachometer"></i>
										</a>

										<a href="view_evidences.php?data=<?php echo$data;?>" class='btn btn-orange btn-sm' title='Ver evidencia'>
											<i class="glyphicon glyphicon-paperclip"></i>
										</a>

										<?php
											if($datas[$i]["estado_ejecucion"] == "") { ?>
												<a class='btn btn-success btn-sm' title='Ingresar resultados'
													data-id_iniciativa='<?php echo noeliaEncode($datas[$i]['id']);?>'
													data-toggle="modal" data-target="#editStatusExecutionResult">
													<i class="glyphicon glyphicon-flag"></i>
												</a>
										<?php
											}
											if($datas[$i]["estado_ejecucion"] == "Finalizada") { ?>
												<a href="edit_initiative_plan_step5.php?data=<?php echo$data;?>" class='btn btn-success btn-sm' title='Ingresar resultados'>
													<i class="glyphicon glyphicon-flag"></i>
												</a>
										<?php
											}
											?>

									</div>
							<?php
								} ?>

							<?php
      					if(canDeleteInitiatives() && false) { ?>
									<a href="#" class='btn btn-blue' title='Eliminar'
										data-id='<?php echo base64_encode($datas[$i]['id']);?>'
										data-nombre='<?php echo $datas[$i]['nombre'];?>'
										data-nombre_usuario='<?php echo $_SESSION["nombre_usuario"];?>'
										data-toggle="modal" data-target="#deleteProcedure">
										<i class="glyphicon glyphicon-trash"></i></a>
							<?php
								} ?>

							<?php
      					switch ($datas[$i]['estado']) {
      						case 'Aprobada':
      							echo "<i class='text-green fa fa-check'></i>";
      							break;
									case 'Rechazada':
      							echo "<i class='text-red fa fa-close'></i>";
      							break;
									case 'En Revisión':
	      						echo "<small class='label label-info'>" . $datas[$i]['estado'] . "</small> &nbsp;";
	      						break;
								}
							?>

							<?php
								$idEjecucion = ("ejecucion" . $datas[$i]['id']);
								echo "<small class='label label-primary' id='$idEjecucion'>" . $datas[$i]['estado_ejecucion'] . "</small> &nbsp;";

								$idCompletitud = ("completitud" . $datas[$i]['id']);
								echo "<small class='label label-info' id='$idCompletitud'>" . $datas[$i]['estado_completitud'] . "</small> &nbsp;";

							?>
      			</td>
          </tr>
 			<?php
 				} ?>

  	</tbody>
	</table>
</div>
<!-- /.box-body -->
