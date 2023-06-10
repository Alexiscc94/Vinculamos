<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}
	include_once("../../utils/user_utils.php");
	$institucion = getInstitution();

	include_once("../../controller/medoo_initiatives_plan.php");
	$datasRaw = findInitiativesByFilters($institucion, $unit, $campus,
			$environment, $mechanism, $program, $covenant, $country, $region, $commune,
			$department, $implementationFormat, $frecuency, $executionStatus, $fillmentStatus);

	$datas = array();
	for ($i=0; $i < sizeof($datasRaw); $i++) {
		if(!in_array($datasRaw[$i], $datas)) {
			$datas[] = $datasRaw[$i];
		}
	}

	include_once("../../controller/medoo_invi_v2.php");

	$sumatoriaInvi = 0;
	$promedioInvi = 0;

	$textIds = "";
	for ($i=0; $i < sizeof($datas); $i++) {
		/* INICIO IDS */
		$textIds .= $datas[$i]['id'];
		if($i < sizeof($datas)-1) {
			$textIds .= ", ";
		}
		/* FIN IDS */

		$inviScore = calculateInviByInitiativePlan($datas[$i]['id']);
		$datas[$i]['invi'] = $inviScore;
		$sumatoriaInvi += $inviScore["invi"]["total"];
	}
	$promedioInvi = round($sumatoriaInvi / sizeof($datas));

	//echo "<br>textIds: " . $textIds;

	include_once("../../controller/medoo_initiatives_plan_ods.php");
	$myODS = getODSByInitiativeGroup($textIds);

	include_once("../../controller/medoo_campus.php");
	$campuses = countVisibleCampusByInstitution($institucion);

	include_once("../../controller/medoo_units.php");
	$units = countVisibleUnitsByInstitution($institucion);

	include_once("../../controller/medoo_departments.php");
	$departments = countVisibleDepartmentsByInstitution($institucion);

	include_once("../../controller/medoo_programs.php");
	$programs = countVisibleProgramsByInstitution($institucion);

	include_once("../../controller/medoo_geographic.php");
	$regions = getRegionsByInitiativeGroup($textIds);
	$communes = getCommunesByInitiativeGroup($textIds);

	include_once("../../controller/medoo_environment.php");
	$environments = getEnvironmentsByInitiativeGroup($textIds);

	include_once("../../controller/medoo_environment_sub.php");
	$environmentSubs = getEnvironmentsSubsByInitiativeGroup($textIds);

	include_once("../../controller/medoo_invi_attributes.php");
	$mechanismsActivities = getVisibleMechanismActivity();
	$mechanisms = countVisibleMechanism();

	//include_once("../../controller/medoo_attributes.php");
	//$scopesOfContribution = countVisibleScopeOfContribution();

	//$students = sumVisibleInitiativesStudentByInstitution($institucion);
	//$teachers = sumVisibleInitiativesTeacherByInstitution($institucion);

	include_once("../../controller/medoo_impact_internal.php");
	$internalImpacts = countVisibleInternalImpact();

	include_once("../../controller/medoo_impact_external.php");
	$externalImpacts = countVisibleExternalImpact();
?>

<div class="row">
	<div class="col-lg-4 col-xs-6">
		<a href="view_stats_v2_by_initiative.php">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?php echo sizeof($datas); ?></h3>
				<p>Iniciativas</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-briefcase"></i>
			</div>
		</div>
	</a>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
						<h3><?php echo $promedioInvi; ?></h3>
						<p>INVI</p>
				</div>
				<div class="icon text-white">
						<i class="fa fa-dashboard"></i>
				</div>
			</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
						<h3><?php echo sizeof($myODS); ?></h3>
						<p>ODS</p>
				</div>
			<div class="icon text-white">
				<img src="../../img/ods-circulo_sf.png" alt="User Image" width="60">
				<!--i class="fa fa-globe"></i-->
			</div>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->

<!-- Small boxes (SEGUNDA FILA) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-maroon color-palette">
			<div class="inner">
				<h3><?php echo $campuses; ?></h3>
				<p>Sedes</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-university"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua-active color-palette">
				<div class="inner">
						<h3><?php echo $units; ?></h3>
						<p>Escuelas</p>
				</div>
			<div class="icon text-white">
					<i class="fa fa-home"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	 <div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green-active color-palette">
				<div class="inner">
						<h3>  <?php echo $departments; ?></h3>
						<p>Ámbitos de contribución</p>
				</div>
				<div class="icon text-white">
						<i class="fa fa-folder"></i>
				</div>
			</div>
	</div> 
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-light-blue-active color-palette">
				<div class="inner">
						<h3><?php echo $programs; ?></h3>
						<p>Programas</p>
				</div>
			<div class="icon text-white">
					<i class="fa fa-code-fork"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->

<!-- Small boxes (TERCERA FILA) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-purple-active color-palette">
			<div class="inner">
				<h3><?php echo sizeof($regions); ?></h3>
				<p>Regiones</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-map"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua disabled color-palette">
			<div class="inner">
				<h3><?php echo sizeof($communes); ?></h3>
				<p>Comunas</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-map-marker"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow-active color-palette">
			<div class="inner">
				<h3><?php echo sizeof($environments); ?></h3>
				<p>Grupos de interés</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-users"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow color-palette">
			<div class="inner">
				<h3><?php echo sizeof($environmentSubs); ?></h3>
				<p>Sub grupos de interés</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-user-plus"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->

<!-- Small boxes (CUARTA FILA) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-orange color-palette">
			<div class="inner">
				<h3><?php echo sizeof($mechanismsActivities); ?></h3>
				<p>Actividades asociadas</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-bars"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red-active color-palette">
			<div class="inner">
				<h3><?php echo $mechanisms; ?></h3>
				<p>Mecanismos</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-bars"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-teal color-palette">
			<div class="inner">
				<h3><?php echo $internalImpacts; ?></h3>
				<p>Impactos internos</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-bars"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-purple color-palette">
			<div class="inner">
				<h3><?php echo $externalImpacts; ?></h3>
				<p>Impactos externos</p>
			</div>
			<div class="icon text-white">
				<i class="fa fa-bars"></i>
			</div>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
