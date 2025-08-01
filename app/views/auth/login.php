<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia sesión en DevWebCamp</p>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form class="formulario" method="POST" action="/login">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email:</label>
            <input class="formulario__input" type="email" id="email" name="email" placeholder="Ingrese su email">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Tu contraseña:</label>
            <input class="formulario__input" type="password" id="password" name="password" placeholder="Ingrese su contraseña">
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar Sesión">
    </form>

    <div class="acciones">
        <a href="/registrarse" class="acciones__enlace">¿Aún no tienes cuenta? Crea una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>