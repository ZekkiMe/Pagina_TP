<?php

$email = htmlentities(addslashes($_POST["email"]));
$pass = htmlentities(addslashes($_POST["pass"]));

include("../Controlador/ingresar.php");

$busqueda = Ingresar($email, $pass);
var_dump($busqueda);

if ($busqueda == "encontrado"){
    header("Location: http://localhost/Pagina_TP/Vista/usuario.php");
} elseif ($busqueda == "nope"){
    header("Location: http://localhost/Pagina_TP/Vista/sin_coinsidir.php");
} else {
    $_GET["error"] = $busqueda;
    header("Location: http://localhost/Pagina_TP/Vista/error.php");
}
?>