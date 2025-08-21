<?php include_once __DIR__ . '/conferencias.php'; ?>

<section class="resumen">

    <div class="resumen__grid">

        <div class="resumen__bloque" data-aos="<?php aos_animacion(); ?>">
            <p class="resumen__texto--numero"><?php echo $total_ponentes; ?></p>
            <p class="resumen__texto">Speakers</p>
        </div>

        <div class="resumen__bloque" data-aos="<?php aos_animacion(); ?>">
            <p class="resumen__texto--numero"><?php echo $total_conferencias; ?></p>
            <p class="resumen__texto">Conferencias</p>
        </div>

        <div class="resumen__bloque" data-aos="<?php aos_animacion(); ?>">
            <p class="resumen__texto--numero"><?php echo $total_workshops; ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>

        <div class="resumen__bloque" data-aos="<?php aos_animacion(); ?>">
            <p class="resumen__texto--numero">500</p>
            <p class="resumen__texto">Asitentes</p>
        </div>

    </div>

</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__descripcion">Conoce a nuestros expertos de DevWebCamp</p>
    <div class="speakers__grid">

        <?php foreach ($ponentes as $ponente) : ?>

            <div class="speaker" data-aos="<?php aos_animacion(); ?>">
                <div class="speaker__imagen">
                    <picture>
                        <source srcset="http://localhost:3000/imagenes/speakers/<?php echo $ponente->imagen; ?>.webp" type="image/webp">
                        <img class="speaker__imagen" loading="lazy" src="http://localhost:3000/imagenes/speakers/<?php echo $ponente->imagen; ?>.jpg" alt="Imagen del ponente">
                    </picture>
                </div>
                <div class="speaker__info">
                    <h4 class="speaker__nombre"><?php echo $ponente->nombre . ' ' . $ponente->apellido; ?></h4>
                    <p class="speaker__ubicacion"><?php echo $ponente->ciudad . ', ' . $ponente->pais; ?></p>

                    <div class="speaker-sociales">
                        <?php $redes = json_decode($ponente->redes); ?>

                        <?php if (!empty($redes->facebook)) : ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                                <span class="speaker-sociales__ocultar">Facebook</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($redes->twitter)) : ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                                <span class="speaker-sociales__ocultar">Twitter</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($redes->linkedin)) : ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->linkedin; ?>">
                                <span class="speaker-sociales__ocultar">Linkedin</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($redes->instagram)) : ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                                <span class="speaker-sociales__ocultar">Instagram</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($redes->github)) : ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github; ?>">
                                <span class="speaker-sociales__ocultar">GitHub</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($redes->tiktok)) : ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->web; ?>">
                                <span class="speaker-sociales__ocultar">TikTok</span>
                            </a>
                        <?php endif; ?>

                    </div>

                    <ul class="speaker__listado-skills">
                        <?php $tags = explode(',', $ponente->tags);
                        foreach ($tags as $tag) : ?>
                            <li class="speaker__skill"><?php echo $tag; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</section>

<div id="mapa" class="mapa"></div>

<section class="boletos">
    <h2 class="boletos__heading">Boletos & Precios</h2>
    <p class="boletos__descripcion">Precios para DevWebCamp</p>

    <div class="boletos__grid">
        <div class="boleto boleto--presencial" data-aos="<?php aos_animacion(); ?>">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$99</p>
        </div>

        <div class="boleto boleto--virtual" data-aos="<?php aos_animacion(); ?>">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$49</p>
        </div>

        <div class="boleto boleto--gratis" data-aos="<?php aos_animacion(); ?>">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Gratis</p>
            <p class="boleto__precio">Gratis - $0</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>

</section>