<?php if (isset($carrito) && count($carrito) > 0): ?>
    <h1>Carrito de compras</h1>

    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php foreach($carrito as $index => $elemento): 
            $producto = $elemento['producto'];
        ?>
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
                <td class="box box-center">
                    <a href="<?=base_url?>carrito/up&index=<?=$index?>" class="button btn-controllers">+</a>
                    <?=$elemento['unidades']?>
                    <a href="<?=base_url?>carrito/down&index=<?=$index?>" class="button btn-controllers">-</a>
                </td>
                <td class="box"><a href="<?=base_url?>carrito/remove&index=<?=$index?>" class="button btn-del">Quitar producto</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div id="total_pedido">
        <?php $stats = Helpers::statsCarrito(); ?>
        <div id="del-carrito">
            <a href="<?=base_url?>carrito/delete_all" class="button btn-del">Vaciar carrito</a>
        </div>
        <div id="totalPedido">
            <h3>Precio total: $<?=$stats["total"]?> euros</h3>
            <a href="<?=base_url?>pedido/hacer" class="button btn-pedido">Hacer pedido</a>
        </div>
    </div>
<?php else: ?>
    <h1>No hay productos</h1>
    <p>Aún no has agregado ningún producto al carrito.</p>
<?php endif; ?>