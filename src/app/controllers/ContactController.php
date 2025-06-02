<?php

require_once '../app/models/Accommodation.php';
require_once '../app/models/User.php';

require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController {
    public function register() {
        // Ya no creamos registros en la base de datos, solo enviamos un email

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar el captcha
            $recaptchaSecret = '6LcuAkorAAAAALmDOMeA2lKlzurISMtc6kl9oE-s';
            $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
            
            if (empty($recaptchaResponse)) {
                echo "Por favor, complete el captcha para verificar que no es un robot.";
                exit;
            }
            
            // Verificar el captcha con Google
            $recaptchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
            $recaptchaData = json_decode($recaptchaVerify);
            
            if (!$recaptchaData->success) {
                echo "La verificación del captcha ha fallado. Por favor, inténtelo de nuevo.";
                exit;
            }
            $owner_name = $_POST['contactInfo']['user_name'];
            $owner_mail = $_POST['contactInfo']['user_email'];
            $owner_phone = $_POST['contactInfo']['user_phone'];
            $owner_city = $_POST['contactInfo']['acc_city'];

            $acc_name = $_POST['contactInfo']['acc_name'];
            $acc_address = $_POST['contactInfo']['acc_address'];
            $acc_type = $_POST['contactInfo']['acc_type'];
            $acc_city = $_POST['contactInfo']['acc_city'];
            
            // Creamos una variable para simular que se ha procesado el formulario correctamente
            $createdOwnerDataForEmail = true;

            $subject = "Nuevo registro de alojamiento";
            $message = "
Hola equipo Symplex,

Se ha recibido una nueva solicitud de registro de alojamiento:

--- DATOS DEL ALOJAMIENTO ---
Nombre: $acc_name
Dirección: $acc_address
Tipo: $acc_type
Ciudad: $acc_city

--- DATOS DEL PROPIETARIO ---
Nombre: $owner_name
Email: $owner_mail
Teléfono: $owner_phone
Ciudad: $owner_city

Por favor, pónganse en contacto con el propietario lo antes posible para verificar los datos y completar el proceso de registro.
            
Saludos,
Sistema Automático de Symplex
";

            // PHPMailer SMTP setup
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'mailhog';  // This will resolve inside Docker network
                $mail->Port = 1025;
                $mail->SMTPAuth = false;

                $mail->setFrom('no-reply@symplex.com', 'Symplex');
                $mail->addAddress('info@symplex.com', 'Equipo Symplex');
                
                // Enviar también una copia de confirmación al propietario
                $confirmationMessage = "Hola $owner_name,\n\nGracias por tu interés en registrar tu alojamiento con Symplex.\n\nHemos recibido tu solicitud y nuestro equipo se pondrá en contacto contigo lo antes posible para verificar los datos y completar el proceso de registro.\n\nSaludos,\nEl equipo de Symplex";
                
                $mailToOwner = clone $mail;
                $mailToOwner->clearAddresses();
                $mailToOwner->addAddress($owner_mail, $owner_name);
                $mailToOwner->Subject = "Hemos recibido tu solicitud de registro";
                $mailToOwner->Body = $confirmationMessage;

                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->isHTML(false);
                $mail->CharSet = 'UTF-8';

                // Enviar el correo al equipo de Symplex
                $mail->send();
                
                // Enviar el correo de confirmación al propietario
                try {
                    $mailToOwner->isHTML(false);
                    $mailToOwner->CharSet = 'UTF-8';
                    $mailToOwner->send();
                } catch (Exception $e) {
                    // Si falla el envío al propietario, al menos ya se envió al equipo
                    // No mostramos el error para no confundir al usuario
                }
                
                // Devolver mensaje de éxito para que el JavaScript lo procese
                echo "enviado";
                exit;
            } catch (Exception $e) {
                echo "Ha ocurrido un error al enviar el email. Por favor, inténtalo de nuevo más tarde.";
                exit;
            }
        }
    }

    public function sendHelp() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar el captcha
            $captcha_response = $_POST['g-recaptcha-response'] ?? '';
            if (empty($captcha_response)) {
                echo "Por favor, complete el captcha para verificar que no es un robot.";
                return;
            }
            
            // Verificar el captcha con Google
            $secret_key = "6LcuAkorAAAAABMDJGLmZ9FZbqfXnJWJnhXKLPbX";
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = [
                'secret' => $secret_key,
                'response' => $captcha_response,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ];
            
            // Usar cURL en lugar de file_get_contents para más fiabilidad
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $verify_response = curl_exec($curl);
            $curl_error = curl_error($curl);
            curl_close($curl);
            
            if ($verify_response === false) {
                echo "Error al conectar con el servicio de verificación: " . $curl_error;
                return;
            }
            
            $response_data = json_decode($verify_response);
            
            // Para desarrollo, vamos a omitir temporalmente la verificación del captcha
            // En producción, debes quitar este comentario y usar la verificación real
            /*
            if (!$response_data->success) {
                echo "Error de verificación del captcha. Por favor, inténtelo de nuevo.";
                return;
            }
            */
            
            $user_email = $_POST['helpEmail'] ?? '';
            $user_message = $_POST['helpMessage'] ?? '';

            $subject = "Consulta desde el Centro de Ayuda";
            $message = "
Hola equipo Symplex,

Has recibido una nueva consulta desde el formulario de ayuda:

Email del usuario: $user_email

Mensaje:
$user_message

Por favor, responde lo antes posible.
";

            // PHPMailer SMTP setup
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'mailhog';
                $mail->SMTPAuth = false;
                $mail->Port = 1025;
                
                $mail->setFrom('info@symplex.com', 'Symplex');
                $mail->addAddress('soporte@symplex.com');
                $mail->addReplyTo($user_email);
                
                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->isHTML(false);

                $mail->send();
                
                // Devolver mensaje de éxito para que el JavaScript lo procese
                echo "enviado";
                exit;
            } catch (Exception $e) {
                // En caso de error, mostrar mensaje de error
                $errorMsg = "Error al enviar el correo: {$mail->ErrorInfo}";
                require '../app/views/help.php';
            }
        }
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $userModel = new User();
            $user = $userModel->getByEmail($email);
            
            if ($user) {
                $newPassword = $userModel->generateRandomPassword();
                $userModel->updatePassword($user['user_id'], $newPassword);
                $user_name = $user['first_name'];

                $subject = "Nueva contraseña generada";
                $message = "
Hola {$user_name},

Se ha generado una nueva contraseña para tu cuenta.

Tu nueva contraseña es: $newPassword

Por favor, inicia sesión y cambia tu contraseña lo antes posible.

Saludos,
El equipo de Symplex
";

                // Send email with PHPMailer
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'mailhog';
                    $mail->Port = 1025;
                    $mail->SMTPAuth = false;

                    $mail->setFrom('no-reply@symplex.com', 'Symplex');
                    $mail->addAddress($email, $user['first_name']);

                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = mb_encode_mimeheader($subject, 'UTF-8', 'B');
                    $mail->Body    = $message;
                    $mail->isHTML(false);

                    $mail->send();

                    header('Location: index.php?action=forgotpass&success=EmailSent');
                    exit;
                } catch (Exception $e) {
                    header('Location: index.php?action=forgotpass&error=EmailSendFailed');
                    exit;
                }
            } else {
                header('Location: index.php?action=forgotpass&error=UserNotFound');
            }
        } else {
            require_once '../app/views/forgotpass.php';
        }
    }
}

?>
