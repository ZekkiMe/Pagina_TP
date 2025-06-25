<?php

use FontLib\Table\Type\head;

$pedido = $_POST;
$consumicion = array();

foreach ($pedido as $nombre_variable => $valor) {

    if (strpos($nombre_variable, 'cantidad') !== false && $valor > 0) {
        $consumicion[] = array(
            'ID' => str_replace('cantidad', '', $nombre_variable),
            'cantidad' => $valor
        );
    }
}

include("../Controlador/agregar_consumicion.php");

foreach ($consumicion as $item) {
    cargarConsumision($_POST['ID_reserva'], $item['ID'], $item['cantidad']);
}

header("Location: http://localhost/Pagina_TP/Vista/historicos.php?exito=1");
?>
