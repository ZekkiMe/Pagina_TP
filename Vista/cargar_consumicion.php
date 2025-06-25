<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Consumiciones</title>
    <link rel="stylesheet" href="CSS/consumiciones.css">
</head>
<?php include("header.php"); ?>

<body>
    <main>
        <table class='tabla_reservas'>
            <tr>
                <td class="dato_reservas">Nombre:</td>
                <td class="dato_reservas"><?php echo ($_POST["nombre"]); ?></td>
            </tr>
            <tr>
                <td class="dato_reservas">Día:</td>
                <td class="dato_reservas"><?php echo ($_POST["dia"]); ?></td>
            </tr>
            <tr>
                <td class="dato_reservas">Horario:</td>
                <td class="dato_reservas"><?php echo ($_POST["horario"]); ?></td>
            </tr>
            <tr>
                <td class="dato_reservas">Mail:</td>
                <td class="dato_reservas"><?php echo ($_POST["mail"]); ?></td>
            </tr>
            <tr>
                <td class="dato_reservas">Cantidad:</td>
                <td class="dato_reservas"><?php echo ($_POST["comensales"]); ?></td>
            </tr>
        </table>
        <form action="../Modelo/cargar_consumicion.php" method="post">
            <input style="display: none;" type=number name="ID_reserva" value="<?php echo ($_POST['ID']); ?>"/>
           
           <?php
            include("../Modelo/platos_consumicion.php");

            echo ("<h1>Entradas</h1>");
            LeerCategoria("entradas");

            echo ("<h1>Ensaladas</h1>");
            LeerCategoria("ensaladas");

            echo ("<h1>Pastas</h1>");
            LeerCategoria("pasta");

            echo ("<h1>Parrilla</h1>");
            LeerCategoria("parrilla");

            echo ("<h1>Pescado</h1>");
            LeerCategoria("pescados");

            echo ("<h1>Postres</h1>");
            LeerCategoria("postres");
            ?>
            <div class="botones">
                <button class="volver"><a class="a_cancelar" href="historicos.php" class="a_cancelar">Cancelar</a>
                </button>
                <input class="volver" type="submit">
            </div>
        </form>
    </main>
</body>

<?php include("footer.php"); ?>

</html>