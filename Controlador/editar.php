<?php

function EditarUsuario($nombre, $email, $pass,$birth): string
{

    try {
        include("conexion.php");

        $opciones = ['cost'=>8];
        $pass_encript = password_hash($pass, PASSWORD_DEFAULT, $opciones);

        session_start();

        $ID = $_SESSION["ID"];

        $query = "UPDATE datos_usuarios
            SET nombre = :nombre,
            email = :email,
            pass = :pass,
            pass_hash = :passhash,
            fecha_nacimiento = :fecha
            WHERE ID = $ID";

        $resultado = $base->prepare($query);

        $resultado->execute(array(':nombre'=> $nombre, ':email'=> $email, ':pass'=> $pass, ':passhash'=> $pass_encript, ':fecha'=> $birth));

        $_SESSION["nombre"] = $nombre;
        $_SESSION["mail"] = $email;
        $_SESSION["password"] = $pass;
        $_SESSION["birth"] = $birth;

        return "correcto";

    } catch (PDOException $e) {
        return $e->getMessage();
    }
    $base->close();
}
?>
