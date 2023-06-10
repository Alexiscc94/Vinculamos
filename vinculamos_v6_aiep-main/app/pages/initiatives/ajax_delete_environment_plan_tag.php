<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	session_start();
	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}

	include_once("../../utils/user_utils.php");
	if(!canUpdateInitiatives()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$institucion = getInstitution();

	include_once("../../controller/medoo_environment_environmentsub_detail.php");
	if(false) {
		echo "<br> id: " . noeliaDecode($_REQUEST['id']);
		echo "<br> id_initiative: " . noeliaDecode($_REQUEST['id_initiative']);
		echo "<br> environment: " . noeliaDecode($_REQUEST['environment']);
		echo "<br> environmentsub: " . noeliaDecode($_REQUEST['environmentsub']);
		echo "<br> author: " . noeliaDecode($_REQUEST['author']);

		echo "<br> tag: " . noeliaDecode($_REQUEST['tag']);
		//return;
	}

	if( isset($_REQUEST['id_initiative']) && isset($_REQUEST['id_initiative'])
		&& isset($_REQUEST['environment']) && isset($_REQUEST['environmentsub'])
		&& isset($_REQUEST['author']) ) {

		include_once("../../controller/medoo_participation_plan.php");
		$validador = sumGeneralPlanParticipationByInitiativeType2(
			noeliaDecode($_REQUEST['id_initiative']), noeliaDecode($_REQUEST['tag']));
		
		if(intval($validador) == 0) {
			$result = deleteTagPlan(noeliaDecode($_REQUEST['id']), noeliaDecode($_REQUEST['id_initiative']),
				noeliaDecode($_REQUEST['environment']), noeliaDecode($_REQUEST['environmentsub']),
				noeliaDecode($_REQUEST['author']));
			if($result != null) { ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Participante eliminado correctamente.
				</div>
			<?php
			} else { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					No pudimos eliminar el participante.
				</div>
			<?php
			}
		} else { ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				No se puede eliminar el participante seleccionado, ya que tiene público ingresado en el paso siguiente.
			</div>
		<?php
		}

	} else {
		echo "Falta info!";
	}
?>
