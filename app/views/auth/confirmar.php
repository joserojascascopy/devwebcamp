<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Tu cuenta DevWebCamp</p>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php if (!$error) { ?>
        <div class="acciones--centrar">
            <a href="/login" class="acciones__enlace">Iniciar sesión</a>
        </div>
    <?php } ?>
</main>