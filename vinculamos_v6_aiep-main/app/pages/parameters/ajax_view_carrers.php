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
	$department = $_POST["id_department"];

	include_once("../../controller/medoo_carrers.php");
	$datas = getVisibleCarrersByDepartment($department);
?>

<div class="box-body table-responsive">
	<table id="table" class="table table-bordered table-hover">
  	<thead>
      <tr>
        <th>Nombre</th>
        <th>Descripción</th>
				<th>Director</th>
				<th style="width:65px">Acciones</th>
      </tr>
    </thead>
		<tbody>
			<?php
				for($i=0 ; $i<sizeof($datas) ; $i++) { ?>
					<tr>
	  			<td><?php echo $datas[$i]['nombre'];?></td>
	  			<td><?php echo $datas[$i]['descripcion'];?></td>
					<td><?php echo $datas[$i]['director'];?></td>
					<td>
	  				<?php
	  					if(canUpdateParameters()) { ?>
								<a href="#" class='btn btn-orange btn-sm' title='Editar'
									data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
									data-nombre='<?php echo $datas[$i]['nombre'];?>'
									data-descripcion='<?php echo $datas[$i]['descripcion'];?>'
									data-director='<?php echo $datas[$i]['director'];?>'
									data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
									data-toggle="modal" data-target="#editCarrer">
									<i class="glyphicon glyphicon-edit"></i></a>
						<?php
							} ?>

						<?php
	  					if(canDeleteParameters()) { ?>
								<a href="#" class='btn btn-default btn-sm' title='Eliminar'
									data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
									data-nombre='<?php echo $datas[$i]['nombre'];?>'
									data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
									data-toggle="modal" data-target="#deleteCarrer">
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
