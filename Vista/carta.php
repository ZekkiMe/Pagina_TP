<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta</title>
    <link rel="stylesheet" href="CSS/carta.css">
</head>
<body>
    <?php include("header.php");?>
    <main>
      <?php
        include("../Modelo/leer_platos.php");

        echo("<h1>Entradas</h1>");
        LeerCategoria("entradas");

        echo("<h1>Ensaladas</h1>");
        LeerCategoria("ensaladas");

        echo ("<h1>Pastas</h1>");
        LeerCategoria("pasta");

        echo("<h1>Parrilla</h1>");
        LeerCategoria("parrilla");
      
        echo("<h1>Pescado</h1>");
        LeerCategoria("pescados");

        echo ("<h1>Postres</h1>");
        LeerCategoria("postres");
      ?>
    </main>
    <?php include("footer.php");?>
</body>
</html>