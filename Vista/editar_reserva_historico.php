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
        <form action="../Modelo/editar_reserva_historico.php" method="post" id="form">
            <div class="contenedor">
                <label id="dia">Día</label>
                <input type="date" id="dia" name="dia" value="<?php echo $_POST["dia"]; ?>" readonly>
                <input type="number" id="dia" name="ID" value="<?php echo $_POST["ID"]; ?>" required style="display: none;">

                <label id="horario">Horario</label>
                <input type="text" multiple list="horarios" id="horario" name="horario" value="<?php echo $_POST["horario"]; ?>" readonly>

                <label id="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" min="0"
                    value="<?php echo $_POST["cantidad"]; ?>" readonly>
            </div>

            <div class="contenedor">
                <label id="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $_POST["nombre"]; ?>" readonly>

                <label id="mail">Mail</label>
                <input type="email" id="mail" name="mail" value="<?php echo $_POST["mail"]; ?>" readonly>

                <label id="observaciones">Estado</label>
                <span>
                    <input type="radio" id="asistido" name="estado" class="radio_in" value="1" <?php if ($_POST['estado'] === 'R') echo 'checked'; ?> required>
                    <label class="radio" for="asistido">Asistió</label>
                </span>
                <span>
                    <input type="radio" id="ausente" name="estado" class="radio_in" value="0" <?php if ($_POST['estado'] === 'C') echo 'checked'; ?> required>
                    <label class="radio" for="ausente">No se presentó</label>
                </span>

            </div>
            <div class="botones">
                <button class="cancelar"><a href="historicos.php" class="a_cancelar">Cancelar</a>
                </button>
                <input type="submit" value="Enviar" class="enviar">
        </form>
        </div>

    </main>
    <?php include("footer.php"); ?>
</body>

</html>