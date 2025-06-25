<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/header.css">
</head>

    <nav>
        <img src="Imagenes/logo.png" alt="Logo">
        <ul class="lista_header">
            <li class="item"><a href="home.php">Inicio</a></li>
            <li class="item"><a href="carta.php">Carta</a></li>
            <li class="item"><a href="about.php">Sobre Nosotros</a></li>
            <li class="item"><a href="form_dispo.php">Reservar</a></li>
            <li class="ingresar">
                <?php
                session_start();
                if (!isset($_SESSION["nombre"])) {
                    echo "<a href='form_ingreso.php'>Ingresar</a>";
                } else {
                    echo "<a href='usuario.php'>Perfil</a>";
                }
                ?>
            </li>
        </ul>
    </nav>
<script>
window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    if (params.get('exito') === '1') {
        alert('¡La acción se realizó correctamente!');
    }
}
</script>
</html>