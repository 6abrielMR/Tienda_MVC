<h1>Registrarse</h1>

<?php if (isset($_SESSION[session_register]) && $_SESSION[session_register] == 'complete'): ?>
    <strong class="alert_succes">Registro completado correctamente</strong>
<?php elseif (isset($_SESSION[session_register]) && $_SESSION[session_register] == 'failed'): ?>
    <strong class="alert_error">Registro fallido</strong>
<?php elseif (isset($_SESSION[session_register]) && $_SESSION[session_register] == 'failed_data'): ?>
    <strong class="alert_error">Registro fallido, digita bien los campos</strong>
<?php endif; ?>
<?php Helpers::deleteCurrentSession(session_register); ?>

<form action="<?=base_url?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" >
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" >
    <label for="email">Email</label>
    <input type="email" name="email" >
    <label for="password">Contraseña</label>
    <input type="password" name="password" >

    <input type="submit" value="Registrarse">
</form>