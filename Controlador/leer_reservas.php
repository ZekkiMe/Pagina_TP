<?php

function invertirHorario($horario): string
{
    switch ($horario) {
        case 1:
            return "8-10hrs";
        case 2:
            return "11-13hrs";
        case 3:
            return "14-16hrs";
        case 4:
            return "17-19hrs";
        case 5:
            return "21-23hrs";
        default:
            return "Horario inválido";
    }
}

function LeerReservas()
{

    $dia = date("Y-m-d");

    try {
        include("../Controlador/conexion.php");
        $query = "SELECT *
        FROM reservas 
        WHERE dia >= :dia AND estado = 1
        ORDER BY dia ASC";

        $resultado = $base->prepare($query);
        $resultado->execute(array(":dia" => $dia));
        $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $fecha_actual = "";
        $inicio = 0;

        if (!empty($resultado)) {

            foreach ($resultado as $tipo) {

                $horario = invertirHorario($tipo["horario"]);
                $nombre = $tipo["nombre"];
                $mail = $tipo["mail"];
                $cantidad = $tipo["cantidad"];
                $observaciones = $tipo["observaciones"];

                if ($observaciones == NULL) {
                    $observaciones = "Sin observaciones";
                }


                if ($fecha_actual != $tipo["dia"]) {
                    if ($inicio != 0) {
                        echo ("</table>");
                        echo ("</div>");
                    }
                    $fecha_actual = $tipo["dia"];

                    echo "<h1>$fecha_actual</h1>";

                    echo "<div class='dia'>";


                    $inicio = 1;
                }
                echo "<table class='tabla_reservas'>";
                echo '
                    <tr>
                        <td  class="dato_reservas">Nombre:</td>
                        <td  class="dato_reservas">' . $nombre . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Horario:</td>
                        <td  class="dato_reservas">' . $horario . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Mail:</td>
                        <td  class="dato_reservas">' . $mail . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Cantidad:</td>
                        <td  class="dato_reservas">' . $cantidad . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Observaciones:</td>
                        <td  class="dato_reservas">' . $observaciones . '</td>
                    </tr>';

                echo ("<tr>
                        <td>
                        <form action='../Modelo/hacer_pdf.php' method='post' id='datos' target='_blank'>                            
                            <input type='number' value=" . $tipo["ID"] . " name='ID'>
                            <input type='text' value='" . $horario . "' name='horario'>
                            <input type='date' value='" . $fecha_actual . "' name='dia'>
                            <input type='text' value='" . $nombre . "' name='nombre'>
                            <input type='email' value='" . $mail . "' name='mail'>
                            <input type='number' value=" . $cantidad . " name='cantidad'>
                            <input type='text' value='" . $observaciones . "' name='observaciones'>
                            <input type='submit' value='Imprimir' class='enviar'>
                            </form>
                            </td>
                        <td>
                        <form action='../Vista/editar_reserva.php' method='post' id='datos'>                            
                            <input type='number' value=" . $tipo["ID"] . " name='ID'>
                            <input type='text' value='" . $horario . "' name='horario'>
                            <input type='date' value='" . $fecha_actual . "' name='dia'>
                            <input type='text' value='" . $nombre . "' name='nombre'>
                            <input type='email' value='" . $mail . "' name='mail'>
                            <input type='number' value=" . $cantidad . " name='cantidad'>
                            <input type='text' value='" . $observaciones . "' name='observaciones'>
                            <input type='submit' value='Editar' class='enviar'>
                            </form>
                            </td>
                    </tr>");

                echo "</table>";
            }
            echo ("</table>");
            echo ("</div>");
        } else {
            echo "<h1>No tienes resevas</h1>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function LeerReservasUsuario($mail)
{

    $dia = date("Y-m-d");

    try {
        include("../Controlador/conexion.php");
        $query = "SELECT * FROM reservas WHERE dia >= :dia AND mail = :mail AND estado = 1 ORDER BY dia ASC";

        $resultado = $base->prepare($query);
        $resultado->execute(array(":dia" => $dia, ":mail" => $mail));
        $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $fecha_actual = "";
        $inicio = 0;

        if (!empty($resultado)) {

            foreach ($resultado as $tipo) {

                $horario = invertirHorario($tipo["horario"]);
                $nombre = $tipo["nombre"];
                $mail_r = $tipo["mail"];
                $cantidad = $tipo["cantidad"];
                $observaciones = $tipo["observaciones"];

                if ($observaciones == NULL) {
                    $observaciones = "Sin observaciones";
                }


                if ($fecha_actual != $tipo["dia"]) {
                    if ($inicio != 0) {
                        echo ("</table>");
                        echo ("</div>");
                    }
                    $fecha_actual = $tipo["dia"];

                    echo "<h1>$fecha_actual</h1>";

                    echo "<div class='dia'>";


                    $inicio = 1;
                }
                echo "<table class='tabla_reservas'>";
                echo '
                    <tr>
                        <td  class="dato_reservas">Nombre:</td>
                        <td  class="dato_reservas">' . $nombre . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Horario:</td>
                        <td  class="dato_reservas">' . $horario . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Mail:</td>
                        <td  class="dato_reservas">' . $mail_r . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Cantidad:</td>
                        <td  class="dato_reservas">' . $cantidad . '</td>
                    </tr>
                    <tr>
                        <td  class="dato_reservas">Observaciones:</td>
                        <td  class="dato_reservas">' . $observaciones . '</td>
                    </tr>';

                echo ("<tr>
                        <td>
                        <form action='../Modelo/hacer_pdf.php' method='post' id='datos' target='_blank'>                            
                            <input type='number' value=" . $tipo["ID"] . " name='ID'>
                            <input type='text' value='" . $horario . "' name='horario'>
                            <input type='date' value='" . $fecha_actual . "' name='dia'>
                            <input type='text' value='" . $nombre . "' name='nombre'>
                            <input type='email' value='" . $mail_r . "' name='mail'>
                            <input type='number' value=" . $cantidad . " name='cantidad'>
                            <input type='text' value='" . $observaciones . "' name='observaciones'>
                            <input type='submit' value='Imprimir' class='enviar'>
                            </form>
                            </td>
                        <td>
                        <form action='../Vista/editar_reserva.php' method='post' id='datos'>                            
                            <input type='number' value=" . $tipo["ID"] . " name='ID'>
                            <input type='text' value='" . $horario . "' name='horario'>
                            <input type='date' value='" . $fecha_actual . "' name='dia'>
                            <input type='text' value='" . $nombre . "' name='nombre'>
                            <input type='email' value='" . $mail_r . "' name='mail'>
                            <input type='number' value=" . $cantidad . " name='cantidad'>
                            <input type='text' value='" . $observaciones . "' name='observaciones'>
                            <input type='submit' value='Editar' class='enviar'>
                            </form>
                            </td>
                    </tr>");

                echo "</table>";
            }
            echo ("</table>");
            echo ("</div>");
        } else {
            echo "<h1>No tienes resevas</h1>";
        }
    } catch (PDOException $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}
