<html lang="en">
    <head>
        <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Registro</title>
         <link rel="stylesheet" href="CSS/registro.css">
    </head>
    <body>
        <?php include("header.php");?>

        <main>

            <div class="separador">

            <form action="../Modelo/confirmar_registro.php" method="post">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Su nombre completo" required>

                <label for="email">e-Mail</label>
                <input type="email" id="email" name="email" placeholder="nombre@dominio.com" required>

                <label for="pass">Contraseña</label>
                <input type="password" id="pass" name="pass" placeholder="3-16 caracteres" required>

                <div class="botones">
                    <button class="cancelar"><a href="form_ingreso.php" class="a_cancelar">Cancelar</a></button>
                    <input type="submit" value="Enviar" class="enviar">
                </div>
            </form>

            <div class="separador">
        </main>

        <?php include("footer.php");?>
    </body>
</html>