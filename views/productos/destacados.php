<h1>Algunos de nuestros productos</h1>
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