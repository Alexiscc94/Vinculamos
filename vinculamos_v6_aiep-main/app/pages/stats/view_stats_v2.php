<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
	}

	include_once("../../utils/user_utils.php");
	if(!canReadStats()) {
		header('Location: ../../index.php');
	}

	$institucion = getInstitution();
	$refreshVal = rand();

?>

<!DOCTYPE html>
<html>
<?php include_once("../../config/settings.php")?>
<?php include_once("../include/header.php")?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

	<?php
		$activeMenu = "stats";
		include_once("../include/menu_side.php");

		include_once("../initiatives/modal_calculate_invi.php");
		//include_once("../initiatives/modal_edit_status_execution.php");
		//include_once("../initiatives/modal_edit_status_fillment.php");
	?>

  	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
    	<section class="content-header">
      		<h1>
        		 Análisis de datos
        		<small>v2 beta</small>
      		</h1>
					<ol class="breadcrumb">
        		<li><i class="fa fa-dashboard"></i> Inicio</li>
        		<li>Análisis de datos</li>
        		<li class="active">Análisis según Iniciativas</li>
      		</ol>
    	</section>

    	<!-- Main content -->
    	<section class="content">

				<div id="mostrar_resultados"></div>

    	</section>
    	<!-- /.content -->
  	</div>
  	<!-- /.content-wrapper -->

  <?php include_once("../include/footer.php")?>
</div>
<!-- ./wrapper -->

<script src="../../../template/bower_components/chart.js/Chart.js"></script>
<script src="../../../template/bower_components/jquery-knob/js/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

<script>
	$(document).ready(function(){
		//$('#filter_initiative').get(0).reset(); //clear form data on page load
		load();
	});

	function load() {
		var parametros = $("#filter_initiative").serialize();

		$.ajax({
			type: "POST",
				url:'./ajax_view_stats_v2.php',
				cache: false,
				data:  parametros,
				beforeSend: function () {
						$('#mostrar_resultados').html('<img src="../../img/ajax-loader.gif"> Obteniendo información, espere por favor. Cargando...');
						//$("#resultado").html("");
				},
				success:  function (response) {
						$('#mostrar_resultados').html('');
						$("#mostrar_resultados").html(response);

						$(".knob").knob();

				},
				error: function() {
					$('#mostrar_resultados').html('');
					$("#mostrar_resultados").html(response);
				}
			});
	}
</script>
</body>
</html>
