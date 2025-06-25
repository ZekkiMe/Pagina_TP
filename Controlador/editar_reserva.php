<?php

function EditarReserva($id, $fecha, $horario, $cantidad, $nombre, $mail, $observaciones): string
{

    try {
        include("conexion.php");

        $query = "UPDATE reservas
          SET dia = :fecha,
              horario = :horario,
              cantidad = :cantidad,
              nombre = :nombre,
              mail = :mail,
              observaciones = :observaciones
          WHERE ID = :id";

        $resultado = $base->prepare($query);

        $resultado->execute(array(
            ':fecha' => $fecha,
            ':horario' => $horario,
            ':cantidad' => $cantidad,
            ':nombre' => $nombre,
            ':mail' => $mail,
            ':observaciones' => $observaciones,
            ':id' => $id
        ));

        return "correcto";
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    $base->close();
}

function BajarReserva($id): string{
    try {
        
        include("conexion.php");

        $query = "UPDATE reservas
            SET estado = 0
            WHERE ID = :id";

        $resultado = $base->prepare($query);

        $resultado->execute(array(':id' => $id));

        return "correcto";
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    $base->close();
}