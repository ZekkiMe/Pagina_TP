<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/historicos.css">
    <title>Reservas Historicas</title>
</head>
<header><?php include("header.php"); 
include("../Controlador/leer_reservas_historico.php")?></header>

<?php if ($_SESSION["tipo"] == "S") {?>
    <main>

    <?php LeerReservas()?>
    <div class="boton">
        <button class="volver"><a href="usuario.php" class="a_cancelar">Volver</a></button>
    </div>
    </main>

<?php }else{?>

    <main>

    <?php LeerReservasUsuario($_SESSION["mail"])?>
    <div class="boton">
        <button class="volver"><a href="usuario.php" class="a_cancelar">Volver</a></button>
    </div>

    </main>

<?php }?>
<footer><?php include("footer.php"); ?></footer>

</html>