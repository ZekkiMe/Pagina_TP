<?php
function RealizarReserva($fecha, $horario, $cantidad, $nombre, $mail, $observaciones, $uid){
    try{
        include("conexion.php");

        $checkQuery = "SELECT COUNT(*) as total 
        FROM reservas WHERE mail = :mail";

        $checkStmt = $base->prepare($checkQuery);
        $checkStmt->execute(array(':mail' => $mail));
        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);

        $query = "INSERT INTO reservas 
        (dia, horario, cantidad, nombre, mail, observaciones, id_usuario)
        VALUES (:dia, :horario, :cantidad, :nombre, :mail, :observaciones, :id_usuario)";

        $resultado = $base->prepare($query);

        $resultado->execute(array(
            ':dia'=>$fecha, 
            ':horario'=>$horario, 
            ':cantidad'=>$cantidad, 
            ':nombre'=>$nombre, 
            ':mail'=>$mail, 
            ':observaciones'=>$observaciones,
            'id_usuario'=>$uid
        ));

        $resultado->closeCursor();

        if ($row && $row['total'] > 0) {
            $updateQuery = "UPDATE datos_usuarios 
            SET reservas = reservas + 1 
            WHERE mail = :mail";

            $updateStmt = $base->prepare($updateQuery);
            $updateStmt->execute(array(':mail' => $mail));
            $updateStmt->closeCursor();
        }

        $checkStmt->closeCursor();

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>