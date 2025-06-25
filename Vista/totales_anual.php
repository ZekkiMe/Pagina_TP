<?php
	require_once "../Controlador/conexion.php";

    $anioSeleccionadoAnual = date("Y");

    if (isset($_GET['anio'])) {
        $anioSeleccionadoAnual = $_GET['anio'];
    }

    $queryTodosPlatos = "SELECT nombre FROM platos ORDER BY nombre ASC";
    $resultadoTodosPlatos = $base->prepare($queryTodosPlatos);
    $resultadoTodosPlatos->execute();
    $todosLosPlatos = $resultadoTodosPlatos->fetchAll(PDO::FETCH_COLUMN);

    $nombresPlatosAnual = [];
    $ventasTotalesAnual = [];

    foreach ($todosLosPlatos as $plato) {
        $nombresPlatosAnual[] = $plato;
        $ventasTotalesAnual[$plato] = 0;
    }

    $queryVentasAnual ="
        SELECT
            p.nombre AS plato_nombre,
            SUM(f.cantidad) AS total_vendido_anual
        FROM
            detalle_orden f
        JOIN
            reservas r ON f.id_reserva = r.ID
        JOIN
            platos p ON f.id_plato = p.ID
        WHERE
            YEAR(r.dia) = :anio
        GROUP BY
            p.nombre;
    ";

    $resultadoVentasAnual = $base->prepare($queryVentasAnual);
    $resultadoVentasAnual->bindParam(':anio', $anioSeleccionadoAnual, PDO::PARAM_INT);
    $resultadoVentasAnual->execute();

    while ($fila = $resultadoVentasAnual->fetch(PDO::FETCH_ASSOC)) {
        $plato = $fila['plato_nombre'];
        $totalVendido = intval($fila['total_vendido_anual']);
        if (isset($ventasTotalesAnual[$plato])) {
            $ventasTotalesAnual[$plato] = $totalVendido;
        }
    }

    $nombresPlatosFinal = array_keys($ventasTotalesAnual);
    $ventasTotalesFinal = array_values($ventasTotalesAnual);

?>

<div>
    <h2>Total de ventas de platos por año</h2>
    <label for="anioBarrasAnual">Año:</label>
    <select id="anioBarrasAnual">
        <option value="2023" <?php if ($anioSeleccionadoAnual == 2023) echo 'selected'; ?>>2023</option>
        <option value="2024" <?php if ($anioSeleccionadoAnual == 2024) echo 'selected'; ?>>2024</option>
        <option value="2025" <?php if ($anioSeleccionadoAnual == 2025) echo 'selected'; ?>>2025</option>
    </select>
</div>

<div id="graficaBarrasAnualContenedor"></div>

<script>
    $(document).ready(function() {
        $('#anioBarrasAnual').on('change', function() {
            const anio = $(this).val();
            $('#ventaTotalAnual').load('totales_anual.php?anio=' + anio);
        });

        const nombresPlatos = <?php echo json_encode($nombresPlatosFinal); ?>;
        const ventasTotales = <?php echo json_encode($ventasTotalesFinal); ?>;
        const anioInicial = <?php echo json_encode($anioSeleccionadoAnual); ?>;
        const numPlatos = nombresPlatos.length;
        const alturaContenedor = numPlatos * 30;

        $('#graficaBarrasAnualContenedor').css('height', `${alturaContenedor}px`);

        if (nombresPlatos.length > 0) {
            const traceAnual = {
                x: ventasTotales,
                y: nombresPlatos,
                type: 'bar',
                orientation: 'h'
            };

            const layoutAnual = {
                title: `Ventas Totales por Plato (${anioInicial})`,
                yaxis: {
                    title: 'Plato',
                    automargin: true
                },
                xaxis: {
                    title: 'Cantidad Vendida'
                }
            };

            Plotly.newPlot('graficaBarrasAnualContenedor', [traceAnual], layoutAnual);
        } else {
            $('#graficaBarrasAnualContenedor').html('<p>No hay datos para el año seleccionado.</p>');
        }
    });
</script>