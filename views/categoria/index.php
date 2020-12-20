<h1>Gestionar categorias</h1>

<a href="<?=base_url?>categoria/crear" class="button btn-small">Crear categoría</a>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>
    <?php while($currentCategoria = $categorias->fetch_object()): ?>
        <tr>
            <td><?=$currentCategoria->id?></td>
            <td><?=$currentCategoria->nombre?></td>
        </tr>
    <?php endwhile; ?>
</table>