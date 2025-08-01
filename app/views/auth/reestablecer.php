<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu acceso a WebDevCamp</p>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php if (!$error) { ?>
        <form class="formulario" method="POST">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Nueva contraseña:</label>
                <input class="formulario__input" type="password" id="password" name="password" placeholder="Ingrese su nueva contraseña">
            </div>

            <input type="submit" class="formulario__submit" value="Reestablecer contraseña">
        </form>

        <div class="acciones--centrar">
            <a href="/login" class="acciones__enlace">Iniciar sesión</a>
        </div>
    <?php } ?>

</main>