<?php if (isset($gestion)): ?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>

<table>
    <tr>
        <th>N° Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php while ($pedido = $pedidos->fetch_object()): ?>
        <tr>
            <td class="box"><a href="<?=base_url?>pedido/detalle&id=<?=$pedido->id?>"><?=$pedido->id?></a></td>
            <td class="box">$<?=$pedido->coste?> euros</td>
            <td class="box"><?=$pedido->fecha?></td>
            <td class="box"><?=Helpers::showState($pedido->estado)?></td>
        </tr>
    <?php endwhile; ?>
</table>