<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../../../template/plugins/PHPMailer/src/Exception.php';
	require '../../../template/plugins/PHPMailer/src/PHPMailer.php';
	require '../../../template/plugins/PHPMailer/src/SMTP.php';

	if(!isset($_SESSION)){
		@session_start();
	}

	session_start();
	if($_SESSION["activo"] == 0) {
		header('Location: ../../index.php');
		return;
	}

	include_once("../../utils/user_utils.php");
	if(!canUpdateInitiatives()) {
		echo "<p><strong> Acceso no permitido.</strong></p>";
		return;
	}

	$institucion = getInstitution();

	if(false) {
		echo "<br>vg_usuario: " . noeliaDecode($_REQUEST['vg_usuario']);
		echo "<br>vg_id: " . noeliaDecode($_REQUEST['vg_id']);
		//return;
	}

	if( isset($_REQUEST['vg_id']) && isset($_REQUEST['vg_usuario']) ) {

		include_once("../../controller/medoo_initiatives_plan.php");
		$result = editInitiativePlanStatus(noeliaDecode($_REQUEST['vg_id']),
			"Aprobada", noeliaDecode($_REQUEST['vg_usuario']));

		if($result != null) {
			if(true) {
				include_once("../../controller/medoo_users.php");
				$userAuthor = getUser($result[0]["autor"]);

				//$url = "http://cftpucv.vinculamosvm02.cl";
				$idIniciativa = $result[0]["id"];
				$nombreIniciativa = $result[0]["nombre"];

				$asunto = "Iniciativa aprobada en plataforma Vinculamos";
				$mensaje = "";
				$mensaje = "Estimado/a,<br>";
				$mensaje .= "Su iniciativa <strong>#$idIniciativa \"$nombreIniciativa\"</strong> ha sido APROBADA en la plataforma Vinculamos. ";
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
					$mail->AddAddress($userAuthor[0]["correo_electronico"]);

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
			}

			echo noeliaEncode("data" . $result[0]["id"]);
		} else {
			echo "-1";
		}
	} else {
		echo "Falta info!";
	}
?>
