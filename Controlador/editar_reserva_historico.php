<?php

function EditarReserva($id, $estado): string
{

    try {
        include("conexion.php");

        $query = "UPDATE reservas
          SET 
            estado = :estado
          WHERE ID = :id";

        $resultado = $base->prepare($query);

        $resultado->execute(array(
            ':estado' => $estado,
            ':id' => $id
        ));

        return "correcto";
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    $base->close();
}
