<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/form_dispo.css">
    <title>Disponibilidad</title>
</head>

<body>
    <?php include("header.php"); ?>
    <main>

        <form action="reservar.php" method="post">

            <label id="dia">Día</label>
            <input type="date" id="dia" name="dia" min="<?php echo date("Y-m-d"); ?>" required>
            <label id="horario">Horario</label>
            <input type="text" multiple list="horarios" id="horario" name="horario" required>
            <label id="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" min="0" required>

            <datalist id="horarios">
                <option value="8-10hrs"></option>
                <option value="11-13hrs"></option>
                <option value="14-16hrs"></option>
                <option value="17-19hrs"></option>
                <option value="21-23hrs"></option>
            </datalist>

            <div class="botones">
                <input type="submit" value="Consultar" class="enviar">
            </div>
        </form>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>