<?php

    function LeerCategoria($categoria){
        include("../Controlador/conexion.php");
        
        $query = "SELECT *
        FROM platos
        WHERE tipo =:tipo";

        $resultado = $base->prepare($query);
        $resultado->execute(array(":tipo" => $categoria));
        $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);

        echo "<table class='tabla_platos'>";

        foreach($resultado as $tipo){
            echo '
            <tr class="fila_plato">
                <td class="data_plato">'.$tipo["nombre"].'</td>
                <td class="data_plato">'.$tipo["descripcion"].'</td>
                <td class="precio">$'.$tipo["precio"].'</td>
            </tr>';
        }
        echo("</table>");
        
    }
    
?>