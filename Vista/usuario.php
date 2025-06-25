<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="CSS/usuario.css">
    <script>
        function mostrarContrasena() {
            var passwordInput = document.getElementById('myPassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</head>
<header>
    <?php include("header.php"); ?>
</header>

<main>
    <section>
        <a class="sec_usuario" href="usuario.php">Informacion</a>
        <a class="sec_usuario" href="reservas.php">Reservas</a>
<?php if($_SESSION["tipo"] == "A"){
            echo "<a class='sec_usuario' href='home_admin.php'>Metricas</a>";
        } ?>
        <a class="sec_usuario" href="historicos.php">Historico</a>
        <a class="sec_usuario" href="../Modelo/cerrar_sesion.php">Cerrar sesion</a>
    </section>
    <div class="centro">
        <?php if($_SESSION["tipo"] == "S"){
            echo "<h1>Staff</h1>";
        }elseif($_SESSION["tipo"] == "A"){
            echo "<h1>Administrador</h1>";
        }else{
            echo "<h1>Cliente</h1>";
        }?>
        <div class="dato">
            <label>Mail:</label>
            <input type="email" value="<?php echo ($_SESSION["mail"]); ?>" readonly />
        </div>
        <div class="dato">
            <label>Contraseña:</label>
            <input type="password" id="myPassword" value="<?php echo ($_SESSION["password"]); ?>" readonly onclick="mostrarContrasena()" />
        </div>
        <div class="dato">
            <label>Fecha de Nacimiento:</label>
            <input type="date" value="<?php echo ($_SESSION["birth"]); ?>" name="birth" readonly/>
        </div>
        <button><a class="editar" href="editar_usuario.php">Editar</a></button>
    </div>
</main>

<footer>
    <?php include("footer.php"); ?>
</footer>

</html>
