<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Camisetas</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
</head>
<body>
    <div id="container">
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="<?=base_url?>">Tienda de Camisetas</a>
            </div>
        </header>
        <!-- MENU -->
        <?php $categorias = Helpers::showCategorias() ?>
        <nav id="menu">
            <ul>
                <li><a href="#">Inicio</a></li>
                <?php while($currentCategoria = $categorias->fetch_object()): ?>
                    <li><a href="#"><?=$currentCategoria->nombre?></a></li>
                <?php endwhile; ?>
            </ul>
        </nav>

        <div id="content">