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

	include_once("../../controller/medoo_environment.php");
	$myEnvironments = getEnvironmentsByInitiativePlanPOC($id_initiative);

	include_once("../../controller/medoo_environment_sub.php");
	include_once("../../controller/medoo_environment_environmentsub_detail.php");

	include_once("../../controller/medoo_participation_plan.php");

	if(sizeof($myEnvironments) == 0) {
		echo "<p> No se han agregado entornos relevantes.</p>";
		return;
	} else {
		for($i=0; $i<sizeof($myEnvironments); $i++) {
			$mySubEnvironments = getEnvironmentsSubDetailByInitiativePlan($id_initiative, $myEnvironments[$i]["id"]);
			$validadorEnv = 0;
			for($j=0; $j<sizeof($mySubEnvironments); $j++) {
				$myTags = getEnvironmentSubDetailsByInitiativePlanEnvSub($id_initiative,
					$myEnvironments[$i]["id"], $mySubEnvironments[$j]["id"]);
				$validadorSubEnv = 0;
				for($x=0; $x<sizeof($myTags); $x++) {
					$validadorTag = sumGeneralPlanParticipationByInitiativeType2($id_initiative, $myTags[$x]["tag"]);
					$validadorSubEnv += $validadorTag;
					$myTags[$x]["eliminable"] = ($validadorTag == 0 ? true:false);
				}

				$mySubEnvironments[$j]["tags"] = $myTags;
				$validadorEnv += $validadorSubEnv;
				$mySubEnvironments[$j]["eliminable"] = ($validadorSubEnv == 0 ? true:false);
			}
			$myEnvironments[$i]["subs"] = $mySubEnvironments;
			$myEnvironments[$i]["eliminable"] = ($validadorEnv == 0 ? true:false);
		}

	}
?>

  <div class="box-body table-responsive">
		<div id="result_human_resources_detail"></div>

		<table class="table table-bordered table-hover">
			<thead>
				<th style="width:20%">Grupos de interés</th>
				<th style="width:23%">Sub grupos</th>
				<th style="width:23%">Participantes</th>
			</thead>
			<tbody>
				<?php
					for($i=0; $i<sizeof($myEnvironments); $i++) {
						$mySubEnvironments = $myEnvironments[$i]["subs"];
						for($j=0; $j<sizeof($mySubEnvironments); $j++) {
							$myTags = $mySubEnvironments[$j]["tags"]; ?>
							<tr>
								<?php
									if($j == 0) { ?>
										<th rowspan="<?php echo sizeof($mySubEnvironments);?>">
											<?php
												if($myEnvironments[$i]["eliminable"] == true) { ?>
													<i class='fa fa-remove text-orange' id='remove'
														title="Eliminar entorno" onclick="removeEnv('<?php echo noeliaEncode($id_initiative);?>', '<?php echo noeliaEncode($myEnvironments[$i]["id"]);?>')"></i>
											<?php
												} else { ?>
													<i class="fa fa-remove text-gray" title="No se puede eliminar este entorno, ya que tiene público ingresado en el paso siguiente"></i>
											<?php
												} ?>

											<?php echo $myEnvironments[$i]["nombre"];?>
											<?php
												$labelName = "";
												if($myEnvironments[$i]['descripcion'] == "Interno") {
													$labelName = " <span class=\"label bg-purple\">Interno</span>";
												} else {
													if($myEnvironments[$i]['descripcion'] == "Externo") {
														$labelName = " <span class=\"label bg-maroon\">Externo</span>";
													}
												}
												echo $labelName;
											?>

										</th>
								<?php
									}
								 ?>

								<td>
									<?php
										if($mySubEnvironments[$j]["eliminable"] == true) { ?>
											<i class='fa fa-remove text-orange' id='remove'
												title="Eliminar sub entorno" onclick="removeSubEnv('<?php echo noeliaEncode($id_initiative);?>', '<?php echo noeliaEncode($myEnvironments[$i]["id"]);?>', '<?php echo noeliaEncode($mySubEnvironments[$j]["id"]);?>')"></i>
									<?php
										} else { ?>
											<i class="fa fa-remove text-gray" title="No se puede eliminar este sub entorno, ya que tiene público ingresado en el paso siguiente"></i>
									<?php
										} ?>
									<?php echo $mySubEnvironments[$j]["nombre"];?>
								</td>

								<td>
									<?php
										$myTags = $mySubEnvironments[$j]["tags"];
										for($x=0; $x<sizeof($myTags); $x++) {
											//echo $myTags[$x]["tag"] . "<br>";
											if($myTags[$x]["tag"] != "") { ?>
												<div id="div0" style="display: inline">
													<?php
													 	if($myTags[$x]["eliminable"] == true) { ?>
															<i class="fa fa-remove text-orange" id="remove"
																title="Eliminar tag" onclick="removeTag('<?php echo noeliaEncode($myTags[$x]["id"]);?>', '<?php echo noeliaEncode($myTags[$x]["id_iniciativa"]);?>', '<?php echo noeliaEncode($myTags[$x]["id_entorno"]);?>', '<?php echo noeliaEncode($myTags[$x]["id_entorno_sub"]);?>', '<?php echo noeliaEncode($myTags[$x]["tag"]);?>')"></i>
													<?php
														} else { ?>
															<i class="fa fa-remove text-gray" title="No se puede eliminar este participante, ya que tiene público ingresado en el paso siguiente"></i>
													<?php
														} ?>

														<span class="label bg-blue"><?php echo$myTags[$x]["tag"];?></span>
													&nbsp;&nbsp;&nbsp;
												</div>
									<?php
											}
										}
									?>
								</td>
							</tr>
				<?php
						}
					}
				?>

			</tbody>
		</table>

  </div>
  <!-- /.box-body -->
