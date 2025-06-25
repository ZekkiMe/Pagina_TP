<?php
function cargarConsumision($id_reserva, $id_plato, $cantidad)
{
    try {
        include("conexion.php");

        $checkQuery = "SELECT cantidad FROM detalle_orden
        WHERE id_reserva = :reserva AND id_plato = :plato";

        $checkStmt = $base->prepare($checkQuery);
        $checkStmt->execute(array(
            ':reserva' => $id_reserva,
            ':plato' => $id_plato
        ));

        if ($row = $checkStmt->fetch(PDO::FETCH_ASSOC)) {

            $nuevaCantidad = $row['cantidad'] + $cantidad;
            $updateQuery = "UPDATE detalle_orden SET cantidad = :cantidad
            WHERE id_reserva = :reserva AND id_plato = :plato";

            $updateStmt = $base->prepare($updateQuery);
            $updateStmt->execute(array(
                ':cantidad' => $nuevaCantidad,
                ':reserva' => $id_reserva,
                ':plato' => $id_plato
            ));
            $updateStmt->closeCursor();
        } else {
            
            $query = "INSERT INTO detalle_orden (id_reserva, id_plato, cantidad)
            VALUES (:reserva, :plato, :cantidad)";

            $resultado = $base->prepare($query);
            $resultado->execute(array(
                ':reserva' => $id_reserva,
                ':plato' => $id_plato,
                ':cantidad' => $cantidad
            ));
            $resultado->closeCursor();
        }

        $checkStmt->closeCursor();

    } catch (PDOException $e) {
        print("<h1>Hubo un error $e</h1>");
    }
}
