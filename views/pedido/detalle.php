<h1>Detalle del pedido</h1>

<?php if (isset($pedido)): ?>
    <?php if (isset($_SESSION[admin_login])): ?>
        <h3>Cambiar estado del pedido</h3><br>
        <form action="<?=base_url?>pedido/estado" method="POST">
            <input type="hidden" name="pedido_id" value="<?=$pedido->id?>">
            <select name="estado">
                <option value="confirm" <?= $pedido->estado == "confirm" ? "selected" : "" ?>>Pendiente</option>
                <option value="preparation" <?= $pedido->estado == "preparation" ? "selected" : "" ?>>En preparación</option>
                <option value="ready" <?= $pedido->estado == "ready" ? "selected" : "" ?>>Preparado para enviar</option>
                <option value="sended" <?= $pedido->estado == "sended" ? "selected" : "" ?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
        <br><br><hr><hr><br><br>
    <?php endif; ?>

    <h3>Dirección de envio</h3><hr>
    <strong>Provincia:</strong> <?=$pedido->provincia?><br>
    <strong>Localidad:</strong> <?=$pedido->localidad?><br>
    <strong>Dirección:</strong> <?=$pedido->direccion?> euros<br><br><br>
    <h3>Datos del pedido</h3><hr>
    <strong>Estado: </strong><?=Helpers::showState($pedido->estado)?><br>
    <strong>Número de pedido:</strong> <?=$pedido->id?><br>
    <strong>Total a pagar:</strong> $<?=$pedido->coste?> euros<br>
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