<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Realizada</title>
    <link rel="stylesheet" href="CSS/reserva_completa.css">

</head>

<body>
    <?php include("header.php"); ?>

    <main>
        <h1>Reserva realizada exitosamente</h1>
        <ul class="datos_reserva">
            <div class="panel">
                <li class="n">El día: <?php echo ($_SESSION["fecha"]); ?></li>
                <li class="n">En el turno: <?php echo ($_SESSION["horario"]); ?></li>
                <li class="n">Para: <?php echo ($_SESSION["cantidad"]); ?></li>
            </div>

            <div class="panel">
                <li class="n">A nombre de: <?php echo ($_SESSION["nombre_r"]); ?></li>
                <li class="n">Con mail: <?php echo ($_SESSION["mail"]); ?></li>
                <li class="n">A tener en cuenta: <?php echo ($_SESSION["observaciones"]); ?></li>
            </div>
        </ul>

        
        <form method="post" id="reserva" style="display: none;">
            <input type="text" value='<?php echo ($_SESSION["fecha"]); ?>' name="dia">
            <input type="text" value='<?php echo ($_SESSION["horario"]); ?>' name="horario">
            <input type="text" value='<?php echo ($_SESSION["cantidad"]); ?>' name="cantidad">
            <input type="text" value='<?php echo ($_SESSION["nombre"]); ?>' name="nombre">
            <input type="text" value='<?php echo ($_SESSION["mail"]); ?>' name="mail">
            <input type="text" value='<?php echo ($_SESSION["observaciones"]); ?>' name="observaciones">
        </form>
<div class="botones">

    <button class="boton" ><a class="volver" href="form_ingreso.php">Terminar</a></button>
    <button type="submit" form="reserva" class="boton" formaction="../Modelo/hacer_pdf.php">Descargar</button>
</div>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>