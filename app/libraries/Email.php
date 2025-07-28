<?php

namespace Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

if (!isset($_ENV['MAIL_MAILER'])) {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
}

define('MAIL_HOST', $_ENV['MAIL_HOST']);
define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
define('MAIL_PORT', $_ENV['MAIL_PORT']);

class Email {
    protected $nombre;
    protected $email;
    protected $token;

    public function __construct($nombre, $email, $token) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
    
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->Port = MAIL_PORT;
        
            //Recipients
            $mail->setFrom('admin@uptask.com', 'Uptask');
            $mail->addAddress($this->email, $this->nombre);
        
            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Confirma tu cuenta';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola, " . $this->nombre . "</strong>. Has creado tu cuenta en Uptask
            , solo debes confirmarla presionando el siguiente enlace.</p>";
            $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar cuenta</a></p>";
            $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje.</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
        
            return $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function enviarReestablecer() {
        // Crear la instancia de PHPMailer
        $mail = new PHPMailer();
        try {
            // Server settings
        $mail->isSMTP();   
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Port = MAIL_PORT;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;

        $mail->setFrom('admin@uptask.com', 'Uptask');
        $mail->addAddress($this->email, $this->nombre);

        //Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Reestablecer contraseña';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola, " . $this->nombre . "</strong>. Para reestablecer su contraseña haga click en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/reestablecer?token=" . $this->token . "'>Reestablecer Contraseña</a></p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el email
        return $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
