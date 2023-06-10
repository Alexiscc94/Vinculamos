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

	$id = base64_decode($_POST["id_initiative"]);
	include_once("../../controller/medoo_initiatives_plan_result.php");
	$datas = getVisibleResultsByInitiativePlan($id);

	if(sizeof($datas) == 0) {
		echo "<p>No se han cargado resultados esperados.</p>";
		return;
	}
?>

<div class="box-body table-responsive">
	<table id="table" class="table table-bordered table-hover">
		<!--thead>
    	<tr>
      	<th style="width:110px">Cantidad</th>
				<th>Resultado</th>
				<th style="width:50px"></th>
      </tr>
		</thead-->
   	<tbody>
 			<?php
 				for($i=0 ; $i<sizeof($datas) ; $i++) { ?>
 					<tr>
      			<td style="width:50px">
							<?php
							 	if($datas[$i]['tipo'] == "Interno") {
									echo "<small class='label bg-purple'>Interno</small>";
								}
								if($datas[$i]['tipo'] == "Externo") {
									echo "<small class='label bg-maroon'>Externo</small>";
								}
							?>
						</td>
						<td class="text-center"><?php echo $datas[$i]['cantidad'];?></td>
      			<td class=""><?php echo $datas[$i]['resultado'];?></td>
						<td style="width:100px">
							<?php
								$data = noeliaEncode("data" . $datas[$i]['id']);
      					if(canUpdateInitiatives()) { ?>
									<a href="#" class='btn btn-blue btn-sm' title='Editar resultado'
										data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
										data-tipo='<?php echo $datas[$i]['tipo'];?>'
										data-cantidad='<?php echo $datas[$i]['cantidad'];?>'
										data-resultado='<?php echo $datas[$i]['resultado'];?>'
										data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
										data-toggle="modal" data-target="#editResult">
										<i class="fa fa-edit small"></i>
									</a>

									<a class="btn btn-blue btn-sm" data-toggle="modal" data-target="#deleteResult"
										data-id_resultado='<?php echo noeliaEncode($datas[$i]['id']);?>'
										data-resultado='<?php echo $datas[$i]['resultado'];?>'
										data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
										title='Eliminar resultado'>
										<i class="fa fa-trash small"></i>
									</a>
							<?php
								} ?>
      			</td>
          </tr>
 			<?php
 				} ?>

  	</tbody>
	</table>
</div>
<!-- /.box-body -->
