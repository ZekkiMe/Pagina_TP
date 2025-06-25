<?php
	require_once "../Controlador/conexion.php";

    $cicloSeleccionadoLineal = date("Y");

    if (isset($_GET['ciclo'])) {
        $cicloSeleccionadoLineal = $_GET['ciclo'];
    }

    $queryLineal ="
        SELECT
            p.nombre AS plato_nombre,
            DATE_FORMAT(r.dia, '%m') AS mes,
            SUM(f.cantidad) AS total_vendido
        FROM
            detalle_orden f
        JOIN
            reservas r ON f.id_reserva = r.ID
        JOIN
            platos p ON f.id_plato = p.ID
        WHERE
            YEAR(r.dia) = :ciclo
        GROUP BY
            p.nombre,
            mes
        ORDER BY
            p.nombre,
            mes;
    ";

    $resultadoLineal = $base->prepare($queryLineal);
    $resultadoLineal->bindParam(':ciclo', $cicloSeleccionadoLineal, PDO::PARAM_INT);
    $resultadoLineal->execute();

    $ventasPorPlatoMesLineal = [];
    while ($fila = $resultadoLineal->fetch(PDO::FETCH_ASSOC)) {
        $plato = $fila['plato_nombre'];
        $mes = intval($fila['mes']);
        $cantidad = intval($fila['total_vendido']);

        if (!isset($ventasPorPlatoMesLineal[$plato])) {
            $ventasPorPlatoMesLineal[$plato] = array_fill(1, 12, 0);
        }
        $ventasPorPlatoMesLineal[$plato][$mes] = $cantidad;
    }

    $queryTop5Lineal = "
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
            YEAR(r.dia) = :ciclo
        GROUP BY
            p.nombre
        ORDER BY
            total_vendido_anual DESC
        LIMIT 5;
    ";
    $resultadoTop5Lineal = $base->prepare($queryTop5Lineal);
    $resultadoTop5Lineal->bindParam(':ciclo', $cicloSeleccionadoLineal, PDO::PARAM_INT);
    $resultadoTop5Lineal->execute();
    $top5PlatosLineal = $resultadoTop5Lineal->fetchAll(PDO::FETCH_COLUMN);

?>

<div>
    <h2>Top 5 platos mas vendido por Año</h2>
    <label for="cicloLineal">Año:</label>
    <select id="cicloLineal">
        <option value="2023" <?php if ($cicloSeleccionadoLineal == 2023) echo 'selected'; ?>>2023</option>
        <option value="2024" <?php if ($cicloSeleccionadoLineal == 2024) echo 'selected'; ?>>2024</option>
        <option value="2025" <?php if ($cicloSeleccionadoLineal == 2025) echo 'selected'; ?>>2025</option>
    </select>
</div>

<div id="graficaLinealContenedor"></div>

<script>
    $(document).ready(function() {
        $('#cicloLineal').on('change', function() {
            const ciclo = $(this).val();
            $('#topVentasAnual').load('top_ventas.php?ciclo=' + ciclo);
        });

        const ventasPorPlatoMes = <?php echo json_encode($ventasPorPlatoMesLineal); ?>;
        const cicloInicial = <?php echo json_encode($cicloSeleccionadoLineal); ?>;
        const top5Platos = <?php echo json_encode($top5PlatosLineal); ?>;
        const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        const dataLineal = [];

        for (const plato in ventasPorPlatoMes) {
            if (top5Platos.includes(plato)) {
                const trace = {
                    x: meses,
                    y: Object.values(ventasPorPlatoMes[plato]),
                    name: plato,
                    type: 'scatter'
                };
                dataLineal.push(trace);
            }
        }

        const layoutLineal = {
            title: `Ventas de los 5 platos más populares (${cicloInicial})`,
            xaxis: {
                title: 'Meses del año',
                showgrid: false,
                zeroline: false
            },
            yaxis: {
                title: 'Cantidad Vendida',
                showline: false
            }
        };

        Plotly.newPlot('graficaLinealContenedor', dataLineal, layoutLineal);
    });
</script>