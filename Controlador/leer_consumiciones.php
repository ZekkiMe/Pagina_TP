<?php


function LeerConsumiciones($id_reserva)
{
    try {
        include("conexion.php");
        $query = "SELECT * FROM detalle_orden 
            WHERE id_reserva = :id";

        $resultado = $base->prepare($query);

        $resultado->execute(array(':id' => $id_reserva));

        if ($resultado = $resultado->fetchAll(PDO::FETCH_ASSOC)) {
?>
            <table class='tabla_platos'>
                    <?php
                    foreach ($resultado as $tipo) {
                    ?>
                        <input style="display:none;" type="number" value="<?php echo $tipo['id_plato']; ?>" name="id_plato<?php echo $tipo['id_plato']; ?>" />
                        <input style="display:none;" type="number" value="<?php echo $tipo['cantidad']; ?>" name="cantidad<?php echo $tipo['id_plato']; ?>" />
                    <?php
                        $query = "SELECT * FROM platos 
                    WHERE ID = :id";

                        $platos = $base->prepare($query);
                        $id_r = $tipo["id_plato"];

                        $platos->execute(array(':id' => $id_r));

                        $platos = $platos->fetchAll(PDO::FETCH_ASSOC);

                        echo '
                    <tr class="fila_plato">
                        <td class="data_plato">Nombre: ' . $platos[0]["nombre"] . '</td>
                        <td class="precio">Cantidad: ' . $tipo["cantidad"] . '</td>
                    </tr>';
                    }
                    ?>
            </table>
            <div class="botones">
            <button class="volver"><a class="a_cancelar" href="historicos.php">Volver</a></button>
            <input class="volver" type="submit" value="Editar" /></div>
            </form>
<?php
        } else {
			?>
            <div class='no_hay'>
				<h1 style="color:black;">No hay consumiciones</h1>
            </div>
            </table>
            <div class="botones">
            <input class="volver" type="submit" value="Editar" />
            </form>
            <button class="volver"><a class="a_cancelar" href="historicos.php">Volver</a></button></div>
<?php
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
