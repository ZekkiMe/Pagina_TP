<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php

function SacarHorario($horario)
{
    switch ($horario) {
        case "8-10hrs":
            return  1;
        case "11-13hrs":
            return  2;
        case "14-16hrs":
            return 3;
        case "17-19hrs":
            return 4;
        case "21-23hrs":
            return 5;
        default:
            break;
    }
}

$fecha = $_POST["dia"];
$horario = $_POST["horario"];
$cantidad = $_POST["cantidad"];
$nombre = $_POST["nombre"];
$mail = $_POST["mail"];
$observaciones = $_POST["observaciones"];

$horario = SacarHorario($horario);

try {
    include("../Controlador/reservar.php");
    RealizarReserva($fecha, $horario, $cantidad, $nombre, $mail, $observaciones);

    session_start();
    $_SESSION["fecha"] = $fecha;
    $_SESSION["horario"] = $horario;
    $_SESSION["cantidad"] = $cantidad;
    $_SESSION["nombre_r"] = $nombre;
    $_SESSION["mail"] = $mail;
    $_SESSION["observaciones"] = $observaciones;

    header("Location: http://localhost/Pagina_TP/Vista/reserva_completa.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

</html>