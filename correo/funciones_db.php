<?php

require '../Controlador/conexion.php';

function cumplesEnviados($id_usuario) {
    global $base;
    $ciclo = date("Y");

    $qry = "
        SELECT
            COUNT(*)
        FROM
            correos_enviados
        WHERE
            id_usuario = :id_usuario
            AND tipo_correo = 'cumpleaños'
            AND YEAR(fecha_envio) = :ciclo
    ";
    $resultado = $base->prepare($qry);
    $resultado->bindParam(':id_usuario', $id_usuario);
    $resultado->bindParam(':ciclo', $ciclo);
    $resultado->execute();

    return $resultado->fetchColumn() > 0;
}

function buscarCumples() {
    global $base;
    $fechaActual = new DateTime();
    $fechaLimite = clone $fechaActual;
    $fechaLimite->modify('+30 days');

    $mesActual = $fechaActual->format('m');
    $diaActual = $fechaActual->format('d');

    $mesLimite = $fechaLimite->format('m');
    $diaLimite = $fechaLimite->format('d');

    $qry = "
        SELECT
            ID, nombre, email, fecha_nacimiento
        FROM
            datos_usuarios d
        WHERE
            (MONTH(d.fecha_nacimiento) = :mesA AND DAY(d.fecha_nacimiento) >= :diaA)
        OR
            (MONTH(d.fecha_nacimiento) = :mesL AND DAY(d.fecha_nacimiento) <= :diaL)
        OR
            (:mesA > :mesL AND (MONTH(d.fecha_nacimiento) >= :mesA OR MONTH(d.fecha_nacimiento) <= :mesL))
        OR
            (:mesA < :mesL AND MONTH(d.fecha_nacimiento) > :mesA AND MONTH(d.fecha_nacimiento) < :mesL)
    ";
    $resultado = $base->prepare($qry);
    $resultado->bindParam(':mesA', $mesActual);
    $resultado->bindParam(':diaA', $diaActual);
    $resultado->bindParam(':mesL', $mesLimite);
    $resultado->bindParam(':diaL', $diaLimite);
    $resultado->execute();

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}

function insertarDB($id_usuario, $email_usuario, $msj_tipo) {
    global $base;

    $qry = "
        INSERT INTO
            correos_enviados(id_usuario, correo_destinatario, tipo_correo)
        VALUES
            (:id_usuario, :email, :tipo_corrreo)
    ";
    $resultado = $base->prepare($qry);
    $resultado->bindParam(':id_usuario', $id_usuario);
    $resultado->bindParam(':email', $email_usuario);
    $resultado->bindParam(':tipo_corrreo', $msj_tipo);
    $resultado->execute();
}

function buscarClienteCancelador(int $min_cancelaciones = 3): array {
    global $base;

    $qry = "
        SELECT
            du.ID as id_usuario,
            du.nombre,
            du.email,
            COUNT(r.ID) AS cantidad_cancelaciones
        FROM
            datos_usuarios du
        JOIN
            reservas r ON du.ID = r.id_usuario
        WHERE
            r.estado = 0 -- 0 para cancelado
        GROUP BY
            du.ID, du.nombre, du.email
        HAVING
            COUNT(r.ID) > :min_cancelaciones
        ORDER BY
            cantidad_cancelaciones DESC;
    ";

    $resultado = $base->prepare($qry);
    $resultado->bindParam(':min_cancelaciones', $min_cancelaciones, PDO::PARAM_INT);
    $resultado->execute();

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerDatosPorId(int $id_usuario) {
    global $base;

    $qry = "
        SELECT
            ID, nombre, email
        FROM
            datos_usuarios
        WHERE
            ID = :id_usuario;
    ";
    $resultado = $base->prepare($qry);
    $resultado->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $resultado->execute();

    return $resultado->fetch(PDO::FETCH_ASSOC);
}

function obtenerNumCancelaciones(int $id_usuario): int {
    global $base;

    $qry = "
        SELECT
            COUNT(ID)
        FROM
            reservas
        WHERE
            id_usuario = :id_usuario AND estado = 0;
    ";
    $resultado = $base->prepare($qry);
    $resultado->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $resultado->execute();

    return (int) $resultado->fetchColumn();
}

?>