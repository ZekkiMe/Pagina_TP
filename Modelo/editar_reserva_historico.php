<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmacion de registro</title>
</head>

<body>
  <?php

  $id = htmlentities(addslashes($_POST["ID"]));
  $estado = htmlentities(addslashes($_POST["estado"]));

  include("../Controlador/editar_reserva_historico.php");

  $insercion = EditarReserva($id, $estado);

  if ($insercion == "correcto") {
    header("Location: http://localhost/Pagina_TP/Vista/historicos.php");
  } else {
    echo ("
    <h1>Hubo un error</h1>
    <p>De hecho fue este: " . $insercion);
  }
  ?>

</body>

</html>