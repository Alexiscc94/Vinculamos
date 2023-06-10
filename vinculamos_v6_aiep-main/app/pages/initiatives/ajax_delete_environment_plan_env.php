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
		echo "<br> id_initiative: " . noeliaDecode($_REQUEST['id_initiative']);
		echo "<br> environment: " . noeliaDecode($_REQUEST['environment']);
		echo "<br> author: " . noeliaDecode($_REQUEST['author']);
		//return;
	}

	if( isset($_REQUEST['id_initiative']) && isset($_REQUEST['id_initiative'])
		&& isset($_REQUEST['environment']) && isset($_REQUEST['author']) ) {

		$result = deleteEnvPlan(noeliaDecode($_REQUEST['id_initiative']),
			noeliaDecode($_REQUEST['environment']), noeliaDecode($_REQUEST['author']));

		if($result == null) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Entorno eliminado correctamente.
			</div>
		<?php
		} else { ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				No pudimos eliminar el entorno.
			</div>
		<?php
		}
	} else {
		echo "Falta info!";
	}
?>
