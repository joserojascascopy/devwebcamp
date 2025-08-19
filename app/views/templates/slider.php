<div class="evento swiper-slide">
    <p class="evento__hora"><?php echo $evento->hora; ?></p>
    <div class="evento__informacion">
        <h4 class="evento__nombre"><?php echo $evento->nombre; ?></h4>

        <p class="evento__introduccion"><?php echo $evento->descripcion; ?></p>

        <div class="evento__autor-info">
            <picture>
                <source srcset="http://localhost:3000/imagenes/speakers/<?php echo $evento->ponente_imagen; ?>.webp" type="image/webp">
                <img class="evento__imagen-autor" loading="lazy" src="http://localhost:3000/imagenes/speakers/<?php echo $evento->ponente_imagen; ?>.jpg" alt="Imagen del ponente">
            </picture>
            <p class="evento__autor-nombre">
                <?php echo $evento->ponente; ?>
            </p>
        </div>
    </div>
</div>