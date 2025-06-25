<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metricas | graficos</title>
    <link type="text/css" rel="stylesheet" href="./css/style.css">
    <script type="text/javascript" src="./libs/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="./libs/plotly-3.0.1.min.js"></script>
</head>
<?php include("../Vista/header.php");?>
<body>

    <div class="btn-correo">
        

        <?php
        require_once '../correo/enviar.php';

        $mensaje_ejecucion_correo = "";

        if (isset($_POST['ejecutar_envio_cumpleanos'])) {
            $mensaje_ejecucion_correo = ejecutarCumples();
        }
        ?>


        <form method="POST" action="">
            <button type="submit" name="ejecutar_envio_cumpleanos" style="padding: 10px 15px; font-size: 16px; cursor: pointer;">
                Ejecutar Envío de Cumpleaños
            </button>
        </form>

        <?php if (!empty($mensaje_ejecucion_correo)): ?>
            <div style="margin-top: 20px; padding: 15px; border: 1px solid #ddd; background-color: #f9f9f9; border-radius: 5px;">
                <strong>Estado de la ejecución:</strong><br>
                <?php echo $mensaje_ejecucion_correo; ?>
            </div>
        <?php endif; ?>
    </div>
    <a class="btn-cancelacion" href="gestion_cancelaciones.php">Ir a Gestión de Cancelaciones</a>

    
    <h1 class="titulo-metricas">Metricas</h1><br>

    <div class="contenedor">
        <div class="contenedor-interior">
            <div class="panel" id="topVentasAnual"></div>
            <div class="panel" id="ventaTotalAnual"></div>
        </div>
        <div class="contenedor-interior">
            <div class="panel" id="ventaPlatosMes"></div>
            <div class="panel" id="cargaVentasRango"></div>     
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#topVentasAnual').load('top_ventas.php');
            $('#ventaTotalAnual').load('totales_anual.php');
            $('#ventaPlatosMes').load('venta_platos_mes.php');
            $('#cargaVentasRango').load('ventas_rango.php');
        });
    </script>
</body>
<?php include("../Vista/footer.php");?>
</html>
