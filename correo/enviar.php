<?php

require_once 'funciones_db.php';
require_once 'estructura_correo.php';

function ejecutarCumples() {
    $mensajes = [];
    echo "Iniciando el proceso de envío de correos de cumpleaños...\n";

    $cumplesProximos = buscarCumples();
    if (!empty($cumplesProximos)) {
        echo "<br>Se encontraron " . count($cumplesProximos) . " usuarios con cumpleaños próximos.\n";
        $noenviados = 0;

        foreach ($cumplesProximos as $usuario) {
            $idUsuario = $usuario['ID'];
            $nombreUsuario = $usuario['nombre'];
            $emailUsuario = $usuario['email'];
            $fechaNacimiento = new DateTime($usuario['fecha_nacimiento']);
            $tipoCorreo = 'cumpleaños';

            if (!cumplesEnviados($idUsuario, $tipoCorreo)) {
                $cicloActual = date("Y");
                $edadProxima = $cicloActual - $fechaNacimiento->format('Y');

                $tituloCorreo = "¡Feliz Cumpleaños " . $nombreUsuario . "!";
                $mensajeHTML = "
                    <html>
                    <head>
                        <style>
                            body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
                            .container { background-color: #ffffff; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 600px; }
                            .header { text-align: center; color: #333; }
                            .content { margin-top: 20px; color: #555; line-height: 1.6; }
                            .footer { margin-top: 30px; text-align: center; font-size: 0.9em; color: #888; }
                            .button { display: inline-block; padding: 10px 20px; margin-top: 20px; background-color:rgb(0, 15, 31); color: white; text-decoration: none; border-radius: 5px; }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <h1 class='header'>¡Feliz Cumpleaños, " . htmlspecialchars($nombreUsuario) . "!</h1>
                            <div class='content'>
                                <p>De parte de todo el equipo de Restaurante Pasta a Pasta, queremos desearte un día maravilloso y lleno de alegría al celebrar tus " . $edadProxima . " años.</p>
                                <p>Esperamos que disfrutes de tu día especial.</p>
                                <p>¡Te esperamos pronto para celebrar juntos!</p>
                                <p style='text-align: center;'><a href='#' class='button'>Visítanos</a></p>
                            </div>
                            <div class='footer'>
                                <p>&copy; " . $cicloActual . " Restaurante Pasta a Pasta. Todos los derechos reservados.</p>
                            </div>
                        </div>
                    </body>
                    </html>
                ";
                $mensajeSimple = "¡Feliz Cumpleaños, " . $nombreUsuario . "! De parte de Restaurante Pasta a Pasta, te deseamos un día maravilloso al celebrar tus " . $edadProxima . " años. Esperamos verte pronto.";

                echo "<br>Intentando enviar correo a: " . $nombreUsuario . " (" . $emailUsuario . ").\n";
                if (enviarCorreo($nombreUsuario, $emailUsuario, $tituloCorreo, $mensajeHTML, $mensajeSimple)) {
                    insertarDB($idUsuario, $emailUsuario, $tipoCorreo);
                    echo "Correo enviado y registrado para " . $nombreUsuario . ".\n";
                }
            } else {
                $noenviados+=1;    
            }
        };
        if ($noenviados != 0){
            echo "<br>Ya se envió un correo de cumpleaños a $noenviados usuarios este año.\n";
        }
    } else {
        echo "<br>No se encontraron usuarios con cumpleaños próximos en los siguientes 30 días.\n";
    }

    echo "<br>Proceso de envío de correos de cumpleaños finalizado.\n";
    return implode("<br>", $mensajes);
}
?>