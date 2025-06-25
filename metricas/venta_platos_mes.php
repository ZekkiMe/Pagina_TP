<?php
    require_once "../Controlador/conexion.php";

    $cicloSeleccionado = date("Y");
    $mesSeleccionado = date("m");

    if (isset($_GET['ciclo']) && isset($_GET['mes'])) {
        $cicloSeleccionado = $_GET['ciclo'];
        $mesSeleccionado = $_GET['mes'];
    }

    $query ="
        SELECT
            p.nombre AS plato_nombre,
            SUM(f.cantidad) AS total_vendido_cantidad,
            SUM(f.cantidad * p.precio) AS total_vendido_dinero
        FROM
            detalle_orden f
        JOIN
            reservas r ON f.id_reserva = r.ID
        JOIN
            platos p ON f.id_plato = p.ID
        WHERE
            YEAR(r.dia) = :ciclo AND MONTH(r.dia) = :mes
        GROUP BY
            p.nombre
        ORDER BY
            p.nombre;
    ";

    $resultado = $base->prepare($query);
    $resultado->bindParam(':ciclo', $cicloSeleccionado, PDO::PARAM_INT);
    $resultado->bindParam(':mes', $mesSeleccionado, PDO::PARAM_INT);
    $resultado->execute();

    $nombres_platos = [];
    $cantidades_vendidas = [];
    $totales_dinero = [];
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $nombres_platos[] = $fila['plato_nombre'];
        $cantidades_vendidas[] = intval($fila['total_vendido_cantidad']);
        $totales_dinero[] = floatval($fila['total_vendido_dinero']);
    }

?>

<div>
    <h2>Ventas de los platos vendidos segun MES</h2>
    <label for="cicloBarras">Año:</label>
    <select id="cicloBarras">
        <option value="2023" <?php if ($cicloSeleccionado == 2023) echo 'selected'; ?>>2023</option>
        <option value="2024" <?php if ($cicloSeleccionado == 2024) echo 'selected'; ?>>2024</option>
        <option value="2025" <?php if ($cicloSeleccionado == 2025) echo 'selected'; ?>>2025</option>
    </select>

    <label for="mesBarras">Mes:</label>
    <select id="mesBarras">
        <?php
            $nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . $i . '" ' . ($mesSeleccionado == $i ? 'selected' : '') . '>' . $nombresMeses[$i - 1] . '</option>';
            }
        ?>
    </select>

    <button type="button" id="cargarGraficoBarras">Cargar</button>
    <button type="button" id="limpiarGraficoBarras">Limpiar</button>
</div>

<div id="graficaBarrasContenedor"></div>

<script>
    $(document).ready(function() {
        $('#cargarGraficoBarras').on('click', function() {
            const ciclo = $('#cicloBarras').val();
            const mes = $('#mesBarras').val();

            $('#ventaPlatosMes').load('venta_platos_mes.php?ciclo=' + ciclo + '&mes=' + mes);
        });

        

        const nombresPlatos = <?php echo json_encode($nombres_platos); ?>;
        const cantidadesVendidas = <?php echo json_encode($cantidades_vendidas); ?>;
        const totalesDinero = <?php echo json_encode($totales_dinero); ?>;en dinero
        const cicloInicial = <?php echo json_encode($cicloSeleccionado); ?>;
        const mesInicial = <?php echo json_encode($mesSeleccionado); ?>;
        const numPlatos = nombresPlatos.length;
        if (numPlatos > 0) {
            $('#graficaBarrasContenedor').css('height', `720px`);
        }
        $('#limpiarGraficoBarras').on('click', function() {
            $('#graficaBarrasContenedor').empty();
            $('#graficaBarrasContenedor').css('height', `10px`);
        });

        if (nombresPlatos.length > 0) {
            const trace = {
                x: cantidadesVendidas,
                y: nombresPlatos,
                type: 'bar',
                orientation: 'h',
                text: totalesDinero.map(dinero => `$${dinero.toFixed(2)}`),
                textposition: 'inside'
            };

            const layout = {
                title: `Total de ventas por plato en ${obtenerNombreMes(mesInicial)} (${cicloInicial})`,
                yaxis: {
                    title: 'Plato',
                    automargin: true,
                    tickmode: 'linear'
                },
                xaxis: {
                    title: 'Cantidad Vendida'
                },
                margin: {
                    l: 150,
                    r: 150,
                    t: 50,
                    b: 50
                }
            };

            Plotly.newPlot('graficaBarrasContenedor', [trace], layout);
        } else {
            $('#graficaBarrasContenedor').html('<p>No hay datos para el año y mes seleccionados.</p>');
        }

        function obtenerNombreMes(numeroMes) {
            const nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            return nombresMeses[parseInt(numeroMes) - 1];
        }
    });
</script>