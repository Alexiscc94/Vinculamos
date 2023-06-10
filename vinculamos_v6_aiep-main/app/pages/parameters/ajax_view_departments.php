<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}
	include_once("../../utils/user_utils.php");
	if(!canReadParameters()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$institucion = getInstitution();

	include_once("../../controller/medoo_departments.php");
	$datas = getVisibleDepartmentsByInstitution($institucion);

	include_once("../../controller/medoo_carrers.php");
?>

<div class="box-body table-responsive">
	<table id="table" class="table table-bordered table-hover">
  	<thead>
      <tr>
        <th>Nombre</th>
        <!--th>Descripción</th>
				<th>Director</th-->
				<th>Carreras</th>
				<th style="width:100px">Acciones</th>
      </tr>
    </thead>
		<tbody>
			<?php
				for($i=0 ; $i<sizeof($datas) ; $i++) { ?>
					<tr>
	  			<td><?php echo $datas[$i]['nombre'];?></td>
	  			<!--td><?php echo $datas[$i]['descripcion'];?></td>
					<td><?php echo $datas[$i]['director'];?></td-->
					<td>
						<?php
							$carrers = getVisibleCarrersByDepartment($datas[$i]['id']);
							echo sizeof($carrers) . " carrera(s).";?>
					</td>
					<td>
	  				<?php
	  					if(canUpdateParameters()) {
	  						$data = noeliaEncode("data" . $datas[$i]['id']); ?>
								<a href="edit_department.php?data=<?php echo$data;?>" class='btn btn-orange btn-sm' title='Editar'>
									<i class="glyphicon glyphicon-cog"></i>
								</a>
								<a href="#" class='btn btn-orange btn-sm' title='Agregar Carrera'
									data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
									data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
									data-toggle="modal" data-target="#addCarrer">
									<i class="glyphicon glyphicon-open-file"></i>
								</a>
						<?php
							} ?>

						<?php
	  					if(canDeleteParameters()) { ?>
								<a href="#" class='btn btn-default btn-sm' title='Eliminar'
									data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
									data-nombre='<?php echo $datas[$i]['nombre'];?>'
									data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
									data-toggle="modal" data-target="#deleteDepartment">
									<i class="glyphicon glyphicon-trash"></i></a>
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
