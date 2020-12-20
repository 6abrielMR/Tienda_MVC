<?php if (isset($currentCategoria)): ?>
    <h1><?=$currentCategoria->nombre?></h1>
    <?php if ($productos->num_rows == 0): ?>
        <p>No hay productos para mostrar.</p>
    <?php else: ?>
        <?php while($currentProducto = $productos->fetch_object()): ?>
            <div class="product">
                <a href="<?=base_url?>productos/ver&id=<?=$currentProducto->id?>">
                    <?php if($currentProducto->imagen != null): ?>
                        <img src="<?=base_url?>uploads/images/<?=$currentProducto->imagen?>">
                    <?php else: ?>
                        <img src="<?=base_url?>assets/img/camiseta.png">
                    <?php endif; ?>
                    <h2><?=$currentProducto->nombre?></h2>
                </a>
                <p><?=$currentProducto->precio?> euros</p>
                <a href="<?=base_url?>carrito/add&id=<?=$currentProducto->id?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
<?php else: ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>