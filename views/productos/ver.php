<?php if (isset($currentProducto)): ?>
    <h1><?=$currentProducto->nombre?></h1>
    <div id="detail_product">
        <?php if($currentProducto->imagen != null): ?>
            <img src="<?=base_url?>uploads/images/<?=$currentProducto->imagen?>">
        <?php else: ?>
            <img src="<?=base_url?>assets/img/camiseta.png">
        <?php endif; ?>
        <div id="content_product">
            <h3><?=$currentProducto->descripcion?></h3>
            <p id="stock">Stock de <?=$currentProducto->stock?></p>
            <p>$<?=$currentProducto->precio?> euros</p>
            <a href="<?=base_url?>carrito/add&id=<?=$currentProducto->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>