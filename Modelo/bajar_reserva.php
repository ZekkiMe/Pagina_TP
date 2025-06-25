<?php
include("../Controlador/editar_reserva.php");

$id = $_POST["ID"];

$insercion = BajarReserva($id);

if ($insercion == "correcto") {
    header("Location: http://localhost/Pagina_TP/Vista/usuario.php");
    echo($insercion);
} else {
    echo ("
    <h1>Hubo un error</h1>
    <p>De hecho fue este: " . $insercion);
}
?>