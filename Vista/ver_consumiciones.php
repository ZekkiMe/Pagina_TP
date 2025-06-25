<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver consumiciones</title>
    <link rel="stylesheet" href="CSS/consumiciones.css">
    <style>

        .data_plato {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    $ID = $_POST["ID"];

    include("header.php");
    include("../Controlador/leer_consumiciones.php");
    ?>
    <main>
        
        <table class='tabla_reservas'>
            <tr>
                <td class=" dato_reservas">Nombre:</td>
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
                    <td class="dato_reservas"><?php echo ($_POST["cantidad"]); ?></td>
                </tr>
            </table>
            <form action="../Vista/cargar_consumicion.php" method="post">
                <input style="display:none;" type='number' value="<?php echo ($ID); ?>" name='ID'>
                <input style="display:none;"  type='text' value='<?php echo ($_POST["horario"]); ?>' name='horario'>
                <input style="display:none;"  type='date' value='<?php echo ($_POST["dia"]); ?>' name='dia'>
                <input style="display:none;"  type='text' value='<?php echo ($_POST["nombre"]); ?>' name='nombre'>
                <input style="display:none;"  type='email' value='<?php echo ($_POST["mail"]); ?>' name='mail'>
                <input style="display:none;"  type='number' value=' <?php echo ($_POST["cantidad"]); ?>' name='comensales'>

            <?php LeerConsumiciones($ID); ?>
			
    </main>

</body>
<?php
include("footer.php");
?>

</html>
