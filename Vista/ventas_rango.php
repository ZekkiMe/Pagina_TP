<?php
    require_once "../Controlador/conexion.php";
    
    $platoSeleccionado = '';
    $fechaInicio = '';
    $fechaFin = '';
    $datosGrafico = [];
    $nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    $queryPlatos = "SELECT ID, nombre FROM platos ORDER BY nombre ASC";
    $resultadoPlatos = $base->prepare($queryPlatos);
    $resultadoPlatos->execute();
    $listaPlatos = $resultadoPlatos->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['plato']) && isset($_GET['inicio']) && isset($_GET['fin'])) {
        $platoSeleccionado = $_GET['plato'];
        $fechaInicio = $_GET['inicio'];
        $fechaFin = $_GET['fin'];

        $queryVentasPlato = "
            SELECT
                DATE(r.dia) AS fecha_venta,
                SUM(f.cantidad) AS total_vendido
            FROM
                detalle_orden f
            JOIN
                reservas r ON f.id_reserva = r.ID
            WHERE
                f.id_plato = :plato
                AND r.dia >= :inicio
                AND r.dia <= :fin
            GROUP BY
                DATE(r.dia)
            ORDER BY
                DATE(r.dia) ASC;
        ";

        $resultadoVentas = $base->prepare($queryVentasPlato);
        $resultadoVentas->bindParam(':plato', $platoSeleccionado, PDO::PARAM_INT);
        $resultadoVentas->bindParam(':inicio', $fechaInicio);
        $resultadoVentas->bindParam(':fin', $fechaFin);
        $resultadoVentas->execute();

        while ($fila = $resultadoVentas->fetch(PDO::FETCH_ASSOC)) {
            $datosGrafico[$fila['fecha_venta']] = intval($fila['total_vendido']);
        }
    }

?>

<div>
    <h2>Ventas por Plato segun rango de Fechas</h2>
    <form id="formVentasPlato">
        <label for="plato">Seleccionar Plato:</label>
        <select id="plato" name="plato">
            <option value="">-- Seleccionar --</option>
            <?php foreach ($listaPlatos as $plato): ?>
                <option value="<?php echo $plato['ID']; ?>" <?php if ($platoSeleccionado == $plato['ID']) echo 'selected'; ?>><?php echo $plato['nombre']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="inicio">Fecha de Inicio:</label>
        <input type="date" id="inicio" name="inicio" value="<?php echo $fechaInicio; ?>">

        <label for="fin">Fecha de Fin:</label>
        <input type="date" id="fin" name="fin" value="<?php echo date("Y-m-d"); ?>"><br>

        <button type="button" id="cargarGraficoVentas">Mostrar Gráfico</button>
        <button type="button" id="limpiarGraficoVentas">Limpiar Gráfico</button>
    </form>
</div>

<div id="graficaVentasPlatoContenedor">
    <?php if (!empty($datosGrafico)): ?>
        <div id="datosGraficoPHP" style="display:none;"><?php echo json_encode($datosGrafico); ?></div>
    <?php else: ?>
        <?php if (isset($_GET['plato']) && isset($_GET['inicio']) && isset($_GET['fin'])): ?>
            <p>No hay ventas para el plato y el rango de fechas seleccionados.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function() {
        $('#cargarGraficoVentas').on('click', function() {
            const platoId = $('#plato').val();
            const fechaInicio = $('#inicio').val();
            const fechaFin = $('#fin').val();

            const url = 'ventas_rango.php?plato=' + platoId + '&inicio=' + fechaInicio + '&fin=' + fechaFin;
            $('#graficaVentasPlatoContenedor').load(url + ' #graficaVentasPlatoContenedor > *', function(responseText, textStatus, jqXHR) {
                if (textStatus === 'success') {
                    const datosGraficoElement = $(responseText).find('#datosGraficoPHP').text();
                    let datos = {};
                    if (datosGraficoElement) {
                        datos = JSON.parse(datosGraficoElement);
                    }
                    console.log('Datos del gráfico (después de la carga):', datos);
                    renderizarGraficoVentas(datos);
                } else {
                    console.error('Error al cargar los datos:', textStatus, jqXHR);
                }
            });
        });

        $('#limpiarGraficoVentas').on('click', function() {
            $('#graficaVentasPlatoContenedor').empty();
        });

        function renderizarGraficoVentas(datos) {
            if (Object.keys(datos).length > 0) {
                const fechas = Object.keys(datos).sort();
                const ventas = fechas.map(fecha => datos[fecha]);

                const trace = {
                    x: fechas,
                    y: ventas,
                    type: 'scatter',
                    mode: 'lines+markers',
                    name: 'Ventas'
                };

                const layout = {
                    title: `Ventas Diarias del Plato "${$('#plato option:selected').text()}" ($('#inicio').val()} - $('#fin').val()})`,
                    xaxis: {
                        title: 'Fecha',
                        tickformat: '%d/%m'
                    },
                    yaxis: {
                        title: 'Cantidad Vendida'
                    }
                };

                Plotly.newPlot('graficaVentasPlatoContenedor', [trace], layout);
            } else {
                $('#graficaVentasPlatoContenedor').html('<p>No hay ventas para el plato y el rango de fechas seleccionados.</p>');
            }
        }

    });
</script>