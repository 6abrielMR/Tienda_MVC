<h1>Crear nueva categoria</h1>
<?php if (isset($_SESSION[session_categoria]) && $_SESSION[session_categoria] == 'complete'): ?>
    <strong class="alert_succes">Categoria creada correctamente</strong>
<?php elseif (isset($_SESSION[session_categoria]) && $_SESSION[session_categoria] == 'failed'): ?>
    <strong class="alert_error">Categoria fallida</strong>
<?php elseif (isset($_SESSION[session_categoria]) && $_SESSION[session_categoria] == 'failed_data'): ?>
    <strong class="alert_error">Categoria fallida, digita bien los campos</strong>
<?php endif; ?>
<?php Helpers::deleteCurrentSession(session_categoria); ?>
<form action="<?=base_url?>categoria/save" method="POST">
    <label for="nombre">Nombre de la categoria</label>
    <input type="text" name="nombre">
    <input type="submit" value="Guardar">
</form>