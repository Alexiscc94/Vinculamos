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
?>

<!DOCTYPE html>
<html>
<?php include_once("../../config/settings.php")?>
<?php include_once("../include/header.php")?>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

	<?php
		$activeMenu = "datas";
		include_once("../include/menu_side.php");

		include_once("../initiatives/modal_calculate_invi.php");
	?>

  	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
    	<section class="content-header">
      		<h1>
        		 Conexión mediante API
        		<small>todas las API</small>
      		</h1>
					<ol class="breadcrumb">
        		<li><i class="fa fa-dashboard"></i> Inicio</li>
        		<li>Análisis de datos</li>
        		<li class="active">Conexión mediante API</li>
      		</ol>
    	</section>

    	<!-- Main content -->
    	<section class="content">
      	<div class="row">
					<div class="col-lg-12 col-xs-6">
						<div class="box box-default">
							<div class="box-header with-border">
							  <h3 class="box-title">APIs disponibles</h3>
							  <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
							  <div class="row">

									<div class="col-lg-12 col-xs-6">
										<p>El enlace de acceso: <a>https://aiep.vinculamosvm01.cl/vinculamos_v6_aiep/app/api/data.php</a>
											<br>Para acceder a los datos se debe realizar una consulta HTTPS mediante el método GET, enviando los datos de acceso del usuario mediante "Basic Auth".
										</p>

										<p>La respuesta a la consulta tiene la siguiente estructura:</p>
										<pre style="font-weight: 600;">
[
	{
		"id": "",
		"nombre": "",
		"año_ejecución": "",
		"formato_implementacion": "",
		"resumen_iniciativa": "",
		"estado": "",
		"institucion": "",
		"mecanismo_nombre": "",
		"frecuencia_nombre": "",
		"unidades": [{
				"id": "",
				"nombre": ""
			}
		],
		"sedes": [{
				"id": "",
				"nombre": ""
			}
		],
		"ambito_contribucion": [{
				"id": "",
				"nombre": ""
			}
		],
		"carreras": [{
				"id": "",
				"nombre": ""
			}
		],
		"ambitos": [{
			"id": "",
			"nombre": ""
		}],
		"ambitos_secundarios": [{
			"id": "",
			"nombre": ""
		}],
		"convenios": [{
				"id": "",
				"nombre": ""
			}
		],
		"entornos": [{
			"id": "",
			"nombre": "",
		}],
		"impactos_internos": [{
				"id": "",
				"nombre": ""
			}
		],
		"impactos_externos": [{
				"id": "",
				"nombre": ""
			}
		],
		"paises": [{
			"id": "",
			"nombre": ""
		}],
		"regiones": [{
			"id": "",
			"nombre": ""
		}],
		"comunas": [{
				"id": "",
				"id_region": "",
				"nombre": ""
			}
		],
		"participantes": [{
			"id": "",
			"tipo": "",
			"tipo2": "",
			"id_iniciativa": "",
			"publico_general": "",
			"aplica_sexo": "",
			"sexo_masculino": "",
			"sexo_femenino": "",
			"sexo_otro": "",
			"aplica_edad": "",
			"edad_ninos": "",
			"edad_jovenes": "",
			"edad_adultos": "",
			"edad_adultos_mayores": "",
			"aplica_procedencia": "",
			"procedencia_rural": "",
			"procedencia_urbano": "",
			"aplica_vulnerabilidad": "",
			"vulnerabilidad_pueblo": "",
			"vulnerabilidad_discapacidad": "",
			"vulnerabilidad_pobreza": "",
			"aplica_nacionalidad": "",
			"nacionalidad_chileno": "",
			"nacionalidad_migrante": "",
			"nacionalidad_pueblo": "",
			"aplica_etnia": "",
			"etnia_mapuche": "",
			"etnia_otro": ""
		}],
		"invi": {
			"mecanismo": {
				"etiqueta": "",
				"valor": ""
			},
			"cobertura_territorialidad": {
				"etiqueta": "",
				"valor": ""
			},
			"cobertura_pertinencia": {
				"etiqueta": "",
				"valor": ""
			},
			"cobertura_cantidad": {
				"etiqueta": "",
				"valor": ""
			},
			"frecuencia": {
				"etiqueta": "",
				"valor": ""
			},
			"evaluacionInterna": {
				"valor": "",
				"etiqueta": ""
			},
			"evaluacionExterna": {
				"valor": "",
				"etiqueta": ""
			},
			"evaluacion": {
				"valor": "",
				"etiqueta": ""
			},
			"invi": {
				"total": ""
			}
		},
		"ods": [{
			"id": "2",
			"nombre": ""
		}]
	}
]


										</pre>
									</div>



								<!-- /.col -->
								</div>
							  <!-- /.row -->
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>

    	</section>
    	<!-- /.content -->
  	</div>
  	<!-- /.content-wrapper -->

  <?php include_once("../include/footer.php")?>
</div>
<!-- ./wrapper -->

<script src="../../../template/bower_components/chart.js/Chart.js"></script>
<script src="../../../template/bower_components/jquery-knob/js/jquery.knob.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

<script>
	$(document).ready(function(){

	});

</script>
</body>
</html>
