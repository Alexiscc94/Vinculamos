<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}

	include_once("../../utils/user_utils.php");
	if(!canCreateParameters()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$institucion = getInstitution();

	if( isset($_REQUEST['vg_nombre']) && isset($_REQUEST['vg_descripcion']) && isset($_REQUEST['vg_usuario']) ) {

		include_once("../../controller/medoo_covenants.php");
		$result = addCovenant($_REQUEST['vg_nombre'], $_REQUEST['vg_descripcion'],
			noeliaDecode($_REQUEST['vg_usuario']), $institucion);

		editCovenantOtherFields($result[0]["id"], $_REQUEST['vg_direccion'], $_REQUEST['vg_nombre_contacto'],
			$_REQUEST['vg_telefono'], $_REQUEST['vg_correo_electronico'], $_REQUEST['vg_fecha_suscripcion'],
			$_REQUEST['vg_observaciones'], noeliaDecode($_REQUEST['vg_usuario']));

		if($result != null) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Convenio guardado correctamente.
			</div>
		<?php
		} else { ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				El convenio que intenta agregar ya existe.
			</div>
		<?php
		}


	} else {
		echo "Falta info!";
	}
?>
