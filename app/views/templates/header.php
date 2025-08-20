<header class="header">
    <div class="header__container">
        <div class="header__navegacion">
            <?php if (isAuth()) { ?>
                <a href="<?php echo isAdmin() ? '/admin/dashboard' : '/finalizar-registro'; ?>" class="header__enlace">Administrar</a>
                <form class="header__form" method="POST" action="/logout">
                    <input type="submit" value="Cerrar Sesión" class="header__submit--logout">
                </form>
            <?php } else { ?>
                <a href="/registrarse" class="header__enlace">Registrarse</a>
                <a href="/login" class="header__enlace">Iniciar sesión</a>
            <?php } ?>
        </div>
        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    &#60;DevWebCamp />
                </h1>
            </a>
            <p class="header__texto">Octubre 5-6 - 2025</p>
            <p class="header__texto header__texto--modalidad">En linea - Presencial</p>
            <a class="header__boton" href="/registrarse">Comprar Pase</a>
        </div>
    </div>
</header>
<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">&#60;DevWebCamp /></h2>
        </a>
        <nav class="navegacion">
            <a href="/devwebcamp" class="navegacion__enlace <?php echo pagina_actual('/devwebcamp') ? 'navegacion__enlace--actual' : ''; ?>">Evento</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : ''; ?>">Paquetes</a>
            <a href="/workshops-conferencias" class="navegacion__enlace <?php echo pagina_actual('/workshops-conferencias') ? 'navegacion__enlace--actual' : ''; ?>">Workshops / Conferencias</a>
            <a href="/registrarse" class="navegacion__enlace <?php echo pagina_actual('/registrarse') ? 'navegacion__enlace--actual' : ''; ?>">Comprar Pase</a>
        </nav>
    </div>
</div>