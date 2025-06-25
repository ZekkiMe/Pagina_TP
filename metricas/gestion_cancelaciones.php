<?php
require_once '../correo/funciones_db.php';
require_once '../correo/enviar.php';

$mensaje_notificacion = "";
if (isset($_POST['enviar_notificacion'])) {
    if (isset($_POST['id_usuario_notificar'])) { 
        $id_usuario_notificar = $_POST['id_usuario_notificar'];
        $cliente_a_notificar = obtenerDatosPorId($id_usuario_notificar); 

        if ($cliente_a_notificar) {
            $nombre_cliente = $cliente_a_notificar['nombre'];
            $email_cliente = $cliente_a_notificar['email'];
            $num_cancelaciones = obtenerNumCancelaciones($id_usuario_notificar); // Pasa el ID correcto

            $resultado_envio = enviarNotificacionCancelaciones(
                $nombre_cliente,
                $email_cliente,
                $num_cancelaciones
            );
            
            if ($resultado_envio === true) {
                $mensaje_notificacion = "<p style='color: green;'>Notificación enviada a " . htmlspecialchars($nombre_cliente) . ".</p>";
                insertarDB($id_usuario_notificar, $email_cliente, 'notificacion');
            } else {
                $mensaje_notificacion = "<p style='color: red;'>Error al enviar notificación a " . htmlspecialchars($nombre_cliente) . ": " . htmlspecialchars($resultado_envio) . "</p>";
            }
        } else {
            $mensaje_notificacion = "<p style='color: red;'>Error: cliente no encontrado para ID " . htmlspecialchars($id_usuario_notificar) . ".</p>";
        }
    } else {
        $mensaje_notificacion = "<p style='color: red;'>Error: ID de usuario no especificado para la notificación.</p>";
    }
}

$clientes_cancelante = buscarClienteCancelador(3); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cancelaciones | Metricas</title>
    <link type="text/css" rel="stylesheet" href="./css/style-gc.css">
</head>
<?php include("../Vista/header.php");?>
<body>
    <a href="home_admin.php" class="volver-btn">← Volver a Métricas</a>
    <h1>Clientes con más de 3 Cancelaciones</h1>

    <?php echo $mensaje_notificacion;?>

    <?php 
    // CAMBIO CLAVE: Usar la variable $clientes_cancelante
    if (!empty($clientes_cancelante)): 
    ?>
        <table>
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Cancelaciones</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // CAMBIO CLAVE: Usar la variable $clientes_cancelante y la clave 'id_usuario'
                foreach ($clientes_cancelante as $cliente): 
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['id_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cantidad_cancelaciones']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id_usuario_notificar" value="<?php echo htmlspecialchars($cliente['id_usuario']); ?>">
                                <button type="submit" name="enviar_notificacion" class="btn-notificar">
                                    Enviar Notificación
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay clientes con más de 3 reservas canceladas en este momento.</p>
    <?php endif; ?>
<?php include("../Vista/footer.php");?>
</body>
</html>