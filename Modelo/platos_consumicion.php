<?php

function LeerCategoria($categoria)
{
    include("../Controlador/conexion.php");

    $query = "SELECT *
        FROM platos
        WHERE tipo =:tipo";

    $resultado = $base->prepare($query);
    $resultado->execute(array(":tipo" => $categoria));
    $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo "<table class='tabla_platos'>";

    foreach ($resultado as $plato) {
        echo '<tr class="fila_plato">
            <td class="data_plato">' . $plato["nombre"] . '</td>
            <td class="precio">$' . $plato["precio"] . '</td>';

        $id = isset($_POST['id_plato' . $plato["ID"]]);
        
        if ($id) {
            $cantidad = $_POST['cantidad' . $plato["ID"]];
            echo '
                <td class="precio">Cantidad: <input class="cantidad" type="number" value="' . $cantidad . '" name="cantidad' . $plato["ID"] . '"></td>';
        } else {
            echo '
                <td class="precio">Cantidad: <input class="cantidad" type="number" value="0" name="cantidad' . $plato["ID"] . '"></td>';
        }
        echo '</tr>';
    }

    echo '</tr>';
    echo ("</table>");
}
