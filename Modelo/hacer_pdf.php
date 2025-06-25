<?php
require_once "../dompdf/autoload.inc.php";

use Dompdf\dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array("isRemoteEnabled" => true));
$dompdf->setOptions($options);
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Reserva</title>
    <link rel="stylesheet" href="../Vista/CSS/hacer_pdf.css">
</head>

<body>
    <?php
    $fecha = $_POST["dia"] ?? '';
    $horario = $_POST["horario"] ?? '';
    $cantidad = $_POST["cantidad"] ?? '';
    $nombre = $_POST["nombre"] ?? '';
    $mail = $_POST["mail"] ?? '';
    $observaciones = $_POST["observaciones"] ?? 'Sin observaciones';
    $nombre = htmlspecialchars($nombre);
    $mail = htmlspecialchars($mail);
    $observaciones = htmlspecialchars($observaciones);
    ?>

    <main>
        <div class="head">
            <h1 class="h1_titulo">Reserva</h1>
        </div>

        <hr class="separador">

        <h1>Datos de reservante</h1>
        <div class="primero">
            <table>
                <tr>
                    <td class="titulo">Nombre:</td>
                    <td class="dato"><?php echo $nombre; ?></td>
                </tr>
                <tr>
                    <td class="titulo">e-mail:</td>
                    <td class="dato"><?php echo $mail; ?></td>
                </tr>
            </table>
        </div>

        <h1>Datos de la reserva</h1>
        <div class="segundo">
            <table>
                <tr>
                    <td class="titulo">Día:</td>
                    <td class="dato"><?php echo $fecha; ?></td>
                </tr>
                <tr>
                    <td class="titulo">Horario:</td>
                    <td class="dato"><?php echo $horario; ?></td>
                </tr>
                <tr>
                    <td class="titulo">Cantidad:</td>
                    <td class="dato"><?php echo $cantidad; ?></td>
                </tr>
                <tr>
                    <td class="titulo">Observaciones:</td>
                    <td class="dato"><?php echo $observaciones; ?></td>
                </tr>
            </table>
        </div>

        <hr class="separador">

        <div class="importante">
            <h1>Importante</h1>
            <p>
                Recuerde que para ingresar deben estar todos los comensales indicados en la reserva.<br>
                Las reservas pueden ser canceladas hasta 24 horas antes de la fecha.<br>
                Para ingresar se debe indicar el nombre de la persona que realizó la reserva.<br>
            </p>
            <strong><br>No es necesario imprimir este comprobante de reserva.</strong>
        </div>

        <div class="foot">
            <h1>Gracias por elegirnos</h1>
            <p>Cualquier consulta comunicarse al: 11 xxxx-xxxx</p>
            <p>Todos los días de: 08-23 hrs</p>
        </div>
    </main>
</body>

</html>

<?php
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper("A4");
$dompdf->render();
$dompdf->stream("Reserva_$nombre", array("Attachment" => false));

?>