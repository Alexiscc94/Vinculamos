<?php
	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
	}

	include_once("../../utils/user_utils.php");
	if(!canUpdateParameters()) {
		header('Location: ../../index.php');
	}

	$nombre_usuario = $_SESSION["nombre_usuario"];
	$institucion = getInstitution();

	$id_covenant = str_replace("data", "", noeliaDecode($_GET["data"]));

	include_once("../../controller/medoo_covenants.php");
	$datas = getCovenant($id_covenant);
?>

<!DOCTYPE html>
<html>
<?php include_once("../include/header.php")?>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
	<?php
		$activeMenu = "parameters";
		include_once("../include/menu_side.php");
		include_once("modal_add_covenant_doc.php");
		include_once("modal_edit_covenant_doc.php");
		include_once("modal_delete_covenant_doc.php");
	?>

  	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
			<section class="content-header">
      		<h1>
        		Convenio
        		<small>editar convenio</small>
      		</h1>
      		<ol class="breadcrumb">
        		<li><i class="fa fa-dashboard"></i> Inicio</li>
        		<li>Convenios</li>
        		<li class="active">Editar Convenio</li>
      		</ol>
    	</section>

    	<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
    						<h3 class="box-title"><?php echo $datas[0]["nombre"]; ?></h3>
						</div>
						<!-- /.box-header -->

						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div id="loader"></div><!-- Carga los datos ajax -->
									<form class="form-horizontal" method="post" id="edit_covenant" name="edit_covenant">
										<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
										<?php echo "<input type='hidden' value='".noeliaEncode($id_covenant)."' id='vg_id' name='vg_id' />"; ?>

										<div class="form-group">
											<label for="vg_nombre" class="col-sm-4 control-label">Nombre</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="vg_nombre" name="vg_nombre"
													placeholder="Nombre" maxlength="100" required value='<?php echo$datas[0]["nombre"];?>'>
											</div>
										</div>
										<div class="form-group">
											<label for="vg_descripcion" class="col-sm-4 control-label">Descripción</label>
											<div class="col-sm-8">
												<textarea class="form-control textarea" placeholder="Descripción" id="vg_descripcion" name="vg_descripcion"
														style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"><?php echo$datas[0]["descripcion"];?></textarea>
											</div>
										</div>

										<!-- Nuevos campos -->
										<div class="form-group">
											<label for="ht_nombre" class="col-sm-4 control-label">Dirección</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="vg_direccion" name="vg_direccion"
													placeholder="Dirección" maxlength="100" value='<?php echo$datas[0]["direccion"];?>'>
											</div>
										</div>
										<div class="form-group">
											<label for="ht_nombre" class="col-sm-4 control-label">Nombre de contacto</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="vg_nombre_contacto" name="vg_nombre_contacto"
													placeholder="Nombre de contacto" maxlength="100" value='<?php echo$datas[0]["nombre_contacto"];?>'>
											</div>
										</div>
										<div class="form-group">
											<label for="ht_nombre" class="col-sm-4 control-label">Teléfono/Celular</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="vg_telefono" name="vg_telefono"
													placeholder="Teléfono/Celular" maxlength="100" value='<?php echo$datas[0]["telefono"];?>'>
											</div>
										</div>
										<div class="form-group">
											<label for="ht_nombre" class="col-sm-4 control-label">Correo electrónico</label>
											<div class="col-sm-8">
												<input type="email" class="form-control" id="vg_correo_electronico" name="vg_correo_electronico"
													placeholder="Correo electrónico" maxlength="100" value='<?php echo$datas[0]["correo_electronico"];?>'>
											</div>
										</div>
										<div class="form-group">
											<label for="ht_nombre" class="col-sm-4 control-label">Fecha de suscripción</label>
											<div class="col-sm-8">
												<input type="date" class="form-control" id="vg_fecha_suscripcion" name="vg_fecha_suscripcion"
													placeholder="Fecha de suscripción" maxlength="100" value='<?php echo$datas[0]["fecha_suscripcion"];?>'>
											</div>
										</div>
										<div class="form-group">
											<label for="ht_apellido" class="col-sm-4 control-label">Observaciones</label>
											<div class="col-sm-8">
												<textarea class="form-control textarea" placeholder="Observaciones" id="vg_observaciones" name="vg_observaciones"
														style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"><?php echo$datas[0]["observaciones"];?></textarea>
											</div>
										</div>

										<div class="modal-footer">
											<a href="view_covenants.php" class="btn btn-default" data-dismiss="modal">Ir al listado</a>
											<button type="submit" class="btn btn-orange"><span class="fa fa-save"></span> Guardar</button>
										</div>
									</form>
								</div>

								<div class="col-md-6">
									<div class="box-header">
											<h3 class="box-title">Listado de documentos asociados</h3>

											<?php
												if(canCreateParameters()) {?>
													<div class="btn-group pull-right">
													<button id="exportButton" name="exportButton" class="btn btn-orange pull-right" data-toggle="modal" data-target="#addCovenantDoc">
														<span class="fa fa-plus"></span> Agregar Documento
													</button>
												</div>
										<?php
											} ?>
									</div>
									<!-- /.box-header -->

									<div id="resultados_modal_eliminar"></div>

									<div id="resultado_docs"></div><!-- Carga los datos ajax -->

								</div>
							</div>

					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
    	<!-- /.content -->
	</div>
  	<!-- /.content-wrapper -->

  	<?php include_once("../include/footer.php")?>
</div>
<!-- ./wrapper -->

<script>
$(document).ready(function(){
	loadDocs();
});

function loadDocs() {
	var parametros = {
		"id_covenant" : '<?php echo$id_covenant;?>'
	};

	$.ajax({
		type: "POST",
			url:'./ajax_view_covenants_docs.php',
			data:  parametros,
			beforeSend: function () {
				$('#resultado_docs').html('<img src="../../img/ajax-loader.gif"> Cargando...');
			},
			success:  function (response) {
				$("#resultado_docs").html(response);

				$('#table').DataTable({
					'language': {
						"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
					},
					'paging'      : true,
					'lengthChange': true,
					'searching'   : true,
					'ordering'    : true,
					'info'        : true,
					'autoWidth'   : true
				})
			},
			error: function() {
				$("#resultado_docs").html(response);
			}
		});
}

$("#add_covenant_doc").submit(function( event ) {
	$('#add_covenant_doc').attr("disabled", true);
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "./ajax_add_covenant_doc.php",
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function(objeto) {
			$("#resultados_modal_agregar").html("Cargando...");
		},
		success: function(datos) {
			$('#add_covenant_doc').attr("disabled", false);
			$("#resultados_modal_agregar").html(datos);
			loadDocs();
		},
		error: function() {
			$("#resultados_modal_agregar").html("Error en el registro");
		}
	});

	event.preventDefault();
})

$('#addCovenantDoc').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var modal = $(this);
	modal.find('.modal-body #vg_nombre').val("");
	modal.find('.modal-body #vg_descripcion').val("");
	$("#resultados_modal_agregar").html("");
})

$("#edit_covenant_doc").submit(function( event ) {
	$('#edit_covenant_doc').attr("disabled", true);
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "./ajax_edit_covenant_doc.php",
		data: parametros,
		beforeSend: function(objeto) {
			$("#resultados_modal_editar").html("Cargando...");
		},
		success: function(datos) {
			$('#edit_covenant_doc').attr("disabled", false);
			$("#resultados_modal_editar").html(datos);
			loadDocs();
		},
		error: function() {
			$("#resultados_modal_editar").html("Error en el registro");
		}
	});

	event.preventDefault();
})

$('#editCovenantDoc').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var id = button.data('id');
	var nombre = button.data('nombre');
	var descripcion = button.data('descripcion');
	var usuario = button.data('usuario');

	var modal = $(this);
	modal.find('.modal-body #vg_id').val(id);
	modal.find('.modal-body #vg_nombre').val(nombre);
	modal.find('.modal-body #vg_descripcion').val(descripcion);
	modal.find('.modal-body #vg_usuario').val(usuario);

	$("#resultados_modal_editar").html("");
})

$("#delete_covenant_doc").submit(function( event ) {
	$('#delete_covenant_doc').attr("disabled", true);
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "./ajax_delete_covenant_doc.php",
		data: parametros,
		beforeSend: function(objeto) {
			$("#resultados_modal_eliminar").html("Cargando...");
		},
		success: function(datos) {
			$('#delete_covenant_doc').attr("disabled", false);
			$('#deleteCovenantDoc').modal('hide');
			$("#resultados_modal_eliminar").html(datos);
			loadDocs();
		},
		error: function() {
			$("#resultados_modal_eliminar").html("Error en el registro");
		}
	});

	event.preventDefault();
})

$('#deleteCovenantDoc').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var id = button.data('id');
	var nombre = button.data('nombre');
	var nombre_convenio = button.data('nombre_convenio');
	var usuario = button.data('usuario');

	var modal = $(this);
	modal.find('.modal-body #vg_id').val(id);
	modal.find('.modal-body #vg_nombre').html(nombre);
	modal.find('.modal-body #vg_nombre_convenio').html(nombre_convenio);
	modal.find('.modal-body #vg_usuario').val(usuario);

	$("#resultados_modal_eliminar").html("");
})

$("#edit_covenant").submit(function( event ) {
	$('#edit_covenant').attr("disabled", true);
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		url: "./ajax_edit_covenant.php",
		data: parametros,
		beforeSend: function(objeto) {
			$("#loader").html("Cargando...");
		},
		success: function(datos) {
			$("#loader").html(datos);
		},
		error: function() {
			$("#loader").html("Error en el registro");
		}
	});

	event.preventDefault();
})

</script>

</body>
</html>
