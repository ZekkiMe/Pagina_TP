<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Carrera</title>
    <link rel="stylesheet" href="CSS/subir_fechas.css">
</head>

<body>
    <h1>Carrera:</h1>
    <form action="subir_fechas" method="post">
        <label for="titulo">Título de entrada blog:</label>
        <input type="text" id="titulo" name="titulo" required placeholder="Fechas Diciembre..."><br>

        <label for="desarrollo">Desarrollo de entrada:</label>
        <textarea id="desarrollo" name="desarrollo" required
            placeholder="Buenas tardes. Estas son los horarios..."></textarea><br>

        <label for="carrera">Carrera:</label>
        <input type="text" list="carreras" id="carrera" name="carrera" required>

        <datalist id="carreras">
            <option value="T.S. Análisis de sistemas (viejo)">Analisis de sistemas (viejo)</option>
            <option value="T.S. Análisis de sistemas (nuevo)">Analisis de sistemas (viejo)</option>
            <option value="T.S. Desarrollo de software">Desarrollo de Software</option>
        </datalist>
        <br>
        <div class="botones">

            <button type="button" class="cancelar">Cancelar</button>
            <button type="submit" class="enviar">Enviar</button>
        </div>
    </form>
</body>

</html>