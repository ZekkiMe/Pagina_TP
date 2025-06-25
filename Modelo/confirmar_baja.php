<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmacion de registro</title>
</head>
<?php
include("../Controlador/eliminar.php");
session_start();

$ID = $_SESSION["ID"];

$insercion = BjarUsuario($ID);

if ($insercion == "correcto") {
  include("cerrar_sesion.php");
} else {
  echo ("
    <h1>Hubo un error</h1>
    <p>De hecho fue este: $insercion</p>");
}
?>

</html>