<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="CSS/editar_reserva.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <form action="../Modelo/editar_reserva.php" method="post" id="form">
            <div class="contenedor">
                <label id="dia">Día</label>
                <input type="date" id="dia" name="dia" value="<?php echo $_POST["dia"]; ?>" required>
                <input type="number" id="dia" name="ID" value="<?php echo $_POST["ID"]; ?>" required style="display: none;">

                <label id="horario">Horario</label>
                <input type="text" multiple list="horarios" id="horario" name="horario" value="<?php echo $_POST["horario"]; ?>" required>

                <label id="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" min="0"
                    value="<?php echo $_POST["cantidad"]; ?>" required>
            </div>

            <div class="contenedor">
                <label id="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $_POST["nombre"]; ?>" required>

                <label id="mail">Mail</label>
                <input type="email" id="mail" name="mail" value="<?php echo $_POST["mail"]; ?>" required>

                <label id="observaciones">Observaciones</label>
                <input type="text" id="observaciones" name="observaciones" value="<?php echo $_POST["observaciones"]; ?>">

            </div>
            <div class="botones">
                <button class="cancelar"><a href="reservas.php" class="a_cancelar">Cancelar</a>
                </button>
                <input type="submit" value="Enviar" class="enviar">
        </form>
        <div>
            <form action="../Modelo/bajar_reserva.php" method="post">
                <input type="number" id="dia" name="ID" value="<?php echo $_POST["ID"]; ?>" required style="display: none;">

                <input type="submit" class="enviar" value="Dar Baja">
            </form>
        </div>
        </div>


        <datalist id="horarios">
            <option value="8-10hrs"></option>
            <option value="11-13hrs"></option>
            <option value="14-16hrs"></option>
            <option value="17-19hrs"></option>
            <option value="21-23hrs"></option>
        </datalist>

    </main>
    <?php include("footer.php"); ?>
</body>

</html>