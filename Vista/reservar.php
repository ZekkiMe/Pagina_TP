<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar</title>
    <link rel="stylesheet" href="CSS/reservar.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <form action="../Modelo/terminar_reserva.php" method="post">
            <div class="contenedor">
                <label id="dia">Día</label>
                <input type="date" id="dia" name="dia" value="<?php echo $_POST["dia"]; ?>" readonly>

                <label id="horario">Horario</label>
                <input type="text" id="horario" name="horario"
                    value="<?php echo $_POST["horario"];?>" readonly>

                <label id="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" min="0"
                    value="<?php echo $_POST["cantidad"];?>" readonly>
            </div>

            <div class="contenedor">
                <label id="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label id="mail">Mail</label>
                <input type="email" id="mail" name="mail" required>

                <label id="observaciones">Observaciones</label>
                <input type="text" id="observaciones" name="observaciones" placeholder="Si hay niños, celiacos, etc.">

                <div class="botones">
                    <button class="cancelar"><a href="form_dispo.php" class="a_cancelar">Cancelar</a>
                    </button>
                    <input type="submit" value="Reservar" class="enviar">
                </div>
            </div>
        </form>

    </main>
    <?php include("footer.php"); ?>
</body>

</html>