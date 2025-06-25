<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmacion de registro</title>
  </head>
<body>
  <?php
    $nombre = htmlentities(addslashes($_POST["nombre"]));
    $email = htmlentities(addslashes($_POST["email"]));
    $pass = htmlentities(addslashes($_POST["pass"]));
    
    include("../Controlador/registrar.php");

    $insercion = Insertar($nombre, $email, $pass);

    if ($insercion == "correcto"){
      header("Location: http://localhost/Pagina_TP/Vista/form_ingreso.php?exito=1");

     }else{
      echo("
    <h1>Hubo un error</h1>
    <p>De hecho fue este:" .$insercion);
  }
  ?>

  </body>

</html>