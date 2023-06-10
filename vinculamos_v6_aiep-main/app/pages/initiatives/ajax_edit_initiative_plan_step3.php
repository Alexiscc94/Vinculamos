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

	if(false) {
		echo "<br> vg_id: " . noeliaDecode($_REQUEST['vg_id']);
		echo "<br> vg_pais: " . $_REQUEST['vg_pais'];
		echo "<br> vg_region: " . $_REQUEST['vg_region'];
		echo "<br> vg_comuna: " . $_REQUEST['vg_comuna'];
		echo "<br> vg_usuario: " . noeliaDecode($_REQUEST['vg_usuario']);
		//return;
	}

	if( isset($_REQUEST['vg_id']) && isset($_REQUEST['vg_pais']) && isset($_REQUEST['vg_usuario'])) {

		include_once("../../controller/medoo_geographic.php");
		updateCountriesByInitiativePlan(noeliaDecode($_REQUEST['vg_id']), $_REQUEST['vg_pais'], noeliaDecode($_REQUEST['vg_autor']));
		updateRegionsByInitiativePlan(noeliaDecode($_REQUEST['vg_id']), $_REQUEST['vg_region'], noeliaDecode($_REQUEST['vg_autor']));
		updateCommunesByInitiativePlan(noeliaDecode($_REQUEST['vg_id']), $_REQUEST['vg_comuna'], noeliaDecode($_REQUEST['vg_autor']));

		if(true) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Iniciativa guardada correctamente.
			</div>
		<?php
		} else { ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				No pudimos actualizar la información.
			</div>
		<?php
		}
	} else {
		echo "Falta info!";
	}
?>
