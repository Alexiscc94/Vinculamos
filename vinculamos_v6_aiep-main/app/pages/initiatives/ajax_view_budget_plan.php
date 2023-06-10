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

	$id_initiative = base64_decode($_POST['id_initiative']);

	include_once("../../controller/medoo_initiatives_plan_resources_financial.php");
	include_once("../../controller/medoo_initiatives_plan_resources_building.php");
	include_once("../../controller/medoo_initiatives_plan_resources_human.php");
?>

  <div class="box-body table-responsive">
		<div id="result_human_resources_detail"></div>

		<table class="table table-bordered table-hover">
			<thead>
				<th style="width:20%"></th>
				<th style="width:23%">Dinero</th>
				<th style="width:23%">Infraestructura y equipamiento</th>
				<th style="width:23%">Recursos Humanos</th>
				<th style="width:10%">TOTAL</th>
			</thead>
			<tbody>
				<tr>
					<th>Monto Aprobado por VcM</th>
					<td>
						<?php
							$resourcesCash = getVisibleCashResourcesByInitiativePlanSource($id_initiative, "vcm");
							$subtotalCash = 0;
							foreach($resourcesCash as $resource) {
								$subtotalCash += $resource["valorizacion"];
							}
							echo "$" .  number_format($subtotalCash, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("vcm");?>'
									data-toggle="modal" data-target="#addCash">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesCash as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("vcm") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editCash'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("vcm") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteCash'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesBulding = getVisibleBuildingResourcesByInitiativePlanSource($id_initiative, "vcm");
							$subtotalBuilding = 0;
							foreach($resourcesBulding as $resource) {
								$subtotalBuilding += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalBuilding, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("vcm");?>'
									data-toggle="modal" data-target="#addBuilding">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesBulding as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("vcm") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editBuilding'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("vcm") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteBuilding'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesHuman = getVisibleHumanResourcesByInitiativePlanSource($id_initiative, "vcm");
							$subtotalHuman = 0;
							foreach($resourcesHuman as $resource) {
								$subtotalHuman += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalHuman, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("vcm");?>'
									data-toggle="modal" data-target="#addHuman">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesHuman as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("vcm") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editHuman'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("vcm") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteHuman'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php echo "$" . number_format(($subtotalCash + $subtotalBuilding + $subtotalHuman), '0', ',','.'); ?>
					</td>
				</tr>
				<tr>
					<th>Monto aportado por unidad ejecutora</th>
					<td>
						<?php
							$resourcesCash = getVisibleCashResourcesByInitiativePlanSource($id_initiative, "unidad");
							$subtotalCash = 0;
							foreach($resourcesCash as $resource) {
								$subtotalCash += $resource["valorizacion"];
							}
							echo "$" .  number_format($subtotalCash, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("unidad");?>'
									data-toggle="modal" data-target="#addCash">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesCash as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("unidad") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editCash'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("unidad") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteCash'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesBulding = getVisibleBuildingResourcesByInitiativePlanSource($id_initiative, "unidad");
							$subtotalBuilding = 0;
							foreach($resourcesBulding as $resource) {
								$subtotalBuilding += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalBuilding, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("unidad");?>'
									data-toggle="modal" data-target="#addBuilding">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesBulding as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("unidad") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editBuilding'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("unidad") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteBuilding'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesHuman = getVisibleHumanResourcesByInitiativePlanSource($id_initiative, "unidad");
							$subtotalHuman = 0;
							foreach($resourcesHuman as $resource) {
								$subtotalHuman += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalHuman, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("unidad");?>'
									data-toggle="modal" data-target="#addHuman">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesHuman as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("unidad") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editHuman'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("unidad") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteHuman'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php echo "$" . number_format(($subtotalCash + $subtotalBuilding + $subtotalHuman), '0', ',','.'); ?>
					</td>
				</tr>
				<tr>
					<th>Monto aportado por unidad secundaria</th>
					<td>
						<?php
							$resourcesCash = getVisibleCashResourcesByInitiativePlanSource($id_initiative, "unidad_sec");
							$subtotalCash = 0;
							foreach($resourcesCash as $resource) {
								$subtotalCash += $resource["valorizacion"];
							}
							echo "$" .  number_format($subtotalCash, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("unidad_sec");?>'
									data-toggle="modal" data-target="#addCash">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesCash as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class='small'>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("unidad_sec") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editCash'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("unidad_sec") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteCash'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesBulding = getVisibleBuildingResourcesByInitiativePlanSource($id_initiative, "unidad_sec");
							$subtotalBuilding = 0;
							foreach($resourcesBulding as $resource) {
								$subtotalBuilding += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalBuilding, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("unidad_sec");?>'
									data-toggle="modal" data-target="#addBuilding">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesBulding as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("unidad_sec") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editBuilding'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("unidad_sec") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteBuilding'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesHuman = getVisibleHumanResourcesByInitiativePlanSource($id_initiative, "unidad_sec");
							$subtotalHuman = 0;
							foreach($resourcesHuman as $resource) {
								$subtotalHuman += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalHuman, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("unidad_sec");?>'
									data-toggle="modal" data-target="#addHuman">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesHuman as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("unidad_sec") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editHuman'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("unidad_sec") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteHuman'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php echo "$" . number_format(($subtotalCash + $subtotalBuilding + $subtotalHuman), '0', ',','.'); ?>
					</td>
				</tr>
				<tr>
					<th>Monto aportados por externos</th>
					<td>
						<?php
							$resourcesCash = getVisibleCashResourcesByInitiativePlanSource($id_initiative, "externos");
							$subtotalCash = 0;
							foreach($resourcesCash as $resource) {
								$subtotalCash += $resource["valorizacion"];
							}
							echo "$" .  number_format($subtotalCash, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("externos");?>'
									data-toggle="modal" data-target="#addCash">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesCash as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class='small'>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("externos") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editCash'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("externos") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteCash'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesBulding = getVisibleBuildingResourcesByInitiativePlanSource($id_initiative, "externos");
							$subtotalBuilding = 0;
							foreach($resourcesBulding as $resource) {
								$subtotalBuilding += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalBuilding, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("externos");?>'
									data-toggle="modal" data-target="#addBuilding">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesBulding as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("externos") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editBuilding'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("externos") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteBuilding'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php
							$resourcesHuman = getVisibleHumanResourcesByInitiativePlanSource($id_initiative, "externos");
							$subtotalHuman = 0;
							foreach($resourcesHuman as $resource) {
								$subtotalHuman += $resource["valorizacion"];
							}
							echo "$" . number_format($subtotalHuman, '0', ',','.');

							if(canUpdateInitiatives()) {
								$data = base64_encode("data" . $datas[$i]['id']); ?>
								<a href="#" class='btn btn-orange btn-sm pull-right' title='Agregar monto'
									data-source='<?php echo noeliaEncode("externos");?>'
									data-toggle="modal" data-target="#addHuman">
									<i class="glyphicon glyphicon-plus"></i></a>
						<?php
							} ?>

							<table class="table small">
								<thead>
									<th>Recurso</th>
									<th>Horas</th>
									<th>Valorización</th>
									<th width="50px"></th>
								</thead>
								<?php
									foreach($resourcesHuman as $resource) {
										echo "<tr>";
										echo "	<td>" . $resource["tipo"] . "</td>";
										echo "	<td>" . number_format($resource["cantidad"], '0', ',','.') . "</td>";
										echo "	<td>$" . number_format($resource["valorizacion"], '0', ',','.') . "</td>";
										echo "	<td class=''>";
										echo " 		<a class='text-yellow' title='Editar recurso'
																data-source='" . noeliaEncode("externos") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-name='" . $resource["tipo"] . "'
																data-amount='" . $resource["cantidad"] . "'
																data-total='" . $resource["valorizacion"] . "'
																data-toggle='modal' data-target='#editHuman'>
																<i class='glyphicon glyphicon-edit small'></i>
															</a>";
										echo "&nbsp&nbsp";
										echo " 		<a class='text-blue' title='Eliminar recurso'
																data-source='" . noeliaEncode("externos") . "'
																data-id='" . noeliaEncode($resource["id"]) . "'
																data-toggle='modal' data-target='#deleteHuman'>
																<i class='glyphicon glyphicon-trash small'></i>
															</a>";
										echo "	</td>";
										echo "</tr>";
									}
								?>
							</table>
					</td>
					<td>
						<?php echo "$" . number_format(($subtotalCash + $subtotalBuilding + $subtotalHuman), '0', ',','.'); ?>
					</td>
				</tr>
			</tbody>
		</table>

  </div>
  <!-- /.box-body -->
