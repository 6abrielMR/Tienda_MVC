<?php if (($_SESSION[session_pedido]) && $_SESSION[session_pedido] == "complete"): ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>Tu pedido ha sido guardado con éxito, una vez que realices la transferencia bancaria 7897841515135534AFF con el coste del pedido, será procesado y enviado.</p>
    <br>
    <br>
    <?php if (isset($pedido)): ?>
        <h3>Datos del pedido</h3><br>
            <strong>Número de pedido:</strong> <?=$pedido->id?><br><br>
            <strong>Total a pagar:</strong> $<?=$pedido->coste?> euros<br><br>
            <strong>Productos:</strong><br><br>
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
                <?php while ($producto = $productos->fetch_object()): ?>
                    <tr>
                        <td class="box">
                            <?php if($producto->imagen != null): ?>
                                <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito">
                            <?php else: ?>
                                <img src="<?=base_url?>assets/img/camiseta.png" class="img_carrito">
                            <?php endif; ?>
                        </td>
                        <td class="box"><a href="<?=base_url?>productos/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
                        <td class="box"><?=$producto->precio?></td>
                        <td class="box"><?=$producto->unidades?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
    <?php endif; ?>
<?php elseif (isset($_SESSION[session_pedido]) && $_SESSION[session_pedido] == 'failed'): ?>
    <h1>Tu pedido NO ha podido procesarce</h1>
    <strong class="alert_error">Hubo un error al procesar tu pedido, intentalo más tarde.</strong>
<?php elseif (isset($_SESSION[session_pedido]) && $_SESSION[session_pedido] == 'failed_data'): ?>
    <h1>Tu pedido NO ha podido procesarce</h1>
    <strong class="alert_error">Hubo un error al procesar tu pedido, digita todos los campos.</strong>
<?php elseif (isset($_SESSION[session_pedido]) && $_SESSION[session_pedido] == 'failed_identity'): ?>
    <h1>Tu pedido NO ha podido procesarce</h1>
    <strong class="alert_error">Hubo un error al procesar tu pedido, debes estar logueado para realizar un pedido.</strong>
<?php endif; ?>