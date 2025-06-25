<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php'; 

const CORREO = "pruebas.zekki@gmail.com";
const PSW = "vjcbsjnvdctnnhwv";

function enviarCorreo($nombre_usuario, $email_usuario, $titulo, $message, $msj_simple) {

    $mail = new PHPMailer(true);

    try {
        //Configuracioned   
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = CORREO;
        $mail->Password   = PSW;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;

        $mail->setFrom(CORREO, 'Restaurante Pasta a Pasta');
        $mail->addAddress($email_usuario, $nombre_usuario);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';   
        $mail->Subject = $titulo;
        $mail->Body    = $message;
        $mail->AltBody = $msj_simple;
        
        $mail->send();

        return True;
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
        return False;
    }
}
?>