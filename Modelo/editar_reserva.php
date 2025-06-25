<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmacion de registro</title>
</head>

<body>
  <?php
  function SacarHorario($horario)
  {
    switch ($horario) {
      case "8-10hrs":
        return  1;
      case "11-13hrs":
        return  2;
      case "14-16hrs":
        return 3;
      case "17-19hrs":
        return 4;
      case "21-23hrs":
        return 5;
      default:
        break;
    }
  }

  $id = htmlentities(addslashes($_POST["ID"]));
  $fecha = htmlentities(addslashes($_POST["dia"]));
  $horario = htmlentities(addslashes($_POST["horario"]));
  $cantidad = htmlentities(addslashes($_POST["cantidad"]));
  $nombre = htmlentities(addslashes($_POST["nombre"]));
  $mail = htmlentities(addslashes($_POST["mail"]));
  $observaciones = htmlentities(addslashes($_POST["observaciones"]));

  $horario = SacarHorario($horario);

  include("../Controlador/editar_reserva.php");

  $insercion = EditarReserva($id, $fecha, $horario, $cantidad, $nombre, $mail, $observaciones);

  if ($insercion == "correcto") {
    header("Location: http://localhost/Pagina_TP/Vista/usuario.php");
  } else {
    echo ("
    <h1>Hubo un error</h1>
    <p>De hecho fue este: " . $insercion);
  }
  ?>

</body>

</html>