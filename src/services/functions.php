<?php
require_once __DIR__ . 'vendor/autoload.php';

print_r(__DIR__ . 'vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function sendMail($subject, $body, $email, $name, $html = false)
{
    $mail = new PHPMailer(true); // Instancia de PHPMailer    
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST']; // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME']; // Correo Gmail
        $mail->Password = $_ENV['MAIL_PASSWORD']; // Clave de aplicación de Gmail
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION']; // Usar TLS en lugar de SSL
        $mail->Port = 587; // Puerto para TLS

        // Remitente y destinatario
        $mail->setFrom($_ENV['MAIL_USERNAME'], 'Sergio Olivo');
        $mail->addAddress($email, $name);

        // Contenido del correo
        $mail->isHTML($html); // Si es HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body); // Texto alternativo para clientes de correo que no soportan HTML

        // Enviar correo
        $mail->send();
        return 'success';
        // echo 'Correo enviado con éxito';
    } catch (Exception $e) {
         return 'error';
    }
}

//Validar Formulario
function validateForm($name, $email, $subject, $message) : bool
{
    return !empty($name) && !empty($email) && !empty($subject) && !empty($message);         
}

