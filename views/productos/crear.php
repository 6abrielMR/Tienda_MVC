<?php if ($_SESSION[session_editar] && isset($currentProducto) && is_object($currentProducto)): ?>
    <h1>Editar producto <?=$currentProducto->nombre?></h1>
    <?php $url_action = base_url."productos/save&id=".$currentProducto->id; ?>
<?php else: ?>
    <h1>Crear nuevos productos</h1>
    <?php $url_action = base_url."productos/save"; ?>
<?php endif; ?>
<?php if (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'failed'): ?>
    <strong class="alert_error">No se pudo guardar el producto en la base de datos</strong>
<?php elseif (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'failed_data'): ?>
    <strong class="alert_error">No se pudo guardar el producto, digita todos los campos</strong>
<?php elseif (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'failed_image'): ?>
    <strong class="alert_error">No se pudo guardar el producto, hubo un error al guardar la imagen</strong>
<?php elseif (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'failed_format'): ?>
    <strong class="alert_error">No se pudo guardar el producto, solo puedes subir imagenes .jpg, .jpeg, .png ó .gif</strong>
<?php elseif (isset($_SESSION[session_producto]) && $_SESSION[session_producto] == 'failed_null_image'): ?>
    <strong class="alert_error">No se pudo guardar el producto, debes seleccionar una imagen</strong>
<?php endif; ?>
<?php Helpers::deleteCurrentSession(session_producto); ?>
<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data" class="form_container">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=isset($currentProducto) && is_object($currentProducto) ? $currentProducto->nombre : '';?>" required>
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion"cols="135" rows="6" required><?=isset($currentProducto) && is_object($currentProducto) ? $currentProducto->descripcion : '';?></textarea>
    <label for="precio">Precio</label>
    <input type="number" name="precio" value="<?=isset($currentProducto) && is_object($currentProducto) ? (int)$currentProducto->precio : '';?>" required>
    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?=isset($currentProducto) && is_object($currentProducto) ? (int)$currentProducto->stock : '';?>" required>
    <label for="categoria">Categoria</label>
    <select name="categoria" required>
        <?php $categorias = Helpers::showCategorias(); ?>
        <option value="">Selecciona...</option>
        <?php while($currentCategoria = $categorias->fetch_object()): ?>
            <option value="<?=$currentCategoria->id?>" <?=isset($currentProducto) && is_object($currentProducto) && $currentCategoria->id == $currentProducto->categoria_id ? 'selected' : '' ?>><?=$currentCategoria->nombre?></option>
        <?php endwhile; ?>
    </select>
    <label for="imagen">Imagen</label>
    <?php if(isset($currentProducto) && is_object($currentProducto) && !empty($currentProducto->imagen)): ?>
        <img src="<?=base_url?>uploads/images/<?=$currentProducto->imagen?>" class="thumb" alt="Imagen del producto">
        <br>
    <?php endif; ?>
    <input type="file" name="imagen" <?=isset($currentProducto) && is_object($currentProducto) ? '' : 'required'?>>

    <input type="submit" value="Guardar">
</form>