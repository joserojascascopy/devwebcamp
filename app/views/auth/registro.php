<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en WebDevCamp</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/registrarse">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre:</label>
            <input class="formulario__input" type="text" id="nombre" name="nombre" placeholder="Tú nombre" value="<?php echo $usuario->nombre; ?>">
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido:</label>
            <input class="formulario__input" type="text" id="apellido" name="apellido" placeholder="Tú apellido" value="<?php echo $usuario->apellido; ?>">
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email:</label>
            <input class="formulario__input" type="email" id="email" name="email" placeholder="Tú email" value="<?php echo $usuario->email; ?>">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Tu contraseña:</label>
            <input class="formulario__input" type="password" id="password" name="password" placeholder="Tú contraseña">
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir contraseña:</label>
            <input class="formulario__input" type="password" id="password2" name="password2" placeholder="Repetir contraseña">
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>