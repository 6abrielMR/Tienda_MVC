<!-- BARRA LATERAL -->
<aside id="lateral">
    <div id="login" class="block_aside">
        <h3>Mi Carrito</h3>
        <ul>
            <?php $stats = Helpers::statsCarrito(); ?>
            <li><a href="<?=base_url?>carrito/index">Productos (<?= $stats["count"]?>)</a></li>
            <li><a href="<?=base_url?>carrito/index">Total: $<?= $stats["total"] ?> euros</a></li>
            <li><a href="<?=base_url?>carrito/index">Ver el carrito</a></li>
        </ul>
    </div>
    <div id="login" class="block_aside">
        <?php if(!isset($_SESSION[identity_login])): ?>
        <h3>Entrar a la web</h3>
            <?php if(isset($_SESSION[error_login])): ?>
                <strong class="alert_error">Datos incorrectos</strong>
            <?php endif; ?>
        <form action="<?=base_url?>usuario/login" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Password</label>
            <input type="password" name="password">

            <input type="submit" value="Enviar">
        </form>
        <?php Helpers::deleteCurrentSession(error_login) ?>
        <?php else: ?>
        <h3><?=$_SESSION[identity_login]->nombre?> <?=$_SESSION[identity_login]->apellidos?></h3>
        <?php endif; ?>

        <ul>
            <?php if(isset($_SESSION[admin_login])): ?>
                <li><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
                <li><a href="<?=base_url?>productos/gestion">Gestionar productos</a></li>
                <li><a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a></li>
            <?php endif; ?>
            <?php if(isset($_SESSION[identity_login])): ?>
                <li><a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
                <li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="<?=base_url?>usuario/registro">Registrate aquí</a></li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<!-- CONTENIDO CENTRAL -->
<div id="central">