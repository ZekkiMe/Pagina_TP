<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso</title>
    <link rel="stylesheet" href="CSS/ingreso.css">
</head>

<body>
    <?php include("header.php"); ?>

    <main>

        <div class="separador">

            <form action="../Modelo/confirmar_ingreso.php" method="post">

                <label for="email">e-Mail</label>
                <input type="email" id="email" name="email" placeholder="nombre@dominio.com" required>

                <label for="pass">Contraseña</label>
                <input type="password" id="pass" name="pass" placeholder="3-16 caracteres" required>

                <div class="botones">
                    <button class="cancelar"><a href="form_registro.php" class="a_cancelar">Registro</a></button>
                    <input type="submit" value="Ingresar" class="enviar">
                </div>
            </form>

            <div class="separador">

    </main>

    <?php include("footer.php"); ?>
</body>

</html>