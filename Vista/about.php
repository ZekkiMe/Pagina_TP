<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/about.css">
        <title>Sobre Nosotros</title>
</head>
    <body>
        <?php
            include("header.php");
        ?>
        <main>
            <div class="alto-centro">
                <div class="espacio"></div>
                <div class="historia">
                    <h1>Nuestra historia</h1>
                    <div class="contenido_historia">
                        <img class="fachada" src="Imagenes/fachada.jpg" alt="Fachada">
                        <p>Nuestra búsqueda incansable por la perfección nos llevó a recorrer Italia en busca de los mejores ingredientes y las técnicas más auténticas.
                            <br>Después de años de experimentación y aprendizaje, abrimos las puertas de <b>Pasta a Pasta</b> con la misión de ofrecer una experiencia culinaria inolvidable.
                            <br>Cada plato es el resultado de nuestra pasión por la pasta y nuestro compromiso con la calidad.</p>
                    </div>
                </div>
                <div class="reseñas">
                    <div class="reseña1">
                        <img src="Imagenes/coctail.jpg" alt="cocteles" class="img_reseña1">
                        <p class="text_reseña1">Los cocteles son variados y ricos.<br>Los recomiendo</p>
                    </div>
                    <div class="reseña2">
                        <img src="Imagenes/amigos.jpg" alt="cocteles" class="img_reseña2">
                        <p class="text_reseña1">Un hambiente calido perfecto para reuniones</p>
                    </div>
                    <div class="reseña3">
                        <img src="Imagenes/mesada.jpg" alt="cocteles" class="img_reseña3">
                        <p class="text_reseña1">Me gusta que la cocina esté a la vista</p>
                    </div>
                    <div class="reseña4">
                        <img src="Imagenes/lasagna.jpg" alt="cocteles" class="img_reseña4">
                        <p class="text_reseña1">La lasagna estaba riquísima sin dudas mi favorita</p>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include("footer.php");
        ?>
    </body>
</html>