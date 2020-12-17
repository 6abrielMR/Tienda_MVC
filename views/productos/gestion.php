<h1>Gestión de productos</h1>

<a href="<?=base_url?>productos/crear" class="button btn-small">Crear producto</a>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
    </tr>
    <?php while($currentProducto = $productos->fetch_object()): ?>
        <tr>
            <td class="box"><?=$currentProducto->id?></td>
            <td class="box"><?=$currentProducto->nombre?></td>
            <td class="box"><?=$currentProducto->precio?></td>
            <td class="box"><?=$currentProducto->stock?></td>
        </tr>
    <?php endwhile; ?>
</table>