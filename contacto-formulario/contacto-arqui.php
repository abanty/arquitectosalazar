<?php

      $whitelist = array('name','email','subject','message');
      // Building an array with the $_POST-superglobal
      foreach ($_POST as $key=>$item) {
              // Check if the value $key (fieldname from $_POST) can be found in the whitelisting array, if not, die with a short message to the hacker
      		if (!in_array($key, $whitelist)) {

      			writeLog('Unknown form fields');
      			die("Hack-Attempt detected. Please use only the fields in the form");
      		}
      }
      // PREPARE THE BODY OF THE MESSAGE

			$message = '<html><body>';
			$message .= '<img src="https://salazararquitectos.com/images/logoform.png" alt="Salazar Arquitectos"/>';
			$message .= '<table rules="all" style="border-color: #d8d6d6;margin-left: 40px;" cellpadding="16">';
      $message .= "<tr style='background: #f7a414;color: white;text-transform: uppercase;'><td colspan='2'><center><strong> INFORMACIÓN DEL CONTACTO</strong></center></td></tr>";
			$message .= "<tr><td><strong>NOMBRE DE CONTACTO:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
			$message .= "<tr><td><strong>CORREO ELECTRÓNICO:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
			$message .= "<tr><td><strong>ASUNTO O TEMA:</strong> </td><td>" . strip_tags($_POST['subject']) . "</td></tr>";

			$redaccion = htmlentities($_POST['message']);
			if (($redaccion) != '') {
			    $message .= "<tr style='height: 150px;'><td><strong>MENSAJE O REDACCIÓN:</strong> </td><td>" . $redaccion . "</td></tr>";
			}
			$message .= "</table>";
			$message .= "</body></html>";

            //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS

			// $to = 'alan.porras@bioshellperu.com';
      $to = 'arq_oscar@salazararquitectos.com';

      // alan.porras@bioshellperu.com
			$subject = 'OSCAR SALAZAR CONTACTOS';

			$headers = "From: OSCAR SALAZAR ";
      	// $headers = "From: " 'BIOSHELL PERU' "\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if (mail($to, $subject, $message, $headers)) {
              echo 'Tu mensaje ha sido Enviado.';
            } else {
              echo 'There was a problem sending the email.';
            }

            die();

?>
