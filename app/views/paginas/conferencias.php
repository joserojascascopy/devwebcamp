<main class="agenda">
    <h2 class="agenda__heading"><?php echo $titulo; ?></h2>
    <p class="agenda__descripcion">Talleres y Conferencias dictados por expertos en desarrollo web</p>

    <div class="eventos">
        <h3 class="eventos__heading">&lt;Conferencias /></h3>
        <p class="eventos__fecha">Viernes, 5 de Octubre</p>
        <div class="eventos__listado">
            <?php foreach ($eventos['conferencias']['viernes'] as $conferencia) : ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $conferencia->hora; ?></p>
                    <div class="evento__informacion">
                        <h4 class="evento__nombre"><?php echo $conferencia->nombre; ?></h4>
        
                        <p class="evento__introduccion"><?php echo $conferencia->descripcion; ?></p>
                
                        <div class="evento__autor-info">
                            <picture>
                                <source srcset="http://localhost:3000/imagenes/speakers/<?php echo $conferencia->ponente_imagen; ?>.webp" type="image/webp">
                                <img class="evento__imagen-autor" loading="lazy" src="http://localhost:3000/imagenes/speakers/<?php echo $conferencia->ponente_imagen; ?>.jpg" alt="Imagen del ponente">
                            </picture>
                            <p class="evento__autor-nombre">
                                <?php echo $conferencia->ponente; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="eventos__fecha">Sábado, 6 de Octubre</p>

        <div class="eventos__listado">

        </div>
    </div>

    <div class="eventos eventos--workshops">
        <h3 class="eventos__heading">&lt;Workshops /></h3>
        <p class="eventos__fecha">Viernes, 5 de Octubre</p>

        <div class="eventos__listado">

        </div>

        <p class="eventos__fecha">Sábado, 6 de Octubre</p>

        <div class="eventos__listado">

        </div>
    </div>
</main>