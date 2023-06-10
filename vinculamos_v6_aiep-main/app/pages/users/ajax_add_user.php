<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../template/plugins/PHPMailer/src/Exception.php';
require '../../../template/plugins/PHPMailer/src/PHPMailer.php';
require '../../../template/plugins/PHPMailer/src/SMTP.php';

	if(!isset($_SESSION)){
		@session_start();
	}

	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}

	include_once("../../utils/user_utils.php");
	if(!canCreateUsers()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$institucion = getInstitution();

	if( isset($_REQUEST['vg_nombre']) && isset($_REQUEST['vg_apellido'])
		&& isset($_REQUEST['vg_telefono']) && isset($_REQUEST['vg_correo_electronico'])
		&& isset($_REQUEST['vg_perfil']) && isset($_REQUEST['vg_nombre_usuario'])
		&& isset($_REQUEST['vg_contrasenia_1']) && isset($_REQUEST['vg_contrasenia_2']) && isset($_REQUEST['vg_estado']) ) {

		if($_REQUEST['vg_contrasenia_1'] != $_REQUEST['vg_contrasenia_2']) { ?>

			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				Las contraseñas ingresadas deben ser iguales.
			</div>
		<?php
			return;
		} else {
			include_once("../../controller/medoo_users.php");
			$result = addUser($_REQUEST['vg_nombre'], $_REQUEST['vg_apellido'], $_REQUEST['vg_correo_electronico'],
				$_REQUEST['vg_telefono'], noeliaDecode($_REQUEST['vg_perfil']), $_REQUEST['vg_nombre_usuario'],
				$_REQUEST['vg_contrasenia_1'], $_REQUEST['vg_estado'], noeliaDecode($_REQUEST['vg_usuario']));

			//editUserInstitutionInformation($result[0]["nombre_usuario"], $_REQUEST['vg_tipo_institucion'], $_REQUEST['vg_sede_institucion'], $_REQUEST['vg_unidad']);

			if($result != null) {

				if(true) {
					$url = "http://aiep.vinculamosvm01.cl/vinculamos_v6_aiep";
					$destinatario = $_REQUEST['vg_correo_electronico'];
					$asunto = "Nueva cuenta de usuario en plataforma Vinculamos";
					$mensaje = "";
					$mensaje = "Estimado/a,<br>";

					$mensaje .= "Se ha creado una cuenta en la plataforma Vinculamos. ";
					$mensaje .= "Para ingresar, haga clic en el siguiente <a href='$url'>enlace</a>.<br>";

					$mensaje .= "<br>Saluda atentamente a usted. <br><br>";
					$mensaje .= "<img src='http://aiep.vinculamosvm01.cl/vinculamos_v6_aiep/app/img/aiep_chico.png' width='200px'>";

					/* INICIO PHP Mailer */
					$mail = new PHPMailer(true);
					try {
						//Create a new PHPMailer instance
						$mail->IsSMTP();

						//Configuracion servidor mail
						$mail->From = "notificaciones@vinculamos.cl"; //remitente
						$mail->FromName = 'Vinculamos';
						$mail->SMTPAuth = true;
						$mail->SMTPSecure = 'tls'; //seguridad
						$mail->Host = "smtp.gmail.com"; // servidor smtp
						$mail->Port = 587; //puerto
						$mail->Username ='notificaciones@vinculamos.cl'; //nombre usuario
						$mail->Password = '8WDy*67d2'; //contraseña

						// Configguración de correo
						$mail->IsHTML(true);
						$mail->CharSet = 'UTF-8';

						//Agregar destinatario
						$mail->AddAddress($destinatario);
						$mail->addBCC('crecontr@gmail.com');
						$mail->Subject = $asunto;
						$mail->Body = $mensaje;

						//Avisar si fue enviado o no y dirigir al index
						$mail->Send();

						//echo 'El mensaje ha sido enviado';
					} catch (Exception $e) {
						//echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
					}
					/* FIN PHP Mailer */
				} ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Usuario guardado correctamente.
				</div>
			<?php
			} else { ?>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					El usuario que intenta agregar ya existe.
				</div>
			<?php
			}

		}
	}
?>
