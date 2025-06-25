<?php

function BjarUsuario($ID): string
{

    try {
        include("conexion.php");

        $query = "UPDATE datos_usuarios
            SET estado = 0
            WHERE ID = :id";

        $resultado = $base->prepare($query);

        $resultado->execute(array(":id" => $ID));

        return "correcto";
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    $base->close();
}

