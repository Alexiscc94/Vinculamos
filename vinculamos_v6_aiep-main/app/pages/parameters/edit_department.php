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

	$id = str_replace("data", "", noeliaDecode($_GET["data"]));

	include_once("../../controller/medoo_departments.php");
	$datas = getDepartment($id);
?>

<!DOCTYPE html>
<html>
<?php include_once("../include/header.php")?>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
	<?php
		$activeMenu = "parameters";
		include_once("../include/menu_side.php");

		include_once("modal_add_carrer.php");
		include_once("modal_edit_carrer.php");
		include_once("modal_delete_carrer.php");
	?>

  	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
			<section class="content-header">
      		<h1>
			  Ámbitos de contribución
        		<small>editar ámbitos de contribución</small>
      		</h1>
      		<ol class="breadcrumb">
        		<li><i class="fa fa-dashboard"></i> Inicio</li>
        		<li>Ámbitos de contribución</li>
        		<li class="active">Editar Ámbitos de contribución</li>
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
		    						<form class="form-horizontal" method="post" id="edit_department" name="edit_department">
											<?php echo "<input type='hidden' value='".$_SESSION['nombre_usuario']."' id='vg_usuario' name='vg_usuario' />"; ?>
											<?php echo "<input type='hidden' value='".noeliaEncode($id)."' id='vg_id' name='vg_id' />"; ?>
											<div class="form-group">
												<label for="vg_nombre" class="col-sm-3 control-label">Nombre <span class="text-red">*</span></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="vg_nombre" name="vg_nombre"
														placeholder="Nombre" maxlength="100" required value='<?php echo$datas[0]["nombre"];?>'>
												</div>
											</div>
											<div class="form-group">
												<label for="vg_descripcion" class="col-sm-3 control-label">Descripción</label>
												<div class="col-sm-8">
													<textarea class="form-control textarea" placeholder="Descripción" id="vg_descripcion" name="vg_descripcion"
															style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"><?php echo$datas[0]["descripcion"];?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="vg_director" class="col-sm-3 control-label">Director</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="vg_director" name="vg_director"
														placeholder="Director" maxlength="100" value='<?php echo$datas[0]["director"];?>'>
												</div>
											</div>

											<div class="modal-footer">
												<a href="view_departments.php" class="btn btn-default" data-dismiss="modal">Ir al listado</a>
												<button type="submit" class="btn btn-orange"><span class="fa fa-save"></span> Guardar</button>
											</div>
										</form>
									</div>

									<div class="col-md-6">
										<div class="box-header">
												<h3 class="box-title">Listado de carreras</h3>

												<?php
													if(canCreateParameters()) {?>
														<div class="btn-group pull-right">
														<button id="exportButton" name="exportButton" class="btn btn-orange btn-sm pull-right" data-toggle="modal" data-target="#addCarrer">
															<span class="fa fa-plus"></span> Agregar Carrera
														</button>
													</div>
											<?php
												} ?>
										</div>
										<!-- /.box-header -->

										<div id="resultados_modal_eliminar"></div>

										<div id="resultado_carreras"></div><!-- Carga los datos ajax -->

									</div>

								</div>
							</form>

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
		loadCarrers();
	});

	function loadCarrers() {
		var parametros = {
			"id_department" : '<?php echo$id;?>'
		};

		$.ajax({
			type: "POST",
				url:'./ajax_view_carrers.php',
				data:  parametros,
				beforeSend: function () {
					$('#resultado_carreras').html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success:  function (response) {
					$("#resultado_carreras").html(response);

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
					$("#resultado_carreras").html(response);
				}
			});
	}

	$("#add_carrer").submit(function( event ) {
		$('#add_carrer').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_add_carrer.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_agregar").html("Cargando...");
			},
			success: function(datos) {
				$('#add_carrer').attr("disabled", false);
				$("#resultados_modal_agregar").html(datos);
				loadCarrers();
			},
			error: function() {
				$("#resultados_modal_agregar").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#addCarrer').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var modal = $(this);
		modal.find('.modal-body #vg_nombre').val("");
		modal.find('.modal-body #vg_descripcion').val("");
		modal.find('.modal-body #vg_director').val("");
		$("#resultados_modal_agregar").html("");
	})

	$("#edit_carrer").submit(function( event ) {
		$('#edit_carrer').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_edit_carrer.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_editar").html("Cargando...");
			},
			success: function(datos) {
				$('#edit_carrer').attr("disabled", false);
				$("#resultados_modal_editar").html(datos);
				loadCarrers();
			},
			error: function() {
				$("#resultados_modal_editar").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#editCarrer').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data('id');
		var nombre = button.data('nombre');
		var descripcion = button.data('descripcion');
		var director = button.data('director');
		var usuario = button.data('usuario');

		var modal = $(this);
		modal.find('.modal-body #vg_id').val(id);
		modal.find('.modal-body #vg_nombre').val(nombre);
		modal.find('.modal-body #vg_descripcion').val(descripcion);
		modal.find('.modal-body #vg_director').val(director);
		modal.find('.modal-body #vg_usuario').val(usuario);

		$("#resultados_modal_editar").html("");
	})

	$("#delete_carrer").submit(function( event ) {
		$('#delete_carrer').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_delete_carrer.php",
			data: parametros,
			beforeSend: function(objeto) {
				$("#resultados_modal_eliminar").html("Cargando...");
			},
			success: function(datos) {
				$('#delete_carrer').attr("disabled", false);
				$('#deleteCarrer').modal('hide');
				$("#resultados_modal_eliminar").html(datos);
				loadCarrers();
			},
			error: function() {
				$("#resultados_modal_eliminar").html("Error en el registro");
			}
		});

		event.preventDefault();
	})

	$('#deleteCarrer').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data('id');
		var nombre = button.data('nombre');
		var usuario = button.data('usuario');

		var modal = $(this);
		modal.find('.modal-body #vg_id').val(id);
		modal.find('.modal-body #vg_nombre').html(nombre);
		modal.find('.modal-body #vg_usuario').val(usuario);

		$("#resultados_modal_eliminar").html("");
	})

	$("#edit_department").submit(function( event ) {
		$('#edit_department').attr("disabled", true);
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "./ajax_edit_department.php",
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
