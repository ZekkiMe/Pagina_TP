<?php

function Ingresar($mail, $pass): string
{

    try {
        include("conexion.php");

        $query = "SELECT *
            FROM datos_usuarios
            WHERE email = :email";

        $resultado = $base->prepare($query);
        $resultado->execute(array(":email" => $mail));

        $correcto = false;

        if($resultado = $resultado->fetch(PDO::FETCH_ASSOC)){
            $correcto = password_Verify($pass, $resultado['pass_hash']);
        }

        if (($correcto == true) && ($resultado["estado"] == true)) {
            session_start();
            $_SESSION["ID"]=$resultado["ID"];
            $_SESSION["nombre"] = $resultado["nombre"];
            $_SESSION["mail"] = $resultado["email"];
            $_SESSION["tipo"] = $resultado["tipo"];
            $_SESSION["password"] = $resultado["pass"];
            $_SESSION["birth"] = $resultado["fecha_nacimiento"];
            return "encontrado";
        }else {
            return "nope";
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    $base->close();
}
?>
