<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="CSS/registro.css">
    
</head>

<body>
    <?php include("header.php"); ?>

    <main>

        <div class="separador">

            <form action="../Modelo/confirmar_edicion.php" method="post">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo ($_SESSION['nombre']); ?>" required>

                <label for="email">e-Mail</label>
                <input type="email" id="email" name="email" value="<?php echo ($_SESSION['mail']); ?>" required>

                <label for="pass">Contraseña</label>
                <input type="password" id="myPassword" value="<?php echo ($_SESSION["password"]); ?>" name="pass"/>
                
                <label for="date">Fecha de nacimiento</label>
                <input type="date" id="date" value="<?php echo ($_SESSION["birth"]); ?>" name="birth"/>

                <div class="botones">
                    <button class="cancelar"><a href="form_ingreso.php" class="a_cancelar">Cancelar</a></button>
                    <input type="submit" value="Enviar" class="enviar">
            </form>
            <form></form>
            <button class="cancelar"><a href="../Modelo/confirmar_baja.php" class="a_cancelar">Eliminar</a></button>
        </div>

        <div class="separador">
    </main>

    <?php include("footer.php"); ?>
</body>

</html>