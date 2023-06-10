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

	include_once("../../controller/medoo_covenants.php");
	$datas = getVisibleCovenantsByInstitution($institucion);

	include_once("../../controller/medoo_covenants_docs.php");
?>

<div class="box-body table-responsive">
	<table id="table" class="table table-bordered table-hover">
  	<thead>
      <tr>
        <th>Nombre</th>
				<th>Descripcion</th>

				<th>Direccion</th>
				<th>Nombre de contacto</th>
				<th>Teléfono/Celular</th>
				<th>Correo electrónico</th>
				<th>Fecha de suscripción</th>
				<th>Observaciones</th>

				<th>Documentos adjuntos</th>
				<th style="width:100px">Acciones</th>
      </tr>
    </thead>
		<tbody>
			<?php
				for($i=0 ; $i<sizeof($datas) ; $i++) { ?>
					<tr>
	  			<td><?php echo $datas[$i]['nombre'];?></td>
					<td><?php echo $datas[$i]['descripcion'];?></td>

	  			<td><?php echo $datas[$i]['direccion'];?></td>
					<td><?php echo $datas[$i]['nombre_contacto'];?></td>
					<td><?php echo $datas[$i]['telefono'];?></td>
					<td><?php echo $datas[$i]['correo_electronico'];?></td>
					<td><?php echo $datas[$i]['fecha_suscripcion'];?></td>
					<td><?php echo $datas[$i]['observaciones'];?></td>
					<td>
						<?php
							$docs = getVisibleCovenantDocsByCovenant($datas[$i]['id']);
							echo sizeof($docs) . " documento(s).";?>
					</td>
					<td>
	  				<?php
	  					if(canUpdateParameters()) {
	  						$data = noeliaEncode("data" . $datas[$i]['id']); ?>
								<a href="edit_covenant.php?data=<?php echo$data;?>" class='btn btn-orange btn-sm' title='Editar'>
									<i class="glyphicon glyphicon-cog"></i>
								</a>
								<a href="#" class='btn btn-orange btn-sm' title='Agregar Documento'
									data-id='<?php echo noeliaEncode($datas[$i]['id']);?>'
									data-usuario='<?php echo $_SESSION["nombre_usuario"];?>'
									data-toggle="modal" data-target="#addCovenantDoc">
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
									data-toggle="modal" data-target="#deleteCovenant">
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
