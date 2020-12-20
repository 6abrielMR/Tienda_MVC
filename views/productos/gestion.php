<h1>Gestión de productos</h1>
<a href="<?=base_url?>productos/crear" class="button btn-small">Crear producto</a>
<?php if (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'complete'): ?>
    <strong class="alert_succes">Proceso realizado correctamente</strong>
<?php elseif (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'failed'): ?>
    <strong class="alert_error">No se pudo eliminar el producto</strong>
<?php elseif (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'failed_id'): ?>
    <strong class="alert_error">No se pudo eliminar el producto, no se recibió el id</strong>
<?php endif; ?>
<?php Helpers::deleteCurrentSession(session_producto); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while($currentProducto = $productos->fetch_object()): ?>
        <tr>
            <td class="box"><?=$currentProducto->id?></td>
            <td class="box"><?=$currentProducto->nombre?></td>
            <td class="box"><?=$currentProducto->precio?></td>
            <td class="box"><?=$currentProducto->stock?></td>
            <td class="box">
                <a href="<?=base_url?>productos/editar&id=<?=$currentProducto->id?>" class="button btn-edit">Editar</a>
                <a href="<?=base_url?>productos/eliminar&id=<?=$currentProducto->id?>" class="button btn-del">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>