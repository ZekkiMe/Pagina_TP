<?php

try {

    $conn = new PDO("mysql:host=localhost; dbname=pagina_tp;", "root", '');

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET CHARACTER SET utf8");


    $sql = "SELECT * FROM reservas";

    $resultado = $conn->prepare($sql);

    $resultado->execute();

    $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultado)) {
        foreach ($resultado as $tipo) {?>

        <table>
            <tr>
                <td>Nombre: </td>
                <td><?php echo $tipo["nombre"] ?></td>
            </tr>

            <td>Fecha: </td>
                <td><?php echo $tipo["dia"] ?></td>
            </tr>
            <form>
                <input type="number" value="">
                <input type="submit">
            </form>
        </table>
        <br>
        <br>
        <?php
            
        }
    }
} catch (PDOException $e) {
    echo 'Hubo un error: ' . $e->getMessage();
}
