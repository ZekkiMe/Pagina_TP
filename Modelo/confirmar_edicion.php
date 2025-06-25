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
    $birth = htmlentities(addslashes($_POST["birth"]));
    
    include("../Controlador/editar.php");

    $insercion = EditarUsuario($nombre, $email, $pass,$birth);

    if ($insercion == "correcto"){
      header("Location: http://localhost/Pagina_TP/Vista/usuario.php");

     }else{
      echo("
    <h1>Hubo un error</h1>
    <p>De hecho fue este: " .$insercion);
  }
  ?>

  </body>

</html>